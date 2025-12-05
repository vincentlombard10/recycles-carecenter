<template>
    <section class="bg-violet-50 p-8 rounded-xl mb-5">
        <div class="SubSection_Head">
            <h4 class="font-bold text-xl mb-2">Identification</h4>
            <div><SectionStatusBadge :completed="store.batteryIdentificationSubSectionCompleted" /></div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-5">
            <div>
                <label for="battery_reference" class="form-label mb-1">Référence</label>
                <input type="text"
                       name="battery_reference"
                       class="form-control"
                       v-model="store.batteryReference">
            </div>
            <div>
                <label for="battery_serial" class="form-label mb-1">Numéro de série</label>
                <input type="text"
                       name="battery_serial"
                       class="form-control"
                       v-model="store.batterySerial">
            </div>
            <div>
                <label for="battery_type" class="form-label mb-1">Type</label>
                <select name="battery_type" id="batterytype"
                        class="form-control"
                        v-model="store.batteryType"
                        @change="handleSetBatteryType($event)">
                    <option value="" disabled>Sélectionner</option>
                    <option v-for="type in store.batteryTypesList" :value="type.label" :key="type.identifier">{{ type.label }}</option>
                </select>
            </div>
            <div>
                <label for="battery_nominal_voltage" class="form-label mb-1">Tension nominale (V)</label>
                <select name="battery_nominal_voltage" id="battery_nominal_voltage"
                        class="form-control"
                        v-model="store.batteryNominalVoltage">
                    <option value="" selected disabled>Sélectionner</option>
                    <option v-for="voltage in store.batteryNominalVoltagesList"
                            :value="voltage.identifier">{{ voltage.label }}</option>
                </select>
            </div>
            <div>
                <label for="battery_nominal_capacity" class="form-label mb-1">Capacité nominale (Ah)</label>
                <input type="number" step="0.1" min="0" max="10000"
                       name="battery_nominal_capacity"
                       class="form-control"
                       v-model="store.batteryNominalCapacity">
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { useProductReportStore } from "../../../../stores/productReport";
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";
const store = useProductReportStore()

const handleSetBatteryType = (e) => {
    console.log(e.target.value)
    store.batteryType = e.target.value
}
</script>
