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
    },

    getters: {
        files: (state): ImageFile[] => state.files,
        loading: (state): boolean => state.loading,
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

        SET_FILES(state, files: ImageFile[]): void {
            state.files = files

            const formData = new FormData()

            formData.append('action', 'pager_set_files')
            formData.append('nonce', pager.nonce)
            formData.append('files', JSON.stringify(files))

            axios.post<ServerResponse<null>>(pager.ajaxUrl, formData)
                .catch(err => console.error(err))
        },

        DELETE_FILE(state, page: number): void {
            if (!confirm('Are you sure you want to delete this file?'))
                return

            state.loading = true

            const formData = new FormData()

            formData.append('id', page.toString())
            formData.append('action', 'pager_delete_file')
            formData.append('nonce', pager.nonce)

            axios.post<ServerResponse<ImageFile[]>>(pager.ajaxUrl, formData)
                .then(resp => state.files = resp.data.data)
                .catch(err => console.error(err))
                .finally(() => state.loading = false)
        },

        async ADD_FILES(state, files: File[]): Promise<void> {
            if (!confirm('Are you sure you want to upload all files?'))
                return

            state.loading = true

            const formData = new FormData()
            formData.append('action', 'pager_add_files')
            formData.append('nonce', pager.nonce)

            files.forEach(f => formData.append('files[]', f, f.name))

            const params = { headers: { 'Content-Type': 'multipart/form-data' } }

            try {
                const resp = await axios.post<ServerResponse<ImageFile[]>>(pager.ajaxUrl, formData, params)
                state.files = resp.data.data
            } catch (err) {
                console.error(err)
            }

            state.loading = false
        },

        DELETE_ALL_FILES(state): void {
            if (!confirm('Are you sure you want to delete all files?'))
                return

            state.loading = true

            const formData = new FormData()
            formData.append('action', 'pager_delete_all_files')
            formData.append('nonce', pager.nonce)

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

        deleteFile({ commit }, page: number): void {
            commit('DELETE_FILE', page)
        },

        setFiles({ commit }, files: ImageFile[]): void {
            commit('SET_FILES', files)
        },

        addFiles({ commit }, files: File[]): void {
            commit('ADD_FILES', files)
        },

        deleteAllFiles({ commit }): void {
            commit('DELETE_ALL_FILES')
        },
    },
}

export default files