<template>

    <!--================ Start Department Area =================-->

    <div class="department_area section_gap">

        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    <div class="dpmt_courses">

                        <!-- single course -->
                        <div class="col-12 text-center ">
                            <div class="single_department">
                                <div class="dpmt_icon">
                                    <img :src="nurse" alt="">
                                </div>
                                <h4>{{text.nurse}}</h4>
                            </div>
                        </div>
                        <!-- single course -->
                        <div class=" col-12 text-center">
                            <div class="single_department">
                                <div class="dpmt_icon">
                                    <img :src="doctor" alt="">
                                </div>
                                <h4>{{text.doctor}}</h4>

                            </div>
                        </div>
                        <!-- single course -->
                        <div class=" col-12 text-center ">
                            <div class="single_department">
                                <div class="dpmt_icon">
                                    <img :src="pharmacy" alt="">
                                </div>
                                <h4>{{text.pharmacy}}</h4>
                            </div>
                        </div>
                        <!-- single course -->
                        <div class=" col-12 text-center">
                            <div class="single_department">
                                <div class="dpmt_icon">
                                    <img :src="phar" alt="">
                                </div>
                                <h4>{{text.phar}}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="dpmt_right" v-html="data.homedescription" v-for="data in datas" :key="data.id">
                        <p>{{ data.homedescription }}</p>
                        <router-link :to="{ name: 'lesson' }" class="primary-btn text-uppercase search_course_btn">
                            {{text.lessons}}
                        </router-link>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--================ End Department Area =================-->
</template>

<script>
    import {getPromiseResult} from '../partials/help';
    import pagestext from './json/pages.json'

    export default {
        data() {
            return {
                datas: [],
                nurse: '/css/frontend/img/nurse.svg',
                doctor: '/css/frontend/img/doctor.png',
                pharmacy: '/css/frontend/img/pharmacy-symbol.svg',
                phar: '/css/frontend/img/pharmacy.png',
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
                        //this.docs = res.document;
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

