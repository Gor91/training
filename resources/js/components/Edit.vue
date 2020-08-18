<template>
    <div class="register  justify-content-center container">
        <div class="form row position-relative" style="height: 1100px">
            <p class="error col-12" v-if="editError">
                {{editError}}
            </p>
            <p class="error col-12" v-if="editedUser">
                {{editedUser}}
            </p>

            <input autocomplete="off" type="radio" id="profile" value="1" name="tractor" checked='checked'>
            <input autocomplete="off" type="radio" id="address" value="2" name="tractor">
            <input autocomplete="off" type="radio" id="education" value="3" name="tractor">
            <nav class="edit_nav">
                <label for="profile" class='fa fa-user-o nav_label col-lg-4'></label>
                <label for="address" class='fa fa-address-card-o nav_label col-lg-4'></label>
                <label for="education" class='fa fa-user-secret nav_label col-lg-4'></label>
            </nav>
            <article class='bio container'>
                <form @submit.prevent="updateInfo" enctype="multipart/form-data">
                    <input autocomplete="off" type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <div class="form-group col-lg-4">
                            <label for="phone">{{texts.phone}}</label>
                            <input autocomplete="off" id="phone" type="tel" name="phone"
                                   class="form-control" :placeholder="texts.valid_phone"
                                   v-validate="{required: true, regex: /^([0-9]+)$/ }"
                                   :class="{'input': true, 'is-invalid': errors.has('phone') }"
                                   v-model="formEdit.phone">
                            <span v-show="errors.has('phone')" class="help is-danger">{{ errors.first('phone') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="email">{{texts.email}}</label>
                            <input autocomplete="off" id="email" type="email" name="email" v-validate="'required|email'"
                                   :class="{'input': true, 'is-invalid': errors.has('email') }"
                                   class="form-control" v-model="formEdit.email">
                            <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="bday">{{texts.birthday}}</label>
                            <datepicker :language="hy" value="state.date" v-validate="'required'" id="bday"
                                        format="dd-MM-yyyy" :open-date="openDate"
                                        :class="{'input': true, 'is-invalid': errors.has('bday') }"
                                        name="bday" v-model="formEdit.bday"></datepicker>
                            <span v-show="errors.has('bday')" class="help is-danger">{{ errors.first('bdsy') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="profession">{{texts.profession}}</label>
                            <select id="profession" name="profession" class="form-control" v-validate="'required'"
                                    :class="{'input': true, 'is-invalid': errors.has('profession') }"
                                    v-model="formEdit.profession" @change="getSpecialties(formEdit.profession)">
                                <option value="">{{texts.selectaprofession}}</option>
                                <option v-for="(prof) in professions" v-bind:value="prof.id">{{prof.name}}</option>
                            </select>
                            <span v-show="errors.has('profession')"
                                  class="help is-danger">{{ errors.first('profession') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="specialty_id">{{texts.specialty}}</label>
                            <select id="specialty_id" name="education_id" class="form-control" v-validate="'required'"
                                    :class="{'input': true, 'is-invalid': errors.has('education_id') }" ref="spec"
                                    v-model="formEdit.education_id" @change="getEducations(formEdit.education_id)">
                                <option v-for="(group) in specialties" :value="group.id">
                                    {{ group.name }}
                                </option>
                            </select>
                            <span v-show="errors.has('specialty_id')"
                                  class="help is-danger">{{ errors.first('specialty_id') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="education_id">{{texts.education}}</label>
                            <select id="education_id" name="specialty_id" class="form-control" v-validate="'required'"
                                    :class="{'input': true, 'is-invalid': errors.has('specialty_id') }"
                                    v-model="formEdit.specialty_id" ref="edu">
                                <option v-for="(edu) in educations" v-bind:value="edu.id">{{edu.name}}</option>
                            </select>
                            <span v-show="errors.has('specialty_id')" class="help is-danger">{{ errors.first('specialty_id') }}</span>
                        </div>


                        <div class="form-group col-lg-12">
                            <label for="info">{{texts.info}}</label>
                            <textarea autocomplete="off" id="info"  name="info"
                                   class="form-control"
                                   v-validate="'max:1024'"
                                   :class="{'input': true, 'is-invalid': errors.has('info') }"
                                      v-model="formEdit.info"></textarea>
                            <span v-show="errors.has('info')"
                                  class="help is-danger">{{ errors.first('info') }}</span>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="workplace_name">{{texts.workplace}}</label>
                            <input autocomplete="off" id="workplace_name" type="text" name="workplace_name"
                                   class="form-control"
                                   v-validate="'required'"
                                   :class="{'input': true, 'is-invalid': errors.has('workplace_name') }"
                                   v-model="formEdit.workplace_name">
                            <span v-show="errors.has('workplace_name')"
                                  class="help is-danger">{{ errors.first('workplace_name') }}</span>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="row ">
                                <p class="form-group-lg col-lg-12">{{texts.workaddress}} </p>
                                <div class="form-group col-lg-4">
                                    <label for="w_region">{{texts.region}}</label>
                                    <select id="w_region" name="w_region" class="form-control"
                                            :class="{'input': true, 'is-invalid': errors.has('w_region') }"
                                            v-validate="'required'" @change="getTerritory(formEdit.w_region,'w')"
                                            v-model="formEdit.w_region">
                                        <option v-for="(region, key) in regions" v-bind:value="region.id">
                                            {{region.name}}
                                        </option>
                                    </select>
                                    <span v-show="errors.has('w_region')" class="help is-danger">{{ errors.first('w_region') }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="w_territory">{{texts.territory}}</label>
                                    <select id="w_territory" name="w_territory" ref="w_territory" class="form-control"
                                            v-validate="'required'"
                                            :class="{'input': true, 'is-invalid': errors.has('w_territory') }"
                                            v-model="formEdit.w_territory">
                                        <optgroup v-for="(group) in w_territories"
                                                  :label="group.name+ 'ի համայք'">
                                            <option v-for="(option) in group.residence" v-if="group.residence"
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
                                    <input autocomplete="off" id="w_street" type="text" name="w_street"
                                           class="form-control"
                                           v-validate="'required'"
                                           :class="{'input': true, 'is-invalid': errors.has('w_street') }"
                                           v-model="formEdit.w_street">
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
                                            v-validate="'required'" @change="getTerritory(formEdit.h_region,'h')"
                                            :class="{'input': true, 'is-invalid': errors.has('h_region') }"
                                            v-model="formEdit.h_region">
                                        <option v-for="(region, key) in regions" v-bind:value="region.id">
                                            {{region.name}}
                                        </option>
                                    </select>
                                    <span v-show="errors.has('h_region')" class="help is-danger">{{ errors.first('h_region') }}</span>

                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="h_territory">{{texts.territory}}</label>
                                    <select id="h_territory" name="h_territory" ref="h_territory" class="form-control"
                                            v-validate="'required'"
                                            :class="{'input': true, 'is-invalid': errors.has('h_territory') }"
                                            v-model="formEdit.h_territory">

                                        <optgroup v-for="(group) in h_territories"
                                                  :label="group.name+ 'ի համայք'">
                                            <option v-for="(option) in group.residence" v-if="group.residence"
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
                                    <input autocomplete="off" id="h_street" type="text" name="h_street"
                                           class="form-control"
                                           v-validate="'required'"
                                           :class="{'input': true, 'is-invalid': errors.has('h_street') }"
                                           v-model="formEdit.h_street">
                                    <span v-show="errors.has('h_street')" class="help is-danger">{{ errors.first('h_street') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-4">
                        <button type="submit" class="btn primary-btn mt-3">{{texts.edit}}</button>
                    </div>
                </form>
            </article>
            <article class='info container '>
                <form @submit.prevent="updateApp" enctype="multipart/form-data">
                    <div class="form-group row ">
                        <div class="form-group col-lg-4">
                            <label for="name">{{texts.name}}</label>
                            <input autocomplete="off" id="name" type="text" name="name" class="form-control"
                                   v-validate="'required'"
                                   :class="{'input': true, 'is-invalid': errors.has('name') }" v-model="appEdit.name"
                            >
                            <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>

                        </div>
                        <div class="form-group col-lg-4">
                            <label for="surname">{{texts.surname}}</label>
                            <input autocomplete="off" id="surname" type="text" name="surname" class="form-control "
                                   :class="{'input': true, 'is-invalid': errors.has('surname') }"
                                   v-validate="'required'" v-model="appEdit.surname">
                            <span v-show="errors.has('surname')"
                                  class="help is-danger">{{ errors.first('surname') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="father_name">{{texts.surname}}</label>
                            <input autocomplete="off" id="father_name" type="text" name="father_name"
                                   class="form-control"
                                   :class="{'input': true, 'is-invalid': errors.has('father_name') }"
                                   v-validate="'required'"
                                   v-model="appEdit.father_name">
                            <span v-show="errors.has('father_name')" class="help is-danger">{{ errors.first('father_name') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="passport">{{texts.serianumber}}</label>
                            <input autocomplete="off" id="passport" type="text" name="passport"
                                   class="form-control"
                                   v-validate="'required'"
                                   v-model="appEdit.passport">
                            <span v-if="errors.has('passport')" class="help is-danger" role="alert">{{ errors.first('passport') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="issue">{{texts.dateofissue}}</label>
                            <datepicker :language="hy" value="state.date" v-validate="'required'" id="issue"
                                        format="dd-MM-yyyy" :open-date="startDate"
                                        :class="{'input': true, 'is-invalid': errors.has('date_of_issue') }"
                                        name="date_of_issue" v-model="appEdit.date_of_issue"></datepicker>

                            <span v-show="errors.has('date_of_issue')" class="help is-danger">{{ errors.first('date_of_issue') }}</span>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="expiry">{{texts.dateofexpire}}</label>
                            <datepicker :language="hy" value="state.date" v-validate="'required'" id="expiry"
                                        name="date_of_expiry" :open-date="startDate"
                                        :disabled-dates="{from:endDate}"
                                        format="dd-MM-yyyy"
                                        :class="{'input': true, 'is-invalid': errors.has('date_of_expiry') }"
                                        v-model="appEdit.date_of_expiry"></datepicker>
                            <span v-show="errors.has('date_of_expiry')" class="help is-danger">{{ errors.first('date_of_expiry') }}</span>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="form-group  col-lg-6"><span>{{texts.member_of_palace}}</span></div>
                            <div class="form-group  col-lg-6">
                                <div class="confirm-switch">
                                    <input autocomplete="off" type="checkbox" id="confirm-switch"
                                           :class="{'input': true, 'is-invalid': errors.has('member_of_palace') }"
                                           name="member_of_palace" class="form-control" :open-date="openDate"
                                           v-validate="'max:5'" v-model="appEdit.member_of_palace">
                                    <label for="confirm-switch"></label>
                                </div>
                            </div>
                            <span v-show="errors.has('member_of_palace')" class="help is-danger">{{ errors.first('member_of_palace') }}</span>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="large-12 medium-12 small-12 diploms_container filezone">
                                <input autocomplete="off" ref="files" v-on:change="handleFiles()"
                                       type="file" id="files" multiple
                                       name="files" v-validate="'required'">
                                <p>
                                    {{texts.uploadfiles}}
                                </p>
                            </div>

                            <div v-for="(file, key) in files" class="file-listing col-lg-6 d-inline-flex">
                                <img class="preview" v-bind:ref="'preview'+parseInt(key)"/>
                                <!--                                {{ file.name }}-->
                                <div class="success-container" v-if="file.id > 0">
                                    Success
                                    <input type="hidden" :name="input_name" :value="file.id"/>
                                </div>
                                <div class="remove-container" v-else>
                                    <a class="remove fa fa-remove" v-on:click="removeFile(key)"> </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <div class="row" ref="img">
                                <!--                                todo path to storage-->

                                <div class="col-lg-3 d-inline-flex" v-model="appEdit.diplomas"
                                     v-for="(diploma, key) in appEdit.j_diplomas" ref="diploma">
                                    <img class="col-lg-12" :src="'/uploads/diplomas/'+diploma" :alt="diploma">
                                    <div class="remove-container">
                                        <a class="remove fa fa-remove"
                                           v-on:click="removeDiploma(key, diploma)"> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <button type="submit" class="btn primary-btn mt-3">{{texts.edit}}</button>
                        </div>
                    </div>
                </form>
            </article>
            <article class='edu container '>
                <form @submit.prevent="update" enctype="multipart/form-data">
                    <input autocomplete="off" type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <div class="form-group  col-lg-4">
                            <div class="row">
                                <label for="old_password">{{texts.oldpassword}}</label>
                                <input autocomplete="off" id="old_password" type="password" name="old_password"
                                       class="form-control"
                                       v-validate="'required|min:8'" v-model="passEdit.old_password"
                                       :class="{'input': true, 'is-invalid': errors.has('old_password') }">
                                <span v-show="errors.has('old_password')"
                                      class="help is-danger">{{ errors.first('old_password') }}</span>
                            </div>
                        </div>
                        <div class="form-group  col-lg-4">
                            <label for="password">{{texts.newpassword}}</label>
                            <input autocomplete="off" id="password" type="password" name="password" class="form-control"
                                   v-validate="'required|min:8'" v-model="passEdit.password"
                                   :class="{'input': true, 'is-invalid': errors.has('password') }">
                            <span v-show="errors.has('password')"
                                  class="help is-danger">{{ errors.first('password') }}</span>
                        </div>
                        <div class="form-group  col-lg-4">
                            <label for="re_password">{{texts.confirmpassword}}</label>
                            <input autocomplete="off" id="re_password" type="password" name="re_password"
                                   class="form-control"
                                   :class="{'input': true, 'is-invalid': errors.has('re_password') }"
                                   v-validate="'required|min:8'" v-model="passEdit.re_password">
                            <span v-show="errors.has('re_password')" class="help is-danger">{{ errors.first('re_password') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn primary-btn mt-3">{{texts.edit}}</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</template>

<script>
    function changeCalender(_date) {
        const current_date = new Date();
        return current_date.getFullYear() + (_date);
    }

    import {approveUser, changePassword, editUser} from '../partials/auth';
    import {education, profession, region, specialty, territory} from '../partials/help';
    import Datepicker from 'vuejs-datepicker';
    import registertexts from './json/registertexts.json'
    import hy from './json/hy.json';

    export default {
        props: ['input_name'],
        data() {
            return {
                hy: hy,
                formEdit: {
                    id: '',
                    phone: '',
                    bday: '',
                    workplace_name: '',
                    h_region: '',
                    w_region: '',
                    h_territory: '',
                    w_territory: '',
                    w_street: '',
                    h_street: '',
                    profession: '',
                    specialty_id: '',
                    education_id: '',
                    info:'',
                },
                appEdit: {
                    name: '',
                    surname: '',
                    father_name: '',
                    passport: '',
                    date_of_expiry: '',
                    date_of_issue: '',
                    member_of_palace: '',
                    email: '',
                    diplomas: '',
                    j_diplomas: '',
                },
                passEdit: {
                    old_password: '',
                    password: '',
                    re_password: ''
                },
                files: [],
                regions: [],
                w_territories: [],
                h_territories: [],
                educations: [],
                professions: [],
                specialties: [],
                openDate: new Date('January 31 1930'),
                startDate: new Date('January 31 ' + changeCalender(-10)),
                endDate: new Date('January 31 ' + changeCalender(11)),
                error:
                    null,
                texts: registertexts
            }
        },
        created() {
            this.getAccountInfo();
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
                        console.log(res);
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
                            this.w_territories = res.territories;

                        } else {
                            this.h_territories = res.territories;
                        }
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            getAccountInfo() {
                let user = JSON.parse(localStorage.getItem('user'));
                const token = user.token;

                axios.get('/api/auth/edit/' + user.id, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                    .then(response => {

                        let obj = response.data;

                        let w_address = JSON.parse(obj.user.work_address);
                        let h_address = JSON.parse(obj.user.home_address);
                        let diplomas = JSON.parse(obj.app.prof.diplomas);

                        this.$data.formEdit = obj.user;
                        this.$data.appEdit = obj.app;
                        this.$data.formEdit.w_region = w_address.w_region;
                        this.$data.formEdit.w_territory = w_address.w_territory;
                        this.$data.formEdit.w_street = w_address.w_street;
                        this.$data.formEdit.h_region = h_address.h_region;
                        this.$data.formEdit.h_territory = h_address.h_territory;
                        this.$data.formEdit.h_street = h_address.h_street;
                        this.$data.appEdit.diplomas = obj.app.prof.diplomas;
                        this.$data.appEdit.j_diplomas = diplomas;
                        this.$data.appEdit.member_of_palace = obj.app.prof.member_of_palace;
                        this.$data.formEdit.token = token;


                        this.getTerritory(this.$data.formEdit.w_region, 'w');
                        this.getTerritory(this.$data.formEdit.h_region, 'h');
                        this.getSpecialties(this.$data.formEdit.profession);
                        this.getEducations(this.$data.formEdit.education_id);
                    })
            },

            updateApp() {
                this.$validator.validateAll(this.$data.appEdit).then((result) => {
                    if (result) {

                        approveUser(this.$data.appEdit.id, this.$data.appEdit,
                            this.files, this.$data.formEdit.token)
                            .then(res => {
                                this.$store.commit("editSuccess", res);
                                this.logout();
                            })
                            .catch(error => {
                                this.$store.commit("editFailed", {error});
                            });
                        return;
                    }
                    console.log('Correct them errors!');
                });
            },
            updateInfo() {
                this.$validator.validateAll(this.$data.formEdit).then((result) => {
                    if (result) {

                        editUser(this.$data.formEdit.id, this.$data.formEdit,
                            this.files, this.$data.formEdit.token)
                            .then(res => {

                                this.$store.commit("editSuccess", res);
                                this.$router.push({path: '/account'});
                            })
                            .catch(error => {

                                this.$store.commit("editFailed", {error});
                            });
                        return;
                    }
                    console.log('Correct them errors!');
                });
            },
            update() {
                this.$validator.validateAll(this.$data.passEdit).then((result) => {
                    if (result) {

                        return;
                    }
                    console.log('Correct them errors!');
                });
                let user = JSON.parse(localStorage.getItem('user'));
                const token = user.token;
                const id = user.id;

                changePassword(id, this.$data.passEdit, token)
                    .then(res => {

                        if (res.success) {
                            this.$store.commit("editSuccess", res);
                            this.logout();
                        }
                    })
                    .catch(error => {
                        this.$store.commit("editFailed", {error});
                    });
            },
            logout() {

                this.$store.commit('logout');
                this.$router.push('/login');
            },
            removeFile(key) {
                this.files.splice(key, 1);
                this.getImagePreviews();
            },
            removeDiploma(key) {
                let diplomas = JSON.parse(this.appEdit.diplomas);
                diplomas.splice(key, 1);
                this.appEdit.diplomas = JSON.stringify(diplomas);
                this.$refs.diploma[key].remove();
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
                    if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
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

        },
        computed: {
            editError() {
                return this.$store.getters.editError
            }, editedUser() {
                return this.$store.getters.editedUser
            }
        },
        components: {
            Datepicker
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
