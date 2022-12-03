<template>
  <calcul-facture v-if="facture != null" :facture-data="factureFormatee"></calcul-facture>
</template>

<script>
import calculFacture from '@/components/facture/calcul-facture.vue';
import useMainStore from "@/stores/mainStore.js";
import { mapStores } from 'pinia'
export default {
  name: "edition",
  components: {calculFacture},
  data() {
    return {
      facture: null
    }
  },
  computed: {
    ...mapStores(useMainStore),
    factureFormatee: function()
    {
      if(this.facture != null)
      {
        return {
          id: this.facture.id,
          dateFacture: this.facture.dateFacture,
          consoKwHp: this.facture.consoKwHp + '',
          consoKwHc: this.facture.consoKwHc + '',
          consoKwPantaRei: this.formaterNombre(this.facture.consommationsCompteur.find(cc => cc.compteur.id === 2).consoKwTotal),
          consoKwPiscine: this.formaterNombre(this.facture.consommationsCompteur.find(cc => cc.compteur.id === 3).consoKwTotal),
          chargesTva5EurosAboHp: this.formaterNombre(this.facture.chargesTva5EurosAboHp),
          chargesTva5EurosContribAchemElec: this.formaterNombre(this.facture.chargesTva5EurosContribAchemElec),
          chargesTva20TaxeConsoFinale: this.formaterNombre(this.facture.chargesTva20TaxeConsoFinale),
          chargesTva20ContribServPub: this.formaterNombre(this.facture.chargesTva20ContribServPub),
          prixKwHp: this.formaterNombre(this.facture.prixKwHp),
          prixKwHc: this.formaterNombre(this.facture.prixKwHc),
          total: this.formaterNombre(this.facture.total),
        }
      }

      return null;
    }
  },
  methods: {
    formaterNombre(nombre)
    {
      return (nombre + '').replace('.', ',');
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      vm.mainStore.getFacture(to.params.id).then(data => vm.facture = data);
    })
  }
}
</script>

<style scoped>

</style>