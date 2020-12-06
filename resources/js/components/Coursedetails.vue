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
                                    <<router-link :to="{ name: 'home' }" class="nav-link">{{texts.home}}
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
                <div class="col-lg-12 m-0 pb-5"><h2 class="or text-center"> {{datas.name}}</h2></div>
                <div class="row">
                    <div class="col-lg-8 course_details_left">
                        <div class="main_image" v-if="video_info">
                            <hooper :itemsToShow="1">
                                <slide v-for="(info, index) in video_info" :key="index" :index="index">
                                    <video ref="video" class="view-video col-lg-12" controls
                                           v-on:loadeddata="manageEvents(info.id, index)">
                                        <source :src="info.path">
                                    </video>
                                    <div class="col-lg-12">
                                        <h5 class="title">{{info.title}}</h5>
                                        <h5 class="vid_content">{{`${info.lectures.name} ${info.lectures.surname}
                                            ${info.lectures.father_name}`}}</h5>
                                    </div>
                                </slide>
                                <hooper-pagination slot="hooper-addons"></hooper-pagination>
                            </hooper>

                        </div>
                        <div class="attachment-mark" v-if="books">
                            <h4 class="title">{{texts.books}}</h4>
                            <template  v-for="book in books">
                                <i class="fa fa-book text"></i>
                                <router-link to="/books/1" class="text" target="_blank">{{book.title}}</router-link>

                            </template>
                        </div>
                        <div class="content_wrapper">
                            <h4 class="title">{{texts.content}}</h4>
                            <div v-html="datas.content" class="content">
                                {{datas.content}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 right-contents">
                        <ul>
                            <li v-if="datas.status ==='active'">
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{texts.status}} </p>
                                    <span class="or"> {{texts.status_active}}</span>
                                </a>
                            </li>

                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{texts.credit}}</p>
                                </a>
                                <a class="justify-content-between d-flex" href="#"
                                   v-for="c in datas.credit">
                                    <span>{{creditName(c.name)}}</span>
                                    <span>{{c.credit}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{texts.duration}} </p>
                                    <span>{{datas.duration_date}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>{{texts.coursecost}} </p>
                                    <span>{{datas.cost}} AMD</span>
                                </a>
                            </li>
                        </ul>

                        <router-link :to="{ name: 'test',params: {id: this.id} }"
                                     class="primary-btn text-uppercase enroll "
                                     v-bind:class="{ 'isDisabled': !isFinished }">{{texts.test}}
                        </router-link>


                        <div class="content">
                            <div class="review-top row pt-40">
                                <div class="col-lg-12">
                                    <h6 class="mb-15"></h6>
                                    <div class="d-flex flex-row reviews justify-content-between">
                                        <span>{{texts.rate}}</span>
                                        <div class="star">
                                            <i class="fa fa-star" :id="item.id" v-on:click="raiting"
                                               v-bind:class="{ checked: isActive }" v-for="(item, key) in objects"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feedeback">
                                <h6>{{texts.feedback}}{{feedbacksuccess}}</h6>
                                <form @submit.prevent="sendcomment">
                                    <textarea name="feedback" class="form-control" ref="feedback" cols="10" rows="10"
                                              id="feedback" v-model="feedback"></textarea>
                                    <div class="mt-10 text-right">
                                        <button class="primary-btn text-right text-uppercase comment">
                                            {{texts.send}}
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
    import {getPromiseResult} from '../partials/help';
    import texts from './json/course.json';
    import {Hooper, Pagination as HooperPagination, Slide} from 'hooper';
    import 'hooper/dist/hooper.css';

    export default {
        data() {
            return {
                id: '',
                // book: '/css/frontend/img/ekg.png',
                video_info: [],
                books: [],
                feedback: '',
                datas: [],
                specialites: [],
                courseimg: '/css/frontend/img/courses/course-details.jpg',
                videoimg: '/css/frontend/img/blog/cat-post/cat-post-3.jpg',
                docs: [],
                texts: texts,
                feedbacksuccess: '',
                isActive: false,
                objects: [
                    {id: 1},
                    {id: 2},
                    {id: 3},
                    {id: 4},
                    {id: 5}

                ],
                isFinished: 0
            };
        },
        computed: {
            currentUser: function () {
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            }
        },
        components: {
            Hooper,
            Slide, HooperPagination
        },
        methods: {
            manageEvents(id, index) {
                this.$nextTick(() => {
                    let credentials = {
                        id: id,
                        token: this.currentUser.token,
                        url: 'videoinfo',
                        auth: true
                    };
                    getPromiseResult(credentials)
                        .then(res => {
                            if (res.video.status === "progress" || !res.video) {
                                let _this = this;
                                if (_this.$refs.video) {
                                    let supposedCurrentTime = 0, backTime = 0;
                                    let video = _this.$refs.video[index], isPlay = true;

                                    video.addEventListener('play', function () {
                                        if (isPlay) {
                                            video.currentTime = res.video.point;
                                            supposedCurrentTime = res.video.point;
                                            isPlay = false;
                                        }
                                    });

                                    video.addEventListener('timeupdate', function () {
                                        if (!video.seeking) {
                                            supposedCurrentTime = video.currentTime;
                                        } else
                                            backTime = video.currentTime;
                                    });

                                    video.addEventListener('seeking', function () {
                                        console.log('seeking', video.currentTime);
                                        let back = backTime - supposedCurrentTime;
                                        if (back < 0) {
                                            supposedCurrentTime = backTime;
                                        } else {
                                            let delta = video.currentTime - supposedCurrentTime;
                                            if (Math.abs(delta) > 0.01) {
                                                console.log("Seeking is disabled");
                                                video.currentTime = supposedCurrentTime;
                                            }
                                        }
                                    });

                                    video.addEventListener('pause', () => {
                                        // video.currentTime = supposedCurrentTime;
                                        _this.addPoint(id, video.currentTime);
                                    });

                                    video.addEventListener('ended', function () {
                                        console.log('ended', id);
                                        _this.addPoint(id, video.currentTime);
                                    });
                                }
                            }
                        })
                        .catch(error => {
                            this.$store.commit("getContentFailed", {error});
                        });
                });
            },
            addPoint(id, point) {
                let credentials = {
                    id: id,
                    user_id: this.currentUser.id,
                    token: this.currentUser.token,
                    point: point,
                    url: "addpoint",
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                    })
                    .catch(error => {
                        console.log('error');
                        // this.$store.commit("registerFailed", {error});
                    })
            },
            finishedVideo() {
                let credentials = {
                    id: this.$route.params.id,
                    user_id: this.currentUser.id,
                    token: this.currentUser.token,
                    url: 'finishedvideo',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.isFinished = res;

                    })
                    .catch(error => {
                        console.log('error', error);
                        // this.$store.commit("registerFailed", {error});
                    })
            },
            coursedetails: function () {
                let credentials = {
                    id: this.$route.params.id,
                    token: this.currentUser.token,
                    url: 'coursedetails',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {

                        this.datas = res.data;
                        this.datas.credit = JSON.parse(res.data.credit);
                        this.video_info = JSON.parse(res.data.videos);
                        this.books = JSON.parse(res.data.books);
                        this.specialites = res.specialities;
                        this.id = res.data.id;
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
            },
            creditName:function (name) {
                let hy_name = '';
                switch (name) {
                    case 'theoretical':
                        hy_name =texts.theoretical;
                        break;
                        case 'practical':
                        hy_name =texts.practical;
                        break;
                        case 'selfeducation':
                        hy_name =texts.selfeducation;
                        break;
                }
                return hy_name;
            }
        },
        beforeMount() {
            this.coursedetails();
            this.finishedVideo();
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

    .isDisabled {
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
        pointer-events: none;
    }

</style>

