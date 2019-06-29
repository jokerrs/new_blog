<?php    

  // Pocetak sesije
    session_start();
  // Konekcija sa bazom podataka (MySql)
    require_once ("./konfiguracija.php");
    // Klasa korisnici.php
    require_once ("./klase/korisnici.php");

    if(!isset($_SESSION['uid'])){
          header('Location: login.php');
    }else{
      $getUserDataBysession = new Users($conn);
      $UserData = $getUserDataBysession->getUser($_SESSION['uid']);
      foreach ($UserData as $User_data_value) {
        $username = $User_data_value['username'];
        $name = $User_data_value['name'];
        $lastname = $User_data_value['lastname'];
      }
    if(!isset($_GET['id'])){
        header('Location: post_list.php');
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
            <a class="navbar-brand" href="<?= $linksajta ?>admin.php">Admin |
                <?= $name." ".$lastname; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= $link_sajta; ?>">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."admin.php"; ?>">Pocetna</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."post_list.php"; ?>">Lista postova</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."add_new.php"; ?>">Dodaj novi post</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        </div>
        <!-- /.row -->
        <script src="./js/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="py-5 bg-dark">
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