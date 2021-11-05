<template>
    <div>
        <transition name="fade">
            <a href="#" v-show="visible">
                <i class="fas fa-arrow-alt-circle-up" ></i>
            </a>
        </transition>
    </div>

</template>

<script>
    export default {
        name: "BackToTop",
        data() {
            return {
                visible: false
            }
        },

        created () {
            window.addEventListener('scroll', this.showHide);
          },

        destroyed () {
            window.removeEventListener('scroll', this.showHide);
        },

        methods: {
            showHide() {
              window.pageYOffset > 200 ? this.visible = true : this.visible = false
            }

        }


    }
</script>

<style lang="scss" scoped>

        a {
            color: #26ba13;
            &:hover {
                color: darken(#26ba13, 10%);
            }
        }
        i {

            position: fixed;
            right: 2rem;
            bottom: 2rem;
            font-size: 3.5rem;
            cursor: pointer;
        }
        .fade-enter-active, .fade-leave-active {
            transition: opacity .3s;
        }
        .fade-enter, .fade-leave-to {
            opacity: 0;

        }
</style>
