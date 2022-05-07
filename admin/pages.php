<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!-- 
        @Gadrawingz 
        Coding pen by https://github.com/Gadrawingz 
      -->
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="row">
    
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <?php 
                // remove
                if(isset($_GET['rempage'])) {
                  if($object->removeSpecificPage($_GET['rempage'])) {
                    echo'<center><h5 class="btn btn-sm btn-danger text-center">Page is Removed!</h5></center>';
                    echo "<script>window.location='?allmenus'</script>";
                  }
                }

                if(isset($_GET['rem_menu'])) {
                  if($object->removeSpecificMenu($_GET['rem_menu'])) {
                    echo'<center><h5 class="btn btn-sm btn-danger text-center">Menu is Deleted!</h5></center>';
                    echo "<script>window.location='?allmenus'</script>";
                  }
                }

                if(isset($_GET['allmenus'])) { ?>
                  <div class="row col-md-12">
                    <div class="col-md-12">
                      <div class="d-flex justify-content-between align-items-center">
                    <div><h3 class="font-weight-bold mb-0">Menus
                      <a class="btn btn-sm btn-success" href="../admin/pages?n_m_menu" style="margin-right: 2px;">Create Menu</a>
                    </h3></div>
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
                          <td>
                            <p>
                              <a href="../admin/pages?rn_menu=<?php echo $menu['menu_id']; ?>" class="btn btn-sm btn-primary"
                                style="margin: 6px 0 6px 0!important; padding: 3px 5px!important;">
                              <i class="ti-pencil" title="Edit"></i></a>&nbsp;&nbsp;
                              <a href="?rem_menu=<?php echo $menu['menu_id']; ?>" class="btn btn-sm btn-danger" title="Delete" style=" margin: 6px 0 6px 0!important; padding: 3px 5px!important;" onclick="return confirm('Make sure you will not need this page anymore, Because, Once it is deleted you can bring back data!')">
                              <i class="ti-trash"></i></a>&nbsp;&nbsp;
                              <?php echo $menu['menu_name']; ?> <i>(menu)</i>
                            </p>
                            

                            <p>
                              Located on <b>
                              <?php
                              if($menu['menu_side']=='Top') { echo "Navigation "; } else {
                                echo "Footer "; } ?>
                              </b>side</p>
                            <p></p>

                          </td>
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
                                  <a class="btn btn-sm btn-success" href="../admin/pages?newmenu=<?php echo $menu['menu_id']; ?>&sm=<?php echo $cmenu['sub_menu_id']; ?>" style="margin-right: 2px;">Add SubMenu</a>
                                <?php } else { ?>
                                  <button class="btn btn-sm btn-danger" disabled style="margin-right: 2px;">Categories</button>
                                <?php }}} ?>
                                &nbsp;&raquo;&nbsp;<?php echo $cmenu['sub_menu_title']; ?>
                                &nbsp;- &nbsp;<a href="../admin/pages?rename_t=<?php echo $cmenu['sub_menu_id']; ?>" class="btn btn-sm btn-primary" style="margin: 6px 0 6px 0!important; padding: 3px 5px!important;"><i class="ti-pencil" title="Edit"></i></a>
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
                                        <a class="btn btn-sm btn-secondary" title="Add related page" href="pages_more?p_related=<?php echo $csmenu['cmenu_id']; ?>"><i class="ti-folder"></i>
                                        </a>
                                        <a href="?rempage=<?php echo $csmenu['cmenu_id']; ?>" class="btn btn-sm btn-danger"
                                        style="
                                        margin: 6px 0 6px 0!important; 
                                        padding: 3px 5px!important;"
                                        onclick="return confirm('Are you sure you want to delete this page?')">
                                        <i class="ti-trash"></i></a>&nbsp;&nbsp;
                                        <a href="?preview=<?php echo $csmenu['cmenu_id']; ?>"><?php echo $csmenu['cmenu_name']; ?>

                                        <i class='ti ti-eye'></i>
                                        <?php
                                        $stmtViews=$object->getSpecificPageBySlug($csmenu['cmenu_url']);
                                        $vrow= $stmtViews->FETCH(PDO::FETCH_ASSOC);
                                          echo $vrow['views'];
                                        ?>
                                        </a>
                                        <?php
                                        if($object->check4TabbedContent($csmenu['cmenu_id'])) {
                                          echo "<span class='text-black'><b> | This page has tabs</b></span>";
                                        }
                                        ?>
                                      <?php } ?>
                                      </li>
                                    <?php } ?>
                                  </ol>
                                <?php }}} else if($menu['menu_url']!='home' && $menu['menu_url']!='videos' && $menu['menu_url']!='contact' && $menu['has_submenu']!='Yes'){ 

                                $stmt39= $object->getContentSubMenusByMenu($menu['menu_id']);
                                $cmenu39= $stmt39->FETCH(PDO::FETCH_ASSOC);
                                ?>
                                <center><a class="btn btn-sm btn-primary" href="../admin/pages?preview=<?php echo $cmenu39['cmenu_id']; ?>">Add content</a></center>
                              <?php } else {
                                echo '<p class="text-warning text-center">This page is static | <strong>| No edit</strong></p>';
                              }?>
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
                    Add new menu to <strong>&laquo;<u><?php echo $sub_item['sub_menu_title']; ?></u>&raquo;</strong> section &nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/pages?allmenus">Back to menus</a>
                  </h3>

                  <?php
                    if(isset($_POST['cmenusave'])) {
                      if($object->regSubContentMenu($_GET['newmenu'], $_GET['sm'], $_POST['cmenu_title'], $_POST['cmenu_title_rw'], $_POST['cmenu_title_fr'], $_POST['content_format'])) {
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
                      <label for="cmenu_title_rw">Title in <span class="text-primary">(Kinyarwanda)</span></label>
                      <input type="text" class="form-control" id="cmenu_title_rw" name="cmenu_title_rw" required/>
                    </div>

                    <div class="form-group">
                      <label for="cmenu_title_fr">Title in <span class="text-primary">(French)</span></label>
                      <input type="text" class="form-control" id="cmenu_title_fr" name="cmenu_title_fr" value="..." required/>
                    </div>

                    <div class="form-group">
                      <label for="content_format">Content Format</label>
                      <select class="form-control" name="content_format" required/>
                          <option value="">Select format here</option>
                          <option value="Untabbed">Normal style(No tabs)</option>
                          <option value="Tabbed">Tabbed style (With tabs)</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="cmenusave">Save</button>
                  </form>
                <?php } ?>





                <?php if(isset($_GET['n_m_menu'])) { ?>
                  <h2 class="card-title">
                    Create new main menu&laquo;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/pages?allmenus">Back to menus</a>
                  </h2>
                  <p class="text-warning font-weight-semibold"><b>N.B: </b>Creating new menu can affect site organization, before creating it, notify site developer to avoid breaking other functionalities!</p>

                  <?php
                    if(isset($_POST['menusave'])) {
                      if($object->regMainMenu($_POST['menu_name'], $_POST['menu_name_rw'], $_POST['menu_name_fr'], $_POST['menu_behavior'], $_POST['menu_side'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Created successfully!</h5></center>';
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Failure!</h5></center>';
                      }
                    }
                  ?>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="menu_name">Menu Name</label>
                      <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Menu title" required/>
                    </div>

                    <div class="form-group">
                      <label for="menu_behavior">Menu behavior</label>
                      <select class="form-control" name="menu_behavior" required/>
                          <option value="">Select here</option>
                          <option value="No">Has no sub-menus</option>
                          <option value="Yes">Has sub-menus</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="menu_side">Menu Location</label>
                      <select class="form-control" name="menu_side" required/>
                          <option value="">Select here</option>
                          <option value="Top">Top</option>
                          <option value="Bottom">Bottom</option>
                      </select>
                    </div>

                    <h4>Other Settings</h4>
                    <div class="form-group">
                      <label for="menu_name_rw">Title in <span class="text-primary">(Kinyarwanda)</span></label>
                      <input type="text" class="form-control" id="menu_name_rw" name="menu_name_rw" placeholder="Translate in Kinyarwanda" required/>
                    </div>

                    <div class="form-group">
                      <label for="menu_name_fr">Title in <span class="text-primary">(French)</span></label>
                      <input type="text" class="form-control" id="menu_name_fr" name="menu_name_fr" value="Translate..." required/>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="menusave" disabled>Save</button>

                  </form>
                <?php } ?>







                <?php if((isset($_GET['rename_t'])) && (!empty($_GET['rename_t']))) { ?>
                  <h3 class="card-title">
                    <?php
                    $stmt37= $object->getSubMenusItem($_GET['rename_t']);
                    $sub_item= $stmt37->FETCH(PDO::FETCH_ASSOC);
                    ?>
                  </h3>

                  <?php
                    if(isset($_POST['saveRename'])) {
                      if($object->renameMenuLabel($_GET['rename_t'], $_POST['m_title'], $_POST['m_title_rw'], $_POST['m_title_fr'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Renaming is successful!</h5></center>';
                        echo "<script>window.location='?allmenus'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                        echo "<script>window.location='?allmenus'</script>";
                      }
                    }
                  ?>

                  <form class="forms-sample" method="POST">
                    <div class="form-group">
                      <label for="m_title">Title</label>
                      <input type="text" class="form-control" id="m_title" name="m_title" value="<?php echo $sub_item['sub_menu_title']; ?>" required/>
                    </div>
                    <h4>Other Settings</h4>
                    <div class="form-group">
                      <label for="m_title_rw">Title in <span class="text-primary">(Kinyarwanda)</span></label>
                      <input type="text" class="form-control" id="m_title_rw" name="m_title_rw" value="<?php echo $sub_item['sub_menu_title_rw']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="m_title_fr">Title in <span class="text-primary">(French)</span></label>
                      <input type="text" class="form-control" id="m_title_fr" name="m_title_fr" value="<?php echo $sub_item['sub_menu_title_fr']; ?>" required/>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="saveRename">Save Changes</button>
                  </form>
                <?php } ?>





                <?php if((isset($_GET['rn_menu'])) && (!empty($_GET['rn_menu']))) { ?>
                  <h3 class="card-title">
                    <?php
                    $stmt38= $object->getSingleMenu($_GET['rn_menu']);
                    $menu_item= $stmt38->FETCH(PDO::FETCH_ASSOC);
                    ?>
                  </h3>
                  <?php
                    if(isset($_POST['renameBtn'])) {
                      if($object->renameMainMenu($_GET['rn_menu'], $_POST['menu_name'], $_POST['menu_name_rw'], $_POST['menu_name_fr'], $_POST['menu_side'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Name is changed successfully!</h5></center>';
                        echo "<script>window.location='?allmenus'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Renaming has failed!</h5></center>';
                        echo "<script>window.location='?allmenus'</script>";
                      }
                    }
                  ?>

                  <form class="forms-sample" method="POST">
                    <div class="form-group">
                      <label for="menu_name">Title</label>
                      <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?php echo $menu_item['menu_name']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="menu_side">Side</label>
                      <select class="form-control" name="menu_side" required/>
                          <option value="<?php echo $menu_item['menu_side']; ?>"><?php echo $menu_item['menu_side']; ?></option>
                          <option value="Top">Top</option>
                          <option value="Bottom">Bottom</option>
                      </select>
                    </div>

                    <h4>Other Settings</h4>
                    <div class="form-group">
                      <label for="menu_name_rw">Title in <span class="text-primary">(Kinyarwanda)</span></label>
                      <input type="text" class="form-control <?php if(empty($menu_item['menu_name_rw'])) echo "text-danger"; else echo "text-dark"; ?>" id="menu_name_rw" name="menu_name_rw" value="<?php if(!empty($menu_item['menu_name_rw'])) echo $menu_item['menu_name_rw']; else echo "Translate..."; ?>" required/>
                    </div>
                    <div class="form-group">
                      <label for="menu_name_fr">Title in <span class="text-primary">(French)</span></label>
                      <input type="text" class="form-control <?php if(empty($menu_item['menu_name_fr'])) echo "text-danger"; else echo "text-dark"; ?>" id="menu_name_fr" name="menu_name_fr" value="<?php if(!empty($menu_item['menu_name_fr'])) echo $menu_item['menu_name_fr']; else echo "Translate..."; ?>" required/>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="renameBtn">Save Changes</button>
                  </form>
                <?php } ?>





                <?php if(isset($_GET['preview'])) {

                  $stmt30= $object->getSubMenuData($_GET['preview']);
                  $prevrow= $stmt30->FETCH(PDO::FETCH_ASSOC);
                ?>
                  <h3 class="card-title">Preview and Update this page </h3>
                  <?php
                  if(isset($_POST['p_title_update'])) {
                    if($object->updateSubMenuTitleAndLinks($_GET['preview'], $_POST['cmenu_title'],  $_POST['cmenu_title_rw'], $_POST['featured_link'],  $_POST['link_order'])) {
                      echo'<center><h5 class="btn btn-sm btn-success text-center">Updating is successful!</h5></center>';
                      echo "<script>window.location='?allmenus'</script>";
                    } else {
                      echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                    }
                  }
                  
                  if($prevrow['page_type']=='Untabbed' || $prevrow['page_type']=='Single'){ ?>
                  <!-- Caring about content titles -->
                  <?php if(!isset($_GET['ct_lang'])) { ?>

                  <div class="text-left">
                    <a class="btn-sm btn-primary" href="?preview=<?php echo $_GET['preview']."&ct_lang=ct_en"; ?>">View English Content</a>&nbsp;|&nbsp;
                    <a class="btn-sm btn-primary" href="?preview=<?php echo $_GET['preview']."&ct_lang=ct_rw"; ?>">View Kinyarwanda Content</a>&nbsp;|&nbsp;
                    <a class="btn-sm btn-success" href="pages_more?p_related=<?php echo $_GET['preview']; ?>">Add Related Page</a>   
                  </div><br><br>

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div style="border-left: 2px solid blue!important; margin-right: 4px!important;">
                      <div class="form-group">
                        <label for="cmenu_title">Content title /<span class="text-primary">English</span></label>
                        <input type="text" class="form-control" id="cmenu_title" name="cmenu_title" value="<?php echo $prevrow['cmenu_name']; ?>" required/>
                      </div>

                      <div class="form-group">
                        <label for="cmenu_title_rw">Content title /<span class="text-primary">Kinyarwanda</span></label>
                        <input type="text" class="form-control" id="cmenu_title_rw" name="cmenu_title_rw" value="<?php echo $prevrow['cmenu_name_rw']; ?>" required/>
                      </div>

                      <hr style="background-color: blue; height: 8px;">

                      <div class="form-group">
                        <label for="featured_link" class="font-weight-bold">Add featured link (msola.org site reference)<span class="text-primary"></span></label>
                        <input type="text" class="form-control" id="featured_link" name="featured_link" value="<?php echo $prevrow['featured_link']; ?>"/>
                      </div>

                      <div class="form-group">
                        <label for="featured_link" class="font-weight-bold">Select page (website link to show)<span class="text-primary"></span></label>
                        <select class="form-control" name="link_order" required>
                          <option value="<?php echo $prevrow['link_order']; ?>"><?php echo $prevrow['link_order']; if($prevrow['link_order']=='Featured') { echo " (From another site)"; } else { echo " (From this site)"; } ?></option>
                          <option value="Featured">Featured (From another site)</option>
                          <option value="Original">Original (From this website)</option>
                        </select>
                      </div>

                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mr-2" name="p_title_update">Update</button>
                  </form>
                  <?php } ?>

                  <!-- Caring about content versions -->
                  <?php
                  if(isset($_GET['ct_lang']) && $_GET['ct_lang']!='' && (isset($_GET['preview']) && $_GET['preview']!='')) {

                    if(isset($_POST['p_cont_update'])) {
                      if(isset($_GET['ct_lang']) && $_GET['ct_lang']=='ct_en') {
                        $content_col = "page_content";
                      } else if(isset($_GET['ct_lang']) && $_GET['ct_lang']=='ct_rw') {
                        $content_col = "page_content_rw";
                      }

                      if($object->updateSubMenuContent($_GET['preview'], $content_col, $_POST['page_content'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Updating is successful!</h5></center>';
                        echo "<script>window.location='?allmenus'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                      }
                    }
                  ?>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">  
                    <div class="text-left">
                    <?php if($_GET['ct_lang']=='ct_rw') { ?>
                    <a href="?preview=<?php echo $_GET['preview']."&ct_lang=ct_en"; ?>">View English Content</a>&nbsp;&laquo;
                    <?php } else if($_GET['ct_lang']=='ct_en') { ?>
                    <a href="?preview=<?php echo $_GET['preview']."&ct_lang=ct_rw"; ?>">View Kinyarwanda Content</a>  
                    <?php } ?>
                    </div><br>
                    
                    <?php if(isset($_GET['ct_lang']) && $_GET['ct_lang']=='ct_en') { ?>
                    <div class="form-group">
                      <label>Page Content /<span class="text-primary">English</span></label>
                      <textarea name="page_content" id="textContent"><?php echo $prevrow['page_content']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mr-2" name="p_cont_update">Update</button>

                    <?php } if(isset($_GET['ct_lang']) && $_GET['ct_lang']=='ct_rw') { ?>
                    <div class="form-group">
                      <label>Page Content /<span class="text-primary">Kinyarwanda</span></label>
                      <textarea name="page_content" id="textContent"><?php echo $prevrow['page_content_rw']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mr-2" name="p_cont_update">Update</button>
                    <?php } ?>
                  </form>
                  <?php } ?>




                  <?php } /*Closing Untabbed */ 
                  if($prevrow['page_type']=='Tabbed'){ ?>
                    <?php 
                    $tabCheck = $object->check4TabbedContent($_GET['preview']);
                    // If tabs are between 0 and 5 create new tab...
                    if($tabCheck==0 || $tabCheck<5){ 
                      if(!isset($_GET['newtab'])) { ?>
                        <a href="?preview=<?php echo $_GET['preview'] ?>&newtab" class="btn btn-sm btn-primary">Add new tab</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a class="btn-sm btn-success" href="pages_more?p_related=<?php echo $_GET['preview']; ?>">Add Related Page</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                        <?php if(!isset($_GET['tb_lang']) || ($_GET['tb_lang']!='tb_rw')) { ?>
                        <a href="?preview=<?php echo $_GET['preview'] ?>&tb_lang=tb_rw" class="btn btn-sm btn-warning font-weight-bold text-white">Tabs in Kinyarwanda</a><br>
                        <?php } else if(isset($_GET['tb_lang']) || ($_GET['tb_lang']=='tb_rw') || ($_GET['tb_lang']=='tb_fr')){?>
                        <a href="?preview=<?php echo $_GET['preview'] ?>" class="btn btn-sm btn-success font-weight-bold text-white">Tabs in English</a><br>
                        <?php } ?>


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
                        <button type="submit" class="btn btn-sm btn-primary mr-2" name="tabsave">Save</button>&nbsp;<a href="?preview=<?php echo $_GET['preview'] ?>&ct=ct_en" class="btn btn-sm btn-danger">Cancel</a><br><br>
                      </form>
                      <?php } ?>
                    <?php } ?>

                    <?php
                    // PREVIEW TAB WHICH IS IN ENGLISH
                    $stmt73= $object->getTabsDataPerPage($_GET['preview']);

                    // Show default tab(english) only if tab in french, kinyarwanda is not set
                    if(!isset($_GET['tb_lang']) || isset($_GET['tb_lang']) && ($_GET['tb_lang']=='tb_en' && $_GET['tb_lang']!='tb_rw' && $_GET['tb_lang']!='tb_fr')) {
                      // If its about creating new tab, Don't show preview
                      if(!isset($_GET['newtab'])) {

                    while($tabbedrow= $stmt73->FETCH(PDO::FETCH_ASSOC)) {

                      if(isset($_POST['tabupdate'])){
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
                        <textarea name="tab_content" class="tabContent"><?php echo strip_tags($tabbedrow['tab_content']); ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-sm btn-success mr-2" name="tabupdate">Save changes</button>
                    </form>
                    <?php }
                      } /* Don't show this on new tab */ 
                    } /* Closing preview tab in english */


                    // PREVIEW TAB WHICH IS IN KINYARWANDA
                    if(isset($_GET['tb_lang']) && $_GET['tb_lang']=='tb_rw') {
                      // Get some records in kiny: tabs
                      $stmt74= $object->getTabsDataPerPageRw($_GET['preview']);
                      while($tabbedrow= $stmt74->FETCH(PDO::FETCH_ASSOC)) {
                        if(isset($_POST['tabupdate_rw'])){
                          if($object->updateContentTabsRw($_POST['tab_id'], $_POST['tab_title'], $_POST['tab_content'])) {
                            echo'<center><h5 class="btn btn-sm btn-success text-center">Updating is successful!</h5></center>';
                            echo "<script>window.location='?preview=$_GET[preview]&tb_lang=tb_rw'</script>";
                          } else {
                            echo'<center><h5 class="btn btn-sm btn-danger text-center">Failed!</h5></center>';
                          }
                        }
                    ?>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data" style="border: 2px solid blue!important; margin: 3px 0 15px 0!important; border-radius: 8px; padding: 8px; ">
                      <br><hr>
                      <div class="form-group">
                        <label for="tab_title">Tab title <span class="text-primary">(Kinyarwanda)</span></label>
                        <p class="font-weight-bold">
                          Reference Title:<u><?php echo $tabbedrow['tab_title_en_ref']; ?></u>
                        </p>
                        <input type="hidden" class="form-control" id="tab_id" name="tab_id" value="<?php echo $tabbedrow['tab_id']; ?>"/>
                        <input type="text" class="form-control" id="tab_title" name="tab_title" value="<?php echo $tabbedrow['tab_title']; ?>" required/>
                      </div>
                      <div class="form-group">
                        <label for="tab_content">Tab content <span class="text-primary">(Kinyarwanda)</span></label>
                        <textarea name="tab_content" class="tabContent"><?php echo strip_tags($tabbedrow['tab_content']); ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-sm btn-success mr-2" name="tabupdate_rw">Save changes</button>
                    </form>
                    <?php }} // Closing preview tab in Kinyarwanda ?><br>



                  <?php }} ?><br>



                </div>
              </div>
            </div>
          </div>
          
        </div>

        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>
