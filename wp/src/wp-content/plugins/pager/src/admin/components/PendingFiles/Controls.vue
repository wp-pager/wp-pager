<script setup lang="ts">
import { computed } from 'vue'
import { useStore } from 'vuex'
import Btn from '@admin/components/Btn.vue'
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
        <Btn
            @click="uploadAll"
            class="btn"
            color="default"
            :isDisabled="files.length === 0"
        >
            <UploadIcon class="icon" /> Upload all
        </Btn>

        <Btn
            @click="clearAll"
            class="btn"
            color="red"
            :isDisabled="files.length === 0"
        >
            <CloseIcon class="icon" /> Clear all
        </Btn>
    </div>
</template>

<style lang="sass" scoped>
[data-v-1fs0uvn0qu]
    display: flex
    gap: .5rem

    .btn
        display: flex
        align-items: center
        gap: 7px

        .icon
            width: 1.3rem
            height: 1.3rem
</style>