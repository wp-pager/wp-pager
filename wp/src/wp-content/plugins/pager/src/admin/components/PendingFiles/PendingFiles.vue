<script setup lang="ts">
import { computed } from 'vue'
import { useStore } from 'vuex'
import PendingFile from '@admin/components/PendingFiles/PendingFile.vue'
import Controls from '@admin/components/PendingFiles/Controls.vue'

const store = useStore()
const files = computed<File[]>(() => store.getters['pendingFiles/files'])
</script>

<template>
    <div data-v-f3f0egk>
        <Controls />

        <div class="files">
            <PendingFile
                v-for="file in files"
                :key="file.name"
                :file="file"
            />
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-f3f0egk]
    margin-top: 15px

    .files
        margin-top: 15px
        display: grid
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr))
        grid-gap: 1rem
</style>