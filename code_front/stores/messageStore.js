import {defineStore} from 'pinia'

export default defineStore('message', {
    state: () => (
        {
            messages: []
        }
    ),
    getters: {
    },
    actions: {
        addMessage(message, error = false) {
            this.messages.push({texte: message, display: true, color: error ? 'red accent-2' : ''});
        }
    },
})