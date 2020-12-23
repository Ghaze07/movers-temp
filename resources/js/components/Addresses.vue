<template>
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Manage Delivery Address:</h2>

            <div class="mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th>City</th>
                        <th>Complete Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="address in addresses" :key="address.id">
                            <td>{{ address.city.name }}</td>
                            <td>{{ address.complete_address }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button"  class="btn btn-success btn-sm mr-1" @click="editAddress( address )">Edit</button> 
                                    <button type="button" style="margin:2px;" class="btn btn-danger" @click="deleteAddress( address )">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="edit-Address" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Change Delivery Address</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="region">Select Region</label>
                                                <select class="custom-select" id="region" v-model='region' @change='getCities()'>
                                                <option value='0' >Select Region</option>
                                                <option  v-for="(region, index) in regions" :key="index" :value="region.id">{{ region.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Select City</label>
                                            <select class="custom-select" id="cities" v-model="fillAddress.city_id">
                                                <option v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="complete_address">Enter Complete Address</label>
                                            <input type="text" class="form-control" id="complete_address" v-model="fillAddress.complete_address"  placeholder="Enter complete address">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" @click="updateAddress( fillAddress.id )">Update</button>
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
            this.getAddresses();
        },

    data: () => ({
            addresses: [],
            fillAddress: { 'city_id': '', 'complete_address': '', 'id': ''},
            
            region: 0,
            regions: [],
            city: 0,
            cities: []
    }),

    methods : {
        
         getAddresses() {
                axios.get( 'get_addresses' ).then( response => {
                    if (response.status == 200) {
                        this.addresses = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });

            },
            
        editAddress( address ) {
                 let edit = this.fillAddress;
                 edit.city_id = address.city_id;
                 edit.complete_address = address.complete_addres;
                 edit.id = address.id;
                $("#edit-Address").modal('show');
            },
        updateAddress( id ){
                let input = this.fillAddress;
                axios.put('address/' + id, input).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    $('#edit-Address').modal('hide');
                     this.getAddresses();
                     swal({
                        title: "Address Updated!",
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
        deleteAddress( address ) {
                axios.delete('address/' + address.id).then( (response) => {
                    if (response.status == 200) {
                        this.getAddresses();
                        swal({
                            title: "Address Deleted!",
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
                    })

            },        

        getRegions: function(){
                axios.get('/get_active_regions')
                    .then((response) => {
                       if (response.status == 200) {
                           this.regions = response.data;
                       } else {
                           console.warn(response.data);
                       }
                   })
                   .catch((error) => {
                       console.error(error);
                   });

            },
        getCities: function() {
                axios.get('/get_cities',{
                    params: {
                        region_id: this.region
                    }
                }).then((response) => {
                   if (response.status == 200) {
                     this.cities = response.data;
                   } else {
                     console.warn(response.data);
                   }
                 })
                 .catch((error) => {
                   console.error(error);
                 });

            }
    },
    created: function(){
            this.getRegions();
        }
}
</script>
