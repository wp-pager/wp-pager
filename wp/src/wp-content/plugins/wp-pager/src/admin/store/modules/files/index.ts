import type { Module } from 'vuex'
import type FilesState from './FilesState'
import type RootState from '@admin/store/RootState'
import { ImageFile } from '@shared/types'
import { ServerResponse } from '@shared/types'
import axios from 'axios'
import { makeLogger } from 'ts-loader/dist/logger'

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

            axios.get<ServerResponse<ImageFile[]>>(pager.ajaxUrl, {
                params: { action: 'pager_get_files' },
            })
                .then(resp => state.files = resp.data.data)
                .catch(e => console.error(e))
                .finally(() => state.loading = false)
        },

        DELETE_FILE(state, id: number): void {
            if (!confirm('Are you sure you want to delete this file?'))
                return

            state.loading = true

            const formData = new FormData()

            formData.append('id', id.toString())
            formData.append('action', 'pager_delete_file')

            axios.post<ServerResponse<ImageFile[]>>(pager.ajaxUrl, formData)
                .then(resp => state.files = resp.data.data)
                .catch(err => console.error(err))
                .finally(() => state.loading = false)
        },

        async UPLOAD_FILES(state, files: File[]): Promise<void> {
            if (!confirm('Are you sure you want to upload all files?'))
                return

            const formData = new FormData()
            formData.append('action', 'pager_add_files')

            files.forEach(f => formData.append('files[]', f, f.name))

            const params = { headers: { 'Content-Type': 'multipart/form-data' } }

            try {
                const resp = await axios.post<ServerResponse<ImageFile[]>>(pager.ajaxUrl, formData, params)
                state.files = resp.data.data
            } catch (err) {
                console.error(err)
            }
        },

        DELETE_ALL_FILES(state): void {
            if (!confirm('Are you sure you want to delete all files?'))
                return

            state.loading = true

            const formData = new FormData()
            formData.append('action', 'pager_delete_all_files')

            axios.post<ServerResponse<null>>(pager.ajaxUrl, formData)
                .then(resp => state.files = [])
                .catch(err => console.error(err))
                .finally(() => state.loading = false)
        },
    },

    actions: {
        fetchFiles({ commit }): void {
            commit('FETCH_FILES')
        },

        deleteFile({ commit }, id: number): void {
            commit('DELETE_FILE', id)
        },

        uploadFiles({ commit }, files: File[]): void {
            commit('UPLOAD_FILES', files)
        },

        deleteAllFiles({ commit }): void {
            commit('DELETE_ALL_FILES')
        },
    },
}

export default files