<template>
    <section
        class="bg-violet-50 p-8 rounded-xl mb-5"
        id="Comments">
        <div class="Section_Head">
            <h2 class="font-bold text-xl mb-2">Commentaires</h2>
            <div><SectionStatusBadge :completed="store.commentsSectionCompleted"/></div>
        </div>
        <div class="grid grid-cols-2 gap-x-6 gap-y-4">
            <div>
                <label for="info" class="font-semibold mb-1">Informations sur le retour (affiché sur le bon de retour)</label>
                <textarea class="form-control" v-model="store.info" rows="5" v-html="store.info" name="info"></textarea>
            </div>
            <div>
                <label for="note" class="font-semibold mb-1">Note interne au technicien (privé)</label>
                <textarea class="form-control" v-model="store.note" rows="5" v-html="store.note"
                          style="background-color: oklch(98.7% 0.026 102.212); color: oklch(27.9% 0.077 45.635);"
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
