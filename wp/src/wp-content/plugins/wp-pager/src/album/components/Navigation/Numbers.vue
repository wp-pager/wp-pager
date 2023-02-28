<script setup lang="ts">
import type { Settings, ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'
import useSound from '@album/composables/useSound'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const prevPageNum = computed<number>(() => store.getters['files/prevPageNum'])
const { playSound } = useSound()

async function pageChosenHandler(pageNum: number) {
    if (pageNum > prevPageNum.value) {
        await store.dispatch('swipe/setTouchStart', 1)
        await store.dispatch('swipe/setTouchEnd', 0)
        playSound('page-prev')
    } else if (pageNum < prevPageNum.value) {
        await store.dispatch('swipe/setTouchStart', 0)
        await store.dispatch('swipe/setTouchEnd', 1)
        playSound('page-next')
    }

    await store.dispatch('files/setPrevPageNum', pageNum)
    await store.dispatch('files/setCurrPageNum', pageNum)
}
</script>

<template>
    <div data-v-qpxh391>
        <b
            v-for="(file, i) in files"
            :key="file.id"
            :class="{ 'active': file.visible }"
            @click="pageChosenHandler(i + 1)"
        >
            <span class="pager-number">{{ i + 1 }}</span>
            <div class="pager-line"></div>
        </b>
    </div>
</template>

<style lang="sass" scoped>
[data-v-qpxh391]
    display: flex
    gap: 6px
    justify-content: space-evenly
    align-items: flex-end
    border-radius: 5px
    background-color: white
    margin-bottom: 12px
    padding: 3px 7px
    height: 30px

    b
        width: 100%
        text-align: center
        cursor: pointer

        &:hover
            .pager-line
                height: 10px

        .pager-number
            color: #d5d5d5
            transition: all .1s ease-in-out
            user-select: none

        .pager-line
            width: 100%
            height: 5px
            display: block
            background-color: #d5d5d5
            border-radius: 2px
            transition: height .1s ease-in-out

        &.active
            .pager-line
                background-color: #6da816

            .pager-number
                color: #6da816
</style>