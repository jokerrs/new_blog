<?php
      $author_id = $_GET['author'];
      $author = $conn->prepare("SELECT author FROM articles_authors WHERE author_id = ?");
      $author->execute([$author_id]);
      foreach ($author as $authorname) {
        $author_name = $authorname['author'];
      }
        ?>
<h1 class="my-4">Zadatak 1 |
    <?= $author_name ?>
</h1>
<?php 

       
        $strana = (!isset($_GET['strana'])?1:$_GET['strana']);

          $pagination = new Articles($conn);
          $pagination_results = $pagination->getArticlePaginationAuthorPage((int)'4', (int)$strana, (int)$author_id);
          $ukupno_strana = $pagination_results[0];

          foreach ($pagination_results[1] as  $objava_value) {  
        $content = substr($objava_value['content'], 0, 800);
            $search = array("/<p[^>]*>[\s|&nbsp;]*<\/p>/","/<img[^>]+\>/i" );
            $replace = array("" , "(slika)");
            $content_clear = preg_replace($search, $replace, stripslashes($content));
          ?>
<!-- Blog Post -->
<div class="card mb-4">
    <img class="img-fluid rounded" src="<?php echo $objava_value['main_image']; ?>" alt="<?php echo $objava_value['title']; ?>" height="300" width="750">
    <div class="card-body">
        <h2 class="card-title">
            <?= $objava_value['title']; ?>
        </h2>
        <div class="row"></div>
        <?php 
            $tidy = new Tidy();
            $tidy->parseString($content_clear."...");
            $tidy->cleanRepair();
            echo $tidy;
            ?>
    </div>
    <div class="card-footer text-muted">
        Posted on
        <?= gmdate("F j Y, g:iA", strtotime($objava_value['created_time'])); ?> by
        <?= "<a href=\"".$link_sajta."index.php?stranica=author&author=".$objava_value['author_id']."\">".$objava_value['author']."</a>" ?>
        <a href="<?= $link_sajta."/index.php?stranica=post&objava=".$objava_value['id']; ?>" class="float-right btn btn-primary">Vise &rarr;</a>
    </div>
</div>
<?php
          }
        ?>
<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
    <?php
      
        if($strana+4 > $ukupno_strana){
          $srednji_index = $ukupno_strana-4;
        }elseif($strana-4 < 1){
          $srednji_index = 5;
        }else{
          $srednji_index = $strana;
        }
        
  $link_strane = ""; 

if($strana>=2){ 
  if($strana > 5) { 
  echo "<li class='page-item'><a class='page-link' href='index.php?stranica=author&author=".$author_id."&strana=1'> << </a></li>"; 
  }
  echo "<li class='page-item'><a class='page-link' href='index.php?stranica=author&author=".$author_id."&strana=".($strana-1)."'> < </a></li>"; 
} 
  

for ($i=-4; $i<=4; $i++) { 
  if($srednji_index+$i==$strana) 
    $link_strane .= "<li class='page-item active'><a class='page-link' href='index.php?stranica=author&author=".$author_id."&strana=".($srednji_index+$i)."'>".($srednji_index+$i)."</a></li>"; 
  else
    $link_strane .= "<li class='page-item'><a class='page-link' href='index.php?stranica=author&author=".$author_id."&strana=".($srednji_index+$i)."'>".($srednji_index+$i)."</a></li>";   
};   
echo $link_strane; 
  

if($strana < $ukupno_strana){ 
  echo "<li class='page-item'><a class='page-link' href='index.php?stranica=author&author=".$author_id."&strana=".($strana+1)."'> > </a></li>"; 
  if($strana <= $ukupno_strana-5) { 
    echo "<li class='page-item'><a class='page-link' href='index.php?stranica=author&author=".$author_id."&strana=".$ukupno_strana."'> >> </a></li>";  
  }
} 
?>
</ul>