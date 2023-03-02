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
        selectedTab: 0,
    },

    getters: {
        settings: (s): Settings | null => s.settings,
        selectedTab: (s): number => s.selectedTab,
    },

    mutations: {
        FETCH_SETTINGS(state): void {
            state.loading = true

            const params = {
                action: 'pager_get_settings',
                nonce: pager.nonce,
            }

            axios.get<ServerResponse<Settings | null>>(pager.ajaxUrl, { params })
                .then(resp => state.settings = resp.data.data)
                .catch(e => console.error(e))
                .finally(() => state.loading = false)
        },

        UPDATE_SETTINGS(state, settings: Settings): void {
            state.loading = true

            const params = new FormData()
            params.append('action', 'pager_update_settings')
            params.append('nonce', pager.nonce)
            params.append('settings', JSON.stringify(settings))

            axios.post<ServerResponse<Settings | null>>(pager.ajaxUrl, params)
                .then(resp => state.settings = resp.data.data)
                .catch(e => console.error(e))
                .finally(() => state.loading = false)
        }
    },

    actions: {
        fetchSettings({ commit }): void {
            commit('FETCH_SETTINGS')
        },

        updateSettings({ commit }, settings: Settings): void {
            commit('UPDATE_SETTINGS', settings)
        },

        setSelectedTab({ state }, tab: number): void {
            state.selectedTab = tab
        },
    },
}

export default settings