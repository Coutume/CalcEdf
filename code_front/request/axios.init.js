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
        messageStore.addMessage("Une erreur est survenue. Veuillez réessayer.", true, false);
        console.log('requête terminée avec erreur.', error);
        return Promise.reject(error);
    });
};