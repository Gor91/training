 <template>
     <h1>ABOUTTTT</h1>
 </template>

<script>
    import {pagesData} from '../partials/auth';
export default {
    methods:{
        aboutPage: function() {
            pagesData("hhh")
                .then(res => {
                    console.log("'kuku");
                    //this.$store.commit("registerSuccess", res);
                    //this.$router.push({path: '/login'});
                })
                .catch(error => {
                    console.log('error');
                    // this.$store.commit("registerFailed", {error});
                })
        }
    },
    beforeMount() {
        this.aboutPage()
    }
}
</script>

