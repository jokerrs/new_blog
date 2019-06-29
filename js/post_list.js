
/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<div class=" align-items-center justify-content-center"><table cellpadding="5" cellspacing="0" border="0" class="row align-items-center justify-content-center">'+
              '<tr>'+
              '<td>'+
            '<a href="<?= $link_sajta."edit.php?id='+d.id+'"; ?>">'+
                '<button type="button" class="btn btn-primary">Izmeni post</button>'+
            '</a>'+
                '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'+d.id+'">Obrisi</button>'+
        '</td>'+
        '</tr>'+ 
        '<tr>'+
            '<td>'+d.content+'</td>'+ 
        '</tr>'+
        '<tr>'+
            '<td>'+d.created_time+'</td>'+
        '</tr>'+
    '</table></div>';
}
 
$(document).ready(function() {

    var table = $('#post_list').DataTable( {
        "ajax": "http://localhost/novi_projekat/api/articles/read.php",
        "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "author" },
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '<a href="#">Pogledaj ceo sadrzaj/Izmeni/Obrisi</a>'
            },
        ],
        "rowId" : "id",
        "order": [[0, 'asc']],
                initComplete: function () {
            this.api().columns([2]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
     
    // Add event listener for opening and closing details
    $('#post_list tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

    $('#post_list tbody').on('click', '.delete', function(){
        var id = JSON.stringify({ 
        id:$(".delete").attr('id'),
      });
        var idRow = $(".delete").attr('id');
       
          Swal.fire({
            title: 'Da li ste sigurni da zelite da obriste ovaj post?',
            text: "Necete moci da opozovete ovu opciju!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'DA, obrisi!',
            cancelButtonText: 'NE!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: "http://localhost/novi_projekat/api/articles/delete.php",
                method: "POST",
                data: id,
                statusCode: {
                 200: function(){
                    Swal.fire(
                        'Obrisano!',
                        'Post je uspesno obrisan!',
                        'success'
                      );
                    table.row('#'+idRow).remove().draw()
                   },
                  403: function(){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Niste autor ovog posta, mozete da obrisete samo svoje postove!'
                      })
                  }
                }
              })
              
            }
          })


        
    });
});