<template>
    <transition name="pager-swipe-left">
        <slot />
    </transition>
</template>

<style lang="scss" scoped>
.pager-swipe-left {
    &-enter-active,
    &-leave-active {
        transition: all 0.3s ease-out;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
    }
    &-enter-to {
        transform: translateX(0);
        position: absolute;
        z-index: 1;
    }
    &-enter-from {
        transform: translateX(100%);
        position: absolute;
        z-index: 1;
    }
    &-leave-to {
        position: absolute;
        z-index: 0;
    }
    &-leave-from {
        position: absolute;
        transform: translateX(0);
        z-index: 0;
    }
}
</style>
