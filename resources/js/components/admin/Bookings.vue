<template>
    <div class="row align-items-end content">
        <div class="col-12 justify-content-around">
            <h2>Moves:</h2>
            
            <div class="mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Customer Name</th>
                            <th>Mobile</th>
                            <th>From</th>
                            <th>TO</th>
                            <th>Date</th>
                            <th>Moving Service</th>
                            <th>Booking Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="booking in bookings" :key="booking.id">
                           <td>{{ booking.user.name}}</td>
                           <td>0{{ booking.user.mobile}}</td>
                           <td>{{ booking.from_city.name}}</td>
                           <td>{{ booking.to_city.name}}</td>
                           <td>{{ booking.date}}</td>
                           <td>{{ booking.service.name}}</td>
                           <td>{{ booking.booking_number}}</td>
                           <td>{{ booking.status}}</td>
                           <td>                               
                                <button @click="viewBooking( booking )" type="button" class="btn btn-outline-primary btn-sm mr-1"><i class="fas fa-eye"></i></button>                         
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Start Confrim Booking Modal -->
            <div class = "modal fade" id = "view_booking" role = "dialog">
            <div class = "modal-dialog modal-lg">
               <div class = "modal-content">
                  <div class = "modal-header">
                    <h4 class = "modal-title">{{booking.service_name}} for {{booking.user_name}}</h4>      
                    <button @click="close()" type = "button" class="close">×</button>   
                  </div>
                    <div class = "modal-body">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="service_name">Service Name</label>
                            <p class="h4">{{booking.service_name}}</p>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="flight">Charges</label>
                            <p class="h4">Rs.{{booking.service_charges}}</p>
                          </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="service_name">Flights</label>
                                <p class="h4">{{booking.flight_name}}</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="flight">Charges</label>
                                <p class="h4">Rs.{{booking.flight_charges}}</p>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="service_name">Parking Situation</label>
                                <p class="h4">{{booking.parking_name}}</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="flight">Charges</label>
                                <p class="h4">Rs.{{booking.parking_charges}}</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="service_name">Approximate Distance</label>
                                <p class="h4">{{booking.distance}}</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="flight">Charges</label>
                                <p class="h4">Rs.{{distance_charges_per_km}} * {{booking.distance}}</p>
                            </div>
                        </div>
                        <div v-if="booking.image != null" class="form-row">
                            <div class="form-group col-md-6">
                                <p class="h4">Image</p> 
                            </div>
                            <div class="form-group col-md-6">
                               <img :src="booking.image" alt="not found" class="img-thumbnail">
                            </div>
                        </div>
                        <div v-if="calculated" class="form-row border-top border-danger">
                            <div class="form-group col-md-6">
                                <p class="h4">Total Estimated Cost</p>
                            </div>
                            <div class="form-group col-md-6">
                                
                                <p class="h4">Rs.{{estimate.total}}</p>
                            </div>
                        </div>
                    </div>

                    <div class = "modal-footer">
                        <button @click="close()" type ="button" class = "btn btn-danger">Close</button>
                        <button v-if="!calculated" @click="estimateCost()" type="button" class="btn btn-primary" >Calculate Estimate Cost</button>
                        <button v-if="calculated" @click="approveBooking()" type="button" class="btn btn-primary" >Approve Request</button>
                    </div>
               </div>
            </div>
            </div>
        <!-- End Confirm Booking Modal -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            bookings: [],
            booking: {'user_name': '', 'service_name': '', 'service_charges': 0, 'flight_name': '', 'flight_charges': 0, 'parking_name': '', 'parking_charges': 0, 'distance': 0,  'service_id': '', 'from_city_id': '', 'to_city_id': '', 'date': '', 'address': '', 'flight_id': '' , 'parking_id': '', 'image': '', 'id': ''},
            distance_charges_per_km: '25',
            estimate: {'total': 0},
            calculated: false,
        }
    },
    created() {
        this.getBookings();
    },   
    methods: {
        getBookings() {
            axios.get( '/all_bookings' ).then( response => {
                    if (response.status == 200) {
                        this.bookings = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });
        },
        viewBooking( booking ) {
            let edit = this.booking;
            edit.user_name = booking.user.name;
            edit.service_name = booking.service.name;
            edit.service_charges = booking.service.charges;
            edit.image = booking.image;
            edit.flight_name = booking.flight.name;
            edit.flight_charges = booking.flight.charges;
            edit.parking_name = booking.parking.name;
            edit.parking_charges = booking.parking.charges;
            edit.distance = booking.distance;
            edit.id = booking.id;
            $("#view_booking").modal('show');
        },
        estimateCost() {
            const sum = (this.booking.service_charges +  this.booking.flight_charges + this.booking.parking_charges) + (this.booking.distance * this.distance_charges_per_km);
            this.estimate.total = sum;
            this.calculated = true;
        },
        approveBooking() {
            console.log('test');
            axios.put('/bookings/' + this.booking.id, this.estimate).then( (response) => {
            if (response.status == 200) {
                console.log(response.data);
                $('#view_booking').modal('hide');
                    this.getBookings();
                    swal({
                    title: "Request Approved!",
                    text: response.data.message,
                    icon: "success",
                    buttons: false,
                    timer: 9000
                });
                this.calculated = false;
                this.estimate = {
                    total: '',
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
        close() {
            $('#view_booking').modal('hide');
            this.calculated = false;
            this.estimate = {
                total: '',
            } 
        }
    },
}
</script>