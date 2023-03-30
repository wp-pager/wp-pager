<script setup lang="ts">
import NestedTab from '@album/components/Navigation/NestedTab.vue'
import Tab from '@album/components/Navigation/Tab.vue'
import Line from '@album/components/Navigation/Line.vue'
import useAlbumNumbers from '@album/composables/useAlbumNumbers'

const { groupedFiles, pageChosenHandler } = useAlbumNumbers()
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
                <Tab>{{ group.title }}</Tab>
                <Line />
            </div>
            <div v-else>
                <Tab>{{ group.title }}
                    <NestedTab
                        v-for="(file, index) in group.files"
                        :key="file.page"
                        :file="file"
                        :number="index + 1"
                        @clicked="pageChosenHandler(file.page)"
                    />
                </Tab>
                <Line />
            </div>
        </b>
    </div>
</template>

<style lang="sass" scoped>
$active: #6da816

[data-v-qpxh391]
    display: flex
    flex-wrap: wrap
    box-sizing: content-box !important
    gap: 3px 10px
    justify-content: center
    align-items: flex-end
    border-radius: 5px
    padding: 7px 0
    margin-bottom: 5px

    b
        width: auto
        text-align: center
        min-width: 30px
        font-weight: normal

        &.pager-with-hover:hover,
        &.pager-active
            cursor: pointer

            .pager-line
                background-color: $active

            .pager-number
                color: $active
</style>