<script setup lang="ts">
import type { Settings } from '@shared/types'
import Checkbox from '@admin/components/Settings/Checkbox.vue'
import { computed } from '@vue/reactivity'
import { useStore } from 'vuex'

const store = useStore()
const settings = computed<Settings | null>(() => store.getters['settings/settings'])

function updateAlbumSound(newValue: boolean): void {
    if (!settings.value)
        return

    const newSettings = { ...settings.value, albumSound: newValue }
    store.dispatch('settings/updateSettings', newSettings)
}
</script>

<template>
    <div data-v-weyt2y78i>
        <h2 class="pager-title">Settings</h2>
        <p class="pager-intro">
            Settings and configurations for your Pager plugin.
        </p>

        <div v-if="settings" class="pager-form-inputs">
            <Checkbox
                @changed="updateAlbumSound"
                id="pager-album-sound"
                :defaultValue="settings!.albumSound || false"
            >
                Enable album sound effects
            </Checkbox>
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-weyt2y78i]
    .pager-form-inputs
        display: flex
        flex-direction: column
        gap: 1.2rem
</style>