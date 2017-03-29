const { mix } = require('laravel-mix');

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

mix.js([
    'resources/assets/js/bootstrap.js',
    'resources/assets/js/libs/bootstrap.min.js',
    'resources/assets/js/libs/daterangepicker.js',
    'resources/assets/js/libs/jquery.dataTables.js',
    'resources/assets/js/libs/dataTables.bootstrap.min.js',
    'resources/assets/js/customScripts/smoothScroll.js',
    'resources/assets/js/customScripts/footerRelocate.js'
], 'public/js/libs.js')
    // .sass('resources/assets/sass/app.scss', 'public/css/sas.css')
   .styles([
       'resources/assets/css/libs/font-awesome.min.css',
       'resources/assets/css/libs/bootstrap.min.css',
       'resources/assets/css/libs/daterangepicker.css',
       'resources/assets/css/libs/dataTables.bootstrap.min.css',
       'resources/assets/css/libs/dropzone.css',
       'resources/assets/css/libs/sweetalert.css',
       'resources/assets/css/custom.css'
   ], 'public/css/public.css')
    .version();


