<template>
<div>
    <section id="tracking">
        <a name="tracking"></a>
        <div class="container-fluid wrapper">
            <div class="container">
                <div class="row align-items-center content">
                    <div class="col-md-2 bg_tracking" data-aos="flip-left" data-aos-duration="600" data-aos-easing="ease-in-sine">
                        &nbsp;
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" v-model="booking_number" class="form-control-lg text-center text-lg-left" placeholder="Enter Booking Number" />
                            </div>
                            <div class="col-md-3 mt-3 mb-3 mt-md-0 mb-md-0">
                                <button @click="trackBooking()" class="btn btn-warning btn-block btn-lg">TRACK YOUR MOVE</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- start Tracking modal -->
    <div class="modal fade" id="trackingModal" tabindex="-1" role="dialog" aria-labelledby="trackingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-warning text-black">
                <h5 class="modal-title" id="trackingModalLabel">Move Tracking ( Booking # {{booking_number}} )</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: wheat;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-wrapper">        
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>    
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{booking.status}}</td>
                                <td>{{booking.updated_at | localTime}}</td>
                            </tr>    
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm " data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End tracking modal -->
    <!-- Start Login Prompt Modal -->
        <div class="modal fade" id="logIn_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body bg-danger text-white">
                You Need To SignIn/SignUp First!
                </div>
            </div>
            </div>
        </div>
    <!-- End LogIn Prompt Modal -->
</div>
</template>
<script>
export default {
    props: {
        authenticated: Number,
    },
    data() {
        return {
            booking_number: '',
            booking: {'status': '', 'updated_at': ''},
        }
    },
    filters: {
        localTime: function (date) {
            return moment(date).format('llll');
        }
    },
    methods: {
        trackBooking() {
            console.log(this.order_number);
            if (this.authenticated) {
                axios.post('trackBooking',{
                    booking_number: this.booking_number
                }).then((response) => {
                    if (response.status == 200) {
                        console.log(response.data);
                        this.booking.status = response.data.status;
                        this.booking.updated_at = response.data.updated_at;
                        $('#trackingModal').modal('show');
                    } else {
                        console.log(response.data);
                    }
                }).catch((error) => {
                    console.error(error.response.data);
                    swal({
                        title: "Sorry! We couldn't find order with this number",
                        icon: "error",
                        buttons: false,
                        timer: 3000
                    });
                });
            } else {
                console.log('test');
                $("#logIn_modal").modal("show");
            } 
        }
    }, 
}
</script>