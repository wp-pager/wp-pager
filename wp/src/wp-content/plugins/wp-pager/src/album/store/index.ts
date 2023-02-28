import { createStore } from 'vuex'
import files from '@album/store/modules/files'
import swipe from '@album/store/modules/swipe'
import settings from '@album/store/modules/settings'

export default createStore({
    modules: {
        files,
        swipe,
        settings,
    }
})
