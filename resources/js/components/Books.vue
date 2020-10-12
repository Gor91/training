<!--<template>-->

<!--    <div class="container" ref="container"></div>-->

<!--</template>-->

<!--<script>-->
<!--    // window.PDFJS_LOCALE = {-->
<!--    //     pdfJsWorker: 'flip-book/js/pdf.worker.js'-->
<!--    // };-->
<!--    // require('flip-book');-->
<!--    // import Html2Canvas from 'flip-book/js/html2canvas.min';-->
<!--    // import PDF from 'flip-book/js/pdf.min';-->
<!--    // import  Three from 'flip-book/js/three.min';-->
<!--    // import * as FlipBook from 'flip-book/dist/flip-book';-->
<!--    // import {getBookById} from '../partials/courses';-->


<!--    export default {-->
<!--        data() {-->
<!--            return {-->
<!--                path: '',-->
<!--                title: ''-->
<!--            }-->
<!--        },-->
<!--        components: {-->
<!--            // Html2Canvas, Three, PDF-->
<!--            // FlipBook-->
<!--        },-->
<!--        computed: {-->
<!--            currentUser: function () {-->
<!--                if (!this.$store.getters.currentUser)-->
<!--                    return JSON.parse(localStorage.getItem('user'));-->
<!--                return this.$store.getters.currentUser-->
<!--            }-->
<!--        },-->
<!--        methods: {-->
<!--            getBook: function () {-->
<!--                let credentials = {-->
<!--                    id: this.$route.params.id,-->
<!--                    token: this.currentUser.token-->
<!--                };-->
<!--                getBookById(credentials)-->
<!--                    .then(res => {-->
<!--                        this.path = res.book.path;-->
<!--                        this.title = res.book.title;-->

<!--                    })-->
<!--                    .catch(error => {-->
<!--                        console.log('error');-->
<!--                        // this.$store.commit("registerFailed", {error});-->
<!--                    })-->
<!--            },-->
<!--        },-->
<!--        beforeMount() {-->
<!--            this.getBook();-->

<!--        },-->
<!--        mounted() {-->
<!--            // this.$refs.container.FlipBook({-->
<!--            //     pdf: 'books/pdf/FoxitPdfSdk.pdf',-->
<!--            //     template: {-->
<!--            //         html: 'node_modules/flip-book/templates/default-book-view.html',-->
<!--            //         links: [-->
<!--            //             {-->
<!--            //                 rel: 'stylesheet',-->
<!--            //                 href: 'node_modules/flip-book/css/font-awesome.min.css'-->
<!--            //             }-->
<!--            //         ],-->
<!--            //         styles: [-->
<!--            //             'node_modules/flip-book/css/short-black-book-view.css'-->
<!--            //         ],-->
<!--            //         links: [{-->
<!--            //             rel: 'stylesheet',-->
<!--            //             href: 'node_modules/flip-book/css/font-awesome.min.css'-->
<!--            //         }],-->
<!--            //         script: 'node_modules/flip-book/js/default-book-view.js'-->
<!--            //     }-->
<!--            // });-->
<!--        }-->
<!--    }-->
<!--</script>-->
<!--<style type="text/css">-->

<!--    .book-container {-->
<!--        height: 95vh;-->
<!--        width: 95%;-->
<!--        margin: 20px auto;-->
<!--        border: 2px solid red;-->
<!--        box-shadow: 0 0 5px red;-->
<!--    }-->

<!--    .fullscreen {-->
<!--        background-color: #333;-->
<!--    }-->
<!--</style>-->
