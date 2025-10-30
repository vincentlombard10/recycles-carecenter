<template>
    <section class="SubSection">
        <div class="SubSection_Head">
            <h3>Autres informations</h3>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="odo" class="form-label mb-1">Kilométrage</label>
                <input type="text"
                       name="odo"
                       v-model="store.odo"
                       class="form-control">
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../../stores/productReport";

const store = useProductReportStore()
</script>
