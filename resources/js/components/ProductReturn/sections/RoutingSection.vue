<template>
    <section class="Section">
        <div class="Section_Head">
            <h2>Acheminement</h2>
            <div>
                <SectionStatusBadge :completed="store.routingSectionCompleted" />
            </div>
        </div>
        <RoutingFromSelector />
        <RoutingToSelector />
        <ReturnToSelector />
    </section>
</template>
<script setup lang="ts">
import RoutingFromSelector from "../components/RoutingFromSelector.vue";
import RoutingToSelector from "../components/RoutingToSelector.vue";
import ReturnToSelector from "../components/ReturnToSelector.vue";
import SectionStatusBadge from "../../common/SectionStatusBadge.vue";
import {useProductReturnStore} from "../../../stores/productReturn";
const store = useProductReturnStore()
</script>

<style lang="scss">
.Contacts_List {
    height: 120px;
    overflow: scroll;
    border-radius: 0.375rem;
    border: 1px solid lightgray;
    .Contact_Item {
        padding: 0.5rem 0.75rem;
        border-bottom: 1px solid black;
        cursor: pointer;
        &:hover {
            background: black;
            color: white;
        }
    }
}
.Address_Card {
    background: oklch(96.9% 0.016 293.756);
    border: 1Px solid oklch(89.4% 0.057 293.283);
    border-radius: 0.5rem;
    padding: 1.25rem 1.5rem;
    &--Actions {
        display: flex;
        gap: 1rem;
    }
}
</style>
