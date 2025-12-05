<template>
    <section class="mb-8">
        <div class="Section_Head">
            <h2 class="text-4xl font-bold mb-3">Contrôles</h2>
            <div>
            </div>
        </div>
        <PresenceChecksSubSection v-if="store.type === 'bike'"/>
        <LookChecksSubSection v-if="store.type === 'bike'"/>
        <OtherInfoSubSection v-if="store.type === 'bike'" />
        <ChecksDiagnosticSection v-if="store.type === 'component'"/>
    </section>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../../stores/productReport";

const store = useProductReportStore()
import PresenceChecksSubSection from "./PresenceChecksSubSection.vue";
import LookChecksSubSection from "./LookChecksSubSection.vue";
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";
import OtherInfoSubSection from "./OtherInfoSubSection.vue";
import ChecksDiagnosticSection from "./ChecksDiagnosticSection.vue";
</script>
