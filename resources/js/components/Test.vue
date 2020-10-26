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
                                    <router-link :to="{ name: 'coursedetails'}" class="nav-link">{{text.lessons}}
                                    </router-link>
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
    import {getTestById, getResult} from '../partials/courses';
    import coursetexts from './json/course.json';
    export default {
        name: 'app-header',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            getTests(id) {
                let credentials = {
                    id: this.id,
                    token: this.currentUser.token
                };
                getTestById(credentials)
                    .then(res => {
                        this.tests = res.tests;
                    })
                    .catch(err => {
                        console.log('errr')
                    })
            },
            getResult(id) {
                let credentials = {
                    id: this.id,
                    user_id: this.currentUser.id,
                    token: this.currentUser.token
                };
                getResult(credentials)
                    .then(res => {
                        this.tests = res.tests;
                    })
                    .catch(err => {
                        console.log('errr')
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
                tests: [],
                text: coursetexts,
            }
        },
        beforeMount() {
            // if (!this.$store.getters.currentUser)
            //     this.allcourses();
            // else
            //     this.getCourses(this.$store.getters.currentUser.id);
            this.id = this.$route.params.id;
        },
    }
</script>
