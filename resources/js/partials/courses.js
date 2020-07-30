
export function getCoursesTitle(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/coursestitle', credentials)
            .then(response => {
                res(response.data);

            })
            .catch(err => {
                rej('An error occured.. try again later.');
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
                rej('An error occured.. try again later.');
            })
    })
}
export function getCourseDetails(credentials) {
    return new Promise((res, rej) => {
        axios.post('/api/coursedetails/'+credentials)
            .then(response => {
                res(response.data);

            })
            .catch(err => {
                rej('An error occured.. try again later.');
            })
    })
}
