<template>
    <section>
        <h2>1. Contrôles</h2>
        <section>
            <h3>Contrôle de présence à réception du produit</h3>
            <div class="fields-group row">
                    <div class="col-lg-8">
                        <YesNoSelector name="battery_key"
                                       label="Clé de batterie"
                                       :value="batteryKey"/>
                    </div>
                    <div class="col-lg-8">
                        <YesNoSelector name="antitheft_key"
                                       label="Clé d'antivol"
                                       :value="antitheftKey"/>
                    </div>
                    <div class="col-lg-8">
                        <YesNoSelector name="charger"
                                       label="Chargeur"
                                       :value="charger"/>
                    </div>
                    <div class="col-lg-8">
                        <YesNoSelector name="battery"
                                       label="Batterie"
                                       :value="battery"/>
                    </div>
                    <div class="col-lg-8">
                        <YesNoSelector name="pedals"
                                       label="Pédales"
                                       :value="pedals"/>
                    </div>
                    <div class="col-lg-8">
                        <YesNoSelector name="front_wheel"
                                       label="Roue avant"
                                       :value="frontWheel"/>
                    </div>
                    <div class="col-lg-8">
                        <YesNoSelector name="rear_wheel"
                                       label="Roue arrière"
                                       :value="rearWheel"/>
                    </div>
                    <div class="col-lg-8">
                        <yes-no-selector name="saddle"
                                         label="Selle"
                                         :value="saddle"/>
                    </div>
                    <div class="col-lg-8">
                        <yes-no-selector name="seatpost"
                                         label="Tige de selle"
                                         :value="seatpost"/>
                    </div>
                    <div class="col-lg-8">
                        <yes-no-selector name="display"
                                         label="Display"
                                         :value="display"/>
                    </div>
                    <div class="col-lg-8">
                        <yes-no-selector name="motor"
                                         label="Moteur"
                                         :value="motor"/>
                    </div>
                    <div class="col-lg-8 mb-3">
                        <div class="mb-3">
                            <label for="presence_comment" class="form-label">Commentaire</label>
                            <textarea name="presence_comment" id="presence_comment" cols="30" rows="3" class="form-control" v-html="presenceComment"></textarea>
                        </div>
                    </div>
                </div>
        </section>
        <section>
            <h3>Contrôle de l'état visuel du produit</h3>
            <div class="fields-group row">
                <div class="col-lg-8">
                    <yes-no-selector name="stripes"
                                     label="Rayures"
                                     :value="stripes"/>
                </div>
                <div class="col-lg-8">
                    <yes-no-selector name="corrosion"
                                     label="Corrosion"
                                     :value="corrosion"/>
                </div>
                <div class="col-lg-8">
                    <yes-no-selector name="clay"
                                     label="Terre"
                                     :value="clay"/>
                </div>
                <div class="col-lg-8">
                    <yes-no-selector name="sand"
                                     label="Sable"
                                     :value="sand"/>
                </div>
                <div class="col-lg-8">
                    <yes-no-selector name="impacts"
                                     label="Impacts"
                                     :value="impacts"/>
                </div>
                <div class="col-lg-8">
                    <yes-no-selector name="cracks"
                                     label="Fissures"
                                     :value="cracks"/>
                </div>
                <div class="col-lg-8">
                    <yes-no-selector name="breakages"
                                     label="Casse"
                                     :value="breakages"/>
                </div>
                <div class="col-lg-8">
                    <yes-no-selector name="customizations"
                                     label="Modifications"
                                     :value="customizations"/>
                </div>
                <div class="col-lg-8 mb-3">
                    <div class="mb-3">
                        <label for="check_comment" class="form-label">Commentaire</label>
                        <textarea name="check_comment" id="check_comment" cols="30" rows="3" class="form-control" v-html="checkComment"></textarea>
                    </div>
                </div>
            </div style="background: gray; padding: 0.5rem 1rem;" style="background: gray; padding: 0.5rem 1rem;">
        </section>
        <section>
            <h3>Défaut constaté</h3>
            <div class="fields-group row">
                <div class="col-lg-8 mb-3">
                    <div class="mb-3">
                        <label for="issue_comment" class="form-label">Commentaire</label>
                        <textarea name="issue_comment" id="" cols="30" rows="3" class="form-control" v-html="issueComment"></textarea>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section>
        <h2>2. Batterie</h2>
        <section>
            <div class="fields-group row">
                <h3>Identification</h3>
                <div id="Battery_Reference" class="col-sm-6 col-lg-4 mb-3">
                    <label for="" class="form-label">Référence de la batterie</label>
                    <input type="text"
                           class="form-control"
                           name="battery_reference"
                           :value="batteryReference">
                </div>
                <div id="Battery_Serial" class="col-sm-6 col-lg-4 mb-3">
                    <label for="" class="form-label">Numéro de série</label>
                    <input type="text"
                           class="form-control"
                           name="battery_serial"
                           :value="batterySerial">
                </div>
                <div id="Battery_Type" class="col-sm-4 mb-3">
                    <label for="" class="form-label">Type</label>
                    <select class="form-control" name="battery_type">
                        <option disabled :selected="batteryType == null">Sélectionner</option>
                        <option v-for="type in batteryTypesList" :value="type.label" :key="type.id" :selected="type === batteryType">{{ type.label }}</option>
                    </select>
                </div>
                <div id="Battery_Voltage" class="col-sm-4 mb-3">
                    <label for="" class="form-label">Tension nominale (V)</label>
                    <select class="form-control" name="battery_voltage">
                        <option disabled :selected="batteryVoltage == null">Sélectionner</option>
                        <option v-for="voltage in voltagesList" :key="voltage" :value="voltage.id" :selected="parseFloat(voltage.id) === parseFloat(batteryVoltage)">{{ voltage.label }}</option>
                    </select>
                </div>
                <div id="Battery_Capacity" class="col-sm-4 mb-3">
                    <label for="" class="form-label">Capacité (Ah)</label>
                    <input type="number"
                           step="0.1"
                           min="0"
                           max="1000"
                           class="form-control"
                           name="battery_capacity"
                           :value="batteryCapacity">
                </div>
            </div>
        </section>
        <section>
            <h3>Tests</h3>
            <div>
                <div class="fields-group row">
                    <h4>Etat visuel</h4>
                    <div id="Battery_Look" class="col-lg-4 mb-3">
                        <label for="battery_look" class="form-label">Etat visuel de la batterie</label>
                        <select name="battery_look" id="battery_look" class="form-control" :class="batteryLookSelectorClass" @change="handleChangeBatteryLook">
                            <option disabled :selected="batteryLook === null">Sélectionner</option>
                            <option value="good" :selected="batteryLook === 'good'">Bon</option>
                            <option value="bad" :selected="!batteryLook === 'bad'">Mauvais</option>
                        </select>
                    </div>
                    <div id="Battery_Issue" class="col-lg-8 mb-3">
                        <label for="" class="form-label">Défaut</label>
                        <input type="text"
                               class="form-control"
                               name="battery_issue"
                               :value="batteryIssue">
                    </div>
                </div>
            </div>
            <div>
                <div class="fields-group row">
                    <h4>Charge</h4>
                    <div id="Battery_Charge" class="col-6 col-lg-4 mb-3">
                        <label for="battery_charge" class="form-label">Charge</label>
                        <select name="battery_charge" id="battery_charge" class="form-control" @change="handleChangeBatteryCharge">
                            <option disabled :selected="batteryCharge === null">Sélectionner</option>
                            <option value="1" :selected="batteryCharge === true">La charge se lance normalement</option>
                            <option value="0" :selected="batteryCharge === false">La charge ne se lance pas normalement</option>
                        </select>
                    </div>
                    <div id="Battery_Current_Voltage" class="col-6 col-lg-4 mb-3">
                        <label for="" class="form-label">Tension aux bornes (V)</label>
                        <input type="number"
                               step="0.1"
                               min="0"
                               max="1000"
                               class="form-control"
                               :class="currentVoltageClass"
                               name="battery_current_voltage"
                               v-model="batteryCurrentVoltage">
                    </div>
                </div>
            </div>
            <div>
                <div class="fields-group row">
                    <h4>Test de capacité au banc de charge</h4>
                    <div class="col-6 col-lg-4 mb-3">
                        <label for="" class="form-label">Energie totale (Ah)</label>
                        <input type="number"
                               class="form-control"
                               min="0" max="1000"
                               step="0.1"
                               name="battery_energy"
                               :value="batteryEnergy">
                    </div>
                    <div class="col-6 col-lg-4 mb-3">
                        <label for="" class="form-label">&nbsp;</label>
                        <input type="text" disabled class="form-control" value="Afficher résultat ici">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <h3>Diagnostic</h3>
            <div>
                <div class="fields-group row">
                    <h4>Diagnostic via le BMS</h4>
                    <div class="col-lg-4 mb-3">
                        <label for="" class="form-label">Nombre de cycles de charge</label>
                        <input type="number"
                               class="form-control"
                               :class="batteryCyclesClass"
                               min="0" max="10000"
                               name="battery_cycles"
                               v-model="batteryCycles">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="battery_cells_state" class="form-label">Etat des cellules</label>
                        <select name="battery_cells_state"
                                id="battery_cells_state"
                                class="form-control"
                                :class="batteryCellsStateClass" @change="handleChangeBatteryCellsState">
                            <option value="" selected disabled>Sélectionner</option>
                            <option v-for="state in batteryStatesList" :key="state.id" :value="state.id" :selected="state.id === batteryCellsState">{{ state.label }}</option>

                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="" class="form-label">Capacité (Ah)</label>
                        <input type="number"
                               class="form-control"
                               name="battery_current_capacity"
                               :value="batteryCurrentCapacity">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="" class="form-label">Température</label>
                        <select class="form-control"
                                name="battery_temperature"
                                id="battery_temperature"
                                :class="batteryTemperatureClass" @change="handleChangeBatteryTemperature">
                            <option disabled :selected="batteryTemperature == null">Sélectionner</option>
                            <option v-for="temp in batteryTempsList" :key="temp" :value="temp.id" :selected="temp.id === batteryTemperature">{{ temp.label }}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="" class="form-label">Résistance interne (mΩ)</label>
                        <input type="number"
                               min="0" max="10000"
                               step="0.1"
                               class="form-control"
                               name="battery_internal_resistance"
                               :value="batteryInternalResistance">
                    </div>
                </div>
            </div>
            <div>
                <div class="fields-group row">
                    <div class="col-lg-8">
                        <label for="diagnostic" class="form-label">Conclusion du diagnostic</label>
                        <textarea name="diagnostic" id="diagnostic" cols="30" rows="3" class="form-control" v-html="diagnostic"></textarea>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section>
        <h2>3. Composants remplacés</h2>
        <div class="fields-group">
            <div class="Spares_List_Wrapper mb-3">
                <ul class="Spares_List">
                    <li
                        class="Spare_Item"
                        v-for="item in items"
                        :key="item.reference">
                        <div>x {{ item.quantity }}</div>
                        <div><span class="fw-semibold">{{ item.reference }}</span></div>
                        <div>{{ item.designation }}</div>
                        <div>{{ getSupportStatus(item) }}</div>
                        <div><a @click.prevent="removeItem(item.reference)" class="Button_Remove">Supprimer</a></div>
                    </li>
                </ul>
                <div v-if="items.length === 0">La liste est vide.</div>
            </div>
            <div class="Spares_Form">
                <h5>Ajouter une référence composant</h5>
                <div class="row">
                    <div class="col-2 col-lg-1 mb-2">
                        <label class="form-label mb-1">Quantité</label>
                        <input type="number" class="form-control" v-model="newItemQuantity">
                    </div>
                    <div class="col-10 col-lg-3 mb-2">
                        <label class="form-label mb-1">Référence</label>
                        <input type="text" class="form-control" v-model="newItemReference">
                    </div>
                    <div class="col-lg-4 mb-2">
                        <label class="form-label mb-1">Désignation</label>
                        <input type="text" class="form-control" v-model="newItemDesignation">
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label class="form-label mb-1">Prise en charge</label>
                        <div>
                            <input type="radio" class="btn-check" name="options-base" id="option5" autocomplete="off"
                                   checked>
                            <label class="btn" for="option5">Oui</label>
                            <input type="radio" class="btn-check" name="options-base" id="option6" autocomplete="off">
                            <label class="btn" for="option6">Non</label>
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label mb-1">&nbsp;</label>
                        <div class="d-grid">
                            <button
                                class="btn btn-primary"
                                :disabled="!canAddItem" @click.prevent="addItem">Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <button class="btn btn-primary">Update</button>
