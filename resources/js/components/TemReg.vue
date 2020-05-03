 <template>
         <!--================ Start Registration Area =================-->
         <div class="section_gap registration_area">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-lg-7">
                         <div class="row clock_sec clockdiv" id="clockdiv">
                             <div class="col-lg-12">
                                 <h1>Գրանցվեք հիմա</h1>
                                 <p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s
                                     exciting to think about setting up your own viewing station.</p>
                             </div>
                             <div class="col clockinner1 clockinner">
                                 <h1 class="days">150</h1>
                                 <span class="smalltext">Մասնակիցներ</span>
                             </div>
                             <div class="col clockinner clockinner1">
                                 <h1 class="hours">23</h1>
                                 <span class="smalltext">Դասընթացներ</span>
                             </div>
                             <div class="col clockinner clockinner1">
                                 <h1 class="minutes">47</h1>
                                 <span class="smalltext">Վկայականներ</span>
                             </div>
                             <div class="col clockinner clockinner1">
                                 <h1 class="seconds">59</h1>
                                 <span class="smalltext">Secs</span>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-4 offset-lg-1">
                         <div class="register_form">
                             <h3>Մուտք</h3>
                             <p>It is high time for learning</p>
                             <form class="form_area" id="myForm" action="mail.html" method="post">
                                 <div class="row">
                                     <div class="col-lg-12 form_group">
                                         <input name="email" placeholder="էլ.հասցե" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"
                                                required="" type="email">

                                         <input name="password" placeholder="Գաղտնաբառ" required="" type="password">
                                     </div>
                                     <div class="col-lg-12 text-center">
                                         <button class="primary-btn">Մուտք</button>
                                         <button class="primary-btn">Գրանցվել</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--================ End Registration Area =================-->
 </template>

<script>
export default {
        data() {
            return {
                nurse: '/css/template/img/nurse.svg',
                doctor:'/css/template/img/doctor.png',
                pharmacy:'/css/template/img/pharmacy-symbol.svg',
                phar:'/css/template/img/pharmacy.png'
            };
        },

}
</script>