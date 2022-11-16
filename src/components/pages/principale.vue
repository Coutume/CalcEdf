<template>
  <v-app>
    <v-app-bar
        color="green darken-2"
        dense
        dark
        app
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Calculateur EDF > {{ $route.meta.nom }}</v-toolbar-title>
    </v-app-bar>
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "principale"
}
</script>

<style scoped>

</style>