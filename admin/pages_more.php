<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!--
        Coding hand : https://github.com/Gadrawingz 
      -->
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="row">
    
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <?php
                if(isset($_GET['page_del'])) {
                  if($object->deleteRelatedPage($_GET['page_del'])) {
                    echo'<center><h5 class="btn btn-sm btn-danger text-center">Page is Removed!</h5></center>';
                    echo "<script>window.location='../admin/pages?allmenus'</script>";
                  }
                }
                ?>

                <?php 

                if(isset($_GET['p_related']) && !empty($_GET['p_related'])) {

                  if(!isset($_GET['view_rel']) || !isset($_GET['edit_rel'])) {

                ?>
                  <h3>
                    Add related page to this page &raquo;</a>
                  </h3>

                  <a class="btn btn-md btn-primary" href="../admin/pages_more?view_rel=<?php echo $_GET['p_related'] ?>">View All Related Pages</a>
                  <a class="btn btn-md btn-success" href="../admin/pages?allmenus">Back to menus</a><hr>

                  <?php
                  $statement= $object->getSubMenuData($_GET['p_related']);
                  $related_row= $statement->FETCH(PDO::FETCH_ASSOC);
                  
                  if(isset($_POST['page_save'])) {
                    if($object->addRelatedPage($_GET['p_related'], $_POST['title_en'], $_POST['title_rw'], $_POST['content_en'], $_POST['content_rw'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Created successfully!</h5></center>';
                    } else {
                      echo'<center><h5 class="btn btn-sm btn-danger text-center">Error! Not successful!</h5></center>';
                    }
                  }
                  ?>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <h4>Reference Page:</h4>
                    <p class="font-weight-bold">
                      &raquo; <?php echo $related_row['cmenu_name']." <span>(".$related_row['cmenu_name_rw'].")</span>"; ?>
                    </p><hr>

                    <h4 class="text-primary">Title</h4>
                    <div class="form-group">
                      <label for="title_en">Content title in <span class="text-primary">(English)</span></label>
                      <input type="text" class="form-control" id="title_en" name="title_en" required/>
                    </div>

                    <div class="form-group">
                      <label for="title_rw">Content Title in <span class="text-primary">(Kinyarwanda)</span></label>
                      <input type="text" class="form-control" id="title_rw" name="title_rw" required/>
                    </div>

                    <h4 class="text-primary">Content</h4>
                    <div class="form-group">
                      <label for="content_en">Content (English)</label>
                      <textarea name="content_en" class="tabContent" id="content_en"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="content_rw">Content (Kinyarwanda)</label>
                      <textarea name="content_rw" class="tabContent" id="content_rw"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="page_save" >Save!</button>
                  </form>
                <?php }} ?>




                <?php 
                if(isset($_GET['view_rel']) && !empty($_GET['view_rel'])) {
                ?>
                  <h3>
                    View All related pages to this page &raquo;
                  </h3>
                  <a class="btn btn-md btn-success" href="../admin/pages_more?p_related=<?php echo $_GET['view_rel']; ?>">Back to menus</a>

                  <?php
                  $statement2= $object->getSubMenuData($_GET['view_rel']);
                  $related_row2= $statement2->FETCH(PDO::FETCH_ASSOC);
                  ?>

                  <hr><h5>Page&raquo; <span class="text-primary"><?php echo $related_row2['cmenu_name']; ?></span>:</h5><br>
                  <ul class="related-ul">
                  <?php
                  $statement3= $object->viewRelatedPages($_GET['view_rel']);
                  while($ref_page_row= $statement3->FETCH(PDO::FETCH_ASSOC)) {
                  ?>
                    <li class="related-list">
                      <a href="../admin/pages_more?view_1p=<?php echo $ref_page_row['page_id']; ?>&page_ref=<?php echo $_GET['view_rel']; ?>" class="btn btn-sm text-white btn-primary bottom-link"><i class="ti ti-pencil"></i></a>&nbsp;
                      <a href="../admin/pages_more?page_del=<?php echo $ref_page_row['page_id']; ?>" class="btn btn-sm text-white btn-danger" style="margin-left: 0px" onclick="return confirm('Do you want to delete this page')" ><i class="ti ti-trash"></i></a>

                      <a href="../admin/pages_more?view_1p=<?php echo $ref_page_row['page_id']; ?>&page_ref=<?php echo $_GET['view_rel']; ?>" class="bottom-link"><?php echo $ref_page_row['content_title_en']; ?></a>
                      &nbsp;&nbsp;

                      <?php
                      $statement5= $object->viewRelatedPage($ref_page_row['page_id']);
                      $view_row= $statement5->FETCH(PDO::FETCH_ASSOC);
                      echo "&nbsp; ".$view_row['views']." view(s)";
                      ?>
                    </li>
                  <?php } ?>
                  </ul>
                <?php } ?>




                <?php if((isset($_GET['view_1p'])) && (!empty($_GET['view_1p']))) { ?>
                  <h3>View and update this page &raquo;</a></h3>

                  <a class="btn btn-md btn-primary" href="../admin/pages_more?view_rel=<?php echo $_GET['page_ref'] ?>">Back to related pages</a><hr>

                  <?php

                  $statement4 = $object->getSubMenuData($_GET['page_ref']);
                  $related_row4= $statement4->FETCH(PDO::FETCH_ASSOC);

                  $statement5= $object->viewRelatedPage($_GET['view_1p']);
                  $update_row5= $statement5->FETCH(PDO::FETCH_ASSOC);
                  
                  if(isset($_POST['update_save'])) {
                    if($object->updateRelatedPage($_GET['view_1p'], $_POST['title_en'], $_POST['title_rw'], $_POST['content_en'], $_POST['content_rw'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Created successfully!</h5></center>';
                    } else {
                      echo'<center><h5 class="btn btn-sm btn-danger text-center">Error! Not successful!</h5></center>';
                    }
                  }
                  ?>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <h4>Reference Page:</h4>
                    <p class="font-weight-bold">
                      &raquo; <?php echo $related_row4['cmenu_name']." <span>(".$related_row4['cmenu_name_rw'].")</span>"; ?>
                    </p><hr>

                    <h4 class="text-primary">Title</h4>
                    <div class="form-group">
                      <label for="title_en">Content title in <span class="text-primary">(English)</span></label>
                      <input type="text" class="form-control" id="title_en" value="<?php echo $update_row5['content_title_en']; ?>" name="title_en" required/>
                    </div>

                    <div class="form-group">
                      <label for="title_rw">Content Title in <span class="text-primary">(Kinyarwanda)</span></label>
                      <input type="text" class="form-control" id="title_rw" value="<?php echo $update_row5['content_title_rw']; ?>" name="title_rw" required/>
                    </div>

                    <h4 class="text-primary">Content</h4>
                    <div class="form-group">
                      <label for="content_en">Content (English)</label>
                      <textarea name="content_en" class="tabContent" id="content_en"><?php echo $update_row5['content_text_en']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="content_rw">Content (Kinyarwanda)</label>
                      <textarea name="content_rw" class="tabContent" id="content_rw"><?php echo $update_row5['content_text_rw']; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="update_save" >Update</button>
                  </form>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>



          <?php if(isset($_GET['page_to']) && !empty($_GET['page_to']) && $_GET['page_to']=='stats') { ?>
          <h3>View Posts(articles) statistics &raquo;</a></h3>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <span class="font-weight-bold" style="border-bottom: 2px solid blue; margin-bottom: 8px!important;">
                    Articles (posts) (english)
                  </span><br><br>
                  <?php
                  $num = 1;
                  $stmt750= $object->readPopularArticlesLimit15('lang_en');
                  while($row_art= $stmt750->FETCH(PDO::FETCH_ASSOC)) {
                            ?>
                  <p style="font-size: 12px;">
                    <a class="btn btn-sm btn-primary" href="?p_view=view_one&p_id=<?php echo $row_art['article_id']; ?>&type=art_en">
                      <i class="ti ti-list"></i>
                    </a>&nbsp;
                    <?php echo $object->showShortTextByNum(45, $row_art['article_title']); ?>
                    <a href="?p_view=view_one&p_id=<?php echo $row_art['article_id']; ?>&type=art_en">
                      (<b><?php echo $row_art['views']; ?> Views</b>)
                    </a>
                  </p>
                  <?php $num++; } ?> 
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <span class="font-weight-bold" style="border-bottom: 2px solid blue; margin-bottom: 8px!important;">
                    Articles (Posts) (kinyarwanda)
                  </span><br><br>
                    <?php
                      $num = 1;
                      $stmt752= $object->readPopularArticlesLimit15('lang_rw');
                      while($row_art2= $stmt752->FETCH(PDO::FETCH_ASSOC)) {
                    ?>
                  <p style="font-size: 12px;">
                    <a class="btn btn-sm btn-primary" href="?p_view=view_one&p_id=<?php echo $row_art2['article_id']; ?>&type=art_rw">
                      <i class="ti ti-list"></i>
                    </a>&nbsp;
                    <?php echo $object->showShortTextByNum(45, $row_art2['article_title']); ?>
                    <a href="?p_view=view_one&p_id=<?php echo $row_art2['article_id']; ?>&type=art_rw">
                      (<b><?php echo $row_art2['views']; ?> Views</b>)
                    </a>
                  </p>
                  <?php $num++; } ?> 
                </div>
              </div>
            </div>
          </div>

          <h3>View Pages traffics &raquo;</a></h3>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <span class="font-weight-bold" style="border-bottom: 2px solid blue; margin-bottom: 8px!important;">
                    Pages (English)
                  </span><br><br>
                  <?php
                    $num = 1;
                    $stmt753= $object->readPopularPages();
                    while($row_art3= $stmt753->FETCH(PDO::FETCH_ASSOC)) {
                  ?>
                  <p style="font-size: 12px;">
                    <a class="btn btn-sm btn-success" href="?p_view=view_one&p_id=<?php echo $row_art3['page_id']; ?>&type=page">
                      <i class="ti ti-list"></i>
                    </a>&nbsp;
                    <?php echo $object->showShortTextByNum(45, $row_art3['cmenu_name']); ?>
                    <a href="?p_view=view_one&p_id=<?php echo $row_art3['page_id']; ?>&type=page">
                      (<b><?php echo $row_art3['views']; ?> Views</b>)
                    </a>
                  </p>
                <?php } ?>

                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <span class="font-weight-bold" style="border-bottom: 2px solid blue; margin-bottom: 8px!important;">
                    Sub Pages (English)
                  </span><br><br>
                  <?php
                    $num = 1;
                    $stmt754= $object->readPopularSubPages();
                    while($row_art4= $stmt754->FETCH(PDO::FETCH_ASSOC)) {
                  ?>
                  <p style="font-size: 12px;">
                    <a class="btn btn-sm btn-secondary" href="?p_view=view_one&p_id=<?php echo $row_art4['page_id']; ?>&type=sub">
                      <i class="ti ti-list"></i>
                    </a>&nbsp;
                    <?php echo $object->showShortTextByNum(45, $row_art4['content_title_en']); ?>
                    <a href="?p_view=view_one&p_id=<?php echo $row_art4['page_id']; ?>&type=sub">
                      (<b><?php echo $row_art4['views']; ?> Views</b>)
                    </a>
                  </p>
                <?php } ?> 
                </div>
              </div>
            </div>
          </div>
          <?php } ?>





          <?php if((isset($_GET['p_view']) && !empty($_GET['p_view'])) && (isset($_GET['p_id']) && $_GET['p_id']!='') && $_GET['p_view']=='view_one') { ?>
          <h2>View Stats by Country/City </a></h3>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="font-weight-bold">
                  Countries visited the page
                  &nbsp; <a class="btn btn-sm btn-danger" href="?page_to=stats">Back</a>
                  </h4><br>
                  <?php
                  $num = 1;
                  if(isset($_GET['type']) && $_GET['type']=='art_en') {
                    $stmt7X= $object->getArticleStatsByCountry('lang_en', $_GET['p_id']);
                  } else if(isset($_GET['type']) && $_GET['type']=='art_rw') {
                    $stmt7X= $object->getArticleStatsByCountry('lang_rw', $_GET['p_id']);
                  } else if(isset($_GET['type']) && $_GET['type']=='page') {
                    $stmt7X= $object->getPostStatsByCountry($_GET['p_id']);
                  } else if(isset($_GET['type']) && $_GET['type']=='sub') {
                    $stmt7X= $object->getSubPageStatsByCountry($_GET['p_id']);
                  }

                  while($r_country= $stmt7X->FETCH(PDO::FETCH_ASSOC)) {
                  ?>
                  <p style="font-size: 12px;">
                    <?php echo $num."<b>) ".$r_country['country']."</b> / ".$r_country['city']." (<b>".$r_country['counting']."</b>"; ?>
                    <?php echo $r_country['counting']>1?" times)":" time)"; ?>
                  </p>
                  <?php $num++; } ?> 
                </div>
              </div>
            </div>
          </div>
          <?php } ?>





          
        </div>
        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>
