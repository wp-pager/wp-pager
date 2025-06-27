<script setup lang="ts">
import { useStore } from 'vuex'
import CloseIcon from '@shared/components/Icons/CloseIcon.vue'
import Tip from '@shared/components/Tip.vue'

type Props = {
    file: File
}

const props = defineProps<Props>()

const store = useStore()

function removeFile() {
    store.dispatch('pendingFiles/removeFile', props.file.name)
}
</script>

<template>
    <button type="button" @click="removeFile">
        <Tip content="Remove image from uploading">
            <CloseIcon class="pager-icon" />
        </Tip>
    </button>
</template>

<style lang="scss" scoped>
button {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    width: 100%;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 0;
    z-index: 1;
    border: none;
    cursor: pointer;
    outline: none;
    opacity: 0;
    transition: opacity 100ms ease-in-out;

    .pager-icon {
        width: 40px;
        height: 40px;
    }
    &:hover {
        opacity: 0.8;
    }
}
</style>
