<template>
    <transition name="pager-appear">
        <slot />
    </transition>
</template>

<style lang="scss" scoped>
.pager-appear {
    &-enter-active,
    &-leave-active {
        transition: opacity 0.4s ease;
    }
    &-enter-from,
    &-leave-to {
        opacity: 0;
    }
    &-enter-to,
    &-leave-from {
        opacity: 1;
    }
}
</style>
