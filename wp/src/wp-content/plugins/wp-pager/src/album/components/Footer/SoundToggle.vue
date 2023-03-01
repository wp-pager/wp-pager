<script setup lang="ts">
import type { Settings } from '@shared/types'
import { useStore } from 'vuex'
import { computed, ref } from 'vue'
import { storage } from '@shared/appConfig'
import useSound from '@album/composables/useSound'
import SoundOnIcon from '@shared/components/Icons/SoundOnIcon.vue'
import SoundOffIcon from '@shared/components/Icons/SoundOffIcon.vue'
import Tip from '@shared/components/Tip.vue'

const store = useStore()
const { playSound } = useSound()
const settings = computed<Settings | null>(() => store.getters['settings/settings'])

function toggleSound(): void {
    if (!settings.value)
        return

    playSound('switch')

    if (settings.value.albumSound) {
        localStorage.setItem(storage.key.albumSoundIsOn, storage.value.off)
        store.dispatch('settings/muteSound')
    } else {
        localStorage.setItem(storage.key.albumSoundIsOn, storage.value.on)
        store.dispatch('settings/unmuteSound')
    }
}
</script>

<template>
    <div v-if="settings" data-v-8eos3>
        <Tip :content="settings!.albumSound ? 'Mute the sound' : 'Unmute the sound'">
            <button @click="toggleSound" type="button">
                <SoundOnIcon v-if="settings!.albumSound" class="pager-icon" />
                <SoundOffIcon v-else class="pager-icon" />
            </button>
        </Tip>
    </div>
</template>

<style lang="sass" scoped>
[data-v-8eos3]
    display: flex
    align-items: center

    button
        width: 22px
        height: 22px
        background: none
        border: none
        padding: 0
        cursor: pointer
        outline: none
        transition: transform .1s ease-in-out, opacity .1s ease-in-out
        perspective: 1000px
        opacity: .7

        &:hover
            transform: scale(1.2)
            opacity: 1

        .pager-icon
            width: 100%
</style>