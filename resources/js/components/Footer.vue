<template>
    <!--================ Start footer Area  =================-->
    <footer class="footer-area ">

        <div class="col-12 bg section_gap">
            <div class="container">
                <div class="row justify-content-around">
                    <!--<div class="col-lg-4 col-md-6 single-footer-widget">-->

                    <div class="col-lg-4 col-md-6 single-footer-widget text-center">
                        <h4 class=" ">Արագ հղումներ</h4>
                        <ul class="text-left">
                            <li><a href="http://www.moh.am/" target="_blank">ՀՀ առողջապահության նախարարություն</a></li>
                            <li><a href="https://ncdc.am/coronavirus/" target="_blank">Կորոնավիրուսային հիվանդություն
                                (COVID-19)</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 single-footer-widget text-center ">
                        <h4>Իրավական ակտեր</h4>
                        <ul class="text-center">
                            <li>
                                <a href=" http://www.moh.am/#1/900002" target="_blank">Օրենքներ և Հրամաններ</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 single-footer-widget text-center">
                        <h4 class="col-lg-12 ">Միացեք մեզ</h4>
                        <div class="footer-social">
                            <a href="tel:+37443007107" class="small">
                                <span class="fa fa-phone"></span>
                                <span class="text">
					        	<span class="text pl-3">(+374) 43-007-107</span>
                                </span>
                            </a>

                        </div>
                        <div class="footer-social">
                            <a href="mailto:support@colorlib.com" class="small">
                                <span class="fa fa-envelope-open-o pl-3"></span>
                                <span class="text">
								<span class="text pl-2">ccpdmw@mail.ru</span>
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
                <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">Copyright © 2020 All rights reserved |
                    Նախագծված և իրականացված է <i class="fa fa-heart-o" aria-hidden="true"></i> <a href="#">GTECH LLC</a>
                    կողմից</p>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->
</template>

<script>
    import {getCoursesTitle} from '../partials/courses';

    export default {
        data() {
            return {
                coursestitles: [],
                nurse: '/css/template/img/nurse.svg',
                doctor: '/css/template/img/doctor.png',
                pharmacy: '/css/template/img/pharmacy-symbol.svg',
                phar: '/css/template/img/pharmacy.png'
            };
        },
        methods: {
            coursestitle: function () {
                getCoursesTitle()
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

