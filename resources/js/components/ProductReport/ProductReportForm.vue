<template>
    <ChecksSection v-if="store.type != 'battery'"/>
    <BatterySection v-if="store.type === 'bike' || store.type === 'battery' "/>
    <ReplacementPartsSection />
    <ReportStatusSection/>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../stores/productReport";
import ChecksSection from "./sections/Checks/ChecksSection.vue";
import BatterySection from "./sections/Battery/BatterySection.vue";
import DiagnosticSection from "./sections/DiagnosticSection.vue";
import {ref, onMounted} from "vue";
import ReportStatusSection from "./sections/ReportStatusSection.vue";
import ReplacementPartsSection from "./sections/ReplacementPartsSection.vue";

const store = useProductReportStore();
const identifier = ref()
const report = ref()

onMounted(() => {
    if (document.querySelector("#product-report-form").getAttribute('data-report') !== null) {
        identifier.value = document.querySelector("#product-report-form").getAttribute('data-report')
        getReport(identifier.value);
    }
})

const getReport = async (_report) => {
    console.log('Identifier', _report)
    const req = await fetch(`/api/v1/reports/${_report}`)
    const response = await req.json();
    const report = response.data
    console.log(report.value)

    store.type = report.type
    store.batteryKey = report.batteryKey
    store.batteryKeyQty = report.batteryKeyQty
    store.lockKey = report.lockKey
    store.lockKeyQty = report.lockKeyQty
    store.charger = report.charger
    store.chargerQty = report.chargerQty
    store.battery = report.battery
    store.batteryQty = report.batteryQty
    store.pedals = report.pedals
    store.pedalsQty = report.pedalsQty
    store.frontWheel = report.frontWheel
    store.frontWheelQty = report.frontWheelQty
    store.rearWheel = report.rearWheel
    store.rearWheelQty = report.rearWheelQty
    store.saddle = report.saddle
    store.saddleQty = report.saddleQty
    store.seatpost = report.seatpost
    store.seatpostQty = report.seatpostQty
    store.display = report.display
    store.displayQty = report.displayQty
    store.motor = report.motor
    store.motorQty = report.motorQty
    store.presenceComment = report.presenceComment
    store.odo = report.odo
    store.description = report.description
    store.defect = report.defect
    store.tests = report.tests
    console.log(report)

    store.stripes = report.stripes
    store.corrosion = report.corrosion
    store.clay = report.clay
    store.sand = report.sand
    store.impacts = report.impacts
    store.cracks = report.cracks
    store.breakage = report.breakage
    store.modification = report.modification
    store.lookComment = report.lookComment

    store.batteryReference = report.batteryReference
    store.batterySerial = report.batterySerial
    store.batteryType = report.batteryType
    store.batteryNominalVoltage = report.batteryNominalVoltage
    store.batteryNominalCapacity = report.batteryNominalCapacity
    store.batteryLookStates = JSON.parse(report.batteryLookStates) ?? []
    store.batteryLookCustomState = report.batteryLookCustomState
    store.batteryIndicator = report.batteryIndicator
    store.batteryErrorCodes = report.batteryErrorCodes
    store.batteryChargeState = report.batteryChargeState
    store.batteryChargeVoltage = report.batteryChargeVoltage
    store.batteryEnergy = report.batteryEnergy
    store.batteryBmsState = report.batteryBmsState
    store.batteryChargeCycles = report.batteryChargeCycles
    store.batteryCellsState = report.batteryCellsState
    store.batteryVirtualUsableCapacity = report.batteryVirtualUsableCapacity
    store.batteryTemperature = report.batteryTemperature
    store.batteryInternalResistance = report.batteryInternalResistance
    store.diagnostic = report.diagnostic
    store.replacementItems = report.replacementItems
    store.order = report.order
}

</script>

<style lang="scss">
.Section {
    margin-bottom: 4rem;

    &_Head {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
}

.SubSection {
    background-color: white;
    padding: 2rem;
    &:first-of-type {
        border-radius: 0.5rem 0.5rem 0 0;
    }
    &:last-of-type {
        border-radius: 0 0 0.5rem 0.5rem;
    }
    &_Head {
        display: flex;
        justify-content: space-between;
    }
}
</style>
