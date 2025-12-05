<template>
    <section class="">
        <div class="Section_Head">
            <h2 class="mb-3">Diagnotics</h2>
            <div>
                <SectionStatusBadge :completed="diagnosticSectionCompleted"/>
            </div>
        </div>
        <section class="SubSection">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <label for="battery_charge_cycles" class="form-label mb-1">Cycles de charge</label>
                    <input type="text"
                           class="form-control"
                           name="battery_charge_cycles"
                           v-model="store.batteryChargeCycles">
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="battery_cells_state" class="form-label mb-1">Etat des cellules</label>
                    <select name="battery_cells_state"
                            class="form-control"
                            v-model="store.batteryCellsState">
                        <option :value="null" selected disabled>Sélectionner</option>
                        <option v-for="cellsState in store.batteryCellsStatesList"
                                :key="cellsState.identifier" :value="cellsState.identifier">
                            {{ cellsState.label }}
                        </option>
                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="battery_usable_capacity" class="form-label mb-1">Capacité utile</label>
                    <input type="number" step="0.1" min="0" max="100000"
                           class="form-control"
                           name="battery_usable_capacity"
                           v-model="store.batteryVirtualUsableCapacity">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <label for="battery_temperature" class="form-label mb-1">Température</label>
                    <select name="battery_temperature" class="form-control" v-model="store.batteryTemperature">
                        <option selected disabled>Sélectionner</option>
                        <option v-for="temp in store.batteryTemperaturesList" :key="temp.identifier"
                                :value="temp.identifier">{{ temp.label }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <label for="battery_internal_resistance" class="form-label mb-1">Résistance interne</label>
                    <input type="number" step="0.1" min="0" max="100000"
                           class="form-control"
                           name="battery_internal_resistance"
                           v-model="store.batteryInternalResistance">
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="diagnostic" class="form-label mb-1">Diagnostic</label>
                    <input type="text" class="form-control" name="diagnostic" v-model="store.diagnostic">
                </div>
            </div>
        </section>
    </section>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../stores/productReport";
import SectionStatusBadge from "../../common/SectionStatusBadge.vue";
import { computed } from 'vue'
const store = useProductReportStore()

const diagnosticSectionCompleted = computed(() => {
    return store.diagnosticSectionCompleted
})
</script>
