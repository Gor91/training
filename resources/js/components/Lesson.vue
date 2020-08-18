<template>
    <div class="container-fluid">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">
                                <div class="page_link"  v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                    <router-link :to="{ name: 'home' }" class="nav-link">ԳԼԽԱՎՈՐ</router-link>
                                    <router-link to="" class="nav-link">{{b.text}}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     <!--================Blog Categorie Area =================-->
        <section class="blog_categorie_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4" v-for="course in courses" :key="course.id">
                        <div class="categories_post">
                            <img :src="image_src" alt="post">
                            <div class="categories_details">
                                <div class="categories_text">
                                    <template v-if="!currentUser">
                                         <p>{{course.name}}</p>
                                    </template>
                                    <template v-else>
                                        <router-link :to="'/coursedetails/'+course.id" class="nav-link"><p>{{course.name}}</p> </router-link>

                                    </template>

                                    <div class="border_line yellow" v-if="!currentUser"></div>
                                    <span class="fa fa-lock yellow" v-if="!currentUser"></span>
                                    <div class='d-flex justify-content-center' v-if="!currentUser" >
                                        <router-link to="/login" class="nav-link">Մտնել </router-link>
                                        <p  class="nav-link">կամ</p>

                                        <router-link to="/register" class="nav-link white"> գրանցվել</router-link></div>
                                </div>
                            </div>

                        </div>
                        <!-- single course -->
                        <div class="row" v-if="currentUser">
                        <div class="col-lg-12 col-md-12" >
                            <div class="single_course">
                                <div class="course_content">
                                    <div class="course_meta d-flex justify-content-between">
                                        <div>
                                    <span class="meta_info">
                                        <a href="#">
                                            <i class="fa fa-user-o yellow" ></i>355
                                        </a>
                                    </span>

                                        </div>
                                        <div>
                                            <span class="price">{{course.cost}} AMD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>





                </div>
            </div>
        </section>
        <!--================Blog Categorie Area =================-->
    </div>
</template>

<script>
    import {getAllCourses} from '../partials/courses';
    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            allcourses: function() {
                getAllCourses("hhh")
                    .then(res => {
                        this.courses = res.data;
                    })
                    .catch(error => {
                        console.log('errorsss');
                        // this.$store.commit("registerFailed", {error});
                    })
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        },
        data() {
            return {
                courses: [],
                image_src: '/css/frontend/img/background.png',
            }
        },
        beforeMount(){
            this.allcourses();
        },

    }
</script>