import axios from 'axios'
import useMessageStore from "@/stores/messageStore";


export function registerAxiosInterceptor() {
    const messageStore = useMessageStore();

    axios.interceptors.response.use(function (response)
    {

        console.log('requête terminée avec succès.', response);
        return response;
    }, function (error)
    {
        let msg = error != null && error.response && error.response.data.message ? error.response.data.message : "Une erreur est survenue. Veuillez réessayer.";

        messageStore.addMessage(msg, true, false);
        console.log('requête terminée avec erreur.', error);
        return Promise.reject(error);
    });
};