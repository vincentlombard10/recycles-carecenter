<template>
    <section class="Section">
        <VAlert v-if="store.reportCompleted" type="success">Le rapport d'intervention est complet.</VAlert>
        <VAlert v-else>Complétez le rapport pour terminer l'intervention.</VAlert>
    </section>
    <section class="Section">
        <div class="row">
            <div class="col-6">
                <label for="status" class="form-label mb-1">Statut</label>
                <select name="status" id="status" class="form-control">
                    <option value="in_progress">En cours</option>
                    <option value="paused">En pause - devis en attente d'approbation</option>
                    <option value="closed" v-if="store.reportCompleted">Terminé</option>
                </select>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../stores/productReport";
import VAlert from "../../form/VAlert.vue";

const store = useProductReportStore()
</script>
