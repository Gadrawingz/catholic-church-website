<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">


          <?php
          if(isset($_GET['view'])) { 
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">All published news</h3>
                </div>
                
                <div>
                  <a href="articles?create" class="btn btn-primary btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Create new
                  </a>
                </div>
              </div>
            </div>
          </div>

          <?php if(isset($_GET['sa'])) { ?>
            <center><h5 class="btn btn-sm btn-primary text-center">Article is added!</h5></center>
          <?php } if(isset($_GET['ea'])) { ?>
            <center><h5 class="btn btn-sm btn-danger text-center">Successful!</h5></center>
          <?php } ?>

          <div class="row">

            <?php
              $num = 1;
              $stmt= $object->readArticlesByPublisher($admin_id);
              while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                $post_views = $object->countArticleViews($row['article_id']);
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
                  </p>
                  <p>
                    <?php echo $object->showMediumText(strip_tags($row['article_post'])); ?>
                  </p>
                  <p>
                    <hr><small>Published on <strong><?php echo $row['article_date']; ?></strong></small>
                  </p>
                </div>
              </div>
            </div>
            <?php } ?></div><br><br><hr class="hr-grey"><br><br>
          <?php } ?>

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  
                </div>
                
                <div>
                  <a href="dashboard" class="btn btn-primary btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Back
                  </a>
                </div>
              </div>
            </div>
          </div>

          <?php if(isset($_GET['create'])) {
            if(isset($_POST['postsave'])) {

              if($_POST['article_title']=="" || $_FILES['a_picture']=="" || $_POST['a_category']=="" || $_POST['a_post']=="") {
                echo "<script>window.location='../admin/articles?create&ea'</script>";
              } else {
                $object->createArticle($admin_id, $_POST['article_title'], $_FILES['a_picture'], $_POST['a_category'], addslashes($_POST['a_post']));
                echo "<script>window.location='../admin/articles?view&sa'</script>";
              }
            }
          ?>

          <?php if(isset($_GET['sa'])) { ?>
            <center><h5 class="btn btn-sm btn-danger text-center">Error!</h5></center>
          <?php } if(isset($_GET['ea'])) { ?>
            <center><h5 class="btn btn-sm btn-primary text-center">Successful!</h5></center>
          <?php } ?>

          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4>Create new article</h4><hr>
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
                        <option value="News">News</option>
                        <option value="Stories">Stories</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="a_post">Article post</label>
                      <textarea name="a_post" id="myTextarea" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="postsave">Save</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>







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

          <?php if(isset($_GET['sa'])) { ?>
            <center><h5 class="btn btn-sm btn-danger text-center">Error!</h5></center>
          <?php } if(isset($_GET['ea'])) { ?>
            <center><h5 class="btn btn-sm btn-primary text-center">Successful!</h5></center>
          <?php } ?>

          <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4>Create new article</h4><hr>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="article_title">Article title</label>
                      <input type="text" class="form-control" id="article_title" name="article_title" value="<?php echo $uresult['article_title']; ?>" required/>
                    </div>

                    
                    <div class="form-group">
                      <label for="a_category">Article category</label>
                      <select class="form-control" id="a_category" name="a_category" required/>
                        <option value="<?php echo $uresult['article_category']; ?>"><?php echo $uresult['article_category']; ?></option>
                        <option value="News">News</option>
                        <option value="Stories">Stories</option>
                        <option value="Others">Others</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="a_post">Article post</label>
                      <textarea name="a_post" id="myTextarea" required/><?php echo $uresult['article_post']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="postupd">Update</button>
                    <button class="btn btn-danger">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>