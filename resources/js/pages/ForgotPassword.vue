<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="register_form">
                    <h3>{{texts.resetpassword}}</h3>
                    <div class="card-body">
                        <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
                            <div class="form-group">
                                <input type="email" id="email" class="form-control" placeholder="էլ.հասցե"
                                       v-model="email" required>
                            </div>
                            <button type="submit" class="btn primary-btn">{{texts.resetlink}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import registertexts from '../components/json/registertexts.json'
    export default {
        data() {
            return {
                email: null,
                has_error: false,
                texts: registertexts,
            }
        },
        methods: {
            requestResetPassword() {
                axios.post("/api/reset-password",
                    {email: this.email}).then(result => {
                    this.response = result.data;
                    console.log(result.data);
                }, error => {
                    console.error(error);
                });
            }
        }
    }
</script>