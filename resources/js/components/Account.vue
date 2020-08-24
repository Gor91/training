<template>
    <div class="container">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">
                                <div class="page_link" v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                    <router-link :to="{ name: 'home' }" class="nav-link">ԳԼԽԱՎՈՐ</router-link>
                                    <router-link to="" class="nav-link">{{b.text}}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Start Course Details Area =================-->
        <section class="course_details_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 course_details_left">
                        <div class="main_image">
                            <p class="pb-4"> {{texts.hint}}</p>
                            <div id="preview">
                                <img v-bind:src="imgName" class="avatar">
                                <i class="fa fa-camera-retro fa-2x icon"></i>
                                <input type="file" @change="onFileChange"/>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 right-contents">
                        <ul>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{texts.profilename}}</p>
                                    <span class="or">{{currentUser.name}} {{currentUser.surname}} {{currentUser.father_name}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{texts.profession}} </p>
                                    <span>{{currentUser.prof.profession}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{texts.email}}</p>
                                    <span>{{currentUser.user.email}}</span>
                                </a>
                            </li>
                        </ul>
                        <router-link :to="'/edit/'+currentUser.id" class="primary-btn text-uppercase enroll">Edit
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    import {uploadAvatar} from '../partials/auth';
    import registertexts from './json/registertexts.json'

    export default {
        props: ['input_name'],
        data() {
            return {
                avatar: [],
                url: null,
                texts: registertexts
            }
        },

        computed: {
            currentUser: function () {
                console.log(this.$store.getters.currentUser);
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            },
            imgName: function () {
                let src = "";
                let img_name = this.$store.getters.currentUser.image_name;
                let pattern = /\d+/ig;
                if (pattern.exec(img_name))
                    src = "/uploads/images/avatars/" + img_name;
                else
                    src = "/images/avatars/" + img_name;
                return src;
            },
        },
        methods: {
            upload(file) {
                // let file = this.$refs.avatar.files[0];
                uploadAvatar(file, this.currentUser.id, this.currentUser.token)
                    .then(res => {
                        this.$store.commit("uploadSuccess", res);
                        this.$nextTick(() => {
                            let ls = JSON.parse(localStorage.getItem('user'));
                            ls.image_name = res.user.image_name;
                            localStorage.setItem('user', JSON.stringify(ls))
                            // console.log('str',localStorage.getItem('user'))
                        })
                        // this.$router.push({path: '/dashboard'});
                    })
                    .catch(error => {
                        this.$store.commit("uploadFailed", {error});
                    });
            },
            onFileChange(e) {
                const file = e.target.files[0];
                // this.url = URL.createObjectURL(file);
                // console.log(file)
                // console.log(this.url)
                this.upload(file);
            },
        }
    }
</script>


