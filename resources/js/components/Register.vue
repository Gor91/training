<template>
    <div class="login  justify-content-center container-fluid">
        <form @submit.prevent="register" class="row">
            <input type="radio" id="profile" value="1" name="tractor" checked='checked'>
            <input type="radio" id="address" value="2" name="tractor">
            <input type="radio" id="education" value="3" name="tractor">
            <!--            <input type="radio" id="register" value="4" name="tractor">-->
            <nav class="reg_nav">
                <label for="profile" class='fa fa-user-o nav_label col-lg-4'></label>
                <label for="address" class='fa fa-address-card-o nav_label col-lg-4'></label>
                <label for="education" class='fa fa-graduation-cap nav_label col-lg-4'></label>
                <!--                <label for="register" class='fa fa-list-alt nav_label'></label>-->
            </nav>

            <article class='bio container'>
                <div class="form-group row">
                    <p class="error col-12" v-if="regError">
                        {{regError}}
                    </p>
                    <div class="form-group  col-lg-4">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" class="form-control" v-validate="'required'"
                               :class="{'input': true, 'is-invalid': errors.has('name') }" v-model="formRegister.name">
                        <!--<i v-show="errors.has('name')" class="fa fa-warning"></i>-->
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>

                    </div>
                    <div class="form-group col-lg-4 ">
                        <label for="surname">Surname</label>
                        <input id="surname" type="text" name="surname" class="form-control "
                               :class="{'input': true, 'is-invalid': errors.has('surname') }"
                               v-validate="'required'" v-model="formRegister.surname">
                        <span v-show="errors.has('surname')" class="help is-danger">{{ errors.first('surname') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="father_name">Father Name</label>
                        <input id="father_name" type="text" name="father_name" class="form-control"
                               :class="{'input': true, 'is-invalid': errors.has('father_name') }"
                               v-validate="'required'"
                               v-model="formRegister.father_name">
                        <span v-show="errors.has('father_name')" class="help is-danger">{{ errors.first('father_name') }}</span>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="phone">Phone</label>
                        <input id="phone" type="text" name="phone"
                               class="form-control"
                               v-validate="'required'"
                               :class="{'input': true, 'is-invalid': errors.has('phone') }"
                               v-model="formRegister.phone">
                        <span v-show="errors.has('phone')" class="help is-danger">{{ errors.first('phone') }}</span>
                    </div>
                    <div class="form-group  col-lg-6">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control" v-validate="'required'"
                                v-model="formRegister.gender">
                            <option value="">Select a gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span v-if="errors.has('gender')" class="help is-danger" role="alert">{{ errors.first('gender') }}</span>
                    </div>
                    <div class="form-group  col-lg-6">
                        <label for="m_status">Married status</label>
                        <select id="m_status" name="m_status" class="form-control" v-validate="'required'"
                                v-model="formRegister.m_status">
                            <option value="">Select a status</option>
                            <option value="single">Single</option>
                            <option value="married">married</option>
                        </select>
                        <span v-if="errors.has('m_status')" class="help is-danger" role="alert">{{ errors.first('m_status') }}</span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="passport">Social number</label>
                        <input id="passport" type="text" name="passport"
                               class="form-control"
                               v-validate="'required'"
                               v-model="formRegister.passport">
                        <span v-if="errors.has('passport')" class="help is-danger" role="alert">{{ errors.first('passport') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="issue">Data of issue</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="issue"
                                          :format="customFormatter"   :class="{'input': true, 'is-invalid': errors.has('issue') }"
                                          name="issue" v-model="formRegister.issue"></vuejs-datepicker>

                        <span v-show="errors.has('issue')" class="help is-danger">{{ errors.first('issue') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="expiry">Data of Expiry</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="expiry" name="expiry"
                                          :format="customFormatter"   :class="{'input': true, 'is-invalid': errors.has('expiry') }"
                                          v-model="formRegister.expiry"></vuejs-datepicker>
                        <span v-show="errors.has('expiry')" class="help is-danger">{{ errors.first('expiry') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bday">Birthday</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="bday"
                                          :format="customFormatter"   :class="{'input': true, 'is-invalid': errors.has('bday') }"
                                          name="bday" v-model="formRegister.bday"></vuejs-datepicker>
                        <span v-show="errors.has('bday')" class="help is-danger">{{ errors.first('bdsy') }}</span>
                    </div>
                </div>
            </article>
            <article class='info container '>
                <div class="form-group row ">
                    <div class="form-group col-lg-12">
                        <label for="work_name">Name of the workplace</label>
                        <input id="work_name" type="text" name="work_name" class="form-control"
                               v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('work_name') }"
                               v-model="formRegister.work_name">
                        <span v-show="errors.has('work_name')" class="help is-danger">{{ errors.first('work_name') }}</span>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">Work Address </p>
                            <div class="form-group col-lg-4">
                                <label for="w_region">Region</label>
                                <select id="w_region" name="w_region" class="form-control"   :class="{'input': true, 'is-invalid': errors.has('w_region') }"
                                        v-validate="'required'"
                                        v-model="formRegister.w_region">
                                    <option value="">Select a region</option>
                                    <option value="1">Shirak</option>
                                    <option value="11">Lori</option>
                                </select>
                                <span v-show="errors.has('w_region')" class="help is-danger">{{ errors.first('w_region') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="w_city">City</label>
                                <select id="w_city" name="w_city" class="form-control" v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('w_city') }"
                                        v-model="formRegister.w_city">
                                    <option value="">Select a City</option>
                                    <option value="1">Shirak</option>
                                    <option value="11">Lori</option>
                                </select>
                                <span v-show="errors.has('w_city')" class="help is-danger">{{ errors.first('w_city') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="w_village">Village</label>
                                <select id="w_village" name="w_village" class="form-control"
                                        v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('w_village') }"
                                        v-model="formRegister.w_village">
                                    <option value="">Select a Village</option>
                                    <option value="1">vv</option>
                                    <option value="11">vvv</option>
                                </select>
                                <span v-show="errors.has('w_village')" class="help is-danger">{{ errors.first('w_village') }}</span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="w_street">Street</label>
                                <input id="w_street" type="text" name="w_street" class="form-control"
                                       v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('w_street') }"
                                       v-model="formRegister.w_street">
                                <span v-show="errors.has('w_street')" class="help is-danger">{{ errors.first('w_street') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">Home Address </p>
                            <div class="form-group col-lg-4">
                                <label for="h_region">Region</label>
                                <select id="h_region" name="h_region" class="form-control"
                                        v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('h_region') }"
                                        v-model="formRegister.h_region">
                                    <option value="">Select a region</option>
                                    <option value="1">Shirak</option>
                                    <option value="2">Lori</option>
                                </select>
                                <span v-show="errors.has('h_region')" class="help is-danger">{{ errors.first('h_region') }}</span>

                            </div>
                            <div class="form-group col-lg-4">
                                <label for="h_city">City</label>
                                <select id="h_city" name="h_city" class="form-control" v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('h_city') }"
                                        v-model="formRegister.h_city">
                                    <option value="">Select a City</option>
                                    <option value="1">Shirak</option>
                                    <option value="11">Lori</option>
                                </select>
                                <span v-show="errors.has('h_city')" class="help is-danger">{{ errors.first('h_city') }}</span>

                            </div>
                            <div class="form-group col-lg-4">
                                <label for="h_village">Village</label>
                                <select id="h_village" name="h_village" class="form-control"
                                        v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('h_village') }"
                                        v-model="formRegister.h_village">
                                    <option value="">Select a Village</option>
                                    <option value="1">Shirak</option>
                                    <option value="11">Lori</option>
                                </select>
                                <span v-show="errors.has('h_village')" class="help is-danger">{{ errors.first('h_village') }}</span>

                            </div>
                            <div class="form-group col-lg-12">

                                <label for="h_street">Street</label>
                                <input id="h_street" type="text" name="h_street" class="form-control"
                                       v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('h_street') }"
                                       v-model="formRegister.h_street">
                                <span v-show="errors.has('h_street')" class="help is-danger">{{ errors.first('h_street') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <article class='edu container'>
                <div class="form-group row">
                    <div class="form-group  col-lg-4">
                        <label for="prof">Professin</label>
                        <select id="prof" name="prof" class="form-control" v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('prof') }"
                                v-model="formRegister.prof">
                            <option value="">Select a prof</option>
                            <option value="doctor">բժիշկ</option>
                            <option value="nurse">բուժ․ քույր</option>
                            <option value="pharmacist">դեղագործ</option>
                            <option value="provider">դեղագետ</option>
                        </select>
                        <span v-show="errors.has('prof')" class="help is-danger">{{ errors.first('prof') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="edu">Education</label>
                        <select id="edu" name="edu" class="form-control" v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('edu') }"
                                v-model="formRegister.edu">
                            <option value="">Select a Education</option>
                            <option value="1">բժիշկ</option>
                            <option value="2">բուժ․ քույր</option>
                            <option value="3">դեղագործ</option>
                            <option value="4">դեղագետ</option>
                        </select>
                        <span v-show="errors.has('edu')" class="help is-danger">{{ errors.first('edu') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="specialty">Specialty</label>
                        <select id="specialty" name="specialty" class="form-control" v-validate="'required'"   :class="{'input': true, 'is-invalid': errors.has('specialty') }"
                                v-model="formRegister.specialty">
                            <option value="">Select a specialty</option>
                            <option value="1">բժիշկ</option>
                            <option value="2">բուժ․ քույր</option>
                            <option value="3">դեղագործ</option>
                            <option value="4">դեղագետ</option>
                        </select>
                        <span v-show="errors.has('specialty')" class="help is-danger">{{ errors.first('specialty') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <div class="confirm-switch">
                            <input type="checkbox" id="confirm-switch"   :class="{'input': true, 'is-invalid': errors.has('palace') }"
                                   checked="" name="palace" class="form-control"
                                   v-validate="'required'" v-model="formRegister.palace">
                            <label for="confirm-switch">Member if palace</label>
                        </div>
                        <span v-show="errors.has('palace')" class="help is-danger">{{ errors.first('palace') }}</span>
                    </div>
                    <!--<div class="form-group  col-lg-12">-->
                    <!--<div v-if="!image">-->
                    <!--<label for="diploma">Member if palace</label>-->
                    <!--<input type="file" @change="onFileChange" id="diploma" name="diploma[]" class="form-control"-->
                    <!--multiple="multiple" v-validate="'required'">-->
                    <!--<span v-if="errors.has('diploma')" class="help is-danger"-->
                    <!--role="alert">{{ errors.first('diploma') }}</span>-->
                    <!--</div>-->
                    <!--<div v-else>-->
                    <!--<img :src="image"/>-->
                    <!--<button @click="removeImage">Remove image</button>-->
                    <!--</div>-->
                    <!--&lt;!&ndash;                            <span v-if="errors.has('diploma')" class="help is-danger" role="alert">{{ errors.first('diploma') }}</span>&ndash;&gt;-->
                    <!--</div>-->
                    <div class="form-group  col-lg-4">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" v-validate="'required|email'"   :class="{'input': true, 'is-invalid': errors.has('email') }"
                               class="form-control" v-model="formRegister.email" placeholder="Email address">
                        <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control"
                               v-validate="'required|min:6'" v-model="formRegister.password"   :class="{'input': true, 'is-invalid': errors.has('password') }"
                               placeholder="password">
                        <span v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="re_password">Confirm Password</label>
                        <input id="re_password" type="password" name="re_password" class="form-control"   :class="{'input': true, 'is-invalid': errors.has('re_password') }"
                               v-validate="'required|min:6'" v-model="formRegister.re_password">
                        <span v-show="errors.has('re_password')" class="help is-danger">{{ errors.first('re_password') }}</span>
                    </div>

                    <footer class="form-group col-lg-4">
                        <input type="submit" value="Register" class="btn btn-outline-primary ml-auto">

                    </footer>
                </div>
            </article>

        </form>
    </div>
</template>

<script>
    import {registerUser} from '../partials/auth';
    import Datepicker from 'vuejs-datepicker';
    import * as moment from 'moment';

    export default {
        data() {
            return {
                formRegister: {
                    name: '',
                    surname: '',
                    father_name: '',
                    gender: '',
                    phone: '',
                    bday: '',
                    passport: '',
                    expiry: '',
                    issue: '',
                    m_status: '',
                    work_name: '',
                    h_region: '',
                    w_region: '',
                    h_city: '',
                    w_city: '',
                    w_village: '',
                    h_village: '',
                    w_street: '',
                    h_street: '',
                    prof: '',
                    specialty: '',
                    edu: '',
                    palace: '',
                    diploma: '',
                    image: '',
                    email: '',
                    password: '',
                    re_password: ''
                },
                error: null,
                moment: moment
            }
        },
        methods: {
            register() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log('Form Submitted!');
                        return;
                    }
                    console.log('Correct them errors!');
                });
                registerUser(this.$data.formRegister)
                    .then(res => {
                        this.$store.commit("registerSuccess", res);
                        this.$router.push({path: '/login'});
                    })
                    .catch(error => {
                        this.$store.commit("registerFailed", {error});
                    })
            },
            customFormatter(date) {
                return moment(date, 'YYYY-MM-DD').format('DD.MM.YYYY');
            },
            onFileChange(e) {
                let files = e.target.files
                    || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let image = new Image();
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            }
        },
        computed: {
            regError() {
                // console.log(this.$store.getters.regError);
                return this.$store.getters.regError
            }
        },
        components: {
            'vuejs-datepicker': Datepicker
        }
    }
</script>

<style scoped>
    .error {
        text-align: center;
        color: red;
    }

    .is-danger,.fa-warning {
        color: red;
    }

</style>