<template>
    <button type="button">
        <slot />
    </button>
</template>

<style lang="sass" scoped>
button
    padding: 0.6rem 1.3rem
    border: 1px solid #ccc
    border-radius: 5px
    background-color: #fff
    cursor: pointer
    transition: all 0.2s ease-in-out
    text-transform: uppercase
    font-weight: bold

    &:hover
        background-color: #f3f3f3
</style>