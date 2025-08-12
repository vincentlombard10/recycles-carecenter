<template>
    <div class="card">
        <div class="card-body p-5">
            <section id="Qualification" class="p-3">
                <div class="row">
                    <div class="col-xl-12 mb-3">
                        <h2><i class="bi me-2" :class="{'bi-check-circle-fill': section1isValid, 'bi-x-circle': !section1isValid}"></i>1. Qualification</h2>
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="type" class="form-label mb-1">Type de retour</label>
                                <VSelect
                                    v-if="typesList.length"
                                    name="type"
                                    :options="typesList"
                                    @select="handleSelectType" />
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="context" class="form-label mb-1">Contexte</label>
                                <VSelect
                                    v-if="contextsList.length"
                                    name="context"
                                    :options="contextsList"
                                    @select="handleSelectContext" />
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="reason" class="form-label mb-1">Motif</label>
                                <VSelect
                                    v-if="reasonsList.length"
                                    name="reason"
                                    :options="reasonsList"
                                    @select="handleSelectReason" />
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="assignee" class="form-label mb-1">Assignation</label>
                                <VSelect
                                    v-if="assignationsList.length"
                                    name="assignee"
                                    :options="assignationsList"
                                    @select="handleSelectAssignation" />
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="action" class="form-label mb-1">Action</label>
                                <VSelect
                                    v-if="actionsList.length"
                                    name="action"
                                    :options="actionsList"
                                    @select="handleSelectAction" />
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="destination" class="form-label mb-1">Destination</label>
                                <VSelect
                                    v-if="destinationsList.length"
                                    name="destination"
                                    :options="destinationsList"
                                    @select="handleSelectDestination" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="Ticket" class="p-3">
                <div class="row">
                    <div class="col-xl-12 mb-3">
                        <h2><i class="bi bi-slash-circle me-2"></i>2. Ticket associé</h2>
                        <TicketSelector @set-ticket="handleSelectTicket" />
                    </div>
                </div>
            </section>
            <section id="Product" class="p-3">
                <div class="row">
                    <div class="col-xl-12 mb-3">
                        <h2><i class="bi me-2" :class="{'bi-check-circle-fill': section3isValid, 'bi-x-circle': !section3isValid}"></i>3. Produit concerné</h2>
                        <template v-if="type">
                            <ItemSelector
                                v-if="type === 'component' || type === 'composant'"
                                @set-item="setComponent" />
                            <SerialSelector
                                v-if="type === 'bike' || type === 'velo'"
                                @set-serial="setSerial" />
                        </template>
                        <VAlert v-else>Veuillez d'abord sélectionner le type de retour.</VAlert>
                    </div>
                </div>
            </section>
            <section id="Sale_Information" class="p-3">
                <h2><i class="bi me-2" :class="{'bi-check-circle-fill': section4isValid, 'bi-x-circle': !section4isValid}"></i>4. Informations de vente</h2>
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <label for="" class="form-label mb-1">Date de vente</label>
                        <input type="date"
                               class="form-control"
                               v-model="bikeSoldAt"
                               name="bike_sold_at">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="" class="form-label mb-1">Commande</label>
                        <input type="text" class="form-control"
                               :class="{'form-control--success': order !== ''}"
                               v-model="order"
                               name="order">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="" class="form-label mb-1">Facture</label>
                        <input type="text"
                               class="form-control"
                               :class="{'form-control--success': invoice.length}"
                               v-model="invoice"
                               name="invoice">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="" class="form-label mb-1">Bon de livraison</label>
                        <input type="text" class="form-control"
                               :class="{'form-control--success': delivery !== ''}"
                               v-model="delivery"
                               name="delivery">
                    </div>
                </div>
            </section>
            <section id="Comments" class="p-3">
                <h2><i class="bi me-2" :class="{'bi-check-circle-fill': section5isValid, 'bi-x-circle': !section5isValid}"></i>5. Commentaires</h2>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="" class="form-label mb-1">Informations sur le retour</label>
                        <textarea class="form-control" v-model="info" rows="5" v-html="info" name="info"></textarea>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="" class="form-label mb-1">Commentaires</label>
                        <textarea class="form-control" v-model="comment" rows="5" v-html="comment" name="comment"></textarea>
                    </div>
                </div>
            </section>
            <section id="Routing" class="p-3">
                <div class="row">
                    <h2><i class="bi me-2" :class="{'bi-check-circle-fill': section6isValid, 'bi-x-circle': !section6isValid}"></i>6. Acheminement et retour</h2>
                    <div class="col-xl-9">
                        <div class="mb-3">
                            <label for="" class="form-label">Expéditeur</label>
                            <AddressBox fields-prefix="routing-from" @selected="handleSetRoutingFromAddress"/>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Destinataire</label>
                            <AddressBox fields-prefix="routing-to" @selected="handleSetRoutingToAddress"/>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Réexpédition</label>
                            <AddressBox fields-prefix="return" @selected="handleSetReturnAddress"/>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col-12">
                        <input v-if="canSubmit" type="submit" value="Créer un bon de retour" class="btn btn-primary">
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>


