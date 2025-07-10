import type { ImageFile } from '@shared/types'

type FilesState = {
    files: ImageFile[]
    loading: boolean
    currPageNum: number
    prevPageNum: number
}

export default FilesState