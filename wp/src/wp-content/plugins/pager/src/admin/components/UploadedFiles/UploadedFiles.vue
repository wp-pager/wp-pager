<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { ref } from 'vue'
import UploadedFile from '@admin/components/UploadedFiles/UploadedFile.vue'

const files = ref<ImageFile[]>(window.pager.files)
</script>

<template>
    <div>
        <section>
            <uploaded-file
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
    grid-gap: 8px
</style>