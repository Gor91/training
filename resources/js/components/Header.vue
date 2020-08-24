<template>
    <div class="container-fluid m-0 p-0">
        <div class="row navbar navbar-expand-md navbar-light navbar-laravel m-0">
            <!--            <router-link class="navbar-brand" to="/">Authentication  Laravel 5.6/Vue SPA</router-link>-->
            <div class="col-lg-6 col-sm-6 col-6 header-top-left">
                <a href="tel:+37443007107" class="small">
                    <span class="fa fa-phone"></span>
                    <span class="text">
						<span class="text pl-3">(+374) 43-007-107</span>
                  </span>
                </a>

                <a href="mailto:support@colorlib.com" class="small">
                    <span class="fa fa-envelope pl-3"></span>
                    <span class="text">
								<span class="text pl-2">
national.med.palace@gmail.com</span>
							</span>
                </a>
            </div>

            <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button-->

            <div class="navbar-collapse col-lg-6 col-sm-6 col-6" id="navbarSupportedContent">
                <div class="navbar-nav ml-auto m_navbar">
                    <template v-if="!currentUser">
                        <li>
                            <router-link to="/login" class="nav-link">Մուտք</router-link>
                        </li>
                        <li>
                            <router-link to="/register" class="nav-link"> Գրանցվել</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <router-link to="/account" class="nav-link">Օգտատեր</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{currentUser.name}} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="#!" @click.prevent="logout" class="dropdown-item">Ելք</a>
                            </div>
                        </li>
                    </template>
                </div>
            </div>

        </div>
        <div class="lines"></div>
        <!--================ Start Header Menu Area =================-->

        <header class="header_area navbar_fixed">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <router-link :to="{ name: 'home' }" class="navbar-brand logo_h">
                        <img :src="image_src" alt=""></router-link>
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
                                <router-link :to="{ name: 'home' }" class="nav-link">Գլխավոր</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'about' }" class="nav-link">Մեր մասին</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'lesson' }" class="nav-link">Դասընթացներ</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'contact' }" class="nav-link">Հետադարձ կապ</router-link>
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
    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        data() {
            return {
                image_src: '/css/frontend/img/logo.png',
            };
        },
    }
</script>
