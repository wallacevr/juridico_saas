const mix = require('laravel-mix');

require('laravel-mix-tailwind');

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

mix.js('resources/js/tenant.js', 'public/js')
   .postCss('resources/css/tenant.css', 'public/css')
   .tailwind('./tailwind.config.js');

   mix.js('resources/js/store.js', 'public/js')
   .postCss('resources/css/store.css', 'public/css')
   .tailwind('./tailwind.config.js');

   mix.js('resources/js/central.js', 'public/js')
   .postCss('resources/css/central.css', 'public/css')
   .tailwind('./tailwind.config.js');

if (mix.inProduction()) {
  mix
   .version();
}
