<template>
    <transition name="pager-swipe-right">
        <slot />
    </transition>
</template>

<style lang="sass" scoped>
.pager-swipe-right
    &-enter-active,
    &-leave-active
        transition: all .3s ease-out

    &-enter-to
        transform: translateX(0)
        position: relative
        z-index: 1

    &-enter-from
        transform: translateX(-100%)
        position: relative
        z-index: 1

    &-leave-to
        position: absolute
        top: 0
        z-index: 0

    &-leave-from
        position: absolute
        top: 0
        transform: translateX(0)
        z-index: 0
</style>
