import type { Module } from 'vuex'
import type FilesState from './FilesState'
import type RootState from '@admin/store/RootState'
import type { ImageFile } from '@shared/types'
import { ServerResponse } from '@shared/types'
import axios from 'axios'

const files: Module<FilesState, RootState> = {
    namespaced: true,

    state: {
        files: [],
        loading: false,
        currentFileIndex: 0,
    },

    getters: {
        files: (s): ImageFile[] => s.files,
        loading: (s): boolean => s.loading,
        currentFileIndex: (s): number => s.currentFileIndex,
    },

    mutations: {
        FETCH_FILES(state): void {
            state.loading = true

            const params = {
                action: 'pager_get_files',
                nonce: pager.nonce,
            }

            axios.get<ServerResponse<ImageFile[]>>(pager.ajaxUrl, { params })
                .then(resp => state.files = resp.data.data)
                .catch(e => console.error(e))
                .finally(() => state.loading = false)
        },
    },

    actions: {
        fetchFiles({ commit }): void {
            commit('FETCH_FILES')
        },

        nextPage({ state }): void {
            const nextIndex = state.currentFileIndex + 1

            if (nextIndex >= state.files.length)
                return

            state.currentFileIndex = nextIndex
        },

        prevPage({ state }): void {
            const prevIndex = state.currentFileIndex - 1

            if (prevIndex < 0)
                return

            state.currentFileIndex = prevIndex
        },
    },
}

export default files