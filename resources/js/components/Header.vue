<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
<!--            <router-link class="navbar-brand" to="/">Authentication  Laravel 5.6/Vue SPA</router-link>-->
          <div class="col-lg-6 col-sm-6 col-4 header-top-left">
              <a href="tel:+9530123654896">
                  <span class="fa fa-phone"></span>
                  <span class="text">
								<span class="text">+953012 3654 896</span>
							</span>
              </a>
              <a href="mailto:support@colorlib.com">
                  <span class="fa fa-envelope"></span>
                  <span class="text">
								<span class="text">support@colorlib.com</span>
							</span>
              </a>
          </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ml-auto">
                    <template v-if="!currentUser">
                        <li>
                            <router-link to="/login" class="nav-link">Մուտք</router-link>
                        </li>
                        <li>
                            <router-link to="/register" class="nav-link">Գրանցվել</router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <router-link to="/account" class="nav-link">Profile</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{currentUser.name}} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'app-header',
    methods:{
        logout(){
            this.$store.commit('logout');
            this.$router.push('/login');
        }
    },
    computed:{
        currentUser(){
            return this.$store.getters.currentUser
        }
    }
}
</script>