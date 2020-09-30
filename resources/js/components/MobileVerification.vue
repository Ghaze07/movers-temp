<template>
    <div class="container mt-auto">
        <div class="w-100">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center text-success">Verification Code</h2>
                    <p class="text-center">We have send you a verification code on your moibile number +92 {{ mobile }} </p>
                    <div class="text-center">
                        <input @keyup="onKeyUp" :disabled="disabled" class="animate__animated" :class="{'animate__shakeX border border-warning': wrongCode}" id="verification_code" autocomplete="off" type="number" v-model="form.otp" />
                    </div>
                    <div class="mt-2" v-show="allowResend">
                        <small>I didn't receive the notification code. <a class="btn btn-sm text-success" @click="resend_verification_code">{{ resendCodeLabel }}</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            mobile: {
                type: Number,
                default: '3xxxxxxxxx'
            },
            allowResend: false
        },
        data() {
            return {
                form: {
                    otp: '',
                    csrf: document.head.querySelector('meta[name="csrf-token"]').content
                },
                disabled: false,
                wrongCode: false,
                resendCodeLabel: 'Resend',
            }
        },
        computed: {
            otpLength: function () {
                return this.form.otp.length;
            }
        },
        methods: {
            onKeyUp(e) {
                if(this.otpLength == 4) {
                    this.disabled = true;
                    this.wrongCode = false;
                    axios.post('/register/verify', this.form)
                        .then( (response) => {
                            if ( response.data.status ) {
                                window.location.reload();
                            }else{
                                this.form.otp = '';
                                this.wrongCode = true;
                                this.disabled = false;
                            }
                        }).catch( (error) => {
                            this.form.otp = '';
                            this.wrongCode = true;
                            this.disabled = false;
                        });
                }
            },
            resend_verification_code() {
                this.resendCodeLabel = 'Sending...';
                return true;
            }
        },
    }
</script>

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    input#verification_code {
        margin: 0 5px;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        border: solid 1px #ccc;
        box-shadow: 0 0 5px #ccc inset;
        outline: none;
        width: 100%;
        transition: all .2s ease-in-out;
        border-radius: 3px;
        letter-spacing: 15px;
        text-indent: 15px;
    }

    input#verification_code:focus {
        border-color: #fd565a;
        box-shadow: 0 0 5px #fd565a inset;
    }

    input#verification_code:selection {
        background: transparent;
    }
</style>