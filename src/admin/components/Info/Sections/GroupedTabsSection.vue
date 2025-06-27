<script setup lang="ts">
import InfoSection from '@admin/components/Info/InfoSection.vue'
</script>

<template>
    <InfoSection
        title="Group album tabs"
        :image="$pager.rootUrl + 'assets/img/info/group-album-tabs.jpg'"
    >
        <p>Grouped tabs are small links in your album tabs that appear only when there are more than one tab with the same title. As you can see on the image we have 3 pages of "Breakfasts", 2 images of "Burgers", etc. "Beer" and "Tea" do not have numbers because where have only 1 image with title of "Beer" and 1 image with the title of "Tea".</p>
        <p>It's done this way to make tabs more compact and remove duplicate titles. Currently, there is no way to disable this feature but we may add it in the future</p>
    </InfoSection>
</template>