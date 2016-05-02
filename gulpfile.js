var elixir = require('laravel-elixir');

var paths = {
    'jquery': 'bower_components/jquery/dist',
    'bootstrap': 'bower_components/bootstrap/dist',
    'dataTables': 'bower_components/datatables/media',
    'fontawesome': 'bower_components/font-awesome',
    'sweetalert': 'bower_components/sweetalert/dist',
};


elixir(function (mix) {


    mix.styles([
        '../../../' + paths.bootstrap + '/css/bootstrap.css',
        '../../../' + paths.sweetalert + '/sweetalert.css',
        'bootstrap-timepicker.css',
        'datepicker3.css',
        'star-rating.css',
        'site.css',
    ], 'public/css/site.css');


    mix.scripts([
        '../../../' + paths.jquery + '/jquery.js',
        '../../../' + paths.bootstrap + '/js/bootstrap.js',
        '../../../' + paths.sweetalert + '/sweetalert-dev.js',
        'bootstrap-datepicker.js',
        'bootstrap-timepicker.js',
        'star-rating.js',
        'site.js'
    ], 'public/js/site.js');

    //concatenate file.css
    mix.styles([
        '../../../' + paths.bootstrap + '/css/bootstrap.css',
        'admin/font-awesome.min.css',
        'admin/AdminLTE.min.css',
        'admin/_all-skins.min.css',
        '../../../' + paths.sweetalert + '/sweetalert.css',
        'admin/site.css'
    ], 'public/css/admin.css');

    mix.scripts([
        '../../../' + paths.jquery + '/jquery.js',
        '../../../' + paths.bootstrap + '/js/bootstrap.js',
        'admin/app.min.js',
        '../../../' + paths.sweetalert + '/sweetalert-dev.js',
        'site.js'
    ], 'public/js/admin.js');

});
