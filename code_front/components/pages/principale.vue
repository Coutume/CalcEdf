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
        bottom
        temporary
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
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "principale",
  data() {
    return {
      menuPrincipal: false,
      listeMenuLien: null,
    }
  }
}
</script>

<style scoped>

</style>