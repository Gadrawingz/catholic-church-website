<?php
session_start();
include('../configs/adminquery.php');
$object = new AdminQuery;

if(isset($_SESSION['admin_id'])) {
    echo "<script>window.location='../admin/dashboard'</script>"; 
}

if(isset($_POST['login'])) {
    if(empty($_POST['email']) || empty($_POST['password'])) {
        header("Location:../admin/login?message=empty_fields");
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $object->adminLogin($email, $password);

    while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
        if(($email == $row['email']) && ($password == $row['password'])) {
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_names'] = $row['firstname']." ".$row['lastname'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['admin_role'] = $row['given_role'];
            echo "<script>window.location='../admin/dashboard'</script>"; 
        } else {
            echo "<script>window.location='../admin/login?message=login_error'</script>"; 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../others/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../others/vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="../others/css/style.css">
  
  <script src="../js/bootstrap.min.js"></script>
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../images/logo.svg" alt="logo">
              </div>
              <h3>Sign in to continue!</h3>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="login">SIGN IN</button>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  Click here to go to <a href="#" class="text-primary">Website</a>!
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src=".../scripts/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../scripts/vendors/js/off-canvas.js"></script>
  <script src="../scripts/vendors/js/hoverable-collapse.js"></script>
  <script src="../scripts/vendors/js/template.js"></script>
  <!-- endinject -->
</body>

</html>
