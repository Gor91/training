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

            <VCreditCard :trans="translations" @change="creditInfoChanged" v-model="paymentForm"/>

    </div>

</template>


<script>
    import text from './json/registertexts.json';
    import VCreditCard from 'v-credit-card';
    import 'v-credit-card/dist/VCreditCard.css';

    const translations = {
        name: {
            label: text.fullname,
            placeholder: `${text.name} ${text.fathername}`,
        },
        card: {
            label: text.cardnumber,
            placeholder: text.cardnumber
        },
        expiration: {
            label: text.date_of_expire
        },
        security: {
            label: text.securitycode,
            placeholder: text.security
        }
    };
    export default {
        name: "paymentForm",
        props: ['direction'],
        data: function () {
            return {
                name: '',
                cardNumber: '',
                expiration: '',
                security: '',
                translations,
                text: text,
                paymentForm: ""
            };
        },
        components: {
            VCreditCard
        },
        watch: {},

        mounted: function () {

        },
        methods: {
            creditInfoChanged(values) {

                for (let key in values) {
                    if (values.hasOwnProperty(key)) {
                        this[key] = values[key];
                        console.log('Credit card fields', values);
                    }
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
