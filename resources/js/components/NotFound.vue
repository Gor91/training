<template>
    <div class="container-fluid">

        <!--================ Start 404 Area =================-->
        <div class="section_gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 text-center">
                        <img class="img-fluid" :src="img" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!--================ End 404 Area =================-->

    </div>
</template>

<script>
    import {getPromiseResult} from '../partials/help';
    import pagestext from './json/pages.json';

    export default {
        data() {
            return {
                datas: [],
                img: '/images/404.jpg',
                docs: [],
                text: pagestext,
            };
        },
        methods: {
            aboutpage: function () {
                let credentials = {
                    url: "about",
                    auth: false
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.datas = res.data;
                        this.docs = res.document;
                    })
                    .catch(error => {
                        console.log('error');
                        // this.$store.commit("registerFailed", {error});
                    })
            }
        },
        beforeMount() {
            this.aboutpage()
        },
    }
</script>
<style>
    .home_banner_area {
        min-height: 234px;
    }
</style>

