/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import './lib/fontawesome-5.12.1/css/all.css';
import './lib/AdminLTE-3.0.5/dist/css/adminlte.min.css';
import './styles/backend.css';

import './lib/jquery-3.5.1/jquery.min.js';
import './lib/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js';
import './lib/AdminLTE-3.0.5/dist/js/adminlte.min.js';


// start the Stimulus application
import './bootstrap';

window.jQuery = $;
// window.$ = $;
console.log('Hello Webpack Encore Backend !');

