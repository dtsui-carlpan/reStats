var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var pathDir = 'vendor/bower_components/';


elixir(function(mix) {
    mix.sass('app.scss')
        .copy(
            pathDir + 'jquery/dist/jquery.min.js',
            'public/js/vendor/jquery.js'
    )
        .copy(
            pathDir + 'bootstrap-sass-official/assets/javascripts/bootstrap.js',
            'public/js/vendor/bootstrap.js'
    )
        .copy(
            pathDir + 'font-awesome/css/font-awesome.min.css',
            'public/css/vendor/font-awesome.css'
    )
        .copy(
            pathDir + 'font-awesome/fonts',
            'public/css/fonts'
    )
        .copy(
            pathDir + 'angular/angular.min.js',
            'public/js/vendor/angular.js'
    );
});
