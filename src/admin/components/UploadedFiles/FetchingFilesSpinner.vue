<script setup lang="ts">
import Spinner from '@shared/components/Spinner.vue'
</script>

<template>
    <div data-v-piq81ndlq>
        <div v-for="i in 4" :key="i" class="pager-placeholder">
            <Spinner />
        </div>
    </div>
</template>

<style lang="sass" scoped>
[data-v-piq81ndlq]
    display: grid
    grid-template-columns: repeat(auto-fill, 300px)
    grid-gap: 1rem

    .pager-placeholder
        height: 300px
        background-color: rgba(255, 255, 255, 0.6)
        border-radius: 5px
        animation: pager-loading 700ms infinite ease-in-out
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1)
        display: flex
        align-items: center
        justify-content: center

    @keyframes pager-loading
        0%
            opacity: 0.3
        50%
            opacity: 1
        100%
            opacity: 0.3
</style>