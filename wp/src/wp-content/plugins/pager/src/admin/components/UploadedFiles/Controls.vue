<script setup lang="ts">
const eyeIcon = window.pager.rootUrl + '/assets/img/eye.webp'
const closeIcon = window.pager.rootUrl + '/assets/img/close.webp'
</script>

<template>
    <section>
        <button type="button">
            <img :src="eyeIcon" alt="o" />
        </button>

        <button type="button">
            <img :src="closeIcon" alt="x" />
        </button>
    </section>
</template>

<style lang="sass" scoped>
section
    opacity: 0
    display: flex
    align-items: center
    justify-content: center
    gap: 12px
    position: absolute
    top: 0
    left: 0
    right: 0
    bottom: 0
    background-color: rgba(255, 255, 255, 0.6)
    border-radius: 7px
    transition: opacity .2s ease-in-out

    &:hover
        opacity: 1

    button
        display: flex
        align-items: center
        justify-content: center
        background: none
        border: none
        padding: 7px
        border-radius: 8px
        border: 1px solid transparent
        cursor: pointer

        &:hover
            background-color: white
            border-color: #ccc

        img
            width: 35px
            height: 35px
</style>