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
        verify_error: null,
        editError: null,
        registeredUser: null,
        verifiedUser: null,
        editedUser: null,
        get_content_error: null,
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
        verifiedUser(state) {
            return state.verifiedUser;
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
        verifySuccess(state, payload) {
            state.verify_error = null;
            state.verifiedUser = payload.success;
        },
        verifyFailed(state, payload) {
            state.verify_error = payload.error;
        },
        editSuccess(state, payload) {
            state.editError = null;
            state.editedUser = payload.user;
        },
        editFailed(state, payload) {
            state.editError = payload.error;
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
