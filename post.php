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
        $updated = $objavaData_values['update_time'];
        $image = $objavaData_values['main_image'];
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
          <?php echo "<a href=\"".$link_sajta."index.php?stranica=author&author=".$author_id."\">".$author."</a>" ?>
        </p>

        <hr>

        <!-- Date/Time -->
        <?php 
        if($created == $updated){ 
            echo '<p>Posted on '.gmdate("F j Y, g:iA", strtotime($created)).'</p>';
        }elseif($created != $updated){
            echo '<p>Posted on '.gmdate("F j Y, g:iA", strtotime($created)).' | Updated on '.gmdate("F j Y, g:iA", strtotime($updated)).'</p>';
        }
        ?>
        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" height="300" width="750">

        <hr>

        <!-- Post Content -->
        <?= stripslashes($content); ?>

        <hr>

               <!-- Date/Time -->
        <?php 
        if($created == $updated){ 
            echo '<p>Posted on '.gmdate("F j Y, g:iA", strtotime($created)).' <small>by <a href="'.$link_sajta.'index.php?stranica=author&author='.$author_id.'">'.$author.'</a></small></p>';
        }elseif($created != $updated){
            echo '<p>Posted on '.gmdate("F j Y, g:iA", strtotime($created)).' | Updated on '.gmdate("F j Y, g:iA", strtotime($updated)).' <small>by <a href="'.$link_sajta.'index.php?stranica=author&author='.$author_id.'">'.$author.'</a></small></p>';
        }
        ?>
        <hr>
        <?php
            }else{
            include "404.php";
           }
        }
           ?>
<script type="text/javascript">
    document.title = <?= "\"".$title."\""; ?>;
</script>