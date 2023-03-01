import type { Settings } from '@shared/types'

type SettingsState = {
    settings: Settings | null
    soundIsOn: boolean | null
}

export default SettingsState