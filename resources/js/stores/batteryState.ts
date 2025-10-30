import {defineStore} from "pinia";
import {computed, ref} from "vue";

export const useBatteryStateStore = defineStore('batteryState', () => {

    const states = ref<[]>([])

    const getAll = async () => {
        console.log('getAll')
        const req = await fetch('/api/v1/batteries/states')
        const response = await req.json()
        states.value = response.data
        console.log(states.value)
        return states.value
    }

    return {
        states,
        getAll
    }

});
