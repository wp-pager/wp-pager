<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { ref } from 'vue'
import UploadedFile from '@admin/components/UploadedFiles/UploadedFile.vue'

const files = ref<ImageFile[]>([])
</script>

<template>
    <div>
        <uploaded-file
            v-for="file in files"
            :key="file.id"
            :file="file"
        />
    </div>
</template>
