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

export function addPoints(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/addpoint' ,credentials)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error)
            })
    })
}
