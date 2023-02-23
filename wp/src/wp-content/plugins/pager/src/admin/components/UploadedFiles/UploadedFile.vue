<script setup lang="ts">
import type { ImageFile } from '@shared/types'

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
    </article>
</template>

<style lang="sass" scoped>
article
    background-color: #fff
    border-radius: 0.5rem
    box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1)
    padding: 1rem
</style>
