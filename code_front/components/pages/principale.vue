<template>
  <v-app>
    <v-app-bar
        color="green darken-2"
        dense
        dark
        app
    >
      <v-app-bar-nav-icon @click.stop="menuPrincipal = !menuPrincipal"></v-app-bar-nav-icon>

      <v-toolbar-title>Calculateur EDF > {{ $route.meta.nom }}</v-toolbar-title>
    </v-app-bar>
    <v-navigation-drawer
        v-model="menuPrincipal"
        absolute
        temporary
        app
    >
      <v-list
          nav
          dense
      >
        <v-list-item-group
            v-model="listeMenuLien"
            active-class="green--text text--accent-4"
        >
          <v-list-item :to="route.path" v-for="route in $router.options.routes">
            <v-list-item-title>{{ route.meta.nom }}</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <v-main v-if="ready">
      <router-view></router-view>
    </v-main>
    <v-dialog
        v-model="loadingStore.loadInProcess"
        persistent
    >
      <v-card>
        <v-card-title class="text-h5">
          Chargement en cours
        </v-card-title>
        <v-card-text>
          <ul>
            <li v-for="(chrg, index) in loadingStore.process" :key="index">{{ chrg }}</li>
          </ul>
        </v-card-text>
        <v-card-actions>
          <v-progress-linear
              indeterminate
          ></v-progress-linear>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar
        v-for="(msg, index) in messageStore.messages" :key="index"
        v-model="msg.display"
        :color="msg.color"
        :timeout="msg.dismissible ? 5000 : -1"
    >
      {{ msg.texte }}

      <template v-slot:action="{ attrs }">
        <v-btn
            text
            v-bind="attrs"
            @click="msg.display = false"
        >
          Fermer
        </v-btn>
      </template>
    </v-snackbar>
  </v-app>
</template>

<script>
import {mapStores} from "pinia";
import useLoadingStore from "@/stores/loadingStore.js";
import useMessageStore from "@/stores/messageStore.js";
import useMainStore from "@/stores/mainStore.js";

export default {
  name: "principale",
  data() {
    return {
      menuPrincipal: false,
      listeMenuLien: null
    }
  },
  computed: {
    ...mapStores(useLoadingStore, useMessageStore, useMainStore),
    ready: function()
    {
      return this.mainStore.compteurs.length > 0;
    }
  },
  mounted()
  {
    this.mainStore.getCompteurs();
  }
}
</script>

<style scoped>

</style>