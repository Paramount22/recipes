<template>
    <transition name="fade">
        <div class="flash-success alert alert-success" role="alert" v-show="visible">
            <strong>OK!</strong> {{text}}
            <button type="button" class="close" aria-label="Close" @click="hide">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "FlashSuccess",

        props: ['text'],

        data() {
            return {
                visible: false
            }
        },

        created() {
            if( this.text ) {
                this.show()
            }

        },

        methods: {
            show() {
                this.visible = true;
                setTimeout(()=> this.hide(), 4000)
            },
            hide() {
                this.visible = false;
            }
        }
    }
</script>

<style scoped>
    .flash-success {
        position: fixed;
        right: 2rem;
        bottom: 2rem;
        z-index: 1;
    }
    .close {
        position: relative;
        left: 12px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .35s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
