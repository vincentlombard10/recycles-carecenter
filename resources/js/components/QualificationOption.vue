<template>
    <div class="row">
        <div class="col-1 mb-2">
            <button class="btn btn-light">...</button>
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" :value="option?.name">
        </div>
        <div class="col-5 mb-2">
            <input type="text" class="form-control" :value="option?.marker">
        </div>
        <div class="col-1 mb-2">

            <button v-if="option" class="btn btn-dark">X</button>
            <button v-else class="btn btn-primary">+</button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Option } from "../types"
import {onMounted} from "vue";

const props = defineProps<{
    option?: Option
}>();

const addOption = () => {

}
</script>
