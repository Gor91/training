import texts from '../components/json/registertexts.json';

export function getVideoDetails(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/videoinfo', credentials)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}

export function education(id) {
    return new Promise((res, rej) => {
        axios.post('/api/edu/' + id)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}

export function specialty(id) {

    return new Promise((res, rej) => {
        axios.post('/api/spec/' + id)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}

export function region() {
    return new Promise((res, rej) => {
        axios.post('/api/regions')
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}

export function territory(id) {
    return new Promise((res, rej) => {
        axios.post('/api/territory/' + id)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}


export function profession() {
    return new Promise((res, rej) => {
        axios.get('/api/prof/')
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}


export function applicantcount() {
    return new Promise((res, rej) => {
        axios.post('/api/applicantcount/')
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}

export function coursescount() {
    return new Promise((res, rej) => {
        axios.post('/api/coursescount/')
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}
