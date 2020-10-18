<template>
    <div class="register  justify-content-center container">
        <h3 class="mt-2">{{texts.register}}</h3>
        <p class="_help">{{texts.helptext}}</p>
        <form @submit.prevent="register" class="row" enctype="multipart/form-data">
            <input autocomplete="off" type="radio" id="profile" value="1" name="tractor" checked='checked'>
            <input autocomplete="off" type="radio" id="address" value="2" name="tractor">
            <input autocomplete="off" type="radio" id="education" value="3" name="tractor">
            <!--            <input autocomplete="off" type="radio" id="register" value="4" name="tractor">-->
            <nav class="reg_nav">
                <label for="profile" class='fa fa-user-o nav_label col-lg-4 col-4'></label>
                <label for="address" class='fa fa-address-card-o nav_label col-lg-4 col-4'></label>
                <label for="education" class='fa fa-graduation-cap nav_label col-lg-4 col-4'></label>
                <!--                <label for="register" class='fa fa-list-alt nav_label'></label>-->
            </nav>
            <article class='bio container'>
                <div class="form-group row">
                    <p class="error col-12" v-if="regError">
                        {{regError}}
                    </p>
                    <div class="form-group  col-lg-4">
                        <label for="name">{{texts.name}}</label>
                        <input autocomplete="off" id="name" type="text" name="name" class="form-control"
                               v-validate="'required'"
                               :class="{'input': true, 'is-invalid': errors.has('name') }"
                               v-model="formRegister.name" :data-vv-as="texts.name"
                               v-on:blur="checkLang('name','hy')"
                               data-toggle="tooltip" ref="name" :placeholder="texts.enterarm">

                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>

                    </div>
                    <div class="form-group col-lg-4 ">
                        <label for="surname">{{texts.surname}}</label>
                        <input autocomplete="off" id="surname" type="text" name="surname" class="form-control "
                               :class="{'input': true, 'is-invalid': errors.has('surname') }"
                               v-on:blur="checkLang('surname','hy')" :placeholder="texts.enterarm"
                               v-validate="'required'" v-model="formRegister.surname" :data-vv-as="texts.surname">
                        <span v-show="errors.has('surname')" class="help is-danger">{{ errors.first('surname') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="father_name">{{texts.fathername}}</label>
                        <input autocomplete="off" id="father_name" type="text" name="father_name" class="form-control"
                               :class="{'input': true, 'is-invalid': errors.has('father_name') }"
                               v-on:blur="checkLang('father_name','hy')" :placeholder="texts.enterarm"
                               v-validate="'required'" :data-vv-as="texts.fathername"
                               v-model="formRegister.father_name">
                        <span v-show="errors.has('father_name')" class="help is-danger">{{ errors.first('father_name') }}</span>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="phone">{{texts.phone}}</label>
                        <input autocomplete="off" id="phone" type="tel" name="phone"
                               class="form-control" :placeholder="texts.valid_phone"
                               v-validate="{required: true, regex: /^([0-9]+)$/ }" :data-vv-as="texts.phone"
                               :class="{'input': true, 'is-invalid': errors.has('phone') }"
                               v-model="formRegister.phone">
                        <span v-show="errors.has('phone')" class="help is-danger">{{ errors.first('phone') }}</span>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="passport">{{texts.serianumber}}</label>
                        <input autocomplete="off" id="passport" type="text" name="passport"
                               class="form-control"
                               v-validate="'required'" :data-vv-as="texts.serianumber"
                               v-on:blur="checkLang('passport','en')"
                               v-model="formRegister.passport">
                        <span v-if="errors.has('passport')" class="help is-danger" role="alert">{{ errors.first('passport') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="issue">{{texts.dateofissue}}</label>
                        <datepicker :language="hy" value="state.date" v-validate="'required'" id="issue"
                                    format="dd-MM-yyyy" :data-vv-as="texts.dateofissue" :open-date="startDate"
                                    :class="{'input': true, 'is-invalid': errors.has('date_of_issue') }"
                                    name="date_of_issue" v-model="formRegister.date_of_issue"></datepicker>

                        <span v-show="errors.has('date_of_issue')" class="help is-danger">{{ errors.first('date_of_issue') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="expiry">{{texts.dateofexpire}}</label>
                        <datepicker :language="hy" value="state.date" v-validate="'required'"
                                    id="expiry"
                                    name="date_of_expiry"
                                    format="dd-MM-yyyy" :data-vv-as="texts.dateofexpire" :open-date="startDate"
                                    :disabled-dates="{from:endDate}"
                                    :class="{'input': true, 'is-invalid': errors.has('date_of_expiry') }"
                                    v-model="formRegister.date_of_expiry"></datepicker>
                        <span v-show="errors.has('date_of_expiry')" class="help is-danger">{{ errors.first('date_of_expiry') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bday">{{texts.birthday}}</label>
                        <datepicker :language="hy" value="state.date" v-validate="'required'" id="bday"
                                    format="dd-MM-yyyy" :open-date="openDate" :data-vv-as="texts.birthday"
                                    :class="{'input': true, 'is-invalid': errors.has('bday') }"
                                    name="bday" v-model="formRegister.bday"></datepicker>
                        <span v-show="errors.has('bday')" class="help is-danger">{{ errors.first('bdsy') }}</span>
                    </div>
                    <footer class="form-group col-lg-12">
                        <label for="address" class='fa fa-arrow-right nav_label col-lg-4 float-right'></label>
                    </footer>
                </div>

            </article>
            <article class='information container '>
                <div class="form-group row ">
                    <div class="form-group col-lg-12">
                        <label for="workplace_name">{{texts.workplace}}</label>
                        <input autocomplete="off" id="workplace_name" type="text" name="workplace_name"
                               class="form-control"
                               v-validate="'required'" :data-vv-as="texts.workplace" :placeholder="texts.enterarm"
                               :class="{'input': true, 'is-invalid': errors.has('workplace_name') }"
                               v-on:blur="checkLang('workplace_name', 'hy')"
                               v-model="formRegister.workplace_name">
                        <span v-show="errors.has('workplace_name')"
                              class="help is-danger">{{ errors.first('workplace_name') }}</span>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">{{texts.workaddress}}</p>
                            <div class="form-group col-lg-4">
                                <label for="w_region">{{texts.region}}</label>
                                <select id="w_region" name="w_region" class="form-control" :data-vv-as="texts.region"
                                        :class="{'input': true, 'is-invalid': errors.has('w_region') }"
                                        v-validate="'required'" @change="getTerritory(formRegister.w_region,'w')"
                                        v-model="formRegister.w_region">
                                    <option value="">{{texts.selectregion}}</option>
                                    <option v-for="(region, key) in regions" v-bind:value="region.id">{{region.name}}
                                    </option>
                                </select>
                                <span v-show="errors.has('w_region')" class="help is-danger">{{ errors.first('w_region') }}</span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="w_territory">{{texts.territory}}</label>
                                <select id="w_territory" name="w_territory" ref="w_territory" class="form-control"
                                        v-validate="'required'"
                                        :class="{'input': true, 'is-invalid': errors.has('w_territory') }"
                                        v-model="formRegister.w_territory" :data-vv-as="texts.territory">
                                    <option value="">{{texts.selectterritory}}</option>
                                    <optgroup v-for="(group) in w_territories" :label="group.name+ 'ի համայնք'">
                                        <option v-for="(option) in group.residence" v-if="group.residence"
                                                :value="option.id">
                                            {{ option.name }}
                                        </option>
                                        <option :value="group.id" v-if="group.residence.length === 0">
                                            {{ group.name }}
                                        </option>
                                    </optgroup>
                                </select>
                                <span v-show="errors.has('w_territory')"
                                      class="help is-danger">{{ errors.first('w_territory') }}</span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="w_street">{{texts.street}}</label>
                                <input autocomplete="off" id="w_street" type="text" name="w_street" class="form-control"
                                       v-validate="'required'" v-on:blur="checkLang('w_street','hy')"
                                       :placeholder="texts.enterarm"
                                       :class="{'input': true, 'is-invalid': errors.has('w_street') }"
                                       v-model="formRegister.w_street" :data-vv-as="texts.street">
                                <span v-show="errors.has('w_street')" class="help is-danger">{{ errors.first('w_street') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">{{texts.homeaddress}} </p>
                            <div class="form-group col-lg-4">
                                <label for="h_region">{{texts.region}}</label>
                                <select id="h_region" name="h_region" class="form-control"
                                        v-validate="'required'" @change="getTerritory(formRegister.h_region,'h')"
                                        :class="{'input': true, 'is-invalid': errors.has('h_region') }"
                                        v-model="formRegister.h_region" :data-vv-as="texts.region">
                                    <option value="">{{texts.selectregion}}</option>
                                    <option v-for="(region) in regions" v-bind:value="region.id">{{region.name}}
                                    </option>
                                </select>
                                <span v-show="errors.has('h_region')" class="help is-danger">{{ errors.first('h_region') }}</span>

                            </div>

                            <div class="form-group col-lg-4">
                                <label for="h_territory">{{texts.territory}}</label>
                                <select id="h_territory" name="h_territory" ref="h_territory" class="form-control"
                                        v-validate="'required'"
                                        :class="{'input': true, 'is-invalid': errors.has('h_territory') }"
                                        v-model="formRegister.h_territory" :data-vv-as="texts.territory">
                                    <option value="">{{texts.selectterritory}}</option>
                                    <optgroup v-for="(group) in h_territories" :label="group.name+ 'ի համայնք'">
                                        <option v-for="(option) in group.residence" v-if="group.residence"
                                                :value="option.id">
                                            {{ option.name }}
                                        </option>
                                        <option :value="group.id" v-if="group.residence.length === 0">
                                            {{ group.name }}
                                        </option>
                                    </optgroup>
                                </select>
                                <span v-show="errors.has('h_territory')"
                                      class="help is-danger">{{ errors.first('h_territory') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="h_street">{{texts.street}}</label>
                                <input autocomplete="off" id="h_street" type="text" name="h_street" class="form-control"
                                       v-validate="'required'" v-on:blur="checkLang('h_street', 'hy')"
                                       :placeholder="texts.enterarm"
                                       :class="{'input': true, 'is-invalid': errors.has('h_street') }"
                                       v-model="formRegister.h_street" :data-vv-as="texts.street">
                                <span v-show="errors.has('h_street')" class="help is-danger">{{ errors.first('h_street') }}</span>
                            </div>
                        </div>
                    </div>
                    <footer class="form-group col-lg-12">
                        <label for="education" class='fa fa-arrow-right nav_label col-lg-4 float-right'></label>
                        <label for="profile" class='fa fa-arrow-left nav_label col-lg-4 float-left'></label>
                    </footer>
                </div>

            </article>
            <article class='edu container'>
                <p class="_help">{{texts.subjecthelp}}</p>
                <div class="form-group row">
                    <div class="form-group  col-lg-4">
                        <label for="profession">{{texts.profession}}</label>
                        <select id="profession" name="profession" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('profession') }"
                                :data-vv-as="texts.profession"
                                v-model="formRegister.profession" @change="getSpecialties(formRegister.profession)">
                            <option value="">{{texts.selectaprofession}}</option>
                            <option v-for="(prof) in professions" v-bind:value="prof.id">{{prof.name}}</option>
                        </select>

                        <span v-show="errors.has('profession')"
                              class="help is-danger">{{ errors.first('profession') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="specialty_id">{{texts.specialty}}</label>
                        <select id="specialty_id" name="education" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('specialty_id') }"
                                v-model="formRegister.education_id" ref="spec" :data-vv-as="texts.specialty"
                                @change="getEducations(formRegister.education_id)">
                            <option v-for="( group) in specialties" :value="group.id">
                                {{ group.name }}
                            </option>

                        </select>
                        <span v-show="errors.has('specialty_id')"
                              class="help is-danger">{{ errors.first('education_id') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="edu">{{texts.education}}</label>
                        <select id="edu" name="education" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('specialty_id') }" ref="edu"
                                v-model="formRegister.specialty_id" :data-vv-as="texts.education">
                            <option v-for="(edu) in educations" v-bind:value="edu.id">{{edu.name}}</option>
                        </select>
                        <span v-show="errors.has('specialty_id')" class="help is-danger">{{ errors.first('specialty_id') }}</span>
                    </div>

                    <div class="form-group  col-lg-5"><span>{{texts.member_of_palace}}</span></div>
                    <div class="form-group  col-lg-5">
                        <div class="confirm-switch">
                            <input autocomplete="off" type="checkbox" id="confirm-switch"
                                   :class="{'input': true, 'is-invalid': errors.has('member_of_palace') }"
                                   checked="" name="member_of_palace" class="form-control"
                                   :data-vv-as="texts.member_of_palace " value="0"
                                   v-validate="" v-model="formRegister.member_of_palace">
                            <label for="confirm-switch"></label>
                        </div>
                        <span v-show="errors.has('member_of_palace')" class="help is-danger">{{ errors.first('member_of_palace') }}</span>
                    </div>
                    <div class="form-group  col-lg-12 diploms_container">
                        <div class="large-12 medium-12 small-12 filezone">
                            <input autocomplete="off" ref="files" v-on:change="handleFiles()"
                                   type="file" id="files" multiple
                                   name="files" v-validate="'required|length:2'"
                                   :data-vv-as="texts.files">
                            <p>
                                {{texts.uploadfiles}}
                            </p>
                            <span v-show="errors.has('files')" class="help is-danger">{{ errors.first('files') }}</span>
                        </div>

                        <div v-for="(file, key) in files" class="file-listing col-lg-6 d-inline-flex">
                            <img class="preview" v-bind:ref="'preview'+ parseInt(key)"/>

                            <!--<p>{{file.name }}</p>-->
                            <div class="success-container" v-if="file.id > 0">
                                Success
                                <input autocomplete="off" type="hidden" :name="input_name" :value="file.id"/>
                            </div>
                            <div class="remove-container" v-else>
                                <a class="remove fa fa-remove" v-on:click="removeFile(key)"></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="email">{{texts.email}}</label>
                        <input autocomplete="off" id="email" type="email" name="email" v-validate="'required|email'"
                               v-on:blur="checkLang('email','en')" :title="texts.email"
                               title="Մուտքագրեք անգլերեն"
                               :class="{'input': true, 'is-invalid': errors.has('email') }"
                               class="form-control" v-model="formRegister.email" :data-vv-as="texts.email">
                        <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="password">{{texts.password}}</label>
                        <input autocomplete="off" id="password" type="password" name="password" class="form-control"
                               v-validate="'required|min:8'" v-model="formRegister.password"
                               :class="{'input': true, 'is-invalid': errors.has('password') }"
                               v-on:blur="checkLang('password','en')"
                               :data-vv-as="texts.password">
                        <span v-show="errors.has('password')"
                              class="help is-danger">{{ errors.first('password') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="re_password">{{texts.confirmpassword}}</label>
                        <input autocomplete="off" id="re_password" type="password" name="re_password"
                               class="form-control"
                               :class="{'input': true, 'is-invalid': errors.has('re_password') }"
                               v-validate="'required|min:8'" v-model="formRegister.re_password"
                               v-on:blur="checkLang('re_password','en')"
                               :data-vv-as="texts.confirmpassword">
                        <span v-show="errors.has('re_password')" class="help is-danger">{{ errors.first('re_password') }}</span>
                    </div>
                    <footer class="form-group col-lg-12">
                        <label for="address" class='fa fa-arrow-left nav_label col-lg-4 float-left'></label>
                        <button type="submit" class="btn primary-btn mt-3 float-right">{{texts.register}}</button>
                    </footer>
                </div>
            </article>

        </form>
    </div>
</template>

<script>
    function changeCalender(_date) {
        const current_date = new Date();
        return current_date.getFullYear() + (_date);
    }

    import {registerUser} from '../partials/auth';
    import {langs} from '../partials/main';
    import {education, profession, region, specialty, territory} from '../partials/help';
    import Datepicker from 'vuejs-datepicker';
    import registertexts from './json/registertexts.json';
    import hy from './json/hy.json';

    export default {
        props: ['input_name'],
        data() {
            return {
                hy: hy,
                formRegister: {
                    name: '',
                    surname: '',
                    father_name: '',
                    phone: '',
                    bday: '',
                    passport: '',
                    date_of_expiry: '',
                    date_of_issue: '',
                    workplace_name: '',
                    regions: '',
                    h_region: '',
                    w_region: '',
                    h_territory: '',
                    w_territory: '',
                    w_street: '',
                    h_street: '',
                    profession: '',
                    specialty_id: '',
                    education_id: '',
                    member_of_palace: '',
                    email: '',
                    password: '',
                    re_password: '',
                },
                files: [],
                regions: [],
                w_territories: [],
                h_territories: [],
                professions: [],
                educations: [],
                specialties: [],
                openDate: new Date('January 31 1930'),
                startDate: new Date('January 31 ' + changeCalender(-10)),
                endDate: new Date('January 31 ' + changeCalender(11)),
                error:
                    null,
                texts: registertexts,

            }
        },
        mounted() {
            this.getRegions();
            this.getProfessions();
        },
        methods: {
            getEducations(id) {
                education(id)
                    .then(res => {
                        this.$refs.edu.style.border = '1px solid #9f12ad';
                        this.$refs.spec.style.border = '1px solid #ced4da';
                        this.educations = res.edu;

                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            getSpecialties(id) {
                let credentials = {
                    id: id
                };
                specialty(credentials)
                    .then(res => {
                        this.$refs.spec.style.border = '1px solid #9f12ad';
                        this.specialties = res.spec;
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            getRegions() {
                region()
                    .then(res => {
                        this.regions = res.regions;
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            getProfessions() {
                profession()
                    .then(res => {
                        this.professions = res.prof;
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            getTerritory(id, prefix) {
                territory(id)
                    .then(res => {
                        if (prefix === 'w') {
                            this.$refs.w_territory.style.border = '1px solid #9f12ad';
                            this.w_territories = res.territories;
                        } else {
                            this.$refs.h_territory.style.border = '1px solid #9f12ad';
                            this.h_territories = res.territories;
                        }
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            register() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log('Form Submitted!');
                        return;
                    }
                    console.log('Correct them errors!');
                });
                registerUser(this.$data.formRegister,
                    this.files)
                    .then(res => {
                        console.log(res);
                        if (res.user) {
                            this.$store.commit("registerSuccess", res);
                            this.$router.push({path: '/login'});
                        }
                    })
                    .catch(error => {
                        this.$store.commit("registerFailed", {error});
                    });
            },
            removeFile(key) {
                this.files.splice(key, 1);
                this.getImagePreviews();
            },
            handleFiles() {
                let uploadedFiles = this.$refs.files.files;
                for (var i = 0; i < uploadedFiles.length; i++) {
                    this.files.push(uploadedFiles[i]);
                    // this.images.push(uploadedFiles[i]);
                }
                this.getImagePreviews();
            },
            getImagePreviews() {
                for (let i = 0; i < this.files.length; i++) {
                    if (/\.(jpe?g|png|gif|pdf)$/i.test(this.files[i].name)) {
                        let reader = new FileReader();
                        reader.addEventListener("load", function () {
                            this.$refs['preview' + parseInt(i)][0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL(this.files[i]);
                    } else {
                        this.$nextTick(function () {
                            this.$refs['preview' + parseInt(i)][0].src = '/images/avatars/generic.png';
                        });
                    }
                }
            },
            checkLang(val, lng, model = false) {
                if (!model) {
                    let el = this.$data.formRegister[val];

                    let isArm = langs(el, lng);

                    if (!isArm) {
                        this.$data.formRegister[val] = "";
                    }
                }
            }
        },
        computed: {
            regError() {
                // console.log(this.$store.getters.regError);
                return this.$store.getters.regError
            }
        },
        components: {
            Datepicker
        }
    }
</script>
