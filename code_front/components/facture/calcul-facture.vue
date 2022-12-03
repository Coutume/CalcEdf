<template>
  <v-container>
    <v-row>
      <v-col
          cols="12"
      >
        <saisie-facture v-model="formData" :edit-mode="editMode" @valide="onFormValide($event)"></saisie-facture>
      </v-col>
    </v-row>
    <v-row>
      <v-col
          cols="12"
      >
        <v-btn
            text
            :disabled="!formValide"
            @click="calculer()"
        >
          Calculer la facture
        </v-btn>
        <v-btn
            text
            :disabled="recapCompteurs.length === 0 || recapPersonnes.length === 0"
            @click="dialogResultat = true"
        >
          Voir le résultat précédent
        </v-btn>
        <v-btn
            text
            @click="dialogOcr = true"
        >
          Reconnaissance facture
        </v-btn>
      </v-col>
    </v-row>
    <v-dialog
        v-model="dialogResultat"
    >
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Vérifier le résultat à payer
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-row>
              <v-col>
                <recap-compteurs v-if="recapCompteurs.length > 0" :recap-compteurs="recapCompteurs"></recap-compteurs>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <recap-personnes v-if="recapPersonnes.length > 0" :recap-personnes="recapPersonnes"></recap-personnes>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="primary"
              text
              @click="validerFacture()"
          >
            Valider
          </v-btn>
          <v-btn
              color="primary"
              text
              @click="dialogResultat = false"
          >
            Fermer
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
        v-model="dialogOcr"
    >
      <ocr-facture @hideDialogOcr="onDialogOcrHide"></ocr-facture>
    </v-dialog>
  </v-container>
</template>

<script>
import SaisieFacture from "@/components/facture/formulaire-facture.vue";
import { mapStores } from 'pinia'
import useMainStore from "@/stores/mainStore.js";
import useMessageStore from "@/stores/messageStore.js";
import RecapCompteurs from "@/components/recap/recap-compteurs.vue";
import RecapPersonnes from "@/components/recap/recap-personnes.vue";
import OcrFacture from "@/components/facture/ocr-facture.vue";

