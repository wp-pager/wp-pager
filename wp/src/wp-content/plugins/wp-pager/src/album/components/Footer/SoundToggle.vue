<script setup lang="ts">
import type { Settings } from '@shared/types'
import { useStore } from 'vuex'
import { computed, ref } from 'vue'
import { storage } from '@shared/appConfig'
import useSound from '@album/composables/useSound'
import SoundOnIcon from '@shared/components/Icons/SoundOnIcon.vue'
import SoundOffIcon from '@shared/components/Icons/SoundOffIcon.vue'
import FooterButton from '@album/components/Footer/FooterButton.vue'

const store = useStore()
const { playSound } = useSound()
const soundIsOn = computed<boolean>(() => store.getters['settings/soundIsOn'])

document.body.addEventListener('keydown', e => {
    if (e.key === 'm') {
        soundIsOn.value ? muteSound() : unmuteSound()
    }
})

async function muteSound(): Promise<void> {
    playSound('switch')
    localStorage.setItem(storage.key.albumSoundIsOn, storage.value.off)
    await store.dispatch('settings/muteSound')
}

async function unmuteSound(): Promise<void> {
    localStorage.setItem(storage.key.albumSoundIsOn, storage.value.on)
    await store.dispatch('settings/unmuteSound')
    playSound('switch')
}
</script>

<template>
    <FooterButton
        v-if="soundIsOn"
        @clicked="muteSound"
        tip="Mute the sound (m)"
        :icon="SoundOnIcon"
    />

    <FooterButton
        v-else
        tip="Unmute the sound (m)"
        @clicked="unmuteSound"
        :icon="SoundOffIcon"
    />
</template>
