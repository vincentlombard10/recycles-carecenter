<template>
    <div class="grid grid-cols-[12rem_auto_4rem] gap-x-6 gap-y-2" v-if="store.item || store.itemSearchMethod === 'manual'">
        <div class="col-lg-3 mb-2">
            <label for="item_itno" class="form-label mb-1">Référence</label>
            <input type="text"
                   name="item_itno"
                   class="form-control"
                   v-model="store.itemSku"
                   :readonly="store.itemSearchMethod === 'auto'"
            />
        </div>
        <div class="col-lg-6 mb-2">
            <label for="item_itds" class="form-label mb-1">Désignation</label>
            <input type="text"
                   name="item_itds"
                   class="form-control"
                   v-model="store.itemDesignation"
                   :readonly="store.itemSearchMethod === 'auto'"
            />
        </div>
        <div class="col-lg-3 mb-2">
            <label for="item_quantity" class="form-label mb-1">Quantité</label>
            <input type="number"
                   name="item_quantity"
                   class="form-control"
                   :readonly="store.type === 'battery'"
                   v-model="store.itemQuantity">
        </div>
        <div>
            <button class="bg-slate-800 text-slate-200 px-2 py-1 rounded-sm font-medium text-xs hover:bg-slate-700"
                    @click.prevent="store.cancelItem()">
                <i class="bi bi-arrow-clockwise mr-1"></i>Annuler
            </button>
        </div>
    </div>
    <div class="row" v-else>
        <template v-if="store.itemsList.length">
            <div class="col-lg-12">
                <div class="Item_Selector">
                    <ul>
                        <li class="Item_Item"
                            v-for="suggestion in store.itemsList"
                            :key="suggestion.itno"
                            @click.prevent="store.setItem(suggestion.itno)">
                            <span class="fw-bold">{{ suggestion.itno }}</span>&nbsp;<span>{{ suggestion.itds }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <button class="bg-slate-800 text-slate-200 px-2 py-1 rounded-sm font-medium text-xs hover:bg-slate-700"
                        @click.prevent="cancelSuggestions">
                    <i class="bi bi-arrow-clockwise"></i>Supprimer la sélection
                </button>
            </div>
        </template>
        <template v-else>
            <div class="grid grid-cols-3 gap-4 items-end">
                <div>
                    <label for="" class="form-label mb-1">Référence</label>
                    <input type="text" class="form-control" v-model="store.itemSearchTerm">
                </div>
                <div class="flex gap-2">
                    <button @click.prevent="store.fetchItems" class="bg-violet-600 rounded px-4 py-2 text-white font-bold">Chercher</button>
                    <button @click.prevent="store.setItemSearchMethod('manual')" class="bg-violet-800 rounded px-4 py-2 text-white font-bold">Renseigner
                        manuellement
                    </button>
                </div>
            </div>
        </template>
    </div>
</template>

<script setup>
import {useProductReturnStore} from "../../../stores/productReturn.ts";
import ItemCard from "./ItemCard.vue";

const store = useProductReturnStore()
</script>

<style lang="scss" scoped>
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

.Button_Simple {
    border: 0;
}

.Item_Selected {
    padding: 1rem 1.25rem;
    background-color: oklch(44.6% 0.043 257.281);
    border-radius: 0.35rem;
    color: white;
    margin-bottom: 0.5rem;
}
</style>
