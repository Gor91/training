<template>
    <div class="register  justify-content-center container">
        <h3 class="mt-2">{{texts.register}}</h3>
        <p>{{texts.helptext}}</p>
        <form @submit.prevent="register" class="row" enctype="multipart/form-data">
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
                        <label for="name">{{texts.name}}</label>
                        <input id="name" type="text" name="name" class="form-control" v-validate="'required'"
                               :class="{'input': true, 'is-invalid': errors.has('name') }" autocomplete="off"
                               v-model="formRegister.name" :data-vv-as="texts.name" v-on:blur="checkLang('name','hy')"
                               data-toggle="tooltip" ref="name" :placeholder="texts.enterarm">

                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>

                    </div>
                    <div class="form-group col-lg-4 ">
                        <label for="surname">{{texts.surname}}</label>
                        <input id="surname" type="text" name="surname" class="form-control "
                               :class="{'input': true, 'is-invalid': errors.has('surname') }"
                               v-on:blur="checkLang('surname','hy')" :placeholder="texts.enterarm"
                               v-validate="'required'" v-model="formRegister.surname" :data-vv-as="texts.surname">
                        <span v-show="errors.has('surname')" class="help is-danger">{{ errors.first('surname') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="father_name">{{texts.fathername}}</label>
                        <input id="father_name" type="text" name="father_name" class="form-control"
                               :class="{'input': true, 'is-invalid': errors.has('father_name') }"
                               v-on:blur="checkLang('father_name','hy')" :placeholder="texts.enterarm"
                               v-validate="'required'" :data-vv-as="texts.fathername"
                               v-model="formRegister.father_name">
                        <span v-show="errors.has('father_name')" class="help is-danger">{{ errors.first('father_name') }}</span>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="phone">{{texts.phone}}</label>
                        <input id="phone" type="text" name="phone"
                               class="form-control"
                               v-validate="'required'" :data-vv-as="texts.phone"
                               :class="{'input': true, 'is-invalid': errors.has('phone') }"
                               v-model="formRegister.phone">
                        <span v-show="errors.has('phone')" class="help is-danger">{{ errors.first('phone') }}</span>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="passport">{{texts.serianumber}}</label>
                        <input id="passport" type="text" name="passport"
                               class="form-control"
                               v-validate="'required'" :data-vv-as="texts.serianumber"
                               v-on:blur="checkLang('passport','en')"
                               v-model="formRegister.passport">
                        <span v-if="errors.has('passport')" class="help is-danger" role="alert">{{ errors.first('passport') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="issue">{{texts.dateofissue}}</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="issue"
                                          format="dd-MM-yyyy" :data-vv-as="texts.dateofissue"
                                          :class="{'input': true, 'is-invalid': errors.has('date_of_issue') }"
                                          name="date_of_issue" v-model="formRegister.date_of_issue"></vuejs-datepicker>

                        <span v-show="errors.has('date_of_issue')" class="help is-danger">{{ errors.first('date_of_issue') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="expiry">{{texts.dateofexpire}}</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="expiry" name="date_of_expiry"
                                          format="dd-MM-yyyy" :data-vv-as="texts.dateofexpire"
                                          :class="{'input': true, 'is-invalid': errors.has('date_of_expiry') }"
                                          v-model="formRegister.date_of_expiry"></vuejs-datepicker>
                        <span v-show="errors.has('date_of_expiry')" class="help is-danger">{{ errors.first('date_of_expiry') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bday">{{texts.birthday}}</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="bday"
                                          format="dd-MM-yyyy" :open-date="openDate" :data-vv-as="texts.birthday"
                                          :class="{'input': true, 'is-invalid': errors.has('bday') }"
                                          name="bday" v-model="formRegister.bday"></vuejs-datepicker>
                        <span v-show="errors.has('bday')" class="help is-danger">{{ errors.first('bdsy') }}</span>
                    </div>
                </div>
            </article>
            <article class='info container '>
                <div class="form-group row ">
                    <div class="form-group col-lg-12">
                        <label for="workplace_name">{{texts.workplace}}</label>
                        <input id="workplace_name" type="text" name="workplace_name" class="form-control"
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
                                    <option v-for="(region, key) in regions" v-bind:value="key">{{region}}</option>
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
                                    <optgroup v-for="(group, name) in w_territories" :label="group.name+ 'ի համայնք'">
                                        <option v-for="(option, key) in group.residence" v-if="group.residence"
                                                :value="option.id">
                                            {{ option.name }}
                                        </option>
                                        <option :value="group.id">
                                            {{ group.name }}
                                        </option>
                                    </optgroup>
                                </select>
                                <span v-show="errors.has('w_territory')"
                                      class="help is-danger">{{ errors.first('w_territory') }}</span>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="w_street">{{texts.street}}</label>
                                <input id="w_street" type="text" name="w_street" class="form-control"
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
                                    <option v-for="(region, key) in regions" v-bind:value="key">{{region}}</option>
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
                                    <optgroup v-for="(group, name) in h_territories" :label="group.name+ 'ի համայնք'">
                                        <option v-for="(option, key) in group.residence" v-if="group.residence"
                                                :value="option.id">
                                            {{ option.name }}
                                        </option>
                                        <option :value="group.id">
                                            {{ group.name }}
                                        </option>
                                    </optgroup>
                                </select>
                                <span v-show="errors.has('h_territory')"
                                      class="help is-danger">{{ errors.first('h_territory') }}</span>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="h_street">{{texts.street}}</label>
                                <input id="h_street" type="text" name="h_street" class="form-control"
                                       v-validate="'required'" v-on:blur="checkLang('h_street', 'hy')"
                                       :placeholder="texts.enterarm"
                                       :class="{'input': true, 'is-invalid': errors.has('h_street') }"
                                       v-model="formRegister.h_street" :data-vv-as="texts.street">
                                <span v-show="errors.has('h_street')" class="help is-danger">{{ errors.first('h_street') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <article class='edu container'>
                <div class="form-group row">
                    <div class="form-group  col-lg-4">
                        <label for="profession">{{texts.profession}}</label>
                        <select id="profession" name="profession" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('profession') }"
                                :data-vv-as="texts.profession"
                                v-model="formRegister.profession" @change="getSpecialties(formRegister.profession)">
                            <option value="">{{texts.selectaprofession}}</option>
                            <option v-for="(prof, key) in professions" v-bind:value="key">{{prof}}</option>
                        </select>

                        <span v-show="errors.has('profession')"
                              class="help is-danger">{{ errors.first('profession') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="specialty_id">{{texts.specialty}}</label>
                        <select id="specialty_id" name="specialty_id" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('specialty_id') }"
                                v-model="formRegister.specialty_id" ref="spec" :data-vv-as="texts.specialty"
                                @change="getEducations(formRegister.specialty_id)">
                            <option v-for="(name, group) in specialties" :value="group">
                                {{ name }}
                            </option>

                        </select>
                        <span v-show="errors.has('specialty_id')"
                              class="help is-danger">{{ errors.first('specialty_id') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="edu">{{texts.education}}</label>
                        <select id="edu" name="education" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('education_id') }" ref="edu"
                                v-model="formRegister.education_id" :data-vv-as="texts.education">
                            <option v-for="(edu, key) in educations" v-bind:value="key">{{edu}}</option>
                        </select>
                        <span v-show="errors.has('education_id')" class="help is-danger">{{ errors.first('education_id') }}</span>
                    </div>

                    <div class="form-group  col-lg-5"><span>{{texts.member_of_palace}}</span></div>
                    <div class="form-group  col-lg-5">
                        <div class="confirm-switch">
                            <input type="checkbox" id="confirm-switch"
                                   :class="{'input': true, 'is-invalid': errors.has('member_of_palace') }"
                                   checked="" name="member_of_palace" class="form-control"
                                   :data-vv-as="texts.member_of_palace "
                                   v-validate="'required'" v-model="formRegister.member_of_palace">
                            <label for="confirm-switch"></label>
                        </div>
                        <span v-show="errors.has('member_of_palace')" class="help is-danger">{{ errors.first('member_of_palace') }}</span>
                    </div>
                    <div class="form-group  col-lg-12 diploms_container">
                        <div class="large-12 medium-12 small-12 filezone">
                            <input ref="files" v-on:change="handleFiles()"
                                   type="file" id="files" multiple
                                   name="files" v-validate="'required'"
                                   :data-vv-as="texts.files"
                            >
                            <p>
                                {{texts.uploadfiles}}
                            </p>
                        </div>

                        <div v-for="(file, key) in files" class="file-listing">
                            <img class="preview" v-bind:ref="'preview'+parseInt(key)"/>
                            {{ file.name }}
                            <div class="success-container" v-if="file.id > 0">
                                Success
                                <input type="hidden" :name="input_name" :value="file.id"/>
                            </div>
                            <div class="remove-container" v-else>
                                <a class="remove" v-on:click="removeFile(key)">Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="email">{{texts.email}}</label>
                        <input id="email" type="email" name="email" v-validate="'required|email'"
                               v-on:blur="checkLang('email','en')" :title="texts.name"
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

                    <footer class="form-group col-lg-4">
                        <button type="submit" class="btn primary-btn">{{texts.register}}</button>
                    </footer>
                </div>
            </article>

        </form>
    </div>
</template>

<script>
    import {registerUser} from '../partials/auth';
    import {education, profession, region, specialty, territory} from '../partials/help';
    import Datepicker from 'vuejs-datepicker';
    import registertexts from './json/registertexts.json'

    export default {
        props: ['input_name'],
        data() {
            return {
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
                openDate: new Date('January 31 1980'),
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
                specialty(id)
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
            checkLang(val, lng) {
                let el = this.$data.formRegister[val];
                let pattern;
                if (lng === 'hy')
                    pattern = /^[\u0530-\u058FF|\u0020-\u0040]*$/;
                else
                    pattern = /^[\u0000-\u009F]*$/;
                if (!pattern.test(el)) {
                    this.$data.formRegister[val] = "";
                    console.log(this.$data.formRegister)
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
            'vuejs-datepicker': Datepicker
        }
    }
</script>

<style scoped>
    .error {
        text-align: center;
        color: red;
    }

    .is-danger, .fa-warning {
        color: red;
    }

    input[type="file"] {
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }

    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        position: relative;
        cursor: pointer;
    }

    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }

    div.file-listing img {
        max-width: 90%;
    }

    div.file-listing {
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img {
        height: 100px;
    }

    div.success-container {
        text-align: center;
        color: green;
    }

    div.remove-container {
        text-align: center;
    }

    div.remove-container a {
        color: red;
        cursor: pointer;
    }

    a.submit-button {
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }
</style>