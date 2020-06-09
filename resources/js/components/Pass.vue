<template>
    <div class="login  justify-content-center container-fluid">
        <form @submit.prevent="update" class="row" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <article class='container'>
                <div class="form-group ">
                    <p class="error col-12" v-if="editError">
                        {{editError}}
                    </p>
                    <div class="form-group  col-lg-4">
                        <label for="old_password">Old Password</label>
                        <input id="old_password" type="password" name="old_password" class="form-control"
                               v-validate="'required|min:8'" v-model="formEdit.old_password"
                               :class="{'input': true, 'is-invalid': errors.has('old_password') }"
                        >
                        <span v-show="errors.has('old_password')"
                              class="help is-danger">{{ errors.first('old_password') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" class="form-control"
                               v-validate="'required|min:8'" v-model="formEdit.password"
                               :class="{'input': true, 'is-invalid': errors.has('password') }"
                        >
                        <span v-show="errors.has('password')"
                              class="help is-danger">{{ errors.first('password') }}</span>
                    </div>
                    <div class="form-group  col-lg-4">
                        <label for="re_password">Confirm Password</label>
                        <input id="re_password" type="password" name="re_password" class="form-control"
                               :class="{'input': true, 'is-invalid': errors.has('re_password') }"
                               v-validate="'required|min:8'" v-model="formEdit.re_password">
                        <span v-show="errors.has('re_password')" class="help is-danger">{{ errors.first('re_password') }}</span>
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
    import {changePassword} from '../partials/auth';

    export default {
        data() {
            return {
                formEdit: {
                    old_password: '',
                    password: '',
                    re_password: ''
                },
                error:
                    null,
            }
        },
        methods: {
            update() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log('Form Submitted!');
                        return;
                    }
                    console.log('Correct them errors!');
                });
                let user = JSON.parse(localStorage.getItem('user'));
                const token = user.token;
                const id = user.id;

                changePassword(id, this.$data.formEdit, token)
                    .then(res => {

                        if (!res.success) {
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
            }
        },
        computed: {
            editError() {
                return this.$store.getters.editError
            }
        },
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
</style>
