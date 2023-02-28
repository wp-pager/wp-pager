<script setup lang="ts">
import type { Settings } from '@shared/types';
import { ref } from 'vue'
import Checkbox from '@admin/components/Settings/Checkbox.vue'

const formData = ref<Settings>({
    albumSound: false,
})
</script>

<template>
    <div data-v-weyt2y78i>
        <h2 class="pager-title">Settings</h2>
        <p class="pager-intro">
            Settings and configurations for your Pager plugin.
        </p>

        <div class="pager-form-inputs">
            <Checkbox id="pager-album-sound" :defaultValue="false">
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