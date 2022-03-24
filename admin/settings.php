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

          

                <?php if(isset($_GET['setup'])) { ?>
                  <h3 class="card-title">Setup website &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/dashboard" class="btn btn-sm btn-danger text-right">Exit</a></h3>

                  <?php
                  $id = 1;
                  $stmt90= $object->websiteSetupOne($id);
                  $editrow = $stmt90->FETCH(PDO::FETCH_ASSOC);
                  $checkSetup = $object->checkWebsiteSetup();

                    if(isset($_POST['settingsave']) && strlen($_POST['mission'])<=500) {
                      if(strlen($_POST['mission'])<=1500) {
                        if($object->setupWebsite($_POST['site_name'], $_POST['contact_no'], $_POST['contact_email'], $_POST['po_box'], $_POST['location'], $_POST['address'], $_POST['active_hours'], $_POST['main_quote'], $_POST['main_quote_rw'], $_POST['mission'], $_POST['mission_rw'], $_POST['date_started'])) {
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
                        if($object->updateUpWebsite($id, $_POST['site_name'], $_POST['contact_no'], $_POST['contact_email'], $_POST['po_box'], $_POST['location'], $_POST['address'], $_POST['active_hours'], $_POST['main_quote'], $_POST['main_quote_rw'], $_POST['mission'], $_POST['mission_rw'], $_POST['date_started'])) {
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
                      <label for="po_box">P.O Box <span class="text-primary">(Optional)</span></label>
                      <input type="text" class="form-control" id="po_box" name="po_box" placeholder="P.O Box"/>
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
                      <label for=""><span class="text-primary">Quote(In Kinyarwanda)</span></label>
                      <textarea class="form-control" id="main_quote_rw" rows="6" name="main_quote_rw" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="">Add mission of website</label>
                      <textarea class="form-control" id="textContent" name="mission"></textarea>
                    </div>

                    <div class="form-group">
                      <label for=""><span class="text-primary">Add mission of website(In Kinyarwanda)</span></label>
                      <textarea class="form-control" id="mission_rw" name="mission_rw"></textarea>
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
                      <label for="po_box">P.O Box <span class="text-primary">(Optional)</span></label>
                      <input type="text" class="form-control" id="po_box" name="po_box" value="<?php echo $editrow['po_box']; ?>"/>
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
                      <textarea class="form-control" rows="6" name="main_quote" required><?php echo $editrow['main_quote']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="main_quote"><span class="text-primary">Quote(In Kinyarwanda)</span></label>
                      <textarea class="form-control" rows="6" name="main_quote_rw" required><?php echo $editrow['main_quote_rw']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="">Add mission of website</label>
                      <textarea class="form-control" id="textContent" rows="6" name="mission" required><?php echo $editrow['mission']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for=""><span class="text-primary">Add mission of website(In Kinyarwanda)</span></label>
                      <textarea class="form-control" id="mission_rw" rows="6" name="mission_rw" required><?php echo $editrow['mission_rw']; ?></textarea>
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