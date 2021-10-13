<?php

session_start();

if(!isset($_SESSION['admin_id'])) {
    echo "<script>window.location='../admin/login'</script>"; 
}

if(isset($_GET['logout'])) {
  session_destroy();
  echo "<script>window.location='../admin/login'</script>";
}

include('../configs/adminquery.php');
$object = new AdminQuery;

$admin_id = $_SESSION['admin_id']; 
$names = $_SESSION['admin_names'];

$total_authors = $object->countAdmins();
$total_messages = $object->countMessages();
$total_articles = $object->countAllArticles();
$total_articles_author = $object->countArticleForAuthor($admin_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin | Catholic Website</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../others/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../others/vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="../others/css/style.css">
  <link rel="stylesheet" href="../others/css/custom.css">

  <link rel="stylesheet" href="../others/summernote-0.8.18/summernote.min.css">
  <!-- <link rel="stylesheet" href="../others/summernote-0.8.18/summernote.css"> -->
  
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- 
      @Gadrawingz 
      Coding hand by https://github.com/Gadrawingz 
    -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a href="../" target="_blank"><img src="../images/profile/logo.png" style="width: 100%; height: auto; padding: 8px;"></a>
        
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="ti-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search news" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          
          &nbsp;&nbsp;
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../images/profile/avatar.png" alt="Profile picture"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="../admin/profile">
                <i class="ti-settings text-primary"></i>
                Profile
              </a>
              <a class="dropdown-item" href="../admin/dashboard?logout">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../admin/dashboard">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Homepage</span>
            </a>
          </li>

          <?php if($_SESSION['admin_role']=='Admin') { ?>
          <li class="nav-item">
            <a class="nav-link" href="../admin/manage?view">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Admins & Authors</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../admin/articles?all">
              <i class="ti-book menu-icon"></i>
              <span class="menu-title" title="Manage posts(articles)">Manage News&nbsp;<mark><?php echo $total_articles; ?></mark>
            </a>
          </li>
          <?php } ?>
          
          <?php if($_SESSION['admin_role']=='Author') { ?>
          <li class="nav-item">
            <a class="nav-link" href="../admin/articles?create">
              <i class="ti-pencil-alt menu-icon"></i>
              <span class="menu-title" title="Manage posts(articles)">Create News</span>
            </a>
          </li>
          <?php } ?>

          <li class="nav-item">
            <a class="nav-link" href="../admin/articles?view">
              <i class="ti-world menu-icon"></i>
              <span class="menu-title" title="Manage posts(articles)">Manage News&nbsp;<mark><?php echo $total_articles_author; ?></mark></span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../admin/messages">
              <i class="ti-email menu-icon"></i>
              <span class="menu-title">Messages&nbsp;<mark><?php echo $total_messages;?></mark></span>
            </a>
          </li>

          <?php if(($_SESSION['admin_role']=='Admin')) { ?>
          <li class="nav-item">
            <a class="nav-link" href="../admin/settings?socials">
              <i class="ti-twitter menu-icon"></i>
              <span class="menu-title">Social media</span>
            </a>
          </li>
          

          <li class="nav-item">
            <a class="nav-link" href="../admin/settings?setup">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Setup website</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="../admin/setup?allslides">
              <i class="ti-book menu-icon"></i>
              <span class="menu-title">Manage pages</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <?php } ?>

          <li class="nav-item">
            <a class="nav-link" href="../admin/help">
              <i class="ti-hand-open menu-icon"></i>
              <span class="menu-title">Help & Support</span>
            </a>
          </li>

        </ul>
      </nav>