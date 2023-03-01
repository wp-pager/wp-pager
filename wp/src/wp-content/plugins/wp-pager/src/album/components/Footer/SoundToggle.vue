<script setup lang="ts">
import SoundOnIcon from '@shared/components/Icons/SoundOnIcon.vue'
import SoundOffIcon from '@shared/components/Icons/SoundOffIcon.vue'
import { useStore } from 'vuex'

const store = useStore()

function toggleSound(): void {
    store.dispatch('album/toggleSound')
}
</script>

<template>
    <div data-v-8eos3>
        <button type="button"></button>
    </div>
</template>

<style lang="sass" scoped>
[data-v-8eos3]
    //
</style>