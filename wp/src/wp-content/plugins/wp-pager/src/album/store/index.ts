import { createStore } from 'vuex'
import files from '@album/store/modules/files'

export default createStore({
    modules: {
        files,
    }
})
