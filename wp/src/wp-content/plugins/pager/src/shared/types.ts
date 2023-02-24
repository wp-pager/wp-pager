export type ServerResponse<T> = {
    success: boolean
    message: string | null
    data: T
}

export type ImageFile = {
    id: number
    path: string
    url: string
    name: string
}

export type Config = {
    ajaxUrl: string
    nonce: string
    rootUrl: string
}