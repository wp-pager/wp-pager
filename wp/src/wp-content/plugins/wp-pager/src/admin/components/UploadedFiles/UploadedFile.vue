<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import FileControls from '@admin/components/UploadedFiles/FileControls.vue'
import ImageCard from '@admin/components/ImageCard.vue'

type Props = {
    file: ImageFile
}

const props = defineProps<Props>()
</script>

<template>
    <div data-v-qlo935msqp9>
        <ImageCard
            :name="props.file.name"
            :url="props.file.url"
        >
            <template #top>
                <div v-if="props.file.title" class="image-title">
                    {{ props.file.title }}
                </div>
            </template>

            <FileControls :file="props.file" />
        </ImageCard>
    </div>
</template>

<style lang="sass" scoped>
[data-v-qlo935msqp9]
    cursor: move

    .image-title
        margin-bottom: 5px
        font-weight: bold
        text-align: center
        font-size: 1.1em
</style>