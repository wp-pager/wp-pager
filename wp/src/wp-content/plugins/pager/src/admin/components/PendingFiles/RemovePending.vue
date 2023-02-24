<script setup lang="ts">
type Emits = {
    (e: 'remove'): void
}

const emit = defineEmits<Emits>()
</script>

<template>
    <button
        type="button"
        @click="emit('remove')"
    >
        <img :src="`${$pager.ajaxUrl}assets/img/icons/close.svg`" alt="Remove" />
    </button>
</template>

<style lang="sass" scoped>

</style>

