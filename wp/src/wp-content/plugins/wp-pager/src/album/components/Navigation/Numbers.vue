<script setup lang="ts">
import type { Settings, ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const prevPageNum = computed<number>(() => store.getters['files/prevPageNum'])

async function pageChosenHandler(pageNum: number) {
    if (pageNum > prevPageNum.value) {
        await store.dispatch('swipe/setTouchStart', 1)
        await store.dispatch('swipe/setTouchEnd', 0)
    } else if (pageNum < prevPageNum.value) {
        await store.dispatch('swipe/setTouchStart', 0)
        await store.dispatch('swipe/setTouchEnd', 1)
    }

    await store.dispatch('files/setPrevPageNum', pageNum)
    await store.dispatch('files/setCurrPageNum', pageNum)
}
</script>

<template>
    <div data-v-qpxh391>
        <b
            v-for="file in files"
            :key="file.page"
            :class="{ 'active': file.visible }"
            @click="pageChosenHandler(file.page)"
        >
            <span class="pager-number">{{ file.title ? file.title : file.page }}</span>
            <div class="pager-line"></div>
        </b>
    </div>
</template>

<style lang="sass" scoped>
[data-v-qpxh391]
    display: flex
    flex-wrap: wrap
    box-sizing: content-box !important
    gap: 3px 10px
    justify-content: center
    align-items: flex-end
    border-radius: 5px
    background-color: white
    padding: 5px 5px 15px 5px

    b
        width: auto
        text-align: center
        cursor: pointer
        min-width: 30px
        font-weight: normal

        &:hover
            .pager-line
                background-color: #456813

            .pager-number
                color: #456813

        .pager-number
            color: #c5c5c5
            transition: all .1s ease-in-out
            user-select: none
            padding: 0 5px

        .pager-line
            width: 100%
            height: 4px
            display: block
            background-color: #c5c5c5
            border-radius: 2px
            transition: height .1s ease-in-out

        &.active
            .pager-line
                background-color: #6da816

            .pager-number
                color: #6da816
</style>