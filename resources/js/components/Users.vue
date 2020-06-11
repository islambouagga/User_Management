<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">

                            <button class="btn btn-success" @click="newModal()">
                                add new
                                <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <div class="row mt-2">
                            <label style="margin-left: 4%;margin-top: 1%; margin-right: 1%">Filter by name</label>
                            <input class="form-control col-md-4"
                                   v-model="filters.name.value"
                            />
                        </div>
                        <v-table class="table table-hover text-nowrap" :data="users"
                                 :filters="filters"
                                 :hideSortIcons="true"
                                 :currentPage.sync="currentPage"
                                 :pageSize="pageSize"
                                 @totalPagesChanged="totalPages = numb ">
                            <thead slot="head">
                            <v-th  sortKey="name">Name</v-th>
                            <v-th  sortKey="email">Email</v-th>
                            <v-th  sortKey="type" >Type</v-th>
                            <v-th  sortKey="isOnline">Status</v-th>
                            <v-th  :customSort="dateSort">Registered</v-th>
                            <th>Modifie</th>
                            </thead>
                            <tbody slot="body" slot-scope="{displayData}">
                            <tr v-for="row in displayData" :key="row.guid">
                                <td>{{ row.name }}</td>
                                <td>{{ row.email }}</td>
                                <td>
                                    {{ row.type}}
                                </td>
                                <div v-if="row.isOnline == true">
                                    <td><span class="badge badge-success">Online</span></td>
                                </div>
                                <div v-if="row.isOnline == false">
                                    <td><span class="badge badge-danger">Offline</span></td>
                                </div>
                                <td>{{row.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(row)">
                                        <i class="fas fa-user-edit teal "></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteUser(row.id)">
                                        <i class="fas fa-trash red "></i>
                                    </a>
                                </td>

                            </tr>
                            </tbody>
                        </v-table>
                        <smart-pagination
                            :currentPage.sync="currentPage"
                            :totalPages="totalPages"
                        />
                    </div>
                    <!--                    &lt;!&ndash; /.card-body &ndash;&gt;-->

                </div>
                <!-- /.card -->
            </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add new </h5>
                        <h5 v-show="editMode" class="modal-title" id="addNewLabel2">Update user </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Enter name "
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="email" name="email"
                                       placeholder="Email Address"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Bio</label>
                                <textarea v-model="form.bio" name="bio" id="bio"
                                          placeholder="Short bio for user (Optional)"
                                          class="form-control"
                                          :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>


                            <div class="form-group">
                                <label>User Type</label>
                                <select name="type" v-model="form.type" id="type" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input v-model="form.password" type="password" name="password" id="password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                editMode: false,
                users: {},
                pageSize: 5,
                currentPage: 1,
                totalPages: 0,

                // Create a new form instance
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    isOnline: '',
                    photo: ''
                }),
                filters: {
                    name: {value: '', keys: ['name']},
                    type: {value: '', keys: ['type']},
                    email: {value: '', keys: ['email']}
                },
            }
        },
        methods: {
            dateSort(a, b) {
                let date1 = new Date(a.created_at).getTime();
                let date2 = new Date(b.created_at).getTime();
                return date1 - date2;
            },
            newModal() {
                this.editMode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal(user) {
                this.editMode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            updateUser() {
                this.$Progress.start();
                this.form.put('api/users/' + this.form.id)
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'User updated  successfully'
                        });
                        this.$Progress.finish();

                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong!'
                        });
                        this.$Progress.fail();
                    })
            },
            deleteUser(id) {
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
                        this.form.delete('api/users/' + id)
                            .then((res) => {

                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            })
                            .catch(() => {
                                Swal.fire(
                                    'Failed!',
                                    'Something went wrong!',
                                    'warning'
                                )
                            })
                    }
                })
            },
            loadUsers() {
                if (this.$gate.isAdminOrAuthor) {

                    axios.get("api/users").then(({data}) => {
                        this.users = data;
                        this.totalPages = Math.round((this.users.length)/(this.pageSize))+1 ;
                    });
                }
            },
            createUser() {
                this.$Progress.start()
                this.form.post('api/users')
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'User created  successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong!'
                        });
                        this.$Progress.fail()
                    })
            },
            intervalFetchData: function () {
                setInterval(() => {
                    this.loadUsers();

                }, 30000);
            }
        },
        mounted() {
            Fire.$on('searching', () => {
                let text = this.$parent.search;
                axios.get('api/findUser?q=' + text)
                    .then((data) => {
                        this.users = data
                    })
                    .chatch((err) => {
                        console.log(err)
                    })
            });
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });
            this.intervalFetchData();
        }
    }
</script>
