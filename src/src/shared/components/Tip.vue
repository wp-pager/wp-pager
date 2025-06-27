<script lang="ts" setup>
import Popper from 'vue3-popper'

interface Props {
    content: string
}

const props = defineProps<Props>()
</script>

<template>
    <slot v-if="props.content === ''" />

    <div v-else class="pager-tip">
        <Popper hover :content="props.content" class="pager-tip__popper">
            <slot />

            <template #content>
                <div class="pager-tip__popup">
                    {{ content }}
                </div>
            </template>
        </Popper>
    </div>
</template>

<style lang="sass" scoped>
:deep(.pager-tip__popper > div)
    display: inline-flex
    align-items: center

.pager-tip
    display: inline-flex
    align-items: center

    &__popper
        display: inline-flex !important
        align-items: center
        margin: 0 !important
        border: none !important

    &__popup
        background-color: rgba(0, 0, 0, .8)
        border-radius: 6px
        padding: 1.5px 12px
        color: white
        font-size: .9rem
        line-height: 1.4
        min-width: 100px
</style>