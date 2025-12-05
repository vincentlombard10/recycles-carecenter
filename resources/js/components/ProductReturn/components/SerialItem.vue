<template>
    <li class="Serial_Item">
        <div><span class="font-semibold">{{ serial.code }}</span></div>
        <div v-if="serial.item" class="d-flex gap-2">
            <span>{{ serial.item.brand.name ?? serial.item.brand.code }}</span>
            <span class="font-semibold">{{ serial.item.itno }}</span>
            <span>{{ serial.item.label ?? serial.item.itds }}</span>
        </div>
        <div class="v-else">
            <span class="serial item_itno"></span>
        </div>
    </li>
</template>

<script setup lang="ts">
const props = defineProps(['serial'])
</script>

<style lang="scss" scoped>
.Serial_Item {
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
</style>
