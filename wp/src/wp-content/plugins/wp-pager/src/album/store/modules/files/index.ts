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
        currPageNum: 1,
        prevPageNum: 1,
    },

    getters: {
        files: (s): ImageFile[] => s.files,
        loading: (s): boolean => s.loading,
        currPageNum: (s): number => s.currPageNum,
        prevPageNum: (s): number => s.prevPageNum,
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

        nextPage({ state, commit }): void {
            const nextPage = state.currPageNum + 1

            if (nextPage > state.files.length) {
                return
            }

            for (const key in state.files) {
                state.files[key].visible = state.files[key].id === nextPage
            }

            state.currPageNum = nextPage
        },

        prevPage({ state, commit }): void {
            const prevPage = state.currPageNum - 1

            if (prevPage <= 0) {
                return
            }

            for (const key in state.files) {
                state.files[key].visible = state.files[key].id === prevPage
            }

            state.currPageNum = prevPage
        },

        setCurrPageNum({ state, commit }, pageNum: number): void {
            if (pageNum <= 0 || pageNum > state.files.length)
                return

            for (const key in state.files) {
                state.files[key].visible = state.files[key].id === pageNum
            }

            state.currPageNum = pageNum
        },

        setPrevPageNum({ state }, pageNum: number): void {
            state.prevPageNum = pageNum
        },
    },
}

export default files