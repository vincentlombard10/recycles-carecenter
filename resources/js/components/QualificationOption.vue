<template>
    <div class="row">
        <div class="col-1 mb-2">
            <button class="btn btn-light">...</button>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" :value="option?.name">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" :value="option?.marker">
        </div>
        <div class="col-1 mb-2">
            <button v-if="option" class="btn btn-dark" @click.prevent="deleteQualification(option.marker)">X</button>
            <button v-else class="btn btn-primary">+</button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Option } from "../types"
import {onMounted} from "vue";
import Swal from 'sweetalert2';

const props = defineProps<{
    option?: Option
}>();

const emits = defineEmits(['delete'])

const deleteQualification = (marker: string) => {
    Swal.fire({
        title: 'Supprimer cette option',
        text: 'La suppression sera définitive',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, supprimer'
    }).then(result => {
        if (result.isConfirmed) {
            emits('delete', {marker: marker})
        }
    });
}
</script>
