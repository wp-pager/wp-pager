const mix = require('laravel-mix')
const path = require('path')

mix.ts('src/main.ts', 'frontend/assets/main.js')
    .svelte()
    .sourceMaps()
    .disableNotifications()

mix.alias({
    '@': path.join(__dirname, 'src'),
})