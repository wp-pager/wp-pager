<script setup lang="ts">
import RemovePending from '@admin/components/Uploader/PendingFiles/RemovePending.vue'
import ImageCard from '@admin/components/ImageCard.vue'

type Props = {
    file: File
}

const props = defineProps<Props>()
const url = URL.createObjectURL(props.file)
</script>

<template>
    <ImageCard :name="props.file.name" :url="url">
        <RemovePending :file="props.file" />
    </ImageCard>
</template>
