<template>
    <select
        :name="name"
        :id="name"
        class="form-control"
        :class="{'form-control--success': selectedOption !== ''}"
        @change="handleSelect">
        <option value="" disabled selected>Sélectionner</option>
        <option v-for="opt in props.options"
                :value="opt.identifier"
                :key="opt.value">{{ opt.label }}
        </option>
    </select>
</template>

<script setup lang="ts">
import {ref} from "vue";

const props = defineProps<{
    name: {
        type: String,
        required: true
    },
    options: {
        type: Array<any>,
        required: false
    }
}>()

const selectedOption: Ref<string> = ref('')

const emits = defineEmits(['select'])

const handleSelect = (e) => {
    console.log("ok")
    selectedOption.value = e.target.value
    emits('select', selectedOption.value)
}
</script>
