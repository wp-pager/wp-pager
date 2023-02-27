import type { Module } from 'vuex'
import type FilesState from './FilesState'
import type RootState from '@album/store/RootState'
import type { ImageFile } from '@shared/types'
import { ServerResponse } from '@shared/types'
import axios from 'axios'

const files: Module<FilesState, RootState> = {
    namespaced: true,

    state: {
        files: [],
        loading: false,
        currentPageNum: 1,
    },

    getters: {
        files: (s): ImageFile[] => s.files,
        loading: (s): boolean => s.loading,
        currentPageNum: (s): number => s.currentPageNum,
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
            const nextPage = state.currentPageNum + 1

            if (nextPage > state.files.length)
                return

            for (const key in state.files) {
                state.files[key].visible = state.files[key].id === nextPage
            }

            state.currentPageNum = nextPage
        },

        prevPage({ state }): void {
            const prevPage = state.currentPageNum - 1

            if (prevPage <= 0)
                return

            for (const key in state.files) {
                state.files[key].visible = state.files[key].id === prevPage
            }

            state.currentPageNum = prevPage
        },

        setPageNum({ state }, pageNum: number): void {
            if (pageNum <= 0 || pageNum > state.files.length)
                return

            for (const key in state.files) {
                state.files[key].visible = state.files[key].id === pageNum
            }

            state.currentPageNum = pageNum
        },
    },
}

export default files