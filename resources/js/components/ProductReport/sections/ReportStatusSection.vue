<template>
    <section class="mb-8">
        <VAlert v-if="store.reportCompleted" class="bg-green-300 font-bold text-green-950">Le rapport d'intervention est complet.</VAlert>
        <VAlert v-else class="bg-green-300 font-bold text-green-950">Complétez le rapport pour terminer l'intervention.</VAlert>
    </section>
    <section class="mb-8">
        <div class="row">
            <div class="col-6 mb-3">
                <label for="status" class="form-label mb-1">Statut</label>
                <select name="status" id="status" class="form-control" @change="handleChangeStatus">
                    <option value="in_progress">En cours</option>
                    <option value="paused">En pause - devis en attente d'approbation</option>
                    <option value="closed" v-if="store.reportCompleted">Terminé</option>
                </select>
            </div>
        </div>
        <div class="row" v-if="store.status === 'paused'">
            <div class="col-6 mb-3">
                <label for="estimate" class="form-label mb-1">Devis</label>
                <input type="file" class="form-control" name="estimate" required>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import {useProductReportStore} from "../../../stores/productReport";
import VAlert from "../../form/VAlert.vue";

const store = useProductReportStore()
const status = ref('')

const handleChangeStatus = (e) => {
    store.setStatus(e.target.value)
}
</script>
