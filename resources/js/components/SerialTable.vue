<template>
<div class="">
    <table class="table">
        <tbody>
        <tr>
            <th>Numéro de série</th>
            <td>{{ props.serial.code }}</td>
        </tr>
        <tr>
            <th>SKU</th>
            <td>{{ props.serial.sku }}</td>
        </tr>
        <tr v-if="props.serial.item">
            <th>Désignation</th>
            <td>{{ props.serial.item.itds }}</td>
        </tr>
        </tbody>
    </table>
</div>
</template>

<script setup>
const props = defineProps(['serial'])
</script>

<style lang="scss" scoped>
.box {
    background-color: oklch(0.967 0.003 264.542);
    border-radius: 0.25rem;
    padding: 2rem;
}
</style>
