<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const currentPageNum = computed<number>(() => store.getters['files/currentPageNum'])
</script>

<template>
    <div data-v-qpxh391>
        <b
            v-for="(file, i) in files"
            :key="file.id"
            :class="{ 'active': file.visible }"
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
    border-radius: 5px
    background-color: white
    margin-bottom: 12px
    padding: 3px 7px

    b
        width: 100%
        text-align: center

        .pager-number
            color: #d5d5d5

        .pager-line
            width: 100%
            height: 5px
            display: block
            background-color: #d5d5d5
            border-radius: 2px

        &.active .pager-line
            background-color: #6da816

        &.active .pager-number
            color: #6da816
</style>