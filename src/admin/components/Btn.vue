<script lang="ts" setup>
type Props = {
    isDisabled: boolean
    color: 'red' | 'default'
}

const props = defineProps<Props>()
</script>

<template>
    <button
        type="button"
        :class="{
            'pager-disabled': props.isDisabled,
            'pager-red': props.color === 'red',
            'pager-default': props.color === 'default'
        }"
    >
        <slot />
    </button>
</template>

<style lang="sass" scoped>
button
    padding: 0.6rem 1.3rem
    border-radius: 5px
    cursor: pointer
    transition: all 0.2s ease-in-out
    text-transform: uppercase
    font-weight: bold
    border: none
    color: #fff
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2)

    &.pager-red
        background-color: #d05045

        &:hover
            background-color: #be5148

    &.pager-default
        background-color: #fff
        color: #000

        &:hover
            background-color: #f5f5f5

    &.pager-disabled
        cursor: not-allowed
        opacity: .5
</style>