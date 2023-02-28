import type { Module } from 'vuex'
import type ZoomState from './ZoomState'
import type RootState from '@album/store/RootState'
import type { SwipeDirection } from '@shared/types'

const zoom: Module<ZoomState, RootState> = {
    namespaced: true,

    state: {
        isActive: false,
    },

    getters: {
        isActive: (s): boolean => s.isActive,
    },

    actions: {
        toggle({ state }): void {
            state.isActive = !state.isActive
        },

        disable({ state }): void {
            state.isActive = false
        },
    },
}

export default zoom