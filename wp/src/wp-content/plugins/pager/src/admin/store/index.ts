import { createStore } from 'vuex'
import files from '@admin/store/modules/files'
import pendingFiles from '@admin/store/modules/pendingFiles'

export default createStore({
    modules: {
        files,
        pendingFiles,
    }
})
