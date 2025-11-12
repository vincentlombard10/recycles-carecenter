<template>
    <select
        :name="name"
        :id="name"
        :value="currentOption"
        class="form-control"
        :class="{'form-control--success': selectedOption.length || currentOption }"
        @change="handleSelect">
        <option value="" disabled selected>Sélectionner</option>
        <option v-for="opt in props.options"
                :value="opt.identifier"
                :key="opt.value">{{ opt.label }}
        </option>
    </select>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";

const props = defineProps<{
    name: string,
    options: Array<any>,
    currentOption: string
}>()

const selectedOption = ref('')
const emits = defineEmits(['select'])

const handleSelect = (e) => {
    selectedOption.value = e.target.value
    emits('select', selectedOption.value)
}

onMounted(() => {
    selectedOption.value = props.currentOption
})
</script>
