<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import CloseIcon from '@shared/components/Icons/CloseIcon.vue'
import EyeIcon from '@shared/components/Icons/EyeIcon.vue'
import { useStore } from 'vuex'

type Props = {
    file: ImageFile
}

const props = defineProps<Props>()
const store = useStore()

function deleteFile(): void {
    store.dispatch('files/deleteFile', props.file.id)
}
</script>

<template>
    <section>
        <a :href="props.file.url" target="_blank" type="button">
            <EyeIcon class="icon" />
        </a>

        <button @click="deleteFile" type="button">
            <CloseIcon class="icon" />
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

    button, a
        display: flex
        align-items: center
        justify-content: center
        background: none
        border: none
        padding: 7px
        border-radius: 8px
        border: 1px solid transparent
        cursor: pointer

        &:active,
        &:hover
            background-color: white
            border-color: #ccc
            box-shadow: none

        .icon
            width: 35px
            height: 35px
            color: #333
</style>