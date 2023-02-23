import type { ImageFile } from '@shared/types'

export { }

declare global {
    var pager: {
        files: ImageFile[]
        rootUrl: string
    }
}
