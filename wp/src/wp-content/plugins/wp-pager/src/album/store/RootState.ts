import type FileState from '@album/store/modules/files/FilesState'
import type SwipeState from '@album/store/modules/swipe/SwipeState'
import type SettingState from '@album/store/modules/settings/SettingsState'
import type ZoomState from '@album/store/modules/zoom/ZoomState'

export default interface RootState {
    files: FileState
    swipe: SwipeState
    settings: SettingState
    zoom: ZoomState
}