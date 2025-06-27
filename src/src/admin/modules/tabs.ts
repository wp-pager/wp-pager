import { AdminTab } from '@shared/types'
import Uploader from '@admin/components/Uploader/Uploader.vue'
import UploadedFiles from '@admin/components/UploadedFiles/UploadedFiles.vue'
import Settings from '@admin/components/Settings/Settings.vue'
import Info from '@admin/components/Info/Info.vue'

const tabs: AdminTab[] = [
    {
        index: 0,
        slug: 'files',
        title: 'Uploaded files',
        component: UploadedFiles,
    },
    {
        index: 1,
        slug: 'uploader',
        title: 'Uploader',
        component: Uploader,
    },
    {
        index: 2,
        slug: 'settings',
        title: 'Settings',
        component: Settings,
    },
    {
        index: 3,
        slug: 'info',
        title: 'Info',
        component: Info,
    },
]

export default tabs