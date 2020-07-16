<template>
    <div class="container-fluid">
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="banner_content text-center">
                            <div class="page_link"  v-for="b in $route.meta.breadCrumbs" :key="b.to">
                                <router-link :to="{ name: 'home' }" class="nav-link">ԳԼԽԱՎՈՐ</router-link>
                                <router-link to="" class="nav-link">{{b.text}}</router-link>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pb-5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d195167.5734712645!2d44.34848097149138!3d40.15356842368178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406aa2dab8fc8b5b%3A0x3d1479ae87da526a!2sYerevan%2C%20Armenia!5e0!3m2!1sen!2s!4v1589744207208!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div></div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="fa fa-home"></i>
                            <h6>{{texts.address}}</h6>
                            <p>{{texts.street}}</p>
                        </div>
                        <div class="info_item">
                            <i class="fa fa-phone"></i>
                            <h6><a href="#">{{texts.phone}}</a></h6>
                            <p>{{texts.workingtime}}</p>
                        </div>
                        <div class="info_item">
                            <i class="fa fa-envelope"></i>
                            <h6><a href="#">{{texts.mail}}</a></h6>
                            <p>{{texts.mailtext}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <form class="row contact_form" action="contact_process.php" method="post" id="contactForm"
                          novalidate="novalidate">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" :placeholder="texts.name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" :placeholder="texts.email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" :placeholder="texts.subject">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="1" :placeholder="texts.message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" value="submit" class="btn primary-btn">{{texts.send}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->
</div>
</template>

<script>
    import contacttext from './json/contacttext.json'
    export default {
        data() {
            return {
                nurse: '/css/template/img/nurse.svg',
                doctor:'/css/template/img/doctor.png',
                pharmacy:'/css/template/img/pharmacy-symbol.svg',
                phar:'/css/template/img/pharmacy.png',
                texts: contacttext

            };
        },

    }
</script>

