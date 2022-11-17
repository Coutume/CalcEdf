<template>
  <v-card>
    <v-card-title class="text-h5 grey lighten-2">
      Reconnaissance de la facture
    </v-card-title>

    <v-card-text>
      <v-container>
        <v-row>
          <v-col>
            <v-file-input
                v-model="fichierFacture"
                accept="image/*"
                label="Sélectionner la photo de la facture"
                :loading="reconnaissanceEnCours"
                :messages="msgReconnaissanceEncours"
                @change="onFileChanged"
            ></v-file-input>
          </v-col>
          <v-col>
            <v-btn dark v-on:click="recognize" :disabled="imageFacture == null">Lancer la reconnaissance</v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col v-if="reconnu">
        <pre>
Pour info, les informations récupérées depuis la photo de la facture :
{{ infosFactureFormatees }}
        </pre>
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
          :disabled="!reconnu"
          @click="valider(true)"
      >
        Valider
      </v-btn>
      <v-btn
          color="primary"
          text
          @click="valider(false)"
      >
        Annuler
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import { createWorker, PSM, OEM } from 'tesseract.js';
const worker = createWorker({
  logger: m => console.log(m),
});
export default {
  name: "ocr-facture",
  data() {
    return {
      texte: null,
      hocr: null,
      fichierFacture: null,
      imageFacture: null,
      reconnaissanceEnCours: false,
      reconnu: false
    }
  },
  computed: {
    infosFacture: function()
    {
      let hcRegResult = /^Heures Creuses.*\(Enedis\) (?<kw>[0-9]*) (?<prixKw>[0,9]+,[0-9]+)/gm.exec(this.texte);
      let hpRegResult = /^Heures Pleines.*\(Enedis\) (?<kw>[0-9]*) (?<prixKw>[0,9]+,[0-9]+)/gm.exec(this.texte);
      let tva5AboRegResult = /^Abonnement$(\r\n|\r|\n)^Heures Creuses.* ([0-9]+,[0-9]+) (?<prix>[0-9]+,[0-9]+)/gm.exec(this.texte);
      let tva5ContribRegResult = /^Contribution Tarifaire d'Acheminement Electricité \(CTA\) (?<prix>[0-9]+,[0-9]+)/gm.exec(this.texte);
      let tva20ConsoFinaleRegResult = /^Taxe sur la Consommation Finale d'Electricité \(TCFE\) ([0-9]+) ([0-9]+,[0-9]+) (?<prix>[0-9]+,[0-9]+)/gm.exec(this.texte);
      let tva20ContribSerbPubRegResult = /^Contribution au Service Public d'Electricité \(CSPE\) ([0-9]+) ([0-9]+,[0-9]+) (?<prix>[0-9]+,[0-9]+)/gm.exec(this.texte);

      console.log(hcRegResult, hpRegResult, tva5AboRegResult
          , tva5ContribRegResult, tva20ConsoFinaleRegResult, tva20ContribSerbPubRegResult);

      // Conso
      let kwHc = hcRegResult != null ? hcRegResult.groups.kw : '';
      let prixKwHc = hcRegResult != null ? hcRegResult.groups.prixKw : '';
      let kwHp = hpRegResult != null ? hpRegResult.groups.kw : '';
      let prixKwHp = hpRegResult != null ? hpRegResult.groups.prixKw : '';

      // Taxes TVA 5,5%
      let tva5Abo = tva5AboRegResult != null ? tva5AboRegResult.groups.prix : '';
      let tva5Contrib = tva5ContribRegResult != null ? tva5ContribRegResult.groups.prix : '';

      // taxes TVA 20%
      let tva20ConsoFinale = tva20ConsoFinaleRegResult != null ? tva20ConsoFinaleRegResult.groups.prix : '';
      let tva20ContribAchem = tva20ContribSerbPubRegResult != null ? tva20ContribSerbPubRegResult.groups.prix : '';

      return {kwHc, prixKwHc, kwHp, prixKwHp, tva5Abo, tva5Contrib, tva20ConsoFinale, tva20ContribAchem};
    },
    msgReconnaissanceEncours: function()
    {
      return this.reconnaissanceEnCours ? 'Reconnaissance en cours...' : '';
    },
    infosFactureFormatees: function()
    {
      return Object.entries(this.infosFacture).map(f => f[0] + ' : '+ f[1]).join("\n");
    }
  },
  methods: {
    valider: function(isValidated)
    {
      this.$emit('hideDialogOcr',
          {
            getData: isValidated,
            data: this.infosFacture
          })
    },
    async recognize () {
      this.reconnaissanceEnCours = true;
      this.reconnu = false;
      await worker.load();
      await worker.loadLanguage('fra');
      await worker.initialize('fra', OEM.LSTM_ONLY);
      await worker.setParameters({
        tessedit_pageseg_mode: PSM.SINGLE_BLOCK,
      });
      const { data: { text, hocr } } = await worker.recognize(this.imageFacture);
      this.texte = text;
      this.hocr = hocr;
      this.reconnaissanceEnCours = false;
      this.reconnu = true;
      console.log(text);
    },
    onFileChanged: function() {
      const offscreen_canvas = new OffscreenCanvas(0, 0);
      const offscreen_canvas_context = offscreen_canvas.getContext("2d");

      var file = this.fichierFacture;
      if (file == undefined) return;
      var reader = new FileReader();
      reader.onload = (event) => {
        const reader_image = event.target.result;
        const image = new Image();
        image.onload =  () => {
          offscreen_canvas.width = image.width;
          offscreen_canvas.height = image.height;
          offscreen_canvas_context.drawImage(image, 0, 0);
          offscreen_canvas.convertToBlob().then((blob) => {
            this.imageFacture = blob;
          });
        };
        image.src = reader_image;
      };
      reader.readAsDataURL(file);
    }
  }
}
</script>

<style scoped>

</style>