</template>

<script setup>

import YesNoSelector from "./YesNoSelector.vue";
import {onMounted, computed, ref} from "vue";

const props = defineProps(['identifier'])

const identifier = ref(null)
const batteryKey = ref(null)
const antitheftKey = ref(null)
const charger = ref(null)
const battery = ref(null)
const pedals = ref(null)
const frontWheel = ref(null)
const rearWheel = ref(null)
const saddle = ref(null)
const seatpost = ref(null)
const display = ref(null)
const motor = ref(null)
const presenceComment = ref('')

const stripes = ref(null)
const corrosion = ref(null)
const clay = ref(null)
const sand = ref(null)
const impacts = ref(null)
const cracks = ref(null)
const breakages = ref(null)
const customizations = ref(null)
const checkComment = ref('')

const issueComment = ref('')

const voltagesList = [
    {id: 24, label: '24V'},
    {id: 36, label: '36V'},
    {id: 48, label: '48V'},
]

const batteryTypesList = [
    {id: 1, label: 'Li-Ion'},
    {id: 2, label: 'LiFePO4'},
    {id: 3, label: 'NiMH'},
    {id: 4, label: 'SLA'},
]

const batteryIssuesList = [
    {id: 1, label: 'Gonflement'},
    {id: 1, label: 'Fissures'},
    {id: 1, label: 'Fuite'},
    {id: 1, label: 'Oxydation'},
    {id: 1, label: 'Brûlure'},
]

