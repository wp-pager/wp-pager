<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed, onMounted } from 'vue'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const currPageNum = computed<number>(() => store.getters['files/currPageNum'])

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
    await store.dispatch('swipe/setTouchStart', 1)
    await store.dispatch('swipe/setTouchEnd', 0)
    await store.dispatch('files/nextPage')
    await store.dispatch('files/setPrevPageNum', currPageNum.value + 1)
}

async function handleLeftDirection(): Promise<void> {
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
            <img src="/wp-content/plugins/wp-pager/assets/img/chevron.webp" alt="arrow-left" />
        </button>

        <button
            v-if="currPageNum < files.length"
            @click="nextPage"
            type="button"
            class="pager-right-button"
        >
            <img src="/wp-content/plugins/wp-pager/assets/img/chevron.webp" alt="arrow-right" />
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
        color: black
        border-radius: 50%
        width: 50px
        height: 50px
        display: flex
        align-items: center
        justify-content: center
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2)
        transition: transform .1s ease
        z-index: 10
        opacity: .6
        padding: 10px

        &.pager-right-button
            right: 17px

            &:hover
                transform: scale(1.2)

        &.pager-left-button
            left: 17px
            transform: rotate(180deg)

            &:hover
                transform: scale(1.2) rotate(180deg)

        img
            width: 100%

@media screen and (max-width: 768px)
    [data-v-bnqp3]
        button
            width: 38px
            height: 38px
            padding: 8px

            &.pager-right-button
                right: 3px

            &.pager-left-button
                left: 3px
</style>