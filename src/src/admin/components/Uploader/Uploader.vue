<script setup lang="ts">
import { ref } from 'vue'
import { useStore } from 'vuex'
import DropIcon from '@shared/components/Icons/DropIcon.vue'
import PendingFiles from '@admin/components/Uploader/PendingFiles/PendingFiles.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import PageIntro from '@admin/components/PageIntro.vue'

const drag = ref<boolean>(false)
const store = useStore()

function dropImage(e: DragEvent): void {
    if (!e.dataTransfer) {
        return
    }

    drag.value = false

    const imageFiles = Array.from(e.dataTransfer.files)

    store.dispatch('pendingFiles/addFiles', imageFiles)
}

function chooseImages(e: Event): void {
    const input = e.target as HTMLInputElement
    const files = input.files as FileList

    store.dispatch('pendingFiles/addFiles', Array.from(files))
}
</script>

<template>
    <div data-v-plsy94b>
        <PageTitle>⬆️ Upload new files</PageTitle>
        <PageIntro>
            Drop your files into the dropping area or click it to choose files from your device.
        </PageIntro>

        <input
            @change="chooseImages"
            type="file"
            class="pager-hidden-input"
            id="pager-file-input"
            multiple
        />

        <label
            for="pager-file-input"
            @dragover.prevent="drag = true"
            @dragleave.self="drag = false"
            @drop.self.prevent="dropImage"
            :class="{ 'pager-drag': drag }"
        >
            <h2>
                <DropIcon class="pager-icon" />

                <span v-if="drag">Release files...</span>
                <span v-else> Drop your files...</span>
            </h2>
        </label>
    </div>

    <PendingFiles />
</template>

<style lang="sass" scoped>
[data-v-plsy94b]
    .pager-hidden-input
        display: none
        visibility: hidden

    label
        border: 4px dashed rgba(0, 0, 0, .2)
        padding: 7px
        border-radius: 7px
        display: flex
        justify-content: center
        align-items: center
        height: 200px
        background-color: rgba(0, 0, 0, .02)
        cursor: pointer
        transition: background-color .2s ease-in-out

        &.pager-drag
            background-color: rgba(255, 255, 255, .7)
            border-color: rgba(0, 0, 0, .5)

        &:hover
            background-color: rgba(0, 0, 0, .04)
            border-color: rgba(0, 0, 0, .3)

        &:hover h2
            color: rgba(0, 0, 0, .7)

        h2
            font-size: 1.5rem
            font-weight: 500
            color: rgba(0, 0, 0, .5)
            pointer-events: none
            display: flex
            align-items: center

            .pager-icon
                width: 2rem
                height: 2rem
                margin-right: 0.8rem
</style>
