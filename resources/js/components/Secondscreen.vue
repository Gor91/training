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
                         <p>Բուժաշխատողների իրավունքները պաշտպանող, շարունակական մասնագիտական և այլ ծրագրեր իրականացնող մասնագիտական միություն:</p>
                         <p>Ազգային Բժշկական Պալատը սկսում է Պալատին անդամակցած բժշկական կենտրոններում կրթական լայնածավալ
                             ծրագրերի իրականացման գործընթաց։ Ուստի առաջարկում ենք այն բժշկական կենտրոններին և մասնագիտական
                             ասոցիացիաներին, ովքեր ասելիք և անելիք ունեն կիրթ, պաշտպանված ու բանիմաց բուժաշխատողի կերտման
                             շարունակական գործընթացում՝ արձագանքել համատեղ ծրագրերի իրականացման համար։ Երկու նման մասնագիտական
                             ասոցիացիայի հետ համատեղ ծրագրեր մշակման փուլում են, որի մասին կհայտարարենք առաջիկայում։</p>
                         <router-link :to="{ name: 'lesson' }" class="primary-btn text-uppercase search_course_btn">
                             Դասընթացներ</router-link>
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

