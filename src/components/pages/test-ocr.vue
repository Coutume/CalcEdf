<template>
  <v-app>
    <div>
      <v-btn dark v-on:click="recognize">recognize</v-btn>
    </div>
    <div>
      <img id="text-img" alt="Vue logo" src="./../../assets/facture-aout-2022-verso.jpg">
    </div>
    <div v-html="hocr">
    </div>
  </v-app>
</template>

<script>
import { createWorker, PSM, OEM } from 'tesseract.js';
const worker = createWorker({
  logger: m => console.log(m),
});
export default {
  name: "test-ocr",
  data() {
    return {
      texte: null,
      hocr: null
    }
  },
  methods: {
    async recognize () {
      const img = document.getElementById('text-img');
      console.log(img);
      await worker.load();
      await worker.loadLanguage('fra');
      await worker.initialize('fra', OEM.LSTM_ONLY);
      await worker.setParameters({
        tessedit_pageseg_mode: PSM.SINGLE_BLOCK,
      });
      const { data: { text, hocr } } = await worker.recognize(img);
      this.texte = text;
      this.hocr = hocr;
      console.log(text);
    }
  }
}
</script>

<style scoped>

</style>