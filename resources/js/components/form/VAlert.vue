<template>
    <div class="Alert">
        <slot></slot>
    </div>
</template>

<style lang="scss" scoped>
.Alert {
    background-color: oklch(92.9% 0.013 255.508);
    color: oklch(27.9% 0.041 260.031);
    padding: 1.25rem 1.75rem;
    border-radius: 0.35rem;
}
</style>
