<template>
    <div class="row" v-if="ticket">
        <div class="col-lg-6">
            <div class="Selected_Ticket">
                <div><span class="fw-bold">{{ ticket.id }}</span></div>
                <div><span>{{ ticket.requester_name }}</span></div>
                <div><span>{{ ticket.subject }}</span></div>
            </div>
        </div>
        <input
            type="hidden"
            class="form-control"
            v-model="ticket.id"
            name="ticket">
    </div>
    <div class="row" v-else>
        <template v-if="ticketsList.length" class="col-xl-9">
            <div class="col-lg-6">
                <div class="Ticket_Selector">
                    <ul>
                        <li class="Ticket_Item"
                            v-for="ticket in ticketsList"
                            :key="ticket.id"
                            @click.prevent="setTicket(ticket)">
                                <div class="zd-id">
                                    <span class="fw-bold">{{ ticket.id }}</span>
                                </div>
                                <div class="zd-info">
                                    <div class="fw-bold">{{ ticket.requester_name }}</div>
                                    <div>{{ ticket.subject }}</div>
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="col-lg-3">
                <label for="ticket" class="form-label mb-1">Numéro de ticket Zendesk</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="searchTerm"
                    >
            </div>
            <div class="col-lg-3 mb-3 d-grid align-bottom">
                <label for="" class="form-label mb-1">&nbsp;</label>
                <button :disabled="!canFetchTickets" class="btn btn-dark" @click.prevent="fetchTickets">Chercher</button>
            </div>
        </template>
    </div>
    <div class="row" v-if="ticket || ticketsList">
        <div class="col">
            <a class="btn btn-sm btn-dark" v-if="ticket" @click="unsetTicket">Annuler l'association</a>
            <a class="btn btn-sm btn-dark" v-if="ticketsList.length" @click="unsetTicketsList">Nouvelle recherche</a>
        </div>
    </div>
</template>

<script setup lang="ts">
import {computed, ref} from "vue";
const searchTerm = ref('')
const ticket = ref()
const ticketsList = ref([])

const emit = defineEmits(['setTicket'])

const fetchTickets = async () => {
    console.log("fetch tickets")
    const req = await fetch('/api/v1/tickets/?' + new URLSearchParams({ q: searchTerm.value }))
    const response = await req.json()
    ticketsList.value = response
    console.log(response)

}

const canFetchTickets = computed(() => {
    return searchTerm.value.length >= 2
})

const setTicket = (payload: Object) => {
    ticket.value = payload
    emit('setTicket', payload)
}

const unsetTicket = () => {
    ticket.value = null
}

const unsetTicketsList = () => {
    ticketsList.value = []
    ticket.value = null
}
</script>

<style lang="scss" scoped>
.Ticket_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border: 1Px solid black;
    border-radius: 0 0 0.25rem 0.25rem;
    margin-bottom: 0.5rem;
    .Ticket_Item {
        padding: 0.65rem 1rem;
        border-bottom: 1Px solid #b5babd;
        background-color: white;
        cursor: pointer;
        &:hover {
            background-color: black;
            color: white;
        }
        &:last-child {
            border-bottom: 0;
        }
    }
}
.Selected_Ticket {
    padding: 0.65rem 1rem;
    background-color: oklch(44.6% 0.043 257.281);
    border-radius: 0.35rem;
    color: white;
    margin-bottom: 0.5rem;
}
</style>