export default {
  name: "saisie",
  props: {
    factureData: {
      type: Object,
      default: function() {
        return {
          dateFacture: null,
          consoKwHp: '0',
          consoKwHc: '0',
          consoKwPantaRei: '0',
          consoKwPiscine: '0',
          chargesTva5EurosAboHp: '0',
          chargesTva5EurosContribAchemElec: '0',
          chargesTva20TaxeConsoFinale: '0',
          chargesTva20ContribServPub: '0',
          prixKwHp: '0',
          prixKwHc: '0',
          total: 0
        }
      }
    }
  },
  components: {OcrFacture, RecapPersonnes, RecapCompteurs, SaisieFacture},
  data() {
    return {
      formData: this.factureData,
      formValide: false,
      recapCompteurs: [],
      recapPersonnes: [],
      dialogResultat: false,
      dialogOcr: false
    }
  },
  computed: {
    ...mapStores(useMainStore),
    ...mapStores(useMessageStore),
    editMode: function()
    {
      return this.factureData.id !== undefined;
    },
    nbPartTaxes: function() {
      return this.mainStore.compteurs.filter(c => c.partageTaxes === true).length;
    },
    partTva5: function() { // Prix d'une part pour les taxes à 5,5%
      let chargesTva5EurosAboHp = this.formData.chargesTva5EurosAboHp;
      let chargesTva5EurosContribAchemElec = this.formData.chargesTva5EurosContribAchemElec;
      if(this.formValide)
      {
        chargesTva5EurosAboHp = parseFloat(chargesTva5EurosAboHp.replace(',', '.'));
        chargesTva5EurosContribAchemElec = parseFloat(chargesTva5EurosContribAchemElec.replace(',', '.'));
        let chargesTva5TotalHt = chargesTva5EurosAboHp + chargesTva5EurosContribAchemElec;
        let chargesTva5TotalTtc = chargesTva5TotalHt + (chargesTva5TotalHt * 5.5 / 100);
        return chargesTva5TotalTtc / this.nbPartTaxes;
      }
      return null;
    },
    partTva20: function() { // Prix d'une part pour les taxes à 20%
      let chargesTva20TaxeConsoFinale = this.formData.chargesTva20TaxeConsoFinale;
      let chargesTva20ContribServPub = this.formData.chargesTva20ContribServPub;
      if(this.formValide)
      {
        chargesTva20TaxeConsoFinale = parseFloat(chargesTva20TaxeConsoFinale.replace(',', '.'));
        chargesTva20ContribServPub = parseFloat(chargesTva20ContribServPub.replace(',', '.'));
        let chargesTva20TotalHt = chargesTva20TaxeConsoFinale + chargesTva20ContribServPub;
        let chargesTva20TotalTtc = chargesTva20TotalHt + (chargesTva20TotalHt * 20 / 100);
        return chargesTva20TotalTtc / this.nbPartTaxes;
      }
      return null;
    },
    facture: function() {
      return {
        saisies: this.formatFormData(),
        compteurs: this.recapCompteurs,
        personnes: this.recapPersonnes,
      }
    }
  },
  methods: {
    validerFacture: function()
    {
      this.dialogResultat = false;
      if(this.editMode)
      {
        this.mainStore.modifierFacture(this.facture, this.factureData.id);
      }
      else
      {
        this.mainStore.ajouterFacture(this.facture);
      }
      console.log(import.meta.env);
    },
    onFormValide: function(isValid)
    {
      this.formValide = isValid;

      if(!this.formValide)
      {
        this.recapCompteurs.splice(0);
        this.recapPersonnes.splice(0);
      }
    },
    onDialogOcrHide: function(dialogData)
    {
      this.dialogOcr = false;
      if(dialogData.getData)
      {
        this.formData.consoKwHc = dialogData.data.kwHc;
        this.formData.prixKwHc = dialogData.data.prixKwHc;
        this.formData.consoKwHp =dialogData.data.kwHp;
        this.formData.prixKwHp = dialogData.data.prixKwHp;
        this.formData.chargesTva5EurosAboHp = dialogData.data.tva5Abo;
        this.formData.chargesTva5EurosContribAchemElec = dialogData.data.tva5Contrib;
        this.formData.chargesTva20TaxeConsoFinale = dialogData.data.tva20ConsoFinale;
        this.formData.chargesTva20ContribServPub = dialogData.data.tva20ContribAchem;
      }
    },
    formatFormData: function() {
      return {
        dateFacture: this.formData.dateFacture,
        consoKwHp: parseInt(this.formData.consoKwHp),
        consoKwHc: parseInt(this.formData.consoKwHc),
        consoKwPantaRei: parseInt(this.formData.consoKwPantaRei),
        consoKwPiscine: parseInt(this.formData.consoKwPiscine),
        chargesTva5EurosAboHp: parseFloat(this.formData.chargesTva5EurosAboHp.replace(',', '.')),
        chargesTva5EurosContribAchemElec: parseFloat(this.formData.chargesTva5EurosContribAchemElec.replace(',', '.')),
        chargesTva20TaxeConsoFinale: parseFloat(this.formData.chargesTva20TaxeConsoFinale.replace(',', '.')),
        chargesTva20ContribServPub: parseFloat(this.formData.chargesTva20ContribServPub.replace(',', '.')),
        prixKwHp: parseFloat(this.formData.prixKwHp.replace(',', '.')),
        prixKwHc: parseFloat(this.formData.prixKwHc.replace(',', '.')),
        total: this.formData.total
      }
    },
    calculer: function()
    {
      this.messageStore.addMessage("Calcul en cours...");
      let compteurs = this.mainStore.compteurs;
      this.recapCompteurs.splice(0);

      // Consommation
      let consoKwHp = parseInt(this.formData.consoKwHp);
      let consoKwHc = parseInt(this.formData.consoKwHc);
      let totalKwPiscine = parseInt(this.formData.consoKwPiscine);
      let consoKwPantaRei = parseInt(this.formData.consoKwPantaRei);
      let totalKwPantaRei = consoKwPantaRei - totalKwPiscine;
      let prixKwHp = parseFloat(this.formData.prixKwHp.replace(',', '.'));
      let prixKwHc = parseFloat(this.formData.prixKwHc.replace(',', '.'));
      let totalKw = consoKwHc + consoKwHp;
      let totalKwPrincipal = totalKw - totalKwPantaRei - totalKwPiscine;
      let pourcentHp = consoKwHp / totalKw * 100;
      let pourcentHc = consoKwHc / totalKw * 100;

      // calcul des parts pour les taxes & autres contributions
      let chargesTva5Part = this.partTva5;
      let chargesTva20Part = this.partTva20;

      // Calcul de la conso hp / hc compteur principal
      let compteurPrincipal = compteurs.find(c => c.id === 1);
      let recapCompteurPrincipal = this.creerRecapCompteur(compteurPrincipal, totalKwPrincipal
          , pourcentHp, pourcentHc, prixKwHp, prixKwHc, totalKw);
      this.ajouterLigneBudgetaire(recapCompteurPrincipal, 'Taxes TVA 5,5%', chargesTva5Part);
      this.ajouterLigneBudgetaire(recapCompteurPrincipal, 'Taxes TVA 20%', chargesTva20Part);

      // Calcul de la conso hp / hc compteur Panta Rei
      let compteurPantaRei = compteurs.find(c => c.id === 2);
      let recapCompteurPantaRei = this.creerRecapCompteur(compteurPantaRei, totalKwPantaRei
          , pourcentHp, pourcentHc, prixKwHp, prixKwHc, consoKwPantaRei);
      this.ajouterLigneBudgetaire(recapCompteurPantaRei, 'Taxes TVA 5,5%', chargesTva5Part);
      this.ajouterLigneBudgetaire(recapCompteurPantaRei, 'Taxes TVA 20%', chargesTva20Part);

      // Calcul de la conso hp / hc compteur Piscine
      let compteurPiscine = compteurs.find(c => c.id === 3);
      let recapCompteurPiscine = this.creerRecapCompteur(compteurPiscine, totalKwPiscine
          , pourcentHp, pourcentHc, prixKwHp, prixKwHc, totalKwPiscine);

      this.recapCompteurs.push(recapCompteurPrincipal, recapCompteurPantaRei, recapCompteurPiscine);
      this.creerRecapsPersonne();
      this.formData.total = this.recapCompteurs.reduce((prev, rc) => prev + rc.total, 0);

      this.dialogResultat = true;
    },
    creerRecapCompteur: function(compteur, consoKw, pourcentHp, pourcentHc, prixKwHp, prixKwHc, consoKwAvantDeduction)
    {
      let consoKwHp = consoKw * pourcentHp / 100;
      let consoKwHc = consoKw * pourcentHc / 100;
      let consoEurosHp = consoKwHp * prixKwHp;
      let consoEurosHc = consoKwHc * prixKwHc;
      let consoEurosTotal = consoEurosHp + consoEurosHc;
      let consoEurosTotalTtc = consoEurosTotal + (consoEurosTotal * 20 / 100);
      let recap = {
        compteur : compteur,
        consoKwHp: consoKwHp,
        consoKwHc: consoKwHc,
        consoKwTotal: consoKwAvantDeduction,
        consoEurosHp: consoEurosHp > 0 ? consoEurosHp : 0,
        consoEurosHc: consoEurosHc > 0 ? consoEurosHc : 0,
        consoEurosTotal: consoEurosTotalTtc > 0 ? consoEurosTotalTtc : 0,
        total: 0,
        valeurPart: 0,
        lignesBudgetaires: []
      };

      this.ajouterLigneBudgetaire(recap, 'Consommation', consoEurosTotalTtc);

      return recap;
    },
    ajouterLigneBudgetaire: function(recapCompteur, nom, montant)
    {
      recapCompteur.lignesBudgetaires.push(
      {
        nom: nom,
        montant: montant > 0 ? montant : 0
      });

      recapCompteur.total = recapCompteur.lignesBudgetaires.reduce((prevL, lb) => prevL + lb.montant, 0);
      recapCompteur.valeurPart = recapCompteur.total / recapCompteur.compteur.personnes.length;
    },
    creerRecapsPersonne()
    {
      this.recapPersonnes.splice(0);

      this.recapCompteurs.forEach(function(recapCompteur)
      {
        let compteur = recapCompteur.compteur;
        compteur.personnes.forEach(function(personne)
        {
          let recapPers = this.recapPersonnes.find(rp => rp.personne.nom === personne.nom);

          if(recapPers === undefined)
          {
            recapPers = this.creerRecapPersonne(personne);
            this.recapPersonnes.push(recapPers);
          }

          // Part à payer d'une personne : total du compteur / nombre de personnes rattachées au compteur
          recapPers.total += recapCompteur.valeurPart;
        }, this)
      }, this);
    },
    creerRecapPersonne: function(personne)
    {
      return {
        personne : personne,
        total: 0
      }
    }
  }
}
</script>

<style scoped>

</style>