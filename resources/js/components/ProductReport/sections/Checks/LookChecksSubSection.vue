<template>
    <section class="bg-violet-50 p-8 rounded-xl mb-5">
        <div class="SubSection_Head">
            <h4 class="font-bold text-xl mb-2">Etat visuel</h4>
            <div>
                <SectionStatusBadge :completed="store.lookChecksSubsectionCompleted"/>
            </div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-4 mb-4">
            <div>
                <label for="stripes" class="form-label">Rayures</label>
                <select name="stripes" id="stripes"
                        class="form-control"
                        :class="`form-control--${store.stripes}`"
                        v-model="store.stripes"
                        @change="handleSelectStripesOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div>
                <label for="corrosion" class="form-label mb-1">Corrosion</label>
                <select name="corrosion" id="corrosion"
                        class="form-control"
                        :class="`form-control--${store.corrosion}`"
                        v-model="store.corrosion"
                        @change="handleSelectCorrosionOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div>
                <label for="clay" class="form-label mb-1">Terre</label>
                <select name="clay" id="clay"
                        class="form-control"
                        :class="`form-control--${store.clay}`"
                        v-model="store.clay"
                        @change="handleSelectClayOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div>
                <label for="sand" class="form-label mb-1">Sable</label>
                <select name="sand" id="sand"
                        class="form-control"
                        :class="`form-control--${store.sand}`"
                        v-model="store.sand"
                        @change="handleSelectSandOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div>
                <label for="impacts" class="form-label mb-1">Impacts</label>
                <select name="impacts" id="impacts"
                        class="form-control"
                        :class="`form-control--${store.impacts}`"
                        v-model="store.impacts"
                        @change="handleSelectImpactsOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div>
                <label for="cracks" class="form-label mb-1">Fissures</label>
                <select name="cracks" id="cracks"
                        class="form-control"
                        :class="`form-control--${store.cracks}`"
                        v-model="store.cracks"
                        @change="handleSelectCracksOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div>
                <label for="breakage" class="form-label mb-1">Casse</label>
                <select name="breakage" id="breakage"
                        class="form-control"
                        :class="`form-control--${store.breakage}`"
                        v-model="store.breakage"
                        @change="handleSelectBreakageOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
            <div>
                <label for="modification" class="form-label mb-1">Modifications</label>
                <select name="modification" id="modification"
                        class="form-control"
                        :class="`form-control--${store.modification}`"
                        v-model="store.modification"
                        @change="handleSelectModificationOption($event)">
                    <option :value="null" selected disabled>Sélectionner</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label for="look_comment" class="form-label mb-1">Commentaire</label>
                <input type="text"
                       class="form-control"
                       name="look_comment"
                       v-model="store.lookComment">
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { useProductReportStore } from "../../../../stores/productReport";
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";
const store = useProductReportStore()

const handleSelectStripesOption = (e) => {

}

const handleSelectCorrosionOption = (e) => {

}

const handleSelectClayOption = (e) => {

}

const handleSelectSandOption = (e) => {

}

const handleSelectImpactsOption = (e) => {

}

const handleSelectCracksOption = (e) => {

}

const handleSelectBreakageOption = (e) => {

}

const handleSelectModificationOption = (e) => {

}

</script>

<style lang="scss" scoped>
.form-control {
    &--yes {
        border-color: oklch(81% 0.117 11.638);
        background-color: oklch(89.2% 0.058 10.001);
        color: oklch(41% 0.159 10.272);
    }
    &--no {
        border-color: oklch(87.1% 0.15 154.449);
        background-color: oklch(92.5% 0.084 155.995);
        color: oklch(39.3% 0.095 152.535);
    }
}
</style>
