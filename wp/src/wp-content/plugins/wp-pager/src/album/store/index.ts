import { createStore } from 'vuex'
import files from '@album/store/modules/files'
import swipe from '@album/store/modules/swipe'

export default createStore({
    modules: {
        files,
        swipe,
    }
})
