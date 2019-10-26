const cssImport = require('postcss-import');
const cssNesting = require('postcss-nesting');
const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.webpackConfig({
    output: {
        chunkFilename: 'js/chunks/[name].js',
    },
})
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        cssImport(),
        cssNesting(),
        tailwindcss(),
    ])
    .sourceMaps()
    .version();
