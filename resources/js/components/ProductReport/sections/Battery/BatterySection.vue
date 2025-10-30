<template>
    <section class="Section">
        <div class="Section_Head">
            <h2 class="mb-3">Diagnostic de la batterie</h2>
            <div>
                <SectionStatusBadge :completed="store.batterySectionCompleted"/>
            </div>
        </div>
        <BatteryIdentificationSubSection />
        <BatteryLookSubSection />
        <BatteryTestSubSection />
    </section>
</template>

<script setup lang="ts">
import {useProductReportStore} from "../../../../stores/productReport";
const store = useProductReportStore()

import BatteryIdentificationSubSection from "./BatteryIdentificationSubSection.vue";
import BatteryLookSubSection from "./BatteryLookSubSection.vue";
import BatteryTestSubSection from "./BatteryTestSubSection.vue";
import SectionStatusBadge from "../../../common/SectionStatusBadge.vue";
</script>
