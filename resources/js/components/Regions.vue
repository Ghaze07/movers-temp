<template>
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Regions:</h2>
            

            <!-- Button trigger for Add_Region_modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRegion">
                Add Region
            </button>
            <!-- start Add region Modal -->
            <div class="modal fade" id="addRegion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Region</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="country">Select Country</label>
                                    <select class="custom-select" id="country" v-model="new_region.country_id">
                                        <option  v-for="(country, index) in countries" :key="index" :value="country.id">{{ country.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="region">Region Title</label>
                                    <input type="text" name="name" class="form-control" v-model="new_region.name" placeholder="Enter Region Title">
                                </div>

                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select class="form-control custom-select" name="status" v-model="new_region.status">
                                        <option value="1">active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" @click.prevent="addRegion">Save</button>
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
                        <th>Country</th>
                        <th>Region</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        <tr v-for="region in regions" :key="region.id" >
                            <td>{{region.country.name}}</td>
                            <td>{{region.name}}</td>
                            <td>{{(region.status)? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button"  class="btn btn-success btn-sm mr-1" @click="editRegion( region )">Edit</button> 
                                <button type="button"  class="btn btn-danger btn-sm mr-1" @click="deleteRegion( region )">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Edit Region Modal -->
                <div class="modal fade" id="edit-Region" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Region</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form >
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="country">Select Country</label>
                                        <select class="custom-select" id="country" v-model="edit_region.country_id">
                                            <option  v-for="(country, index) in countries" :key="index" :value="country.id">{{ country.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="region">Region Title</label>
                                        <input type="text" name="name" class="form-control" v-model="edit_region.name" placeholder="Enter Region Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Select Status</label>
                                        <select class="form-control custom-select" name="status" v-model="edit_region.status">
                                            <option value="1">active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" @click.prevent="updateRegion(edit_region.id)">Save</button>
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
            this.getRegions();
            this.getCountries();
        },
    data: () => ({
        regions: [],
        countries: [],
        new_region: {'name': '', 'country_id': 1, 'status':0},
        edit_region: {'name': '', 'country_id': '', 'status':'', 'id': ''},

    }),
    
    methods: {
        getRegions() {
            axios.get( 'get_regions' ).then( response => {
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
        getCountries() {
            axios.get( 'get_active_countries' ).then( response => {
                    if (response.status == 200) {
                        this.countries = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });
        },

        addRegion() {
            axios.post('regions', this.new_region).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#addRegion').modal('hide');
                     this.getRegions();
                     swal({
                        title: "Region Added!",
                        text: response.data.message,
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    });

                    this.new_region  = {
                        name: '',
                        country_id: 1,
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
        editRegion( region ) {
                 let edit = this.edit_region;
                 edit.name = region.name;
                 edit.country_id = region.country_id;
                 edit.status = region.status;
                 edit.id = region.id;
                $("#edit-Region").modal('show');
        },
        updateRegion( id ){
                axios.put('regions/' + id, this.edit_region).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#edit-Region').modal('hide');
                     this.getRegions();
                     swal({
                        title: "Region Updated!",
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
        deleteRegion( region ) {
                axios.delete('regions/' + region.id).then( (response) => {
                    if (response.status == 200) {
                        this.getRegions();
                        swal({
                            title: "Region Deleted!",
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
