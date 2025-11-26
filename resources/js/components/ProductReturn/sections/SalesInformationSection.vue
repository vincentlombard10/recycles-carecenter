<template>
    <section class="Section" id="Sale_Information">
        <div class="Section_Head">
            <h2 class="font-bold mb-3">Informations de vente</h2>
            <div>
                <SectionStatusBadge :completed="store.salesInfoSectionCompleted"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-3">
                <label for="bike_sold_at" class="form-label mb-1">Date de vente au distributeur</label>
                <input type="date" class="form-control"
                       :class="{'form-control--success': store.bikeSoldAt !== ''}"
                       v-model="store.bikeSoldAt"
                       name="bike_sold_at">
            </div>
            <div class="col-lg-3 mb-3">
                <label for="" class="form-label mb-1">Commande</label>
                <input type="text" class="form-control"
                       :class="{'form-control--success': store.order !== ''}"
                       v-model="store.order"
                       name="order">
            </div>
            <div class="col-lg-3 mb-3">
                <label for="" class="form-label mb-1">Facture</label>
                <input type="text"
                       class="form-control"
                       :class="{'form-control--success': store.invoice !== ''}"
                       v-model="store.invoice"
                       name="invoice">
            </div>
            <div class="col-lg-3 mb-3">
                <label for="" class="form-label mb-1">Bon de livraison</label>
                <input type="text" class="form-control"
                       :class="{'form-control--success': store.delivery !== ''}"
                       v-model="store.delivery"
                       name="delivery">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-3">
                <label for="" class="form-label mb-1">Date de vente au consommateur</label>
                <input type="date" class="form-control"
                       :class="{'form-control--success': store.bikePurchasedAt !== ''}"
                       v-model="store.bikePurchasedAt"
                       name="bike_purchased_at">
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn.js";
import SectionStatusBadge from "../../common/SectionStatusBadge.vue";

const store = useProductReturnStore()
</script>
