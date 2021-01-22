/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/frontend.css';
import './styles/login.css';

import './lib/jquery-3.5.1/jquery.min.js';


// start the Stimulus application
import './bootstrap';

window.jQuery = $;
console.log('Hello Webpack Encore frontend urca');