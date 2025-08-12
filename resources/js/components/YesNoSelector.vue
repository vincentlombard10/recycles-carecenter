<template>
    <div class="Yes_No_Selector">
        <label for="" class="form-label mb-0">{{ label }}</label>
        <div class="btn-group" role="group">
            <input type="radio" class="btn-check" :name="name" :id="name + '-yes'" value="1" :checked="value === true">
            <label class="btn btn-checkbox btn-sm btn-outline-primary" :for="name + '-yes'">{{ props.yesLabel }}</label>
            <input type="radio" class="btn-check" :name="name" :id="name + '-no'" value="0" :checked="value === false">
            <label class="btn btn-checkbox btn-sm btn-outline-primary" :for="name + '-no'">{{ props.noLabel }}</label>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    yesLabel: {
        type: String,
        default: 'Oui'
    },
    noLabel: {
        type: String,
        default: 'Non'
    },
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: true
    },
    value: {
        type: Boolean|null,
        required: false
    }
})
</script>


<style lang="scss" scoped>
.Yes_No_Selector {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0.5rem;
    &:hover {
        background-color: oklch(96.9% 0.016 293.756);
    }
    .btn-checkbox {
        width: 8rem;
        padding: 0.25rem 1rem;
    }
}
</style>
