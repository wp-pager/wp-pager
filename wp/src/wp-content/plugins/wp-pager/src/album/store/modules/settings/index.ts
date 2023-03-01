import type { Module } from 'vuex'
import type SettingsState from './SettingsState'
import type RootState from '@album/store/RootState'
import type { ServerResponse, Settings } from '@shared/types'
import axios from 'axios'
import { storage } from '@shared/appConfig'

const storedSoundIsOn = localStorage.getItem(storage.key.albumSoundIsOn)

const settings: Module<SettingsState, RootState> = {
    namespaced: true,

    state: {
        settings: null,
        soundIsOn: storedSoundIsOn ? storedSoundIsOn === storage.value.on : null,
    },

    getters: {
        settings: (s): Settings | null => s.settings,
        soundIsOn: (s): boolean => {
            if (!s.settings)
                return false

            return s.soundIsOn !== null ? s.soundIsOn : s.settings.albumSound
        },
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

        muteSound({ state }): void {
            state.soundIsOn = false
        },

        unmuteSound({ state }): void {
            state.soundIsOn = true
        },
    },
}

export default settings