<template>
    <!--================ Start footer Area  =================-->
    <footer class="footer-area ">

        <div class="col-12 bg section_gap">
            <div class="container">
                <div class="row justify-content-around">
                    <!--<div class="col-lg-4 col-md-6 single-footer-widget">-->

                    <div class="col-lg-4 col-md-6 single-footer-widget text-center">
                        <h4 class=" ">{{text.fastlinks}}</h4>
                        <ul class="text-left">
                            <li><a href="http://www.moh.am/" target="_blank">{{text.moh}}</a></li>
                            <li><a href="https://ncdc.am" target="_blank">{{text.ncdc}}
                                </a></li>
                            <li><a href="http://nih.am/am" target="_blank"> {{text.nih}}</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 single-footer-widget text-center ">
                        <h4> {{text.acts}}</h4>
                        <ul class="text-center">
                            <li>
                                <a href=" http://www.moh.am/#1/900002" target="_blank">{{text.rules}}</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 single-footer-widget text-center">
                        <h4 class="col-lg-12 ">{{text.joinus}}</h4>
                        <div class="footer-social">
                            <a href="tel:+37443007107" class="small">
                                <span class="fa fa-phone"></span>
                                <span class="text">
					        	<span class="text pl-3">{{text.phone}}</span>
                                </span>
                            </a>

                        </div>
                        <div class="footer-social">
                            <a href="mailto:support@colorlib.com" class="small">
                                <span class="fa fa-envelope-open-o pl-3"></span>
                                <span class="text">
								<span class="text pl-2">{{text.email}}</span>
                                </span>
                            </a>
                        </div>
                        <div class="footer-social d-inline-flex">
                            <a href="https://www.facebook.com/pg/national.medical.palace.armenia/"
                               target="_blank"><i class="fa fa-facebook"></i></a>

                        </div>
                        <div class="footer-social d-inline-flex">
                            <a href="mailto:name@email.com"> <i class="fa fa-envelope"></i></a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="row footer-bottom  d-flex justify-content-center">
                <p class="col-lg-8 col-sm-12 footer-text m-0 text-white" v-html="text.copyright">{{text.copyright}}</p>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->
</template>

<script>
    import {getPromiseResult} from '../partials/help';
    import pagestext from './json/pages.json';
    export default {
        data() {
            return {
                coursestitles: [],
                nurse: '/css/template/img/nurse.svg',
                doctor: '/css/template/img/doctor.png',
                pharmacy: '/css/template/img/pharmacy-symbol.svg',
                phar: '/css/template/img/pharmacy.png',
                text:pagestext
            };
        },
        methods: {
            coursestitle: function () {
                let credentials = {
                    url: 'coursestitle',
                    auth: false
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.coursestitles = res.data;

                    })
                    .catch(error => {
                        console.log('errorsss');
                        // this.$store.commit("registerFailed", {error});
                    })
            }
        },
        beforeMount() {
            this.coursestitle()
        },

    }
</script>

