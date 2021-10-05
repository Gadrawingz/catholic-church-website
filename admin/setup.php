<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!-- 
        @Gadrawingz 
        Coding hand by https://github.com/Gadrawingz 
      -->
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card-body">
                      <h4 class="card-title">Settings</h4>
                      <div class="template-demo">
                        <a href="../admin/setup?allmenus" class="btn btn-success">View Menus</a>
                        <a href="../admin/setup?allslides" class="btn btn-primary">Manage slides</a>
                        <a href="../admin/setup?newslide" class="btn btn-primary">New slide</a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                <?php if(isset($_GET['allslides'])) { ?>
                  <div class="row col-md-12">
                    <div class="col-md-12">
                      <div class="d-flex justify-content-between align-items-center">
                    <div><h3 class="font-weight-bold mb-0">All slides</h3></div>

                    <div>
                      <a href="setup?newslide" class="btn btn-primary btn-icon-text btn-rounded">
                        <i class="ti-clipboard btn-icon-prepend"></i>Add new
                      </a>
                    </div>
                  </div><hr>

                  <div class="row col-md-12">
                    <!-- Xtt card row -->
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Picture</th>
                          <th class="text-center">#</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $num = 1;
                        $stmt= $object->viewAllSlides();
                        while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      ?>
                        <tr>
                          <td><?php echo $num; ?></td>
                          <td><?php echo $object->showShortText12($row['slide_title']); ?></td>
                          <td><?php echo $object->showShortText12($row['description']); ?></td>
                          <td><img src="../uploads/slides/<?php echo $row['slide_image']; ?>"></td>
                          <td class="text-center"><a class="btn btn-sm btn-primary" href="?upslide=<?php echo $row['slide_id']; ?>">Update</a></td>
                        </tr>
                      <?php $num++; } ?>
                      </tbody>
                    </table>
                    <!-- End card row -->
                  </div>
                <?php } ?>




                <?php if(isset($_GET['newslide'])) { ?>
                  <h3 class="card-title">Add new slide &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/dashboard" class="btn btn-sm btn-danger text-right">Exit</a></h3>

                  <?php

                    if(isset($_POST['slidesave'])) {
                      if($object->addSlide($_POST['slide_title'], $_POST['description'], $_FILES['slide_picture'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                      }
                    }
                  ?>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="slide_title">Slide title</label>
                      <input type="text" class="form-control" id="slide_title" name="slide_title" placeholder="Slide title" required/>
                    </div>

                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" class="form-control" id="description" name="description" placeholder="Description"/>
                    </div>

                    <div class="form-group">
                      <label for="slide_picture">Slide picture</label>
                      <input type="file" class="form-control" id="slide_picture" name="slide_picture" placeholder="Slide picture"/>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="slidesave">Save</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/setup?allslides" class="btn btn-success text-right">View all slides</a>
                  </form>
                <?php } ?>





                <?php if(isset($_GET['upslide'])) { ?>
                  <h3 class="card-title">Update slide &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/dashboard" class="btn btn-sm btn-danger text-right">Exit</a></h3>

                  <?php
                  $stmt80= $object->viewOneSlide($_GET['upslide']);
                  $editrow = $stmt80->FETCH(PDO::FETCH_ASSOC);
                    if(isset($_POST['slideupdatebtn'])) {
                      if($object->updateSlide($_GET['upslide'], $_POST['slide_title'], $_POST['description'], $_FILES['slide_picture'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                        echo "<script>window.location='?allslides'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                      }
                    }
                  ?>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="slide_title">Slide title</label>
                      <input type="text" class="form-control" id="slide_title" name="slide_title" value="<?php echo $editrow['slide_title'];?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" class="form-control" id="description" name="description"  value="<?php echo $editrow['description'];?>"/>
                    </div>

                    <div class="form-group">
                      <label for="pic_preview">Current picture</label>
                      <span class="btn-sm btn-primary" id="viewppic" style="padding: 2px 6px!important;">View</span>
                      <span class="btn-sm btn-success" id="hideppic" style="padding: 2px 6px!important;">Hide</span>
                      <div style="border: 1.5px solid green;" id="prevppic">
                        <img src="../uploads/slides/<?php echo $editrow['slide_image']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="slide_picture">Slide picture</label>
                      <input type="file" class="form-control" id="slide_picture" name="slide_picture" required />
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="slideupdatebtn">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/setup?allslides" class="btn btn-success text-right">Back</a>
                  </form>
                <?php } ?>












                <?php if(isset($_GET['allmenus'])) { ?>
                  <div class="row col-md-12">
                    <div class="col-md-12">
                      <div class="d-flex justify-content-between align-items-center">
                    <div><h3 class="font-weight-bold mb-0">Menus</h3></div>
                  </div><hr>

                  <div class="row col-md-12">
                    <!-- Xtt card row -->
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Menu</th>
                          <th>Menu title</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $num = 1;
                        $stmt2= $object->getAllMenus();
                        while($menu= $stmt2->FETCH(PDO::FETCH_ASSOC)) { 
                      ?>
                        <tr>
                          <td><strong><?php echo $num; ?></strong></td>
                          <td><?php echo $menu['menu_name']; ?></td>
                          <td>
                            <?php
                            if($menu['has_submenu']=='Yes') {
                            ?>
                            <ul>
                              <?php
                                $stmt3= $object->getSubMenus($menu['menu_id']);
                                while($cmenu= $stmt3->FETCH(PDO::FETCH_ASSOC)) {
                                ?>
                                <li><a href="../admin/setup?preview=<?php echo $cmenu['cmenu_id']; ?>"><?php echo $cmenu['cmenu_name']; ?></a></li>
                              <?php }} else if($menu['menu_url']!='home' && $menu['has_submenu']!='Yes'){ 

                                $stmt39= $object->getSubMenus($menu['menu_id']);
                                $cmenu39= $stmt39->FETCH(PDO::FETCH_ASSOC);
                                ?>
                                <a class="btn btn-sm btn-primary" href="../admin/setup?preview=<?php echo $cmenu39['menu_id']; ?>">Add content</a>
                              <?php } ?>
                            </ul>
                          </td>
                          <td>
                            <center>
                              <?php
                              if($menu['has_submenu']=='Yes') {
                              ?>
                              
                              <?php if($_SESSION['admin_role']=='Admin') { ?>
                              <a class="btn btn-sm btn-success" href="../admin/setup?newmenu=<?php echo $menu['menu_id']; ?>">Add menu</a>
                              <?php }} ?>
                            </center>
                          </td>
                        </tr>
                      <?php $num++; } ?>
                      </tbody>
                    </table>
                    <!-- End card row -->
                  </div>
                <?php } ?>



                <?php if(isset($_GET['newmenu'])) { ?>
                  <h3 class="card-title">Add new menu </h3>

                  <?php
                    if(isset($_POST['menusave'])) {
                      if($object->regSubShit($_GET['newmenu'], $_POST['cmenu_title'], $_POST['cmenu_header'], $_FILES['page_picture'], $_POST['page_content'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                      }
                    }
                  ?>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="cmenu_title">Menu title</label>
                      <input type="text" class="form-control" id="cmenu_title" name="cmenu_title" placeholder="Menu title" required/>
                    </div>

                    <div class="form-group">
                      <label for="cmenu_header">Menu header</label>
                      <input type="text" class="form-control" id="cmenu_header" name="cmenu_header" placeholder="Menu header"/>
                    </div>

                    <div class="form-group">
                      <label for="cmenu_picture">Menu picture (Optional)</label>
                      <input type="file" class="form-control" id="page_picture" name="page_picture"/>
                    </div>

                    <div class="form-group">
                      <label for="page_content">Content</label>
                      <textarea name="page_content" id="myTextarea"></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary mr-2" name="menusave">Save</button>
                  </form>
                <?php } ?>






                <?php if(isset($_GET['preview'])) {

                  $stmt30= $object->getPageData($_GET['preview']);
                  $prevrow= $stmt30->FETCH(PDO::FETCH_ASSOC);
                ?>
                  <h3 class="card-title">Preview and Update this page </h3>

                  <?php
                    if(isset($_POST['pageupdate'])) {
                      if($object->updateSubMenu($_GET['preview'], $_POST['cmenu_title'], $_POST['cmenu_header'], $_POST['page_content'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Updating is successful!</h5></center>';
                        echo "<script>window.location='?allmenus'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                      }
                    }
                  ?>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="cmenu_title">Menu title(name)</label>
                      <input type="text" class="form-control" id="cmenu_title" name="cmenu_title" value="<?php echo $prevrow['cmenu_name']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="cmenu_header">Menu header</label>
                      <input type="text" class="form-control" id="cmenu_header" name="cmenu_header" value="<?php echo $prevrow['cmenu_header']; ?>"/>
                    </div>

                    <div class="form-group">
                      <label for="page_content">Content</label>
                      <textarea name="page_content" id="myTextarea"><?php echo $prevrow['page_content']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary mr-2" name="pageupdate">Update</button>
                  </form>
                <?php } ?>







                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Some script -->
        <script type="text/javascript">
          document.getElementById('prevppic').style.display ='none';
          document.getElementById('hideppic').style.display ='none';

          //document.getElementById('viewppic').style.display ='none';
          document.addEventListener('click', doStuffs).getElementById('viewppic');
          function doStuffs() {
            document.getElementById('viewppic').style.display ='none';
            document.getElementById('prevppic').style.display ='block';
            document.getElementById('hideppic').style.display ='block';
          }

          document.addEventListener('click', hideStuffs).getElementById('hideppic');
          function hideStuffs() {
            document.getElementById('prevppic').style.display ='none';
            document.getElementById('hideppic').style.display ='none';
          }

        </script>