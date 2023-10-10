const mix = require('laravel-mix');

mix.copy('resources/assets/fonts', 'public/fonts');
mix.copy('node_modules/lightbox2/src', 'public/lightbox')
