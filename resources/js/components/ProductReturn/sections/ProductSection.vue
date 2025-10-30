<template>
    <section class="Section" id="Product">
        <div class="Section_Head">
            <h2>Produit concerné</h2>
        </div>
        <template v-if="store.type">
            <ItemSelector
                v-if="store.type === 'component' || store.type === 'battery'" />
            <SerialSelector
                v-if="store.type === 'bike'"/>
        </template>
        <VAlert v-else>Veuillez d'abord sélectionner le type de retour.</VAlert>
    </section>
</template>
<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn.js";
import VAlert from "../../form/VAlert.vue";
import ItemSelector from "../components/ItemSelector.vue";
import SerialSelector from "../components/SerialSelector.vue";
import SectionStatusBadge from "../../common/SectionStatusBadge.vue";

const store = useProductReturnStore()
</script>
