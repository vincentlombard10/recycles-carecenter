<template>
    <section class="bg-violet-200 p-5 rounded-lg">
        <h6>Ajouter une référence</h6>
        <div class="grid grid-cols-[4rem_auto_auto_8rem_6rem] gap-x-6 align-items-end">
            <div class="col-span-1">
                <label for="quantity" class="form-label mb-1">Quantité</label>
                <input type="number" class="form-control" v-model="quantity">
            </div>
            <div class="col-span-1">
                <label for="itno" class="form-label mb-1">Référence</label>
                <input type="text" class="form-control" v-model="searchTerm" @input="fetchItems">
            </div>
            <div class="col-span-1">
                <label for="itds" class="form-label mb-1">Désignation</label>
                <input type="text" class="form-control" v-model="itds">
            </div>
            <div class="col-span-1">
                <label for="care" class="form-label mb-1">Prise en charge</label>
                <select name="care" id="care" class="form-control" v-model="care">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option :value="true">Oui</option>
                    <option :value="false">Non</option>
                </select>
            </div>
            <div>
                <label for="" class="form-label">-</label>
                <button class="w-full bg-violet-900 px-3 py-2 font-bold border-0"
                        :disabled="!canAddReplacementItem"
                        @click.prevent="handleAddReplacementItem">Ajouter</button>
            </div>
        </div>
        <div class="row">
            <ul class="Item_Selector" v-if="itemsList.length">
                <li v-for="item in itemsList" :key="item" @click="setItem(item)" class="Item_Item">
                    <span>{{ item.itno }}</span>
                    <span>{{ item.label ?? item.itds }}</span>
                    <span>{{ item.group.code }}</span>
                </li>
            </ul>
        </div>
    </section>
</template>

<script setup lang="ts">

import {useProductReportStore} from "../../../stores/productReport";

const store = useProductReportStore()
import {computed, ref} from "vue";

const searchTerm = ref<string>('')
const item = ref()
const quantity = ref<Number>()
const itds = ref<string>('')
const care = ref<Boolean|null|undefined>(null)
const itemsList = ref<[]>([])
const fetchItems = async () => {
    item.value = null
    if(searchTerm.value.length >= 4) {
        console.log(searchTerm.value)
        const req = await fetch('/api/v1/items/?' + new URLSearchParams({q: searchTerm.value}))
        const response = await req.json()
        itemsList.value = response.data
    }
}

const setItem = (_item) => {
    item.value = _item
    searchTerm.value = item.value.itno
    itds.value = item.value.itds
    itemsList.value = []
}

const canAddReplacementItem = computed(() => {
    return searchTerm.value &&
        itds.value &&
        quantity.value &&
        care.value != null && true
})

const handleAddReplacementItem = () => {
    store.addReplacementItem({
        itno: searchTerm.value,
        itds: itds.value,
        quantity: quantity.value,
        care: care.value,
        item: item.value
    })
    itemsList.value = []
    searchTerm.value = itds.value = quantity.value = care.value = item.value = null
}
</script>

<style lang="scss" scoped>
.RI_Form {
    background-color: oklch(94.3% 0.029 294.588);
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
}

.Item_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border: 1px solid oklch(70.2% 0.183 293.541);
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;

    .Item_Item {
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
</style>
