<template>
    <section id="Ticket">
        <div class="Section_Head">
            <h2 class="font-bold mb-3">Ticket associé</h2>
            <div>
                <SectionStatusBadge :completed="store.ticketSectionCompleted"/>
            </div>
        </div>
        <div class="row" v-if="store.ticket">
            <div class="col-12 mb-2">
                <TicketCard :ticket="store.ticket"/>
                <input type="hidden" name="ticket" :value="store.ticket.id"/>
            </div>
            <div class="col-12 mb-2">
                <button class="text-sm" @click.prevent="store.cancelTicket">
                    <i class="bi bi-arrow-clockwise"></i>
                    Annuler</button>
            </div>
        </div>
        <div class="row" v-else-if="store.ticketsList.length">
            <div class="col-12 mb-3">
                <ul class="Ticket_Selector">
                    <li class="Ticket_Item"
                        v-for="ticket in store.ticketsList"
                        :key="ticket.id"
                        @click.prevent="store.setTicket(ticket.id)">
                        <div class="zd-id">
                            <span class="fw-bold">{{ ticket.id }}</span>
                        </div>
                        <div v-if="ticket.contact">{{ ticket.contact.code }} / {{ ticket.contact.name }}</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-lg-3">
                <input type="text" class="form-control" v-model="store.ticketSearchTerm">
            </div>
            <div class="col-lg-3">
                <button @click.prevent="store.fetchTickets">Rechercher</button>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn.js";
import TicketCard from "../components/TicketCard.vue";
import SectionStatusBadge from "../../common/SectionStatusBadge.vue";

const store = useProductReturnStore()

const handleSelectTicket = (_ticket: string) => {
    ticket.value = _ticket
}
</script>

<style lang="scss" scoped>
.Ticket_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border: 1px solid oklch(70.2% 0.183 293.541);
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;

    .Ticket_Item {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid oklch(89.4% 0.057 293.283);
        background-color: white;
        cursor: pointer;
        color: oklch(28.3% 0.141 291.089);

        &:hover {
            background-color: oklch(94.3% 0.029 294.588);
            color: oklch(28.3% 0.141 291.089);
        }

        &:last-child {
            border-bottom: 0;
        }
    }
}

.Selected_Ticket {
    padding: 1rem 1.25rem;
    background-color: oklch(44.6% 0.043 257.281);
    border-radius: 0.35rem;
    color: white;
    margin-bottom: 0.5rem;
}
</style>
