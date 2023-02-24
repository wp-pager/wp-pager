<script lang="ts" setup>
type Props = {
    isDisabled: boolean
}

const props = defineProps<Props>()
</script>

<template>
    <button type="button" :class="{ 'disabled': props.isDisabled }">
        <slot />
    </button>
</template>

<style lang="sass" scoped>
button
    padding: 0.6rem 1.3rem
    border: 1px solid #ccc
    border-radius: 5px
    background-color: #fff
    cursor: pointer
    transition: all 0.2s ease-in-out
    text-transform: uppercase
    font-weight: bold

    &:hover
        background-color: #f3f3f3

    &.disabled
        cursor: not-allowed
        opacity: .5

        &:hover
            background-color: #fff
</style>