<template>
    <div class="Item_Card">
        <div><span class="fw-semibold">{{ item.itno }}</span></div>
        <div>{{ item.itds }}</div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['item'])
</script>

<style lang="scss">
.Item_Card {
    padding: 1.25rem 1.5rem;
    background-color: oklch(94.3% 0.029 294.588);
    color: oklch(38% 0.189 293.745);
}
</style>
