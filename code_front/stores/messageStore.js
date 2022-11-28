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
        addMessage(message, error = false, dismissible = true) {
            this.messages.push({texte: message, display: true, dismissible: dismissible, color: error ? 'red accent-2' : ''});
        }
    },
})