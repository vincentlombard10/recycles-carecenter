<template>
    <div>
        <div>{{ address.address1 }}</div>
        <div>{{ address.address2 }}</div>
        <div>{{ address.postcode }} {{ address.city }}</div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps(['address'])
</script>
