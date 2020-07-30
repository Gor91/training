<template>
    <div class="container-fluid m-0 p-0">
        <!--================ Start Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="banner_content">
                                <h2 class="pt-4"> Ազգային բժշկական պալատ </h2>
                                <p>Բուժաշխատողների իրավունքները պաշտպանող, շարունակական մասնագիտական և այլ ծրագրեր իրականացնող մասնագիտական միություն</p>
                                <div class="search_course_wrap">
                                   <router-link :to="{ name: 'lesson' }" class="btn search_course_btn">
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
                image_src: '/css/frontend/img/logo.png',
            };
        },
    }
</script>

