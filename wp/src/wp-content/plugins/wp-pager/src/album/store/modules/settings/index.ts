import type { Module } from 'vuex'
import type SettingsState from './SettingsState'
import type RootState from '@album/store/RootState'
import type { ServerResponse, Settings } from '@shared/types'
import axios from 'axios'
import { storage } from '@shared/appConfig'

const settings: Module<SettingsState, RootState> = {
    namespaced: true,

    state: {
        settings: null,
    },

    getters: {
        settings: (s): Settings | null => s.settings,
    },

    mutations: {
        FETCH_SETTINGS(state): void {
            const params = {
                action: 'pager_get_settings',
                nonce: pager.nonce,
            }

            axios.get<ServerResponse<Settings | null>>(pager.ajaxUrl, { params })
                .then(resp => state.settings = resp.data.data)
                .catch(e => console.error(e))
        },
    },

    actions: {
        fetchSettings({ commit }): void {
            commit('FETCH_SETTINGS')
        },

        muteSound({ state}): void {
            if (!state.settings)
                return

            state.settings.albumSound = false
        },

        unmuteSound({ state}): void {
            if (!state.settings)
                return

            state.settings.albumSound = true
        },
    },
}

export default settings