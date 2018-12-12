//const mix = require('laravel-mix');
const { mix } = require('laravel-mix')
//let src_path = 'resources/assets/js/';

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
 mix.webpackConfig({
   resolve: {
     extensions: ['.js', '.vue', '.json'],
     alias: {
       //'vue$': 'vue/dist/vue.esm.js',
       '@': __dirname + '/resources/js'
     },
   },
 })

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
