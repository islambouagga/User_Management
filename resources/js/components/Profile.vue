<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 :src="userPhoto()"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{this.form.name}}</h3>

                        <p class="text-muted text-center">{{this.form.type}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">


                            </div>
                            <!-- /.tab-pane -->


                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.name" type="text" class="form-control" id="inputName" placeholder="Name"
                                                   :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input v-model="form.email" type="email" class="form-control" id="inputEmail" placeholder="Email"
                                                   :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                            <textarea v-model="form.bio" class="form-control" id="inputExperience" placeholder="Experience"
                                                      :class="{ 'is-invalid': form.errors.has('bio') }"  ></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="photo" class="col-sm-2 col-form-label">Profile photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" @change="updateProfile" name="photo" class="form-control" id="photo">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassowrd" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" v-model="form.password" class="form-control" id="inputPassword" placeholder="Password"
                                                   :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" @click.prevent="updateInfo" class="btn btn-success">Update</button>
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid --></template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    id:'',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods:{
            userPhoto(){

                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;
            },
            updateProfile(e){
                let file =  e.target.files[0];
                let reader = new FileReader();
                if(file['size'] < 2111775){
                    reader.onloadend =  (file) => {
                        // console.log('result ',reader.result)
                        this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
                else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        icon:'error',
                        text: 'You are uploading a large file',
                    });
                }

            },
            updateInfo(){
                this.$Progress.start();
                this.form.put('api/profile')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    Toast.fire({
                        icon: 'success',
                        title: 'User updated  successfully'
                    });
                    this.$Progress.finish();
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong!'
                    });
                    this.$Progress.fail();
                })
            },
        },
        mounted() {
            console.log('Component mounted.')
        },

        created() {
            axios.get("api/profile")
                .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
