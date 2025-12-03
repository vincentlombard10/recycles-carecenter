<template>
    <section
        class="bg-violet-50 p-8 rounded-xl mb-5"
        id="Qualification">
        <div class="Section_Head">
            <h2 class="font-bold text-xl mb-2">Qualification</h2>
            <div><SectionStatusBadge :completed="store.qualificationSectionCompleted"/></div>
        </div>
        <div class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>

                <label for="type" class="form-label mb-1">Type de retour</label>
                <VSelect name="type"
                         :current-option="store.type"
                         :options="store.typesOptions"
                         @select="handleSelectType"/>
            </div>
            <div>
                <label for="context" class="form-label mb-1">Contexte</label>
                <VSelect name="context"
                         :current-option="store.context"
                         :options="store.contextsOptions"
                         @select="handleSelectContext"/>
            </div>
            <div>
                <label for="reason" class="form-label mb-1">Motif</label>
                <VSelect name="reason"
                         :current-option="store.reason"
                         :options="store.reasonsOptions"
                         @select="handleSelectReason"/>
            </div>
            <div>
                <label for="assignee" class="form-label mb-1">Assignation</label>
                <VSelect name="assignation"
                         :current-option="store.assignation"
                         :options="store.assignationsOptions"
                         @select="handleSelectAssignation"/>
            </div>
            <div>
                <label for="action" class="form-label mb-1">Action</label>
                <VSelect name="action"
                         :currentOption="store.action"
                         :options="store.actionsOptions"
                         @select="handleSelectAction"/>
            </div>
            <div>
                <label for="destination" class="form-label mb-1">Destination</label>
                <VSelect name="destination"
                         :currentOption="store.destination"
                         :options="store.destinationsOptions"
                         @select="handleSelectDestination"/>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn";
import VSelect from "../../form/VSelect.vue";
import SectionStatusBadge from "../../common/SectionStatusBadge.vue";

const store = useProductReturnStore()

const handleSelectType = (_type: string) => {
    store.setType(_type)
}

const handleSelectContext = (_context: string) => {
    store.setContext(_context)
}

const handleSelectReason = (_reason: string) => {
    store.setReason(_reason)
}

const handleSelectDestination = (_destination: string) => {
    store.setDestination(_destination)
}

const handleSelectAction = (_action: string) => {
    store.setAction(_action)
}

const handleSelectAssignation = (_assignation: string) => {
    store.setAssignation(_assignation)
}
</script>

<style lang="scss">
#mypopover {
    background-color: #ffffff;
    width: 80%;
    padding: 40px;
    border-radius: 0.5rem;
    border: 0;
    &::backdrop {
        background-color: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }
    .btn-close {
        color: white;
        background: none;
        border: none;
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
    }
}
</style>
