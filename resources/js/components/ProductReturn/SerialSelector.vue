<template>
    <div class="row" v-if="serial">
        <div class="col-lg-12">
            <div class="Serial_Selected">
                <div>{{ serial.code }}</div>
                <div>{{ serial.sku }}</div>
            </div>
            <input type="hidden" name="serial" :value="serial.code">
        </div>
        <div class="lg-6">
            <button class="btn btn-sm btn-dark"
                    @click.prevent="reset">Reset</button>
        </div>
    </div>
    <div class="row" v-else>
        <template v-if="suggestions.length">
            <div class="col-lg-6">
                <div class="Serial_Selector">
                    <ul>
                        <li class="Serial_Item"
                            v-for="suggestion in suggestions"
                            :key="suggestion.code"
                            @click.prevent="setSerial(suggestion)">
                            <span class="fw-bold">{{ suggestion.code }}</span>&nbsp;<span>{{ suggestion.sku }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <button class="btn btn-sm btn-dark"
                        @click.prevent="cancelSuggestions">Supprimer la sélection</button>
            </div>
        </template>
        <template v-else>
            <div class="col-lg-3">
                <label for="" class="form-label mb-1">Numéro de chassis</label>
                <input type="text" class="form-control" v-model="searchTerm">
            </div>
            <div class="col-lg-3 mb-3 d-grid align-bottom">
                <label for="" class="form-label mb-1">&nbsp;</label>
                <button :disabled="!canFetchSerial" class="btn btn-dark" @click.prevent="fetchData">Chercher</button>
            </div>
        </template>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";

const emit = defineEmits(["setSerial"])

const searchTerm = ref('')
const serial = ref()
const suggestions = ref([])

const fetchData = async () => {
    const req = await fetch('/api/v1/serials/?' + new URLSearchParams({ q: searchTerm.value }))
    const response = await req.json()
    suggestions.value = response.data
}

const cancelSuggestions = () => {
    suggestions.value = []
}

const reset = () => {
    searchTerm.value = ''
    serial.value = ''
    suggestions.value = []
    emit('setSerial', null)
}

const setSerial = (_serial) => {
    console.log(_serial)
    serial.value = _serial
    emit('setSerial', serial.value)
}

const canFetchSerial = computed(() => {
    return searchTerm.value.length >= 5
})
</script>

<style lang="scss" scoped>
.Serial_Selector {
    overflow-y: scroll;
    max-height: 12rem;
    border: 1px solid black;
    border-radius: 0 0 0.25rem 0.25rem;
    margin-bottom: .5rem;
    .Serial_Item {
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
.Serial_Selected {
    padding: 1rem 1.25rem;
    background-color: oklch(44.6% 0.043 257.281);
    border-radius: 0.35rem;
    color: white;
    margin-bottom: 0.5rem;
}
</style>

