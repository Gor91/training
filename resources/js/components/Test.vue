<template>
    <div class="container-fluid">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">

                                <div class="page_link" v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{text.home}}</router-link>
                                    <router-link :to="{ name: 'coursedetails'}" class="nav-link" >{{text.lessons}}</router-link>
                                    <router-link to="" class="nav-link">{{b.text}}</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================Blog Test Area =================-->
        <section class="blog_categorie_area">
            <div class="container">
                <div class="row">



                </div>
            </div>
        </section>
        <!--================Blog Categorie Area =================-->
    </div>
</template>

<script>
    import {getAllCourses, getCoursesById} from '../partials/courses';
    import coursetexts from './json/course.json';

    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            allcourses: function () {
                getAllCourses()
                    .then(res => {
                        this.courses = res.data;
                    })
                    .catch(error => {
                        console.log('errorsss');
                        // this.$store.commit("registerFailed", {error});
                    })
            },
            getCourses(id) {
                let credentials = {
                    id: id,
                    token: this.currentUser.token
                };
                getCoursesById(credentials)
                    .then(res => {
                        this.courses = res.courses;
                    })
                    .catch(err => {
                    })
            }

        },
        computed: {
            currentUser: function () {

                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            }
        },
        data() {
            return {
                id: '',
                courses: [],
                image_src: '/css/frontend/img/background.png',
                text: coursetexts,
            }
        },
        beforeMount() {
            if (!this.$store.getters.currentUser)
                this.allcourses();
            else
                this.getCourses(this.$store.getters.currentUser.id);
            this.id = this.$route.params.id;
        },
    }
</script>