const batteryStatesList = [
    {id: 'stable', label: 'Equilibre : <0,2V / cellule'},
    {id: 'unstable', label: 'Déséquilibre : <0,2V / cellule'}
]

const batteryTempsList = [
    {id: 'low', label: 'Faible : < 0°C'},
    {id: 'normal', label: 'Normale : entre 0°C et 45°C'},
    {id: 'high', label: 'Elevée : > 45°C'},
]

const batteryReference = ref(null)
const batterySerial = ref(null)
const batteryType = ref(null)
const batteryVoltage = ref(null)
const batteryCapacity = ref(null)
const batteryLook = ref(null)
const batteryCharge = ref(null)
const batteryIssue = ref(null)
const batteryCurrentVoltage = ref(null)

const batteryEnergy = ref(null)

const batteryCycles = ref(null)
const batteryCellsState = ref(null)
const batteryCurrentCapacity = ref(null)
const batteryTemperature = ref(null)
const batteryInternalResistance = ref(null)

const diagnostic = ref(null)

const newItemReference = ref('')
const newItemDesignation = ref('')
const newItemQuantity = ref(1)
const items = ref([])

const batteryLookSelectorClass = computed(() => {
    return batteryLook.value === 'good' ? 'form-control--success' : batteryLook.value === 'bad' ? 'form-control--danger' : '-';
})

