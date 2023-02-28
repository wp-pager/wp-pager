import type FileState from '@album/store/modules/files/FilesState'
import type SwipeState from '@album/store/modules/swipe/SwipeState'
import type SettingState from '@album/store/modules/settings/SettingsState'

export default interface RootState {
    files: FileState
    swipe: SwipeState
    settings: SettingState
}