<template>
    <!--================ Start footer Area  =================-->
    <footer class="footer-area section_gap">

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 single-footer-widget">
                    <h4>Լավագույն դասընթացներ</h4>
                    <ul  v-for="ct in coursestitles" :key="ct.id">
                        <li><a href="#">{{ ct.name }}</a></li>

                    </ul>
                </div>
                <div class="col-lg-5 col-md-6 single-footer-widget">
                    <h4>Արագ հղումներ</h4>
                    <ul>
                        <li><a href="http://www.moh.am/" target="_blank">ՀՀ առողջապահության նախարարություն</a></li>
                        <li><a href="https://ncdc.am/coronavirus/" target="_blank">Կորոնավիրուսային հիվանդություն (COVID-19)</a></li>

                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 single-footer-widget">
                    <h4>Իրավական ակտեր</h4>
                    <ul>
                        <li>
                            <a href=" http://www.moh.am/#1/900002" target="_blank">Օրենքներ և Հրամաններ</a></li>
                    </ul>
                </div>
            </div>
            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">Copyright © 2020 All rights reserved | Նախագծված և իրականացված է <i class="fa fa-heart-o" aria-hidden="true"></i>  <a href="#">GTECH LLC</a> կողմից</p>
                <div class="col-lg-4 col-sm-12 footer-social">
                    <a href="https://www.facebook.com/pg/national.medical.palace.armenia/" target="_blank"><i class="fa fa-facebook"></i></a>

                </div>
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
                doctor:'/css/template/img/doctor.png',
                pharmacy:'/css/template/img/pharmacy-symbol.svg',
                phar:'/css/template/img/pharmacy.png'
            };
        },
        methods:{
            coursestitle: function() {
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
        beforeMount(){
            this.coursestitle()
        },

    }
</script>

