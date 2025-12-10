<template>
    <h4 class="font-semibold text-md mb-2">Réexpédition</h4>
    <div class="grid grid-cols-[24rem_auto] gap-x-6" v-if="store.returnTo">
        <div>
            <ContactCard :contact="store.returnTo" class="mb-2"/>
            <input type="hidden" name="return_to_code" :value="store.returnToCode">
            <button
                class="bg-slate-800 text-slate-200 px-2 py-1 rounded-sm font-medium text-xs hover:bg-slate-700"
                @click.prevent="store.cancelReturnTo"><i class="bi bi-x-lg me-1"></i>&nbsp;Annuler
            </button>
        </div>
        <div class="bg-white rounded-lg px-6 py-4">
            <h6>Adresse postale</h6>
            <div class="mb-2" v-show="isEditing">
                <div class="row mb-1">
                    <div class="col-12">
                        <input type="text"
                               name="return_to_address1"
                               class="form-control form-control-xs"
                               v-model="store.returnToAddress1">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-12">
                        <input type="text"
                               name="return_to_address2"
                               class="form-control form-control-xs"
                               v-model="store.returnToAddress2">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-3">
                        <input type="text"
                               name="return_to_postcode"
                               class="form-control form-control-xs"
                               v-model="store.returnToPostcode">
                    </div>
                    <div class="col-9">
                        <input type="text"
                               name="return_to_city"
                               class="form-control form-control-xs"
                               v-model="store.returnToCity">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-4">
                        <label for="return_to_phone" class="form-label mb-0">Téléphone</label>
                        <input type="text"
                               id="return_to_phone"
                               name="return_to_phone"
                               class="form-control form-control-xs"
                               v-model="store.returnToPhone">
                    </div>
                    <div class="col-8">
                        <label for="return_to_email" class="form-label mb-0">E-mail</label>
                        <input type="text"
                               id="return_to_email"
                               name="return_to_email"
                               class="form-control form-control-xs"
                               v-model="store.returnToEmail">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="return_to_info" class="form-label mb-0">Infos</label>
                        <textarea name="return_to_info"
                                  class="form-control form-control-sm"
                                  id="return_to_info"
                                  cols="30"
                                  v-html="store.returnToInfo"></textarea>
                    </div>
                </div>
            </div>
            <ContactAddress class="mb-2" v-show="!isEditing" :address="returnToAddress"/>
            <div class="flex gap-2">
                <button v-if="!isEditing"
                        class="px-3 py-2 rounded-sm bg-slate-100 text-slate-800 font-medium hover:bg-slate-200"
                        @click.prevent="startEditing">
                    <i class="bi bi-pen me-1"></i>Modifier
                </button>
                <button v-else
                        class="px-3 py-1 rounded-sm bg-slate-200 text-slate-900 font-medium hover:bg-slate-300"
                        @click.prevent="stopEditing">
                    <i class="bi bi-x-lg me-1"></i>Fermer
                </button>
                <button v-if="addressIsChanged"
                        class="px-3 py-1 rounded-sm bg-violet-200 text-violet-900 font-medium hover:bg-violet-300"
                        @click.prevent="store.resetReturnToAddress">
                    Restaurer l'adresse initiale
                </button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-[16rem_auto] gap-x-6" v-else>
        <div>
            <input type="text"
                   class="form-control mb-2"
                   placeholder="Code client ..."
                   v-model="store.returnToSearchTerm"
                   @input="store.fetchReturnToContacts()">
            <button
                class="bg-slate-800 text-slate-200 px-2 py-1 rounded-sm font-medium text-xs hover:bg-slate-700"
                v-if="store.returnToSearchTerm.length"
                @click.prevent="store.cancelReturnTo()"><i class="bi bi-eraser"></i>&nbsp;Effacer
            </button>
        </div>
        <div>
            <ul class="Contacts_List" v-if="store.returnToList.length">
                <ContactItem
                    v-for="contact in store.returnToList"
                    :key="contact"
                    :contact="contact"
                    @click.prevent="store.setReturnTo(contact)"/>
            </ul>
            <template v-else-if="store.returnToSearchTerm.length">
                <div v-if="store.canFetchReturnToContacts && !store.queryingReturnToContacts">No suggestions</div>
                <div v-else-if="!store.canFetchReturnToContacts">Tapez au moins {{ store.generalMinSearchLength }}
                    caractères.
                </div>
            </template>
        </div>
    </div>
</template>

<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn";
import ContactItem from "./ContactItem.vue";
import ContactCard from "./ContactCard.vue";
import {ref, computed} from "vue";
import ContactAddress from "./ContactAddress.vue";

const store = useProductReturnStore()

const isEditing = ref(false)

const startEditing = () => {
    isEditing.value = true
}

const stopEditing = () => {
    isEditing.value = false
}

const contactAddress = computed(() => {
    return {
        address1: store.returnTo.address1,
        address2: store.returnTo.address2,
        postcode: store.returnTo.postcode,
        city: store.returnTo.city
    }
})

const returnToAddress = computed(() => {
    return {
        address1: store.returnToAddress1,
        address2: store.returnToAddress2,
        postcode: store.returnToPostcode,
        city: store.returnToCity
    }
})

const addressIsChanged = computed(() => {
    return store.returnTo.address1 !== store.returnToAddress1 ||
        store.returnTo.address2 !== store.returnToAddress2 ||
        store.returnTo.postcode !== store.returnToPostcode ||
        store.returnTo.city !== store.returnToCity
})

</script>

<style lang="scss" scoped>
.Contacts_List {
    overflow-y: scroll;
    height: 14rem;
    border: 1px solid oklch(70.2% 0.183 293.541);
    border-radius: 0.375rem;
    margin-bottom: 0.5rem;
    background-color: oklch(94.3% 0.029 294.588);

    .Contact_Item {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid oklch(89.4% 0.057 293.283);
        background-color: white;
        cursor: pointer;
        color: oklch(28.3% 0.141 291.089);

        &:hover {
            background-color: oklch(95.4% 0.038 75.164);
            color: oklch(28.3% 0.141 291.089);
        }

        &:last-child {
            border-bottom: 0;
        }
    }
}
</style>
