<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])

function setPageNum(page: number) {
    store.dispatch('files/setPageNum', page)
}
</script>

<template>
    <div data-v-qpxh391>
        <b
            v-for="(file, i) in files"
            :key="file.id"
            :class="{ 'active': file.visible }"
            @click="setPageNum(i + 1)"
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