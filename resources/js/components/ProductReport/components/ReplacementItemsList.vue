<template>
    <div v-if="!store.replacementItems.length" class="px-6 py-4 bg-gray-50 font-bold text-slate-950 mb-3 border-slate-200 border-1 rounded-lg">La liste est vide.</div>
    <ul class="Items_List mb-4">
        <li class="Item_Row" v-for="item in store.replacementItems" :key="item">
            <div><i class="bi bi-circle-fill"></i></div>
            <div><i class="bi bi-patch-check-fill"></i></div>
            <div>{{ item.quantity }} x </div>
            <div>{{ item.itno }}</div>
            <div>{{ item.itds }}</div>
            <div><button class="Item_Row__Delete"
                @click.prevent="handleDeleteRow(item)"><i class="bi bi-x"></i></button></div>
            <input name="replacement_item_quantity[]" type="hidden" :value="item.quantity">
            <input name="replacement_item_itno[]" type="hidden" :value="item.itno">
            <input name="replacement_item_itds[]" type="hidden" :value="item.itds">
            <input name="replacement_item_care[]" type="hidden" :value="item.care">
        </li>
    </ul>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../stores/productReport";
import VAlert from "../../form/VAlert.vue";
const store = useProductReportStore()

const handleDeleteRow = (_item) => {
    console.log("handleDeleteRow", _item)
    store.removeReplacementItem(_item)
}
</script>

<style lang="scss" scoped>
.Items_List {
    overflow:hidden;
    border-radius: 0.5rem;
    .Item_Row {
        display:grid;
        padding: 0.5rem 1rem;
        grid-template-columns: 1rem 1rem 2rem 1fr 1fr 1.5rem;
        gap: 1rem;
        background: white;
        align-items: center;
        border-bottom: 1px solid oklch(92.9% 0.013 255.508);
        &:last-child {
            border-bottom: none;
        }
        .Item_Row__Delete {
            width: 1.5rem;
            height: 1.5rem;
            background: gray;
            border: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
        }
    }
}
</style>
