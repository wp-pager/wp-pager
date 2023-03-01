<script setup lang="ts">
import Tip from '@shared/components/Tip.vue'

type Props = {
    tip: string
    icon: object
}

type Emits = {
    (e: 'clicked'): void
}

const emit = defineEmits<Emits>()
const props = defineProps<Props>()
</script>

<template>
    <Tip :content="props.tip">
        <button @click="emit('clicked')" type="button">
            <component :is="props.icon" />
        </button>
    </Tip>
</template>

<style lang="sass" scoped>
button
    width: 22px
    height: 22px
    background: none
    border: none
    padding: 0
    cursor: pointer
    outline: none
    transition: transform .1s ease-in-out, opacity .1s ease-in-out
    perspective: 1000px
    opacity: .7

    &:hover
        transform: scale(1.2)
        opacity: 1
</style>