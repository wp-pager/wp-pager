<script setup lang="ts">
import Album from '@album/components/Album.vue'
import { onMounted } from 'vue'
import { useStore } from 'vuex'

const store = useStore()

onMounted(() => {
    store.dispatch('files/fetchFiles')
    store.dispatch('settings/fetchSettings')
})
</script>

<template>
    <Album />
</template>

