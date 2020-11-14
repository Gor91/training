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
                        <h4 v-if="this.msg" class="router-link-active text-uppercase">{{this.msg}}</h4>
                        <h4 v-if="this.again" class="router-link-active ">{{this.again}}</h4>
                        <form ref="form" @submit.prevent="getResult">
                            <div v-for="(info, index) in tests">
                                <h3 class="or">{{index+1}}. {{info.question}}</h3>

                                <ul>
                                    <li v-for="(answer, i) in JSON.parse(info.answers)" class="d-flex flex-row">

                                        <label>
                                            <input :type="info.type" :value="(i+1)" class=""
                                                   v-model="formTest[(index +1)+'_'+(i+1)]"
                                                   :name="'test_'+(index +1)" v-validate="'required|included:1,2,3,4'">
                                        </label>
                                        <span v-html="answer.inp">{{answer.inp}}</span>
                                        <span v-show="errors.has('test_'+(index +1))"
                                              class="help is-danger">{{ errors.first('test_'+(index +1)) }}</span>
                                    </li>
                                </ul>

                            </div>
                            <button type="submit" class="btn primary-btn mt-3 float-right">{{text.test}}</button>
                        </form>
                        <div class="col-lg-12 m-0 pb-5">
                            <p ref="msg"></p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--================Blog Categorie Area =================-->
    </div>
</template>

<script>
    import coursetexts from './json/course.json';
    import {getPromiseResult} from '../partials/help';

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
                    token: this.currentUser.token,
                    account_id: this.currentUser.id,
                    url: 'gettests',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                            let counter = 0;
                            console.log('res.tests', res);
                            for (let i of res.tests) {
                                for (let answer of JSON.parse(i.answers)) {
                                    if (answer.check == 1)
                                        counter++;
                                }
                                i.type = (counter > 1) ? 'checkbox' : "radio";
                                this.tests = res.tests;
                            }
                        }
                    )
                    .catch(err => {
                        console.log('errr')
                    })
            },
            getResult() {
                this.$validator.validateAll().then((result) => {

                    if (result) {
                        let credentials = {
                            id: this.id,
                            user_id: this.currentUser.id,
                            token: this.currentUser.token,
                            model: this.formTest,
                            url: "getresult",
                            auth: true
                        };
                        getPromiseResult(credentials)
                            .then(res => {
                                this.tests = res.result;
                                // this.$refs.form.style.display = 'none';
                                // this.$refs.msg.innerText = 'none';
                                window.location.reload();

                            })
                            .catch(err => {
                                console.log('errr')
                            });
                        console.log('Form Submitted!');
                        return;
                    }
                    console.log('Correct them errors!');
                });
            },
            getCourseTitle(id) {
                let credentials = {
                    id: this.id,
                    token: this.currentUser.token,
                    url: "gettitle",
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.title = res.title.name;
                    })
                    .catch(err => {
                        console.log('errr')
                    })
            },
            getPercentAndCount() {
                let credentials = {
                    id: this.id,
                    user_id: this.currentUser.id,
                    token: this.currentUser.token,
                    url: 'getcpcourse',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        let info = JSON.parse(res.info);
                        if (!!info) {
                            this.percent = info.percent;
                            this.count = info.count;

                            if (this.count < 3) {
                                if (this.percent < 80) {
                                    this.msg = coursetexts.result + info.percent + coursetexts.point;
                                    this.again = coursetexts.again + (3 - this.count) + coursetexts.possibility;
                                } else {
                                    this.msg = coursetexts.result + this.percent + coursetexts.point;
                                    // this.again = coursetexts.again + (3 - this.count) + coursetexts.possibility;
                                    this.$refs.form.style.display = 'none';
                                }
                            } else {
                                this.$refs.form.style.display = 'none';
                                this.msg = coursetexts.unsuccess;
                                setTimeout(() => {
                                    this.logout();
                                }, 1000)
                            }
                        }
                    })
                    .catch(err => {
                        console.log('errr', err)
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
                title: "",
                formTest: {},
                msg: "",
                again: ""
            }
        },
        beforeMount() {

            this.id = this.$route.params.id;
            this.getPercentAndCount();
            this.getTests(this.id);
            this.getCourseTitle(this.id);
        },

    }
</script>
