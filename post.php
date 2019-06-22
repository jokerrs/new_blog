<?php
    // Klasa za objave
    if(!isset($_GET['objava'])){
        include "404.php";
    }else{
    require_once ("./klase/objave.php");
    $objava = new Articles($conn);
    $getobjava = $_GET['objava'];
    $objavaData = $objava->getArticle($getobjava);
    foreach ($objavaData as $objavaData_values) {
        $title = $objavaData_values['title'];
        $content = $objavaData_values['content'];
        $author_id = $objavaData_values['author_id'];
        $author = $objavaData_values['author'];
        $created = $objavaData_values['created_time'];
    }

    if($objavaData->rowCount() > 0){
?>

        <!-- Title -->
        <h1 class="mt-4"><?php echo $title; ?></h1>
            
            <?php

            ?>
        <!-- Author -->
        <p class="lead">
          by
          <?php echo "<a href=\"".$link_sajta."index.php?author=".$author_id."\">".$author."</a>" ?>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on <?php echo gmdate("F j Y, g:iA", strtotime($created)); ?></p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

        <hr>

        <!-- Post Content -->
        <?php echo $content;

            }else{
            include "404.php";
           }
        }
           ?>
