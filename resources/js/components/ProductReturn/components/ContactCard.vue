<template>
    <div class="Contact_Card">
        <div>{{ contact.code }}</div>
        <div>{{ contact.name }}</div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['contact'])
</script>

<style lang="scss" scoped>
.Contact_Card {
    padding: 1rem 1.5rem;
    background: oklch(94.3% 0.029 294.588);
    border-radius: 0.5rem;
}
</style>
