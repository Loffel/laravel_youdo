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

mix.js('resources/js/app.js', 'public/js')
    // .combine([
    //     'resources/js/scripts/jquery-migrate-3.0.0.min.js',
    //     'resources/js/scripts/bootstrap-slider.min.js',
    //     'resources/js/scripts/bootstrap-select.min.js',
    //     'resources/js/scripts/clipboard.min.js',
    //     'resources/js/scripts/counterup.min.js',
    //     'resources/js/scripts/magnific-popup.min.js',
    //     'resources/js/scripts/mmenu.min.js',
    //     'resources/js/scripts/simplebar.min.js',
    //     'resources/js/scripts/slick.min.js',
    //     'resources/js/scripts/snackbar.js',
    //     'resources/js/scripts/tippy.all.min.js',
    //     'resources/js/scripts/custom.js'
    // ], 'public/js/bundle.min.js')
    .sass('resources/sass/app.scss', 'public/css');
