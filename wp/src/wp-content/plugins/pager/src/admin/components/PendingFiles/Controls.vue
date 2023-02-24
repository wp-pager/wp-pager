<script setup lang="ts">
import ControlButton from '@admin/components/PendingFiles/ControlButton.vue'
import UploadIcon from '@shared/components/Icons/UploadIcon.vue'
import CloseIcon from '@shared/components/Icons/CloseIcon.vue'
</script>

<template>
    <section>
        <ControlButton class="upload btn">
            <UploadIcon class="icon" /> Upload all
        </ControlButton>
        <ControlButton class="clear btn">
            <CloseIcon class="icon" /> Clear all
        </ControlButton>
    </section>
</template>

<style lang="sass" scoped>
section
    display: flex
    gap: .5rem

.btn
    display: flex
    align-items: center
    gap: 7px

    .icon
        width: 1.3rem
        height: 1.3rem

.upload
    color: #045b04

.clear
    color: #950909
</style>