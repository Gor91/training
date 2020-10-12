<template>
    <div class="container-fluid">
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="banner_content text-center">
                                <div class="page_link" v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                    <router-link :to="{ name: 'home' }" class="nav-link">{{text.main}}</router-link>
                                    <router-link to="" class="nav-link">{{b.text}}</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <VCreditCard :trans="translations"/>
    </div>
    <!--@change="creditInfoChanged-->
</template>


<script>
    import pagestext from './json/pages.json';
    import VCreditCard from 'v-credit-card';
    import 'v-credit-card/dist/VCreditCard.css';
    const translations = {
        name: {
            label: 'Nombre',
            placeholder: 'Nombre completo'
        },
        card: {
            label: 'Número de tarjeta',
            placeholder: 'Número de tarjeta'
        },
        expiration: {
            label: 'Expiration'
        },
        security: {
            label: 'Código de seguridad',
            placeholder: 'Código'
        }
    };
    export default {
        name: "paymentForm",
        props:['direction'],
        data: function () {
            return {
                // name: '',
                // cardNumber: '',
                // expiration: '',
                // security: '',
                translations,
                text: pagestext,
            };
        },
        components: {
            VCreditCard
        },
        watch: {

        },

        mounted: function () {

        },
        methods: {
            creditInfoChanged(values) {
                console.log('Credit card fields', values);
                for (let key in values) {
                    this[key] = values[key];
                }
            }
        },
        computed: {
            currentUser: function () {
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            }
        },
    };
</script>
