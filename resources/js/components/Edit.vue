<template>
    <div class="login  justify-content-center container-fluid">
        <form @submit.prevent="update" class="row" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <input type="radio" id="profile" value="1" name="tractor" checked='checked'>
            <input type="radio" id="address" value="2" name="tractor">
            <input type="radio" id="education" value="3" name="tractor">
            <!--            <input type="radio" id="edit" value="4" name="tractor">-->
            <nav class="reg_nav">
                <label for="profile" class='fa fa-user-o nav_label col-lg-4'></label>
                <label for="address" class='fa fa-address-card-o nav_label col-lg-4'></label>
                <label for="education" class='fa fa-graduation-cap nav_label col-lg-4'></label>
                <!--                <label for="edit" class='fa fa-list-alt nav_label'></label>-->
            </nav>

            <article class='bio container'>
                <div class="form-group row">
                    <p class="error col-12" v-if="editError">
                        {{editError}}
                    </p>

                    <div class="form-group  col-lg-4">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" class="form-control" v-validate="'required'"
                               :class="{'input': true, 'is-invalid': errors.has('name') }" v-model="formEdit.name"
                        >
                        <!--<i v-show="errors.has('name')" class="fa fa-warning"></i>-->
                        <span v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</span>

                    </div>
                    <div class="form-group col-lg-4 ">
                        <label for="surname">Surname</label>
                        <input id="surname" type="text" name="surname" class="form-control "
                               :class="{'input': true, 'is-invalid': errors.has('surname') }"
                               v-validate="'required'" v-model="formEdit.surname">
                        <span v-show="errors.has('surname')" class="help is-danger">{{ errors.first('surname') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="father_name">Father Name</label>
                        <input id="father_name" type="text" name="father_name" class="form-control"
                               :class="{'input': true, 'is-invalid': errors.has('father_name') }"
                               v-validate="'required'"
                               v-model="formEdit.father_name">
                        <span v-show="errors.has('father_name')" class="help is-danger">{{ errors.first('father_name') }}</span>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="phone">Phone</label>
                        <input id="phone" type="text" name="phone"
                               class="form-control"
                               v-validate="'required'"
                               :class="{'input': true, 'is-invalid': errors.has('phone') }"
                               v-model="formEdit.phone">
                        <span v-show="errors.has('phone')" class="help is-danger">{{ errors.first('phone') }}</span>
                    </div>
                    <div class="form-group  col-lg-6">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control" v-validate="'required'"
                                v-model="formEdit.gender">
                            <option value="">Select a gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span v-if="errors.has('gender')" class="help is-danger" role="alert">{{ errors.first('gender') }}</span>
                    </div>
                    <div class="form-group  col-lg-6">
                        <label for="married_status">Married status</label>
                        <select id="married_status" name="married_status" class="form-control" v-validate="'required'"
                                v-model="formEdit.married_status">
                            <option value="">Select a status</option>
                            <option value="single">Single</option>
                            <option value="married">married</option>
                        </select>
                        <span v-if="errors.has('married_status')" class="help is-danger" role="alert">{{ errors.first('married_status') }}</span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="passport">Social number</label>
                        <input id="passport" type="text" name="passport"
                               class="form-control"
                               v-validate="'required'"
                               v-model="formEdit.passport">
                        <span v-if="errors.has('passport')" class="help is-danger" role="alert">{{ errors.first('passport') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="issue">Data of Issue</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="issue"
                                          format="dd-MM-yyyy"
                                          :class="{'input': true, 'is-invalid': errors.has('date_of_issue') }"
                                          name="date_of_issue" v-model="formEdit.date_of_issue"></vuejs-datepicker>

                        <span v-show="errors.has('date_of_issue')" class="help is-danger">{{ errors.first('date_of_issue') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="expiry">Data of Expiry</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="expiry"
                                          name="date_of_expiry"
                                          format="dd-MM-yyyy"
                                          :class="{'input': true, 'is-invalid': errors.has('date_of_expiry') }"
                                          v-model="formEdit.date_of_expiry"></vuejs-datepicker>
                        <span v-show="errors.has('date_of_expiry')" class="help is-danger">{{ errors.first('date_of_expiry') }}</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="bday">Birthday</label>
                        <vuejs-datepicker value="state.date" v-validate="'required'" id="bday"
                                          format="dd-MM-yyyy" :open-date="openDate"
                                          :class="{'input': true, 'is-invalid': errors.has('bday') }"
                                          name="bday" v-model="formEdit.bday"></vuejs-datepicker>
                        <span v-show="errors.has('bday')" class="help is-danger">{{ errors.first('bdsy') }}</span>
                    </div>
                </div>
            </article>
            <article class='info container '>
                <div class="form-group row ">
                    <div class="form-group col-lg-12">
                        <label for="workplace_name">Name of the workplace</label>
                        <input id="workplace_name" type="text" name="workplace_name" class="form-control"
                               v-validate="'required'"
                               :class="{'input': true, 'is-invalid': errors.has('workplace_name') }"
                               v-model="formEdit.workplace_name">
                        <span v-show="errors.has('workplace_name')"
                              class="help is-danger">{{ errors.first('workplace_name') }}</span>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">Work Address </p>
                            <div class="form-group col-lg-3">
                                <label for="w_region">Region</label>
                                <select id="w_region" name="w_region" class="form-control"
                                        :class="{'input': true, 'is-invalid': errors.has('w_region') }"
                                        v-validate="'required'" @change="getTerritory(formEdit.w_region,'w')"
                                        v-model="formEdit.w_region">
                                    <option v-for="(region, key) in regions" v-bind:value="key">{{region}}</option>
                                </select>
                                <span v-show="errors.has('w_region')" class="help is-danger">{{ errors.first('w_region') }}</span>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="w_city">City</label>
                                <select id="w_city" name="w_city" ref="w_city" class="form-control"
                                        v-validate="{ rules: { required: this.isWorkCityRequired}}"
                                        :class="{'input': true, 'is-invalid': errors.has('w_city') }"
                                        v-model="formEdit.w_city">
                                    <option v-for="(city, key) in w_cities" v-bind:value="key">{{city}}</option>
                                </select>
                                <span v-show="errors.has('w_city')"
                                      class="help is-danger">{{ errors.first('w_city') }}</span>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="w_territory">Territory</label>
                                <select id="w_territory" name="w_territory" ref="w_territory" class="form-control"
                                        v-validate="{ rules: { required: this.isWorkTerritoryRequired}}"
                                        :class="{'input': true, 'is-invalid': errors.has('w_territory') }"
                                        v-model="formEdit.w_territory"
                                        @change="getVillage(formEdit.w_territory,'w')">
                                    <option v-for="(territory, key) in w_territories" v-bind:value="key">{{territory}}
                                    </option>
                                </select>
                                <span v-show="errors.has('w_territory')"
                                      class="help is-danger">{{ errors.first('w_territory') }}</span>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="w_village">Village</label>
                                <select id="w_village" name="w_village" ref="w_village" class="form-control"
                                        v-validate="'required'" @change="getVillage(formEdit.w_territory,'w')">
                                    :class="{'input': true, 'is-invalid': errors.has('w_village') }"
                                    v-model="formEdit.w_village">
                                    <option v-for="(village, key) in w_villages" v-bind:value="key">{{village}}
                                    </option>
                                </select>
                                <span v-show="errors.has('w_village')" class="help is-danger">{{ errors.first('w_village') }}</span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="w_street">Street</label>
                                <input id="w_street" type="text" name="w_street" class="form-control"
                                       v-validate="'required'"
                                       :class="{'input': true, 'is-invalid': errors.has('w_street') }"
                                       v-model="formEdit.w_street">
                                <span v-show="errors.has('w_street')" class="help is-danger">{{ errors.first('w_street') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <div class="row ">
                            <p class="form-group-lg col-lg-12">Home Address </p>
                            <div class="form-group col-lg-3">
                                <label for="h_region">Region</label>
                                <select id="h_region" name="h_region" class="form-control"
                                        v-validate="'required'" @change="getTerritory(formEdit.h_region,'h')"
                                        :class="{'input': true, 'is-invalid': errors.has('h_region') }"
                                        v-model="formEdit.h_region">
                                    <option v-for="(region, key) in regions" v-bind:value="key">{{region}}</option>
                                </select>
                                <span v-show="errors.has('h_region')" class="help is-danger">{{ errors.first('h_region') }}</span>

                            </div>
                            <div class="form-group col-lg-3">
                                <label for="h_city">City</label>
                                <select id="h_city" name="h_city" ref="h_city" class="form-control"
                                        v-validate="{ rules: { required: this.isHomeCityRequired}}"
                                        :class="{'input': true, 'is-invalid': errors.has('h_city') }"
                                        v-model="formEdit.h_city">
                                    <option v-for="(city, key) in h_cities" v-bind:value="key">{{city}}</option>
                                </select>
                                <span v-show="errors.has('h_city')"
                                      class="help is-danger">{{ errors.first('h_city') }}</span>

                            </div>
                            <div class="form-group col-lg-3">
                                <label for="h_territory">Territory</label>
                                <select id="h_territory" name="h_territory" ref="h_territory" class="form-control"
                                        v-validate="{ rules: { required: this.isHomeTerritoryRequired}}"
                                        :class="{'input': true, 'is-invalid': errors.has('h_territory') }"
                                        v-model="formEdit.h_territory"
                                        @change="getVillage(formEdit.h_territory,'h')">
                                    <option v-for="(territory, key) in h_territories" v-bind:value="key">{{territory}}
                                    </option>
                                </select>
                                <span v-show="errors.has('h_territory')"
                                      class="help is-danger">{{ errors.first('h_territory') }}</span>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="h_village">Village</label>
                                <select id="h_village" name="h_village" ref="h_village" class="form-control"
                                        v-validate="'required'"
                                        :class="{'input': true, 'is-invalid': errors.has('h_village') }"
                                        v-model="formEdit.h_village">
                                    <option v-for="(village, key) in h_villages" v-bind:value="key">{{village}}
                                    </option>
                                </select>
                                <span v-show="errors.has('h_village')" class="help is-danger">{{ errors.first('h_village') }}</span>

                            </div>
                            <div class="form-group col-lg-12">

                                <label for="h_street">Street</label>
                                <input id="h_street" type="text" name="h_street" class="form-control"
                                       v-validate="'required'"
                                       :class="{'input': true, 'is-invalid': errors.has('h_street') }"
                                       v-model="formEdit.h_street">
                                <span v-show="errors.has('h_street')" class="help is-danger">{{ errors.first('h_street') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <article class='edu container'>
                <div class="form-group row">
                    <div class="form-group  col-lg-4">
                        <label for="profession">Profession</label>
                        <select id="profession" name="profession" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('profession') }"
                                v-model="formEdit.profession">
                            <option value="">Select a profession</option>
                            <option value="doctor">բժիշկ</option>
                            <option value="nurse">բուժ․ քույր</option>
                            <option value="pharmacist">դեղագործ</option>
                            <option value="provider">դեղագետ</option>
                        </select>
                        <span v-show="errors.has('profession')"
                              class="help is-danger">{{ errors.first('profession') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="education_id">Education</label>
                        <select id="education_id" name="education_id" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('education_id') }"
                                v-model="formEdit.education_id">
                            <option v-for="(edu, key) in educations" v-bind:value="key">{{edu}}</option>
                        </select>
                        <span v-show="errors.has('education_id')" class="help is-danger">{{ errors.first('education_id') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="specialty_id">Specialty</label>
                        <select id="specialty_id" name="specialty_id" class="form-control" v-validate="'required'"
                                :class="{'input': true, 'is-invalid': errors.has('specialty_id') }"
                                v-model="formEdit.specialty_id">
                            <optgroup v-for="(group, name) in specialties" :label="name">
                                <option v-for="(option, key) in group" :value="key">
                                    {{ option }}
                                </option>
                            </optgroup>
                        </select>
                        <span v-show="errors.has('specialty_id')"
                              class="help is-danger">{{ errors.first('specialty_id') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <div class="confirm-switch">
                            <input type="checkbox" id="confirm-switch"
                                   :class="{'input': true, 'is-invalid': errors.has('member_of_palace') }"
                                   checked="" name="member_of_palace" class="form-control"
                                   v-validate="'required'" v-model="formEdit.member_of_palace">
                            <label for="confirm-switch">Member of palace</label>
                        </div>
                        <span v-show="errors.has('member_of_palace')" class="help is-danger">{{ errors.first('member_of_palace') }}</span>
                    </div>
                    <div class="form-group  col-lg-12">
                        <div class="large-12 medium-12 small-12 filezone">
                            <input ref="files" v-on:change="handleFiles()"
                                   type="file" id="files" multiple
                                   name="files" v-validate="'required'"
                            >
                            <p>
                                Drop your files here <br>or click to search
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
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" v-validate="'required|email'"
                               :class="{'input': true, 'is-invalid': errors.has('email') }"
                               class="form-control" v-model="formEdit.email">
                        <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>
                    </div>

                    <div class="form-group  col-lg-8">
                        <div class="row">
                            <div class="col-lg-3" v-model="formEdit.diploma"
                                 v-for="diploma in formEdit.diplomas">
                                <img class="col-lg-12" :src="'/storage/diploma/'+diploma" :alt="diploma">
                                <div class="remove-container">
                                    <a class="remove" v-on:click="removeDiploma(diploma)">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="form-group col-lg-4">
                        <input type="submit" value="Edit" class="btn btn-outline-primary ml-auto">

                    </footer>
                </div>
            </article>
        </form>
    </div>
</template>

<script>
    import {editUser} from '../partials/auth';
    import {education, region, specialty, territory, village} from '../partials/help';
    import Datepicker from 'vuejs-datepicker';

    export default {
        props: ['input_name'],
        data() {
            return {
                formEdit: {
                    name: '',
                    surname: '',
                    father_name: '',
                    gender: '',
                    phone: '',
                    bday: '',
                    passport: '',
                    date_of_expiry: '',
                    date_of_issue: '',
                    married_status: '',
                    workplace_name: '',
                    h_region: '',
                    w_region: '',
                    h_city: '',
                    w_city: '',
                    h_territory: '',
                    w_territory: '',
                    w_village: '',
                    h_village: '',
                    w_street: '',
                    h_street: '',
                    profession: '',
                    specialty_id: '',
                    education_id: '',
                    member_of_palace: '',
                    email: '',
                    diplomas: ''
                },
                files: [],
                regions: [],
                w_cities: [],
                h_cities: [],
                w_territories: [],
                h_territories: [],
                w_villages: [],
                h_villages: [],
                educations: [],
                specialties: [],
                openDate: new Date('January 31 1980'),
                error:
                    null,
            }
        },
        created() {
            this.getAccountInfo();
            this.getRegions();
            this.getEducations();
            this.getSpecialties();
        },

        methods: {
            getEducations() {
                education()
                    .then(res => {
                        this.educations = res.edu;
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            getSpecialties() {
                specialty()
                    .then(res => {
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
            getTerritory(id, prefix) {
                territory(id)
                    .then(res => {

                        if (prefix === 'w') {
                            this.$refs.w_city.style.border = '1px solid #9f12ad';
                            this.$refs.w_territory.style.border = '1px solid #9f12ad';
                            this.w_cities = res.cities;
                            this.w_territories = res.territories;

                        } else {
                            this.$refs.h_city.style.border = '1px solid #9f12ad';
                            this.$refs.h_territory.style.border = '1px solid #9f12ad';
                            this.h_cities = res.cities;
                            this.h_territories = res.territories;
                        }
                    })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    });
            },
            getVillage(id, prefix) {
                village(id).then(res => {
                    if (prefix === 'w') {
                        this.$refs.w_village.style.border = '1px solid #9f12ad';
                        this.w_villages = res.villages;
                    } else {
                        this.$refs.h_village.style.border = '1px solid #9f12ad';
                        this.h_villages = res.villages;
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
                        let diplomas = JSON.parse(obj.user.diplomas);
                        this.$data.formEdit = obj.user;
                        this.$data.formEdit.w_region = w_address.w_region;
                        this.$data.formEdit.w_city = w_address.w_city;
                        this.$data.formEdit.w_village = w_address.w_village;
                        this.$data.formEdit.w_street = w_address.w_street;
                        this.$data.formEdit.h_region = h_address.h_region;
                        this.$data.formEdit.h_city = h_address.h_city;
                        this.$data.formEdit.h_village = h_address.h_village;
                        this.$data.formEdit.h_street = h_address.h_street;
                        this.$data.formEdit.diplomas = diplomas;
                        this.$data.formEdit.token = token;
                        this.getTerritory(this.$data.formEdit.w_region, 'w');
                        this.getTerritory(this.$data.formEdit.h_region, 'h');
                    })
            },
            update() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log('Form Submitted!');
                        return;
                    }
                    console.log('Correct them errors!');
                });

                editUser(this.$data.formEdit.account_id, this.$data.formEdit,
                    this.files, this.$data.formEdit.token)
                    .then(res => {
                        this.$store.commit("editSuccess", res);
                        this.$router.push({path: '/account'});
                    })
                    .catch(error => {
                        this.$store.commit("editFailed", {error});
                    });

            },

            removeFile(key) {
                this.files.splice(key, 1);
                this.getImagePreviews();
            },
            removeDiploma(key) {
                this.formEdit.diplomas.splice(key, 1)

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
            isHomeCityRequired() {
                if (this.$data.formEdit.h_territory === '')
                    return true;
                return false;
            },
            isWorkCityRequired() {
                if (this.$data.formEdit.w_territory === '')
                    return true;
                return false;
            },
            isHomeTerritoryRequired() {
                if (this.$data.formEdit.h_city === '')
                    return true; // cellphone is required
                return false;
            },
            isWorkTerritoryRequired() {
                if (this.$data.formEdit.w_city === '')
                    return true; // cellphone is required
                return false;
            },
            editError() {
                return this.$store.getters.editError
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
