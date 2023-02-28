import Uploader from '@admin/components/Uploader/Uploader.vue'
import UploadedFiles from '@admin/components/UploadedFiles/UploadedFiles.vue'
import Settings from '@admin/components/Settings/Settings.vue'

export default [
    {
        title: 'Uploaded files',
        component: UploadedFiles,
    },
    {
        title: 'Uploader',
        component: Uploader,
    },
    {
        title: 'Settings',
        component: Settings,
    },
]