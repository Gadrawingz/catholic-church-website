<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">


          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Add or update social media</h3>

                  <?php

                    if(isset($_POST['savesocial'])) {
                      if($object->regSocialMedia($_POST['soc_name'], $_POST['soc_url'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                      }
                    }

                    if(isset($_POST['updatesocial'])) {
                      if($object->updateSocialMedia($_POST['soc_name'], $_POST['soc_url'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                      }
                    }
                  ?>

                  <form method="POST">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="hidden" class="form-control" value="facebook" name="soc_name">

                        <?php 
                        if($object->checkSocialMedia('facebook')) {
                          $stmt= $object->readOneSocial('facebook');
                          $result= $stmt->FETCH(PDO::FETCH_ASSOC);
                        ?>
                        <input type="text" class="form-control" value="<?php echo $result['soc_url']; ?>" name="soc_url">
                        <?php } else { ?>
                        <input type="text" class="form-control" placeholder="Add facebook link" name="soc_url">
                        <?php } ?>

                        <div class="input-group-append">
                          <button class="btn btn-sm btn-facebook" type="button">
                            <i class="ti-facebook"></i>
                          </button>&nbsp;&nbsp;&nbsp;
                          <?php if($object->checkSocialMedia('facebook')) { ?>
                            <button type="submit" name="updatesocial" class="btn btn-primary mr-2">Update</button>
                          <?php } else { ?>
                            <button type="submit" name="savesocial" class="btn btn-success mr-2">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </form>

                  <form method="POST">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="hidden" class="form-control" value="twitter" name="soc_name">
                        <?php 
                        if($object->checkSocialMedia('twitter')) {
                          $stmt= $object->readOneSocial('twitter');
                          $result= $stmt->FETCH(PDO::FETCH_ASSOC);
                        ?>
                        <input type="text" class="form-control" value="<?php echo $result['soc_url']; ?>" name="soc_url">
                        <?php } else { ?>
                        <input type="text" class="form-control" placeholder="Add twitter link" name="soc_url">
                        <?php } ?>

                        <div class="input-group-append">
                          <button class="btn btn-sm btn-twitter" type="button">
                            <i class="ti-twitter-alt"></i>
                          </button>&nbsp;&nbsp;&nbsp;
                          <?php if($object->checkSocialMedia('twitter')) { ?>
                            <button type="submit" name="updatesocial" class="btn btn-primary mr-2">Update</button>
                          <?php } else { ?>
                            <button type="submit" name="savesocial" class="btn btn-success mr-2">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </form>

                  <form method="POST">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="hidden" class="form-control" value="linkedin" name="soc_name">
                        <?php 
                        if($object->checkSocialMedia('linkedin')) {
                          $stmt= $object->readOneSocial('linkedin');
                          $result= $stmt->FETCH(PDO::FETCH_ASSOC);
                        ?>
                        <input type="text" class="form-control" value="<?php echo $result['soc_url']; ?>" name="soc_url">
                        <?php } else { ?>
                        <input type="text" class="form-control" placeholder="Add LinkedIn link" name="soc_url">
                        <?php } ?>

                        <div class="input-group-append">
                          <button class="btn btn-sm btn-linkedin" type="button">
                            <i class="ti-linkedin"></i>
                          </button>&nbsp;&nbsp;&nbsp;
                          <?php if($object->checkSocialMedia('linkedin')) { ?>
                            <button type="submit" name="updatesocial" class="btn btn-primary mr-2">Update</button>
                          <?php } else { ?>
                            <button type="submit" name="savesocial" class="btn btn-success mr-2">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </form>

                  <form method="POST">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="hidden" class="form-control" value="youtube" name="soc_name">
                        <?php 
                        if($object->checkSocialMedia('youtube')) {
                          $stmt= $object->readOneSocial('youtube');
                          $result= $stmt->FETCH(PDO::FETCH_ASSOC);
                        ?>
                        <input type="text" class="form-control" value="<?php echo $result['soc_url']; ?>" name="soc_url">
                        <?php } else { ?>
                        <input type="text" class="form-control" placeholder="Add Youtube link" name="soc_url">
                        <?php } ?>

                        <div class="input-group-append">
                          <button class="btn btn-sm btn-youtube" type="button">
                            <i class="ti-youtube"></i>
                          </button>&nbsp;&nbsp;&nbsp;
                          <?php if($object->checkSocialMedia('youtube')) { ?>
                            <button type="submit" name="updatesocial" class="btn btn-primary mr-2">Update</button>
                          <?php } else { ?>
                            <button type="submit" name="savesocial" class="btn btn-success mr-2">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </form>



                </div>
              </div>
            </div>








        </div>
        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>