<template>
    <!--================ Start footer Area  =================-->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 single-footer-widget">
                    <h4>Լավագույն դասընթացներ</h4>
                    <ul  v-for="ct in coursestitles" :key="ct.id">
                        <li><a href="#">{{ ct.title }}</a></li>

                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 single-footer-widget">
                    <h4>Արագ հղումներ</h4>
                    <ul>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Brand Assets</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-6 single-footer-widget">
                    <h4>Առողջապահական ոլորտի հրամաններ</h4>
                    <p>You can trust us. we only send promo offers,</p>

                </div>
            </div>
            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">Copyright © 2020 All rights reserved | Նախագծված և իրականացված է <i class="fa fa-heart-o" aria-hidden="true"></i>  <a href="#">GTECH LLC</a> կողմից</p>
                <div class="col-lg-4 col-sm-12 footer-social">
                    <a href="https://www.facebook.com/pg/national.medical.palace.armenia/" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
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
                getCoursesTitle("hhh")
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

