<template>
    <div class="container">
        <router-link :to="'/edit/'+currentUser.id" class="button is-fullwidth">Edit</router-link>
        <router-link :to="'/changePassword/'+currentUser.id" class="button is-fullwidth">Change Password</router-link>
        <img v-bind:src="imgName" class="avatar">
        <form @submit.prevent="upload" class="row" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <div class="filezone">
                <input id="avatar" type="file" @change="changedAvatar"
                       ref="avatar">
            </div>
            <div v-for="(file, key) in avatar" class="file-listing">
                <img class="preview" v-bind:ref="'preview'"/>

                <div class="success-container" v-if="file.id > 0">
                    Success
                    <input type="hidden" :name="input_name" :value="file.id"/>
                </div>
            </div>
            <input type="submit" value="Change Avatar" class="btn btn-outline-primary ml-auto">
        </form>
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
                    src = "/storage/images/avatars/" + img_name;
                else
                    src = "/images/avatars/" + img_name;
                return src;
            },
        },
        methods: {
            changedAvatar() {
                let uploadedFiles = this.$refs.avatar.files;
                for (var i = 0; i < uploadedFiles.length; i++) {
                    this.avatar.push(uploadedFiles[i]);
                }

                this.getImagePreviews();

            },
            getImagePreviews() {
                for (var i = 0; i < this.avatar.length; i++) {
                    if (/\.(jpe?g|png|gif)$/i.test(this.avatar[i].name)) {
                        let reader = new FileReader();
                        reader.addEventListener("load", function () {
                            this.$refs['preview'][0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL(this.avatar[i]);
                    } else {
                        this.$nextTick(function () {
                            this.$refs['preview'][0].src = '/images/avatars/generic.png';
                        });
                    }
                }
            },
            upload() {
                let file = this.$refs.avatar.files[0];
                uploadAvatar(file, this.currentUser.id, this.currentUser.token)
                    .then(res => {
                        this.$store.commit("uploadSuccess", res);
                        this.$nextTick(() => {
                            let ls = JSON.parse(localStorage.getItem('user'));
                            ls['image_name'] = res.avatar;

                            localStorage.setItem('user', JSON.stringify(ls))
                        })
                        // this.$router.push({path: '/dashboard'});
                    })
                    .catch(error => {
                        this.$store.commit("uploadFailed", {error});
                    });
            }

        }
    }
</script>

<style scoped>
    .avatar {
        width: 120px;
        border-radius: 50%;
        border: 2px solid #202095;
        padding: 5px
    }

    .is-danger, .fa-warning {
        color: red;
    }

    input[type="file"] {
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }

    form {
        position: relative;
    }

    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 10px;
        position: absolute;
        cursor: pointer;
        left: 100px;
    }

    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }

    div.file-listing img {
        max-width: 90%;
    }

    div.file-listing {
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img {
        height: 100px;
    }

    div.success-container {
        text-align: center;
        color: green;
    }

    div.remove-container {
        text-align: center;
    }

    div.remove-container a {
        color: red;
        cursor: pointer;
    }

    a.submit-button {
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }
</style>