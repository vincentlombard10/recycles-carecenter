<template>
    <QualificationSection class="mb-5"/>
    <TicketSection class="mb-5"/>
    <ProductSection class="mb-5"/>
    <SalesInformationSection class="mb-5"/>
    <CommentsSection class="mb-5"/>
    <RoutingSection class="mb-5"/>
    <StatusSection />
</template>


<script setup lang="ts">
import {ref, computed, onMounted} from "vue"

import { useProductReturnStore} from "../../stores/productReturn";
import QualificationSection from "./sections/QualificationSection.vue";
import TicketSection from "./sections/TicketSection.vue";
import ProductSection from "./sections/ProductSection.vue";
import SalesInformationSection from "./sections/SalesInformationSection.vue";
import CommentsSection from "./sections/CommentsSection.vue";
import RoutingSection from "./sections/RoutingSection.vue";
import StatusSection from "./sections/StatusSection.vue";
import dayjs from "dayjs"
const store = useProductReturnStore()

const productReturn = ref()
const routingFromAddress = ref<string>(null)
const routingToAddress = ref<string>(null)
const returnAddress = ref<string>(null)


const handleSetRoutingFromAddress = (payload: string) => {
    routingFromAddress.value = payload
}

const handleSetRoutingToAddress = (payload: string) => {
    routingToAddress.value = payload
}

const handleSetReturnAddress = (payload: string) => {
    returnAddress.value = payload
}

onMounted(() => {
    if (document.querySelector("#product-return-form").getAttribute('data-return') !== null) {
        productReturn.value = JSON.parse(document.querySelector("#product-return-form").getAttribute('data-return'))
        store.status = productReturn.value.status
        console.log(productReturn.value)
        store.setType(productReturn.value.type)
        store.setContext(productReturn.value.context)
        store.setReason(productReturn.value.reason)
        store.setAssignation(productReturn.value.assignation)
        store.setAction(productReturn.value.action)
        store.setDestination(productReturn.value.destination)
        store.order = productReturn.value.order
        store.invoice = productReturn.value.invoice
        store.delivery = productReturn.value.delivery
        store.info = productReturn.value.info
        store.note = productReturn.value.note
        store.bikeSoldAt = dayjs(productReturn.value.bike_sold_at).format('YYYY-MM-DD')
        store.bikePurchasedAt = dayjs(productReturn.value.bike_purchased_at).format('YYYY-MM-DD')
        store.setTicket(productReturn.value.ticket_id ?? null)
        store.setItem(productReturn.value.item_itno ?? null)
        if (productReturn.value.serial_code) {
            store.setSerial(productReturn.value.serial_code, false)
        }
        store.itemQuantity = productReturn.value.quantity
        setRoutingFrom()
        setRoutingTo()
        setReturnTo()
    }
})

const setRoutingFrom = () => {
    if (productReturn.value.routing_from_code) {
        store.setRoutingFrom(productReturn.value.routing_from_code)
        store.routingFromAddress1 = productReturn.value.routing_from_address1
        store.routingFromAddress2 = productReturn.value.routing_from_address2
        store.routingFromPostcode = productReturn.value.routing_from_postcode
        store.routingFromCity = productReturn.value.routing_from_city
        store.routingFromEmail = productReturn.value.routing_from_email
        store.routingFromPhone = productReturn.value.routing_from_phone
        store.routingFromInfo = productReturn.value.routing_from_info
    }
}

const setRoutingTo = () => {
    if (productReturn.value.routing_to_code) {
        store.setRoutingTo(productReturn.value.routing_to_code)
        store.routingToAddress1 = productReturn.value.routing_to_address1
        store.routingToAddress2 = productReturn.value.routing_to_address2
        store.routingToPostcode = productReturn.value.routing_to_postcode
        store.routingToCity = productReturn.value.routing_to_city
    }
}

const setReturnTo = () => {
    if (productReturn.value.return_to_code) {
        store.setReturnTo(productReturn.value.return_to_code)
        store.returnToAddress1 = productReturn.value.return_to_address1
        store.returnToAddress2 = productReturn.value.return_to_address2
        store.returnToPostcode = productReturn.value.return_to_postcode
        store.returnToCity = productReturn.value.return_to_city
    }
}
</script>


<style lang="scss">
.Section {
    margin-bottom: 4rem;
    &_Head {
        display: flex;
        justify-content: space-between;
    }
}
.SubSection {
    background-color: white;
    padding: 2rem;
    &:first-of-type {
        border-radius: 0.5rem 0.5rem 0 0;
    }
    &:last-of-type {
        border-radius: 0 0 0.5rem 0.5rem;
    }
    &_Head {
        display: flex;
        justify-content: space-between;
    }
}
</style>
