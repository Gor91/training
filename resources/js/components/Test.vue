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
                <div class="row align-items-center">

                    <div class="col-lg-12 m-0 pb-5">
                        <h2 class="text-center">
                            <router-link :to="{ name: 'coursedetails', params:{id:this.id}}" class="nav-link or">
                                {{this.title}}
                            </router-link>
                        </h2>
                        <div v-for="(info, index) in tests">
                            <p>{{index+1}}. {{info.question}}</p>

                            <ul :name="index">
                                <li v-for="(answer, i) in JSON.parse(info.answers)"  :value="i">
                                   <span v-html="answer.inp">{{answer.inp}}</span>
                                    <label >
                                        <input :type="info.type" :value="i">
                                    </label>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--================Blog Categorie Area =================-->
    </div>
</template>

<script>
    import {getCourseTitleById, getResult, getTestById} from '../partials/courses';
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
                            let counter = 0;
                            for (let i of res.tests) {
                                for (let answer of JSON.parse(i.answers)) {
                                    if (answer.check == 1)
                                        counter++;
                                }
                                i.type = (counter > 1) ? 'checkbox' : "radio";
                                console.log(res.tests);
                                this.tests = res.tests;
                            }
                        }
                    )
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
            },
            getCourseTitle(id) {
                let credentials = {
                    id: this.id,
                    token: this.currentUser.token
                };
                getCourseTitleById(credentials)
                    .then(res => {
                        this.title = res.title.name;
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
                title: ""
            }
        },
        beforeMount() {
            // if (!this.$store.getters.currentUser)
            //     this.allcourses();
            // else
            //     this.getCourses(this.$store.getters.currentUser.id);
            this.id = this.$route.params.id;
            this.getTests(this.id);
            this.getCourseTitle(this.id);
        },
    }
</script>
