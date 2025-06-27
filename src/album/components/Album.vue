<script setup lang="ts">
import type { ImageFile, Settings, SwipeDirection } from '@shared/types'
import { useStore } from 'vuex'
import { debounce } from 'lodash'
import { computed, ref } from 'vue'
import Spinner from '@shared/components/Spinner.vue'
import Tabs from '@album/components/Navigation/Tabs.vue'
import Arrows from '@album/components/Navigation/Arrows.vue'
import SwipeLeftTransition from '@shared/components/Transitions/SwipeLeftTransition.vue'
import SwipeRightTransition from '@shared/components/Transitions/SwipeRightTransition.vue'
import Footer from '@album/components/Footer/Footer.vue'

const store = useStore()
const loading = computed<boolean>(() => store.getters['files/loading'])
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const swipeDirection = computed<SwipeDirection>(() => store.getters['swipe/direction'])
const currHeight = ref<number>(0)
const settings = computed<Settings | null>(() => store.getters['settings/settings'])

addEventListener('resize', () => updateAlbumHeight())

const updateAlbumHeight = debounce(() => {
    const img = document.getElementById('pager-album-image') as HTMLImageElement

    if (img) {
        setCurrentHeight(img)
    }
}, 500)

const albumStyles = computed(() => {
    let styles: Record<string, string> = {}

    if (currHeight.value > 0) {
        styles.height = currHeight.value + 'px'
    }

    if (settings.value && settings.value.albumMaxWidth) {
        styles.maxWidth = settings.value.albumMaxWidth + 'px'
    }

    return styles
})

function setTouchStart(e: TouchEvent): void {
    if (e.changedTouches)
        store.dispatch('swipe/setTouchStart', e.changedTouches[0].clientX)
}

function setTouchEnd(e: TouchEvent): void {
    if (e.changedTouches)
        store.dispatch('swipe/setTouchEnd', e.changedTouches[0].clientX)
}

function setCurrentHeight(image: HTMLImageElement): void {
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
            <Tabs />

            <div
                @touchstart="setTouchStart"
                @touchmove="setTouchEnd"
                class="pager-album-image"
                :style="albumStyles"
            >
                <Arrows />

                <section
                    v-for="file in files"
                    :key="file.page"
                >
                    <Component :is="swipeDirection === 'right' ? SwipeRightTransition : SwipeLeftTransition">
                        <img
                            v-if="file.visible"
                            :src="file.url"
                            :alt="file.name"
                            @load="e => setCurrentHeight(e.target as HTMLImageElement)"
                            id="pager-album-image"
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
    position: relative
    padding: 0 10px
    z-index: 100

    .pager-album-image
        user-select: none
        position: relative
        margin-left: auto
        margin-right: auto

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

@media screen and (max-width: 768px)
    [data-v-hw0krsr3]
        padding: 0 1px

        .pager-album-image
            section
                img
                    box-shadow: 0 0 4px 0 rgba(0, 0, 0, .3)
</style>