<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { computed } from 'vue'
import { useStore } from 'vuex'
import useFileDownloader from '@album/composables/useFileDownloader'
import showToast from '@shared/modules/showToast'
import DownloadIcon from '@shared/components/Icons/DownloadIcon.vue'
import FooterButton from '@album/components/Footer/FooterButton.vue'

const store = useStore()
const { downloadFile } = useFileDownloader()

document.body.addEventListener('keydown', e => {
    if (e.key === 'd') {
        downloadImageHandler()
    }
})

const currFile = computed<ImageFile | null>(() => {
    const files = store.getters['files/files'] as ImageFile[]
    const file = files.find(f => f.visible)
    return file || null
})

async function downloadImageHandler(): Promise<void> {
    if (!currFile.value) {
        return
    }

    const success = await downloadFile(currFile.value.url)
    const text = success ? 'Image downloaded' : 'Error downloading image'

    showToast({ text, success })
}
</script>

<template>
    <FooterButton
        tip="Download current image (d)"
        :icon="DownloadIcon"
        @clicked="downloadImageHandler"
    />
</template>