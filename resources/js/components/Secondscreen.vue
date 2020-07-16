 <template>
     <!--================ Start Department Area =================-->
     <div class="department_area section_gap">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-lg-6">
                     <div class="dpmt_courses">
                         <div class="row">
                             <!-- single course -->
                             <div class="col-lg-4 col-md-4 col-sm-6 col-12 text-center mt-100">
                                 <div class="single_department">
                                     <div class="dpmt_icon">
                                         <img :src="nurse" alt="">
                                     </div>
                                     <h4>ԲՈՒԺՔՈՒՅՐ</h4>
                                 </div>
                             </div>
                             <!-- single course -->
                             <div class="col-lg-4 col-md-4 col-sm-6 col-12 text-center">
                                 <div class="single_department">
                                     <div class="dpmt_icon">
                                         <img :src="doctor" alt="">
                                     </div>
                                     <h4>ԲԺԻՇԿ</h4>

                                 </div>
                             </div>
                             <!-- single course -->
                             <div class="col-lg-4 col-md-4 col-sm-6 col-12 text-center mt-100">
                                 <div class="single_department">
                                     <div class="dpmt_icon">
                                         <img :src="pharmacy" alt="">
                                     </div>
                                     <h4>ԴԵՂԱԳԵՏ</h4>
                                 </div>
                             </div>
                             <!-- single course -->
                             <div class="col-lg-4 col-md-4 col-sm-6 col-12 text-center">
                             </div>
                             <!-- single course -->
                             <div class="col-lg-4 col-md-4 col-sm-6 col-12 text-center mt--100">
                                 <div class="single_department">
                                     <div class="dpmt_icon">
                                         <img :src="phar" alt="">
                                     </div>
                                     <h4>ԴԵՂԱԳՈՐԾ</h4>
                                 </div>
                             </div>


                         </div>
                     </div>
                 </div>

                 <div class="offset-lg-1 col-lg-5">
                     <div class="dpmt_right">
                         <h1>ԴԱՍԸՆԹԱՑՆԵՐՆ ԸՍՏ ՈՐՈԿԱՎՈՐՄԱՆ</h1>
                         <p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s
                             exciting to think about setting up your own viewing station. In the life of any aspiring astronomer that it is
                             time to buy that first telescope. It’s exciting to think about setting up your own viewing station.</p>
                         <p>It’s exciting to think about setting up your own viewing station. In the life of any aspiring astronomer that
                             it is time to buy that first telescope exciting is time to buy that first.</p>
                         <a href="#" class="primary-btn text-uppercase search_course_btn">Դասընթացներ</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--================ End Department Area =================-->
 </template>

<script>
export default {
        data() {
            return {
                nurse: '/css/frontend/img/nurse.svg',
                doctor:'/css/frontend/img/doctor.png',
                pharmacy:'/css/frontend/img/pharmacy-symbol.svg',
                phar:'/css/frontend/img/pharmacy.png'
            };
        },

}
</script>

