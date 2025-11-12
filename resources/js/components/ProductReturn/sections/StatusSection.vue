<template>
    <section class="Section">
        <div class="row">
            <div class="col-lg-6" v-if="store.status !== 'received'">
                <label for="status" class="form-label mb-1">Statut</label>
                <select name="status" id="status" class="form-control" v-model="store.status">
                    <option value="" selected disabled>Sélectionner</option>
                    <option value="incomplete">En cours d'édition</option>
                    <option value="pending">En attente de réception</option>
                </select>
            </div>
            <div class="col-lg-6" v-else>
                <VAlert class="Alert Alert__Success">Réceptionné</VAlert>
                <input type="hidden" name="status" :value="store.status">
            </div>
        </div>
    </section>
</template>


<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn";
import VAlert from "../../form/VAlert.vue";

const store = useProductReturnStore()
</script>
