<template>
    <div class="Section_Status" :class="{Completed: completed}">
        {{ message }}
    </div>
</template>

<script setup>
const props = defineProps({
    completed: {
        type: Boolean,
        default: false,
    },
    message: {
        type: String,
        default: 'Section complète.'
    }
})
</script>


<style lang="scss" scoped>
.Section_Status {
    background-color: oklch(98.4% 0.003 247.858);
    padding: 0.5rem 1.25rem;
    border-radius: 0.25rem;
    font-size: 0.85rem;
    &.Completed {
        background-color: oklch(93% 0.034 272.788);
        color: oklch(25.7% 0.09 281.288);
    }
}
</style>
