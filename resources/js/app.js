import './bootstrap';

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

import $ from "jquery";
import "datatables.net";
import "datatables.net-dt/css/jquery.dataTables.min.css";

$(document).ready(function () {
    $("#example").DataTable();
});
