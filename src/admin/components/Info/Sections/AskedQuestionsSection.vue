<script setup lang="ts">
import InfoSection from '@admin/components/Info/InfoSection.vue'
import useAskedQuestions from '@admin/composables/useAskedQuestions'

const { qaItems } = useAskedQuestions()
</script>

<template>
    <InfoSection
        title="Frequently Asked Questions"
    >
        <ul>
            <li v-for="item in qaItems" :key="item.question">
                <b>{{ item.question }}</b>
                <span>{{ item.answer }}</span>
            </li>
        </ul>
    </InfoSection>
</template>

<style lang="sass" scoped>
ul
    li
        margin-bottom: 15px

        b
            font-weight: bold
            font-size: 1.4em

            &::before
                content: '❓ '

        span
            display: block
            font-size: 1.2em
            margin-top: 3px
            border-left: 2px dotted gray
            margin-left: 10px
            padding-left: 20px
</style>