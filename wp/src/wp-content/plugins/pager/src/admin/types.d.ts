import type { ImageFile } from '@shared/types'

export { }

declare global {
    var pager: {
        ajaxUrl: string
        nonce: string
        files: ImageFile[]
        rootUrl: string
    }
}
