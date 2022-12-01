import {defineStore} from 'pinia'
import axios from 'axios'
import useLoadingStore from '@/stores/loadingStore.js'
import useMessageStore from '@/stores/messageStore.js'

export default defineStore('main', {
    state: () => (
        {
            compteurs: [
                {
                    id: 1,
                    nom: 'Principal',
                    partageTaxes: true, // Si vrai, les taxes & autres contributions seront imputées sur ce compteur
                    rattacheA: null, // Identifiant du compteur auquel le sous-compteur est rattaché. Si null = compteur principal
                    personnes: [
                        {
                            'nom' : 'Marco',
                            id: 3
                        },
                        {
                            'nom' : 'Raphael',
                            id: 2
                        }
                    ]
                },
                {
                    id: 2,
                    nom: 'Panta Rei',
                    partageTaxes: true,
                    rattacheA: 1,
                    personnes: [
                        {
                            'nom' : 'Florian',
                            id: 4
                        },
                        {
                            'nom' : 'Christophe',
                            id: 1
                        }
                    ]
                },
                {
                    id: 3,
                    nom: 'Piscine',
                    rattacheA: 2,
                    partageTaxes: false,
                    personnes: [
                        {
                            'nom' : 'Florian',
                            id: 4
                        },
                        {
                            'nom' : 'Christophe',
                            id: 1
                        },
                        {
                            'nom' : 'Marco',
                            id: 3
                        },
                        {
                            'nom' : 'Raphael',
                            id: 2
                        }
                    ]
                }
            ]
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
        }
    },
})