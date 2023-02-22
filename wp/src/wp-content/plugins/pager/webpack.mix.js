const mix = require('laravel-mix')
const path = require('path')

mix.sass('resources/sass/main.sass', 'frontend/assets/nnl-pdf-main.css')
    .ts('resources/ts/forms/main.tsx', 'frontend/assets/nnl-forms.js').react()
    .ts('resources/ts/form/main.tsx', 'frontend/assets/nnl-form.js').react()
    .sourceMaps()
    .disableNotifications()

mix.alias({
    '@form': path.join(__dirname, 'resources/ts/form'),
    '@forms': path.join(__dirname, 'resources/ts/forms'),
    '@shared': path.join(__dirname, 'resources/ts/shared'),
})