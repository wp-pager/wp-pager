<script setup lang="ts">
import { ref } from 'vue'
import Uploader from '@admin/components/Uploader/Uploader.vue'
import UploadedFiles from '@admin/components/UploadedFiles/UploadedFiles.vue'
import PendingFiles from '@admin/components/PendingFiles/PendingFiles.vue'
</script>

<template>
    <main data-v-lnqpslz79s>
        <div>
            <Uploader />
            <PendingFiles />
        </div>

        <UploadedFiles />
    </main>
</template>

<style lang="sass" scoped>
main[data-v-lnqpslz79s]
    display: grid
    grid-template-columns: minmax(200px, 600px) 1fr
    gap: 1.7rem

@media screen and (max-width: 600px)
    main[data-v-lnqpslz79s]
        grid-template-columns: 1fr
</style>