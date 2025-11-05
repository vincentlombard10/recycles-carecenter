import {defineStore} from "pinia";
import {computed, ref} from "vue";
import {Obj} from "@popperjs/core";

export const useProductReportStore = defineStore('report', () => {

    const type = ref<string>()
    const batteryKey = ref()
    const lockKey = ref()
    const charger = ref()
    const battery = ref()
    const pedals = ref()
    const frontWheel = ref()
    const rearWheel = ref()
    const saddle = ref()
    const seatpost = ref()
    const display = ref()
    const motor = ref()
    const presenceComment = ref<string>('')
    const odo = ref<Number>()
    const description = ref<string>('')
    const defect = ref<string>('')
    const tests = ref<string>('')

    const setBatteryKey = (_battery: string) => {
        batteryKey.value = _battery
    }

    const setLockKey = (_lock: string) => {
        lockKey.value = _lock
    }

    const stripes = ref()
    const corrosion = ref()
    const clay = ref()
    const sand = ref()
    const impacts = ref()
    const cracks = ref()
    const breakage = ref()
    const modification = ref()
    const lookComment = ref()

    const batteryReference = ref<string>('')
    const batterySerial = ref<string>('')
    const batteryTypesList = [
        {identifier: 'liion', label: 'Li-Ion'},
        {identifier: 'lifepo4', label: 'LiFePO4'},
        {identifier: 'nimh', label: 'NiMH'},
        {identifier: 'sla', label: 'SLA'},
    ];
    const batteryType = ref<string>('')

    const setBatteryType = (e) => {
        batteryType.value = e.target.value
    }
    const batteryNominalVoltage = ref()
    const batteryNominalVoltagesList = [
        {identifier: '24', label: '24V'},
        {identifier: '36', label: '36V'},
        {identifier: '48', label: '48V'},
    ]
    const batteryNominalCapacity = ref()

    const batteryLookStatesList = ref<[]>([])
    const batteryLookStates = ref<[]>([])
    const batteryLookCustomState = ref<string>('')

    const getBatteryLookStatesList = async () => {
        const req = await fetch('/api/v1/batteries/states')
        const response = await req.json()
        console.log(response)
        return response.data
    }
    const batteryLookFault = ref<string>('')

    const batteryIndicator = ref<string>('')
    const batteryErrorCodes = ref<string>('')
    const batteryChargeState = ref('')
    const batteryCellsStatesList = [
        {identifier: 'stable', label: 'Equilibre : < 0,2V / cellule'},
        {identifier: 'unstable', label: 'Déséquilibre : > 0,2V / cellule'}
    ]
    const batteryChargeVoltage = ref()

    const batteryEnergy = ref()
    const batteryChargeCycles = ref()
    const batteryCellsState = ref()
    const batteryVirtualUsableCapacity = ref()
    const batteryTemperature = ref()
    const batteryTemperaturesList = [
        {identifier: 'low', label: 'Faible : < 0°C'},
        {identifier: 'normal', label: 'Normale : entre 0°C et 45°C'},
        {identifier: 'high', label: 'Elevée : > 45°C'},
    ]
    const batteryInternalResistance = ref()

    const diagnostic = ref<string>('')



    const replacementItems = ref<[any]>()

    const addReplacementItem = (_item: any) => {
        replacementItems.value.push(_item)
    }

    const removeReplacementItem = (_item: any) => {
        replacementItems.value = replacementItems.value.filter(item => item !== _item)
    }

    const order = ref<string>()


    const presenceChecksSubsectionCompleted = computed(() => {
        return batteryKey.value &&
            lockKey.value &&
            charger.value &&
            battery.value &&
            pedals.value &&
            frontWheel.value &&
            rearWheel.value &&
            saddle.value &&
            seatpost.value &&
            display.value &&
            motor.value && true
    })

    const lookChecksSubsectionCompleted = computed(() => {
        return stripes.value &&
            corrosion.value &&
            clay.value &&
            sand.value &&
            impacts.value &&
            cracks.value &&
            breakage.value &&
            modification.value && true
    })

    const diagnosticsChecksSubsectionCompleted = computed(() => {
        return defect.value &&
            tests.value && true
    })

    const checksSectionCompleted = computed(() => {
        return presenceChecksSubsectionCompleted.value &&
            lookChecksSubsectionCompleted.value &&
            diagnosticsChecksSubsectionCompleted.value
    })

    /* Section 2 - Batterie */

    const batteryIdentificationSubSectionCompleted = computed(() => {
        return batteryReference.value &&
            batterySerial.value &&
            batteryType.value &&
            batteryNominalVoltage.value &&
            batteryNominalCapacity.value
    })

    const batteryLookSubsectionCompleted = computed(() => {
        return batteryLookStates.value.length
    })

    const batteryOperatingSubsectionCompleted = computed(() => {
        return batteryIndicator.value && true
    })

    const batteryTestsSubsectionCompleted = computed(() => {
        return batteryChargeState.value &&
            batteryChargeVoltage.value &&
            batteryEnergy.value && true
    })

    const batterySectionCompleted = computed(() => {
        return batteryIdentificationSubSectionCompleted.value &&
            batteryLookSubsectionCompleted.value &&
            batteryOperatingSubsectionCompleted.value &&
            batteryTestsSubsectionCompleted.value
    })

    /* Section 3 - Diagnostic */

    const diagnosticSectionCompleted = computed(() => {
        return batteryChargeCycles.value &&
            batteryCellsState.value &&
            batteryVirtualUsableCapacity.value &&
            batteryTemperature.value &&
            batteryInternalResistance.value &&
            diagnostic.value

    })

    const reportCompleted = computed(() => {
        if (type.value === 'bike') {
            return presenceChecksSubsectionCompleted.value &&
                lookChecksSubsectionCompleted.value &&
                batterySectionCompleted.value
        } else if (type.value === 'battery') {
            return batterySectionCompleted.value
        } else {
            return diagnosticsChecksSubsectionCompleted.value
        }
    })

    return {
        type,
        batteryKey,
        lockKey,
        charger,
        battery,
        pedals,
        frontWheel,
        rearWheel,
        saddle,
        seatpost,
        display,
        motor,
        presenceComment,
        odo,
        description,
        defect,
        tests,

        setBatteryKey,
        stripes,
        corrosion,
        clay,
        sand,
        impacts,
        cracks,
        breakage,
        modification,
        lookComment,
        batteryReference,
        batterySerial,
        batteryTypesList,
        batteryType,
        batteryNominalVoltage,
        batteryNominalVoltagesList,
        batteryNominalCapacity,
        setBatteryType,
        batteryLookStatesList,
        batteryLookStates,
        batteryLookFault,
        batteryLookCustomState,
        getBatteryLookStatesList,

        batteryIndicator,
        batteryErrorCodes,
        batteryChargeState,
        batteryChargeVoltage,
        batteryEnergy,

        batteryChargeCycles,
        batteryCellsStatesList,
        batteryCellsState,
        batteryVirtualUsableCapacity,
        batteryTemperature,
        batteryTemperaturesList,
        batteryInternalResistance,
        diagnostic,

        replacementItems,
        addReplacementItem,
        removeReplacementItem,
        order,

        presenceChecksSubsectionCompleted,
        lookChecksSubsectionCompleted,
        diagnosticsChecksSubsectionCompleted,
        checksSectionCompleted,
        batteryIdentificationSubSectionCompleted,
        batteryLookSubsectionCompleted,
        batteryOperatingSubsectionCompleted,
        batteryTestsSubsectionCompleted,
        batterySectionCompleted,
        diagnosticSectionCompleted,
        reportCompleted,
    }
})
