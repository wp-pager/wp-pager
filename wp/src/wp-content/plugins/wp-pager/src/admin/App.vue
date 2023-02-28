<script setup lang="ts">
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import tabs from '@admin/modules/tabs'
</script>

<template>
    <div data-v-qvrskl39s>
        <TabGroup :selectedIndex="2">
            <TabList class="pager-tabs">
                <Tab
                    v-for="tab in tabs"
                    :key="tab.title"
                    as="template"
                    v-slot="{ selected }"
                >
                    <button class="pager-tab" :class="{ 'pager-active': selected }">
                        {{ tab.title }}
                    </button>
                </Tab>
            </TabList>
            <TabPanels>
                <TabPanel v-for="tab in tabs" :key="tab.title">
                    <component :is="tab.component" />
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>

<style lang="sass" scoped>
/deep/ .pager-title
    font-size: 2rem
    font-weight: 400
    margin-bottom: 1.2rem

/deep/ .pager-intro
    font-size: 1.1rem
    margin-bottom: 1.2rem

[data-v-qvrskl39s]
    padding: 20px 20px 0 0

    .pager-tabs
        width: fit-content
        padding: 5px
        border-radius: 50px
        background-color: white
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, .1)

        .pager-tab
            min-width: 200px
            padding: 8px 5px
            border: none
            background: none
            color: #4a5568
            font-size: 0.875rem
            font-weight: 600
            line-height: 1.25rem
            cursor: pointer
            margin-right: 5px
            text-transform: uppercase
            border-right: 1px solid #e2e8f0

            &:first-child
                border-radius: 50px 7px 7px 50px

            &:last-child
                margin-right: 0
                border-radius: 7px 50px 50px 7px
                border-right: none

            &:hover
                background-color: #e0e8ee

            &:active,
            &:focus
                outline: none

            &.pager-active
                background-color: #5a7182
                color: white
</style>