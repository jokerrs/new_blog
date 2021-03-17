<?php
// Pocetak sesije
session_start();
// Konekcija sa bazom podataka (MySql)
require_once("./konfiguracija.php");
// Klasa korisnici.php
require_once("./klase/korisnici.php");
if (!isset($_SESSION['uid'])) {
    header('Location: login.php') and die();
}
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
    <!-- Custom styles for this template -->
    <link href="./css/blog-post.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= $link_sajta ?>admin.php">Admin |
            <?= $name . " " . $lastname; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="<?= $link_sajta; ?>">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $link_sajta . "post_list.php"; ?>">Lista postova</a>
                </li>
                <li class="nav-item active" active><a class="nav-link" href="<?= $link_sajta . "add_new.php"; ?>">Dodaj
                        novi post</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 center">
            <form id="insertArticle" method="POST">
                <div id="success" class="alert alert-success" style="display:none">
                    <strong>Uspesno</strong> ste dodali novi post.
                </div>
                <div id="invalid" class="alert alert-danger" style="display:none">
                    <strong>Greska!</strong><span id="invalidM"></span>
                </div>
                <label for="title">Naslov</label>
                <input class="form-control" id="title" name="title" type="text" required>
                <div class="form-group">
                    <label for="content">Sadrzaj</label>
                    <textarea class="form-control" id="content" name="content" rows="15"></textarea>
                </div>
                <input class="form-control" type="hidden" id="author_id" name="author_id"
                       value="<?= $_SESSION['uid'] ?>">
                <span id="span_image"></span>
                <button type="submit" class="btn btn-primary">Unesi</button>
            </form>
        </div>
        <div class="col-lg-4 center">
            <br/><br/>
            <form id="imageUpload">
                <span id="uploaded_image"><label for="file">Izaberite glavnu sliku</label></span><br/>
                <input id="file" type="file" accept="image/*" name="file"/><br/>
                <span id="uploaded_image"></span>
                <form>
        </div>
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
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="./js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="./js/tinymce.js"></script>
<script type="text/javascript" src="./js/add_new.js"></script>
</body>
</html>