import type { Module } from 'vuex'
import type FilesState from './FilesState'
import type RootState from '@admin/store/RootState'
import { ImageFile } from '@shared/types'
import { ServerResponse } from '@shared/types'
import axios from 'axios'

const files: Module<FilesState, RootState> = {
    namespaced: true,

    state: {
        files: [],
        loading: false,
    },

    getters: {
        files: (state): ImageFile[] => state.files,
        loading: (state): boolean => state.loading,
    },

    mutations: {
        FETCH_FILES(state): void {
            state.loading = true

            const url = `${pager.ajaxUrl}?action=pager_get_files`

            axios.get<ServerResponse<ImageFile[]>>(url)
                .then(resp => state.files = resp.data.data)
                .catch(e => console.error(e))
                .finally(() => state.loading = false)
        },
    },

    actions: {
        fetchFiles({ commit }): void {
            commit('FETCH_FILES')
        },
    },
}

export default files