import type { Module } from 'vuex'
import type PendingFilesState from './PendingFilesState'
import type RootState from '@admin/store/RootState'

const files: Module<PendingFilesState, RootState> = {
    namespaced: true,

    state: {
        files: [],
    },

    getters: {
        files: (state): File[] => state.files,
    },

    mutations: {
        REMOVE_FILE(state, fileName: string): void {
            state.files = state.files.filter(f => f.name !== fileName)
        },

        ADD_FILES(state, files: File[]): void {
            state.files = state.files.concat(files)
        },

        CLEAR_FILES(state): void {
            state.files = []
        },
    },

    actions: {
        removeFile({ commit }, fileName: string): void {
            commit('REMOVE_FILE', fileName)
        },

        addFiles({ commit }, files: File[]): void {
            commit('ADD_FILES', files)
        },

        clearFiles({ commit }): void {
            commit('CLEAR_FILES')
        },
    },
}

export default files