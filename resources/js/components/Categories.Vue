<template>
    <div class="container">
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card" v-if="$gate.isAdminORAuthor()">
              <div class="card-header">
                <h3 class="card-title">Categories list</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add Category<i class="fa fa-blog-plus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Title</th>
                      <th>Creator</th>
                      <th>Creation date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                        <td>{{category.id}}</td>
                        <td>{{category.name}}</td>
                        <td>{{category.user.name}}</td>
                        <td>{{category.created_at | myDate}}</td>
                      <td>
                          <a href="#" @click="editModal(category)"> <i class="fa fa-edit" title="edit"></i>
                          </a> |
                          <a href="#" @click="deletecategory(category.id)"> <i class="fa fa-trash" title="delete"></i>
                          </a> 
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <!-- <pagination :data="categories" @pagination-change-page="getResults"></pagination> -->
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdminORAuthor()">
            <not-found></not-found>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNewCat" tabindex="-1" role="dialog" aria-labelledby="addNewlLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Category</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                      <div class="modal-body">
                          <div class="form-group">
                            <!-- Name -->
                            <input v-model="form.name" type="text" name="name"
                              placeholder="Category Name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                          </div>
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
                form: new Form({
                    id: '',
                    name: '',
                    user_id: '',
                    
                    
                })
            }
        },
        methods: {
            getResults(page = 1) {
              axios.get('api/category?page=' + page)
                .then(response => {
                  this.categories = response.data;
                });
            },
            updateCategory(){
                this.$Progress.start();
                this.form.put('api/category/'+this.form.id)
                .then(() => {
                  // success
                  // Close modal
                   $('#addNewCat').modal('hide');
                  //  show success alert
                  Swal.fire(
                    'Updated',
                    'Category data has been updated!',
                    'success'
                  )
                  this.$Progress.finish();
                  Fire.$emit('afterUpdated');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(category){
              this.editmode = true;
                this.form.reset();
                $('#addNewCat').modal('show');
                this.form.fill(category);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNewCat').modal('show');
            },
            deleteCategory(id){
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
                        this.form.delete('api/category/'+id).then(() => {
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
            loadCategories(){
                if(this.$gate.isAdminORAuthor()){
                  axios.get("api/category").then(({ data }) => (this.categories = data));
                }
                
            },
            createCategory(){
                this.$Progress.start();
                this.form.post('api/category')
                // use promise to check if blog creation was successful
                .then(()=>{
                    Fire.$emit('afterUpdated');
                      $('#addNewCat').modal('hide');
                      Toast.fire({
                        icon: 'success',
                        title: 'Category created successfully'
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
            axios.get('api/findCategory?q=' +query)
            .then((data) => {
                this.categories = data.data;
            })
            .catch(() => {
            })
          })
          
          this.loadCategories();
          // update table after insertion of blog
          Fire.$on('afterUpdated',() => {
              this.loadCategories();
          });
          // setInterval(() => this.loadblogs(), 3000);
        },
        mounted() {
            // console.log('Component mounted.')
            // this.loadCategories();
        }
    }
</script>