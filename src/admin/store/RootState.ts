import type FilesState from '@admin/store/modules/files/FilesState'
import type SettingsState from '@admin/store/modules/settings/SettingsState'

export default interface RootState {
    files: FilesState
    pendingFiles: File[]
    settings: SettingsState
}