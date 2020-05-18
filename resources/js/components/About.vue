<template>
    <h1>ABOUTTTT</h1>
</template>

<script>
    import {getPagesData} from '../partials/auth';
    export default {
        // data(){
        //     return {
        //         formLogin: {
        //             email: '',
        //             password: ''
        //         },
        //         error: null
        //     }
        // },
        methods:{
         aboutpage: function() {
             getPagesData("hhh")
                 .then(res => {
                 console.log(res.data);
                 //this.$store.commit("registerSuccess", res);
                 //this.$router.push({path: '/login'});
             })
                 .catch(error => {
                     console.log('error');
                    // this.$store.commit("registerFailed", {error});
                 })
                }
         },
          beforeMount(){
            this.aboutpage()
         },
    }
</script>
