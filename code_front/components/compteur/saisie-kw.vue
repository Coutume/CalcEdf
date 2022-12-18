<template>
  <v-container fluid>
    <v-row dense>
      <v-col>
        <h3>{{ libelle }}</h3>
      </v-col>
    </v-row>
    <v-row dense>
      <v-col cols="6" v-for="saisie in saisiesKw">
        <v-text-field dense
            v-model="saisie.kw"
            :label="libelle"
            :placeholder="libelle"
            suffix="kw"
            :rules="[regles.kwRenseigne]"
            outlined
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-btn text @click="ajouter()">Ajouter</v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "saisie-kw",
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
      saisiesKw: this.formatKwArrayToObject(this.saisies),
      regles: {
        kwRenseigne: function(value) { return (value.length  > 0 && /^-?[0-9]+$/.test(value)) || 'Le nombre de kilowatt doit être un entier'}
      }
    }
  },
  methods: {
    formatKwArrayToObject(kwArray)
    {
      return kwArray.map(kw => ({kw}));
    },
    formatKwObjectToArray(kwArray)
    {
      return kwArray.map(saisie => saisie.kw);
    },
    ajouter()
    {
      this.saisiesKw.push({kw: '0'});
    }
  },
  watch: {
    saisiesKw: {
      handler: function()
      {
        this.$emit('update:saisies', this.formatKwObjectToArray(this.saisiesKw));
      },
      deep: true,
      immediate: true
    }
  }
}
</script>

<style scoped>

</style>