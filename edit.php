<?php    

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Pocetak sesije
    session_start();
    // Konekcija sa bazom podataka (MySql)
    require_once ("./konfiguracija.php");
    // Klasa korisnici.php
    require_once ("./klase/korisnici.php");
    // Klasa korisnici.php
    require_once ("./klase/objave.php");

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
                    <li class="nav-item active" active><a class="nav-link" href="<?= $link_sajta."add_new.php"; ?>">Dodaj novi post</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
             <?php 
                $update_post = new Articles($conn);
                $res = $update_post->getArticle((int)$_GET['id']);

                foreach ($res as $update_post_value) {
                
                  echo '
                            <div class="col-lg-8 center">
                    <form id="EditArticle" method="POST">
                        <div id="success" class="alert alert-success" style="display:none">
                            <strong>Uspesno</strong> ste izmenili objavu. Mozete pogledati clanak <a href="'.$link_sajta.'index.php?stranica=post&objava='.$_GET['id'].'">ovde</a>
                        </div>
                        <div id="invalid" class="alert alert-danger" style="display:none">
                            <strong>Greska!</strong><span id="invalidM"></span>
                        </div>
                        <label for="title">Naslov</label>
                        <input class="form-control" value="'.$update_post_value['title'].'" id="title" name="title" type="text" required>
                        <div class="form-group">
                            <label for="content">Sadrzaj</label>
                            <textarea class="form-control" id="content" name="content" rows="15">'.stripslashes($update_post_value['content']).'</textarea>
                        </div>

                    <input class="form-control" type="hidden" id="author_id" name="author_id" value="'.$_SESSION['uid'].'">
                    <input class="form-control" type="hidden" id="article_id" name="article_id" value="'.$_GET['id'].'">
                    <span id="span_image">
                      <input class="form-control" type="hidden" id="main_image" name="main_image" value="'.$update_post_value['main_image'].  '">
                    </span>
                        <button type="submit" class="btn btn-primary">Izmeni</button>
                    </form>
                </div>
                <div class="col-lg-4 center">
                    <br /><br />
                    <form id="imageUpload">
                        <span id="uploaded_image"><img src="'.$update_post_value['main_image'].'" class="img-thumbnail" /></span><br />
                        <input id="file" type="file" accept="image/*" name="file" /><br />
                        <form>
                </div>
                  ';
                }
              ?>
        </div>
        <!-- /.row -->
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
    <!-- JavaScript -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/tinymce/tinymce.min.js"></script>
    <script src="./js/tinymce/jquery.tinymce.min.js"></script>
    <script src="./js/tinymce.js"></script>
    <script type="text/javascript" src="./js/edit.js"></script>
</body>

</html>
<?php
    }

    ?>