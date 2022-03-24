<!-- navbar shit -->
<?php include('reusable/navbar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">



          <?php if(!isset($_GET['reply'])) { ?>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="font-weight-bold mb-0">All people who contacted</h3>
                </div>
                
                <div>
                  <a href="../admin/dashboard" class="btn btn-danger btn-icon-text btn-rounded">
                      <i class="ti-clipboard btn-icon-prepend"></i>Back Home
                  </a>
                </div>
              </div>
            </div>
          </div>

          <?php if(isset($_GET['msuccess'])) { ?>
            <center><h5 class="btn btn-sm btn-success text-center">Reply is successful!</h5></center>
          <?php } ?>

          <?php if(isset($_GET['dsuccess'])) { ?>
            <center><h5 class="btn btn-sm btn-danger text-center">Message is successfully deleted!</h5></center>
          <?php } ?>

          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th colspan="2">#</th>
                          <th>Message</th>
                          <th>Send by</th>
                          <th>Email</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>           
                      <?php
                        $num = 1;
                        $stmt= $object->readAllMessages();
                        while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      ?>
                        <tr>
                          <td><?php echo $num; ?></td>
                          <td class="py-1">
                            <img src="../images/profile/avatar.png" alt="image"/>
                          </td>
                          <td><?php echo $object->showShortText25($row['message_content']); ?></td>
                          <td><?php echo $row['firstname']." ".$row['lastname']; ?><br><br>
                            <i><?php echo $row['message_date']; ?></i>
                          </td>
                          <td title="<?php echo $row['sender_email']; ?>"><?php echo $object->showShortText12($row['sender_email']); ?></td>
                          <td class="text-center"><a class="btn btn-sm btn-primary" href="../admin/messages?reply=<?php echo $row['message_id']; ?>">View/Reply</a></td>
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

          // Removal
          if(isset($_GET['rem'])) {
            if($object->removeMessage($_GET['rem'])) {
              echo'<center><h5 class="btn btn-sm btn-danger text-center">Message has been deleted!</h5></center>';
              echo "<script>window.location='../admin/messages?dsuccess'</script>";
            }
          }

          if(isset($_GET['reply'])) {
            error_reporting(E_WARNING & E_NOTICE);
            $stmt= $object->readOneMessage($_GET['reply']);
            $result= $stmt->FETCH(PDO::FETCH_ASSOC);
            $message_id= $_GET['reply'];

            if(isset($_POST['replybtn'])) {
              $object->replyToMessage($_POST['reply_text'], $message_id, $admin_id);

              // Push message
              $sender = "ADMIN";
              $recipient = $_POST['sender_email'];
              $subject= "Contact reply";
              $message= $_POST['reply_text'];
              $header = "Reply to message!";
              $mail= mail($recipient, $subject, $message, $header);

              if($mail){
                echo'<center><h5 class="btn btn-sm btn-success text-center">SUCCESS!</h5></center>';
              } else {
                echo'<center><h5 class="btn btn-sm btn-danger text-center">FAILED!</h5></center>';
              }
              echo "<script>window.location='../admin/messages?msuccess'</script>";
            }
          ?>
      
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Reply to (<?php echo $result['firstname']." ".$result['lastname']; ?>)</h4>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-description">
                    <?php echo $result['message_title']; ?> <code><?php echo $result['sender_email']; ?></code>
                  </p>
                  <p>
                    <?php echo $result['message_content']; ?>
                  </p><hr>
                  <form class="forms-sample" method="POST">
                    <div class="form-group">
                      <label for="a_post"><strong>Write reply</strong></label>
                      &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <a href="?rem=<?php echo $result['message_id']; ?>" class="text-danger font-weight-bold">Delete Message</a>

                      <input type="hidden" name="sender_email" value="><?php echo $result['sender_email']; ?>">
                      <textarea class="form-control" id="message_reply" rows="5" name="reply_text" required/></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="replybtn">Reply</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>







        </div>
        <!-- content-wrapper ends -->
        <?php include('reusable/footer.php'); ?>
