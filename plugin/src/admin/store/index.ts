import { createStore } from 'vuex'
import files from '@admin/store/modules/files'
import pendingFiles from '@admin/store/modules/pendingFiles'
import settings from '@admin/store/modules/settings'

export default createStore({
    modules: {
        files,
        pendingFiles,
        settings,
    }
})
