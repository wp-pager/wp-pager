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
const soundIsOn = computed<boolean>(() => store.getters['settings/soundIsOn'])

async function muteSound(): Promise<void> {
    playSound('switch')
    localStorage.setItem(storage.key.albumSoundIsOn, storage.value.off)
    await store.dispatch('settings/muteSound')
}

async function unmuteSound(): Promise<void> {
    console.log('unmuteSound')
    localStorage.setItem(storage.key.albumSoundIsOn, storage.value.on)
    await store.dispatch('settings/unmuteSound')
    playSound('switch')
}
</script>

<template>
    <div data-v-8eos3>
        <Tip :content="soundIsOn ? 'Mute the sound' : 'Unmute the sound'">
            <button v-if="soundIsOn" @click="muteSound" type="button">
                <SoundOnIcon class="pager-icon" />
            </button>
            <button v-else @click="unmuteSound" type="button">
                <SoundOffIcon class="pager-icon" />
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