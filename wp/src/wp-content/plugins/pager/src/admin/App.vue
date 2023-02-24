<script setup lang="ts">
import { ref } from 'vue'
import Uploader from '@admin/components/Uploader/Uploader.vue'
import UploadedFiles from '@admin/components/UploadedFiles/UploadedFiles.vue'
import PendingFiles from '@admin/components/PendingFiles/PendingFiles.vue'
</script>

<template>
    <div data-v-lnqpslz79s>
        <h1>Pager settings</h1>

        <main>
            <div>
                <Uploader />
                <PendingFiles />
            </div>

            <UploadedFiles />
        </main>
    </div>
</template>

<style lang="sass" scoped>
[data-v-lnqpslz79s]
    h1
        font-size: 2rem
        font-weight: 400
        margin-bottom: 1rem

    main
        display: grid
        grid-template-columns: minmax(200px, 600px) 1fr
        gap: 1.7rem

@media screen and (max-width: 600px)
    [data-v-lnqpslz79s]
        main
            grid-template-columns: 1fr
</style>