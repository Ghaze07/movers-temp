<template>
    <div class="container">
        <div class="w-100">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Sign Up</h3>
                    <form method="POST" action="/register">
                        <input type="hidden" name="_token" :value="csrf" />
                        <input type="hidden" name="wantsJson" value="true" />

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="name" placeholder="You full name." type="text" class="form-control" name="name" required autocomplete="name" autofocus v-model="name">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input id="email" type="email" placeholder="Your email address." class="form-control" name="email" value="" required autocomplete="email" v-model="email">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+92</span>
                            </div>
                            <input id="mobile" type="number" placeholder="3xxxxxxxxx" class="form-control" name="mobile" value="" required autocomplete="mobile" v-model="mobile">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" placeholder="Set a password of 6 characters." class="form-control" name="password" required autocomplete="new-password" v-model="password">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password-confirm" type="password" placeholder="Retype your password." class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="password_confirmation">
                        </div>

                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
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
                mobile: '',
                password: '',
                password_confirmation: '',
                csrf: document.head.querySelector('meta[name="csrf-token"]').content
            }
        },
        mounted() {
            console.log(this.name);
        },
    }
</script>
