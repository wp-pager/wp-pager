<script setup lang="ts">
type Props = {
    file: File
}

const props = defineProps<Props>()
const url = URL.createObjectURL(props.file)
</script>

<template>
    <section>
        <img
            :src="url"
            alt="Preview"
        />

        <span class="title" :title="props.file.name">{{ props.file.name }}</span>
    </section>
</template>

<style lang="sass" scoped>
section
    margin-top: 15px
    display: flex
    flex-direction: column
    justify-content: space-between
    background: rgba(255, 255, 255, .8)
    padding: 6px
    border-radius: 6px

img
    max-width: 100%
    max-height: 100%
    border-radius: 6px
    box-shadow: 2px 2px 7px rgba(0, 0, 0, .1)

.title
    margin: 8px 0 0 0
    font-size: .75rem
    color: #999
    overflow: hidden
    text-overflow: ellipsis
    white-space: nowrap
</style>
