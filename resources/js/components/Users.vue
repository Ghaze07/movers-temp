<template>
       
    <div>
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addUser">
            creat user
        </button>
        <!-- Add User Modal -->
        <div class="modal fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" v-model="new_user.name" placeholder="Enter User Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" v-model="new_user.email" placeholder="Enter User Email">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="number" name="mobile" class="form-control" v-model="new_user.mobile" placeholder="Enter User Mobile" required>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" @click.prevent="addUser">Insert</button>
                                </div>
                            </div>  
                    </form>
                </div>
            </div>
        </div>
         <!--End Add User Modal  -->
        <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role</th>
                    <th>Reg. Date</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.mobile}}</td>
                        <td>{{user.role}}</td>
                        <td>{{user.created_at | localTime}}</td>
                        <td>                               
                            <button type="button"  class="btn btn-success btn-sm mr-1"  @click="editUser( user )">Edit</button> 
                            <button type="button"  class="btn btn-danger btn-sm mr-1"  @click="deleteUser( user )">Delete</button>                               
                        </td>
                    </tr>
                </tbody>
        </table>
        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" v-model="edit_user.name" placeholder="Enter User Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" v-model="edit_user.email" placeholder="Enter User Email">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="number" name="mobile" class="form-control" v-model="edit_user.mobile" placeholder="Enter User Mobile" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select class="form-control" name="status" v-model="edit_user.role">
                                        <option value="admin">admin</option>
                                        <option value="customer">customer</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" @click.prevent="updateUser( edit_user.id )">Update</button>
                                </div>
                            </div>  
                    </form>
                </div>
            </div>
        </div>
        <!-- End Edit User Modal -->
    </div>        
</template>
<script>
export default {
    props:{
        user: Array,
    },
    data: () => ({
        users: [],
        new_user: {'name': '', 'email':'', 'mobile':''},
        edit_user: {'name': '', 'email':'', 'mobile':'', 'role':'', 'id':''}

    }),
    created() {
        this.setUsers();
    },
    filters: {
        localTime: function (date) {
            return moment(date).format('LL');
        }
    },
    methods: {
        setUsers() {
            this.users = this.user
        },
        addUser() {
            let input = this.new_user;
            axios.post('user', input).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#addUser').modal('hide');
                      this.users.push(response.data);
                     swal({
                        title: "User Added!",
                        text: "User Account has been created",
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    });

                    this.new_user = {
                        name: '',
                        short_name: '',
                        status: ''
                    }
                    
                } else {
                    console.warn(response.data);
                }
                }).catch( (error)=> {
                    console.log( error.response.data )
                    swal({
                    title: "Some Thing Wrong!",
                    text: error.response.data.message,
                    icon: "error",
                    buttons: false,
                    timer: 3000
                });
            })

        },
        editUser( user ) {
                 let edit = this.edit_user;
                 edit.name = user.name;
                 edit.email = user.email;
                 edit.mobile = user.mobile;
                 edit.role = user.role;
                 edit.id = user.id;
                $("#editUser").modal('show');
        },
        updateUser( id ){
                let input = this.edit_user;
                console.log(id);
                axios.put('user/' + id, input).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#editUser').modal('hide');
                    this.users.forEach((user) => {
                        if (user.id == id) {
                            user.name = response.data.name;
                            user.email = response.data.email;
                            user.mobile = response.data.mobile;
                            user.role = response.data.role;
                        }
                    });
                    swal({
                        title: "User Updated!",
                        text: "User updated successfully.",
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    });
                    
                } else {
                    console.warn(response.data);
                }
                }).catch( (error)=> {
                    console.log( error.response.data )
                    swal({
                    title: "Some Thing Wrong!",
                    text: error.response.data.message,
                    icon: "error",
                    buttons: false,
                    timer: 3000
                });
                })
        },
        deleteUser( user ) {
                axios.delete('user/' + user.id).then( (response) => {
                    if (response.status == 200) {
                        console.log(response.data.id);
                        location.reload();
                        swal({
                            title: "User Deleted!",
                            text: "User has been deleted successfully.",
                            icon: "warning",
                            buttons: false,
                            timer: 3000
                        });

                    } else {
                        console.warn(response.data);
                    }
                    
                    }).catch( (error)=> {
                        console.log( error.response.data)
                        swal({
                            title: "Some Thing Wrong!",
                            text: error.response.data.message,
                            icon: "error",
                            buttons: false,
                            timer: 3000
                        });
                    })

            },                
    }
}
</script>