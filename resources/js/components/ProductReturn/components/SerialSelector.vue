<template>
    <div class="grid grid-cols-[8rem_4rem_12rem_auto] gap-x-6 gap-y-2" v-if="store.serial || store.serialSearchMethod === 'manual'">
        <div>
            <label for="serial_code" class="form-label mb-1">Numéro de série</label>
            <input type="text"
                   name="serial_code"
                   class="form-control"
                   v-model="store.serialCode"
                   :readonly="store.serialSearchMethod === 'auto'"
                   />
        </div>
        <div>
            <label for="serial_itcl" class="form-label mb-1">Marque</label>
            <input type="text"
                   name="serial_itcl"
                   class="form-control"
                   v-model="store.serialBrand"
                   :readonly="store.serialSearchMethod === 'auto'"
            />
        </div>
        <div>
            <label for="serial_itno" class="form-label mb-1">Référence</label>
            <input type="text"
                   name="serial_itno"
                   class="form-control"
                   v-model="store.serialSku"
                   :readonly="store.serialSearchMethod === 'auto'"
                   />
        </div>
        <div>
            <label for="serial_itds" class="form-label mb-1">Désignation</label>
            <input type="text"
                   name="serial_itds"
                   class="form-control"
                   v-model="store.serialDesignation"
                   :readonly="store.serialSearchMethod === 'auto'"
                   />
        </div>
        <div>
            <button class="bg-slate-800 text-slate-200 px-2 py-1 rounded-sm font-medium text-xs hover:bg-slate-700"
                    @click.prevent="store.cancelSerial()"><i class="bi bi-arrow-clockwise"></i>
                Annuler</button>
        </div>
    </div>
    <div class="row" v-else-if="store.serialsList.length">
        <div class="col-lg-12 mb-2">
            <ul class="Serial_Selector">
                <SerialItem v-for="serial in store.serialsList"
                            :serial="serial"
                            :key="serial.code"
                            @click.prevent="store.setSerial(serial.code, true)" />
            </ul>
        </div>
        <div class="col-lg-3 mb-3">
            <button class="bg-slate-800 text-slate-200 px-2 py-1 rounded-sm font-medium text-xs hover:bg-slate-700"
                    @click.prevent="store.cancelSerial()">
                <i class="bi bi-eraser-fill"></i>
                Supprimer la sélection</button>
        </div>
    </div>
    <template v-else>
        <div class="grid grid-cols-3 gap-4 items-end">
            <div>
                <label for="" class="form-label mb-1">Numéro de chassis</label>
                <input type="text" class="form-control" v-model="store.serialSearchTerm">
            </div>
            <div class="flex gap-2">
                <button class="bg-violet-600 rounded px-4 py-2 text-white font-bold" @click.prevent="store.fetchSerials()">Chercher</button>
                <button @click.prevent="store.setSerialSearchMethod('manual')" class="bg-violet-800 rounded px-4 py-2 text-white font-bold">Renseigner manuellement</button>
            </div>
        </div>
    </template>
</template>

<script setup>
import {useProductReturnStore} from "../../../stores/productReturn.ts";
import SerialItem from "./SerialItem.vue";

const store = useProductReturnStore()
</script>

<style lang="scss" scoped>
.Serial_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border: 1px solid oklch(70.2% 0.183 293.541);
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
    .Serial_Item {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid oklch(89.4% 0.057 293.283);
        background-color: white;
        cursor: pointer;
        color: oklch(28.3% 0.141 291.089);
        &:hover {
            background-color: oklch(94.3% 0.029 294.588);
            color: oklch(28.3% 0.141 291.089);
        }
        &:last-child {
            border-bottom: 0;
        }
    }
}
.Button_Simple {
    border: 0;
}
.Serial_Selected {
    padding: 1rem 1.25rem;
    background-color: oklch(44.6% 0.043 257.281);
    border-radius: 0.35rem;
    color: white;
    margin-bottom: 0.5rem;
}
</style>

