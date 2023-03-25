<script setup lang="ts">
import { ref } from 'vue'

type Emits = {
    (e: 'changed', value: boolean): void
}

type Props = {
    type: 'text' | 'email' | 'password'
    inputWidth: number
    defaultValue: string
    id: string
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const value = ref<string>(props.defaultValue)
</script>

<template>
    <div class="pager-input">
        <label :for="props.id">
            <slot />
        </label>

        <input
            v-model="value"
            @blur="emit('changed', value)"
            :id="props.id"
            :type="props.type"
            :style="{ width: props.inputWidth + 'px' }"
        >

        <slot name="after" />
    </div>
</template>

<style lang="sass" scoped>
.pager-input
    label
        display: block
        font-weight: bold
        margin-bottom: 1px
</style>