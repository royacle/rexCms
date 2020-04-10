<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer {
    padding-top: 0px;
}
</style>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image:url('./img/user-cover.png');">
                        <h3 class="widget-user-username"><em>Name : </em>{{ this.form.name }}</h3>
                        <h5 class="widget-user-desc"><em>User Type : </em> {{this.form.type}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">3,200</h5>
                            <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">35</h5>
                            <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    </div>
                    <!-- setting tab -->
                    
                    <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                        <div class="tab-pane" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <h3>Display User Activity</h3>
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        
                        <!-- /.tab-pane -->

                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="email" v-model="form.name" class="form-control" id="name" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" v-model="form.email" class="form-control" id="email" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputBio" class="col-sm-2 col-form-label">Bio</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" v-model="form.bio" id="bio" placeholder="Bio" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profilePhoto" class="col-sm-2 col-form-label">Profile Photo</label>
                                <div class="col-sm-10">
                                    <input type="file" @change="updateProfile" class="form-control-file" id="profilePhoto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                <input type="password" v-model="form.password" class="form-control" id="password" placeholder="Password (Leave empty if not changing)" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    </div>
            <!-- /.nav-tabs-custom -->
          
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user : {},
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
        mounted() {
            // console.log('Component mounted.')
            // console.log(this.form.name)
        },

        methods:{

            
            loadUsers(){
                axios.get("api/profile").then(({ data }) => (this.user = data.data));
            },

            getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+this.form.photo ;
                return photo;
                
            },
            updateInfo(){
                this.$Progress.start();
                if (this.form.password == '') {
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(() => {

                    Fire.$emit('afterUpdated');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            },
            updateProfile(e){
                // console.log('uploading');
                
                let file = e.target.files[0];
                let reader = new FileReader();
                // check file size
                if (file['size'] <= 2111775) {
                     reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result)
                    this.form.photo = reader.result;
                    Fire.$emit('afterUpdated');
                    }
                    reader.readAsDataURL(file);
                }else{
                    // display error
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a file larger than 2MB!'
                    })
                }
               
            }

        },

        created()  {
            this.loadUsers();
            // update table after insertion of user
            Fire.$on('afterUpdated',() => {
                this.loadUsers();
            });
            // setInterval(() => this.loadUsers(), 3000);
        //    axios.get("api/profile")
        //    .then(({ data }) => (this.form.fill(data)));

           
        }
    }
</script>
