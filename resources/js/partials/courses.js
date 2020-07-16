
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
