<script setup lang="ts">
import useSound from '@album/composables/useSound'
import { ref } from 'vue'
import InfoModal from '@album/components/InfoModal/InfoModal.vue'
import InfoIcon from '@shared/components/Icons/InfoIcon.vue'
import FooterButton from '@album/components/Footer/FooterButton.vue'
import useClickOutside from '@album/composables/useClickOutside'

const { playSound } = useSound()
const visible = ref<boolean>(false)
const modalEl = ref<HTMLElement | null>(null)

useClickOutside(modalEl, () => visible.value = false)

function toggleModalTo(state: boolean): void {
    visible.value = state
    playSound('switch')
}
</script>

<template>
    <div ref="modalEl" :style="{ position: 'relative', display: 'flex' }">
        <FooterButton
            tip="Learn keyboard shortcuts"
            :icon="InfoIcon"
            @clicked="toggleModalTo(!visible)"
        />

        <InfoModal
            v-if="visible"
            @closed="toggleModalTo(false)"
        />
    </div>
</template>