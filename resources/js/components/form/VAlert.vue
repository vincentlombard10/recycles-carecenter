<template>
    <div
        class="bg-green-300 font-bold text-green-950"
        :class="`Alert__${props.type}`">
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['type'])
</script>

<style lang="scss" scoped>
.Alert {
    background-color: oklch(95.4% 0.038 75.164);
    color: oklch(38% 0.189 293.745);
    padding: 1.25rem 1.75rem;
    border-radius: 0.35rem;
    &__success, &__Success {
        background-color: oklch(87.1% 0.15 154.449);
        color: oklch(39.3% 0.095 152.535);
    }
    &__danger, &__Danger {
        background-color: oklch(71.2% 0.194 13.428);
        color: oklch(98% 0.016 73.684);
    }
}
</style>
