import type { Settings } from '@shared/types'
import { computed } from 'vue'
import { useStore } from 'vuex'

export default () => {
    const store = useStore()
    const settings = computed<Settings | null>(() => store.getters['settings/settings'])

    const playSound = (fileName: string): void => {
        if (!settings.value || !settings.value.albumSound) {
            return
        }

        const sound = new Audio(`${pager.rootUrl}/assets/sounds/${fileName}.mp3`)
        sound.volume = 0.5
        sound.play()
    }

    return {
        playSound,
    }
}