<template>
    <h4 class="font-semibold text-lg mb-2">Expéditeur</h4>
    <div class="row" v-if="store.routingFrom">
        <div class="col-lg-4">
            <ContactCard :contact="store.routingFrom" class="mb-2"/>
            <input type="hidden" name="routing_from_code" :value="store.routingFromCode">
            <button
                class="btn btn-sm btn-dark"
                @click.prevent="store.cancelRoutingFrom"><i class="bi bi-x-lg me-1"></i>Annuler
            </button>
        </div>
        <div class="col-lg-8">
            <div class="Address_Card">
                <h6>Adresse postale</h6>
                <div class="mb-2" v-show="isEditing">
                    <div class="row mb-1">
                        <div class="col-12">
                            <input type="text"
                                   name="routing_from_address1"
                                   class="form-control form-control-xs"
                                   v-model="store.routingFromAddress1">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12">
                            <input type="text"
                                   name="routing_from_address2"
                                   class="form-control form-control-xs"
                                   v-model="store.routingFromAddress2">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-3">
                            <input type="text"
                                   name="routing_from_postcode"
                                   class="form-control form-control-xs"
                                   v-model="store.routingFromPostcode">
                        </div>
                        <div class="col-9">
                            <input type="text"
                                   name="routing_from_city"
                                   class="form-control form-control-xs"
                                   v-model="store.routingFromCity">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-4">
                            <label for="routing_from_phone" class="form-label mb-0">Téléphone</label>
                            <input type="text"
                                   name="routing_from_phone"
                                   class="form-control form-control-xs"
                                   v-model="store.routingFromPhone">
                        </div>
                        <div class="col-8">
                            <label for="routing_from_email" class="form-label mb-0">E-mail</label>
                            <input type="text"
                                   name="routing_from_email"
                                   class="form-control form-control-xs"
                                   v-model="store.routingFromEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="routing_from_info" class="form-label mb-0">Infos</label>
                            <textarea name="routing_from_info"
                                      class="form-control form-control-sm"
                                      id="routing_from_info"
                                      rows="3"
                                      v-html="store.routingFromInfo"></textarea>
                        </div>
                    </div>
                </div>
                <ContactAddress class="mb-2" v-show="!isEditing" :address="routingFromAddress"/>
                <div class="Address_Card--Actions">
                    <button v-if="!isEditing" class="btn btn-sm btn-violet"
                            @click.prevent="startEditing">
                        <i class="bi bi-pen me-1"></i>Modifier
                    </button>
                    <button v-else class="btn btn-sm btn-dark"
                            @click.prevent="stopEditing">
                        <i class="bi bi-x-lg me-1"></i>Fermer
                    </button>
                    <button v-if="addressIsChanged"
                            class="btn btn-sm btn-violet"
                            @click.prevent="store.resetRoutingFromAddress">Restaurer l'adresse initiale
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
                   v-model="store.routingFromSearchTerm"
                   @input="store.fetchRoutingFromContacts">
            <button
                class="btn btn-sm btn-dark"
                v-if="store.routingFromSearchTerm.length"
                @click.prevent="store.cancelRoutingFrom()"><i class="bi bi-eraser me-1"></i>Effacer
            </button>
        </div>
        <div class="col-lg-8 mb-3">
            <ul class="Contacts_List" v-if="store.routingFromList.length">
                <ContactItem
                    v-for="contact in store.routingFromList"
                    :key="contact"
                    :contact="contact"
                    @click.prevent="store.setRoutingFrom(contact.code)"/>
            </ul>
            <template v-else-if="store.routingFromSearchTerm.length">
                <div v-if="store.canFetchRoutingFromContacts && !store.queryingRoutingFromContacts">No suggestions</div>
                <div v-else-if="!store.canFetchRoutingFromContacts">Type</div>
            </template>
            <VAlert v-else>Sélectionnez un contact.</VAlert>
        </div>
    </div>
</template>

<script setup lang="ts">
import {computed, onMounted, ref} from "vue";
import {useProductReturnStore} from "../../../stores/productReturn";
import ContactItem from "./ContactItem.vue";
import ContactCard from "./ContactCard.vue";
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
        address1: store.routingFrom.address1,
        address2: store.routingFrom.address2,
        postcode: store.routingFrom.postcode,
        city: store.routingFrom.city,
        phone: store.routingFrom.phone,
        email: store.routingFrom.email,
        info: store.routingFrom.info
    }
})

const routingFromAddress = computed(() => {
    return {
        address1: store.routingFromAddress1,
        address2: store.routingFromAddress2,
        postcode: store.routingFromPostcode,
        city: store.routingFromCity
    }
})

const addressIsChanged = computed(() => {
    return store.routingFrom.address1 !== store.routingFromAddress1 ||
        store.routingFrom.address2 !== store.routingFromAddress2 ||
        store.routingFrom.postcode !== store.routingFromPostcode ||
        store.routingFrom.city !== store.routingFromCity ||
        store.routingFrom.phone !== store.routingFromPhone ||
        store.routingFrom.email !== store.routingFromEmail
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
