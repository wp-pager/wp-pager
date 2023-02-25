<script setup lang="ts">
import type { ImageFile } from '@shared/types'
import { computed } from 'vue'
import { useStore } from 'vuex'
import Btn from '@admin/components/Btn.vue'
import DeleteIcon from '@shared/components/Icons/DeleteIcon.vue'

const store = useStore()
const files = computed<ImageFile[]>(() => store.getters['files/files'])
const loading = computed<boolean>(() => store.getters['files/loading'])

function deleteAllFiles(): void {
    if (loading.value || files.value.length === 0)
        return

    store.dispatch('files/deleteAllFiles')
}
</script>

<template>
    <div data-v-01fk3851k>
        <Btn
            @click="deleteAllFiles"
            class="pager-btn"
            :isDisabled="files.length === 0 || loading"
            color="red"
        >
            <DeleteIcon class="pager-icon" />
            Delete All
        </Btn>
    </div>
</template>

<style lang="sass" scoped>
[data-v-01fk3851k]
    margin-bottom: 1.4rem

    .pager-btn
        display: flex
        align-items: center
        gap: 7px

        .pager-icon
            width: 17px
            height: 17px
</style>