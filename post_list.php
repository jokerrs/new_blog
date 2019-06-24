 <?php    

    // Pocetak sesije
    session_start();
    // Konekcija sa bazom podataka (MySql)
    require_once ("./konfiguracija.php");
    // Klasa korisnici.php
    require_once ("./klase/korisnici.php");

    if(!isset($_SESSION['uid'])){
                header('Location: login.php');;
    }else{
        $getUserDataBysession = new Users($conn);
        $UserData = $getUserDataBysession->getUser($_SESSION['uid']);
        foreach ($UserData as $User_data_value) {
            $username = $User_data_value['username'];
            $name = $User_data_value['name'];
            $lastname = $User_data_value['lastname'];
        }

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>
  <!-- Custom styles for this template -->
  <link href="./css/blog-post.css" rel="stylesheet">

</head>

<body>
      <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?= $linksajta ?>admin.php">Admin | <?= $name." ".$lastname; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."admin.php"; ?>">Pocetna</a></li>
          <li class="nav-item active" active><a class="nav-link" href="<?= $link_sajta."post_list.php"; ?>">Lista postova</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."add_new.php"; ?>">Dodaj novi post</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."edit.php"; ?>">Izmeni post</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."delete.php"; ?>">Obrisi post</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">



    <div class="row">

<style type="text/css">

.table td, .table th {
   text-align: center;   
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<div class="container">
    <table id="dtBasicExample" class="table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naslov</th>
                <th>Autor</th>
                <th>Sadrzaj</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Naslov</th>
                <th>Autor</th>
                <th>Sadrzaj</th>
            </tr>
        </tfoot>
    </table>
</div>

    <script type="text/javascript">

/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<div class=" align-items-center justify-content-center"><table cellpadding="5" cellspacing="0" border="0" class="row align-items-center justify-content-center">'+
              '<tr>'+
              '<td>'+
            '<a href="<?= $link_sajta."edit.php?id='+d.id+'"; ?>">'+
                '<button type="button" class="btn btn-primary">Izmeni post</button>'+
            '</a>'+
            '<form>'+
            '<input type="hidden" id="delete" name="'+d.id+'">'+
                '<button type="button" class="btn btn-danger">Obrisi post</button>'+
            '</form>'+
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
    var table = $('#dtBasicExample').DataTable( {
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
        "order": [[1, 'asc']],
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
    $('#dtBasicExample tbody').on('click', 'td.details-control', function () {
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
} );
    </script>
             
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->


  <!-- Footer -->
  <footer class="py-5 bg-dark ">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; <b>Zadatak 1</b> <?php echo date('Y'); ?></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->

</body>

</html>
<?php
    }

    ?>