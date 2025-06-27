import type { Module } from 'vuex'
import type SwipeState from './SwipeState'
import type RootState from '@album/store/RootState'
import type { SwipeDirection } from '@shared/types'

const swipe: Module<SwipeState, RootState> = {
    namespaced: true,

    state: {
        touchStart: 1,
        touchEnd: 0,
    },

    getters: {
        direction: (s): SwipeDirection => s.touchStart > s.touchEnd ? 'left' : 'right',
    },

    actions: {
        setTouchStart({ state }, touchStart: number): void {
            state.touchStart = touchStart
        },

        setTouchEnd({ state }, touchEnd: number): void {
            state.touchEnd = touchEnd
        },
    },
}

export default swipe