export function educate() {
    return new Promise((res, rej) => {
        axios.post('/api/educate/')
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
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
                rej('An error occured.. try again later.')
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
                rej('An error occured.. try again later.')
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
                rej('An error occured.. try again later.')
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
                rej('An error occured.. try again later.')
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
                rej('An error occured.. try again later.')
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
                rej('An error occured.. try again later.')
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
                rej('An error occured.. try again later.')
            })
    })
}