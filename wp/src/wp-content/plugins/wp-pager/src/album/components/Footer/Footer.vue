<script setup lang="ts">
import SoundToggle from '@album/components/Footer/SoundToggle.vue'
import DownloadFile from '@album/components/Footer/DownloadFile.vue'
import Copyright from '@album/components/Footer/Copyright.vue'
import InfoModalTrigger from '@album/components/Footer/InfoModalTrigger.vue'
</script>

<template>
    <div data-v-go094ik>
        <div class="pager-buttons">
            <InfoModalTrigger />
            <SoundToggle />
            <DownloadFile />
        </div>

        <Copyright />
    </div>
</template>

<style lang="sass" scoped>
[data-v-go094ik]
    display: flex
    justify-content: space-between
    align-items: center
    padding: 10px 10px
    background-color: white
    border-radius: 0 0 8px 8px
    overflow: visible

    .pager-buttons
        display: flex
        align-items: center
        gap: 13px
</style>