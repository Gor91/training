export function registerUser(credentials, files) {
    let formData = new FormData();

    for (let key in credentials) {
        if(credentials.hasOwnProperty(key))
        formData.append(key, credentials[key]);
        // JSON.stringify(credentials));
    }
    for (let i = 0; i < files.length; i++) {
        if (files[i].id) {
            continue;
        }
        formData.append(`diploma_${i + 1}`, files[i]);
    }
    return new Promise(function (res, rej) {
        axios.post('/api/auth/register',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
            })
    })
}

export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/login', credentials)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('Wrong Email/Password combination.')
            })
    })
}

export function resetPassword() {

    return new Promise((res, rej) => {
        axios.get('/api/password/request')
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('Wrong Email/Password combination.')
            })
    })
}

export function getLoggedinUser() {
    const userStr = localStorage.getItem('user');

    if (!userStr) {
        return null
    }

    return JSON.parse(userStr);
}

export function uploadAvatar(file, id, token) {
    let data = new FormData();
    data.append('avatar', file);
    data.append('_method', 'PUT');
    data.append('token', token);
    return new Promise((res, rej) => {
        axios.post('/api/auth/avatar/' + id, data,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + token
                }
            }
        ).then(response => {
            res(response.data);
        })
            .catch(err => {
                rej('Wrong uploaded a avatar.')
            })
    })
}

export function getPagesData(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/about', credentials)
            .then(response => {
                res(response.data);
                console.log(credentials);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
            })
    })
}

export function editUser(id, credentials, files, token) {
    let formData = new FormData();

    for (let key in credentials) {
        if (credentials.hasOwnProperty(key))
            formData.append(key, credentials[key]);
    }
    // for (let i = 0; i < files.length; i++) {
    //     if (files[i].id) {
    //         continue;
    //     }
    //     formData.append(`diploma_${i + 1}`, files[i]);
    // }
    formData.append('_method', 'PUT');
    formData.append('token', token);
    return new Promise(function (res, rej) {
        // console.log('id',token)
        axios.post('/api/auth/edit/' + id,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
            })
    })
}

export function approveUser(id, credentials, files, token) {
    let formData = new FormData();

    for (let key in credentials) {
        if (credentials.hasOwnProperty(key))
            formData.append(key, credentials[key]);
    }
    for (let i = 0; i < files.length; i++) {
        if (files[i].id) {
            continue;
        }
        formData.append(`diploma_${i + 1}`, files[i]);
    }
    formData.append('_method', 'PUT');
    formData.append('token', token);
    return new Promise(function (res, rej) {
        // console.log('id',token)
        axios.post('/api/auth/approve/' + id,
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
            })
    })
}

export function changePassword(id, credentials, token) {
    let formData = new FormData();

    for (let key in credentials) {
        if (credentials.hasOwnProperty(key))
            formData.append(key, credentials[key]);
    }
    formData.append('_method', 'PUT');
    formData.append('_token', token);
    return new Promise(function (res, rej) {
        axios.post('/api/auth/changePass/' + id,
            formData,
            {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
            })
    })
}
