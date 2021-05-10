<template>
    <div class="container-fluid wrapper pt-1" style="background: #20374f !important">
        <div class="container">
            <div class="row content">
                <div class="col-sm-6 col-lg-4">
                    
                </div>
                <div class="col-sm-6 col-lg-8">
                    <form>
                        <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label" style="color: wheat">Name</label>
                          <div class="col-sm-10">
                            <input v-model="contact.name" type="text" class="form-control" placeholder="Enter Your Name">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label" style="color: wheat">Email</label>
                            <div class="col-sm-10">
                              <input v-model="contact.email" type="email" class="form-control" placeholder="Enter Your Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message" class="col-sm-2 col-form-label" style="color: wheat">Message</label>
                            <div class="col-sm-10">
                                <textarea v-model="contact.message" class="form-control" rows="3" cols="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-10">
                            <button type="button" @click="submit()" class="btn btn-primary">Send Message</button>
                          </div>
                        </div>
                      </form>                  
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
		data() {
			return {
                contact: {'name': '', 'email': '', 'message': ''}
			}
		},
		
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            submit() {
                let input = this.contact;
                axios.post('contact', input).then( (response) => {
                    if (response.status == 200) {
                    console.log(response.data);
                    swal({
                        title: "Message Recieved!",
                        text: response.data.message,
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    });
                    this.contact = {
                        name: '',
                        email: '',
                        phone: '',
                        message: '',
                        captcha_response: ''
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

        },
    }
</script>