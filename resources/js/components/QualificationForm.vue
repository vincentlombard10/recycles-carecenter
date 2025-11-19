<template>
    <div class="row">
        <div class="col-1">&nbsp;</div>
        <div class="col-5">Valeur</div>
        <div class="col-5">Marqueur</div>
        <div class="col-1">&nbsp;</div>
    </div>
    <QualificationOption v-for="option in options" :option="option"/>
    <QualificationOption />

</template>

<script setup lang="ts">
import {ref} from "vue";
import { Option } from "../types"
import QualificationOption from "./QualificationOption.vue";

const options = ref<[Option]>([
    { marker: "gerantie", name: "Garantie" },
    { marker: "hors_garantie", name: "Hors garantie" },
    { marker: "entretien", name: "entretien", }
])
</script>
