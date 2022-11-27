import {defineStore} from 'pinia'
import axios from 'axios'

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
                            'nom' : 'Marco'
                        },
                        {
                            'nom' : 'Raphael'
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
                            'nom' : 'Florian'
                        },
                        {
                            'nom' : 'Christophe'
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
                            'nom' : 'Florian'
                        },
                        {
                            'nom' : 'Christophe'
                        },
                        {
                            'nom' : 'Marco'
                        },
                        {
                            'nom' : 'Raphael'
                        }
                    ]
                }
            ]
        }
    ),
    getters: {

    },
    actions: {
        async ajouterFacture(facture) {
            try {
                console.log(facture);
                let data = await axios.post(import.meta.env + 'facture/ajouter', facture);
                console.log(data);
            } catch (error) {
                console.log(error)
                return error
            }
        },
    },
})