<template>
    <transition name="pager-swipe-left">
        <slot />
    </transition>
</template>

<style lang="sass" scoped>
.pager-swipe-left
    &-enter-active,
    &-leave-active
        transition: all .4s ease-out

    &-enter-to
        position: absolute
        right: 0

    &-enter-from
        position: absolute
        right: -100%

    &-leave-to
        position: absolute
        left: -100%

    &-leave-from
        position: absolute
        left: 0
</style>