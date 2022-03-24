<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
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

                <?php if(isset($_GET['preview'])){

                  $stmt30= $object->getSubMenuData($_GET['preview']);
                  $prevrow= $stmt30->FETCH(PDO::FETCH_ASSOC);
                ?>
                  <h3 class="card-title">Preview this page </h3>

                  <?php if($prevrow['page_type']=='Untabbed' || $prevrow['page_type']=='Single'){ ?>
                  <div name="page_content" id="textContent">
                        <?php echo $prevrow['page_content']; ?>
                          
                  </div>
                  <?php }} ?><br>

                </div>
              </div>
            </div>
          </div>
          
        </div>

        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>