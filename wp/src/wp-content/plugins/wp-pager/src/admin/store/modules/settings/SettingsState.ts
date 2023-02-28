import type { Settings } from '@shared/types'

type SettingsState = {
    settings: Settings | null
    loading: boolean
}

export default SettingsState