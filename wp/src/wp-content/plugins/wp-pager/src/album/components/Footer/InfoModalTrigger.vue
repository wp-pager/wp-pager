<script setup lang="ts">
import useSound from '@album/composables/useSound'
import { ref } from 'vue'
import useClickOutside from '@album/composables/useClickOutside'
import usePressEscape from '@album/composables/usePressEscape'
import InfoModal from '@album/components/InfoModal/InfoModal.vue'
import InfoIcon from '@shared/components/Icons/InfoIcon.vue'
import FooterButton from '@album/components/Footer/FooterButton.vue'
import AppearTransition from '@shared/components/Transitions/AppearTransition.vue'

const { playSound } = useSound()
const visible = ref<boolean>(false)
const modalEl = ref<HTMLElement | null>(null)

useClickOutside(modalEl, closeModal)
usePressEscape(closeModal)

function openModal(): void {
    visible.value = true
    playSound('popup')
}

function closeModal(): void {
    if (visible.value === false)
        return

    visible.value = false
    playSound('popup')
}
</script>

<template>
    <div ref="modalEl" :style="{ position: 'relative', display: 'flex' }">
        <FooterButton
            tip="Learn keyboard shortcuts"
            :icon="InfoIcon"
            @clicked="visible ? closeModal() : openModal()"
        />

        <AppearTransition>
            <InfoModal
                v-if="visible"
                @closed="closeModal"
            />
        </AppearTransition>
    </div>
</template>