<template>
    <div class="row">
        <div class="col-xl-12">
            <section>
                <h3>Classification du retour</h3>
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <label for="" class="form-label mb-1">Type de retour</label>
                        <select name="type" id="type" v-model="type" class="form-control" :class="{'form-control--success': type !== ''}" @change="handleSelectType">
                            <option value="" selected disabled>Sélectionner</option>
                            <option :value="type.value" v-for="type in typesList" :key="type.value">{{ type.label}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="" class="form-label mb-1">Contexte</label>
                        <select name="context" id="context" class="form-control" :class="{'form-control--success': context !== ''}" @change="handleSelectContext">
                            <option value="" selected disabled>Sélectionner</option>
                            <option :value="context.value" v-for="context in contextsList" :key="context.value">{{ context.label}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="reason" class="form-label mb-1">Motif</label>
                        <select name="reason" id="reason" class="form-control" :class="{'form-control--success': reason !== ''}" @change="handleSelectReason">
                            <option value="" selected disabled>Sélectionner</option>
                            <option v-for="reason in reasonsList" :key="reason.value">{{ reason.label}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="assignee" class="form-label mb-1">Destination</label>
                        <select name="assignee" id="assignee" class="form-control" :class="{'form-control--success': destination !== ''}" @change="handleSelectDestination">
                            <option value="" selected disabled>Sélectionner</option>
                            <option v-for="destination in destinationsList" :key="destination.value">{{ destination.label}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="action" class="form-label mb-1">Action 1</label>
                        <select name="action" id="action" class="form-control" :class="{'form-control--success': action1 !== ''}" @change="handleSelectAction1">
                            <option value="" selected disabled>Sélectionner</option>
                            <option v-for="action in actionsList1" :key="action.value">{{ action.label}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="destination" class="form-label mb-1">Action 2</label>
                        <select name="destination" id="destination" class="form-control" :class="{'form-control--success': action2 !== ''}" @change="handleSelectAction2">
                            <option value="">Sélectionner</option>
                            <option v-for="action in actionsList2" :key="action.value">{{ action.label }}</option>
                        </select>
                    </div>
                </div>
            </section>
            <section>
                <h3>Ticket associé</h3>
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <label for="ticket" class="form-label mb-1">Numéro de ticket Zendesk</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="ticket"
                            name="ticket">
                    </div>
                </div>
            </section>
            <section>
                <template v-if="type && serial === null && component === null">
                    <h3>{{ type === 'bike' ? 'Vélo concerné' : 'Composant concerné' }}</h3>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="" class="form-label mb-1">{{ type === 'bike' ? 'Nuéro de série' : 'Référence' }}</label>
                            <input type="text" class="form-control" v-model="searchTerm">
                        </div>
                        <div class="col-lg-3 mb-3 d-grid align-bottom">
                            <label for="" class="form-label mb-1">&nbsp;</label>
                            <button class="btn btn-dark" @click.prevent="fetchData">Chercher</button>
                        </div>
                    </div>
                </template>
                <template v-else-if="type">
                    <h3>{{ type === 'bike' ? 'Vélo concerné' : 'Composant concerné' }}</h3>
                    <ItemTable :item="component" v-if="component" />
                    <SerialTable :serial="serial" v-if="serial"/>
                </template>
                <template v-else>
                    <div class="box">
                        <h3>Produit concerné</h3>
                        Le type de retour est requis pour afficher cette section du formulaire
                    </div>
                </template>
            </section>
            <section>
                <h3>Informations de vente</h3>
                <div class="row">
                    <div class="col-lg-3">
                        <label for="" class="form-label mb-1">Date de vente</label>
                        <input type="date" class="form-control" v-model="bikeSoldAt">
                    </div>
                    <div class="col-lg-3">
                        <label for="" class="form-label mb-1">Commande</label>
                        <input type="text" class="form-control" :class="{'form-control--success': order !== ''}" v-model="order">
                    </div>
                    <div class="col-lg-3">
                        <label for="" class="form-label mb-1">Facture</label>
                        <input type="text" class="form-control" :class="{'form-control--success': invoice.length}" v-model="invoice">
                    </div>
                    <div class="col-lg-3">
                        <label for="" class="form-label mb-1">Bon de livraison</label>
                        <input type="text" class="form-control" :class="{'form-control--success': delivery !== ''}" v-model="delivery">
                    </div>
                </div>
            </section>
            <section>
                <h3>Commentaires</h3>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="" class="form-label mb-1">Informations sur le retour</label>
                        <textarea class="form-control" v-model="info" rows="5" v-html="info"></textarea>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="" class="form-label mb-1">Commentaires</label>
                        <textarea class="form-control" v-model="comment" rows="5" v-html="comment"></textarea>
                    </div>
                </div>
            </section>
            <section>
                <h3>Expéditeur</h3>
                <AddressBox fields-prefix="from"/>
            </section>
            <section>
                <h3>Destinataire</h3>
                <AddressBox fields-prefix="to"/>
            </section>
            <section>
                <h3>Réexpédition</h3>
                <AddressBox fields-prefix="reshipment"/>
            </section>
            <section>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Créer un bon de retour" class="btn btn-primary">
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xl-3 d-none">
            <ul>
                <li><span class="fw-bold">Type : </span>{{ type }}</li>
                <li><span class="fw-bold">Contexte : </span>{{ context }}</li>
                <li><span class="fw-bold">Motif : </span>{{ reason }}</li>
                <li><span class="fw-bold">Destination : </span>{{ destination }}</li>
                <li><span class="fw-bold">Action 1 : </span>{{ action1 }}</li>
                <li><span class="fw-bold">Action 2 : </span>{{ action2 }}</li>
                <li><span class="fw-bold">Ticket : </span>{{ ticket }}</li>
                <li><span class="fw-bold">Date de vente : </span>{{ bikeSoldAt }}</li>
                <li><span class="fw-bold">Commande : </span>{{ order }}</li>
                <li><span class="fw-bold">Facture : </span>{{ invoice }}</li>
                <li><span class="fw-bold">Bon de livraison : </span>{{ delivery }}</li>
                <li><span class="fw-bold">Infos : </span>{{ info }}</li>
                <li><span class="fw-bold">Commentaire :</span>{{ comment }}</li>
            </ul>
        </div>
    </div>
</template>


<script setup>
import { ref, computed } from "vue"
import ItemTable from "./ItemTable.vue";
import SerialTable from "./SerialTable.vue";
import AddressBox from "./AddressBox.vue";
const type = ref('')
const typesList = [
    {"value": "component", "label": "Composant"},
    {"value": "bike", "label": "Vélo"},
]
const context = ref('')
const contextsList = [
    {"value": "warranty", "label": "Garantie"},
    {"value": "out-of-warranty", "label": "Hors Garantie"},
]
const reason = ref('')
const reasonsList = [
    {"id": 1, "label": "Panne électrique"},
    {"id": 2, "label": "Panne mécanique"},
    {"id": 3, "label": "Erreur interne"},
    {"id": 4, "label": "Erreur client"},
    {"id": 5, "label": "Avarie de transport"},
    {"id": 6, "label": "Vélo de prêt ou salon"},
]
const destination = ref('')
const destinationsList = [
    {"value": 1, "label": "Atelier"},
    {"value": 2, "label": "Laboratoire"},
    {"value": 3, "label": "Stock"},
    {"value": 3, "label": "Qualité"},
]
const action1 = ref('')
const actionsList1 = [
    {"value": 1, "label": "Réparation"},
    {"value": 2, "label": "Expertise"},
]
const action2 = ref('')
const actionsList2 = [
    {"value": 1, "label": "Réexpédition"},
    {"value": 2, "label": "Stock"},
    {"value": 3, "label": "Recyclage"},
    {"value": 4, "label": "Crédit"},
    {"value": 5, "label": "Echange"},
]
const ticket = ref('')
const searchTerm = ref('')
const serial = ref(null)
const component = ref(null)
const bikeSoldAt = ref('')
const order = ref('')
const invoice = ref('')
const delivery = ref('')
const info = ref('')
const comment = ref('')

const section1isValid = computed(() => {
    return true
})

const section2isValid = computed(() => {
    return true
})

const section3isValid = computed(() => {
    return true;
})

const section4isValid = computed(() => {
    return true;
})

const section5isValid = computed(() => {
    return true;
})

const canSubmit = computed(() => {
    return section1isValid &&
        section2isValid &&
        section3isValid &&
        section4isValid &&
        section5isValid
})

const handleSelectType = (e) => {
    searchTerm.value = ''
    serial.value = null
    component.value = null
    type.value = e.target.value
}

const handleSelectContext = (e) => {
    context.value = e.target.value
}

const handleSelectReason = (e) => {
    reason.value = e.target.value
}

const handleSelectDestination = (e) => {
    destination.value = e.target.value
}

const handleSelectAction1 = (e) => {
    action1.value = e.target.value
}

const handleSelectAction2 = (e) => {
    action2.value = e.target.value
}
const fetchData = async () => {

    console.log(type.value)
    if (type.value === 'component') {
        const req = await fetch('/items/search?' + new URLSearchParams({ itno: searchTerm.value }))
        const response = await req.json()
        if (response?.item !== undefined) {
            console.log(response.item)
            component.value = response.item
        } else {
            console.log('aucun item correspondant')
        }
    } else if (type.value === 'bike') {
        const req = await fetch('/serials/search?' + new URLSearchParams({serial: searchTerm.value}))
        const response = await req.json()
        if(response.serial) {
            serial.value = response.serial
            order.value = response.serial.order ?? '';
            invoice.value = response.serial.invoice ?? '';
            delivery.value = response.serial.delivery ?? '';
        } else {
            console.log("rien du tout")
        }
    }
}

</script>


<style lang="scss" scoped>
section {
    padding: 1rem;
    .box {
        background-color: oklch(0.967 0.003 264.542);
        border-radius: 0.25rem;
        padding: 2rem;
    }
}
</style>
