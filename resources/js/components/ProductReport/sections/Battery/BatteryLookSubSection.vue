<template>
    <section class="">
        <div class="SubSection_Head">
            <h4>Etat visuel</h4>
            <div><SectionStatusBadge :completed="store.batteryLookSubsectionCompleted" /></div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
               <div class="form-check" v-for="item in store.batteryLookStatesList" :key="item.identifier">
                   <input type="checkbox"
                          name="battery_look_states[]"
                          :id="`battery-state--${item.identifier}`"
                          class="form-check-input"
                          :value="`${item.identifier}`"
                          v-model="store.batteryLookStates"
                           />
                   <label :for="`battery-state--${item.identifier}`" class="form-check-label">{{ item.title }} - {{ item.description }}</label>
               </div>
                <div class="form-check">
                    <input type="checkbox"
                           name="battery_look_states[]"
                           id="`ther"
                           class="form-check-input"
                           value="other"
                           v-model="store.batteryLookStates" />
                    <label for="`battery-state--other" class="form-check-label">Autre - Préciser</label>
                </div>
            </div>

            <div class="col-lg-12 mb-3" v-if="otherStateSelected">
                <label for="battery_look_fault" class="form-label mb-1">Préciser</label>
                <input type="text"
                       class="form-control"
                       name="battery_look_custom_state"
                       :value="store.batteryLookCustomState" />
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../../stores/productReport";
import {computed, onMounted, ref} from "vue";
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";

const store = useProductReportStore()

const checkedNames = ref(['Jack'])

const getBatteryLookStates = async () => {
    const req = await fetch('/api/v1/batteries/states')
    const response = await req.json()
    store.batteryLookStatesList = response.data
}

const otherStateSelected = computed(() => {
    return store.batteryLookStates.length &&
        store.batteryLookStates.includes("other")
})

onMounted(() => {
    getBatteryLookStates()
})
</script>
