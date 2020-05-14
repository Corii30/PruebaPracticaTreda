const mix = require('laravel-mix');

mix.scripts([
    'resources/js/assets/jquery.js',
    'resources/js/assets/toastr.js',
    'resources/js/assets/axios.js',
    'resources/js/assets/fontawesome.js',
    'resources/js/assets/app.js',
], 'public/js/app.js')
   .styles([
       'resources/sass/app.scss',
       'resources/css/toastr.css',
], 'public/css/app.css');
