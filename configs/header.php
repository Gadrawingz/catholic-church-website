<?php
include('configs/adminquery.php');
$object = new AdminQuery;

$stmt= $object->viewWebsiteSetup();
$aboutrow= $stmt->FETCH(PDO::FETCH_ASSOC);

if(isset($_GET['cmenu_url']) || isset($_GET['article_id'])) {
// Getting special url
$menu_slug = $_REQUEST['cmenu_url'];
$articleid = $_REQUEST['article_id'];

$check_page= $object->check4PageExistance($menu_slug);
$stmt500= $object->getSpecificPageBySlug($menu_slug);
$result = $stmt500->FETCH(PDO::FETCH_ASSOC);

$stmt600= $object->readArticle($articleid);
$articla= $stmt600->FETCH(PDO::FETCH_ASSOC);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Hello
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- css -->
    <!-- <link href="configs/some.css" rel="stylesheet" /> -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="css/jcarousel.css" rel="stylesheet" />
    <link href="css/flexslider.css" rel="stylesheet" />
    <!-- Vendor Styles -->
    <link href="css/magnific-popup.css" rel="stylesheet">
    <link href="js/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="css/gallery-1.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/defined.css" rel="stylesheet" />
    <link href="others/carousel/custom-slides.css" rel="stylesheet" />
</head>
<body style="overflow-x: hidden!important;">

<div id="wrapper">
<div class="topbar" style="background: orange;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <img src="images/profile/logo.png" style="width: 25%; height: auto;">
      </div>
    </div>
  </div>
</div>

    <div id="wrapper" class="home-page">
        <!-- start header -->
        <header>
            <div class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="./" style="padding-top: 10px; color: #d5f5e3!important;">Donnekt</a>
                    </div>
                    <div class="navbar-collapse collapse ">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Go">Site <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dashboard</a></li>
                                </ul>
                            </li>
                        <li><a href="index">Gashboard</a></li>
                            <li class=""><a href="#">Dash dash</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- end header -->