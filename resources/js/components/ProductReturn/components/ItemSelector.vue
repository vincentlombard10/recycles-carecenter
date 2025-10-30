<template>
    <div class="row" v-if="store.item">
        <div class="col-lg-12 mb-2">
            <ItemCard :item="store.item" />
            <input type="hidden" name="item" :value="store.item.itno">
        </div>
        <div class="col-lg-6">
            <button class="btn btn-sm btn-dark" @click.prevent="store.cancelItem()">
                <i class="bi bi-arrow-clockwise"></i>Annuler</button>
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
                <button class="btn btn-sm btn-dark"
                        @click.prevent="cancelSuggestions">
                    <i class="bi bi-arrow-clockwise"></i>Supprimer la sélection</button>
            </div>
        </template>
        <template v-else>
            <div class="col-lg-3">
                <label for="" class="form-label mb-1">Référence</label>
                <input type="text" class="form-control" v-model="store.itemSearchTerm">
            </div>
            <div class="col-lg-3 mb-3 d-grid align-bottom">
                <label for="" class="form-label mb-1">&nbsp;</label>
                <button class="btn btn-dark" @click.prevent="store.fetchItems">Chercher</button>
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
