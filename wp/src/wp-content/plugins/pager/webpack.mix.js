const mix = require('laravel-mix')
const path = require('path')

mix.ts('src/main.ts', 'frontend/main.js')
    .vue()
    .sourceMaps()
    .disableNotifications()

mix.webpackConfig({
    resolve: {
        extensions: ['.vue', '.ts', '.js'],
        alias: {
            '@': __dirname + '/src',
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
