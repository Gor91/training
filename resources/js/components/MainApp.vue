<template>
    <div class="main">
       <Header />
        <Home />
       <div class="content">
           <router-view></router-view>
       </div>
        <Secondscreen />
        <TemReg />
        <Footer />
    </div>
</template>

<script>
import Header from './Header.vue';
import Home from './Home.vue';
import Secondscreen from './Secondscreen.vue';
import TemReg from './TemReg.vue';
import Footer from './Footer.vue';
export default {
    name: 'main-App',
    components: { Header, Home, Secondscreen, TemReg, Footer }
}
</script>
