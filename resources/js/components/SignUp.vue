<template>
    <div class="container">
        <div class="w-100">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Sign Up</h3>
                    <div v-show="hasError">
                        <p class="text-danger"><small>{{ errorMessage }}</small></p>
                    </div>
                    <form @submit.prevent="signUp">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="name" placeholder="You full name." type="text" class="form-control" name="name" required autocomplete="name" autofocus v-model="form.name">
                        </div>
                        <div v-show="nameErrors">
                            <p v-for="(error) in errors.name" class="text-danger">
                                <small>{{ error }}</small>
                            </p>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input id="email" type="email" placeholder="Your email address." class="form-control" name="email" value="" required autocomplete="email" v-model="form.email">
                        </div>
                        <div v-show="emailErrors">
                            <p v-for="(error) in errors.email" class="text-danger">
                                <small>{{ error }}</small>
                            </p>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+92</span>
                            </div>
                            <input id="mobile" type="number" placeholder="3xxxxxxxxx" class="form-control" name="mobile" value="" required autocomplete="mobile" v-model="form.mobile">
                        </div>
                        <div v-show="mobileErrors">
                            <p v-for="(error) in errors.mobile" class="text-danger">
                                <small>{{ error }}</small>
                            </p>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" placeholder="Set a password of 6 characters." class="form-control" name="password" required autocomplete="new-password" v-model="form.password">
                        </div>
                        <div v-show="passwordErrors">
                            <p v-for="(error) in errors.password" class="text-danger">
                                <small>{{ error }}</small>
                            </p>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password-confirm" type="password" placeholder="Retype your password." class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="form.password_confirmation">
                        </div>
                        <div v-show="passwordConfirmationErrors">
                            <p v-for="(error) in errors.password_confirmation" class="text-danger">
                                <small>{{ error }}</small>
                            </p>
                        </div>

                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-primary" :disabled="disableSignUp">{{ signUpLabel }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                default: ''
            },
            email: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                form: {
                    mobile: '',
                    password: '',
                    password_confirmation: '',
                    csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                },
                disableSignUp: false,
                signUpLabel: "Sign Up",
                hasError: false,
                errors: {},
                errorMessage: '',
            }
        },
        created() {
            this.form.name = this.name;
            this.form.email = this.email;
        },
        computed: {
            nameErrors: function() {
                return ( this.hasError && this.errors.name && this.errors.name.length );
            },
            emailErrors: function() {
                return ( this.hasError && this.errors.email && this.errors.email.length );
            },
            mobileErrors: function() {
                return ( this.hasError && this.errors.mobile && this.errors.mobile.length );
            },
            passwordErrors: function() {
                return ( this.hasError && this.errors.password && this.errors.password.length );
            },
            passwordConfirmationErrors: function() {
                return ( this.hasError && this.errors.password_confirmation && this.errors.password_confirmation.length );
            }
        },
        methods: {
            signUp() {
                this.signUpLabel = "Creating your account...";
                this.disableSignUp = true;

                axios.post('/register', this.form)
                    .then( (response) => {
                        if ( response.status == 201 ) {
                            this.$router.push({name: 'mobile_verification', params: {mobile: this.form.mobile}});
                        }
                    }).catch( (error) => {
                        if( error.response.data.message )
                            this.errorMessage = error.response.data.message;
                        else
                            this.errorMessage = "Something went wrong while processing your request.";

                        this.hasError = true;
                        this.disableSignUp = false;
                        this.signUpLabel = "Sign Up Again";
                        this.errors = error.response.data.errors;
                });
            },
        },
    }
</script>
