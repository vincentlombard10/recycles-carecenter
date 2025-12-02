<template>
    <section class="Section">
        <h2 class="text-4xl font-bold mb-3">Composants remplacés</h2>
        <ReplacementItemsList />
        <ReplacementItemForm class="mb-5"/>
        <div class="SubSection">
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <label for="order" class="form-label">Commande</label>
                    <input type="text" class="form-control" name="order" v-model="store.order">
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">

import {useProductReportStore} from "../../../stores/productReport";

const store = useProductReportStore()
import ReplacementItemForm from "../components/ReplacementItemForm.vue";
import ReplacementItemsList from "../components/ReplacementItemsList.vue";
</script>
