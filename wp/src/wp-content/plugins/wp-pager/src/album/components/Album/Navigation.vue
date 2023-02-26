<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'
import ArrowRightIcon from '@shared/components/Icons/ArrowRightIcon.vue'
import ArrowLeftIcon from '@shared/components/Icons/ArrowLeftIcon.vue'

const store = useStore()

const files = computed<ImageFile[]>(() => store.getters['files/files'])
const currentPageNum = computed<number>(() => store.getters['files/currentPageNum'])

function nextPage(): void {
    store.dispatch('files/nextPage')
}

function prevPage(): void {
    store.dispatch('files/prevPage')
}
</script>

<template>
    <div data-v-bnqp3>
        <button
            v-if="currentPageNum > 1"
            @click="prevPage"
            type="button"
            class="pager-left-button"
        >
            <ArrowLeftIcon class="pager-icon" />
        </button>

        <button
            v-if="currentPageNum < files.length"
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

        &:hover
            background-color: #f5f5f5

        &.pager-right-button
            right: 10px

        &.pager-left-button
            left: 10px

        .pager-icon
            width: 27px
            height: 27px
</style>