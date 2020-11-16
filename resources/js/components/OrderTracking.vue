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
                                        <input type="text" v-model="order_number" class="form-control-lg text-center text-lg-left" placeholder="Order Number" />
                                    </div>
                                    <div class="col-md-3 mt-3 mb-3 mt-md-0 mb-md-0">
                                        <button class="btn btn-info btn-block btn-lg" @click="trackOrder">TRACK ORDER</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            order_number: ''
        }
    },

    methods: {
        trackOrder() {
            console.log(this.order_number);

            axios.post('trackOrder',{
                order_number: this.order_number
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.error(error);
                });
        }
    },
}
</script>