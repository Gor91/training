<template>
    <div class="login row justify-content-center">
        <div class="col-md-6">
            <div v-if="registeredUser" class="text-success">Thank you {{registeredUser.name}}.You can now login</div>
           <div class="register_form">
                    <h3>Գրանցվել</h3>
                    <form @submit.prevent="authenticate" class="form_area">
                        <div class="form-group row" v-if="authError">
                            <p class="error m-auto">
                                {{authError}}
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 form_group m-auto">
                            <input id="email" type="email" class="form-control p-4" v-model="formLogin.email" placeholder="էլ.հասցե">
                            <input id="password" type="password" class="form-control p-4" v-model="formLogin.password" placeholder="Գաղտնաբառ">
                             </div>
                        <div class="col-lg-6 text-center m-auto">
                            <input type="submit" value="Մուտք" class="btn primary-btn">
                        </div>
                </div>
                    </form>

           </div>
        </div>
    </div>
</template>

<script>
import {login} from '../partials/auth';
export default {
    data(){
        return {
            formLogin: {
            email: '',
            password: ''
        },
        error: null
        }
    },
    methods:{
        authenticate(){
            this.$store.dispatch('login');

        login(this.$data.formLogin)
            .then(res => {
                this.$store.commit("loginSuccess", res);
                this.$router.push({path: '/account'});
            })
            .catch(error => {
                this.$store.commit("loginFailed", {error});
            })
        }
    },
    computed:{
        authError(){
            return this.$store.getters.authError
        },
        registeredUser(){
            return this.$store.getters.registeredUser
        }
    }
}
</script>

<style scoped>
.error{
    text-align: center;
    color: red;
}
</style>