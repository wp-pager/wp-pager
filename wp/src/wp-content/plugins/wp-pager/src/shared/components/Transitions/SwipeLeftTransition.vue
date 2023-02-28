<template>
    <transition name="pager-swipe-left">
        <slot />
    </transition>
</template>

<style lang="sass" scoped>
.pager-swipe-left
    &-enter-active,
    &-leave-active
        transition: all .3s ease-out

    &-enter-to
        transform: translateX(0)

    &-enter-from
        transform: translateX(100%)

    &-leave-to
        position: absolute
        top: 0
        left: -100%

    &-leave-from
        position: absolute
        left: 0
        top: 0
</style>