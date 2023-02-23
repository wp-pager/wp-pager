<script setup lang="ts">
import type { ImageFile, ServerResponse } from '@shared/types'
import { ref, onMounted } from 'vue'
import axios from 'axios'
import UploadedFile from '@admin/components/UploadedFiles/UploadedFile.vue'
import Spinner from '@shared/components/Spinner.vue'

const files = ref<ImageFile[]>([])
const loading = ref<boolean>(false)

onMounted(() => fetchFiles())

function fetchFiles() {
    loading.value = true

    axios.get<ServerResponse<ImageFile[]>>(`${window.pager.ajaxUrl}?action=pager_get_files`)
        .then(resp => files.value = resp.data.data)
        .catch(err => console.error(err))
        .finally(() => loading.value = false)
}
</script>

<template>
    <div>
        <h2 class="title">Uploaded Files</h2>
        <p class="intro">These are the files that have been uploaded to the server.</p>

        <Spinner v-if="loading" />

        <h3 v-else-if="files.length === 0" class="no-files">
            There are no files yet...
        </h3>

        <section v-else>
            <UploadedFile
                v-for="f in files"
                :key="f.id"
                :file="f"
            />
        </section>
    </div>
</template>

<style lang="sass" scoped>
section
    display: grid
    grid-template-columns: 1fr 1fr
    grid-gap: 8px

.title
    margin-top: 0
    font-size: 1.7rem

.intro
    font-size: 1.2rem

.no-files
    font-size: 1.2rem
    font-weight: 400
</style>