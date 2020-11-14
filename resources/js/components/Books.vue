<template>
    <div id="flipbook">
        <flipbook class="flipbook" :pages="images" v-slot="flipbook">
            <div class="action-bar">
        <span class="page-num or text-uppercase">
           {{ flipbook.page }}-ը  {{ flipbook.numPages }} {{text.page}}
        </span>
                <button @click="flipbook.flipLeft" class="flip_button_left btn left disabled">
                    <i class="fa fa-angle-left fa-8x"></i>
                </button>
                <button @click="flipbook.flipRight" class="flip_button_right btn right disabled">
                    <i class="fa fa-angle-right fa-8x"></i>
                </button>
            </div>
        </flipbook>
    </div>
</template>

<script>
    import Flipbook from 'flipbook-vue';
    import text from './json/pages.json';
    // import Flipbook from 'flipbook-vue/src/Flipbook.vue'

    export default {
        data() {
            return {
                path: '/uploads/books/funcitons/',
                images: [
                    null,
                    '/uploads/books/funcitons/funcitons-01.jpg',
                    '/uploads/books/funcitons/funcitons-02.jpg',
                    '/uploads/books/funcitons/funcitons-03.jpg',
                    '/uploads/books/funcitons/funcitons-04.jpg',
                    '/uploads/books/funcitons/funcitons-05.jpg',
                    '/uploads/books/funcitons/funcitons-06.jpg',
                ],
                text: text
            };
        },

        components: {
            'flipbook': Flipbook

        },
        methods: {}
    }
</script>
<style>
    #flipbook {
        border-bottom: 2px dotted #eee;
    }

    .flipbook {
        width: 90vw;
        height: 90vh;

    }

    .action-bar {
        width: 100%;
        height: 30px;
        padding: 10px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 5vw;
        margin-top: 2vh;
    }

    .flip_button_right, .flip_button_left {
        position: absolute;
        cursor: pointer;
        z-index: 10;
        opacity: 0.2;
        right: 0;
        top: 64vh;
        display: block;
    }

    .flip_button_left {
        left: 0;
    }

    .flip_button_right i, .flip_button_left i {
        transform: scale(2, 3);
        -webkit-transform: scale(2, 3);
    }
</style>
