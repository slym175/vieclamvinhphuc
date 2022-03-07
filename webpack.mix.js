const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/public/js/app.js', 'public/assets/public/js')
    .sass('resources/public/sass/app.scss', 'public/assets/public/css')
    .sourceMaps();
mix.js('resources/admin/js/app.js', 'public/assets/admin/js')
    .sass('resources/admin/sass/app.scss', 'public/assets/admin/css')
    .sourceMaps();
