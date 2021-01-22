/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './lib/DataTables-1.10.21/DataTables-1.10.21/css/jquery.dataTables.min.css';
import './lib/DataTables-1.10.23/DataTables-1.10.23/css/dataTables.bootstrap4.min.css';
import './lib/DataTables-1.10.23/Responsive-2.2.7/css/responsive.bootstrap4.min.css';

import './lib/DataTables-1.10.23/DataTables-1.10.23/js/jquery.dataTables.min';
import './lib/DataTables-1.10.23/DataTables-1.10.23/js/dataTables.bootstrap4.min';
import './lib/DataTables-1.10.23/Responsive-2.2.7/js/dataTables.responsive.min';
import './lib/DataTables-1.10.23/Responsive-2.2.7/js/responsive.bootstrap4.min';

$(document).ready(function () {
    $('#tableMessagesEnvoyes').DataTable(
        {
            processing: false,
            serverSide: false,
            responsive: true,
            order: [[ 0, "desc" ]],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            columns: [
                {width: '5%', orderable: true, title: "N°", visible: true},
                {width: '5%', orderable: true, title: "Destinataire", visible: true},
                {width: '5%', orderable: true, title: "Objet", visible: true},
                {width: '5%', orderable: true, title: "Documents", visible: true},
                {width: '5%', orderable: true, title: "Date d'envoi", visible: true},
                {width: '5%', orderable: false, title: "Actions", visible: true},
            ],
        }
    );
    $('#tableMessagesRecus').DataTable(
        {
            processing: false,
            serverSide: false,
            responsive: true,
            order: [[ 0, "desc" ]],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            columns: [
                {width: '5%', orderable: true, title: "N°", visible: true},
                {width: '5%', orderable: true, title: "Expéditeurs", visible: true},
                {width: '5%', orderable: true, title: "Objet", visible: true},
                {width: '5%', orderable: true, title: "Documents", visible: true},
                {width: '5%', orderable: true, title: "Date de réception", visible: true},
                {width: '5%', orderable: false, title: "Actions", visible: true},
            ],
        }
    );
});
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
// window.jQuery = $;
// // window.$ = $;
console.log('Hello Webpack Encore Datatables !');
