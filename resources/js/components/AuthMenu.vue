<template>
    <div class="expand navbar-expand" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="/blog">
                    <i class="fas fa-bullhorn"></i><span class="pl-2">Blog</span>
                </a>
            </li>
            <li class="nav-item"><span class="nav-link">|</span></li>
            <li class="nav-item" v-if="guest">
                <router-link class="nav-link" to="signin"><span @click="showModal">Sign In</span></router-link>
            </li>

            <li class="nav-item" v-if="guest"><span class="nav-link">|</span></li>

            <li class="nav-item" v-if="guest">
                <router-link class="nav-link" to="signup"><span @click="showModal">Sign Up</span></router-link>
            </li>

            <li class="nav-item dropdown" v-if="!guest">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ visitor.name }}</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <router-link v-show="!visitor.is_verified" class="dropdown-item" :to="{name: 'mobile_verification', params: {mobile: visitor.mobile}}"><span @click="showModal">Verify Mobile Number</span></router-link>
                    <a class="dropdown-item" href="/dashboard" v-show="isAdmin">Dashboard</a>
                    <a class="dropdown-item" href="/myorders">My Orders</a>
                    <a class="dropdown-item" href="/settings">Settings</a>
                    <a class="dropdown-item" href="/logout"
                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="/logout" method="POST" class="d-none">
                        <input type="hidden" name="_token" :value="csrf" />
                    </form>
                </div>
            </li>
        </ul>
        <transition
                enter-active-class="animate__animated animate__slideInRight"
                leave-active-class="animate__animated animate__slideOutRight"
        >
            <modal v-show="displayModal" @stopEditing="hideModal"></modal>
        </transition>
    </div>
</template>

<script>
    export default {
        props: {
            visitor: {
                type: Object
            }
        },
        data() {
            return {
                displayModal: false,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                guest: true,
                isAdmin: false
            }
        },
        created() {
            this.guest = ( this.visitor.role == "guest" );
            this.isAdmin = ( this.visitor.role == 'admin');
            // This is required to initiate with an empty modal so that the router links with parameters can pass the props.
            if( this.$router.currentRoute.path != '/')
                this.$router.push('/');
        },
        mounted() {
            this.$root.$on('showModal', () => {
                this.showModal();
            });
            this.$root.$on('hideModal', () => {
                this.hideModal();
            });
        },
        methods: {
            hideModal() {
                this.displayModal = false;
            },
            showModal() {
                this.displayModal = true;
            }
        }
    }
</script>