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
export function specialty() {
    return new Promise((res, rej) => {
        axios.post('/api/spec')
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
        axios.post('/api/territory/'+id)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
            })
    })
}
export function village(id) {
    return new Promise((res, rej) => {
        axios.post('/api/village/'+id)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('An error occured.. try again later.')
            })
    })
}
