<template>
    <div class="Ticket_Card">
        <div>{{ ticket.requesterName }}</div>
        <div>{{ ticket.subject }}</div>
        <div>{{ ticket.requesterEmail }}</div>
        <div>{{ ticket.brand }}</div>
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
