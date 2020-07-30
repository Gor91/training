<template>
    <div class="main">
        <Header />
        <Banner v-if="$route.path!='/login' && $route.path!='/register' && $route.path!='/account' && $route.path!='/reset-password' " />
        <div class="content">
            <router-view></router-view>
        </div>
        <Secondscreen v-if="$route.path!='/register'" />
        <TemReg />
        <Footer />
    </div>
</template>

<script>
    import Header from './Header.vue';
    import Banner from './Banner.vue';
    import Secondscreen from './Secondscreen.vue';
    import TemReg from './TemReg.vue';
    import Footer from './Footer.vue';
    export default {
        name: 'main-App',
        components: { Header, Banner, Secondscreen, TemReg, Footer }
    }
</script>
