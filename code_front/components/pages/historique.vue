<template>
  <div>
    Bientôt, l'historique...
    <v-data-table :headers="headers"
                  :items="factures">

    </v-data-table>
  </div>
</template>

<script>
import useMainStore from '@/stores/mainStore'
import { mapStores } from 'pinia'
export default {
  name: "historique",
  data() {
    return {
      headers: [
        {
          text: 'Id',
          value: 'id'
        },
        {
          text: 'Date facture',
          value: 'date'
        }
      ],
      factures: []
    }
  },
  computed: {
    ...mapStores(useMainStore)
  },
  mounted() {
    this.mainStore.getHistoFacture().then(data => this.factures = data);
  }
}
</script>

<style scoped>

</style>