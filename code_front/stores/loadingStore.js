import {defineStore} from 'pinia'
import axios from 'axios'

export default defineStore('loading', {
    state: () => (
        {
            process: []
        }
    ),
    getters: {
        loadInProcess: state => state.process.length > 0
    },
    actions: {
        beginLoading(loading) {
            this.process.push(loading);
        },
        finishLoading(loading) {
            let idProcess = this.process.findIndex(p => p === loading)
            if(idProcess > -1)
            {
                this.process.splice(idProcess, 1);
            }
        },
    },
})