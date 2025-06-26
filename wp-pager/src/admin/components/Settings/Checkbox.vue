<script setup lang="ts">
import { ref } from 'vue'

type Emits = {
    (e: 'changed', value: boolean): void
}

type Props = {
    defaultValue: boolean
    id: string
}

const props = defineProps<Props>()

const emit = defineEmits<Emits>()
const value = ref<boolean>(props.defaultValue)
</script>

<template>
    <div class="pager-input">
        <input
            v-model="value"
            @change="emit('changed', value)"
            type="checkbox"
            :id="props.id"
        >

        <label :for="props.id">
            <slot />
        </label>
    </div>
</template>

<style lang="sass" scoped>
.pager-input
    display: flex
    align-items: center

    input
        margin-right: 0.5rem
</style>