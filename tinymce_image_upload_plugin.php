<?php
if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name =md5(mt_rand(100, 999)) . '.' . $ext;
 $location = 'images/' . $name;  
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo json_encode(array(
        'file_path' => $location
    ));
}
?>
