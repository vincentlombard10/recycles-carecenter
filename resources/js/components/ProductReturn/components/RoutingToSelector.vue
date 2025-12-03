<template>
    <h4 class="font-semibold text-md mb-2">Destinataire</h4>
    <div class="row" v-if="store.routingTo">
        <div class="col-lg-4">
            <ContactCard :contact="store.routingTo" class="mb-2"/>
            <input type="hidden" name="routing_to_code" :value="store.routingToCode">
            <button
                class="btn btn-sm btn-dark"
                @click.prevent="store.cancelRoutingTo"><i class="bi bi-x-lg me-1"></i>
                Annuler
            </button>
        </div>
        <div class="col-lg-8">
            <div class="Address_Card">
                <h6>Adresse postale</h6>
                <div class="mb-2" v-show="isEditing">
                    <div class="row mb-1">
                        <div class="col-12">
                            <input type="text"
                                   name="routing_to_address1"
                                   class="form-control form-control-xs"
                                   v-model="store.routingToAddress1">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <input type="text"
                                   name="routing_to_address2"
                                   class="form-control form-control-xs"
                                   v-model="store.routingToAddress2">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-3">
                            <input type="text"
                                   name="routing_to_postcode"
                                   class="form-control form-control-xs"
                                   v-model="store.routingToPostcode">
                        </div>
                        <div class="col-9">
                            <input type="text"
                                   name="routing_to_city"
                                   class="form-control form-control-xs"
                                   v-model="store.routingToCity">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-4">
                            <label for="routing_to_phone" class="form-label mb-0">Téléphone</label>
                            <input type="text"
                                   name="routing_to_phone"
                                   class="form-control form-control-xs"
                                   v-model="store.routingToPhone">
                        </div>
                        <div class="col-8">
                            <label for="routing_to_email" class="form-label mb-0">E-mail</label>
                            <input type="text"
                                   name="routing_to_email"
                                   class="form-control form-control-xs"
                                   v-model="store.routingToEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="routing_to_info" class="form-label mb-0">Infos</label>
                            <textarea name="routing_to_info"
                                      class="form-control form-control-sm"
                                      id="routing_to_info"
                                      cols="30"
                                      v-html="store.routingToInfo"></textarea>
                        </div>
                    </div>
                </div>
                <ContactAddress class="mb-2" v-show="!isEditing" :address="routingToAddress" />
                <div class="Address_Card--Actions">
                    <button class="btn btn-sm btn-violet"
                            v-if="!isEditing"
                            @click.prevent="startEditing">
                        <i class="bi bi-pen me-1"></i>Modifier
                    </button>
                    <button v-else class="btn btn-sm btn-dark"
                            @click.prevent="stopEditing">
                        <i class="bi bi-x-lg me-1"></i>Fermer
                    </button>
                    <button v-if="addressIsChanged"
                            class="btn btn-sm btn-violet"
                            @click.prevent="store.resetRoutingToAddress">
                        Restaurer l'adresse initiale
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row" v-else>
        <div class="col-lg-4 mb-3">
            <input type="text"
                   class="form-control mb-2"
                   placeholder="Code client ..."
                   v-model="store.routingToSearchTerm"
                   @input="store.fetchRoutingToContacts()">
            <button
                class="btn btn-sm btn-dark"
                v-if="store.routingToSearchTerm.length"
                @click.prevent="store.cancelRoutingTo()"><i class="bi bi-eraser me-1"></i>Effacer
            </button>
        </div>
        <div class="col-lg-8 mb-3">
            <ul class="Contacts_List" v-if="store.routingToList.length">
                <ContactItem
                    v-for="contact in store.routingToList"
                    :key="contact" :contact="contact"
                    @click.prevent="store.setRoutingTo(contact.code)"/>
            </ul>
            <template v-else-if="store.routingToSearchTerm.length">
                <div v-if="store.canFetchRoutingToContacts && !store.queryingRoutingToContacts">No suggestions</div>
                <div v-else-if="!store.canFetchRoutingToContacts">Type</div>
            </template>
            <VAlert v-else>Sélectionnez un contact.</VAlert>
        </div>
    </div>
</template>

<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn";
import ContactItem from "./ContactItem.vue";
import ContactCard from "./ContactCard.vue";
import {computed, ref} from "vue";
import ContactAddress from "./ContactAddress.vue";
import VAlert from "../../form/VAlert.vue";

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
        address1: store.routingTo.address1,
        address2: store.routingTo.address2,
        postcode: store.routingTo.postcode,
        city: store.routingTo.city,
        phone: store.routingTo.phone,
        email: store.routingTo.email
    }
})

const routingToAddress = computed(() => {
    return {
        address1: store.routingToAddress1,
        address2: store.routingToAddress2,
        postcode: store.routingToPostcode,
        city: store.routingToCity,
        phone: store.routingToPhone,
        email: store.routingToEmail
    }
})

const addressIsChanged = computed(() => {
    return store.routingTo.address1 !== store.routingToAddress1 ||
        store.routingTo.address2 !== store.routingToAddress2 ||
        store.routingTo.postcode !== store.routingToPostcode ||
        store.routingTo.city !== store.routingToCity ||
        store.routingTo.phone !== store.routingToPhone ||
        store.routingTo.email !== store.routingToEmail
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
