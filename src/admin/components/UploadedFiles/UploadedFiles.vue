<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { computed } from 'vue'
import { useStore } from 'vuex'
import UploadedFile from '@admin/components/UploadedFiles/UploadedFile.vue'
import FetchingFilesSpinner from '@admin/components/UploadedFiles/FetchingFilesSpinner.vue'
import Controls from '@admin/components/UploadedFiles/Controls.vue'
import { VueDraggableNext } from 'vue-draggable-next'

const store = useStore()
const loading = computed<boolean>(() => store.getters['files/loading'])

const files = computed<ImageFile[]>({
    get: (): ImageFile[] => store.getters['files/files'],
    set: (val: ImageFile[]) => store.dispatch('files/setFiles', val),
})
</script>

<template>
    <div data-v-kosbj3f>
        <h2 class="pager-title">Uploaded Files</h2>

        <p class="pager-intro">
            These are the files that have been uploaded to the server. You can drag and drop them to change the order.
        </p>

        <Controls />

        <FetchingFilesSpinner v-if="loading" />

        <h3 v-else-if="files.length === 0" class="pager-no-files">
            There are no files yet...
        </h3>

        <div v-else>
            <VueDraggableNext
                class="pager-files list-group w-full"
                v-model="files"
            >
                <UploadedFile
                    v-for="file in files"
                    :key="file.page"
                    :file="file"
                />
            </VueDraggableNext>
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-kosbj3f]
    .pager-files
        display: grid
        grid-template-columns: repeat(auto-fill, 300px)
        grid-gap: 1rem

    .pager-no-files
        font-size: 1.2rem
        font-weight: 400
</style>