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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">View Admins</h3>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>User</th>
                          <th>Names/Email</th>
                          <th>Username/Phone</th>
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
                          <td class="py-1">
                            <img src="../images/faces/face1.jpg" alt="image"/>
                          </td>
                          <td><b><?php echo $row['firstname']." ".$row['lastname']; ?></b><br><br>
                            <?php echo $row['email']; ?></td>
                          <td><b><?php echo $row['username']; ?></b><br><br>
                            <?php echo $row['phone']; ?></td>
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


          <?php 
          if(isset($_GET['register'])) {
            
            if(isset($_POST['adminsave'])) {
              $object->registerAdmin($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['given_role'], $_POST['password']);
              echo "<script>window.location='../admin/manage?view&message'</script>";
            }
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">Register new admin</h3>
                </div>
                
                <div>
                  <a href="manage?view" class="btn btn-primary btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>View all admins
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <form class="form-sample" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="firstname" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" name="username" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone number</label>
                          <div class="col-sm-9">
                            <input name="phone" class="form-control" placeholder="07..." required/>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Given Role</label>
                          <div class="col-md-9">
                            <select class="form-control" name="given_role" required/>
                              <option value="">Select role</option>
                              <option value="Admin">Admin</option>
                              <option value="Author">Author</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" placeholder="Password" required/>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9">
                            <button type="submit" name="adminsave" class="btn btn-primary mr-2">Save</button>
                            <button type="reset" class="btn btn-danger mr-2">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
          <?php } ?>




          <?php 
          if(isset($_GET['update'])) {

            $stmt= $object->viewOneAdmin($_GET['update']);
            $result= $stmt->FETCH(PDO::FETCH_ASSOC);

            if(isset($_POST['save'])) {
              $object->updateAdmin($_GET['update'], $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['given_role']);
              echo "<script>window.location='../admin/manage?view&message'</script>";
            }
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">Update information </h3>
                </div>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <form class="form-sample" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="firstname" value="<?php echo $result['firstname']; ?>" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control" value="<?php echo $result['lastname']; ?>" required/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" name="username" value="<?php echo $result['username']; ?>" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" value="<?php echo $result['email']; ?>" name="email" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone number</label>
                          <div class="col-sm-9">
                            <input name="phone" value="<?php echo $result['phone']; ?>" class="form-control" placeholder="07..." required/>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">Given Role</label>
                          <div class="col-md-9">
                            <select class="form-control" name="given_role" required/>
                              <option value="<?php echo $result['given_role']; ?>"><?php echo $result['given_role']; ?></option>
                              <?php
                              $stmt0= $object->viewOneAdmin($_SESSION['admin_id']);
                              $result0= $stmt0->FETCH(PDO::FETCH_ASSOC);
                              if($result0['given_role']=='Admin') { 
                              ?>
                              <option value="Admin">Admin</option>
                              <option value="Author">Author</option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <button type="submit" name="save" class="btn btn-primary mr-2">Save Changes</button>
                          </div>

                          <div class="col-sm-6">
                            <a href="../admin/manage?xbio=<?php echo $_GET['update'];?>" class="btn btn-outline-primary btn-icon-text"><i class="ti-tag btn-icon-prepend"></i>Add Bio</a>&nbsp;&nbsp;&nbsp;
                            <a href="../admin/manage?changepass=<?php echo $_GET['update'];?>" class="btn btn-outline-primary btn-icon-text"><i class="ti-alert btn-icon-prepend"></i>Change Password</a>

                            
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
              </div>
            </div>
          </div>
          <?php } ?>





          <?php 
          if(isset($_GET['changepass'])) {
            
            $stmt= $object->viewOneAdmin($_GET['changepass']);
            $result= $stmt->FETCH(PDO::FETCH_ASSOC);

            if(isset($_POST['psave'])) {
              if($_POST['password1']!=$_POST['password2']) {
                echo "<script>window.location='../admin/manage?changepass=$_GET[changepass]&ep'</script>";
              } else {
                $object->changePassword($_GET['changepass'], $_POST['password2']);
                echo "<script>window.location='../admin/manage?view&message&sp'</script>";
              }
            }
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">Change password </h3>
                </div>

              </div>
            </div>
          </div>

          <?php if(isset($_GET['ep'])) { ?>
            <center><h5 class="btn btn-sm btn-danger text-center">Password doesn't match!</h5></center>
          <?php } if(isset($_GET['sp'])) { ?>
            <center><h5 class="btn btn-sm btn-primary text-center">Password's changed!</h5></center>
          <?php } ?>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <form class="form-sample" method="POST">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-6 col-form-label">Password</label>
                          <div class="col-sm-6">
                            <input type="password" name="password1" value="" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-6 col-form-label">Password Again</label>
                          <div class="col-sm-6">
                            <input type="password" name="password2" class="form-control" required/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <button type="submit" name="psave" class="btn btn-primary mr-2">Save</button>
                          </div>

                          <div class="col-sm-6">
                            <a href="../admin/manage?update=<?php echo $_GET['changepass'];?>" class="btn btn-outline-danger btn-icon-text"><i class="ti-close btn-icon-prepend"></i>Exit</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
              </div>
            </div>
          </div>
          <?php } ?>






          <?php 
          if(isset($_GET['xbio'])) {
            $stmt= $object->viewOneAdmin($_GET['xbio']);
            $result= $stmt->FETCH(PDO::FETCH_ASSOC);

            if(isset($_POST['bsave'])) {
              if($_POST['bio']!="") {
                $object->updateBio($_GET['xbio'], $_POST['bio'], $_FILES['picture']);
                echo "<script>window.location='../admin/manage?xbio=$_GET[xbio]&sb'</script>";
              } else {
                echo "<script>window.location='../admin/manage?xbio=$_GET[xbio]&eb'</script>";
              }
            }
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">Add Bio and Picture</h3>
                </div>
              </div>
            </div>
          </div>

          <?php if(isset($_GET['eb'])) { ?>
            <center><h5 class="btn btn-sm btn-danger text-center">Error occurred!</h5></center>
          <?php } if(isset($_GET['sb'])) { ?>
            <center><h5 class="btn btn-sm btn-primary text-center">Info's updated!</h5></center>
          <?php } ?>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <form class="form-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="picture" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleTextarea1">Textarea</label>
                      <textarea class="form-control" name="bio" id="exampleTextarea1" rows="4"></textarea>
                    </div>

                    <button type="submit" name="bsave" class="btn btn-primary mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
              </div>
            </div>
          </div>
          <?php } ?>








        </div>
        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>
