<script setup lang="ts">
import PendingFile from '@admin/components/PendingFiles/PendingFile.vue'

type Props = {
    files: File[]
}

const props = defineProps<Props>()
</script>

<template>
    <div class="files">
        <PendingFile
            v-for="file in props.files"
            :key="file.name"
            :file="file"
        />
    </div>
</template>

<style lang="sass" scoped>
.files
    display: grid
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr))
    grid-gap: 1rem
</style>