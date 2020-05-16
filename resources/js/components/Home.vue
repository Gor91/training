 <template>
    <!--div class="container-fluid">
        <!--================ Start Header Menu Area =================-->
        <!--header class="header_area">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <!--a class="navbar-brand logo_h" href="index.html"><img :src="image_src" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <!--div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="index.html">Գլխավոր</a></li>
                            <li class="nav-item"><router-link :to="{ name: 'about' }" class="nav-link">Մեր մասին</router-link></li>

                            <li class="nav-item"><a class="nav-link" href="lessons.html">Դասընթացներ</a></li>
                            <li class="nav-item"><router-link :to="{ name: 'contact' }" class="nav-link">Հետադարձ կապ</router-link></li>
                         </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--================ End Header Menu Area =================-->
    <!--/div-->
</template>

<script>
export default {

        data() {
            return {
                image_src: '/css/frontend/img/logo.png',
            };
        },

}
</script>