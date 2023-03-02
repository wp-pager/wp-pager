<script setup lang="ts">
import type { ImageFile, SwipeDirection } from '@shared/types'
import { useStore } from 'vuex'
import isTouchDevice from 'is-touch-device'
import { debounce } from 'lodash'
import { computed, ref } from 'vue'
import Spinner from '@shared/components/Spinner.vue'
import Numbers from '@album/components/Navigation/Numbers.vue'
import Arrows from '@album/components/Navigation/Arrows.vue'
import SwipeLeftTransition from '@shared/components/Transitions/SwipeLeftTransition.vue'
import SwipeRightTransition from '@shared/components/Transitions/SwipeRightTransition.vue'
import Footer from '@album/components/Footer/Footer.vue'

const store = useStore()
const loading = computed<boolean>(() => store.getters['files/loading'])
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const swipeDirection = computed<SwipeDirection>(() => store.getters['swipe/direction'])
const currHeight = ref<number>(0)

const debouncedTouchendHandler = debounce(handleTouchend, 100, {
    leading: true,
    trailing: false,
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

function setCurrentHeight(e: Event, file: ImageFile): void {
    const image = e.target as HTMLImageElement
    const height = image.offsetHeight

    if (height > 0) {
        currHeight.value = height
    }
}
</script>

<template>
    <div data-v-hw0krsr3>
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
                :style="currHeight > 0 ? { height: currHeight + 'px' } : {}"
            >
                <Arrows v-if="!isTouchDevice()" />

                <section
                    v-for="file in files"
                    :key="file.page"
                >
                    <Component :is="swipeDirection === 'right' ? SwipeRightTransition : SwipeLeftTransition">
                        <img
                            v-if="file.visible"
                            :src="file.url"
                            :alt="file.name"
                            @load="setCurrentHeight($event, file)"
                        />
                    </Component>
                </section>
            </div>
        </div>

        <Footer />
    </div>
</template>

<style lang="sass" scoped>
[data-v-hw0krsr3]
    overflow: hidden
    padding: 7px
    position: relative
    z-index: 100

    .pager-album-image
        user-select: none
        position: relative

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