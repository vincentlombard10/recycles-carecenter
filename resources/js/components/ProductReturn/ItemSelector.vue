<template>
    <div class="row" v-if="item">
        <div class="col-lg-6 mb-3">
            <div class="Item_Selected">
                <span class="fw-bold">{{ item.itno }}</span> <span>{{ item.itds }}</span>
                <input type="text" name="component" :value="item.itno">
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <button class="Button_Simple" @click.prevent="reset">Nouvelle sélection</button>
        </div>
    </div>
    <div class="row" v-else>
        <template v-if="itemsSuggestions.length">
            <div class="col-lg-6 mb-3">
                <div class="Item_Selector">
                    <ul>
                        <li class="Item_Item"
                            v-for="suggestion in itemsSuggestions"
                            :key="suggestion.itno"
                            @click.prevent="setItem(suggestion)">
                            <span class="fw-bold">{{ suggestion.itno }}</span>&nbsp;<span>{{ suggestion.itds }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <button class="Button_Simple"
                        @click.prevent="cancelSuggestions">Supprimer la sélection</button>
            </div>
        </template>
        <template v-else>
            <div class="col-lg-3">
                <label for="" class="form-label mb-1">Référence</label>
                <input type="text" class="form-control" v-model="searchTerm">
            </div>
            <div class="col-lg-3 mb-3 d-grid align-bottom">
                <label for="" class="form-label mb-1">&nbsp;</label>
                <button class="btn btn-dark" @click.prevent="fetchData">Chercher</button>
            </div>
        </template>
    </div>
</template>

<script setup>
import {ref} from "vue";

const emit = defineEmits(['setItem'])

const searchTerm = ref('')
const item = ref()
const itemsSuggestions = ref([])

const fetchData = async () => {
    const req = await fetch('/api/v1/items/?' + new URLSearchParams({ q: searchTerm.value }))
    const response = await req.json()
    itemsSuggestions.value = response
}

const cancelSuggestions = () => {
    itemsSuggestions.value = []
    emit('setItem', null)
}

const reset = () => {
    searchTerm.value = ''
    item.value = ''
    itemsSuggestions.value = []
    emit('setItem', null)
}

const setItem = (payload) => {
    item.value = payload
    emit('setItem', payload)
}
</script>

<style lang="scss" scoped>
.Item_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border: 1Px solid black;
    border-radius: 0 0 0.25rem 0.25rem;
    .Item_Item {
        padding: 0.65rem 1rem;
        border-bottom: 1Px solid #b5babd;
        cursor: pointer;
        &:hover {
            background-color: black;
            color: white;
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
    padding: 0.65rem 1rem;
    background-color: oklch(44.6% 0.043 257.281);
    color: white;
}
</style>
