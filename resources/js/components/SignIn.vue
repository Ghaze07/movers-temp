<template>
    <div class="container">
        <div class="w-100">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Sign In</h3>
                    <p v-show="hasError" class="alert alert-danger">{{ errorMessage }}</p>
                    <form method="POST" action="/login" @submit.prevent="login">
                        <input type="hidden" name="_token" :value="form.csrf" />

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
                errorMessage: '',
            }
        },
        mounted() {

        },
        methods: {
            login() {
                this.signInLabel = "Signing you in...";
                this.disableSignIn = true;

                axios.post('/login', this.form)
                    .then( (response) => {
                        if ( response.status == 204 ) {
                            window.location.reload();
                        }
                    }).catch( (error) => {
                        this.hasError = true;
                        if( error.response.data.message )
                            this.errorMessage = error.response.data.message;
                        else
                            error.response.data.message = "Something went wrong whilie processing your request.";

                        this.disableSignIn = false;
                        this.signInLabel = "Sign In Again";
                        console.log();
                    });
                //console.log("form submitted");
            }
        }
    }
</script>
