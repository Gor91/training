<template>
    <pdf @loaded="onLoad" src="https://cdn.rawgit.com/mozilla/pdf.js/c6e8ca86/test/pdfs/freeculture.pdf" page="1"
         ref="mypdf"></pdf>
</template>

<script>
    import pdf from 'vue-pdf';
    import {getBookById} from '../partials/courses';

    export default {
        data() {
            return {
                path: '',
                title: '',
            }
        },
        components: {
            'pdf': pdf
        },
        computed: {
            currentUser: function () {
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            }
        },


        methods: {
            getBook: function () {
                let credentials = {
                    id: this.$route.params.id,
                    token: this.currentUser.token
                };
                getBookById(credentials)
                    .then(res => {
                        this.path = res.book.path;
                        this.title = res.book.title;

                    })
                    .catch(error => {
                        console.log('error');
                        // this.$store.commit("registerFailed", {error});
                    })

            },

        },
        beforeMount() {
            this.getBook();
        }
    }

</script>

