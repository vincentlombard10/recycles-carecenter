<template>
    <div class="row" v-if="store.serial || store.serialSearchMethod === 'manual'">
        <div class="col-lg-3 mb-2">
            <label for="serial_code" class="form-label mb-1">Numéro de série</label>
            <input type="text"
                   name="serial_code"
                   class="form-control"
                   v-model="store.serialCode"
                   :readonly="store.serialSearchMethod === 'auto'"
                   />
        </div>
        <div class="col-lg-3 mb-2">
            <label for="serial_itno" class="form-label mb-1">Référence</label>
            <input type="text"
                   name="serial_itno"
                   class="form-control"
                   v-model="store.serialSku"
                   :readonly="store.serialSearchMethod === 'auto'"
                   />
        </div>
        <div class="col-lg-3 mb-2">
            <label for="serial_itds" class="form-label mb-1">Désignation</label>
            <input type="text"
                   name="serial_itds"
                   class="form-control"
                   v-model="store.serialDesignation"
                   :readonly="store.serialSearchMethod === 'auto'"
                   />
        </div>
        <div class="col-lg-3 mb-2">
            <label for="serial_itcl" class="form-label mb-1">Marque</label>
            <input type="text"
                   name="serial_itcl"
                   class="form-control"
                   v-model="store.serialBrand"
                   :readonly="store.serialSearchMethod === 'auto'"
                   />
        </div>
        <div class="lg-6">
            <button class="btn btn-sm btn-dark"
                    @click.prevent="store.cancelSerial()"><i class="bi bi-arrow-clockwise"></i>
                Annuler</button>
        </div>
    </div>
    <div class="row" v-else-if="store.serialsList.length">
        <div class="col-lg-12 mb-2">
            <ul class="Serial_Selector">
                <li class="Serial_Item"
                    v-for="serial in store.serialsList"
                    :key="serial.code"
                    @click.prevent="store.setSerial(serial.code)">
                    <span class="fw-bold">{{ serial.code }}</span>&nbsp;<span>{{ serial.sku }}</span>
                </li>
            </ul>
        </div>
        <div class="col-lg-3 mb-3">
            <button class="btn btn-sm btn-dark"
                    @click.prevent="store.cancelSerial()">
                <i class="bi bi-eraser-fill"></i>
                Supprimer la sélection</button>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-lg-3 mb-3">
            <label for="" class="form-label mb-1">Numéro de chassis</label>
            <input type="text" class="form-control" v-model="store.serialSearchTerm">
        </div>
        <div class="col-lg-3 mb-3 d-grid align-bottom">
            <label for="" class="form-label mb-1">&nbsp;</label>
            <button class="btn btn-dark full-width" @click.prevent="store.fetchSerials()">Chercher</button>
        </div>
        <div class="col-lg-3 mb-3 d-grid align-bottom">
            <label for="" class="form-label mb-1">&nbsp;</label>
            <button @click.prevent="store.setSerialSearchMethod('manual')" class="btn btn-primary">Renseigner manuellement</button>
        </div>
    </div>
</template>

<script setup>
import {useProductReturnStore} from "../../../stores/productReturn.ts";
import SerialCard from "./SerialCard.vue";

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

