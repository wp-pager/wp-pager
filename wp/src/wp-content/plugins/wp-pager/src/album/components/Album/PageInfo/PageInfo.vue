<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed } from 'vue'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const currentFileIndex = computed<number>(() => store.getters['files/currentFileIndex'])
</script>

<template>
    <div data-v-qpxh391>
        <span>Page: {{ currentFileIndex + 1 }}/{{ files.length }}</span>
    </div>
</template>

<style lang="sass" scoped>
[data-v-qpxh391]
    background-color: white
    color: #777
    border-radius: 5px
    padding: 3px 7px
    font-size: .9rem
    margin-bottom: 10px
</style>