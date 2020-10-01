<template>
    <section id="signup">
        <a name="signup"></a>
        <div class="container-fluid wrapper">
            <div class="container">
                <form action="#" method="post">
                    <div class="row align-items-center content">
                        <div class="col-md-3 bg_arrow" data-aos="fade-up-right" data-aos-duration="600" data-aos-easing="ease-in-sine">
                            &nbsp;
                        </div>
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control-lg" placeholder="Full Name" v-model="url.params.name" />
                                </div>
                                <div class="col-md-4 mt-3 mb-3 mt-md-0 mb-md-0">
                                    <input type="email"  class="form-control-lg" placeholder="Email Address" v-model="url.params.email" />
                                </div>
                                <div class="col-md-4">
                                    <router-link class="btn btn-warning btn-block btn-lg" :to="url" @click.native="showDialog">Sign Up</router-link>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="mb-3 mb-md-0"><small class="text-warning font-italic">*Sign up now and get flat 10% discount on your first order.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                url: {
                    name: 'signup',
                    params: {
                        name: '',
                        email: ''
                    }
                }
            }
        },
        created() {
        },
        methods: {
            showDialog() {
                this.$root.$emit('showModal');
            }
        }
    }
</script>