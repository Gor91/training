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

                        <hooper :itemsToShow="1">
                            <slide>
                            <iframe width="100%" height="576px" :src="path"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allow="autoplay"></iframe>

                            <!--video ref="video" class="view-video col-lg-12" controls
                                   v-on:loadeddata="manageEvents(info.id)">
                                <source :src="info.path">
                            </video-->
                            <div class="col-lg-12">
                                <h5 class="title">test</h5>

                            </div>
                        </slide>
                            <slide>
                              <img :src="banner_src" alt="ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ ԿԵՆՏՐՈՆ" title="ԲՈՒԺԱՇԽԱՏՈՂՆԵՐԻ ՇԱՐՈՒՆԱԿԱԿԱՆ ՄԱՍՆԱԳԻՏԱԿԱՆ ԶԱՐԳԱՑՄԱՆ ԿԵՆՏՐՈՆ">
                                <!--video ref="video" class="view-video col-lg-12" controls
                                       v-on:loadeddata="manageEvents(info.id)">
                                    <source :src="info.path">
                                </video-->
                                <div class="col-lg-12">
                                    <h5 class="title">test1</h5>

                                </div>
                            </slide>
                            <hooper-pagination slot="hooper-addons"></hooper-pagination>
                        </hooper>

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
    import {Hooper, Pagination as HooperPagination, Slide} from 'hooper';
    import 'hooper/dist/hooper.css';
    export default {
        data() {
            return {
                path:"https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fnational.medical.palace.armenia%2Fvideos%2F1156056018093516%2F&show_text=0",
                image_src: '/css/frontend/img/logo.png',
                banner_src: '/css/frontend/img/banner/banner.jpeg',
                isActive: false,
                objects: [
                    {id: 1},
                    {id: 2},
                    {id: 3},
                    {id: 4},
                    {id: 5}

                ],
            };
        },
        components: {
            Hooper,
            Slide, HooperPagination
        },
    }
</script>
