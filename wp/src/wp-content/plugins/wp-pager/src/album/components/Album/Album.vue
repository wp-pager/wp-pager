<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed, onMounted } from 'vue'
import Spinner from '@shared/components/Spinner.vue'

const store = useStore()

onMounted(() => store.dispatch('files/fetchFiles'))

const loading = computed<boolean>(() => store.getters['files/loading'])
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const currentFileIndex = computed<number>(() => store.getters['files/currentFileIndex'])
const currentFile = computed<ImageFile | null>(() => files.value[currentFileIndex.value])
</script>

<template>
    <div data-v-hw0krsr3>
        <div v-if="loading">
            <Spinner />
        </div>

        <div v-else-if="currentFile" class="pager-album-image">
            <img
                :src="currentFile.url"
                :alt="currentFile.name"
            />
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-hw0krsr3]
    .pager-album-image
        position: relative

        img
            width: 100%
            border-radius: 5px
            pointer-events: none
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2)
</style>