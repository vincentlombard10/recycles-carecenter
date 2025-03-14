<template>
    <div class="">
        <table class="table">
            <tbody>
            <tr>
                <th>SKU</th>
                <td>{{ props.item.itno }}</td>
            </tr>
            <tr>
                <th>Désignation</th>
                <td>{{ props.item.itds }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
const props = defineProps(['item'])
</script>

<style lang="scss" scoped>
.box {
    background-color: oklch(0.967 0.003 264.542);
    border-radius: 0.25rem;
    padding: 2rem;
}
</style>