const currentVoltageClass = computed(() => {
    return batteryCurrentVoltage.value < batteryVoltage.value ?  'form-control--danger' : 'form-control--success';
})

const batteryCyclesClass = computed(() => {
    if (batteryCycles.value != null && batteryCycles.value <= 500) {
        return 'form-control--success';
    } else if (batteryCycles.value != null && batteryCycles.value > 500) {
        return 'form-control--danger';
    } else {
        return '';
    }
})

const batteryCellsStateClass = computed(() => {
    if (batteryCellsState.value === 'stable') {
        return 'form-control--success';
    } else if (batteryCellsState.value === 'unstable') {
        return 'form-control--danger';
    } else {
        return '';
    }
})

const batteryTemperatureClass = computed(() => {
    if (batteryTemperature.value === 'normal') {
        return 'form-control--success';
    } else if (batteryCellsState.value === 'low' || batteryTemperature.value === 'high') {
        return 'form-control--danger';
    } else {
        return '';
    }
})

const handleChangeBatteryLook = (e) => {
    batteryLook.value = e.target.value
}

const handleChangeBatteryCharge = (e) => {

}

const handleChangeBatteryCellsState = (e) => {
    batteryCellsState.value = e.target.value
}

const handleChangeBatteryTemperature = (e) => {
    batteryTemperature.value = e.target.value
}
const addItem = () => {
    let newItem = {
        reference: newItemReference.value,
        designation: newItemDesignation.value,
        quantity: newItemQuantity.value
    }
    items.value.push(newItem)
    newItemDesignation.value = ''
    newItemReference.value = ''
    newItemQuantity.value = 1
}

