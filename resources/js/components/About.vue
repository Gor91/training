<template>
     <div class="container-fluid">
         <section class="banner_area">
             <div class="banner_inner d-flex align-items-center">
                 <div class="overlay"></div>
                 <div class="container">
                     <div class="row justify-content-center">
                         <div class="col-lg-6">
                             <div class="banner_content text-center">

                                 <div class="page_link">
                                     <a href="index.html">ԳԼԽԱՎՈՐ
                                     </a>
                                     <a href="about-us.html">ՄԵՐ ՄԱՍԻՆ</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
         <!--================ Start About Area =================-->
         <div class="department_area section_gap">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-lg-6 text-center">
                         <img class="img-fluid" :src="aboutimg" alt="">
                     </div>

                     <div class="offset-lg-1 col-lg-5">
                         <div class="dpmt_right" v-for="data in datas" :key="data.id">
                             <h1>{{ data.title }}</h1>
                             <p> {{ data.description }}</p>

                             <a href="#" class="primary-btn text-uppercase">Դասընթացներ</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <h4 class="title">Փաստաթղթեր</h4>
         <hr class="line">
         <div class="content">
             <ul class="course_list" v-for="doc in docs" :key="doc.id">
                 <li class="justify-content-between d-flex">
                     <p>{{ doc.doc_path }}</p>
                     <a class="primary-btn text-uppercase" href="#">Ներբեռնել</a>
                 </li>
             </ul>
         </div>

         <!--================ End About Area =================-->

     </div>
</template>

<script>
    import {getPagesData} from '../partials/auth';
    export default {
        data() {
            return {
                datas: [],
                aboutimg:'/css/frontend/img/about-img.png',
                docs: [],
            };
        },
        methods:{
         aboutpage: function() {
             getPagesData("hhh")
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
          beforeMount(){
            this.aboutpage()
         },
    }
</script>
<style>
    .home_banner_area {
        min-height: 234px;
    }
</style>
