import type { ImageFile } from '@shared/types'

type FilesState = {
    files: ImageFile[]
    loading: boolean
    currentFileIndex: number
}

export default FilesState