<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed, onMounted, ref } from 'vue'
import Spinner from '@shared/components/Spinner.vue'
import PageInfo from '@album/components/Album/PageInfo/PageInfo.vue'
import Navigation from '@album/components/Album/Navigation.vue'
import isTouchDevice from 'is-touch-device'
import { debounce } from 'lodash'
import SwipeLeftTransition from '@shared/components/Transitions/SwipeLeftTransition.vue'
import SwipeRightTransition from '@shared/components/Transitions/SwipeRightTransition.vue'

const store = useStore()

onMounted(() => store.dispatch('files/fetchFiles'))

const loading = computed<boolean>(() => store.getters['files/loading'])
const files = computed<ImageFile[]>(() => store.getters['files/files'])

const debouncedTouchendHandler = debounce(handleTouchend, 200, {
    leading: true,
    trailing: false,
})

const touchStart = ref(0)
const touchEnd = ref(0)
const swipeDirection = computed<'right' | 'left'>(() => touchStart.value > touchEnd.value ? 'left' : 'right')

function setTouchStart(e: TouchEvent): void {
    if (!e.changedTouches)
        return

    touchStart.value = e.changedTouches[0].clientX
}

function handleTouchend(e: TouchEvent): void {
    if (!e.changedTouches)
        return

    touchEnd.value = e.changedTouches[0].clientX

    if (swipeDirection.value === 'right') {
        store.dispatch('files/prevPage')
    } else if (swipeDirection.value === 'left') {
        store.dispatch('files/nextPage')
    }
}
</script>

<template>
    <div data-v-hw0krsr3>
        <div v-if="loading">
            <Spinner />
        </div>

        <div v-else-if="files.length > 0">
            <PageInfo />

            <div
                @touchstart="setTouchStart"
                @touchmove="debouncedTouchendHandler"
                class="pager-album-image"
            >
                <Navigation v-if="!isTouchDevice()" />

                <div
                    v-for="file in files"
                    :key="file.id"
                >
                    <component :is="swipeDirection === 'right' ? SwipeRightTransition : SwipeLeftTransition">
                        <img
                            v-if="file.visible"
                            :src="file.url"
                            :alt="file.name"
                        />
                    </component>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-hw0krsr3]
    overflow: hidden
    position: relative

    .pager-album-image
        min-height: 700px

        &:hover [data-v-bnqp3]
            opacity: 1

        img
            width: 100%
            border-radius: 5px
            pointer-events: none
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .3)
</style>