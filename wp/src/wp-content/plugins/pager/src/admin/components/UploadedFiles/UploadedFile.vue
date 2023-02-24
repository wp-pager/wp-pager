<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import FileControls from '@admin/components/UploadedFiles/FileControls.vue'

type Props = {
    file: ImageFile
}

const props = defineProps<Props>()
</script>

<template>
    <div data-v-1s0gr6mjaq>
        <article>
            <img
                :src="props.file.url"
            />

            <FileControls :file="props.file" />
        </article>
    </div>
</template>

<style lang="sass" scoped>
[data-v-1s0gr6mjaq]
    article
        background-color: white
        border-radius: 0.5rem
        box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1)
        position: relative
        padding: 7px
        line-height: 0

        img
            width: 100%
            border-radius: 5px
</style>
