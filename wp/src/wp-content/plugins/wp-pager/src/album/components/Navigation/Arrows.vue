<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed, onMounted } from 'vue'
import ArrowRightIcon from '@shared/components/Icons/ArrowRightIcon.vue'
import ArrowLeftIcon from '@shared/components/Icons/ArrowLeftIcon.vue'
import useSound from '@album/composables/useSound'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const currPageNum = computed<number>(() => store.getters['files/currPageNum'])
const { playSound } = useSound()

onMounted(() => {
    window.addEventListener('keydown', async e => {
        if (e.key === 'ArrowRight') {
            handleRightDirection()
        } else if (e.key === 'ArrowLeft') {
            handleLeftDirection()
        }
    })
})

function nextPage(): void {
    handleRightDirection()
}

function prevPage(): void {
    handleLeftDirection()
}

async function handleRightDirection(): Promise<void> {
    playSound('page-prev')
    await store.dispatch('swipe/setTouchStart', 1)
    await store.dispatch('swipe/setTouchEnd', 0)
    await store.dispatch('files/nextPage')
    await store.dispatch('files/setPrevPageNum', currPageNum.value + 1)
}

async function handleLeftDirection(): Promise<void> {
    playSound('page-next')
    await store.dispatch('swipe/setTouchStart', 0)
    await store.dispatch('swipe/setTouchEnd', 1)
    await store.dispatch('files/prevPage')
    await store.dispatch('files/setPrevPageNum', currPageNum.value - 1)
}
</script>

<template>
    <div data-v-bnqp3>
        <button
            v-if="currPageNum > 1"
            @click="prevPage"
            type="button"
            class="pager-left-button"
        >
            <ArrowLeftIcon class="pager-icon" />
        </button>

        <button
            v-if="currPageNum < files.length"
            @click="nextPage"
            type="button"
            class="pager-right-button"
        >
            <ArrowRightIcon class="pager-icon" />
        </button>
    </div>
</template>

<style lang="sass" scoped>
[data-v-bnqp3]
    opacity: 0

    button
        background: none
        border: none
        cursor: pointer
        position: absolute
        top: 50%
        margin-top: -25px
        background-color: white
        border: 1px solid #eaeaea
        border-radius: 50%
        width: 50px
        height: 50px
        display: flex
        align-items: center
        justify-content: center
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2)
        transition: background-color 200ms ease, opacity 200ms ease
        z-index: 10

        &:hover
            background-color: #f5f5f5

        &.pager-right-button
            right: 17px

        &.pager-left-button
            left: 17px

        .pager-icon
            width: 27px
            height: 27px
</style>