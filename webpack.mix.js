const mix = require('laravel-mix')
const path = require('path')

mix.ts('src/admin/main.ts', 'assets/admin.js').vue({ version: 3 })
    .ts('src/album/main.ts', 'assets/album.js').vue({ version: 3 })
    .sourceMaps()
    .disableNotifications()

mix.alias({
    '@admin': path.join(__dirname, 'src/admin'),
    '@album': path.join(__dirname, 'src/album'),
    '@shared': path.join(__dirname, 'src/shared'),
})
