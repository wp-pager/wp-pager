<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import Controls from '@admin/components/UploadedFiles/Controls.vue'

type Props = {
    file: ImageFile
}

const props = defineProps<Props>()
</script>

<template>
    <article>
        <img
            :src="props.file.url"
        />

        <controls />
    </article>
</template>

<style lang="sass" scoped>
article
    background-color: #fff
    border-radius: 0.5rem
    box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1)
    padding: 3px
    position: relative

    img
        width: 100%
        border-radius: 5px
</style>
