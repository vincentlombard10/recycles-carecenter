<template>
    <div class="row">
        <div class="col-xl-6 mb-2">
            <div>{{ address.address1 }}</div>
            <div>{{ address.address2 }}</div>
            <div>{{ address.postcode }} {{ address.city }}</div>
        </div>
        <div class="col-xl-6 mb-2">
            <div v-if="address.phone"><i class="bi bi-telephone me-1"></i>{{ address.phone }}</div>
            <div v-if="address.email"><i class="bi bi-send me-1"></i>{{ address.email }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['address'])
</script>
