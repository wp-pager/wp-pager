<script setup lang="ts">
type Props = {
    url: string
    name: string
}

const props = defineProps<Props>()
</script>

<template>
    <div data-v-01klabn74la>
        <div class="pager-card">
            <slot name="top" />

            <img :src="props.url" :alt="props.name" />

            <slot />
        </div>

        <span class="pager-title" :title="props.name">
            {{ props.name }}
        </span>
    </div>
</template>

<style lang="scss" scoped>
[data-v-01klabn74la] {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: rgba(255, 255, 255, 0.8);
    padding: 6px;
    border-radius: 6px;
    box-shadow: 2px 2px 7px rgba(0, 0, 0, 0.07);

    .pager-card {
        position: relative;

        img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 6px;
            box-shadow: 2px 2px 7px rgba(0, 0, 0, 0.1);
        }
    }
}
</style>
