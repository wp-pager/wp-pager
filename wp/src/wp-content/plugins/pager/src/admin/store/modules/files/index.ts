import type { Module } from 'vuex'
import type FilesState from './FilesState'
import type RootState from '@admin/store/RootState'

const files: Module<FilesState, RootState> = {
    namespaced: true,

    state: {
        files: [],
        pendingFiles: [],
    },

    mutations: {
        ADD_PENDING_FILES(state, files: File[]): void {
        },
    },

    actions: {
        addPendingFiles({ commit }, files: File[]): void {
            commit('ADD_PENDING_FILES', files)
        },
    },
}

export default files