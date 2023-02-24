export type ServerResponse<T> = {
    success: boolean
    data: T
}

export type ImageFile = {
    id: number
    path: string
    url: string
}

export type Config = {
    ajaxUrl: string
    nonce: string
    rootUrl: string
}