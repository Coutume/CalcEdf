import axios from 'axios'

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data

    console.log('requête terminée avec succès.', response);
    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error

    console.log('requête terminée avec erreur.', error);
    return Promise.reject(error);
});

export default axios;