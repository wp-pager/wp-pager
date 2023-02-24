<script setup lang="ts">
import Spinner from '@shared/components/Spinner.vue'
</script>

<template>
    <section>
        <div v-for="i in 4" :key="i" class="placehoder">
            <Spinner />
        </div>
    </section>
</template>

<style lang="sass" scoped>
.placehoder
    height: 300px
    background-color: rgba(255, 255, 255, 0.6)
    border-radius: 5px
    animation: loading 700ms infinite ease-in-out
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1)
    display: flex
    align-items: center
    justify-content: center

@keyframes loading
    0%
        opacity: 0.3
    50%
        opacity: 1
    100%
        opacity: 0.3
</style>