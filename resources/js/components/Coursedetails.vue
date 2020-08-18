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
         <section class="blog_categorie_area m-0 p-0">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-4">
                         <div class="categories_post">
                             <img :src="videoimg" alt="post">
                             <div class="categories_details">
                                 <div class="categories_text">
                                     <a href="blog-details.html">
                                         <h5>Video 1</h5>
                                     </a>
                                     <div class="border_line"></div>
                                     <p>Enjoy your social life together</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-4">
                         <div class="categories_post">
                             <img :src="videoimg" alt="post">
                             <div class="categories_details">
                                 <div class="categories_text">
                                     <a href="blog-details.html">
                                         <h5>Video 2</h5>
                                     </a>
                                     <div class="border_line"></div>
                                     <p>Be a part of politics</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-4">
                         <div class="categories_post">
                             <img :src="videoimg" alt="post">
                             <div class="categories_details">
                                 <div class="categories_text">
                                     <a href="blog-details.html">
                                         <h5>Video 3</h5>
                                     </a>
                                     <div class="border_line"></div>
                                     <p>Let the food be finished</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
         <!--================Blog Categorie Area =================-->

         <!--================ Start Course Details Area =================-->
         <section class="course_details_area section_gap">
             <div class="container" v-for="course in datas" :key="course.id">
                 <div class="col-lg-12 m-0 pb-5"><h2 class="or"> {{course.name}}</h2></div>
                 <div class="row" >
                     <div class="col-lg-8 course_details_left" >
                         <div class="main_image">
                             <img class="img-fluid" :src='courseimg' alt="">
                         </div>
                         <div class="content_wrapper">
                             <h4 class="title">{{coursetexts.content}}</h4>
                             <div class="content">
                                 {{course.content}}
                             </div>
                         </div>
                     </div>

                     <div class="col-lg-4 right-contents">
                         <ul>
                             <li v-if="course.status=='active'">
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>{{coursetexts.status}} </p>
                                     <span class="or" > {{coursetexts.status_active}}</span>
                                 </a>
                             </li>
                             <li>
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>{{coursetexts.credit}}</p>
                                     <span>{{course.credit}}</span>
                                 </a>
                             </li>
                             <li>
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>{{coursetexts.duration}} </p>
                                     <span>{{course.duration_date}}</span>
                                 </a>
                             </li>
                             <li>
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>{{coursetexts.coursecost}} </p>
                                     <span>{{course.cost}} AMD</span>
                                 </a>
                             </li>
                             <li v-for="speciality in specialites" :key="speciality.id">
                                 <a class="justify-content-between d-flex flex-wrap" href="#">
                                     <p>{{coursetexts.specialities}} </p>

                                     <p  >{{speciality.name}}<br/></p>
                                 </a>
                             </li>
                         </ul>
                         <a href="#" class="primary-btn text-uppercase enroll">{{coursetexts.paid}}</a>


                         <div class="content">
                             <div class="review-top row pt-40">
                                 <div class="col-lg-12">
                                     <h6 class="mb-15"></h6>
                                     <div class="d-flex flex-row reviews justify-content-between">
                                         <span>Գնահատել</span>
                                         <div class="star">
                                             <i class="fa fa-star" :id="item.id" v-on:click="raiting" v-bind:class="{ checked: isActive }" v-for="(item, key) in objects"></i>

                                         </div>
                                     </div>
                                 </div>
                     </div>
                             <div class="feedeback">
                                 <h6>{{coursetexts.feedback}}{{feedbacksuccess}}</h6>
                                 <form @submit.prevent="sendcomment" >
                                 <textarea name="feedback" class="form-control" ref="feedback" cols="10" rows="10" id="feedback" v-model="feedback"></textarea>
                                 <div class="mt-10 text-right">
                                     <button class="primary-btn text-right text-uppercase comment">{{coursetexts.send}}</button>
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
    import {getCourseDetails} from '../partials/courses';
    import coursetexts from './json/course.json'
    export default {
        data() {
            return {
                feedback:'',
                datas: [],
                specialites: [],
                courseimg:'/css/frontend/img/courses/course-details.jpg',
                videoimg:'/css/frontend/img/blog/cat-post/cat-post-3.jpg',
                docs: [],
                coursetexts: coursetexts,
                feedbacksuccess:'',
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
        methods:{
           coursedetails: function() {
                getCourseDetails(this.$route.params.id)
                 .then(res => {
                     this.datas = res.data;
                     this.specialites = res.specialities;
                     console.log(res.specialities);

             })
                 .catch(error => {
                     console.log('error');
                    // this.$store.commit("registerFailed", {error});
                 })
                },
            raiting: function (event) {

                  var loop_count = 5 - parseInt(event.currentTarget.id);


                    for( var j = event.currentTarget.id; j >= event.currentTarget.id; j--) {
                        var ss = j.toString();
                        if (document.getElementById(ss).classList.contains('checked')) {


                             document.getElementById(ss).classList.remove("checked");
                         }
                        event.currentTarget.classList.remove("checked");

                    }


                if (!event.currentTarget.classList.contains('checked')) {
                     for( var i = 1; i <= parseInt(event.currentTarget.id); i++) {
                        event.currentTarget.classList.add("checked");
                        var s = i.toString();
                        document.getElementById(s).classList.add("checked");

                    }
                }
            },
            sendcomment:function(){
               // if(this.feedback != ''){
                    //console.log(this.$refs.feedback.text);
                    let user = JSON.parse(localStorage.getItem('user'));
                   // this.feedback = this.$refs.feedback.text;
                    axios.post('/api/comment/', {
                        comment: feedback.value ,
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

          beforeMount(){
            this.coursedetails();

         },
  }

</script>
<style>
    .home_banner_area {
        min-height: 234px;
    }
</style>

