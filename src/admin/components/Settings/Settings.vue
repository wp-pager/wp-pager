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
    <div data-v-weyt2y78i>
        <PageTitle>⚙️ Settings</PageTitle>
        <PageIntro>
            Settings and configurations for your Pager plugin.
        </PageIntro>

        <hr />

        <div v-if="settings" class="pager-form-inputs">
            <InputField
                id="album-max-width"
                :defaultValue="settings?.albumMaxWidth ? settings?.albumMaxWidth.toString() : '1000'"
                type="text"
                :inputWidth="120"
                @changed="updateAlbumMaxWidth"
            >
                Album max width

                <template #after>
                    pixels
                </template>
            </InputField>
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-weyt2y78i]
    .pager-form-inputs
        display: flex
        flex-direction: column
        gap: 1.5rem
        padding-top: 15px
</style>