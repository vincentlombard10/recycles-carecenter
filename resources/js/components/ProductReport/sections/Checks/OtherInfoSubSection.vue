<template>
    <section class="bg-violet-50 p-8 rounded-xl mb-5">
        <div class="SubSection_Head">
            <h3 class="font-bold text-xl mb-2">Autres informations</h3>
        </div>
        <div class="grid lg:grid-cols-4 gap-x-6 gap-y-4">
            <div>
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
