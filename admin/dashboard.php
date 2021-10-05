<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <!-- 
        @Gadrawingz 
        Coding hand by https://github.com/Gadrawingz 
        -->
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <h4 style="color: blue; margin-bottom: 1px!important;">Admin Dashboard</h4>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Posts</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $total_articles; ?> all posts</h3>
                    <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-danger"><span class="text-black ml-1"><small>(<?php echo $total_articles; ?> total articles published)</small></span></p>
                </div>
              </div>
            </div>
          

            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Authors</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $total_authors; ?></h3>
                    <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-danger"><span class="text-black ml-1"><small>(<?php echo $total_authors; ?> authors)</small></span></p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Messages</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"><?php echo $total_messages; ?></h3>
                    <i class="ti-email icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                  <p class="mb-0 mt-2 text-danger"><span class="text-black ml-1"><small>(<?php echo $total_messages; ?> people contacted)</small></span></p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card border-bottom-0">
                <div class="card-body pb-0">
                  <p class="card-title">Overview</p>
                  <div class="d-flex flex-wrap mb-5">

                    <div class="mr-5 mt-3">
                      <h5>
                        <?php if($total_articles==0) { echo "No post"; } 
                        else if($total_articles==1) { echo "1 total posts"; }
                        else { echo $total_articles." total posts"; } ?>
                      </h5>
                      <?php if($total_articles!=0) { ?>
                      <center><a href="articles?view">View</a></center>
                      <?php } ?>
                    </div>

                    <div class="mr-5 mt-3">
                      <h5>
                        <?php if($total_articles_author==0) { echo "You dont have any post"; } 
                        else if($total_articles_author==1) { echo "You have 1 post"; }
                        else { echo "Your posts ".$total_articles_author; } ?>
                      </h5>
                      <?php if($total_articles_author!=0) { ?>
                      <center><a href="articles?view">View</a></center>
                      <?php } ?>
                    </div>


                    <div class="mr-5 mt-3">
                      <h5><?php echo $total_authors; ?> Authors</h5>
                      <center><a href="manage?view">View</a></center>
                    </div>
                    
                    <div class="mr-5 mt-3">
                      <h5><?php echo $total_messages; ?> Messages</h5>
                      <center><a href="messages">View</a></center>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>




        </div>
        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>
