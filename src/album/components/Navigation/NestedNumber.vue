<script setup lang="ts">
import type { ImageFile } from '@shared/types'

type Props = {
    file: ImageFile
    number: number
}

type Emits = {
    (e: 'clicked'): void
}

const emit = defineEmits<Emits>()
const props = defineProps<Props>()
</script>

<template>
    <button
        class="pager-tab-number"
        @click="emit('clicked')"
        :class="{ 'pager-active': props.file.visible }"
    >
        {{ props.number }}
    </button>
</template>

<style lang="sass" scoped>
$active: #6da816

.pager-tab-number
    border-radius: 2px
    border: none
    padding: 1px
    min-width: 20px
    display: inline-block
    background-color: #c5c5c5
    color: white
    margin-left: 2px
    cursor: pointer
    transition: background-color .1s ease-in-out

    &:hover
        background-color: $active

    &.pager-active
        background-color: $active
</style>