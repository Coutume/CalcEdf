<template>
  <v-container v-if="factures.length > 0">
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>
            Histo des consommation en kw
          </v-card-title>
          <v-card-text>
            <Bar
                :chart-options="chartOptions"
                :chart-data="chartData"
                :chart-id="chartId"
                :dataset-id-key="datasetIdKey"
                :plugins="plugins"
                :css-classes="cssClasses"
                :styles="styles"
            />
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>
            Histo des factures
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="factures">
              <template v-slot:item.consommationsCompteur="{ item }">
                <div v-for="(cc, i) in item.consommationsCompteur">
                  {{ cc.compteur.nom }}
                  <v-chip
                      x-small
                  >
                    {{ cc.total }} €
                  </v-chip>
                </div>
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>

      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import useMainStore from '@/stores/mainStore'
import { mapStores } from 'pinia'

import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
export default {
  name: "historique",
  components: {
    Bar
  },
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
        },
        {
          text: 'Conso kw heure pleine',
          value: 'consoKwHp'
        },
        {
          text: 'Conso kw heure creuse',
          value: 'consoKwHc'
        },
        {
          text: 'Total',
          value: 'total'
        },
        {
          text: 'Compteurs',
          value: 'consommationsCompteur',
          sortable: false
        }
      ],
      factures: [],
      chartId: 'bar-chart',
      datasetIdKey: 'label',
      cssClasses: '',
      styles: {},
      plugins: [],
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true
          }
        }
      }
    }
  },
  computed: {
    ...mapStores(useMainStore),
    labelsDate: function()
    {
      return this.factures.map(f => f.date);
    },
    datasetsConsoKw: function() {
      return this.mainStore.compteurs.map(function(compteur) {
        return {
          label: compteur.nom,
          backgroundColor: compteur.couleurGraphique,
          data : this.factures.map(facture =>
          {
            let cc = facture.consommationsCompteur.find(cc => cc.compteur.id === compteur.id);
            return cc !== undefined ? cc.consoKwHp + cc.consoKwHc : 0;
          })
        }
      }, this)
    },
    chartData: function()
    {
      return {
        labels: this.labelsDate,
        datasets: this.datasetsConsoKw
      }
    }
  },
  mounted() {
    this.mainStore.getHistoFacture().then(data => this.factures = data);
  }
}
</script>

<style scoped>

</style>