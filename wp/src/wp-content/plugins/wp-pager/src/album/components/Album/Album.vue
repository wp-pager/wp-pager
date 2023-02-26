<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { useStore } from 'vuex'
import { computed, onMounted } from 'vue'
import Spinner from '@shared/components/Spinner.vue'
import PageInfo from '@album/components/Album/PageInfo/PageInfo.vue'
import Navigation from '@album/components/Album/Navigation.vue'

const store = useStore()

onMounted(() => store.dispatch('files/fetchFiles'))

const loading = computed<boolean>(() => store.getters['files/loading'])
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const pageTurnDirection = computed<string>(() => store.getters['files/pageTurnDirection'])
</script>

<template>
    <div data-v-hw0krsr3>
        <div v-if="loading">
            <Spinner />
        </div>

        <div v-else-if="files.length > 0">
            <PageInfo />

            <div class="pager-album-image">
                <Navigation />

                <img
                    v-for="file in files"
                    :key="file.id"
                    :style="{ opacity: file.visible ? 1 : 0 }"
                    :src="file.url"
                    :alt="file.name"
                />
            </div>
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-hw0krsr3]
    .pager-album-image
        position: relative
        min-height: 700px

        &:hover [data-v-bnqp3]
            opacity: 1

        img
            width: 100%
            border-radius: 5px
            pointer-events: none
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .3)
            position: absolute
            transition: opacity .3s ease-in-out
</style>