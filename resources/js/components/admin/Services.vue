<template>
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Services:</h2>
            
            <!-- Button trigger for Add_Country_modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_service">
                Add Service
            </button>
            <!-- Start Add Service Modal -->
            <div class = "modal fade" id = "add_service" role = "dialog">
            <div class = "modal-dialog modal-lg">
               <div class = "modal-content">
                  <div class = "modal-header">
                    <h4 class = "modal-title">Add Service</h4>      
                    <button type = "button" class="close" data-dismiss = "modal">×</button>   
                  </div>
                    <div class = "modal-body">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Service Name</label>
                            <input type="text" v-model="new_service.name" class="form-control" placeholder="Enter Service Name">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            <input type="file" @change="imageSelected" accept="image/*" class="form-control">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="first_trait">First Trait</label>
                            <input type="text" v-model="new_service.first_trait" class="form-control" placeholder="Enter First Trait">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="second_trait">Second Trait</label>
                            <input type="text" v-model="new_service.second_trait" class="form-control" placeholder="Enter Second Trait">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="third_trait">Third Trait</label>
                            <input type="text" v-model="new_service.third_trait" class="form-control" placeholder="Enter Third Trait">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="status">Select Status</label>
                            <select class="form-control" v-model="new_service.status" name="status" required>
                                <option value="1">active</option>
                                <option value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class = "modal-footer">
                        <button type ="button" class = "btn btn-danger" data-dismiss = "modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="addService()">Save</button>
                    </div>
               </div>
            </div>
            </div>
            <!-- End Add Service Modal -->
            <div class="mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>First Trait</th>
                            <th>Second Trait</th>
                            <th>Third Trait</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="service in services" :key="service.id">
                           <td>{{ service.name}}</td>
                           <td><img :src="service.image"  alt="" style="width: 5rem;"></td>
                           <td>{{ service.first_trait}}</td>
                           <td>{{ service.second_trait}}</td>
                           <td>{{ service.third_trait}}</td>
                           <td>{{ (service.status) ? 'Active' : 'Inactive'}}</td>
                           <td>                               
                                <button type="button" @click="editService( service )"  class="btn btn-primary btn-sm mr-1">Edit</button> 
                                <button type="button" @click="deleteService(service)"  class="btn btn-danger btn-sm mr-1">Delete</button>                               
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Start Edit Service Modal -->
            <div class = "modal fade" id = "edit_service" role = "dialog">
            <div class = "modal-dialog modal-lg">
               <div class = "modal-content">
                  <div class = "modal-header">
                    <h4 class = "modal-title">Add Service</h4>      
                    <button type = "button" class="close" data-dismiss = "modal">×</button>   
                  </div>
                    <div class = "modal-body">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Service Name</label>
                            <input type="text" v-model="edit_service.name" class="form-control" placeholder="Enter Service Name">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            <input type="file" @change="update_imageSelected" accept="image/*" class="form-control">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="first_trait">First Trait</label>
                            <input type="text" v-model="edit_service.first_trait" class="form-control" placeholder="Enter First Trait">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="second_trait">Second Trait</label>
                            <input type="text" v-model="edit_service.second_trait" class="form-control" placeholder="Enter Second Trait">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="third_trait">Third Trait</label>
                            <input type="text" v-model="edit_service.third_trait" class="form-control" placeholder="Enter Third Trait">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="status">Select Status</label>
                            <select class="form-control" v-model="edit_service.status" name="status" required>
                                <option value="1">active</option>
                                <option value="0">Inactive</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <div class = "modal-footer">
                        <button type ="button" class = "btn btn-danger" data-dismiss = "modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="updateService(edit_service.id)">Update</button>
                    </div>
               </div>
            </div>
            </div>
            <!-- End Edit Service Modal -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            services: [],
            new_service: {'name': '', 'image': '', 'first_trait': '', 'second_trait': '', 'third_trait': '', 'status': ''},
            edit_service: {'name': '', 'image': '', 'first_trait': '', 'second_trait': '', 'third_trait': '', 'status': '', 'id': ''},
        }
    },
    created() {
        this.getServices();
    },   
    methods: {
        getServices() {
            axios.get( '/all_services' ).then( response => {
                    if (response.status == 200) {
                        this.services = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });
        },
        imageSelected(e){
            this.new_service.image = e.target.files[0];
        },
        update_imageSelected(e){
            this.edit_service.image = e.target.files[0];
        },
        addService() {
        let data = new FormData;
        Object.entries(this.new_service).forEach(([key, value]) => {
          data.append(key, value);
        });
        axios.post('/services', data).then( (response) => {
            if (response.status == 200) {
                console.log(response.data);
                 $('#add_service').modal('hide');
                this.services.push(response.data);
                swal({
                    title: "Service Saved",
                    text: "Service has been created successfully",
                    icon: "success",
                    buttons: false,
                    timer: 3000
                });
                this.new_service  = {
                    name: '',
                    image: '',
                    first_trait: '',
                    second_trait: '',
                    third_trait: '',
                    status: '',
                }                
            } else {
                console.warn(response.data);
            }
            }).catch( (error)=> {
                var message = '';
                if(error.response.status == 500) {
                message = error.response.statusText;
                } else {
                message = error.response.data.message;
                this.errors = error.response.data.errors;
                }
                swal({
                    title: "Some Thing Wrong!",
                    text: error.response.data.message,
                    icon: "error",
                    buttons: false,
                    timer: 2000
                });
            })
        },
        editService( service ) {
            let edit = this.edit_service;
            edit.name = service.name;
            edit.first_trait = service.first_trait;
            edit.second_trait = service.second_trait;
            edit.third_trait = service.third_trait;
            edit.status = service.status;
            edit.id = service.id;
            $("#edit_service").modal('show');
        },
        updateService() {
        let id = this.edit_service.id;
        console.log(id);
        let data = new FormData;
         Object.entries(this.edit_service).forEach(([key, value]) => {
          data.append(key, value);
        });
        axios.post('/update_service', data).then( (response) => {
          if (response.status == 200) {
            console.log(response.data);
            $('#edit_service').modal('hide');
            this.getServices();
            swal({
              title: "Service Updated!",
              text: "Service updated successfully.",
              icon: "success",
              buttons: false,
              timer: 3000
            });  
            } else {
                console.warn(response.data);
            }
            }).catch( (error)=> {
                var message = '';
                message = error.response.data.message;
                this.errors = error.response.data.errors;
                swal({
                title: "Some Thing Wrong!",
                text: error.response.data.message,
                icon: "error",
                buttons: false,
                timer: 2000
              });
            })
        },
        deleteService( service ) {
                axios.delete('services/' + service.id).then( (response) => {
                    if (response.status == 200) {
                        this.getServices();
                        swal({
                            title: "Service Deleted!",
                            text: response.data.message,
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
    },
}
</script>