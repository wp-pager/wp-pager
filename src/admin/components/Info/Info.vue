<script setup lang="ts">
import PageTitle from '@admin/components/PageTitle.vue'
import PageIntro from '@admin/components/PageIntro.vue'
import GroupedTabsSection from '@admin/components/Info/Sections/GroupedTabsSection.vue'
import AboutSection from '@admin/components/Info/Sections/AboutSection.vue'
</script>

<template>
    <div data-v-kcqpg38whf>
        <PageTitle>ℹ️ Info</PageTitle>
        <PageIntro>
            Learn about WP Pager and how to use it effectively.
        </PageIntro>

        <hr />

        <div class="pager-tab-content">
            <AboutSection />
            <GroupedTabsSection />
        </div>
    </div>
</template>

<style lang="sass" scoped>
</style>