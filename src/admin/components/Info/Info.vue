<script setup lang="ts">
import type { Settings } from '@shared/types'
import { computed } from '@vue/reactivity'
import { useStore } from 'vuex'
import InputField from '@admin/components/Settings/InputField.vue'
import PageTitle from '@admin/components/PageTitle.vue'
import PageIntro from '@admin/components/PageIntro.vue'

const store = useStore()
const settings = computed<Settings | null>(() => store.getters['settings/settings'])

function updateAlbumMaxWidth(newValue: string): void {
    store.dispatch('settings/updateSettingValue', { albumMaxWidth: Number(newValue) })
}
</script>

<template>
    <div data-v-kcqpg38whf>
        <PageTitle>ℹ️ Info</PageTitle>
        <PageIntro>
            Learn about WP Pager and how to use it effectively.
        </PageIntro>

        <hr />

        <div>
            here
        </div>
    </div>
</template>

<style lang="sass" scoped>
</style>