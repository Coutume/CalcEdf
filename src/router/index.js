import Vue from 'vue'
import VueRouter from 'vue-router'
import PageOcr from '../components/pages/test-ocr.vue'
import PageSaisie from '../components/pages/saisie.vue'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: PageOcr,
      meta: {nom: "Accueil"}
    },
    {
      path: '/saisie',
      name: 'saisie',
      component: PageSaisie,
      meta: {nom: "Saisie de la consommation"}
    }
  ]
})

export default router
