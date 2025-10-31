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
    background: oklch(96.9% 0.016 293.756);
    border: 1Px solid oklch(89.4% 0.057 293.283);
    border-radius: 0.5rem;
}
</style>
