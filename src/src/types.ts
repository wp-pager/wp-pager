import type { Config } from '@shared/types'

export { }

declare module 'vue' {
    interface ComponentCustomProperties {
        $pager: Config
    }
}

declare global {
    const pager: Config
}
