<template>
    <section class="SubSection">
        <div class="SubSection_Head">
            <h4>Présence des organes</h4>
            <div>
                <SectionStatusBadge :completed="store.presenceChecksSubsectionCompleted"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-3">
                <label for="battery_key" class="form-label mb-1">Clé de batterie</label>
                <select name="battery_key" id="battery_key"
                        class="form-control"
                        :class="`form-control--${store.batteryKey}`"
                        v-model="store.batteryKey"
                        @change="handleSelectBatteryKey($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="lock_key" class="form-label mb-1">Clé d'antivol</label>
                <select name="lock_key" id="lock_key"
                        class="form-control"
                        :class="`form-control--${store.lockKey}`"
                        v-model="store.lockKey"
                        @change="handleSelectLockKey($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="charger" class="form-label mb-1">Chargeur</label>
                {{ store.charger }}
                <select name="charger" id="charger"
                        class="form-control"
                        :class="`form-control--${store.charger}`"
                        v-model="store.charger"
                        @change="handleSelectCharger($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="battery" class="form-label mb-1">Batterie</label>
                <select name="battery" id="battery"
                        class="form-control"
                        :class="`form-control--${store.battery}`"
                        v-model="store.battery"
                        @change="handleSelectBattery($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="pedals" class="form-label mb-1">Pédales</label>
                <select name="pedals" id="pedals"
                        class="form-control"
                        :class="`form-control--${store.pedals}`"
                        v-model="store.pedals"
                        @change="handleSelectPedals($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="front_wheel" class="form-label mb-1">Roue avant</label>
                <select name="front_wheel" id="front_wheel"
                        class="form-control"
                        :class="`form-control--${store.frontWheel}`"
                        v-model="store.frontWheel"
                        @change="handleSelectFrontWheel($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="rear_wheel" class="form-label mb-1">Roue arrière</label>
                <select name="rear_wheel" id="rear_wheel"
                        class="form-control"
                        :class="`form-control--${store.rearWheel}`"
                        v-model="store.rearWheel"
                        @change="handleSelectRearWheel($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="saddle" class="form-label mb-1">Selle</label>
                <select name="saddle" id="saddle"
                        class="form-control"
                        :class="`form-control--${store.saddle}`"
                        v-model="store.saddle"
                        @change="handleSelectSaddle($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="seatpost" class="form-label mb-1">Tige de selle</label>
                <select name="seatpost" id="seatpost"
                        class="form-control"
                        v-model="store.seatpost"
                        :class="`form-control--${store.seatpost}`"
                        @change="handleSelectSeatpost($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="display" class="form-label mb-1">Display</label>
                <select name="display" id="display"
                        class="form-control"
                        :class="`form-control--${store.display}`"
                        v-model="store.display"
                        @change="handleSelectDisplay($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label for="motor" class="form-label mb-1">Moteur</label>
                <select name="motor" id="motor"
                        class="form-control"
                        :class="`form-control--${store.motor}`"
                        v-model="store.motor"
                        @change="handleSelectMotor($event)">
                    <option value="null" disabled>Non défini</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                    <option value="none">Non équipé</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label for="presence_comment" class="form-label mb-1">Commentaire</label>
                <input type="text"
                       class="form-control"
                       name="presence_comment"
                       v-model="store.presenceComment">
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { useProductReportStore } from "../../../../stores/productReport";
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";
const store = useProductReportStore()

const handleSelectBatteryKey = (e) => {
    store.batteryKey = e.target.value
}

const handleSelectLockKey = (e) => {
    store.lockKey = e.target.value
}

const handleSelectCharger = (e) => {
    store.charger = e.target.value
}

const handleSelectBattery = (e) => {
    store.battery = e.target.value
}

const handleSelectPedals = (e) => {
    store.pedals = e.target.value
}

const handleSelectFrontWheel = (e) => {
    store.frontWheel = e.target.value
}

const handleSelectRearWheel = (e) => {
    store.rearWheel = e.target.value
}

const handleSelectSaddle = (e) => {
    store.saddle = e.target.value
}

const handleSelectSeatpost = (e) => {
    store.seatpost = e.target.value
}

const handleSelectDisplay = (e) => {
    store.display = e.target.value
}

const handleSelectMotor = (e) => {
    store.motor = e.target.value
}
</script>

<style lang="scss" scoped>
.Section {
    background: white;
}
.form-control {
    &--yes {
        border-color: oklch(87.1% 0.15 154.449);
        background-color: oklch(92.5% 0.084 155.995);
        color: oklch(39.3% 0.095 152.535);
    }
    &--no {
        border-color: oklch(81% 0.117 11.638);
        background-color: oklch(89.2% 0.058 10.001);
        color: oklch(41% 0.159 10.272);
    }
    &--none {
        border-color: oklch(86.9% 0.005 56.366);
        background-color: oklch(92.3% 0.003 48.717);
        color: oklch(21.6% 0.006 56.043);
    }
}
</style>
