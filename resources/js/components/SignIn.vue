<template>
    <div class="container">
        <div class="w-100">
            <div class="card">
                <div class="card-body" id="card_body">
                    <h3 class="mb-3" style="color: black;">Sign In</h3>
                    <div v-show="hasError">
                        <p class="text-danger"><small>{{ errorMessage }}</small></p>
                        <p v-for="(error) in errors.email" class="text-danger">
                            <small>{{ error }}</small>
                        </p>
                    </div>

                    <div v-show="emailErrors"></div>

                    <form @submit.prevent="signIn">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                            </div>
                            <input id="email" type="text" class="form-control" name="email" placeholder="3xxxxxxxxx OR name@example.com." v-model="form.email" required autocomplete="email" autofocus>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Your password." v-model="form.password" required autocomplete="current-password">
                        </div>

                        <div class="input-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" v-model="form.remember"/>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-primary" :disabled="disableSignIn">{{ signInLabel }}</button>
                            <a class="btn btn-link" href="/password/reset">Forgot Your Password?</a>
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
                form: {
                    email: '',
                    password: '',
                    remember: false,
                    csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                },
                disableSignIn: false,
                signInLabel: "Sign In",
                hasError: false,
                errors: {},
                errorMessage: '',
            }
        },
        computed: {
            emailErrors: function() {
                return ( this.hasError && this.errors.email && this.errors.email.length );
            }
        },
        mounted() {

        },
        methods: {
            signIn() {
                this.signInLabel = "Signing you in...";
                this.disableSignIn = true;

                axios.post('/login', this.form)
                    .then( (response) => {
                        if ( response.status == 204 ) {
                            window.location.reload();
                        }
                    }).catch( (error) => {
                        if( error.response.data.message )
                            this.errorMessage = error.response.data.message;
                        else
                            this.errorMessage = "Something went wrong while processing your request.";

                        this.hasError = true;
                        this.disableSignIn = false;
                        this.signInLabel = "Sign In Again";
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>
<style scoped>
    #card_body{
        background-color: #fbdb44;
        }
</style>
