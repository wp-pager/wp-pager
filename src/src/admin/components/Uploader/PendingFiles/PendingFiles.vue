<script setup lang="ts">
import { computed } from 'vue'
import { useStore } from 'vuex'
import PendingFile from '@admin/components/Uploader/PendingFiles/PendingFile.vue'
import Controls from '@admin/components/Uploader/PendingFiles/Controls.vue'

const store = useStore()
const files = computed<File[]>(() => store.getters['pendingFiles/files'])
</script>

<template>
    <div data-v-f3f0egk>
        <Controls />

        <div class="pager-files">
            <PendingFile v-for="file in files" :key="file.name" :file="file" />
        </div>
    </div>
</template>

<style lang="scss" scoped>
[data-v-f3f0egk] {
    margin-top: 15px;

    .pager-files {
        margin-top: 15px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        grid-gap: 1rem;
    }
}
</style>
