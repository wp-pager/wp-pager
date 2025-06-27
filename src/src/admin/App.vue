<script setup lang="ts">
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import tabs from '@admin/modules/tabs'
import listenEvent from '@shared/modules/listenEvent'
import { events } from '@shared/appConfig'
import { onMounted } from 'vue'
import { useStore } from 'vuex'
import { computed } from '@vue/reactivity'

const store = useStore()
const selectedTab = computed<number>(() => store.getters['settings/selectedTab'])

onMounted(() => {
    store.dispatch('settings/fetchSettings')
    store.dispatch('files/fetchFiles')

    listenEvent(events.filesUploaded, () => {
        const tab = tabs.find(t => t.slug === 'files')
        changeTab(tab ? tab.index : 0)
    })
})

function changeTab(tab: number): void {
    store.dispatch('settings/setSelectedTab', tab)
}
</script>

<template>
    <div data-v-qvrskl39s>
        <TabGroup :selectedIndex="selectedTab" @change="changeTab">
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
                    <Component :is="tab.component" />
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>

<style lang="scss" scoped>
[data-v-qvrskl39s] {
    padding: 20px 20px 0 0;
    max-width: 1300px;

    .pager-tabs {
        width: 100%;
        max-width: 800px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 10px;
        padding: 5px;
        border-radius: 7px;
        background-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);

        .pager-tab {
            width: 100%;
            padding: 8px 5px;
            border: none;
            background: none;
            color: #4a5568;
            font-size: 0.875rem;
            font-weight: 600;
            line-height: 1.25rem;
            cursor: pointer;
            margin-right: 5px;
            text-transform: uppercase;
            border-right: 1px solid #e2e8f0;
            border-radius: 7px;

            &:last-child {
                margin-right: 0;
                border-right: none;
            }
            &:hover {
                background-color: #e0e8ee;
            }
            &:active,
            &:focus {
                outline: none;
            }
            &.pager-active {
                background-color: #5a7182;
                color: white;
            }
        }
    }
}
</style>
