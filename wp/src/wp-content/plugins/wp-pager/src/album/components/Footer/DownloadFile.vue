<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { computed } from 'vue'
import { useStore } from 'vuex'
import useSound from '@album/composables/useSound'
import DownloadIcon from '@shared/components/Icons/DownloadIcon.vue'
import FooterButton from '@album/components/Footer/FooterButton.vue'

const store = useStore()
const { playSound } = useSound()

const currFile = computed<ImageFile | null>(() => {
    const files = store.getters['files/files'] as ImageFile[]
    const file = files.find(f => f.visible)
    return file || null
})

function downloadFile(): void {
    if (!currFile.value)
        return

    playSound('switch')

    const url = currFile.value.url
    const link = document.createElement('a')

    link.href = url
    link.download = url.split('/').pop() || 'file.jpg'

    document.body.appendChild(link)

    link.click()

    document.body.removeChild(link)
}
</script>

<template>
    <FooterButton
        tip="Download current image"
        :icon="DownloadIcon"
        @clicked="downloadFile"
    />
</template>