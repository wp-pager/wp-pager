const mix = require('laravel-mix')
const path = require('path')

mix.ts('src/admin/main.ts', 'assets/admin.js').vue()
    .ts('src/album/main.ts', 'assets/album.js').vue()
    .sourceMaps()
    .disableNotifications()

mix.webpackConfig({
    resolve: {
        extensions: ['.vue', '.ts', '.js'],
        alias: {
            '@admin': __dirname + '/src/admin',
            '@album': __dirname + '/src/album',
            '@shared': __dirname + '/src/shared',
        }
    },
    module: {
        rules: [
            {
                test: /\.ts$/,
                loader: 'ts-loader',
                exclude: /node_module/,
                options: { appendTsSuffixTo: [/\.vue$/] }
            },
        ],
    },
})
