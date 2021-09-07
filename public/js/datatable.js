// DATATABLE
$(document).ready( function () {
    $('#myTable').dataTable( {
        "columnDefs": [
            { type: "html", targets: 0 }
        ]
    } );
});