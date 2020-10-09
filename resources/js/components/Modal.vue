<template>
    <div id="editing_pane" class="p-4 pt-5">
        <div class="row">
            <!-- Close Button -->
            <div id="close_button" @click="$emit('stopEditing')"><i class="far fa-times-circle"></i></div>
        </div>
        <transition enter-active-class="animate__animated animate__slideInRight"
                    leave-active-class="animate__animated animate__slideOutLeft quickSlideOutLeft">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        methods: {
            stopEditing() {

            }
        }
    }
</script>

<style>
    .quickSlideOutLeft {
        animation-duration: 0s;
    }
    #editing_pane {
        background: #6c9ea9;
        color: black;
        top: 0px;
        right: 0px;
        position: fixed;
        width: 30%;
        height: 100vh;
        max-height: 100vh;
        overflow: scroll;
        z-index: 100;
    }

    #close_button {
        position: absolute;
        top: 5px;
        right: 15px;
        font-size: 30px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        #editing_pane {
            width: 70%;
        }
    }

    @media (max-width: 500px) {
        #editing_pane {
            width: 100%;
        }
    }


</style>