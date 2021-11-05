const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.postCss('resources/sb-admin-2/css/sb-admin-2.min.css', 'public/sb-admin-2/css/sb-admin-2.min.css');

mix.js('resources/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js', 'public/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js')
mix.js('resources/sb-admin-2/js/sb-admin-2.min.js', 'public/sb-admin-2/js/sb-admin-2.min.js')
mix.js('resources/assets/fund/js/index.js', 'public/assets/fund/js/index.js')
mix.js('resources/assets/fund/js/new.js', 'public/assets/fund/js/new.js')
mix.js('resources/assets/fund/js/edit.js', 'public/assets/fund/js/edit.js')
