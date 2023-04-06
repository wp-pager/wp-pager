<script setup lang="ts">
type Props = {
    title: string
    image?: string
}

const { title, image } = defineProps<Props>()
</script>

<template>
    <section data-v-v9pqnch4>
        <h3>{{ title }}</h3>

        <img
            v-if="image"
            :src="image"
            class="pager-info-image"
        />

        <slot />
        <hr />
    </section>
</template>

<style lang="sass" scoped>
[data-v-v9pqnch4]
    h3
        font-size: 1.5em

    :deep(p)
        font-size: 1.2em

    .pager-info-image
        width: auto
        heght: 100px
        margin: 10px 0
</style>