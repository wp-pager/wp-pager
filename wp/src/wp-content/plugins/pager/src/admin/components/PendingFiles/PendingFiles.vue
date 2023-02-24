<script setup lang="ts">
import { computed } from 'vue'
import { useStore } from 'vuex'
import PendingFile from '@admin/components/PendingFiles/PendingFile.vue'
import Controls from '@admin/components/PendingFiles/Controls.vue'

const store = useStore()
const files = computed<File[]>(() => store.getters['pendingFiles/files'])
</script>

<template>
    <section>
        <Controls />

        <div class="files">
            <PendingFile
                v-for="file in files"
                :key="file.name"
                :file="file"
            />
        </div>
    </section>
</template>

<style lang="sass" scoped>
section
    margin-top: 15px

.files
    display: grid
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr))
    grid-gap: 1rem
</style>