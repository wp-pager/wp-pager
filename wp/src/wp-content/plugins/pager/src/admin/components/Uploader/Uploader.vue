<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'

type Emits = {
    (e: 'selected', files: File[]): void
}

const emit = defineEmits<Emits>()

const drag = ref(false)

function startDragging(e: DragEvent): void {
    drag.value = true
}

function dropImage(e: DragEvent): void {
    if (!e.dataTransfer) {
        return
    }

    drag.value = false
    const imageFiles = Array.from(e.dataTransfer.files)

    emit('selected', imageFiles)
}
</script>

<template>
    <div>
        <section
            @dragover.prevent="startDragging"
            @dragleave.self="drag = false"
            @drop.self.prevent="dropImage"
            :class="{ 'drag': drag }"
        >
            <h2 v-if="drag">Release files...</h2>
            <h2 v-else>Drop your files...</h2>
        </section>
    </div>
</template>

<style lang="sass" scoped>
section
    border: 4px dashed rgba(0, 0, 0, .2)
    padding: 7px
    border-radius: 7px
    display: flex
    justify-content: center
    align-items: center
    max-width: 700px
    height: 200px
    background-color: rgba(0, 0, 0, .02)
    cursor: pointer
    transition: background-color .2s ease-in-out

    &.drag
        background-color: rgba(255, 255, 255, .7)
        border-color: rgba(0, 0, 0, .5)

    &:hover
        background-color: rgba(0, 0, 0, .04)
        border-color: rgba(0, 0, 0, .3)

    &:hover h2
        color: rgba(0, 0, 0, .7)

    h2
        font-size: 1.5rem
        font-weight: 500
        color: rgba(0, 0, 0, .5)
        pointer-events: none
</style>
