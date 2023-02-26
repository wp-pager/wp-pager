import type { ImageFile } from '@shared/types'

type FilesState = {
    files: ImageFile[]
    loading: boolean
    currentPageNum: number
    pageTurnDirection: 'right' | 'left'
}

export default FilesState