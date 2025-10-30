<template>
    <section class="Section" id="Comments">
        <div class="Section_Head">
            <h2>Commentaires</h2>
            <div><SectionStatusBadge :completed="store.commentsSectionCompleted"/></div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label for="info" class="form-label mb-1">Informations sur le retour</label>
                <textarea class="form-control" v-model="store.info" rows="5" v-html="store.info" name="info"></textarea>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="note" class="form-label mb-1">Note interne au technicien</label>
                <textarea class="form-control" v-model="store.note" rows="5" v-html="store.note"
                          name="note"></textarea>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {useProductReturnStore} from "../../../stores/productReturn.js";
import SectionStatusBadge from "../../common/SectionStatusBadge.vue";

const store = useProductReturnStore()
</script>
