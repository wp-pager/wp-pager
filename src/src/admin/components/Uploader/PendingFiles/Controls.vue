<script setup lang="ts">
import { computed } from 'vue'
import { useStore } from 'vuex'
import confirmModal from '@shared/modules/confirmModal'
import Btn from '@admin/components/Btn.vue'
import UploadIcon from '@shared/components/Icons/UploadIcon.vue'
import CloseIcon from '@shared/components/Icons/CloseIcon.vue'

const store = useStore()

const files = computed<File[]>(() => store.getters['pendingFiles/files'])

async function uploadAll(): Promise<void> {
    if (files.value.length === 0)
        return

    const answer = await confirmModal({
        text: 'Are you sure you want to upload all files?',
    })

    if (!answer.isConfirmed) {
        return
    }

    store.dispatch('files/addFiles', files.value)
    store.dispatch('pendingFiles/clearFiles')
}

function clearAll(): void {
    if (files.value.length === 0)
        return

    store.dispatch('pendingFiles/clearFiles')
}
</script>

<template>
    <div data-v-1fs0uvn0qu>
        <Btn
            @click="uploadAll"
            class="pager-btn"
            color="default"
            :isDisabled="files.length === 0"
        >
            <UploadIcon class="pager-icon" /> Upload all
        </Btn>

        <Btn
            @click="clearAll"
            class="pager-btn"
            color="red"
            :isDisabled="files.length === 0"
        >
            <CloseIcon class="pager-icon" /> Clear all
        </Btn>
    </div>
</template>

<style lang="sass" scoped>
[data-v-1fs0uvn0qu]
    display: flex
    gap: .5rem

    .pager-btn
        display: flex
        align-items: center
        gap: 7px

        .pager-icon
            width: 1.3rem
            height: 1.3rem
</style>