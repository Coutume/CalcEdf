<template>
  <v-container class="no-padding">
    <v-row dense>
      <charge v-for="saisie in saisiesCharge" v-bind.sync="saisie" @suppression="supprimer(saisie)"></charge>
      <v-col cols="12"
             lg="6">
        <v-btn text @click="ajouter()">Ajouter</v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Charge from "@/components/charge/charge.vue";

export default {
  name: "saisie-charge",
  components: {Charge},
  props: {
    saisies: {
      type: Array,
      default() {
        return [];
      }
    },
    libelle: {
      type: String,
      default: 'Conso kw'
    }
  },
  data() {
    return {
      saisiesCharge: this.saisies
    }
  },
  methods: {
    ajouter()
    {
      this.saisiesCharge.push({id: this.saisiesCharge.length + 1, montant: '0', tva: 5.5});
    },
    supprimer(saisie)
    {
      this.saisiesCharge.splice(this.saisiesCharge.findIndex(sc => sc.id === saisie.id), 1);
    }
  },
  watch: {
    saisiesCharge: {
      handler: function()
      {
        this.$emit('update:saisies', this.saisiesCharge);
      },
      deep: true,
      immediate: true
    }
  }
}
</script>

<style scoped>
.no-padding
{
  padding-left: 0;
  padding-right: 0;
}
</style>