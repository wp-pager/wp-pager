<script setup lang="ts">
type Emits = {
    (e: 'remove'): void
}

const emit = defineEmits<Emits>()
</script>

<template>
    <button
        type="button"
        @click="emit('remove')"
    >
        <img
            :src="`${$pager.rootUrl}assets/img/icons/close.webp`"
            alt="Remove"
        />
    </button>
</template>

<style lang="sass" scoped>
button
    position: absolute
    top: 0
    right: 0
    left: 0
    width: 100%
    bottom: 0
    background-color: rgba(255, 255, 255, .9)
    padding: 0
    z-index: 1
    border: none
    cursor: pointer
    outline: none
    opacity: 0
    transition: opacity 100ms ease-in-out

    img
        width: 40px
        height: 40px

    &:hover
        opacity: .8
</style>
