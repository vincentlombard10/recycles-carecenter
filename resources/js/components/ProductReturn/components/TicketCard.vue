<template>
    <div class="Ticket_Card">
        <div><h5 class="font-semibold mb-1">{{ ticket.id }}</h5></div>
        <div v-if="ticket.contact">{{ ticket.contact.code }} {{ ticket.contact.name }}</div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['ticket'])
</script>

<style lang="scss">
.Ticket_Card {
    background-color: white;
    border: 1px solid oklch(70.2% 0.183 293.541);
    padding: 1.25rem 1.5rem;
    border-radius: 0.5rem;
}
</style>
