<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import confirmModal from '@shared/modules/confirmModal'
import DeleteIcon from '@shared/components/Icons/DeleteIcon.vue'
import EyeIcon from '@shared/components/Icons/EyeIcon.vue'
import EditIcon from '@shared/components/Icons/EditIcon.vue'
import Tip from '@shared/components/Tip.vue'

type Props = {
    file: ImageFile
}

const props = defineProps<Props>()
const store = useStore()

async function deleteFile(): Promise<void> {
    const isConfirmed = await confirmModal({
        text: 'Are you sure you want to delete this file?',
    })

    if (isConfirmed) {
        store.dispatch('files/deleteFile', props.file.page)
    }
}
</script>

<template>
    <div data-v-mklq4p19ma>
        <Tip content="Preview the image">
            <a :href="props.file.url" target="_blank" type="button">
                <EyeIcon class="pager-icon" />
            </a>
        </Tip>

        <Tip content="Rename the image">
            <button @click="deleteFile" type="button">
                <EditIcon class="pager-icon" />
            </button>
        </Tip>

        <Tip content="Delete the image">
            <button @click="deleteFile" type="button">
                <DeleteIcon class="pager-icon" />
            </button>
        </Tip>
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