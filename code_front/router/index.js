import Vue from 'vue'
import VueRouter from 'vue-router'
import PageAccueil from '../components/pages/accueil.vue'
import PageSaisie from '../components/pages/saisie.vue'
import PageHistorique from '../components/pages/historique.vue'

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
      meta: {nom: "Saisie de la consommation"}
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
