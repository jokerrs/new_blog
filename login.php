<?php    
// Pocetak sesije
    session_start();
    // Konekcija sa bazom podataka (MySql)
    require_once ("./konfiguracija.php");
    // Klasa korisnici.php
    require_once ("./klase/korisnici.php");


    if(isset($_POST['username'], $_POST['password'])){
        $UserLogin = new Users($conn);
        $UserLogin_bool = $UserLogin->userLogin($_POST['username'], $_POST['password']);
        if($UserLogin_bool){
            $getUserDataByUserName = new Users($conn);
            $userData_byName = $getUserDataByUserName->getUserName($_POST['username']);
            foreach ($userData_byName as $Userdata) {
                $_SESSION['uid'] = $Userdata['id'];
                echo "ok";
            }
        }
    }elseif(isset($_SESSION['uid'])){
                header('Location: post_list.php');
    }else{
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/login.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Login | Zadatak 1</title>
</head>
<body>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Prijavljivanje</div>
                    <div class="card-body">
                        <form id="loginform" action="" method="POST">
                                <div id="successlogin" class="alert alert-success" style="display:none">
                                  <strong>Uspesno!</strong> Molimo sacekajte, prebacicemo Vas na drugu stranicu.
                                </div>
                                <div id="invalidlogin" class="alert alert-danger" style="display:none">
                                  <strong>Greska!</strong> Korisnicko ime ili lozinka se ne podudaraju.
                                </div>
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Korisnicko ime</label>
                                <div class="col-md-6">
                                    <input type="text" id="username" class="form-control" name="username" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Lozinka</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Prijavi se
                                </button>
                            </div>
                      <a class="nav-link" href="<?= $link_sajta; ?>">Blog</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: './login.php',
      data: {username:$("#username").val(), password:$("#password").val()},
       success: function(data)
       {
          if (data === "ok") {
            $("#successlogin").show(500);
            setTimeout(function() { $("#successlogin").hide(500); }, 1500);
            setTimeout(function(){ document.location = 'post_list.php';}, 3000 ); 
          }
          else {
            $("#invalidlogin").show(500);
            setTimeout(function() { $("#invalidlogin").hide(500); }, 2500);
          }
       }
   });
 });
});
  </script>
</body>
</html>
<?php } ?>
