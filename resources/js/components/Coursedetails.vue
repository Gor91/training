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
                 <div class="row" >
                     <div class="col-lg-8 course_details_left" >
                         <div class="main_image">
                             <img class="img-fluid" :src='courseimg' alt="">
                         </div>
                         <div class="content_wrapper">
                             <h4 class="title">Objectives</h4>
                             <div class="content">
                                 When you enter into any new area of science, you almost always find yourself with a
                                 baffling new language of
                                 technical terms to learn before you can converse with the experts. This is certainly
                                 true in astronomy both in
                                 terms of terms that refer to the cosmos and terms that describe the tools of the trade,
                                 the most prevalent
                                 being the telescope.
                                 <br>
                                 <br>
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                 incididunt ut labore et dolore
                                 magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                 ut aliquip ex ea
                                 commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                 cillum. Lorem ipsum dolor sit
                                 amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                 dolore magna aliqua. Ut enim
                                 ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                 commodo consequat. Duis aute
                                 irure dolor in reprehenderit in voluptate velit esse cillum.
                             </div>

                             <h4 class="title">Eligibility</h4>
                             <div class="content">
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                 incididunt ut labore et dolore
                                 magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                 ut aliquip ex ea commodo
                                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                                 <br>
                                 <br>
                                 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                 incididunt ut labore et dolore
                                 magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                 ut aliquip ex ea
                                 commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                 cillum. Lorem ipsum dolor sit
                                 amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                 dolore magna aliqua. Ut enim
                                 ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                 commodo consequat. Duis aute
                                 irure dolor in reprehenderit in voluptate velit esse cillum.
                             </div>

                             <h4 class="title">Course Outline</h4>
                             <div class="content">
                                 <ul class="course_list">
                                     <li class="justify-content-between d-flex">
                                         <p>Introduction Lesson</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Basics of HTML</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Getting Know about HTML</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Tags and Attributes</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Basics of CSS</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Getting Familiar with CSS</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Introduction to Bootstrap</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Responsive Design</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>
                                     <li class="justify-content-between d-flex">
                                         <p>Canvas in HTML 5</p>
                                         <a class="primary-btn text-uppercase" href="#">View Details</a>
                                     </li>

                                 </ul>
                             </div>
                         </div>
                     </div>


                     <div class="col-lg-4 right-contents">
                         <ul>
                             <li>
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>Trainer’s Name</p>
                                     <span class="or">George Mathews</span>
                                 </a>
                             </li>
                             <li>
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>Credits</p>
                                     <span>{{course.credit}}</span>
                                 </a>
                             </li>
                             <li>
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>Available Seats </p>
                                     <span>15</span>
                                 </a>
                             </li>
                             <li>
                                 <a class="justify-content-between d-flex" href="#">
                                     <p>Schedule </p>
                                     <span>2.00 pm to 4.00 pm</span>
                                 </a>
                             </li>
                         </ul>
                         <a href="#" class="primary-btn text-uppercase enroll">Enroll the course</a>


                         <div class="content">
                             <div class="review-top row pt-40">
                                 <div class="col-lg-12">
                                     <h6 class="mb-15"></h6>
                                     <div class="d-flex flex-row reviews justify-content-between">
                                         <span>Գնահատել</span>
                                         <div class="star">
                                             <i class="fa fa-star checked"></i>
                                             <i class="fa fa-star checked"></i>
                                             <i class="fa fa-star checked"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                         </div>
                                     </div>
                                 </div>
                     </div>
                             <div class="feedeback">
                                 <h6>Your Feedback</h6>
                                 <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                                 <div class="mt-10 text-right">
                                     <a href="#" class="primary-btn text-right text-uppercase">Submit</a>
                                 </div>
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
    export default {
        data() {
            return {
                datas: [],
                courseimg:'/css/frontend/img/courses/course-details.jpg',
                videoimg:'/css/frontend/img/blog/cat-post/cat-post-3.jpg',
                docs: [],
            };
        },
        methods:{
           coursedetails: function() {
               console.log(this.$route.params.id);
                getCourseDetails(this.$route.params.id)
                 .then(res => {
                     this.datas = res.data;


             })
                 .catch(error => {
                     console.log('error');
                    // this.$store.commit("registerFailed", {error});
                 })
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

