<template>
  <v-card outlined>
    <v-card-title>
      Détails par compteur
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col lg="4" sm="12" md="6" v-for="rc in recapCompteurs" :key="rc.compteur.id">
            <recap-compteur :recapCompteur="rc"></recap-compteur>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
import RecapCompteur from "@/components/recap-compteur.vue";
export default {
  name: "recap-compteurs",
  components: {RecapCompteur},
  props: ["recapCompteurs"]
}
</script>

<style scoped>

</style>