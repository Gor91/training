<template>
    <div class="container-fluid m-0 p-0">
        <div ref="topbar" class="row navbar navbar-expand-md navbar-light navbar-laravel m-0">
            <!--            <router-link class="navbar-brand" to="/">Authentication  Laravel 5.6/Vue SPA</router-link>-->
            <div class=" col-lg-8 col-sm-8 col-8 header-top-left">
                <h1>{{text.title}}</h1>
            </div>

            <div class="navbar-collapse col-lg-4 col-sm-4 col-4" id="navbarContent">
                <div class="navbar-nav ml-auto m_navbar">
                    <template v-if="!currentUser">
                        <li>
                            <router-link to="/login" class="nav-link"><img :src="stethoscope" style="height: 24px;"/>{{text.login}}
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/register" class="nav-link"><img :src="ekg"/>{{text.register}}
                            </router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <router-link to="/account" class="nav-link">{{text.user}}</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{currentUser.name}} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="#!" @click.prevent="logout" class="dropdown-item">{{text.logout}}</a>
                            </div>
                        </li>
                    </template>
                </div>
            </div>

        </div>

        <!--================ Start Header Menu Area =================-->

        <header ref="navbar" class="header_area" :class="{'navbar_fixed': scrolled}" v-on:scroll="handleScroll">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <router-link :to="{ name: 'home' }" class="navbar-brand logo_h">
                        <!--img :src="image_src" alt=""-->
                        <span class="shmz">ՇՄԶ</span>
                    </router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item">
                                <router-link :to="{ name: 'home' }" class="nav-link">{{text.main}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'about' }" class="nav-link">{{text.aboutus}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'lesson' }" class="nav-link">{{text.lessons}}</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'contact' }" class="nav-link">{{text.contact}}</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

    </div>
    <!--================ End Header Menu Area =================-->
</template>

<script>
    import pagestext from './json/pages.json';

    export default {
        name: 'app-header',

        methods: {
            handleScroll() {

                if (this.$refs.navbar.clientHeight + this.$refs.topbar.clientHeight < window.scrollY) {
                    this.scrolled = true;
                    this.$refs.navbar.style.position = "fixed";
                    this.$refs.navbar.style.top = 0;
                    this.$refs.navbar.style.background = '#f8fafc';
                } else {
                    this.scrolled = false;
                    this.$refs.navbar.style.position = "relative";

                }

                this.lastPosition = window.scrollY;
                // this.scrolled = window.scrollY > 50;
            },
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },

        },
        created() {
            window.addEventListener("scroll", this.handleScroll);
        },
        destroyed() {
            window.removeEventListener("scroll", this.handleScroll);

        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        data() {
            return {
                image_src: '/css/frontend/img/logo.png',
                ekg: '/css/frontend/img/ekg.png',
                stethoscope: '/css/frontend/img/stethoscope.png',
                limitPosition: 2000,
                scrolled: false,
                lastPosition: 0,
                text: pagestext
            };
        },
    }
</script>
