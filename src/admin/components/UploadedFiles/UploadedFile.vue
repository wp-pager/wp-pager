<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { computed } from 'vue'
import FileControls from '@admin/components/UploadedFiles/FileControls.vue'
import ImageCard from '@admin/components/ImageCard.vue'

type Props = {
    file: ImageFile
}

const props = defineProps<Props>()
const versionedUrl = computed<string>(() => `${props.file.url}?v=${Date.now()}`)
</script>

<template>
    <div data-v-qlo935msqp9>
        <ImageCard :name="props.file.name" :url="versionedUrl">
            <template #top>
                <div v-if="props.file.title" class="image-title">
                    {{ props.file.title }}
                </div>
            </template>

            <FileControls :file="props.file" />
        </ImageCard>
    </div>
</template>

<style lang="scss" scoped>
[data-v-qlo935msqp9] {
    cursor: move;

    .image-title {
        margin-bottom: 5px;
        font-weight: bold;
        text-align: center;
        font-size: 1.1em;
    }
}
</style>
