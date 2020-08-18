<template>
    <div class="login row justify-content-center m-0">

    </div>
</template>

<script>
    import {verify} from '../partials/auth';

    export default {
        data() {
            return {
                error: null
            }
        },
        mounted() {

            this.verification(this.$route.params.id, this.$route.params.key);
        },
        methods: {
            verification(id, key) {
                verify(id, key)
                    .then(res => {
                        this.$store.commit("verifySuccess", res);
                        this.$router.push({path: '/login'});
                    })
                    .catch(error => {
                        this.$store.commit("verifyFailed", {error});
                    })
            },

        },

    }
</script>

<style scoped>
    .error {
        text-align: center;
        color: red;
    }
</style>
