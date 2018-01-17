let mix = require('laravel-mix');

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
//css

//js
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/easy_responsive_tabs.js', 'public/js');
mix.js('resources/assets/js/imagezoom.js', 'public/js');
mix.js('resources/assets/js/jquery.easydropdown.js', 'public/js');
mix.js('resources/assets/js/jquery.flexslider.js', 'public/js');
mix.js('resources/assets/js/jquery.nicescroll.js', 'public/js');
mix.js('resources/assets/js/order.js', 'public/js');
mix.js('resources/assets/js/profile.js', 'public/js');
mix.js('resources/assets/js/sort.js', 'public/js');
mix.js('resources/assets/js/paginate_ajax.js', 'public/js');
// mix.js('resources/assets/js/basket.js', 'public/js');
mix.js('resources/assets/js/review.js', 'public/js');
mix.js('resources/assets/js/search.js', 'public/js');
mix.js('resources/assets/js/jquery-ui.js', 'public/js');
mix.js('resources/assets/js/validate.js', 'public/js');

