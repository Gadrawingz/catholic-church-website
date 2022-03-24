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
                      <a href="../admin/setup?newslide" class="btn btn-primary">New slide</a>
                      <a href="../admin/setup?allslides" class="btn btn-primary">Manage slides</a>
                      &nbsp;&bull;&nbsp;
                      <a href="../admin/setup?newvideo" class="btn btn-success text-right">New Video</a>
                      <a href="../admin/setup?all_vid" class="btn btn-success">Manage all videos</a>
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
                    <div><h4 class="font-weight-bold mb-0">All slides (<span style="font-style: normal!important;">Only first 4 slides can be shown</span>)</h4></div>

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
                          <th>Slide / Description</th>
                          <th class="text-center">Picture</th>
                          <th class="text-center">Settings</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $num = 1;
                        $stmt= $object->viewAllSlides();
                        while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      ?>
                        <tr>
                          <td>
                            <span class="font-weight-bold" style="border-bottom: 1px solid blue;">
                              <?php echo $object->showShortText18($row['slide_title']); ?>
                            </span><br><br>
                            &raquo; <i style="font-size: 11px;">
                            <?php echo $object->showShortTextByNum(38, $row['description']); ?>
                            </i><br>
                          </td>

                          <td class="text-center">
                            <img src="../uploads/slides/<?php echo $row['slide_image']; ?>" style="width: 100px; height: 100px;">
                          </td>
                          <td class="text-center"><a class="btn btn-sm btn-primary" href="?upslide=<?php echo $row['slide_id']; ?>">Replace</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" href="?rem_slide=<?php echo $row['slide_id']; ?>"><i class="ti-trash" title="Edit"></i></a></td>
                        </tr>
                      <?php $num++; } ?>
                      </tbody>
                    </table>
                    <!-- End card row -->
                  </div>
                <?php } ?>

                <?php if(isset($_GET['newslide'])) { ?>
                  <h3 class="card-title">Add new slide &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/allslides" class="btn btn-sm btn-danger text-right">Close</a></h3>

                  <?php
                    if(isset($_POST['slidesave'])) {
                      if($object->addSlide($_POST['slide_title'], $_POST['description'], $_FILES['slide_picture'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                        echo "<script>window.location='?allslides'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Action failed!</h5></center>';
                        echo "<script>window.location='?allslides'</script>";
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
                  <h3 class="card-title">
                    Update slide &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if(!isset($_GET['view_pic'])) { ?>
                      <a href="../admin/setup?upslide=<?php echo $_GET['upslide']; ?>&view_pic" class="btn btn-sm btn-primary font-weight-bold">View Slide Image</a>
                    <?php } else { ?>
                      <a href="../admin/setup?upslide=<?php echo $_GET['upslide']; ?>" class="btn btn-sm btn-warning text-white font-weight-bold">Hide Image</a>
                    <?php } ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="?allslides" class="btn btn-sm btn-danger text-right">Close</a>
                  </h3>
                  <?php
                  $stmt80= $object->viewOneSlide($_GET['upslide']);
                  $editrow = $stmt80->FETCH(PDO::FETCH_ASSOC);
                    if(isset($_POST['slideupdatebtn'])) {
                      if($object->updateSlide($_GET['upslide'], $_POST['slide_title'], $_POST['description'], $_FILES['slide_picture'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                        echo "<script>window.location='?allslides'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Action failed!</h5></center>';
                      }
                    }
                  ?>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <?php if(isset($_GET['view_pic'])) { ?>
                    <div class="form-group">
                      <div>
                        <img style="border: 1.5px solid green; width: 50%!important; opacity: 40%!important;" src="../uploads/slides/<?php echo $editrow['slide_image']; ?>">
                      </div>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                      <label for="slide_title">Slide title</label>
                      <input type="text" class="form-control" id="slide_title" name="slide_title" value="<?php echo $editrow['slide_title'];?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" class="form-control" id="description" name="description"  value="<?php echo $editrow['description'];?>"/>
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
                // Removal side
                if(isset($_GET['rem_slide'])) {
                  if($object->deleteSlide($_GET['rem_slide'])) {
                    echo'<center><h5 class="btn btn-sm btn-danger text-center">Slide has been removed!</h5></center>';
                    echo "<script>window.location='?allmenus'</script>";
                  }
                }

                if(isset($_GET['del_vid'])) {
                  if($object->deleteVideo($_GET['del_vid'])) {
                    echo'<center><h5 class="btn btn-sm btn-danger text-center">Video has been removed in the list!</h5></center>';
                    echo "<script>window.location='?all_vid'</script>";
                  }
                }?>





                <?php if(isset($_GET['all_vid'])) { ?>
                  <div class="row col-md-12">
                    <div class="col-md-12">
                      <div class="d-flex justify-content-between align-items-center">
                    <div><h4 class="font-weight-bold mb-0">All uploaded videos (<span style="font-style: normal!important;">Only 6 videos is allowed to be shown to website</span>)</h4></div>

                    <div>
                      <a href="setup?newvideo" class="btn btn-primary btn-icon-text btn-rounded">
                        <i class="ti-clipboard btn-icon-prepend"></i>Add new
                      </a>
                    </div>
                  </div><hr>

                  <div class="row col-md-12">
                    <!-- Xtt card row -->
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Video Description</th>
                          <th class="text-center">Video thumbnail</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        $num = 1;
                        $stmt= $object->viewAllVideos();
                        while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      ?>
                        <tr>
                          <td>
                            <span class="font-weight-bold">
                              <br><span style="font-size: 11px;">
                              <?php echo $object->showShortTextByNum(30, $row['description']); ?><br><br>
                              <?php echo $object->showShortTextByNum(30, $row['description_rw']); ?> (Kinyarwanda)
                            </span><br><br>
                            <a class="btn btn-sm btn-primary" href="?upd_vid=<?php echo $row['video_id']; ?>">Edit</a>&nbsp;&nbsp;&nbsp;
                            <a class="btn btn-sm btn-danger" href="?del_vid=<?php echo $row['video_id']; ?>" onclick="return confirm('Are you sure you want to remove this video?')"title="Remove"><b>&nbsp;&nbsp;X&nbsp;</b>&nbsp;</a>
                          </td>

                          <td class="text-center">
                            <iframe height="" src="<?php echo "https://www.youtube.com/embed/".explode('v=', $row['video_url'], 2)[1]."?autoplay=1&mute=1"; ?>" frameborder="0" allowfullscreen></iframe>
                          </td>
                        </tr>
                      <?php $num++; } ?>
                      </tbody>
                    </table>
                    <!-- End card row -->
                  </div>
                <?php } ?>

                <?php if(isset($_GET['newvideo'])) { ?>
                  <h3 class="card-title">Add new video links &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?all_vid" class="btn btn-sm btn-danger text-right">Close</a></h3>

                  <?php if($object->countVideosNum()>8) { ?>
                    <p class="text-black font-weight-semibold" style="border: 2px solid orange; border-radius: 3px; padding: 5px;">
                      <b>Notice: Don't add more links, replace existing ones!</b><br>
                      This page is for adding fewer videos to represent your <br>
                      youtube channel as Its not good to add too much videos, <br>
                      Instead, other videos can be found by visiting channel.<br>
                      Maximum of 8 videos is enough, otherwise, Replace existing videos.
                    </p>
                  <?php } ?>
                  
                  <?php
                    if(isset($_POST['yt_btn'])) {
                      if($object->addNewVideoLink($_POST['video_full'], $_POST['description'], $_POST['description_rw'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                        echo "<script>window.location='?all_vid'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Action has failed!</h5></center>';
                        echo "<script>window.location='?all_vid'</script>";
                      }
                    }
                  ?>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="video_full">Video full URL...</label>
                      <input type="text" class="form-control" id="video_full" name="video_full" placeholder="Video full link..." required/>
                    </div>

                    <div class="form-group">
                      <label for="description">Video description</label>
                      <textarea class="form-control" id="description" rows="4" name="description" placeholder="Your Description..."></textarea>
                    </div>

                    <div class="form-group">
                      <label for="description_rw">Video description <span class="text-primary">(Kinyarwanda)</span></label>
                      <textarea class="form-control" id="description_rw" rows="4" name="description_rw" placeholder="Your Description in Kinyarwanda..."></textarea>
                    </div>
                    <?php if($object->countVideosNum()<=8) { ?>
                    <button type="submit" class="btn btn-primary mr-2" name="yt_btn">Save</button>
                    <?php } ?>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/setup?all_vid" class="btn btn-success text-right">View added videos</a>
                  </form>
                <?php } ?>




                <?php if(isset($_GET['upd_vid'])) { ?>
                  <h3 class="card-title">
                    Update video &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="?all_vid" class="btn btn-sm btn-danger text-right">Close</a>
                  </h3>
                  <?php
                  $stmt90= $object->viewOneVideo($_GET['upd_vid']);
                  $editrow = $stmt90->FETCH(PDO::FETCH_ASSOC);
                    if(isset($_POST['vid_updatebtn'])) {
                      if($object->updateVideoLink($_GET['upd_vid'], $_POST['video_full'], $_POST['description'], $_POST['description_rw'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Successful!</h5></center>';
                        echo "<script>window.location='?all_vid'</script>";
                      } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Action has failed!</h5></center>';
                      }
                    }
                  ?>
                  <form class="forms-sample" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="video_full">Video full URL...</label>
                      <input type="text" class="form-control" id="video_full" name="video_full" value="<?php echo $editrow['video_url'];?>" required/>
                    </div>

                    <div class="form-group">
                      <label for="description">Video description</label>
                      <textarea class="form-control" id="description" rows="4" name="description"><?php echo $editrow['description'];?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="description_rw">Video description <span class="text-primary">(Kinyarwanda)</span></label>
                      <textarea class="form-control" id="description_rw" rows="4" name="description_rw"><?php echo $editrow['description_rw'];?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="vid_updatebtn">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/setup?all_vid" class="btn btn-success text-right">Back</a>
                  </form>
                <?php } ?>




                </div>
              </div>
            </div>
          </div>
          
        </div>

        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>