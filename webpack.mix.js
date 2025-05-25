const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Compilation des assets JS + SCSS + Tailwind CSS
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css') // Pour Bootstrap ou styles personnalisés
   .postCss('resources/css/app.css', 'public/css', [
       require('tailwindcss'),
   ]) // Pour Tailwind CSS
   .sourceMaps()
   .version();
