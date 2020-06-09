import {getLoggedinUser} from './partials/auth';

const user = getLoggedinUser();
export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        isUploadedIn: !!user,
        loading: false,
        auth_error: null,
        reg_error: null,
        edit_error: null,
        registeredUser: null,
        editedUser: null,
        get_content_error:null,
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedin(state) {
            return state.isLoggedin;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        regError(state) {
            return state.reg_error;
        },
        registeredUser(state) {
            return state.registeredUser;
        },
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedin = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        uploadAvatar(state) {
            state.loading = true;
            state.auth_error = null;
        },
        uploadSuccess(state, payload) {
            state.auth_error = null;
            state.isUploadedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

        },
        uploadFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedin = false;
            state.currentUser = null;
        },
        registerSuccess(state, payload) {
            state.reg_error = null;
            state.registeredUser = payload.user;
        },
        registerFailed(state, payload) {
            state.reg_error = payload.error;
        },
        editSuccess(state, payload) {
            state.edit_error = null;
            state.editedUser = payload.user;
        },
        editFailed(state, payload) {
            state.edit_error = payload.error;
        },
        getContentFailed(state, payload) {
            state.get_content_error = payload.error;
        },
    },
    actions: {
        login(context) {
            context.commit("login");
        }
    }
};