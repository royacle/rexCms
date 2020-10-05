<template>
    <div class="container">
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card" v-if="$gate.isAdminORAuthor()">
              <div class="card-header">
                <h3 class="card-title">Posts list</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Post<i class="fa fa-blog-plus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Post Title</th>
                      <th>View Post</th>
                      <th>Creator</th>
                      <th>Category</th>
                      <th>Creation date</th>
                      <th>Update date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr v-for="post in posts.data" :key="post.id"> -->
                    <tr v-for="post in posts.data" :key="post.id">
                        <td>{{post.id}}</td>
                        <td>{{post.title}}</td>
                        <td>{{post.slug}}</td>
                        <td>{{post.user.name}}</td>
                        <td>{{post.category.name}}</td>
                        <td>{{post.updated_at | myDate}}</td>
                        <td>{{post.created_at | myDate}}</td>
                      <td>
                          <a href="#" @click="editModal(post)"> <i class="fa fa-edit" title="edit"></i>
                          </a> |
                          <a href="#" @click="deletepost(post.id)"> <i class="fa fa-trash" title="delete"></i>
                          </a> 
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="posts" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdminORAuthor()">
            <not-found></not-found>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNewPost" tabindex="-1" role="dialog" aria-labelledby="addNewlLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New post</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  <form @submit.prevent="editmode ? updatePost() : createPost()">
                      <div class="modal-body">
                          <div class="form-group">
                            <!-- Title -->
                            <input v-model="form.title" type="text" name="title"
                              placeholder="Post Title"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                            <has-error :form="form" field="title"></has-error>
                          </div>
                          <!-- Body -->
                          <div class="form-group">
                            <textarea v-model="form.body" type="text" name="body"
                              placeholder="Post Body"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('body') }"></textarea>
                            <has-error :form="form" field="body"></has-error>
                          </div>
                          <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="categories_id" style="width: 100%;" v-model="form.category_id" 
                            :class="{ 'is-invalid': form.errors.has('categories_id') }">
                              <option value="">Select Category</option>
                              <option v-for="(category, c) in categories.data" v-bind:key="c" :value="category.id">{{category.name}}</option>
                            </select>
                            <has-error :form="form" field="categories_id"></has-error>
                          </div>
                          <!-- /.form-group -->
                      </div>
                      <!-- Buttons -->
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                          <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                      </div>
                  </form>
              </div>
            </div>
        </div>
        <!-- /.Modal -->
    </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: true,
                categories : {},
                posts : {},
                form: new Form({
                    id: '',
                    title: '',
                    body: '',
                    category_id: '',
                    user_id: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
              axios.get('api/post?page=' + page)
                .then(response => {
                  this.posts = response.data;
                });
            },
            updatePost(){
                this.$Progress.start();
                this.form.put('api/post/'+this.form.id)
                .then(() => {
                  // success
                  // Close modal
                   $('#addNewPost').modal('hide');
                  //  show success alert
                  Swal.fire(
                    'Updated',
                    'Post data has been updated!',
                    'success'
                  )
                  this.$Progress.finish();
                  Fire.$emit('afterUpdated');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(post){
              this.editmode = true;
                this.form.reset();
                $('#addNewPost').modal('show');
                this.form.fill(post);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNewPost').modal('show');
            },
            deletePost(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                     if (result.value) {
                    // Send req to server for confirmation
                        this.form.delete('api/post/'+id).then(() => {
                            // if (result.value) {
                              Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                              )
                              Fire.$emit('afterUpdated');
                            // }
                        }).catch(() => {
                            Swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                  })
            },
            loadPosts(){
                if(this.$gate.isAdminORAuthor()){
                  axios.get("api/post").then(({ data }) => (this.posts = data)).catch(error => console.log(error));
                }
                
            },
            loadCategories(){
                if(this.$gate.isAdminORAuthor()){
                  axios.get("api/category").then(({ data }) => (this.categories = data)).catch(error => console.log(error));
                }
            },
            
            createPost(){
                this.$Progress.start();
                this.form.post('api/post')
                // use promise to check if post creation was successful
                .then(()=>{
                    Fire.$emit('afterUpdated');
                      $('#addNewPost').modal('hide');
                      Toast.fire({
                        icon: 'success',
                        title: 'Post created successfully'
                      })
                    this.$Progress.finish();
                })
                // if it failed catch and display error
                .catch(() => {
                });
                
          }
        },
        created(){
          Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('api/findpost?q=' +query)
            .then((data) => {
                this.posts = data.data;
            })
            .catch(() => {
            })
          })
          
          this.loadPosts();
          // update table after insertion of blog
          Fire.$on('afterUpdated',() => {
              this.loadPosts();
          });
          // setInterval(() => this.loadblogs(), 3000);
        },
        mounted() {
            // console.log('Component mounted.')
            // console.log()
            this.loadCategories();
        }
    }
    // $(document).ready(function() {
    //     $('.cate').select2();
    // });
</script>