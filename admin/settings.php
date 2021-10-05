<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">


          <?php if(isset($_GET['view'])) { ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">List of admins</h3>
                </div>
                
                <div>
                  <a href="manage?register" class="btn btn-primary btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Add new
                  </a>
                </div>
              </div>
            </div>
          </div>

          <?php if(isset($_GET['message'])) { ?>
            <center><h5 class="btn btn-sm btn-success text-center">Operation is successful!</h5></center>
          <?php } ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <div class="row col-md-12">
                    <!-- Xtt card row -->
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Role</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $num = 1;
                        $stmt= $object->viewAdmins();
                        while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      ?>
                        <tr>
                          <td><?php echo $num; ?></td>
                          <td><?php echo $row['firstname']; ?></td>
                          <td><?php echo $row['lastname']; ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['given_role']; ?></td>
                          <td class="text-center"><a class="btn btn-sm btn-primary" href="../admin/manage?update=<?php echo $row['admin_id']; ?>">Update</a></td>
                        </tr>
                      <?php $num++; } ?>
                      </tbody>
                    </table>
                    <!-- End card row -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">

                  <?php if(isset($_GET['socials'])) { ?>
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
                <?php } ?>




                <?php if(isset($_GET['setup'])) { ?>
                  <h3 class="card-title">Setup website &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/dashboard" class="btn btn-sm btn-danger text-right">Exit</a></h3>

                  <?php
                  $id = 1;
                  $stmt90= $object->websiteSetupOne($id);
                  $editrow = $stmt90->FETCH(PDO::FETCH_ASSOC);
                  $checkSetup = $object->checkWebsiteSetup();

                    if(isset($_POST['settingsave']) && strlen($_POST['mission'])<=500) {
                      if(strlen($_POST['mission'])<=1500) {
                        if($object->setupWebsite($_POST['site_name'], $_POST['contact_no'], $_POST['contact_email'], $_POST['location'], $_POST['address'], $_POST['active_hours'], $_POST['main_quote'], $_POST['mission'], $_POST['date_started'])) {
                          echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                          echo "<script>window.location='?setup'</script>";
                        } else {
                          echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                        }
                      } else {
                      echo'<center><h5 class="btn btn-sm btn-danger text-center">Mission must be short!</h5></center>';
                        echo "<script>window.location='?setup'</script>";
                      }
                    }


                    if(isset($_POST['settingupd'])) {
                      if(strlen($_POST['mission'])<=1500) {
                        if($object->updateUpWebsite($id, $_POST['site_name'], $_POST['contact_no'], $_POST['contact_email'], $_POST['location'], $_POST['address'], $_POST['active_hours'], $_POST['main_quote'], $_POST['mission'], $_POST['date_started'])) {
                          echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                          echo "<script>window.location='?setup'</script>";
                        } else {
                          echo'<center><h5 class="btn btn-sm btn-danger text-center">Operation failed!</h5></center>';
                        }
                      } else {
                      echo'<center><h5 class="btn btn-sm btn-danger text-center">Mission must be short!</h5></center>';
                        echo "<script>window.location='?setup'</script>";
                      }
                    }


                    
                  ?>
                  <?php if($checkSetup==0) { ?>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                      <label for="site_name">Site name</label>
                      
                      <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Site name" required/>
                    </div>

                    <div class="form-group">
                      <label for="contact_no">Contact number</label>
                      <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact number"/>
                    </div>

                    <div class="form-group">
                      <label for="contact_email">Contact email</label>
                      <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Contact email"/>
                    </div>

                    <div class="form-group">
                      <label for="location">Location</label>
                      <input type="text" class="form-control" id="location" name="location" placeholder="Location" required/>
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Ex: Street no" required/>
                    </div>

                    <div class="form-group">
                      <label for="active_hours">Active hours</label>
                      <select class="form-control" id="active_hours" name="active_hours" required>
                        <option value="24 hours">24 hours</option>
                        <option value="12 hours">12 hours</option>
                        <option value="10 hours">10 hours</option>
                        <option value="9 hours">9 hours</option>
                        <option value="8 hours">8 hours</option>
                        <option value="7 hours">7 hours</option>
                        <option value="5 hours">5 hours</option>
                        <option value="4 hours">4 hours</option>
                        <option value="Closed">Closed</option>
                        <option value="Temporary closed">Temporary closed</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="main_quote">Quote</label>
                      <textarea class="form-control" id="main_quote" rows="6" name="main_quote" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="mission">Add mission of website</label>
                      <textarea class="form-control" id="myTextarea" name="mission"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="date_started">Date site created</label>
                      <input type="date" class="form-control" id="date_started" name="date_started"/>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="settingsave">Save</button>
                    <button class="btn btn-danger" type="reset">Cancel</button>
                  </form><hr>
                  <?php } else { ?>
              
            

                  <form class="forms-sample" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                      <label for="site_name">Site name</label>
                      <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo $editrow['site_name']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="contact_no">Contact number</label>
                      <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo $editrow['contact_no']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="contact_email">Contact email</label>
                      <input type="text" class="form-control" id="contact_email" name="contact_email" value="<?php echo $editrow['contact_email']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="location">Location</label>
                      <input type="text" class="form-control" id="location" name="location" value="<?php echo $editrow['location']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" name="address" value="<?php echo $editrow['address']; ?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="active_hours">Active hours</label>
                      <select class="form-control" id="active_hours" name="active_hours" required>
                        <option value="<?php echo $editrow['active_hours']; ?>"><?php echo $editrow['active_hours']; ?></option>
                        <option value="24 hours">24 hours</option>
                        <option value="12 hours">12 hours</option>
                        <option value="10 hours">10 hours</option>
                        <option value="9 hours">9 hours</option>
                        <option value="8 hours">8 hours</option>
                        <option value="7 hours">7 hours</option>
                        <option value="5 hours">5 hours</option>
                        <option value="4 hours">4 hours</option>
                        <option value="Closed">Closed</option>
                        <option value="Temporary closed">Temporary closed</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="main_quote">Quote</label>
                  
                      <textarea class="form-control" id="summernote" rows="6" name="main_quote" required><?php echo $editrow['address']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="mission">Add mission of website</label>
                      <textarea class="form-control" id="myTextarea" rows="6" name="mission" required><?php echo $editrow['mission']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="date_started">Date site created</label>
                      <input type="date" class="form-control" id="date_started" name="date_started" value="<?php echo $editrow['date_started']; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="settingupd">Update</button>
                  </form>


                <?php }} ?>







                </div>
              </div>
            </div>








        </div>
        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>