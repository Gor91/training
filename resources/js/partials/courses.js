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

export function getCourseDetails(id) {
    return new Promise((res, rej) => {
        axios.post('/api/coursedetails/' + id)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error);
            })
    })
}

export function getCoursesById(id) {
    return new Promise((res, rej) => {
        axios.post('/api/getcoursebyspec/' + id)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej(texts.error);
            })
    })
}
