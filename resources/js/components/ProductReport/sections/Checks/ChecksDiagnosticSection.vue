<template>
    <section class="">
        <div class="SubSection_Head">
            <h4>Diagnostic</h4>
            <div>
                <SectionStatusBadge :completed="store.diagnosticsChecksSubsectionCompleted"/>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label for="description" class="form-label">Etat visuel du produit</label>
                <textarea name="description" id="defect" rows="3" class="form-control"
                          v-model="store.description"
                ></textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="defect" class="form-label">Défaut constaté</label>
                <textarea name="defect" id="defect" rows="3" class="form-control"
                          v-model="store.defect"
                          ></textarea>
            </div>
            <div class="col-12 mb-3">
                <label for="tests" class="form-label">Tests réalisés</label>
                <textarea name="tests" id="tests" rows="3" class="form-control" v-model="store.tests"></textarea>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";
import {useProductReportStore} from "../../../../stores/productReport";

const store = useProductReportStore()
</script>
