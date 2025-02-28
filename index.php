<?php
// Konekcija sa bazom podataka (MySql)
require_once("./konfiguracija.php");
// Klasa korisnici.php
require_once("./klase/korisnici.php");
// Klasa za objave
require_once("./klase/objave.php");
// Pocetak sesije
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog Post - Start Bootstrap Template</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/blog-post.css" rel="stylesheet">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= $link_sajta ?>">Zadatak 1</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Pocetna
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item"><?php
                    if (isset($_SESSION['uid'])) {
                        echo "
            <a class=\"nav-link\" href=\"post_list.php\">Admin panel</a>";
                    } else { ?>
                        <a class="nav-link" href="login.php">Login</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Post Content Column -->
        <div class="col-lg-8">
            <?php
            if (!isset($_GET['stranica']) || empty($_GET['stranica'])) {
                include 'pocetna.php';
            } elseif ($_GET['stranica'] === 'post') {
                include "post.php";
            } elseif ($_GET['stranica'] === 'author') {
                include "author.php";
            }
            ?>
        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <?php
            function random_posts($conn, $link_sajta)
            {
                $random = $conn->prepare("SELECT id, title FROM articles ORDER BY RAND() LIMIT 5");
                $random->execute();
                foreach ($random as $random_posts) {
                    echo "<li><a href=\"" . $link_sajta . "index.php?stranica=post&objava=" . $random_posts['id'] . "\">" . $random_posts['title'] . "</a></li>";
                }
            }

            ?>
            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Nasumicni postovi</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <?php random_posts($conn, $link_sajta); ?>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <?php random_posts($conn, $link_sajta); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <b>Zadatak 1</b> <?php echo date('Y'); ?></p>
    </div>
    <!-- /.container -->
</footer>
<!-- Bootstrap core JavaScript -->
</body>
</html>
