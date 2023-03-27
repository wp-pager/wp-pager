import Uploader from '@admin/components/Uploader/Uploader.vue'
import UploadedFiles from '@admin/components/UploadedFiles/UploadedFiles.vue'
import Settings from '@admin/components/Settings/Settings.vue'
import { AdminTab } from '@shared/types'

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
]

export default tabs