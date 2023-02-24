<script setup lang="ts">

</script>

<template>
    <div>
        <section>
            <h2>Drop your files...</h2>
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

    &:hover
        background-color: rgba(0, 0, 0, .04)
        border-color: rgba(0, 0, 0, .3)

    &:hover h2
        color: rgba(0, 0, 0, .7)

    h2
        font-size: 1.5rem
        font-weight: 500
        color: rgba(0, 0, 0, .5)
</style>
