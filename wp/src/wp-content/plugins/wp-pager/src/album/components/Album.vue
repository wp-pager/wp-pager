<script setup lang="ts">
import type { ImageFile, SwipeDirection } from '@shared/types'
import { useStore } from 'vuex'
import { computed, onMounted, ref } from 'vue'
import Spinner from '@shared/components/Spinner.vue'
import Numbers from '@album/components/Navigation/Numbers.vue'
import Arrows from '@album/components/Navigation/Arrows.vue'
import isTouchDevice from 'is-touch-device'
import { debounce } from 'lodash'
import SwipeLeftTransition from '@shared/components/Transitions/SwipeLeftTransition.vue'
import SwipeRightTransition from '@shared/components/Transitions/SwipeRightTransition.vue'

const store = useStore()
const loading = computed<boolean>(() => store.getters['files/loading'])
const files = computed<ImageFile[]>(() => store.getters['files/files'])

const debouncedTouchendHandler = debounce(handleTouchend, 100, {
    leading: true,
    trailing: false,
})

const swipeDirection = computed<SwipeDirection>(() => store.getters['swipe/direction'])
const isActive = computed<boolean>(() => store.getters['zoom/isActive'])

window.addEventListener('keydown', e => {
    if (e.key === 'Enter') {
        handleZoom()
    } else if (e.key === 'Escape') {
        store.dispatch('zoom/disable')
    }
})

function setTouchStart(e: TouchEvent): void {
    if (!e.changedTouches)
        return

    store.dispatch('swipe/setTouchStart', e.changedTouches[0].clientX)
}

function setTouchEnd(e: TouchEvent): void {
    if (!e.changedTouches)
        return

    store.dispatch('swipe/setTouchEnd', e.changedTouches[0].clientX)
}

function handleTouchend(e: TouchEvent): void {
    if (!e.changedTouches)
        return

    if (swipeDirection.value === 'right') {
        store.dispatch('files/prevPage')
    } else if (swipeDirection.value === 'left') {
        store.dispatch('files/nextPage')
    }
}

function handleZoom(): void {
    if (isTouchDevice())
        return

    store.dispatch('zoom/toggle')
}
</script>

<template>
    <div data-v-hw0krsr3 :class="{ 'pager-zoomed': isActive }">
        <div v-if="loading">
            <Spinner />
        </div>

        <div v-else-if="files.length > 0">
            <Numbers />

            <div
                @touchstart="setTouchStart"
                @touchmove="setTouchEnd"
                @touchend="debouncedTouchendHandler"
                class="pager-album-image"
                :class="{ 'pager-zoomed': isActive }"
            >
                <Arrows v-if="!isTouchDevice()" />

                <section
                    v-for="file in files"
                    :key="file.id"
                    @click="handleZoom"
                >
                    <component :is="swipeDirection === 'right' ? SwipeRightTransition : SwipeLeftTransition">
                        <img
                            v-show="file.visible"
                            :src="file.url"
                            :alt="file.name"
                        />
                    </component>
                </section>
            </div>
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-hw0krsr3]
    overflow: hidden
    padding: 7px

    &.pager-zoomed
        cursor: zoom-out
        position: absolute
        left: 10px
        top: 10px
        right: 10px
        z-index: 10

        .admin-bar &
            top: 40px

    .pager-album-image
        user-select: none
        cursor: zoom-in
        position: relative

        &.pager-zoomed
            cursor: zoom-out

        &:hover [data-v-bnqp3]
            opacity: 1

        section
            transition: all .5s ease-in-out

            img
                width: 100%
                user-select: none
                border-radius: 5px
                pointer-events: none
                box-shadow: 0 0 10px 0 rgba(0, 0, 0, .3)
</style>