<script setup lang="ts">
import {ref, computed, onMounted} from "vue"
import ItemSelector from "./ItemSelector.vue";
import ItemTable from "../ItemTable.vue";
import SerialTable from "../SerialTable.vue";
import AddressBox from "../AddressBox.vue";
import SerialSelector from "./SerialSelector.vue";
import SectionStatusAlert from "../SectionStatusAlert.vue";
import VSelect from "../form/VSelect.vue";
import VAlert from "../form/VAlert.vue";
import TicketSelector from "./TicketSelector.vue";

const type = ref<string>('')
const typesList = ref<[]>([])

const context = ref<string>('')
const contextsList = ref([])

const reason = ref<string>('')
const reasonsList = ref([])

const assignation = ref<string>('')
const assignationsList = ref([])

const action = ref<string>('')
const actionsList = ref([])

const destination = ref<string>('')
const destinationsList = ref([])

const ticket = ref<string>('')
const searchTerm = ref<string>('')
const serial = ref<{[key: string]: string}>(null)
const component = ref<{[key: string]: string}>(null)
const bikeSoldAt = ref('')
const order = ref<string>('')
const invoice = ref<string>('')
const delivery = ref<string>('')
const info = ref<string>('')
const comment = ref<string>('')
const routingFromAddress = ref<string>(null)
const routingToAddress = ref<string>(null)
const returnAddress = ref<string>(null)

const section1isValid = computed<boolean>(() => {
    return type.value.length > 0
        && context.value.length > 0
        && reason.value.length > 0
        && assignation.value.length > 0
        && action.value.length > 0
        && destination.value.length > 0;
})

const section2isValid = computed(() => {
    return true
})

const section3isValid = computed(() => {
    return serial.value != null || component.value != null;
})

const section4isValid = computed(() => {
    return bikeSoldAt.value.length > 0
        && order.value.length > 0
        && invoice.value.length > 0
        && delivery.value.length > 0;

})

const section5isValid = computed(() => {
    return info.value.length > 0
})

const section6isValid = computed(() => {
    return routingToAddress.value != null && routingFromAddress.value != null;
})

const canSubmit = computed(() => {
    return section1isValid.value === true
        && section2isValid.value === true
        && section3isValid.value === true
        && section4isValid.value === true
        && section5isValid.value === true;
})

const setComponent = (payload: Object) => {
    component.value = payload
}

const setSerial = (payload: string) => {
    serial.value = payload
}

const handleSelectType = (_type: string) => {
    type.value = _type
}

const handleSelectContext = (_context: string) => {
    context.value = _context
}

const handleSelectReason = (_reason: string) => {
    reason.value = _reason
}

const handleSelectDestination = (_destination: string) => {
    destination.value = _destination
}

const handleSelectAction = (_action: string) => {
    action.value = _action
}

const handleSelectAssignation = (_assignation: string) => {
    assignation.value = _assignation
}

const handleSelectTicket = (_ticket: string) => {
    ticket.value = _ticket
}

const handleSetRoutingFromAddress = (payload: string) => {
    routingFromAddress.value = payload
}

const handleSetRoutingToAddress = (payload: string) => {
    routingToAddress.value = payload
}

const handleSetReturnAddress = (payload: string) => {
    returnAddress.value = payload
}

const fetchData = async () => {
    if (type.value === 'component') {
        getComponents()
    } else if (type.value === 'bike') {
        getSerial()
    }
}

const getReasons = async () => {
    const req = await fetch('/api/v1/custom-fields/1754387034')
    const response = await req.json()
    reasonsList.value = response.options
}

const getAssignation = async () => {
    const req = await fetch('/api/v1/custom-fields/1754387236')
    const response = await req.json()
    assignationsList.value = response.options
}

const getActions = async () => {
    const req = await fetch('/api/v1/custom-fields/1754387287')
    const response = await req.json()
    actionsList.value = response.options
}

const getDestinations = async () => {
    const req = await fetch('/api/v1/custom-fields/1754387312')
    const response = await req.json()
    destinationsList.value = response.options
}

const getContexts = async () => {
    const req = await fetch('/api/v1/custom-fields/1754406864')
    const response = await req.json()
    contextsList.value = response.options
}

const getTypes = async () => {
    const req = await fetch('/api/v1/custom-fields/1754406879')
    const response = await req.json()
    typesList.value = response.options
}

const getComponents = async () => {
    const req = await fetch('/api/v1/items/?' + new URLSearchParams({ q: searchTerm.value }))
    const response = await req.json()
    if (response?.item !== undefined) {
        component.value = response.item
    }
}

const getSerial = async () => {
    const req = await fetch('/serials/search?' + new URLSearchParams({serial: searchTerm.value}))
    const response = await req.json()
    if (response.serial) {
        serial.value = response.serial
        order.value = response.serial.order ?? '';
        invoice.value = response.serial.invoice ?? '';
        delivery.value = response.serial.delivery ?? '';
    }
}

onMounted(() => {
    getReasons()
    getAssignation()
    getActions()
    getDestinations()
    getContexts()
    getTypes()
})

</script>


<style lang="scss" scoped>
.Section_Card {
    padding: 1.5rem 2.25rem;
    background: white;
    border-radius: 0.5rem;
}
</style>
