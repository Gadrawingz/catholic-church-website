<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <?php if(isset($_GET['view'])) { ?>
                  <h3 class="font-weight-bold mb-0">All your published news</h3>
                  <?php } else if(isset($_GET['all'])) { ?>
                  <h3 class="font-weight-bold mb-0">All published news</h3>
                  <?php } else { ?>
                  <h3 class="font-weight-bold mb-0">Dashboard</h3>
                  <?php } ?>
                </div>



                <div>
                  <a href="articles?create&post_en" class="btn btn-primary btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Create Post(en)
                  </a>&nbsp;
                  <a href="articles?create&post_rw" class="btn btn-success btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Create Post(rw)
                  </a>
                </div>
              </div>
            </div>
          </div>
          
          <?php if(isset($_GET['dd'])) { ?>
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Sales</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">34040</h3>
                    <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-danger">0.12% <span class="text-black ml-1"><small>(30 days)</small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Revenue</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">47033</h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-danger">0.47% <span class="text-black ml-1"><small>(30 days)</small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Downloads</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">40016</h3>
                    <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-success">64.00%<span class="text-black ml-1"><small>(30 days)</small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Returns</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">61344</h3>
                    <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-success">23.00%<span class="text-black ml-1"><small>(30 days)</small></span></p>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

          <?php if(isset($_GET['sa'])) { ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <center><h5 class="btn btn-sm btn-primary text-center">Successful!</h5></center>
            </div>
          </div>
          <?php } if(isset($_GET['ea'])) { ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <center><h5 class="btn btn-sm btn-danger text-center">Error!</h5></center>
            </div>
          </div>            
          <?php } ?>


          <div class="row">
            <?php 
            if(isset($_GET['all'])) { 
              $stmt= $object->readArticlesAll();
              while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                $post_views = $object->countArticleViews($_SESSION['active_lang'], $row['article_id']);
            ?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="../read/<?php echo $row['article_id']; ?>">
                    <h3 class="card-title text-primary" title="Read only"><?php echo $row['article_title']; ?></h3>
                  </a>
                  <p class="card-description">
                    By <?php echo $row['firstname']." ".$row['lastname']; ?> 
                    •<mark class="text-primary" >
                      <?php if($post_views=='0') echo "No view"; ?>
                      <?php if($post_views=='1') echo $post_views." view"; ?>
                      <?php if($post_views>1) echo "<strong>".$post_views."</strong> views"; ?>
                    </mark>&nbsp;•&nbsp;
                    <?php if($row['publisher_id']== $admin_id) { ?>
                    <a href="../admin/articles?update=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-success text-right" style="padding: 2.5px 5px!important;">Preview</a>
                    <?php } else { ?>
                      <a href="../read/<?php echo $row['article_id']; ?>" class="btn btn-sm btn-warning text-right" style="padding: 2.5px 5px!important;">View only</a>
                    <?php } ?>

                    <?php if($object->check4TranslatedPost($row['article_id'])==1) { ?>
                      <a href="articles?update_rw=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-secondary text-right text-white" style="padding:2.5px 5px!important;">VIEW:RW</a>
                    <?php } else { ?>
                      <a href="articles?create&post_rw&p_fixed=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-primary text-right text-white" style="padding:2.5px 5px!important;">Translate</a>
                    <?php } ?>

                  </p>
                  <p>
                    <?php echo $object->showMediumText(strip_tags($row['article_post'])); ?>
                  </p>
                  <p>
                    <hr><small>Created: <strong><?php echo $row['article_date']; ?></strong>&nbsp;in&nbsp;&raquo;&nbsp;<?php echo $row['article_category']; ?></small>&nbsp;•&nbsp;
                    <a href="../admin/articles?update=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-primary text-right" style="padding: 2.5px 5px!important;">Edit</a>
                    &bull;
                    <a href="../admin/articles?rema=<?php echo $row['article_id']; ?>" onclick="return confirm('If you click press \'OK\' Both English and Kinyarwanda will be removed, You cannot restore data!')" class="btn btn-sm btn-danger text-right" style="padding: 2.5px 5px!important;">Delete</a>
                  </p>
                </div>
              </div>
            </div>
            <?php }} ?>

            <?php
            if(isset($_GET['view'])) { 
            $num = 1;
            $stmt= $object->readArticlesByPublisher($admin_id);
            while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
            $post_views = $object->countArticleViews($_SESSION['active_lang'], $row['article_id']);
            ?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <a href="../admin/articles?update=<?php echo $row['article_id']; ?>">
                    <h3 class="card-title text-primary"><?php echo $row['article_title']; ?></h3>
                  </a>
                  <p class="card-description">
                    By <?php echo $row['firstname']." ".$row['lastname']; ?> 
                    •<mark class="text-primary" >
                      <?php if($post_views=='0') echo "No view"; ?>
                      <?php if($post_views=='1') echo $post_views." view"; ?>
                      <?php if($post_views>1) echo "<strong>".$post_views."</strong> views"; ?>
                    </mark>&nbsp;•&nbsp;

                    <a href="../admin/articles?update=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-success text-right" style="padding: 2.5px 5px!important;">Preview</a>
                  
                    <?php if($object->check4TranslatedPost($row['article_id'])==1) { ?>
                      <a href="articles?update_rw=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-secondary text-right text-white" style="padding:2.5px 5px!important;">VIEW:RW</a>
                    <?php } else { ?>
                      <a href="articles?create&post_rw&p_fixed=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-primary text-right text-white" style="padding:2.5px 5px!important;">Translate</a>
                    <?php } ?>

                  </p>
                  <p>
                    <?php echo $object->showMediumText(strip_tags($row['article_post'])); ?>
                  </p>
                  <p>
                    <hr><small>Created: <strong><?php echo $row['article_date']; ?></strong>&nbsp;in&nbsp;&raquo;&nbsp;<?php echo $row['article_category']; ?></small>&nbsp;•&nbsp;
                    <a href="../admin/articles?update=<?php echo $row['article_id']; ?>" class="btn btn-sm btn-primary text-right" style="padding: 2.5px 5px!important;">Edit</a>
                    &bull;
                    <a href="../admin/articles?rema=<?php echo $row['article_id']; ?>" onclick="return confirm('If you click press \'OK\' Both English and Kinyarwanda will be removed, You cannot restore data!')" class="btn btn-sm btn-danger text-right" style="padding: 2.5px 5px!important;">Delete</a>
                  </p>
                </div>
              </div>
            </div>
            <?php }} ?>


            <div class="col-md-12 grid-margin stretch-card">    
              <?php if(isset($_GET['create']) && isset($_GET['post_en'])){
              if(isset($_POST['postsave'])) {
                if($_POST['article_title']=="" || $_FILES['a_picture']=="" || $_POST['a_category']=="" || $_POST['a_post']=="") {
                  echo "<script>window.location='../admin/articles?create&ea'</script>";
                } else {
                  $object->createArticle($admin_id, $_POST['article_title'], $_FILES['a_picture'], $_POST['a_category'], addslashes($_POST['a_post']));
                  echo "<script>window.location='../admin/articles?view&sa'</script>";
                }
              }
              ?>
              <div class="card">
                <div class="card-body">
                  <h4>Create new article in <span class="text-primary">English</span></h4><hr>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="article_title">Article title</label>
                      <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Article title" required/>
                    </div>

                    <div class="form-group">
                      <label>Article Picture</label>
                      <input type="file" name="a_picture" class="form-control" required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="a_category">Article category</label>
                      <select class="form-control" id="a_category" name="a_category" required/>
                        <option value="Posts">Posts</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="a_post">Article post</label>
                      <textarea name="a_post" id="textContent" cols="100" rows="100" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="postsave">Save</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
                </div>
              </div>
              <?php } if(isset($_GET['create']) && isset($_GET['post_rw'])){
              if(isset($_POST['postsave_rw'])) {
                if($_POST['art_ref']=="" || $_POST['article_title']=="" || $_FILES['a_picture']=="" || $_POST['a_category']=="" || $_POST['a_post']=="") {
                  echo "<script>window.location='../admin/articles?create&ea'</script>";
                } else {
                  $object->createArticleRw($admin_id, $_POST['art_ref'], $_POST['article_title'], $_FILES['a_picture'], $_POST['a_category'], addslashes($_POST['a_post']));
                  echo "<script>window.location='../admin/articles?view&sa'</script>";
                }
              }
              ?>
              <div class="card">
                <div class="card-body">
                  <h4>Create new article in <span class="text-primary">Kinyarwanda</span></h4><hr>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="art_ref"><b>Reference post<span class="text-primary text-weight-bold"> (Choose a post you want to translate)</span></b></label>
                      
                      <?php if(!isset($_GET['p_fixed'])) { ?>
                      <select class="form-control" id="art_ref" name="art_ref" required/>
                        <option value="">Select reference post</option>
                        <?php
                          $stmt1= $object->readUntranslatedArts();
                          while($result1= $stmt1->FETCH(PDO::FETCH_ASSOC)){
                        ?>
                        <option value="<?php echo $result1['article_id']; ?>">
                          <?php echo $result1['article_title']; ?>
                        </option>
                        <?php } ?>
                      </select>
                      <?php } else { 
                      $stmt2= $object->readArticle($_GET['p_fixed']);
                      $result2= $stmt2->FETCH(PDO::FETCH_ASSOC);
                      echo "<p><i>".$result2['article_title']."</i></p>";
                      }
                      ?>
                      <input type="hidden" class="form-control" name="art_ref" value="<?php echo $result2['article_id']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="article_title">Article title</label>
                      <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Article title" required/>
                    </div>

                    <div class="form-group">
                      <label>Article Picture</label>
                      <input type="file" name="a_picture" class="form-control" required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="a_category">Article category</label>
                      <select class="form-control" id="a_category" name="a_category" required/>
                        <option value="Posts">Posts</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="a_post">Article post</label>
                      <textarea name="a_post" id="textContent" cols="100" rows="100" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="postsave_rw">Save</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
                </div>
              </div>              
              <?php } ?>


              <?php
              if(isset($_GET['rema'])) {
                if($object->removeArticle($_GET['rema'])) {
                  echo'<center><h5 class="btn btn-sm btn-danger text-center">Content has been removed!</h5></center>';
                  echo "<script>window.location='?all'</script>";
                }
              }
              ?>

              <?php if(isset($_GET['update'])) {
                $stmt= $object->readOneArticle($_GET['update'], $admin_id);
                $uresult= $stmt->FETCH(PDO::FETCH_ASSOC);

                if(isset($_POST['postupd'])) {
                  if($_POST['article_title']=="" || $_POST['a_category']=="" || $_POST['a_post']=="") {
                    echo "<script>window.location='../admin/articles?update=$_GET[update]&ea'</script>";
                  } else {
                    $object->updateArticle($_GET['update'], $_POST['article_title'], $_POST['a_category'], $_POST['a_post']);
                    echo "<script>window.location='../admin/articles?view&sa'</script>";
                  }
                }
              ?>
              <div class="card">
                <div class="card-body">
                  <h4>View & Update this article</h4><hr>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="article_title">Article title</label>
                      <input type="text" class="form-control" id="article_title" name="article_title" value="<?php echo $uresult['article_title']; ?>" required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="a_category">Article category</label>
                      <select class="form-control" id="a_category" name="a_category" required/>
                        <option value="<?php echo $uresult['article_category']; ?>"><?php echo $uresult['article_category']; ?></option>
                        <option value="Posts">Posts</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="a_post">Article post</label>
                      <textarea name="a_post" id="textContent" rows="12" required/><?php echo stripslashes($uresult['article_post']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="postupd">Update</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
                </div>
              </div>
              <?php } ?>


              <?php if(isset($_GET['update_rw'])) {
                $stmt= $object->readOneArticleRwByRef($_GET['update_rw'], $admin_id);
                $uresult= $stmt->FETCH(PDO::FETCH_ASSOC);

                if(isset($_POST['postupd'])) {
                  if($_POST['article_title']=="" || $_POST['a_category']=="" || $_POST['a_post']=="") {
                    echo "<script>window.location='../admin/articles?update_rw=$_GET[update_rw]&ea'</script>";
                  } else {
                    $object->updateArticleRw($uresult['article_id'], $_POST['article_title'], $_POST['a_category'], $_POST['a_post']);
                    echo "<script>window.location='../admin/articles?view&sa'</script>";
                  }
                }
              ?>
              <div class="card">
                <div class="card-body">
                  <h4>View & Update this article</h4><hr>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="article_title">Article title</label>
                      <input type="text" class="form-control" id="article_title" name="article_title" value="<?php echo $uresult['article_title']; ?>" required/>
                    </div>
                    
                    <div class="form-group">
                      <label for="a_category">Article category</label>
                      <select class="form-control" id="a_category" name="a_category" required/>
                        <option value="<?php echo $uresult['article_category']; ?>"><?php echo $uresult['article_category']; ?></option>
                        <option value="Posts">Posts</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="a_post">Article post</label>
                      <textarea name="a_post" id="textContent" rows="12" required/><?php echo stripcslashes($uresult['article_post']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="postupd">Update</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
                </div>
              </div>
              <?php } ?>











            </div>
          </div>
          
        </div>
        <!-- content-wrapper ends -->
      
      <!-- content-wrapper ends -->
      <?php include('reusable/footer.php'); ?>