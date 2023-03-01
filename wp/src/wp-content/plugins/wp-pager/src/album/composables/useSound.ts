import type { Settings } from '@shared/types'
import { computed } from 'vue'
import { useStore } from 'vuex'

export default () => {
    const store = useStore()
    const soundIsOn = computed<boolean>(() => store.getters['settings/soundIsOn'])

    const playSound = (fileName: string): void => {
        if (!soundIsOn.value)
            return

        const sound = new Audio(`${pager.rootUrl}/assets/sounds/${fileName}.mp3`)
        sound.volume = 0.5

        sound.play().catch(e => console.error(e))
    }

    return {
        playSound,
    }
}