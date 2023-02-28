<script setup lang="ts">
import type { Settings } from '@shared/types'
import Checkbox from '@admin/components/Settings/Checkbox.vue'
import { computed } from '@vue/reactivity'
import { useStore } from 'vuex'

const store = useStore()
const settings = computed<Settings | null>(() => store.getters['settings/settings'])
</script>

<template>
    <div data-v-weyt2y78i>
        <h2 class="pager-title">Settings</h2>
        <p class="pager-intro">
            Settings and configurations for your Pager plugin.
        </p>

        <div v-if="settings" class="pager-form-inputs">
            <Checkbox
                @changed="settings.albumSound = $event"
                id="pager-album-sound"
                :defaultValue="false"
            >
                Play sound when changing pages
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