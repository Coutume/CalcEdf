<template>
  <v-card outlined>
    <v-card-title>
      {{ recapCompteur.compteur.nom }}
    </v-card-title>
    <v-card-text>
      <v-simple-table>
        <template v-slot:default>
          <tbody>
          <tr
              v-for="(lb, i) in recapCompteur.lignesBudgetaires"
          >
            <td>{{ lb.nom }}</td>
            <td>{{ lb.montant }} €</td>
          </tr>
          <tr>
            <td><strong>Total</strong></td>
            <td>{{ recapCompteur.total.toFixed(2) }} €</td>
          </tr>
          </tbody>
        </template>
      </v-simple-table>
      Le total de <strong>{{ recapCompteur.total.toFixed(2) }} €</strong> est à répartir entre {{ listePersonnes }} ({{ recapCompteur.valeurPart.toFixed(2) }} € chacun) pour ce compteur.
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "recap-compteur",
  props: ["recapCompteur"],
  computed: {
    listePersonnes: function() {
      return this.recapCompteur.compteur.personnes.map(p => p.nom).join(', ');
    }
  }
}
</script>

<style scoped>

</style>