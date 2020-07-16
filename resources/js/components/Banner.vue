<template>
    <div class="container-fluid m-0 p-0">
        <!--================ Start Header Menu Area =================-->
        <header class="header_area navbar_fixed">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <router-link :to="{ name: 'home' }" class="navbar-brand logo_h">
                        <img :src="image_src" alt=""></router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><router-link :to="{ name: 'home' }" class="nav-link">Գլխավոր</router-link></li>
                            <li class="nav-item"><router-link :to="{ name: 'about' }" class="nav-link">Մեր մասին</router-link></li>
                            <li class="nav-item"><router-link :to="{ name: 'lesson' }" class="nav-link">Դասընթացներ</router-link></li>
                            <li class="nav-item"><router-link :to="{ name: 'contact' }" class="nav-link">Հետադարձ կապ</router-link></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--================ End Header Menu Area =================-->

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

