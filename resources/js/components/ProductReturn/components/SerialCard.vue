<template>
    <div class="Serial_Card">
        <div>{{ serial.code }}</div>
        <div>{{ serial.item.brand.code }} {{ serial.item.itno }} {{ serial.item.itds }}</div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['serial'])
</script>

<style lang="scss">
.Serial_Card {
    padding: 1.25rem 1.5rem;
    background-color: oklch(94.3% 0.029 294.588);
    color: oklch(38% 0.189 293.745);
}
</style>
