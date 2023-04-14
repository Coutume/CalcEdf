<template>
  <v-col
      cols="12"
      lg="6">
    <v-container fluid>
      <v-row dense>
        <v-col cols="9">
          <v-text-field
              v-model="montantModel"
              label="Montant"
              prefix="€"
              suffix="HT"
              :rules="[regles.prixRenseigne]"
              outlined
          ></v-text-field>
        </v-col>
        <v-col>
          <v-select
              v-model="tvaModel"
              :items="tvas"
              item-text="libelle"
              item-value="valeur">
          </v-select>
        </v-col>
        <v-col>
          <v-btn @click="$emit('suppression')" color="red" text><v-icon>mdi-delete</v-icon></v-btn>
        </v-col>
      </v-row>
    </v-container>


  </v-col>
</template>

<script>
export default {
  name: "charge",
  props: ['montant', 'tva'],
  data() {
    return {
      regles: {
        prixRenseigne: function(value) { return (/^-?[0-9]+(,[0-9]+)?$/.test(value))
            || 'Le montant renseigné doit être un nombre'}
      },
    }
  },
  computed: {
    tvaModel: {
      get() {return this.tva;},
      set(val) {this.$emit('update:tva', val);}
    },
    montantModel: {
      get() {return this.montant;},
      set(val) {this.$emit('update:montant', val);}
    },
    tvas: function() {
      return [
        {
          libelle: 'TVA 0',
          valeur: 0
        },
        {
          libelle: 'TVA 5,5 %',
          valeur: 5.5
        },
        {
          libelle: 'TVA 20 %',
          valeur: 20
        }
      ]
    }
  }
}
</script>

<style scoped>

</style>