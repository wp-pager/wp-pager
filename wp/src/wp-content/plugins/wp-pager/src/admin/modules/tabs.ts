import Uploader from '@admin/components/Uploader/Uploader.vue'
import UploadedFiles from '@admin/components/UploadedFiles/UploadedFiles.vue'

const tabs = [
    {
        title: 'Uploaded files',
        component: UploadedFiles,
    },
    {
        title: 'Uploader',
        component: Uploader,
    },
]

export default tabs