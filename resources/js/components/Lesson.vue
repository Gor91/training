<template>
    <div class="container-fluid">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">
                                <div :key="b.to" class="page_link" v-for="b in $route.meta.breadCrumbs">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{text.main}}</router-link>
                                    <router-link class="nav-link" to="">{{b.text}}</router-link>

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
                    <div :key="course.id" class="col-lg-4" v-for="course in courses">
                        <div class="categories_post">
                            <!--<img :src="image_src" alt="post">-->
                            <div class="categories_details">
                                <div class="categories_text">
                                    <div v-if="!currentUser">
                                        <p>{{course.name}}</p>
                                    </div>
                                    <div v-else>
                                        <template v-if="!isOpened && course.account_course === null">
                                            <p>{{course.name}}</p>
                                        </template>

                                        <template v-else>
                                            <router-link :to="'/coursedetails/'+course.id" class="nav-link"><p>
                                                {{course.name}}</p></router-link>
                                        </template>
                                    </div>
                                    <div v-if="!currentUser">
                                        <div class="border_line yellow"></div>
                                        <span class="fa fa-lock yellow"></span>
                                        <div class='d-flex justify-content-center'>
                                            <router-link class="nav-link" to="/login">{{texts.login}}</router-link>
                                            <p class="nav-link">կամ</p>

                                            <router-link class="nav-link" to="/register"> {{text.register}}
                                            </router-link>

                                        </div>
                                    </div>
                                    <div v-else>
                                        <div v-if="!isOpened && course.account_course === null">
                                            <div class="border_line yellow"></div>
                                            <span class="fa fa-lock yellow"></span>
                                            <div class='d-flex justify-content-center'>
                                                <div>
                                                    <button id="show-modal" class="text-uppercase enroll nav-link btn"
                                                            @click="eventClick(course)">{{texts.pay}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- single course -->
                        <div class="row" v-if="currentUser">
                            <div class="col-lg-12 col-md-12">
                                <div class="single_course">
                                    <div class="course_content">
                                        <div class="course_meta d-flex justify-content-between">
                                            <div>
                                    <span class="meta_info">
                                        <a href="#">
                                            <i class="fa fa-user-o yellow"></i>355
                                        </a>
                                    </span>

                                            </div>
                                            <div>
                                                <span ref="price" class="price">{{course.cost}} AMD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="showModal">
                <transition name="modal">
                    <div class="modal-mask">
                        <div class="modal-wrapper">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" @click="showModal=false">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="payment">
                                            <div class="card-form wrapper">
                                                <div class="col-lg-6 ">
                                                    <div class="card-item justify-content-center"
                                                         v-bind:class="{ '-active' : isCardFlipped }">
                                                        <div class="card-item__side -front ">
                                                            <div class="card-item__focus"
                                                                 v-bind:class="{'-active' : focusElementStyle }"
                                                                 v-bind:style="focusElementStyle"
                                                                 ref="focusElement"></div>
                                                            <div class="card-item__cover">
                                                                <img
                                                                        v-bind:src="'images/cards/' + currentCardBackground + '.jpeg'"
                                                                        class="card-item__bg ">
                                                            </div>

                                                            <div class="card-item__wrapper">
                                                                <div class="card-item__top">
                                                                    <img v-bind:src="'images/cards/chip.png'"
                                                                         class="card-item__chip">
                                                                    <div class="card-item__type">
                                                                        <transition name="slide-fade-up">
                                                                            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'"
                                                                                 v-if="getCardType"
                                                                                 v-bind:key="getCardType"
                                                                                 alt=""
                                                                                 class="card-item__typeImg">
                                                                        </transition>
                                                                    </div>
                                                                </div>
                                                                <label for="cardNumber" class="card-item__number"
                                                                       ref="cardNumber">
                                                                    <template v-if="getCardType === 'amex'">
                 <span v-for="(n, $index) in amexCardMask" :key="$index">
                  <transition name="slide-fade-up">
                    <div
                            class="card-item__numberItem"
                            v-if="$index > 4 && $index < 14 && formCard.number.length > $index && n.trim() !== ''"
                    >*</div>
                    <div class="card-item__numberItem"
                         :class="{ '-active' : n.trim() === '' }"
                         :key="$index" v-else-if="formCard.number.length > $index">
                      {{formCard.number[$index]}}
                    </div>
                    <div
                            class="card-item__numberItem"
                            :class="{ '-active' : n.trim() === '' }"
                            v-else
                            :key="$index + 1"
                    >{{n}}</div>
                  </transition>
                </span>
                                                                    </template>

                                                                    <template v-else>
                  <span v-for="(n, $index) in otherCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div
                              class="card-item__numberItem"
                              v-if="$index > 4 && $index < 15 && formCard.number.length > $index && n.trim() !== ''"
                      >*</div>
                      <div class="card-item__numberItem"
                           :class="{ '-active' : n.trim() === '' }"
                           :key="$index" v-else-if="formCard.number.length > $index">
                        {{formCard.number[$index]}}
                      </div>
                      <div
                              class="card-item__numberItem"
                              :class="{ '-active' : n.trim() === '' }"
                              v-else
                              :key="$index + 1"
                      >{{n}}</div>
                    </transition>
                  </span>
                                                                    </template>
                                                                </label>
                                                                <div class="card-item__content">
                                                                    <label for="cardName" class="card-item__info"
                                                                           ref="cardName">
                                                                        <div class="card-item__holder">{{text.holder}}
                                                                        </div>
                                                                        <transition name="slide-fade-up">
                                                                            <div class="card-item__name"
                                                                                 v-if="formCard.name.length" key="1">
                                                                                <transition-group
                                                                                        name="slide-fade-right">
                                                    <span class="card-item__nameItem"
                                                          v-for="(n, $index) in formCard.name.replace(/\s\s+/g, ' ')"
                                                          v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                                                                                </transition-group>
                                                                            </div>
                                                                            <div class="card-item__name" v-else key="2">
                                                                                {{text.fullname}}
                                                                            </div>
                                                                        </transition>
                                                                    </label>
                                                                    <div class="card-item__date" ref="cardDate">
                                                                        <label for="cardMonth"
                                                                               class="card-item__dateTitle">{{text.expire}}</label>
                                                                        <label for="cardMonth"
                                                                               class="card-item__dateItem">
                                                                            <transition name="slide-fade-up">
                                                                            <span v-if="formCard.month"
                                                                                  v-bind:key="formCard.month">{{formCard.month}}</span>
                                                                                <span v-else key="2">Ա</span>
                                                                            </transition>
                                                                        </label>/
                                                                        <label for="cardYear"
                                                                               class="card-item__dateItem">
                                                                            <transition name="slide-fade-up">
                                                                            <span v-if="formCard.year"
                                                                                  v-bind:key="formCard.year">{{String(formCard.year).slice(2,4)}}</span>
                                                                                <span v-else key="2">Տ</span>
                                                                            </transition>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-item__side -back">
                                                            <div class="card-item__cover">
                                                                <img v-bind:src="'/images/cards/' + currentCardBackground + '.jpeg'"
                                                                     class="card-item__bg">
                                                            </div>
                                                            <div class="card-item__band"></div>
                                                            <div class="card-item__cvv">
                                                                <div class="card-item__cvvTitle">{{text.securitycode}}
                                                                </div>
                                                                <div class="card-item__cvvBand">
                  <span v-for="(n, $index) in formCard.cvv" :key="$index">
                    *
                  </span>

                                                                </div>
                                                                <div class="card-item__type">
                                                                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'"
                                                                         v-if="getCardType" class="card-item__typeImg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card-input form-group">
                                                        <label for="cardNumber" class="card-input__label">{{text.cardnumber}}</label>
                                                        <input type="text" id="cardNumber" class=" form-control"
                                                               v-mask="generateCardNumberMask"
                                                               v-model="formCard.number" v-on:focus="focusInput"
                                                               v-on:blur="blurInput" data-ref="cardNumber"
                                                               autocomplete="off">
                                                    </div>
                                                    <div class="card-input form-group">
                                                        <label for="cardName"
                                                               class="card-input__label">{{text.fullname}}</label>
                                                        <input type="text" id="cardName" class=" form-control"
                                                               v-model="formCard.name"
                                                               v-validate="'required'"
                                                               :class="{'input': true, 'is-invalid': errors.has('name') }"
                                                               v-on:focus="focusInput" v-on:blur="blurInput"
                                                               data-ref="cardName" autocomplete="off">
                                                        <span ref="name" v-show="errors.has('name')"
                                                              class="help is-danger">{{ errors.first('name') }}</span>
                                                    </div>
                                                    <div class="card-form__row">
                                                        <div class="card-form__col">
                                                            <div class="card-form__group form-group">
                                                                <label for="cardMonth" class="card-input__label">{{text.date_of_expire}}</label>
                                                                <select class="form-control " id="cardMonth"
                                                                        v-model="formCard.month"
                                                                        v-on:focus="focusInput" v-on:blur="blurInput"
                                                                        data-ref="cardDate">
                                                                    <option value="" disabled selected>{{text.month}}
                                                                    </option>
                                                                    <option v-bind:value="n < 10 ? '0' + n : n"
                                                                            v-for="n in 12"
                                                                            v-bind:disabled="n < minCardMonth"
                                                                            v-bind:key="n">
                                                                        {{n < 10 ? '0' + n : n}}
                                                                    </option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="card-form__col">
                                                            <div class="card-form__group form-group">
                                                                <label for="cardMonth" class="card-input__label">{{text.date_of_expire}}</label>

                                                                <select class="form-control " id="cardYear"
                                                                        v-model="formCard.year"
                                                                        v-validate="'required'"
                                                                        v-on:focus="focusInput" v-on:blur="blurInput"
                                                                        data-ref="cardDate">
                                                                    <option value="" disabled selected>{{text.year}}
                                                                    </option>
                                                                    <option v-bind:value="$index + minCardYear"
                                                                            v-for="(n, $index) in 12"
                                                                            v-bind:key="n">
                                                                        {{$index + minCardYear}}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="card-form__col ">
                                                            <div class="card-input form-group">
                                                                <label for="cardCvv" class="card-input__label">{{text.security}}</label>
                                                                <input type="text" class=" form-control" id="cardCvv"
                                                                       v-mask="'####'"
                                                                       maxlength="4"
                                                                       v-validate="'required|size:4'"
                                                                       v-model="formCard.cvv"
                                                                       v-on:focus="flipCard(true)"
                                                                       v-on:blur="flipCard(false)"
                                                                       autocompletenumber="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-form__row">
                                                        <div class="card-form__col ">
                                                            <div class="card-input form-group">
                                                                <label for="cardCost" class="card-input__label">{{text.cost}}</label>
                                                                <input type="text" class=" form-control" id="cardCost"
                                                                       v-model="cost" readonly>
                                                                <input type="hidden" v-model="course_id">
                                                            </div>
                                                        </div>
                                                        <div class="card-form__col ">
                                                            <div class="card-input form-group">
                                                                <button class="primary-btn" type="submit">
                                                                    {{text.pay}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </section>
        <!--================Blog Categorie Area =================-->
    </div>
</template>

<script>
    import {getPromiseResult} from '../partials/help';
    import pagetexts from './json/pages.json'
    import text from './json/registertexts.json';
    import {mask} from '@titou10/v-mask';

    export default {
        name: "paymentForm",
        data() {
            return {
                courses: [],
                image_src: '/css/frontend/img/background.png',
                texts: pagetexts,
                isOpened: false,
                showModal: false,
                currentCardBackground: Math.floor(Math.random() * 9 + 1), // just for fun :D
                formCard: {
                    name: "",
                    number: "",
                    month: "",
                    year: "",
                    cvv: "",
                },
                minCardYear: new Date().getFullYear(),
                amexCardMask: "#### ###### #####",
                otherCardMask: "#### #### #### ####",
                cardNumberTemp: "",
                isCardFlipped: false,
                focusElementStyle: null,
                isInputFocused: false,
                text: text,
                cost: "",
                course_id: ""
            }
        },
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            },
            eventClick: function (e) {
                this.cost = e.cost;
                this.course_id = e.id;
                this.showModal = true;
            },
            allcourses: function () {
                let credentials = {
                    url: 'allcourses',
                    auth: false
                };
                getPromiseResult(credentials)
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
                    token: this.currentUser.token,
                    url: 'getcoursebyspec',
                    auth: true
                };
                getPromiseResult(credentials)
                    .then(res => {
                        this.courses = res.courses;
                    })
                    .catch(err => {
                    })
            },
            flipCard(status) {
                this.isCardFlipped = status;
            },
            focusInput(e) {
                this.isInputFocused = true;
                let targetRef = e.target.dataset.ref;
                let target = this.$refs[targetRef];
                this.focusElementStyle = {
                    width: `${target.offsetWidth}px`,
                    height: `${target.offsetHeight}px`,
                    transform: `translateX(${target.offsetLeft}px) translateY(${target.offsetTop}px)`
                }
            },
            blurInput() {
                let vm = this;
                setTimeout(() => {
                    if (!vm.isInputFocused) {
                        vm.focusElementStyle = null;
                    }
                }, 300);
                vm.isInputFocused = false;
            },
            payment() {
                // this.$validator.validateAll().then((result) => {
                //     if (result) {
                //         console.log('Form Submitted!');
                //         return;
                //     }
                //     console.log('Correct them errors!');
                // });
                let data = {};
                data.cvv = btoa(this.formCard.cvv);
                data.number = btoa(this.formCard.number);
                data.name = this.formCard.cvv;
                data.month = this.formCard.month;
                data.year = this.formCard.year;
                data.account_id = this.currentUser.id;
                data.course_id = this.course_id;
                data.cost = this.cost;

                let credentials = {
                    account_id: this.currentUser.id,
                    token: this.currentUser.token,
                    form: data,
                    url: "payment",
                    auth: true
                };

                getPromiseResult(credentials)
                    .then(res => {
                    })
                    .catch(error => {
                        console.log('error');
                        // this.$store.commit("registerFailed", {error});
                    })
            }
        },
        computed: {
            currentUser: function () {
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            },
            getCardType() {
                let number = this.formCard.number;

                let re = new RegExp("^4");
                if (number.match(re) != null) return "visa";

                re = new RegExp("^(34|37)");
                if (number.match(re) != null) return "amex";

                re = new RegExp("^5[1-5]");
                if (number.match(re) != null) return "mastercard";

                // re = new RegExp("^6011");
                // if (number.match(re) != null) return "discover";
                //
                re = new RegExp('^90')
                if (number.match(re) != null) return 'troy'

                return "visa"; // default type
            },
            generateCardNumberMask() {
                return this.getCardType === "amex" ? this.amexCardMask : this.otherCardMask;
            },
            minCardMonth() {
                if (this.formCard.number === this.minCardYear) return new Date().getMonth() + 1;
                return 1;
            },

        },

        beforeMount() {
            if (!this.$store.getters.currentUser) {
                this.allcourses();
            } else {
                this.getCourses(this.$store.getters.currentUser.id);

                if (this.$store.getters.currentUser.prof.member_of_palace === 1)
                    this.isOpened = true;
            }
        },
        mounted() {
            this.cardNumberTemp = this.otherCardMask;
            // document.getElementById("cardNumber").focus();
        },
        watch: {
            cardYear() {
                if (this.formCard.month < this.minCardMonth) {
                    this.formCard.month = "";
                }
            }
        },
        directives: {
            mask
        }
    }
</script>

<style>
    .modal-dialog {
        max-width: 70% !important;
    }
</style>