const canAddItem = computed(() => {
    return newItemQuantity.value >= 1
        && newItemReference.value.length >= 3
        && newItemDesignation.value.length >= 2
})
const removeItem = (reference) => {
    let index = items.value.findIndex(item => item.reference === reference)
    items.value.splice(index, 1)
}

const getSupportStatus = (item) => {
    if (item.support) {
        return "Pris en charge"
    }
    return "Non pris en charge"
}

const fetchProductReport = async () => {
    const req = await fetch(`/api/v1/reports/${identifier.value}`)
    const response = await req.json()
    batteryKey.value = response.data.batteryKey;
    antitheftKey.value = response.data.antitheftKey;
    charger.value = response.data.charger;
    battery.value = response.data.battery;
    pedals.value = response.data.pedals;
    frontWheel.value = response.data.frontWheel;
    rearWheel.value = response.data.rearWheel;
    saddle.value = response.data.saddle;
    seatpost.value = response.data.seatpost;
    display.value = response.data.display;
    motor.value = response.data.motor;
    presenceComment.value = response.data.presenceComment;

    stripes.value = response.data.stripes;
    corrosion.value = response.data.corrosion;
    clay.value = response.data.clay;
    sand.value = response.data.sand;
    impacts.value = response.data.impacts;
    cracks.value = response.data.cracks;
    breakages.value = response.data.breakages;
    customizations.value = response.data.customizations;
    checkComment.value = response.data.checkComment;

    issueComment.value = response.data.issueComment;

    batteryReference.value = response.data.batteryReference;
    batterySerial.value = response.data.batterySerial;
    batteryType.value = response.data.batteryType;
    batteryVoltage.value = response.data.batteryVoltage;
    batteryCapacity.value = response.data.batteryCapacity;
    batteryLook.value = response.data.batteryLook;
    batteryCharge.value = response.data.batteryCharge;
    batteryIssue.value = response.data.batteryIssue;
    batteryCurrentVoltage.value = response.data.batteryCurrentVoltage;

    batteryEnergy.value = response.data.batteryEnergy;

    batteryCycles.value = response.data.batteryCycles;
    batteryCellsState.value = response.data.batteryCellsState;
    batteryCurrentCapacity.value = response.data.batteryCurrentCapacity;
    batteryTemperature.value = response.data.batteryTemperature;
    batteryInternalResistance.value = response.data.batteryInternalResistance;

    diagnostic.value = response.data.diagnostic;
}

onMounted(() => {
    if (document.querySelector("#product-report-form").dataset.identifier !== undefined) {
        identifier.value = document.querySelector("#product-report-form").dataset.identifier
        fetchProductReport()
    }
})
</script>


<style lang="scss" scoped>
.Spares_List_Wrapper {
    .Spares_List {
        .Spare_Item {
            background-color: white;
            margin-bottom: 2px;
            padding: 0.35rem 1rem;

            &:nth-child(2n+1) {
                background-color: oklch(96.7% 0.003 264.542);
            }

            display: grid;
            grid-template-columns: 4rem auto auto 12rem 6rem;

            .Button_Remove {
                text-decoration: none;
                color: oklch(58.6% 0.253 17.585);
                cursor: pointer;
            }
        }
    }
}

.Spares_Form {
    background-color: oklch(94.3% 0.029 294.588);
    color: oklch(38% 0.189 293.745);
    padding: 1rem 1.5rem;

    .form-control {
        background-color: white;
    }
}
</style>
