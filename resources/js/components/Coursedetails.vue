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
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{coursetexts.home}}
                                    </router-link>
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
            <div class="container" :key="datas.id">
                <div class="col-lg-12 m-0 pb-5"><h2 class="or"> {{datas.name}}</h2></div>
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image">
                            <hooper :itemsToShow="1">
                                <slide v-for="(info,index) in video_info" :key="index" :index="index">

                                    <video ref="video" class="view-video col-lg-12" controls
                                           v-on:loadeddata="manageEvents(info.id)">
                                        <source :src="info.path">
                                    </video>
                                    <div class="col-lg-12">
                                        <h5 class="title">{{info.title}}</h5>
                                        <h5>{{`${info.lectures.name} ${info.lectures.surname}
                                            ${info.lectures.father_name}`}}</h5>
                                    </div>
                                </slide>
                                <hooper-pagination slot="hooper-addons"></hooper-pagination>
                            </hooper>

                        </div>
                        <div class="content_wrapper">
                            <h4 class="title">{{coursetexts.content}}</h4>
                            <div v-html="datas.content" class="content">
                                {{datas.content}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 right-contents">
                        <ul>
                            <li v-if="datas.status ==='active'">
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{coursetexts.status}} </p>
                                    <span class="or"> {{coursetexts.status_active}}</span>
                                </a>
                            </li>

                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{coursetexts.credit}}</p>
                                </a>
                                <a class="justify-content-between d-flex" href="#"
                                   v-for="c in datas.credit">
                                    <span>{{c.name}}</span>
                                    <span>{{c.credit}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{coursetexts.duration}} </p>
                                    <span>{{datas.duration_date}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{coursetexts.coursecost}} </p>
                                    <span>{{datas.cost}} AMD</span>
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="primary-btn text-uppercase enroll">{{coursetexts.paid}}</a>


                        <div class="content">
                            <div class="review-top row pt-40">
                                <div class="col-lg-12">
                                    <h6 class="mb-15"></h6>
                                    <div class="d-flex flex-row reviews justify-content-between">
                                        <span>{{coursetexts.rate}}</span>
                                        <div class="star">
                                            <i class="fa fa-star" :id="item.id" v-on:click="raiting"
                                               v-bind:class="{ checked: isActive }" v-for="(item, key) in objects"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feedeback">
                                <h6>{{coursetexts.feedback}}{{feedbacksuccess}}</h6>
                                <form @submit.prevent="sendcomment">
                                    <textarea name="feedback" class="form-control" ref="feedback" cols="10" rows="10"
                                              id="feedback" v-model="feedback"></textarea>
                                    <div class="mt-10 text-right">
                                        <button class="primary-btn text-right text-uppercase comment">
                                            {{coursetexts.send}}
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ End Course Details Area =================-->
    </div>
</template>

<script>
    import {getVideoDetails} from '../partials/video';
    import {getCourseDetails} from '../partials/courses';
    import coursetexts from './json/course.json';
    import {Hooper, Pagination as HooperPagination, Slide} from 'hooper';
    import 'hooper/dist/hooper.css';

    export default {
        data() {
            return {

                video_info: [],
                video: 'http://iandevlin.github.io/mdn/video-player/video/tears-of-steel-battle-clip-medium.mp4',
                feedback: '',
                datas: [],
                specialites: [],
                courseimg: '/css/frontend/img/courses/course-details.jpg',
                videoimg: '/css/frontend/img/blog/cat-post/cat-post-3.jpg',
                docs: [],
                coursetexts: coursetexts,
                feedbacksuccess: '',
                isActive: false,
                objects: [
                    {id: 1},
                    {id: 2},
                    {id: 3},
                    {id: 4},
                    {id: 5}

                ],


            };
        },
        components: {
            Hooper,
            Slide, HooperPagination
        },
        methods: {
            manageEvents(id) {
                alert(id);
                this.$nextTick(() => {
                    getVideoDetails(id).
                    then(res => {
                        console.log(res)

                    })
                        .catch(error => {
                            this.$store.commit("getContentFailed", {error});
                        });
                    let _this = this;
                    // if (_this.$refs.video) {
                    //     let supposedCurrentTime = 0, backTime = 0;
                    //     let video = _this.$refs.video;
                    //
                    //     video.addEventListener('timeupdate', function () {
                    //         if (!video.seeking) {
                    //
                    //             supposedCurrentTime = video.currentTime;
                    //         } else
                    //             backTime = video.currentTime;
                    //     });
                    //
                    //     video.addEventListener('seeking', function () {
                    //
                    //
                    //         let back = backTime - supposedCurrentTime;
                    //
                    //         if (back < 0) {
                    //             video.currentTime = backTime;
                    //             supposedCurrentTime = backTime;
                    //             console.log(supposedCurrentTime);
                    //         } else {
                    //             let delta = video.currentTime - supposedCurrentTime;
                    //             if (Math.abs(delta) > 0.01) {
                    //                 console.log("Seeking is disabled");
                    //                 video.currentTime = supposedCurrentTime;
                    //             }
                    //         }
                    //     });
                    //     video.addEventListener('pause', function () {
                    //         video.currentTime = supposedCurrentTime;
                    //     });
                    //     video.addEventListener('ended', function () {
                    //
                    //         supposedCurrentTime = 0;
                    //     });
                    // }
                    console.log(_this.$refs.video)
                });
            },
            coursedetails: function () {
                getCourseDetails(this.$route.params.id)
                    .then(res => {
                        this.datas = res.data;
                        this.datas.credit = JSON.parse(res.data.credit);
                        this.video_info = JSON.parse(res.data.videos);
                        this.specialites = res.specialities;
                        // this.manageEvents();

                    })
                    .catch(error => {
                        console.log('error');
                        // this.$store.commit("registerFailed", {error});
                    })
            },
            raiting: function (event) {

                var loop_count = 5 - parseInt(event.currentTarget.id);


                for (var j = event.currentTarget.id; j >= event.currentTarget.id; j--) {
                    var ss = j.toString();
                    if (document.getElementById(ss).classList.contains('checked')) {


                        document.getElementById(ss).classList.remove("checked");
                    }
                    event.currentTarget.classList.remove("checked");

                }


                if (!event.currentTarget.classList.contains('checked')) {
                    for (var i = 1; i <= parseInt(event.currentTarget.id); i++) {
                        event.currentTarget.classList.add("checked");
                        var s = i.toString();
                        document.getElementById(s).classList.add("checked");

                    }
                }
            },
            sendcomment: function () {
                // if(this.feedback != ''){
                //console.log(this.$refs.feedback.text);
                let user = JSON.parse(localStorage.getItem('user'));
                // this.feedback = this.$refs.feedback.text;
                axios.post('/api/comment/', {
                    comment: feedback.value,
                    account_id: user.id,
                    course_id: this.$route.params.id
                })
                    .then(function (response) {
                        //alert(response.data);
                        feedback.value = '';
                        feedbacksuccess = "Մեկնաբանությունը հաջողությամբ ուղարկվեց";
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                /* }else{
                     alert('Fill all fields.');
                 }*/
            }

        },
        beforeMount() {
            this.coursedetails();
        },

    }

</script>
<style>
    .home_banner_area {
        min-height: 234px;
    }

    .hooper {
        height: 600px;
    }

    .hooper-pagination {
        top: 0
    }

</style>

