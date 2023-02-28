import type { Module } from 'vuex'
import type SettingsState from './SettingsState'
import type RootState from '@admin/store/RootState'
import type { ServerResponse, Settings } from '@shared/types'
import axios from 'axios'

const settings: Module<SettingsState, RootState> = {
    namespaced: true,

    state: {
        settings: null,
        loading: false,
    },

    getters: {
        settings: (state): Settings | null => state.settings,
    },

    mutations: {
        FETCH_SETTINGS(state): void {
            state.loading = true

            const params = {
                action: 'pager_get_settings',
                nonce: pager.nonce,
            }

            axios.get<ServerResponse<Settings>>(pager.ajaxUrl, { params })
                .then(resp => state.settings = resp.data.data)
                .catch(e => console.error(e))
                .finally(() => state.loading = false)
        },
    },

    actions: {
        fetchSettings({ commit }): void {
            commit('FETCH_SETTINGS')
        },
    },
}

export default settings