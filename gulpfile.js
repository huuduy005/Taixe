var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    //concatenate file.css
    mix.styles([
        'app.css',
        'custom.css'
    ], null, 'public/css')
        .styles([
            'libs/bootstrap-timepicker.css',
            'libs/star-rating.css',
            'libs/sweetalert.css'
        ],'public/css/libs.css')
        .styles([
          'admin/bootstrap.min.css',
          'admin/elegant-icons-style.css',
          'admin/font-awesome.min.css',
          'admin/style.css'
        ],'public/css/admin.css');

    //concatenate file.js
    mix.scripts([
        'jquery.js',
        'bootstrap.min.js',
    ], null, 'public/js')
        .scripts([
            'libs/star-rating.js',
            'libs/bootstrap-datepicker.js',
            'libs/bootstrap-timepicker.js',
            'libs/sweetalert-dev.js',
        ],'public/js/libs.js');

});
