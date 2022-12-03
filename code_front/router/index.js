import Vue from 'vue'
import VueRouter from 'vue-router'
import PageAccueil from '../pages/accueil.vue'
import PageSaisie from '../pages/saisie.vue'
import PageEdition from '../pages/edition.vue'
import PageHistorique from '../pages/historique.vue'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'hash',
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: PageAccueil,
      meta: {nom: "Accueil"}
    },
    {
      path: '/saisie',
      name: 'saisie',
      component: PageSaisie,
      meta: {nom: "Saisie d'une facture"}
    },
    {
      path: '/edition/:id',
      name: 'edition',
      component: PageEdition,
      meta: {nom: "Édition d'une facture", hidden: true}
    },
    {
      path: '/historique',
      name: 'historique',
      component: PageHistorique,
      meta: {nom: "Historique des factures"}
    }
  ]
})

export default router
