<script setup lang="ts">
import { computed } from 'vue'
import { useStore } from 'vuex'
import ControlButton from '@admin/components/PendingFiles/ControlButton.vue'
import UploadIcon from '@shared/components/Icons/UploadIcon.vue'
import CloseIcon from '@shared/components/Icons/CloseIcon.vue'

const store = useStore()

const files = computed<File[]>(() => store.getters['pendingFiles/files'])

function uploadAll(): void {
    if (files.value.length === 0)
        return

    store.dispatch('files/uploadFiles', files.value)
}

function clearAll(): void {
    if (files.value.length === 0)
        return

    store.dispatch('pendingFiles/clearAll')
}
</script>

<template>
    <div data-v-1fs0uvn0qu>
        <ControlButton
            @click="uploadAll"
            class="upload btn"
            :isDisabled="files.length === 0"
        >
            <UploadIcon  class="icon" /> Upload all
        </ControlButton>

        <ControlButton
            @click="clearAll"
            class="clear btn"
            :isDisabled="files.length === 0"
        >
            <CloseIcon class="icon" /> Clear all
        </ControlButton>
    </div>
</template>

<style lang="sass" scoped>
[data-v-1fs0uvn0qu]
    section
        display: flex
        gap: .5rem

    .btn
        display: flex
        align-items: center
        gap: 7px

        .icon
            width: 1.3rem
            height: 1.3rem

    .upload
        color: #045b04

    .clear
        color: #950909
</style>