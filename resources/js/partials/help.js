export function education() {
    return new Promise((res, rej) => {
        axios.post('/api/edu')
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
