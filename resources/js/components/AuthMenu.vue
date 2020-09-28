<template>
    <div class="expand navbar-expand" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/blogs" style="color: #E6001F;">
                    <i class="fas fa-bullhorn"></i><span class="pl-2">Blog</span>
                </a>
            </li>
            <li class="nav-item"><span class="nav-link">|</span></li>
            <li class="nav-item" v-if="guest">
                <router-link class="nav-link" to="login"><span @click="showModal = true">Sign In</span></router-link>
            </li>

            <li class="nav-item" v-if="guest"><span class="nav-link">|</span></li>

            <li class="nav-item" v-if="guest">
                <router-link class="nav-link" to="register"><span @click="showModal = true">Sign Up</span></router-link>
            </li>

            <li class="nav-item dropdown" v-if="!guest">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ visitor }}</a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            <modal v-show="showModal" @stopEditing="stopEditing"></modal>
        </transition>
    </div>
</template>

<script>
    import VueRouter from 'vue-router';
    import SignIn from './SignIn';
    import SignUp from './SignUp';

    const routes = [
        {
            path: '/login',
            name: 'signin',
            component: SignIn
        },
        {
            path: '/register',
            name: 'signup',
            component: SignUp
        }
    ];

    export default {
        props: {
            visitor: {
                type: String
            }
        },
        router: new VueRouter({
            routes: routes,
        }),
        data() {
            return {
                showModal: false,
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                guest: true
            }
        },
        created() {
            this.guest = ( typeof(this.visitor) == "undefined" ) || (this.visitor == "guest");
            console.log(this.visitor);
        },
        methods: {
            stopEditing() {
                this.showModal = false;
            }
        }
    }
</script>