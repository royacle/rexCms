<template>
    <div class="container">
        <div class="row mt-4">
          <div class="col-md-12">
            <div class="card" v-if="$gate.isAdminORAuthor()">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add <i class="fa fa-user-plus"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Bio</th>
                      <th>Type</th>
                      <th>Creation date</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.bio}}</td>
                      <td>{{user.type | upText}}</td>
                      <td>{{user.created_at | myDate}}</td>
                      <td>
                          <a href="#" @click="editModal(user)"> <i class="fa fa-edit" title="edit"></i>
                          </a> |
                          <a href="#" @click="deleteUser(user.id)"> <i class="fa fa-trash" title="delete"></i>
                          </a> 
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdminORAuthor()">
            <not-found></not-found>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewlLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New User</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                  <form @submit.prevent="editmode ? updateUser() : createUser()">
                      <div class="modal-body">
                          <div class="form-group">
                            <!-- Name -->
                            <input v-model="form.name" type="text" name="name"
                              placeholder="Full Name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                          </div>
                          <!-- Email -->
                          <div class="form-group">
                            <input v-model="form.email" type="email" name="email"
                              placeholder="Email Address"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                          </div>
                          <!-- Bio -->
                          <div class="form-group">
                            <textarea v-model="form.bio" type="text" name="bio"
                              placeholder="Brief Bio"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                            <has-error :form="form" field="bio"></has-error>
                          </div>
                          <!-- User type -->
                          <div class="form-group">
                            <select v-model="form.type" type="text" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                <option value="">Select User Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="author">Author</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                          </div>
                          <!-- Password -->
                          <div class="form-group">
                            <input v-model="form.password" type="password" name="password"
                              placeholder=""
                              class="form-control" :class="{'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
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
                users : {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo:  ''
                    
                })
            }
        },
        methods: {
            getResults(page = 1) {
              axios.get('api/user?page=' + page)
                .then(response => {
                  this.users = response.data;
                });
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                  // success
                  // Close modal
                   $('#addNew').modal('hide');
                  //  show success alert
                  Swal.fire(
                    'Updated',
                    'User data has been updated!',
                    'success'
                  )
                  this.$Progress.finish();
                  Fire.$emit('afterUpdated');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(user){
              this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUser(id){
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
                        this.form.delete('api/user/'+id).then(() => {
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
            loadUsers(){
                if(this.$gate.isAdminORAuthor()){
                  axios.get("api/user").then(({ data }) => (this.users = data));
                }
                
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                // use promise to check if user creation was successful
                .then(()=>{
                    Fire.$emit('afterUpdated');
                      $('#addNew').modal('hide');
                      Toast.fire({
                        icon: 'success',
                        title: 'User created successfully'
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
            axios.get('api/findUser?q=' +query)
            .then((data) => {
                this.users = data.data;
            })
            .catch(() => {
            })
          })
          
          this.loadUsers();
          // update table after insertion of user
          Fire.$on('afterUpdated',() => {
              this.loadUsers();
          });
          // setInterval(() => this.loadUsers(), 3000);

        }
        // mounted() {
        //     console.log('Component mounted.')
        
    }
</script>