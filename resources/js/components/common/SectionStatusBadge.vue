<template>
    <span class="Badge"
          v-html="badgeLabel"
        :class="badgeClass">
    </span>
</template>

<script setup lang="ts">
import {computed} from "vue";

const props = defineProps(['completed'])

const badgeClass = computed(() => {
    return props.completed ? 'Completed' : 'Progress'
})

const badgeLabel = computed(() => {
    return props.completed ? '<i class="bi bi-check-all"></i>\n' : '<i></i>'
})
</script>

<style lang="scss">
.Badge {
    background: black;
    color: white;
    padding: 0rem 1rem;
    border-radius: 2rem;
    display: inline-block;
    &.Completed {
        background: transparent;
        font-weight: 600;
        color: oklch(72.3% 0.219 149.579);
        font-size: 2rem;
    }
    &.Progress {
        background: oklch(95.4% 0.038 75.164);
        color: oklch(38% 0.189 293.745);
    }
}
</style>
