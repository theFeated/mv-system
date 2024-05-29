//Allow the tables to be reponsive and to make sure there are no conflict if the the script
// is called more than once on a script
$(document).ready(function() {
    var table = $('#recordTable').DataTable( {
        responsive: true
    } );

    new $.fn.dataTable.FixedHeader( table );
} );

$(document).ready(function() {
    var table = $('#recordTableTwo').DataTable( {
        responsive: true
    } );

    new $.fn.dataTable.FixedHeader( table );
} );

$(document).ready(function() {
    var table = $('#recordTableThree').DataTable( {
        responsive: true
    } );

    new $.fn.dataTable.FixedHeader( table );
} );