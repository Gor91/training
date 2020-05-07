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
                    <p class="error" v-if="regError">
                        {{regError}}
                    </p>
                    <div class="form-group  col-lg-4">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" class="form-control" v-validate="'required'"
                               v-model="formRegister.name">
                        <span v-if="errors.has('name')" class="invalid-feedback"
                              role="alert">{{ errors.first('name') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="surname">Surname</label>
                        <input id="surname" type="text" name="surname" class="form-control"
                               v-validate="'required'" v-model="formRegister.surname">
                        <span v-if="errors.has('surname')" class="invalid-feedback" role="alert">{{ errors.first('surname') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="father_name">Father Name</label>
                        <input id="father_name" type="text" name="father_name" class="form-control"
                               v-validate="'required'"
                               v-model="formRegister.father_name">
                        <span v-if="errors.has('father_name')" class="invalid-feedback" role="alert">{{ errors.first('father_name') }}</span>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="phone">Phone</label>
                        <input id="phone" type="text" name="phone"
                               class="form-control"
                               v-validate="'required'"
                               v-model="formRegister.phone">
                        <span v-if="errors.has('phone')" class="invalid-feedback"
                              role="alert">{{ errors.first('phone') }}</span>
                    </div>
                    <div class="form-group  col-lg-6">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control" v-validate="'required'"
                                v-model="formRegister.gender">
                            <option value="">Select a gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span v-if="errors.has('gender')" class="invalid-feedback" role="alert">{{ errors.first('gender') }}</span>
                    </div>
                    <div class="form-group  col-lg-6">
                        <label for="m_status">Married status</label>
                        <select id="m_status" name="m_status" class="form-control" v-validate="'required'"
                                v-model="formRegister.m_status">
                            <option value="">Select a status</option>
                            <option value="single">Single</option>
                            <option value="married">married</option>
                        </select>
                        <span v-if="errors.has('m_status')" class="invalid-feedback" role="alert">{{ errors.first('m_status') }}</span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="passport">Social number</label>
                        <input id="passport" type="text" name="passport"
                               class="form-control"
                               v-validate="'required'"
                               v-model="formRegister.passport">
                        <span v-if="errors.has('passport')" class="invalid-feedback" role="alert">{{ errors.first('passport') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="issue">Data of issue</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="issue"
                                          name="issue"  v-model="formRegister.issue"></vuejs-datepicker>

                        <span v-if="errors.has('issue')" class="invalid-feedback" role="alert">{{ errors.first('issue') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="expiry">Data of Expiry</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="expiry" name="expiry"
                                          v-model="formRegister.expiry"></vuejs-datepicker>
                        <span v-if="errors.has('expiry')" class="invalid-feedback" role="alert">{{ errors.first('expiry') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bday">Birthday</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="bday"
                                     name="bday"  v-model="formRegister.bday"></vuejs-datepicker>

                        <span v-if="errors.has('bday')" class="invalid-feedback"
                              role="alert">{{ errors.first('bday') }}</span>
                    </div>
                </div>
            </article>
            <article class='info container '>
                <div class="form-group row ">
                    <div class="form-group col-lg-12">
                        <label for="work_name">Name of the workplace</label>
                        <input id="work_name" type="text" name="work_name" class="form-control"
                               v-validate="'required'"
                               v-model="formRegister.work_name">
                        <span v-if="errors.has('work_name')" class="invalid-feedback" role="alert">{{ errors.first('work_name') }}</span>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">Work Address </p>
                            <div class="form-group col-lg-4">
                                <label for="v_region">Region</label>
                                <select id="v_region" name="v_region" class="form-control"
                                        v-validate="'required'"
                                        v-model="formRegister.v_region">
                                    <option value="">Select a region</option>
                                    <option value="single">Shirak</option>
                                    <option value="married">Lori</option>
                                </select>
                                <span v-if="errors.has('v_region')" class="invalid-feedback" role="alert">{{ errors.first('v_region') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="v_city">City</label>
                                <select id="v_city" name="v_city" class="form-control" v-validate="'required'"
                                        v-model="formRegister.v_city">
                                    <option value="">Select a City</option>
                                    <option value="single">Shirak</option>
                                    <option value="married">Lori</option>
                                </select>
                                <span v-if="errors.has('v_city')" class="invalid-feedback" role="alert">{{ errors.first('v_city') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="v_village">Village</label>
                                <select id="v_village" name="v_village" class="form-control"
                                        v-validate="'required'"
                                        v-model="formRegister.h_village">
                                    <option value="">Select a Village</option>
                                    <option value="single">Shirak</option>
                                    <option value="married">Lori</option>
                                </select>
                                <span v-if="errors.has('h_village')" class="invalid-feedback" role="alert">{{ errors.first('h_village') }}</span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="v_street">Street</label>
                                <input id="v_street" type="text" name="v_street" class="form-control"
                                       v-validate="'required'"
                                       v-model="formRegister.v_street">
                                <span v-if="errors.has('v_street')" class="invalid-feedback" role="alert">{{ errors.first('v_street') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">Home Address </p>
                            <div class="form-group col-lg-4">
                                <label for="h_region">Region</label>
                                <select id="h_region" name="h_region" class="form-control"
                                        v-validate="'required'"
                                        v-model="formRegister.h_region">
                                    <option value="">Select a region</option>
                                    <option value="single">Shirak</option>
                                    <option value="married">Lori</option>
                                </select>
                                <span v-if="errors.has('h_region')" class="invalid-feedback" role="alert">{{ errors.first('h_region') }}</span>

                            </div>
                            <div class="form-group col-lg-4">
                                <label for="h_city">City</label>
                                <select id="h_city" name="h_city" class="form-control" v-validate="'required'"
                                        v-model="formRegister.h_city">
                                    <option value="">Select a City</option>
                                    <option value="single">Shirak</option>
                                    <option value="married">Lori</option>
                                </select>
                                <span v-if="errors.has('h_city')" class="invalid-feedback" role="alert">{{ errors.first('h_city') }}</span>

                            </div>
                            <div class="form-group col-lg-4">
                                <label for="h_village">Village</label>
                                <select id="h_village" name="h_village" class="form-control"
                                        v-validate="'required'"
                                        v-model="formRegister.h_village">
                                    <option value="">Select a Village</option>
                                    <option value="single">Shirak</option>
                                    <option value="married">Lori</option>
                                </select>
                                <span v-if="errors.has('h_village')" class="invalid-feedback" role="alert">{{ errors.first('h_village') }}</span>

                            </div>
                            <div class="form-group col-lg-12">

                                <label for="h_street">Street</label>
                                <input id="h_street" type="text" name="h_street" class="form-control"
                                       v-validate="'required'"
                                       v-model="formRegister.h_street">
                                <span v-if="errors.has('h_street')" class="invalid-feedback" role="alert">{{ errors.first('h_street') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <article class='edu container'>
                <div class="form-group row">
                    <div class="form-group  col-lg-4">
                        <label for="prof">Professin</label>
                        <select id="prof" name="prof" class="form-control" v-validate="'required'"
                                v-model="formRegister.prof">
                            <option value="">Select a prof</option>
                            <option value="doctor">բժիշկ</option>
                            <option value="nurse">բուժ․ քույր</option>
                            <option value="pharmacist">դեղագործ</option>
                            <option value="provider">դեղագետ</option>
                        </select>
                        <span v-if="errors.has('prof')" class="invalid-feedback"
                              role="alert">{{ errors.first('prof') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="edu">Education</label>
                        <select id="edu" name="edu" class="form-control" v-validate="'required'"
                                v-model="formRegister.edu">
                            <option value="">Select a Education</option>
                            <option value="doctor">բժիշկ</option>
                            <option value="nurse">բուժ․ քույր</option>
                            <option value="pharmacist">դեղագործ</option>
                            <option value="provider">դեղագետ</option>
                        </select>
                        <span v-if="errors.has('edu')" class="invalid-feedback"
                              role="alert">{{ errors.first('edu') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="palace">Member if palace</label>
                        <input id="palace" type="checkbox" name="palace" class="form-control"
                               v-validate="'required'" v-model="formRegister.palace">

                        <span v-if="errors.has('palace')" class="invalid-feedback"
                              role="alert">{{ errors.first('palace') }}</span>
                    </div>
                    <!--<div class="form-group  col-lg-12">-->
                    <!--<div v-if="!image">-->
                    <!--<label for="diploma">Member if palace</label>-->
                    <!--<input type="file" @change="onFileChange" id="diploma" name="diploma[]" class="form-control"-->
                    <!--multiple="multiple" v-validate="'required'">-->
                    <!--<span v-if="errors.has('diploma')" class="invalid-feedback"-->
                    <!--role="alert">{{ errors.first('diploma') }}</span>-->
                    <!--</div>-->
                    <!--<div v-else>-->
                    <!--<img :src="image"/>-->
                    <!--<button @click="removeImage">Remove image</button>-->
                    <!--</div>-->
                    <!--&lt;!&ndash;                            <span v-if="errors.has('diploma')" class="invalid-feedback" role="alert">{{ errors.first('diploma') }}</span>&ndash;&gt;-->
                    <!--</div>-->
                    <div class="form-group  col-lg-4">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" v-validate="'required|email'"
                               class="form-control" v-model="formRegister.email" placeholder="Email address">
                        <span v-if="errors.has('email')" class="invalid-feedback" role="alert">{{ errors.first('email') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control"
                               v-validate="'required|min:6'" v-model="formRegister.password"
                               placeholder="password">
                        <span v-if="errors.has('password')" class="invalid-feedback" role="alert">{{ errors.first('password') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="re_password">Confirm Password</label>
                        <input id="re_password" type="password" name="re_password" class="form-control"
                               v-validate="'required|min:6'" v-model="formRegister.re_password">
                        <span v-if="errors.has('re_password')" class="invalid-feedback" role="alert">{{ errors.first('re_password') }}</span>
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

    let state = {
        date: new Date(1940, 1, 1)
    };

    export default {

        data() {
            return {
                formRegister: {
                    name: '',
                    surname: '',
                    father_name: '',
                    gender: '',
                    m_status: '',
                    h_region: '',
                    v_region: '',
                    h_city: '',
                    v_city: '',
                    v_village: '',
                    h_village: '',
                    prof: '',
                    edu: '',
                    diploma: '',
                    image: '',
                    email: '',
                    password: ''
                },
                error: null
            }
        },
        methods: {
            register() {

                registerUser(this.$data.formRegister)
                    .then(res => {
                        console.log(res);
                        this.$store.commit("registerSuccess", res);
                        this.$router.push({path: '/login'});
                    })
                    .catch(error => {
                        this.$store.commit("registerFailed", {error});
                    })
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
</style>

