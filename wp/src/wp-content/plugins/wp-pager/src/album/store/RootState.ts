import type FileState from '@album/store/modules/files/FilesState'
import type SwipeState from '@album/store/modules/swipe/SwipeState'

export default interface RootState {
    files: FileState
    swipe: SwipeState
}