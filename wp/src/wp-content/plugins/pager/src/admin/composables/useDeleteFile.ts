import type { ImageFile } from '@shared/types'
import dispatchEvent from '@shared/modules/dispatchEvent'
import { events } from '@shared/appConfig'
import axios from 'axios'

export default (file: ImageFile) => {
    function deleteFile(): void {
        if (!confirm('Are you sure you want to delete this file?'))
            return

        const url = window.pager.ajaxUrl + '?action=pager_delete_file'

        const formData = new FormData()
        formData.set('id', file.id.toString())

        axios.post(url, formData)
            .then(() => dispatchEvent(events.fetchFiles))
            .catch(err => console.error(err))
    }

    return {
        deleteFile,
    }
}