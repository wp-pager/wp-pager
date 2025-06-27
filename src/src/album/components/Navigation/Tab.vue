<template>
    <span class="pager-number">
        <slot />
    </span>
</template>

<style lang="sass" scoped>
.pager-number
    color: #c5c5c5
    transition: all .1s ease-in-out
    user-select: none
    padding: 0 5px
</style>