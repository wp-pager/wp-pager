export type ServerResponse<T> = {
    success: boolean
    message: string | null
    data: T
}

export type AdminTab = {
    index: number
    slug: 'files' | 'uploader' | 'settings' | 'info'
    title: string
    component: object
}

export type ImageFile = {
    page: number
    path: string
    url: string
    name: string
    title: string | null
    visible: boolean
}

export type Config = {
    ajaxUrl: string
    nonce: string
    rootUrl: string
}

export type Settings = {
    albumMaxWidth: number
    files: ImageFile[]
}

export type Setting = {
    [key in keyof Settings]: Settings[key]
}

export type SwipeDirection = 'left' | 'right'

export type ShowToastParams = {
    text: string
    success?: boolean
    url?: string
    duration?: number
}

export type GiveImageNameParams = {
    title: string
    page: number
}