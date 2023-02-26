<template>
    <button type="button">
        <slot />
    </button>
</template>

<style lang="sass" scoped>
button
    opacity: 0
    background: none
    border: none
    cursor: pointer
    position: absolute
    top: 50%
    margin-top: -25px
    background-color: white
    border: 1px solid #eaeaea
    border-radius: 50%
    width: 50px
    height: 50px
    display: flex
    align-items: center
    justify-content: center
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2)
    transition: background-color 200ms ease, opacity 200ms ease

    &:hover
        background-color: #f5f5f5

    &:nth-child(1)
        right: 10px

    &:nth-child(2)
        left: 10px
        transform: rotate(180deg)
</style>