<template>
    <li class="Contact_Item">
        <div><span class="fw-semibold">{{ contact.code }}</span></div>
        <div>{{ contact.name }}</div>
    </li>
</template>

<script setup lang="ts">
const props = defineProps(['contact'])
</script>
