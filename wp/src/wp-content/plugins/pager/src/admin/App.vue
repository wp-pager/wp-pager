<script setup lang="ts">
import Uploader from '@admin/components/Uploader/Uploader.vue'
import UploadedFiles from '@admin/components/UploadedFiles/UploadedFiles.vue'
</script>

<template>
    <div class="wrap">
        <h1>Pager settings</h1>

        <main>
            <uploader />
            <uploaded-files />
        </main>
    </div>
</template>

<style lang="sass" scoped>
h1
    font-size: 2rem
    font-weight: 400
    margin-bottom: 1rem

main
    display: grid
    grid-template-columns: 1fr 1fr
    gap: 1rem

@media screen and (max-width: 600px)
    main
        grid-template-columns: 1fr
</style>

