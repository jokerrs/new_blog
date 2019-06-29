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
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/blog-post.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= $linksajta ?>admin.php">Admin |
                <?= $name." ".$lastname; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= $link_sajta; ?>">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."admin.php"; ?>">Pocetna</a></li>
                    <li class="nav-item active" active><a class="nav-link" href="<?=$link_sajta."post_list.php"; ?>">Lista postova</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."add_new.php"; ?>">Dodaj novi post</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <style type="text/css">
            .table td,
            .table th {
                text-align: center;
            }
            </style>
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
            <div class="container">
                <table id="post_list" class="table table-striped table-bordered" width="100%">
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
            <script type="text/javascript" src="./js/post_list.js"></script>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="py-5 bg-dark ">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; <b>Zadatak 1</b>
                <?php echo date('Y'); ?>
            </p>
        </div>
        <!-- /.container -->
    </footer>
    <!-- Bootstrap core JavaScript -->
</body>

</html>
<?php
    }

    ?>