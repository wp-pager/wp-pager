<script setup lang="ts">
import useSound from '@album/composables/useSound'
import InfoIcon from '@shared/components/Icons/InfoIcon.vue'
import FooterButton from '@album/components/Footer/FooterButton.vue'
import dispatchEvent from '@shared/modules/dispatchEvent'
import { events } from '@shared/appConfig'

const { playSound } = useSound()

function showModal(): void {
    playSound('switch')
    dispatchEvent(events.showInfoModal)
}
</script>

<template>
    <FooterButton
        tip="Click to learn keyboard shortcuts"
        :icon="InfoIcon"
        @clicked="showModal"
    />
</template>