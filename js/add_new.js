 $(document).ready(function() {
     $('#insertArticle').submit(function(e) {
         var data = JSON.stringify({
             title: $("#title").val(),
             content: $("#content").val(),
             author_id: $("#author_id").val(),
             main_image: $("#main_image").val()
         });
         e.preventDefault();
         $.ajax({
             type: "POST",
             url: 'http://localhost/novi_projekat/api/articles/create.php',
             data: data,
             statusCode: {
                 200: function() {
                     $("#success").show(500);
                     setTimeout(function() { $("#success").hide(500); }, 2500);
                     $("#insertArticle")[0].reset();
                     $("#imageUpload")[0].reset();
                     $('#uploaded_image').empty();
                 },
                 400: function() {
                     $('#invalidM').html(" Morate popuniti sva polja");
                     $("#invalid").show(500);
                     setTimeout(function() { $("#invalid").hide(500); }, 2500);
                 },

                 503: function() {
                     $('#invalidM').html(" Doslo je do greske prilikom ubacivanja u bazu, pokusajte ponovo!");
                     $("#invalid").show(500);
                     setTimeout(function() { $("#invalid").hide(500); }, 2500);
                 },

                 403.3: function() {
                     $('#invalidM').html(" Jos uvek nemate permisije da unosite nove postove!");
                     $("#invalid").show(500);
                     setTimeout(function() { $("#invalid").hide(500); }, 2500);
                 },

                 404: function() {
                     $('#invalidM').html(" Slika je obavezna!");
                     $("#invalid").show(500);
                     setTimeout(function() { $("#invalid").hide(500); }, 2500);
                 },

             }
         });
     });

     $(document).on('change', '#file', function() {
         var name = document.getElementById("file").files[0].name;
         var form_data = new FormData();
         var ext = name.split('.').pop().toLowerCase();
         if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'jfif']) == -1) {
             alert("Slika je loseg formata");
         }
         var oFReader = new FileReader();
         oFReader.readAsDataURL(document.getElementById("file").files[0]);
         var f = document.getElementById("file").files[0];
         var fsize = f.size || f.fileSize;
         if (fsize > 2000000) {
             alert("Slika je veca od 2M, molimo kompresujte sliku");
         } else {
             form_data.append("file", document.getElementById('file').files[0]);
             $.ajax({
                 url: "upload.php",
                 method: "POST",
                 data: form_data,
                 contentType: false,
                 cache: false,
                 processData: false,
                 beforeSend: function() {
                     $('#uploaded_image').html("<label class='text-success'>SLika se otprema...</label>");
                 },
                 success: function(data) {
                     $('#uploaded_image').html("<img src='" + data + "' class='img-thumbnail' />");
                     $('#span_image').html("<input class='form-control' type='hidden' id='main_image' name='main_image' value='" + data + "'>");
                 }
             });
         }
     });
 });