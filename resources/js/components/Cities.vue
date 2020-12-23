<template>
    <div class="row align-items-end content">
    <div class="col-12 justify-content-around">
        <h2>Cities:</h2>
        <!-- Button trigger for Add_Region_modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCity">
            Add City
        </button>
        <!-- Add_Region_Modal -->
        <div class="modal fade" id="addCity" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New City</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="region">Select Region</label>
                                <select class="custom-select" id="region" v-model="new_city.region_id">
                                    <option  v-for="(region, index) in regions" :key="index" :value="region.id">{{ region.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">City Title</label>
                                <input type="text" name="name" class="form-control" v-model="new_city.name" placeholder="Enter City Title">
                            </div>
                            <div class="form-group">
                                <label for="name_abbreviation">City Abbrevation</label>
                                <input type="text" name="name_abbreviation" class="form-control" v-model="new_city.name_abbreviation" placeholder="Enter City Abbrevation">
                            </div>
                            <div class="form-group">
                                <label for="status">Select Status</label>
                                <select class="form-control custom-select" name="status" v-model="new_city.status">
                                    <option value="1">active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" @click.prevent="addCity">Save</button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Region</th>
                    <th>City</th>
                    <th>City Abbrevation</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="city in cities" :key="city.id">
                        <td>{{city.region.name}}</td>
                        <td>{{city.name }}</td>
                        <td>{{city.name_abbreviation }}</td>
                        <td>{{(city.status) ? 'Active' : 'Inactive'}}</td>
                        <td>
                            <button type="button"  class="btn btn-success btn-sm mr-1" @click="editCity( city )">Edit</button> 
                            <button type="button"  class="btn btn-danger btn-sm mr-1" @click="deleteCity( city )">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Edit City Modal -->
            <div class="modal fade" id="edit-City" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit City</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="region">Select Region</label>
                                        <select class="custom-select" id="region" v-model="edit_city.region_id">
                                            <option  v-for="(region, index) in regions" :key="index" :value="region.id">{{ region.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">City Title</label>
                                        <input type="text" name="name" class="form-control" v-model="edit_city.name" placeholder="Enter City Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="name_abbreviation">City Abbrevation</label>
                                        <input type="text" name="name_abbreviation" class="form-control" v-model="edit_city.name_abbreviation" placeholder="Enter City Abbrevation">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Select Status</label>
                                        <select class="form-control custom-select" name="status" v-model="edit_city.status">
                                            <option value="1">active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" @click.prevent="updateCity(edit_city.id)">Save</button>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>                
            </div>    
        </div>
        <div>
            
        </div>     
    </div>
</div>
</template>
<script>
export default {
    mounted() {
            this.getCities();
            this.getRegions();
    },
    data: () => ({

        cities: [],
        regions: [],
        new_city: {'region_id': 2, 'name': '', 'status':0, 'name_abbreviation':''},
        edit_city: {'region_id': '', 'name': '', 'status':'', 'name_abbreviation':'', 'id': ''},
    }),

    methods: {
        getCities() {
            axios.get( 'get_all_cities' ).then( response => {
                    if (response.status == 200) {
                        this.cities = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });
        },
        getRegions() {
            axios.get( 'get_active_regions' ).then( response => {
                console.log(response.data);
                    if (response.status == 200) {
                        this.regions = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });
        },

        addCity() {
            axios.post('cities', this.new_city).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#addCity').modal('hide');
                     this.getCities();
                     swal({
                        title: "City Added!",
                        text: response.data.message,
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    });

                    this.new_city = {
                        name: '',
                        name_abbreviation: '',
                        region_id: 2,
                        status: 0
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
        editCity( city ) {
                 let edit = this.edit_city;
                 edit.name = city.name;
                 edit.name_abbreviation = city.name_abbreviation;
                 edit.region_id = city.region_id;
                 edit.status = city.status;
                 edit.id = city.id;
                $("#edit-City").modal('show');
        },
        updateCity( id ){
                axios.put('cities/' + id, this.edit_city).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#edit-City').modal('hide');
                     this.getCities();
                     swal({
                        title: "City Updated!",
                        text: response.data.message,
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
        deleteCity( city ) {
                axios.delete('cities/' + city.id).then( (response) => {
                    if (response.status == 200) {
                        this.getCities();
                        swal({
                            title: "City Deleted!",
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
    }
}
</script>
