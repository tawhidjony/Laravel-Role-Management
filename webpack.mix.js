const mix = require('laravel-mix');

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

/* mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
 */

 mix.styles([
   'public/assets/adminlte/css/adminlte.min.css',
   'public/assets/plugins/fontawesome-free/css/fontawesome.css',
   'public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
   'public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
   'public/assets/plugins/daterangepicker/daterangepicker.css',
   'public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
   'public/assets/plugins/bootstrap-treeview-checkbox/css/roles.css',
   'public/assets/custom/css/style.css',
], 'public/css/all.css');

 mix.scripts([
    'public/assets/plugins/jquery/jquery.min.js',
    'public/assets/plugins/jquery-ui/jquery-ui.min.js',
    'public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'public/assets/plugins/moment/moment.min.js',
    'public/assets/plugins/daterangepicker/daterangepicker.js',
    'public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    'public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    'public/assets/plugins/bootstrap-treeview-checkbox/js/bootstrap-checkbox-tree.js',
    'public/assets/adminlte/js/adminlte.min.js',
    'public/assets/custom/js/style.js',
],  'public/js/all.js');


