import { ImageFile } from '@shared/types'

type FilesState = {
    files: ImageFile[]
    pendingFiles: File[]
}

export default FilesState