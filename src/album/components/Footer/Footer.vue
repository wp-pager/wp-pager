<script setup lang="ts">
import type { Settings } from '@shared/types'
import DownloadFile from '@album/components/Footer/DownloadFile.vue'
import Copyright from '@album/components/Footer/Copyright.vue'
import InfoModalTrigger from '@album/components/Footer/InfoModalTrigger.vue'
import { computed } from 'vue'
import { useStore } from 'vuex'

const store = useStore()
const settings = computed<Settings | null>(() => store.getters['settings/settings'])
const styles = computed(() => {
    if (settings.value) {
        return {
            maxWidth: settings.value.albumMaxWidth + 'px',
        }
    }

    return {}
})
</script>

<template>
    <div data-v-go094ik :style="styles">
        <div class="pager-buttons">
            <InfoModalTrigger />
            <DownloadFile />
        </div>

        <Copyright />
    </div>
</template>

<style lang="sass" scoped>
[data-v-go094ik]
    display: flex
    justify-content: space-between
    align-items: center
    padding: 10px 10px
    border-radius: 0 0 8px 8px
    overflow: visible
    margin-left: auto
    margin-right: auto

    .pager-buttons
        display: flex
        align-items: center
        gap: 13px
</style>