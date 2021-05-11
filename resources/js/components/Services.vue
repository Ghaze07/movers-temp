<template>
    <div class="container-fluid wrapper">
        <div class="container pt-3 pb-3">
            <div class="row">
                <h2>Our Services</h2>
            </div>
            <div class="row align-items-start content">          
                <div v-for="service in services" :key="service.id" class="col-md-4 mb-1">
                    <div class="card" style="width: 18rem;">
                        <h5 class="card-header border border-success" style="background: #fbe36b !important; color: black !important;">
                           {{service.name}}
                        </h5>
                        <img class="card-img-top" :src="service.image" alt="Card image cap" style="width: fit-content; margin-left: 5rem;">
                        <div class="card-body" style="background: #0f1941 !important;">
                          <ul class="list-group mb-2">
                            <li class="list-group-item">{{ service.first_trait}}</li>
                            <li class="list-group-item">{{ service.second_trait}}</li>
                            <li class="list-group-item">{{ service.third_trait}}</li>
                          </ul>
                          <button type="button" class="btn btn-lg" @click="bookingModal(service)" style="background: #F9C909;">Book</button>
                        </div>
                    </div>
                </div>         
                <!-- Modal -->
                <div class = "modal fade" id = "booking_modal" role = "dialog">
                  <div class = "modal-dialog modal-lg">
                    <div class = "modal-content">
                      <div class = "modal-header bg-warning">
                        <h4 class = "modal-title">{{booking.service_name}}</h4>      
                        <button type = "button" class="close" data-dismiss = "modal">×</button>   
                      </div>
                      <div class = "modal-body bg-light">
                        <div v-if="!booking_form" class="row">
                          <div class="card-body bg-warning">
                          <h5 class="card-title">Small Haul Move Request Form</h5>
                          <p class="card-text">
                              This request form will allow us to assess the details of your move 
                              and to give you an estimate that is based on volume, time, and complexity.
                          </p>
                          <p class="card-text">
                              We tier our pricing based on a combination of these factors. Not all moves are the same.
                          </p>
                          <p class="card-text">
                              Please be as accurate as possible with the information provided, 
                              and supply photos of any large items, stairs, or anything of note.
                          </p>
                          <h5 class="card-title">Thank You!</h5>
                          <button type="button" @click="bookingForm()" class="btn btn-success">Proceed</button>
                          </div>
                        </div>
                        <form v-if="booking_form">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Select From City</label>
                            <select class="custom-select" id="city" v-model="booking.from_city_id">
                                <option value="0">Select City</option>
                                <option  v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                            </select>
                            <small v-if="errors.name" class="form-text text-danger">{{ errors.name[0] }}</small>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="to_city_id">Select To City</label>
                            <select class="custom-select" id="city" v-model="booking.to_city_id">
                                <option value="0">Select City</option>
                                <option  v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                            </select>
                            <small v-if="errors.image" class="form-text text-danger">{{ errors.image[0] }}</small>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="date">Select Date</label>
                            <input type="date" class="form-control" v-model="booking.date">
                            <small v-if="errors.first_trait" class="form-text text-danger">{{ errors.first_trait[0] }}</small>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="address">What is Pick up Address?</label>
                            <input type="text" class="form-control" placeholder="Enter complete address" v-model="booking.address">
                            <small v-if="errors.second_trait" class="form-text text-danger">{{ errors.second_trait[0] }}</small>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">How many flights of stairs are the items at going up/down?</label>
                            <select class="custom-select" id="city" v-model="booking.flight_id">
                                <option value="0">Select Flight</option>
                                <option  v-for="(flight, index) in flights" :key="index" :value="flight.id">{{ flight.name }}</option>
                            </select>
                            <small v-if="errors.third_trait" class="form-text text-danger">{{ errors.third_trait[0] }}</small>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="parking_id">What is the parking situation?</label>
                            <select class="custom-select" id="city" v-model="booking.parking_id">
                                <option value="0">Select Parking</option>
                                <option  v-for="(parking, index) in parkings" :key="index" :value="parking.id">{{ parking.name }}</option>
                            </select>
                            <small v-if="errors.status" class="form-text text-danger">{{ errors.status[0] }}</small>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                             <label for="image">Upload Image If any</label>
                            <input type="file" @change="imageSelected" accept="image/*" class="form-control">
                            <small v-if="errors.charges" class="form-text text-danger">{{ errors.charges[0] }}</small>
                          </div>
                        </div>
                        </form>
                      </div>
                      <div v-if="booking_form" class = "modal-footer">
                          <button type ="button" class = "btn btn-danger" data-dismiss = "modal">Close</button>
                          <button type="button" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
          flights_prop: Array,
          parkings_prop: Array,
    },
    data() {
        return {
            services: [],
            cities: [],
            flights: [],
            parkings: [],
            booking_form: false,
            booking: {'service_name': '', 'from_city_id': 0, 'to_city_id': 0, 'date': '', 'address': '', 'flight_id': 0 , 'parking_id': 0, 'image': ''},
            errors:{},
        }
    },
    created() {
        this.getServices();
        this.getCities();
        this.setFlights();
        this.setParkings();
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
        setFlights() {
          this.flights = this.flights_prop;
        },
        setParkings() {
          this.parkings = this.parkings_prop;
        },
        bookingModal(service) {
          this.booking.service_name = service.name;
          $("#booking_modal").modal('show');
        },
        bookingForm() {
          this.booking_form = true;
        },
        imageSelected(e){
            this.booking.image = e.target.files[0];
        },
    }    
}
</script>