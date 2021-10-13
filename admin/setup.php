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












                <?php 

                // remove
                if(isset($_GET['rempage'])) {
                  if($object->removeSpecificPage($_GET['rempage'])) {
                    echo "<script>window.location='?allmenus'</script>";
                    echo'<center><h5 class="btn btn-sm btn-danger text-center">Page is Removed!</h5></center>';
                  }
                }

                if(isset($_GET['allmenus'])) { ?>
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
                            <ul class="main-ul">
                              <?php
                                $stmt3= $object->getSubMenus($menu['menu_id']);
                                while($cmenu= $stmt3->FETCH(PDO::FETCH_ASSOC)) {
                                ?>
                                <li class="unshitli">
                                  <?php
                                  if($menu['has_submenu']=='Yes') {
                                    if($_SESSION['admin_role']=='Admin') { 
                                      if($cmenu['sub_menu_id']!=10) {
                                  ?>
                                  <a class="btn btn-sm btn-success" href="../admin/setup?newmenu=<?php echo $menu['menu_id']; ?>&sm=<?php echo $cmenu['sub_menu_id']; ?>" style="margin-right: 2px;">Add menu</a>
                                <?php } else { ?>
                                  <button class="btn btn-sm btn-danger" disabled style="margin-right: 2px;">Categoties</button>
                                <?php }}} ?>
                                &nbsp;&raquo;&nbsp;<?php echo $cmenu['sub_menu_title']; ?>
                                </li>

                                  <?php

                                  $stmt6=$object->getContentSubMenus($cmenu['sub_menu_id']);
                                  $testif= $stmt6->FETCH(PDO::FETCH_ASSOC);
                                  if(!empty($testif['cmenu_name'])) { 
                                  ?>
                                  <ol class="inside-uls">
                                    <?php
                                    $stmt40=$object->getContentSubMenus($cmenu['sub_menu_id']);
                                      while($csmenu= $stmt40->FETCH(PDO::FETCH_ASSOC)){
                                    ?>
                                      <li>
                                        <?php if($cmenu['sub_menu_id']=='10') { ?>
                                        <a href="articles?view" class="btn btn-sm btn-warning"
                                        style="
                                        margin: 6px 0 6px 0!important; 
                                        padding: 3px 5px!important;"
                                        >
                                        <i class="ti-eye"></i></a>&nbsp;&nbsp;
                                        <a href="articles?view" class="text-dark"><?php echo $csmenu['cmenu_name']; ?></a>
                                      <?php } else { ?>
                                        <a href="?rempage=<?php echo $csmenu['cmenu_id']; ?>" class="btn btn-sm btn-danger"
                                        style="
                                        margin: 6px 0 6px 0!important; 
                                        padding: 3px 5px!important;"
                                        onclick="return confirm('Are you sure you want to delete this page?')">
                                        <i class="ti-trash"></i></a>&nbsp;&nbsp;
                                        <a href="?preview=<?php echo $csmenu['cmenu_id']; ?>"><?php echo $csmenu['cmenu_name']; ?></a>
                                      <?php } ?>
                                      </li>
                                    <?php } ?>
                                  </ol>
                                <?php }}} else if($menu['menu_url']!='home' && $menu['has_submenu']!='Yes'){ 

                                $stmt39= $object->getContentSubMenusByMenu($menu['menu_id']);
                                $cmenu39= $stmt39->FETCH(PDO::FETCH_ASSOC);
                                ?>
                                <center><a class="btn btn-sm btn-primary" href="../admin/setup?preview=<?php echo $cmenu39['cmenu_id']; ?>">Add content</a></center>
                              <?php } ?>
                            </ul>
                          </td>
                        </tr>
                      <?php $num++; } ?>
                      </tbody>
                    </table>
                    <!-- End card row -->
                  </div>
                <?php } ?>



                <?php if((isset($_GET['newmenu']) && isset($_GET['sm'])) && (!empty($_GET['newmenu']) && !empty($_GET['sm']))) { ?>
                  <h3 class="card-title">
                    <?php
                    $stmt37= $object->getSubMenusItem($_GET['sm']);
                    $sub_item= $stmt37->FETCH(PDO::FETCH_ASSOC);
                    ?>
                    Add new menu to <strong>&laquo;<u><?php echo $sub_item['sub_menu_title']; ?></u>&raquo;</strong> section &nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/setup?allmenus">Back to menus</a>
                  </h3>

                  <?php
                    if(isset($_POST['cmenusave'])) {
                      if($object->regSubContentMenu($_GET['newmenu'], $_GET['sm'], $_POST['cmenu_title'], $_POST['cmenu_header'], $_POST['content_format'])) {
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
                      <label for="cmenu_header">Content Format</label>
                      <select class="form-control" name="content_format" required/>
                          <option value="">Select format here</option>
                          <option value="Untabbed">Normal style(No tabs)</option>
                          <option value="Tabbed">Tabbed style (With tabs)</option>
                      </select>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="cmenusave">Save</button>

                  </form>
                <?php } ?>






                <?php if(isset($_GET['preview'])) {

                  $stmt30= $object->getSubMenuData($_GET['preview']);
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

                  <?php if($prevrow['page_type']=='Untabbed'){ ?>
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
                      <textarea name="page_content" id="textContent"><?php echo $prevrow['page_content']; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary mr-2" name="pageupdate">Update</button>
                  </form>
                  <?php } if($prevrow['page_type']=='Tabbed'){ ?>
                    
                    <?php 
                    $tabCheck = $object->check4TabbedContent($_GET['preview']);
                    if($tabCheck==0 || $tabCheck<5){ 

                      if(!isset($_GET['newtab'])) { ?>
                        <a href="?preview=<?php echo $_GET['preview'] ?>&newtab" class="btn btn-sm btn-primary">Add new tab</a><br>
                      <?php } ?>
                      
                      <?php if(isset($_GET['newtab'])) {
                        if(isset($_POST['tabsave'])) {
                          if($object->addNewTab($_GET['preview'], $_POST['tab_title'], $_POST['tab_content']))  {
                            echo'<center><h5 class="btn btn-sm btn-success text-center">Tab is added!</h5></center>';
                            echo "<script>window.location='?preview=$_GET[preview]'</script>";
                          } else {
                            echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                            echo "<script>window.location='?preview=$_GET[preview]'</script>";
                          }
                        }
                      ?>
                      <form class="forms-sample" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="tab_title">Tab title</label>
                          <input type="text" class="form-control" id="tab_title" name="tab_title" required/>
                        </div>

                        <div class="form-group">
                          <label for="">Tab content</label>
                          <textarea name="tab_content" id="textContent"></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mr-2" name="tabsave">Save</button>&nbsp;<a href="?preview=<?php echo $_GET['preview'] ?>" class="btn btn-sm btn-danger">Cancel</a><br><br>
                      </form>
                      <?php } ?>
                    <?php } ?>



                    <?php
                    $stmt73= $object->getTabsDataPerPage($_GET['preview']);
                    while($tabbedrow= $stmt73->FETCH(PDO::FETCH_ASSOC)) {

                      if(isset($_POST['tabupdate'])) {

                        if($object->updateContentTabs($_POST['tab_id'], $_POST['tab_title'], $_POST['tab_content'])) {
                          echo'<center><h5 class="btn btn-sm btn-success text-center">Updating is successful!</h5></center>';
                          echo "<script>window.location='?preview=$_GET[preview]'</script>";
                        } else {
                          echo'<center><h5 class="btn btn-sm btn-danger text-center">Failed!</h5></center>';
                      }
                    }


                    ?>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data" style="border: 2px solid blue!important; margin: 3px 0 15px 0!important; border-radius: 8px; padding: 8px; ">
                      <br><hr>
                      <div class="form-group">
                          <label for="tab_title">Tab title</label>
                          <input type="hidden" class="form-control" id="tab_id" name="tab_id" value="<?php echo $tabbedrow['tab_id']; ?>"/>
                          <input type="text" class="form-control" id="tab_title" name="tab_title" value="<?php echo $tabbedrow['tab_title']; ?>" required/>
                      </div>
                      <div class="form-group">
                        <label for="tab_content">Tab content</label>
                        <textarea name="tab_content" class="tabContent"><?php echo $tabbedrow['tab_content']; ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-sm btn-success mr-2" name="tabupdate">Save changes</button>
                    </form>
                  <?php }}} ?><r>





                </div>
              </div>
            </div>
          </div>
          
        </div>

        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>

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