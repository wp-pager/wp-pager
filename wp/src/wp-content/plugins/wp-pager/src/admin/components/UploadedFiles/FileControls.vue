<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import DeleteIcon from '@shared/components/Icons/DeleteIcon.vue'
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
    <div data-v-mklq4p19ma>
        <a :href="props.file.url" target="_blank" type="button">
            <EyeIcon class="pager-icon" />
        </a>

        <button @click="deleteFile" type="button">
            <DeleteIcon class="pager-icon" />
        </button>
    </div>
</template>

<style lang="sass" scoped>
[data-v-mklq4p19ma]
    opacity: 0
    display: flex
    align-items: center
    justify-content: center
    gap: 9px
    position: absolute
    top: 0
    left: 0
    right: 0
    bottom: 0
    background-color: rgba(0, 0, 0, .2)
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
        border: 2px solid #555
        cursor: pointer
        background-color: white
        box-shadow: none
        color: #333

        &:hover
            border-color: green
            color: green

        .pager-icon
            width: 30px
            height: 30px
</style>