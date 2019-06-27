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
  <script src="./js/tinymce/tinymce.min.js"></script>
  <script src="./js/tinymce/jquery.tinymce.min.js"></script>
 <script>
tinymce.init({
    selector: '#content',
     plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview | forecolor backcolor emoticons",
    image_class_list: [
        {title: 'Responsive image', value: 'img-fluid rounded'}
    ],
  images_upload_url : 'tinymce_image_upload_plugin.php',
    automatic_uploads : false,

    images_upload_handler : function(blobInfo, success, failure) {
      var xhr, formData;

      xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open('POST', 'tinymce_image_upload_plugin.php');

      xhr.onload = function() {
        var json;

        if (xhr.status != 200) {
          failure('HTTP Error: ' + xhr.status);
          return;
        }

        json = JSON.parse(xhr.responseText);

        if (!json || typeof json.file_path != 'string') {
          failure('Invalid JSON: ' + xhr.responseText);
          return;
        }

        success(json.file_path);
      };

      formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());

      xhr.send(formData);
    },
  });
</script>
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
          <li class="nav-item"><a class="nav-link" href="<?= $link_sajta; ?>">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."admin.php"; ?>">Pocetna</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $link_sajta."post_list.php"; ?>">Lista postova</a></li>
          <li class="nav-item active" active><a class="nav-link" href="<?= $link_sajta."add_new.php"; ?>">Dodaj novi post</a></li>
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
                <input class="form-control" type="hidden" id="author_id" name="author_id" value="<?= $_SESSION['uid']?>">
                <span id="span_image"></span>
                <button type="submit" class="btn btn-primary">Unesi</button>
            </form>
        </div>
        <div class="col-lg-4 center">
          <br /><br />
            <form id="imageUpload">
              <span id="uploaded_image"><label for="file">Izaberite glavnu sliku</label></span><br />
              <input id="file" type="file" accept="image/*" name="file" /><br />
              <span id="uploaded_image"></span>
            <form>
        </div>

    </div>
    <!-- /.row -->

  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  </div>
  <!-- /.container -->

<script type="text/javascript">
      $(document).ready(function() {
  $('#insertArticle').submit(function(e) {
    var data = JSON.stringify({
            title:$("#title").val(), 
            content:$("#content").val(), 
            author_id:$("#author_id").val(), 
            main_image:$("#main_image").val()
        });
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: 'http://localhost/novi_projekat/api/articles/create.php',
        data: data,
        statusCode: {
        200: function(){
            $("#success").show(500);
            setTimeout(function() { $("#success").hide(500); }, 2500);
            $("#insertArticle")[0].reset();
            $("#imageUpload")[0].reset();
            $('#uploaded_image').empty();
            },
        400: function(){
            $('#invalidM').html(" Morate popuniti sva polja");
            $("#invalid").show(500);
            setTimeout(function() { $("#invalid").hide(500); }, 2500);
            },
        
        503: function(){
            $('#invalidM').html(" Doslo je do greske prilikom ubacivanja u bazu, pokusajte ponovo!");
            $("#invalid").show(500);
            setTimeout(function() { $("#invalid").hide(500); }, 2500);
            },
        
        403.3: function(){
            $('#invalidM').html(" Jos uvek nemate permisije da unosite nove postove!");
            $("#invalid").show(500);
            setTimeout(function() { $("#invalid").hide(500); }, 2500);
            },
        
        404: function(){
            $('#invalidM').html(" Slika je obavezna!");
            $("#invalid").show(500);
            setTimeout(function() { $("#invalid").hide(500); }, 2500);
            },

        }
   });
 });
});
  </script>
  <script>
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Slika je loseg formata");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Slika je veca od 2M, molimo kompresujte sliku");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>SLika se otprema...</label>");
    },   
    success:function(data)
    {
     $('#uploaded_image').html("<img src='"+data+"' class='img-thumbnail' />");
     $('#span_image').html("<input class='form-control' type='hidden' id='main_image' name='main_image' value='"+data+"'>");
    }
   });
  }
 });
});
</script>
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
<?php
    }

    ?>