<template>
    <div class="container">
        <router-link :to="'/edit/'+currentUser.id" class="button is-fullwidth">Edit</router-link>
        <div id="preview">
            <img v-bind:src="imgName" class="avatar">
            <i class="fa fa-camera-retro fa-2x icon"></i>
            <input type="file" @change="onFileChange"/>

        </div>

        <h3>{{currentUser.name}} {{currentUser.surname}} {{currentUser.father_name}}</h3>
        <p>{{currentUser.prof.profession}}</p>
        <p>{{currentUser.user.email}}</p>
    </div>
</template>

<script>
    import {uploadAvatar} from '../partials/auth';

    export default {
        props: ['input_name'],
        data() {
            return {
                avatar: [],
                url: null,
            }
        },
        computed: {
            currentUser: function () {
                if (!this.$store.getters.currentUser)
                    return JSON.parse(localStorage.getItem('user'));
                return this.$store.getters.currentUser
            },
            imgName: function () {
                let src = "";
                let img_name = this.$store.getters.currentUser.image_name;
                let pattern = /\d+/ig;
                if (pattern.exec(img_name))
                    src = "/uploads/images/avatars/" + img_name;
                else
                    src = "/images/avatars/" + img_name;
                return src;
            },
        },
        methods: {

            upload(file) {
                // let file = this.$refs.avatar.files[0];
                uploadAvatar(file, this.currentUser.id, this.currentUser.token)
                    .then(res => {
                        this.$store.commit("uploadSuccess", res);
                        this.$nextTick(() => {
                            let ls = JSON.parse(localStorage.getItem('user'));
                            ls.image_name = res.user.image_name;
                            localStorage.setItem('user', JSON.stringify(ls))
                            // console.log('str',localStorage.getItem('user'))
                        })
                        // this.$router.push({path: '/dashboard'});
                    })
                    .catch(error => {
                        this.$store.commit("uploadFailed", {error});
                    });
            },

            onFileChange(e) {
                const file = e.target.files[0];
                // this.url = URL.createObjectURL(file);
                // console.log(file)
                // console.log(this.url)
                this.upload(file);
            }

        }
    }
</script>

<style scoped>
    #preview {
        display: flex;
        position: relative;
        width: 120px;
    }

    .avatar {
        width: 100%;
        border-radius: 50%;
        border: 2px solid #202095;
        padding: 6px;
        position: relative;
        z-index: 0;
    }

    input[type="file"], .icon {
        opacity: 0;
        position: absolute;
        z-index: 1;
        bottom: 0;
        width: 100%;
    }

    .icon {
        /*z-index: 3;*/
        right: 0;
        opacity: 1;
        cursor: pointer;
        border-radius: 50%;
        width: 36px;
        background-color: #9c8fa2;
        padding: 5px;
    }

</style>