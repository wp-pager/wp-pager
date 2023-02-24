<script setup lang="ts">
import CloseIcon from '@shared/components/Icons/CloseIcon.vue'

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
        <CloseIcon class="icon" />
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

    .icon
        width: 40px
        height: 40px

    &:hover
        opacity: .8
</style>
