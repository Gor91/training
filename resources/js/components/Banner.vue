<template>
    <div class="container-fluid m-0 p-0">
        <!--================ Start Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner">
                <div class="container-fluid">
                    <div class="row">
<!--                        <video ref="video" class="view-video col-lg-12 p-0" controls>-->
<!--                            <source :src="path">-->
<!--                        </video>-->
                        <iframe width="100%" height="576px" :src="path"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allow="autoplay"></iframe>
                    </div>
                </div>
                <div class="ekgbg">
                <div class="container">
                    <div class="row">
                            <div class="banner_content col-12">
                                <h2 class="pt-4"> ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ ԿԵՆՏՐՈՆ </h2>
                                <p>Բարի գալուստ Բուժաշխատողների շարունակական մասնագիտական զարգացման կենտրոնի էլեկտրոնային հավելված։ Մեր թիմը ստեղծել է այս գործիքը, որպեսզի բուժաշխատողներն իրենց շարունակական մասնագիտական զարգացումը կարողանա իրականացնել նաև պարբերաբար և առցանց՝ էլեկտրոնային ուսուցման նյութերի միջոցով։
                                <div class="search_course_wrap d-flex justify-content-end">
                                   <router-link :to="{ name: 'lesson' }" class="btn search_course_btn align-self-end">
                                   Դասընթացներ</router-link>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>
        </section>
        <!--================ End Home Banner Area =================-->


    </div>
</template>

<script>
    export default {
        data() {
            return {
                path:"https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fnational.medical.palace.armenia%2Fvideos%2F1156056018093516%2F&show_text=0",
                image_src: '/css/frontend/img/logo.png',
            };
        },
    }
</script>

