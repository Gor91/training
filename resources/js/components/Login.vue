<template>
    <div class="login row justify-content-center m-0">
        <div class="col-md-6">

            <div class="register_form">
                <h3>{{texts.enter}}</h3>
                <form @submit.prevent="authenticate" class="form_area">

                    <div class="form-group row">

                        <div v-if="registeredUser" class="text-success">{{texts.registred}}</div>
                        <div v-if="verifiedUser" class="text-success">{{texts.verified}}</div>

                    </div>
                    <div class="form-group row" v-if="unverifiedError">
                        <p class="error m-auto">
                            {{unverifiedError}}
                        </p>
                    </div>
                    <div class="form-group row" v-else-if="unauthorizedError">
                        <p class="error m-auto">
                            {{unauthorizedError}}
                        </p>
                    </div>
                    <div class="form-group row" v-else="authError">
                        <p class="error m-auto">
                            {{authError}}
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 form_group m-auto">
                            <input autocomplete="off" id="email" type="email" name="email"
                                   v-validate="'required|email'" :placeholder="texts.email"
                                   :class="{'input': true, 'is-invalid': errors.has('email') }"
                                   class="form-control p-4" v-model="formLogin.email" :data-vv-as="texts.email">
                            <span v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</span>

                            <input autocomplete="off" id="password" type="password" name="password"
                                   class="form-control p-4"
                                   v-validate="'required|min:8'" v-model="formLogin.password"
                                   :class="{'input': true, 'is-invalid': errors.has('password') }"
                                   :data-vv-as="texts.password" :placeholder="texts.password">
                            <span v-show="errors.has('password')"
                                  class="help is-danger">{{ errors.first('password') }}</span>

                        </div>

                        <div class="col-lg-6 text-center m-auto">
                            <div class="btn btn-link">
                                <router-link to="/reset-password" class="purple"> {{texts.forgot}}</router-link>
                            </div>

                            <input type="submit" :value="texts.enter" class="btn primary-btn">
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import {login, resetPassword} from '../partials/auth';
    import registertexts from './json/registertexts.json';

    export default {
        data() {
            return {
                formLogin: {
                    email: '',
                    password: ''
                },
                error: null,
                texts: registertexts,
            }
        },
        methods: {
            authenticate() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        login(this.$data.formLogin)
                            .then(res => {
                                this.$store.commit("loginSuccess", res);
                                this.$router.push({path: '/account'});
                            })
                            .catch(error => {
                                let msg = "", pattern = /\d+/,
                                    e = pattern.exec(error);
                                switch (e[0]) {
                                    case '400':
                                        error = this.texts.unverified;
                                        msg = 'unverified';
                                        break;
                                    case '401':
                                        error = this.texts.unauthorized;
                                        msg = 'unauthorized';
                                        break;
                                    default:
                                        error = this.texts.reject;
                                        msg = 'loginFailed';
                                }

                                this.$store.commit(msg, {error});
                            });
                        return;
                    }
                    console.log('Correct them errors!');
                });
                this.$store.dispatch('login');

            },
            reset() {
                resetPassword().then(res => {
                    // this.professions = res.prof;
                })
                    .catch(error => {
                        this.$store.commit("getContentFailed", {error});
                    })
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError
            },
            unauthorizedError() {
                return this.$store.getters.unauthorizedError
            },
            unverifiedError() {
                return this.$store.getters.unverifiedError
            }
            ,
            registeredUser() {
                return this.$store.getters.registeredUser
            },
            verifiedUser() {
                console.log('verifiedUser', this.$store.getters.verifiedUser);
                return this.$store.getters.verifiedUser
            }
        }
    }
</script>

<style scoped>
    .error {
        text-align: center;
        color: red;
    }
</style>
