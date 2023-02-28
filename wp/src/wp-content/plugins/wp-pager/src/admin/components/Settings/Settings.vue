<script setup lang="ts">
import type { Settings } from '@shared/types';
import { ref } from 'vue'

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

        <div>
            <div class="pager-input">
                <input v-model="formData.albumSound" type="checkbox" id="pager-album-sound">
                <label for="pager-album-sound">
                    Play sound when changing pages
                </label>
            </div>
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-weyt2y78i]
    .pager-input
        display: flex
        align-items: center
        margin-bottom: 1.2rem

        input
            margin-right: 0.5rem
</style>