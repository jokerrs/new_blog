
        <h1 class="my-4">Zadatak 1
          
        </h1>

        <?php 
        $strana = (!isset($_GET['strana'])?1:$_GET['strana']);

          $pagination = new Articles($conn);
          $pagination_results = $pagination->getArticlePagination((int)'4', (int)$strana);
          $ukupno_strana = $pagination_results[0];

          foreach ($pagination_results[1] as  $objava_value) {
            $content = substr($objava_value['content'], 0, 800);
          ?>
                  <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title"><?= $objava_value['title']; ?></h2>
            <?= $content."..."; ?>
            <a href="<?php echo $link_sajta."/index.php?stranica=post&objava=".$objava_value['id']; ?>" class="float-right btn btn-primary">Vise &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on <?= gmdate("F j Y, g:iA", strtotime($objava_value['created_time'])); ?> by
            <?= "<a href=\"".$link_sajta."index.php?stranica=author&author=".$objava_value['author_id']."\">".$objava_value['author']."</a>" ?>
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
  echo "<li class='page-item'><a class='page-link' href='index.php?strana=1'> << </a></li>"; 
  }
  echo "<li class='page-item'><a class='page-link' href='index.php?strana=".($strana-1)."'> < </a></li>"; 
} 
  

for ($i=-4; $i<=4; $i++) { 
  if($srednji_index+$i==$strana) 
    $link_strane .= "<li class='page-item active'><a class='page-link' href='index.php?strana=".($srednji_index+$i)."'>".($srednji_index+$i)."</a></li>"; 
  else
    $link_strane .= "<li class='page-item'><a class='page-link' href='index.php?strana=".($srednji_index+$i)."'>".($srednji_index+$i)."</a></li>";   
};   
echo $link_strane; 
  

if($strana < $ukupno_strana){ 
  echo "<li class='page-item'><a class='page-link' href='index.php?strana=".($strana+1)."'> > </a></li>"; 
  if($strana <= $ukupno_strana-5) { 
    echo "<li class='page-item'><a class='page-link' href='index.php?strana=".$ukupno_strana."'> >> </a></li>";  
  }
} 
?>
</ul>