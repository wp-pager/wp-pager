<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { onMounted, computed } from 'vue'
import UploadedFile from '@admin/components/UploadedFiles/UploadedFile.vue'
import FetchingFilesSpinner from '@admin/components/UploadedFiles/FetchingFilesSpinner.vue'
import { useStore } from 'vuex'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const loading = computed<boolean>(() => store.getters['files/loading'])

onMounted(() => store.dispatch('files/fetchFiles'))
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
    grid-template-columns: repeat(auto-fill, 300px)
    grid-gap: 1rem

.title
    margin-top: 0
    font-size: 1.7rem

.intro
    font-size: 1.2rem

.no-files
    font-size: 1.2rem
    font-weight: 400
</style>