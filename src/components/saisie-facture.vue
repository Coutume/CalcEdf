<template>
  <v-form
    v-model="valide"
  >
    <v-container>
      <v-row>
        <v-col
            cols="12"
            sm="6"
        >
          <v-menu
              v-model="menuDateFacture"
              :close-on-content-click="false"
              :nudge-right="40"
              transition="scale-transition"
              offset-y
              min-width="auto"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                  v-model="dateFacture"
                  label="Date de la facture"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                  :rules="[regles.dateRenseignee]"
              ></v-text-field>
            </template>
            <v-date-picker
                v-model="dateFacture"
                @input="menuDateFacture = false"
                locale="fr-fr"
                first-day-of-week="1"
            >
            </v-date-picker>
          </v-menu>
        </v-col>
        <v-col
            cols="12"
            sm="6"
        >
        </v-col>
      </v-row>
      <v-row>
        <v-col
            cols="12"
            sm="6"
        >
          <v-card
            outlined
          >
            <v-card-title>
              Consommation en kw
            </v-card-title>
            <v-card-text>
              <v-text-field
                  v-model="consoKwHp"
                  label="Conso kw heures pleines"
                  placeholder="Conso kw heures pleines"
                  suffix="kw"
                  :rules="[regles.kwRenseigne]"
                  outlined
              ></v-text-field>
              <v-text-field
                  v-model="consoKwHc"
                  label="Conso kw heures creuses"
                  placeholder="Conso kw heures creuses"
                  suffix="kw"
                  :rules="[regles.kwRenseigne]"
                  outlined
              ></v-text-field>
              <v-text-field
                  v-model="consoKwPantaRei"
                  label="Conso kw Panta Rei"
                  placeholder="Conso kw Panta Rei"
                  suffix="kw"
                  :rules="[regles.kwRenseigne]"
                  outlined
              ></v-text-field>
              <v-text-field
                  v-model="consoKwPiscine"
                  label="Conso kw de la piscine"
                  placeholder="Conso kw de la piscine"
                  suffix="kw"
                  :rules="[regles.kwRenseigne]"
                  outlined
              ></v-text-field>
            </v-card-text>
          </v-card>
        </v-col>

        <v-col
            cols="12"
            sm="6"
        >
          <v-card
              outlined
          >
            <v-card-title>
              Prix du kw
            </v-card-title>
            <v-card-text>
              <v-text-field
                  v-model="prixKwHp"
                  label="Prix du kw heures pleines"
                  placeholder="Prix du kw heures pleines"
                  prefix="€"
                  :rules="[regles.prixRenseigne]"
                  outlined
              ></v-text-field>
              <v-text-field
                  v-model="prixKwHc"
                  label="Prix du kw heures creuses"
                  placeholder="Prix du kw heures creuses"
                  prefix="€"
                  :rules="[regles.prixRenseigne]"
                  outlined
              ></v-text-field>
            </v-card-text>
          </v-card>
        </v-col>

        <v-col
            cols="12"
        >
          <v-card
              outlined
          >
            <v-card-title>
              Taxes et abonnements
            </v-card-title>
            <v-card-text>
              <v-container class="no-padding">
                <v-row dense>
                  <v-col
                      cols="6"
                  >
                    <v-text-field
                        v-model="chargesTva5EurosAboHp"
                        label="Abonnements heures creuses"
                        prefix="€"
                        suffix="HT (TVA 5,5%)"
                        :rules="[regles.prixRenseigne]"
                        outlined
                    ></v-text-field>
                  </v-col>
                  <v-col
                      cols="6"
                  >
                    <v-text-field
                        v-model="chargesTva5EurosContribAchemElec"
                        label="Contributions à l'acheminement de l'électricité"
                        prefix="€"
                        suffix="HT (TVA 5,5%)"
                        :rules="[regles.prixRenseigne]"
                        outlined
                    ></v-text-field>
                  </v-col>
                  <v-col
                      cols="6"
                  >
                    <v-text-field
                        v-model="chargesTva20TaxeConsoFinale"
                        label="Taxe consommation finale électricité"
                        prefix="€"
                        suffix="HT (TVA 20%)"
                        :rules="[regles.prixRenseigne]"
                        outlined
                    ></v-text-field>
                  </v-col>
                  <v-col
                      cols="6"
                  >
                    <v-text-field
                        v-model="chargesTva20ContribServPub"
                        label="Contribution service public électricité"
                        prefix="€"
                        suffix="HT (TVA 20%)"
                        :rules="[regles.prixRenseigne]"
                        outlined
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
export default {
  name: "saisie-facture",
  props: ["value"],
  data() {
    return {
      // Champs à saisir
      dateFacture: this.value.dateFacture,
      consoKwHp: this.value.consoKwHp,
      consoKwHc: this.value.consoKwHc,
      consoKwPantaRei: this.value.consoKwPantaRei,
      consoKwPiscine: this.value.consoKwPiscine,
      chargesTva5EurosAboHp: this.value.chargesTva5EurosAboHp,
      chargesTva5EurosContribAchemElec: this.value.chargesTva5EurosContribAchemElec,
      chargesTva20TaxeConsoFinale: this.value.chargesTva20TaxeConsoFinale,
      chargesTva20ContribServPub: this.value.chargesTva20ContribServPub,
      prixKwHp: this.value.prixKwHp,
      prixKwHc: this.value.prixKwHc,

      menuDateFacture: false,
      valide: false,

      regles: {
        prixRenseigne: value => (value.length > 0 && /^[0-9]+(,[0-9]+)?$/.test(value)) || 'Le nombre de kilowatt doit être un entier',
        kwRenseigne: function(value) { return (value.length  > 0 && /^[0-9]+$/.test(value)) || 'Le nombre de kilowatt doit être un entier'},
        dateRenseignee: function(value) { return !!value || 'La date doit être renseignée'},
      }
    }
  },
  computed: {
    formData: function()
    {
      return {
        dateFacture: this.dateFacture,
        consoKwHp: this.consoKwHp,
        consoKwHc: this.consoKwHc,
        consoKwPantaRei: this.consoKwPantaRei,
        consoKwPiscine: this.consoKwPiscine,
        chargesTva5EurosAboHp: this.chargesTva5EurosAboHp,
        chargesTva5EurosContribAchemElec: this.chargesTva5EurosContribAchemElec,
        chargesTva20TaxeConsoFinale: this.chargesTva20TaxeConsoFinale,
        chargesTva20ContribServPub: this.chargesTva20ContribServPub,
        prixKwHp: this.prixKwHp,
        prixKwHc: this.prixKwHc,
      }
    }
  },

  methods: {
  },
  watch: {
    valide: {
      immediate : true,
      handler : function()
      {
        this.$emit('valide', this.valide);
      }
    },
    formData: {
      immediate : true,
      handler : function()
      {
        this.$emit('input', this.formData);
      }
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