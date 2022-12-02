import {defineStore} from 'pinia'
import axios from 'axios'
import useLoadingStore from '@/stores/loadingStore.js'
import useMessageStore from '@/stores/messageStore.js'

export default defineStore('main', {
    state: () => (
        {
            compteurs: []
        }
    ),
    getters: {

    },
    actions: {
        async ajouterFacture(facture)
        {
            const loadingStore = useLoadingStore();
            const messageStore = useMessageStore();
            try
            {
                loadingStore.beginLoading('Ajout de la facture...');
                let data = await axios.post(import.meta.env.VITE_URL_API + 'facture/ajouter', facture);
                messageStore.addMessage("Facture ajoutée.", false, true);
            }
            finally
            {
                loadingStore.finishLoading('Ajout de la facture...');
            }
        },
        async getHistoFacture()
        {
            const loadingStore = useLoadingStore();
            try
            {
                loadingStore.beginLoading('Récupération des factures...');
                let data = await axios.get(import.meta.env.VITE_URL_API + 'facture/lister');

                return data.data;
            }
            finally
            {
                loadingStore.finishLoading('Récupération des factures...');
            }
        },
        async getCompteurs()
        {
            const loadingStore = useLoadingStore();
            try
            {
                loadingStore.beginLoading('Récupération des compteurs...');
                let data = await axios.get(import.meta.env.VITE_URL_API + 'compteur/lister');

                this.compteurs = data.data;
            }
            finally
            {
                loadingStore.finishLoading('Récupération des compteurs...');
            }
        }
    },
})