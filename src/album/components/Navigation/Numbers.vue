<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'
import NestedNumber from '@album/components/Navigation/NestedNumber.vue'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const prevPageNum = computed<number>(() => store.getters['files/prevPageNum'])

type GroupedFile = {
    title: string | number
    visible: boolean
    files: ImageFile[]
}

const groupedFiles = computed<GroupedFile[]>(() => {
    if (!files.value) {
        return []
    }

    const result: GroupedFile[] = files.value.reduce((groups: GroupedFile[], file) => {
        const matchedGroup = groups.find((group) => group.title === file.title || group.title === file.page)

        if (!matchedGroup) {
            const newGroup = {
                title: file.title || file.page,
                visible: false,
                files: [file]
            }

            groups.push(newGroup)

            return groups
        }

        matchedGroup.files.push(file)

        return groups
    }, [])

    result[0].visible = true

    return result
})

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
            v-for="(group, i) in groupedFiles"
            :key="i"
            :class="{
                'pager-active': group.files.some(f => f.visible),
                'pager-with-hover': group.files.length === 1
            }"
        >
            <div
                v-if="group.files.length === 1"
                @click="pageChosenHandler(group.files[0].page)"
            >
                <span class="pager-number">{{ group.title }}</span>
                <div class="pager-line"></div>
            </div>
            <div v-else>
                <span class="pager-number">{{ group.title }}
                    <NestedNumber
                        v-for="(file, index) in group.files"
                        :key="file.page"
                        :file="file"
                        :number="index + 1"
                        @clicked="pageChosenHandler(file.page)"
                    />
                </span>
                <div class="pager-line"></div>
            </div>
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
    padding: 7px
    margin-bottom: 5px

    b
        width: auto
        text-align: center
        min-width: 30px
        font-weight: normal

        &.pager-with-hover
            &:hover
                cursor: pointer

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

        &.pager-active
            .pager-line
                background-color: #6da816

            .pager-number
                color: #6da816
</style>