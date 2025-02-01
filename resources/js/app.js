import "bootstrap";

import "datatables.net-dt/css/jquery.dataTables.min.css";

import dt from "datatables.net"; // Import DataTables JS

import jQuery from "jquery";
window.$ = jQuery;

$(function () {
    $("#example").DataTable();
});
