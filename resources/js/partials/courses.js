import texts from '../components/json/registertexts.json';

export function getCoursesTitle(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/coursestitle', credentials)
            .then(response => {
                res(response.data);

            })
            .catch(err => {
                rej(texts.error);
            })
    })
}

export function getAllCourses(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/allcourses', credentials)
            .then(response => {
                res(response.data);

            })
            .catch(err => {
                rej(texts.error);
            })
    })
}

export function getCourseDetails(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/coursedetails', credentials)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error);
            })
    })
}

export function checkFinishedVideo(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/auth/finishedvideo', credentials)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error);
            })
    })
}

export function getCoursesById(credentials) {
    // let data = new FormData();
    // data.append('token', token);

    return new Promise((res, rej) => {
        axios.post('/api/auth/getcoursebyspec', credentials,
        )
            .then(response => {
                console.log(response)
                res(response.data);
            })
            .catch(err => {
                rej(texts.error);
            })
    })
}
export function getBookById(credentials) {

    return new Promise((res, rej) => {
        axios.post('/api/auth/getbook', credentials,
        )
            .then(response => {
                console.log(response)
                res(response.data);
            })
            .catch(err => {
                rej(texts.error);
            })
    })
}
