import { createStore } from 'vuex'
import files from '@admin/store/modules/files'

export default createStore({
    modules: {
        files,
    }
})
