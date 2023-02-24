import type { Module } from 'vuex'
import type PendingFilesState from './PendingFilesState'
import type RootState from '@admin/store/RootState'

const files: Module<PendingFilesState, RootState> = {
    namespaced: true,

    state: {
        files: [],
    },

    mutations: {
        ADD_FILES(state, files: File[]): void {
        },
    },

    actions: {
        addFiles({ commit }, files: File[]): void {
            commit('ADD_FILES', files)
        },
    },
}

export default files