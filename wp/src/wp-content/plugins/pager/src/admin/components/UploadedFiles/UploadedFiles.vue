<script setup lang="ts">
import type { ImageFile, ServerResponse } from '@shared/types'
import { ref, onMounted } from 'vue'
import { events } from '@shared/appConfig'
import listenEvent from '@shared/modules/listenEvent'
import axios from 'axios'
import UploadedFile from '@admin/components/UploadedFiles/UploadedFile.vue'
import FetchingFilesSpinner from '@admin/components/UploadedFiles/FetchingFilesSpinner.vue'

const files = ref<ImageFile[]>([])
const loading = ref<boolean>(false)

onMounted(() => {
    fetchFiles()
    listenEvent(events.fetchFiles, fetchFiles)
})

function fetchFiles() {
    loading.value = true

    const url = `${window.pager.ajaxUrl}?action=pager_get_files`

    axios.get<ServerResponse<ImageFile[]>>(url)
        .then(resp => files.value = resp.data.data)
        .catch(err => console.error(err))
        .finally(() => loading.value = false)
}
</script>

<template>
    <div>
        <h2 class="title">Uploaded Files</h2>
        <p class="intro">These are the files that have been uploaded to the server.</p>

        <FetchingFilesSpinner v-if="loading" />

        <h3 v-else-if="files.length === 0" class="no-files">
            There are no files yet...
        </h3>

        <section v-else>
            <UploadedFile
                v-for="file in files"
                :key="file.id"
                :file="file"
            />
        </section>
    </div>
</template>

<style lang="sass" scoped>
section
    display: grid
    grid-template-columns: 1fr 1fr
    grid-gap: 10px

.title
    margin-top: 0
    font-size: 1.7rem

.intro
    font-size: 1.2rem

.no-files
    font-size: 1.2rem
    font-weight: 400
</style>