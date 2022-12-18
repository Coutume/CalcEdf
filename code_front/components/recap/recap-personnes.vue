<template>
  <v-card outlined>
    <v-card-title>
      Somme à payer par personne
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col v-for="rp in recapPersonnes">
            {{ rp.personne.prenom }} {{ rp.personne.nom }} <v-chip class="ma-2" color="primary" >{{ rp.total.toFixed(2) }} €</v-chip>
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            Le montant total à payer s'élève à {{ montantTotal }}
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "recap-personnes",
  props: ["recapPersonnes"],
  computed: {
    montantTotal: function()
    {
      return this.recapPersonnes.reduce((total,rp) => total + rp.total, 0).toFixed(2);
    }
  }
}
</script>

<style scoped>

</style>