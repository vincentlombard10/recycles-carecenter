<template>
    <div class="row">
        <div class="col-1">&nbsp;</div>
        <div class="col-5">Valeur</div>
        <div class="col-5">Marqueur</div>
        <div class="col-1">&nbsp;</div>
    </div>
    <div>
        <QualificationOption v-for="option in options" :option="option" @delete="deleteOption"/>
        <button class="btn btn-primary" @click.prevent="addEmptyQualification">Ajouter</button>
    </div>

</template>

<script setup lang="ts">
import {ref} from "vue";
import {Option} from "../types";
import Swal from 'sweetalert2';

import QualificationOption from "./QualificationOption.vue";

const options = ref<Option[]>(
    [
        {marker: 'garantie', name: 'Garantie'},
        {marker: 'hors_garantie', name: 'Hors garantie'},
        {marker: 'entretien', name:'Entretien'}
    ]
)

const addEmptyQualification = () => {
    options.value.push({marker:null, name: null})
}

const deleteOption = (_option: object) => {
    console.log("delete option", _option);
    let index = options.value.findIndex(option => option.marker === _option.marker)
    console.log(index)
    options.value.splice(index, 1)
}
</script>
