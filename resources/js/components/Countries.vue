<template>
<div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Countries:</h2>

            <!-- Button trigger for Add_Country_modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcountry">
                Add Country
            </button>
            <!-- Start Add Country Modal -->
            <div class="modal fade" id="addcountry" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Country</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="cname">Country Name</label>
                                    <input type="text" name="name" class="form-control" v-model="new_country.name" placeholder="Enter Country Name">
                                </div>
                                <div class="form-group">
                                    <label for="sname">Country Code</label>
                                    <input type="text" name="short_name" class="form-control" v-model="new_country.short_name" placeholder="Enter Country Code">
                                </div>
                                <div class="form-group">
                                    <label for="status">Select Status</label>
                                    <select class="form-control" name="status" v-model="new_country.status">
                                        <option value="1">active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" @click.prevent="addCountry">Save</button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Country Modal -->

            <div class="mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>Country Name</th>
                        <th>Country Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="country in countries" :key="country.id">
                            <td>{{country.name }}</td>
                            <td>{{country.short_name}}</td>
                            <td>{{ (country.status) ? 'Active' : 'Inactive'}}</td>
                            <td>                               
                                <button type="button"  class="btn btn-success btn-sm mr-1" @click="editCountry( country )" >Edit</button> 
                                <button type="button"  class="btn btn-danger btn-sm mr-1" @click="deleteCountry( country )">Delete</button>                               
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <!-- Edit Country Modal -->
                <div class="modal fade" id="edit-Country" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Country</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form >
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="cname">Country Name</label>
                                        <input type="text" name="name" class="form-control" id="name" v-model="edit_country.name" placeholder="Enter Country Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="sname">Country Code</label>
                                        <input type="text" name="short_name" class="form-control" id="short_name" v-model="edit_country.short_name" placeholder="Enter Country Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Select Status</label>
                                        <select class="form-control" name="status" v-model="edit_country.status">
                                            <option value="1">active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" @click.prevent="updateCountry( edit_country.id )">Update</button>
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
            this.getCountries();
        },

    data: () => ({
        countries: [],
        new_country: {'name': '', 'short_name': '', 'status': 0},
        edit_country: {'name': '', 'short_name': '', 'status':'', 'id': ''},

    }),

    methods: {
        getCountries() {
            axios.get( 'get_countries' ).then( response => {
                    if (response.status == 200) {
                        this.countries = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });
        },
        addCountry() {
            let input = this.new_country;
            axios.post('countries', input).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#addcountry').modal('hide');
                     this.getCountries();
                     swal({
                        title: "Country Added!",
                        text: response.data.message,
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    });

                    this.new_country = {
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
        editCountry( country ) {
                 let edit = this.edit_country;
                 edit.name = country.name;
                 edit.short_name = country.short_name;
                 edit.status = country.status;
                 edit.id = country.id;
                $("#edit-Country").modal('show');
            },
        updateCountry( id ){
                let input = this.edit_country;
                console.log(id);
                axios.put('countries/' + id, input).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#edit-Country').modal('hide');
                     this.getCountries();
                     swal({
                        title: "Country Updated!",
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
        deleteCountry( country ) {
                axios.delete('countries/' + country.id).then( (response) => {
                    if (response.status == 200) {
                        this.getCountries();
                        swal({
                            title: "Country Deleted!",
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
