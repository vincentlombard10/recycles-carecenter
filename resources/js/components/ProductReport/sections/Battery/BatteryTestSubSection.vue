<template>
    <section class="bg-violet-50 p-8 rounded-xl mb-5">
        <div class="SubSection_Head">
            <h4 class="font-bold text-xl mb-2">Test de fonctionnement</h4>
            <div>
                <SectionStatusBadge :completed="store.batteryOperatingSubsectionCompleted"/>
            </div>
        </div>
        <div class="grid lg:grid-cols-4 gap-x-6 gap-y-4">
            <div>
                <label for="battery_indicator" class="form-label mb-1">La batterie s'allume t-elle ?</label>
                <select name="battery_indicator"
                        v-model="store.batteryIndicator"
                        id="battery_indicator"
                        class="form-control">
                    <option value="" disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div class="col-span-3">
                <label for="battery_error_codes" class="form-label mb-1">Codes erreur</label>
                <input type="text"
                       name="battery_error_codes"
                       id="battery_error_codes"
                       v-model="store.batteryErrorCodes"
                       class="form-control">
            </div>
        </div>
    </section>
    <section class="bg-violet-50 p-8 rounded-xl mb-5">
        <div class="SubSection_Head">
            <h4 class="font-bold text-xl mb-2">Tests de charge et décharge</h4>
            <div>
                <SectionStatusBadge :completed="store.batteryTestsSubsectionCompleted"/>
            </div>
        </div>
        <div class="grid lg:grid-cols-2 gap-x-6 gap-y-4">
            <div>
                <h5>Tests de charge</h5>
                <div class="col-lg-4 mb-3">
                    <label for="battery_charge_state" class="form-label mb-1">Est-ce que la charge se lance normalement </label>
                    <select name="battery_charge_state" id="battery_charge_state" class="form-control" v-model="store.batteryChargeState">
                        <option value="" selected disabled>Sélectionner</option>
                        <option value="good">Oui</option>
                        <option value="bad">Non</option>
                    </select>
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="battery_charge_voltage" class="form-label mb-1">Tension aux bornes de la batterie (V)</label>
                    <input type="text"
                           v-model="store.batteryChargeVoltage"
                           name="battery_charge_voltage"
                           class="form-control">
                </div>
            </div>
            <div>
                <h5>Test capacité banc de décharge</h5>
                <div class="col-4 mb-3">
                    <label for="battery_energy" class="form-label mb-1">Energie totale délivrée en Ah </label>
                    <input type="number" step="0.1" min="0" max="20"
                           name="battery_energy"
                           v-model="store.batteryEnergy"
                           class="form-control">
                </div>
                <div class="col-12 mb-3" v-if="store.batteryEnergy">
                    <VAlert type="success" v-if="batteryIsAbove70Percent">
                        La batterie est au dessus de 70% de sa capacité nominale. Elle est dans un état normal de fonctionnement.
                    </VAlert>
                    <VAlert type="danger" v-else>La batterie est en dessous de 70% de sa capacité nominale. Un remplacement est fortement recommandé.</VAlert>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-violet-50 p-8 rounded-xl mb-5">
        <div class="SubSection_Head">
            <h4 class="font-bold text-xl mb-2">Diagnostic via le BMS</h4>
            <div><SectionStatusBadge :completed="true" /></div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" v-model="store.batteryBmsState" name="bms_state" id="bms_state">
                <label for="bms_state" class="form-check-label mb-1">BMS exploitable</label>
            </div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-4 mb-4">
            <div>
                <label for="battery_charge_cycles" class="form-label">Cycles de charge</label>
                <input type="text"
                       class="form-control"
                       name="battery_charge_cycles"
                       :disabled="!store.batteryBmsState"
                       v-model="store.batteryChargeCycles">
            </div>
            <div>
                <label for="battery_cells_state" class="form-label">Etat des cellules</label>
                <select name="battery_cells_state"
                        class="form-control"
                        :disabled="!store.batteryBmsState"
                        v-model="store.batteryCellsState">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option v-for="cellsState in store.batteryCellsStatesList"
                            :key="cellsState.identifier" :value="cellsState.identifier">
                        {{ cellsState.label }}
                    </option>
                </select>
            </div>
            <div>
                <label for="battery_usable_capacity" class="form-label mb-1">Capacité utile (Ah)</label>
                <input type="number" step="0.1" min="0" max="100000"
                       class="form-control"
                       :disabled="!store.batteryBmsState"
                       name="battery_usable_capacity"
                       v-model="store.batteryVirtualUsableCapacity">
            </div>
            <div>
                <label for="battery_temperature" class="form-label mb-1">Température interne</label>
                <select name="battery_temperature" id="battery_temperature" v-model="store.batteryTemperature">
                    <option :value="temp.identifier" v-for="temp in store.batteryTemperaturesList">{{ temp.label }}</option>
                </select>
            </div>
            <div>
                <label for="battery_internal_resistance" class="form-label mb-1">Résistance interne (mΩ)</label>
                <input type="number" step="0.1" min="0" max="100000"
                       class="form-control"
                       :disabled="!store.batteryBmsState"
                       name="battery_internal_resistance"
                       v-model="store.batteryInternalResistance">
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label for="diagnostic" class="form-label mb-1">Diagnostic</label>
                <textarea class="form-control" rows="4" v-html="store.diagnostic" name="diagnostic"></textarea>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../../stores/productReport";
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";
import VAlert from "../../../form/VAlert.vue";
import {computed} from "vue";

const store = useProductReportStore()

const batteryIsAbove70Percent = computed(() => {
    return store.batteryEnergy > 0.7 * store.batteryNominalCapacity
})
</script>
