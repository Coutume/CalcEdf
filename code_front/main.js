import Vue from 'vue'

import App from './App.vue'
import router from './router'
import vuetify from '@/plugins/vuetify'
import { createPinia, PiniaVuePlugin } from 'pinia'
import axios from 'axios'
import useMessageStore from "@/stores/messageStore";

Vue.use(PiniaVuePlugin)
const pinia = createPinia()

new Vue({
  router,
  vuetify,
  pinia,
  render: (h) => h(App)
}).$mount('#app')

const messageStore = useMessageStore();
// Add a response interceptor
axios.interceptors.response.use(function (response) {
  // Any status code that lie within the range of 2xx cause this function to trigger
  // Do something with response data

  console.log('requête terminée avec succès.', response);
  return response;
}, function (error) {
  // Any status codes that falls outside the range of 2xx cause this function to trigger
  // Do something with response error

  messageStore.addMessage("Une erreur est survenue. Veuillez réessayer.", true, false);
  console.log('requête terminée avec erreur.', error);
  return Promise.reject(error);
});