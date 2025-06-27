import type { Settings } from '@shared/types'

type SettingsState = {
    settings: Settings | null
    loading: boolean
    selectedTab: number
}

export default SettingsState