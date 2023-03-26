export type ServerResponse<T> = {
    success: boolean
    message: string | null
    data: T
}

export type AdminTab = {
    index: number
    slug: 'files' | 'uploader' | 'settings'
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
    albumSound: boolean
    albumMaxWidth: number
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