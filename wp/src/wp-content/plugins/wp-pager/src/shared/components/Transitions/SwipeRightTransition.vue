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

    &-enter-from
        transform: translateX(-100%)

    &-leave-to
        position: absolute
        top: 0
        right: -100%

    &-leave-from
        position: absolute
        top: 0
        right: 0
</style>