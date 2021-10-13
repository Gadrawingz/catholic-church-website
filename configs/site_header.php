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
        <?php
        if(isset($menu_slug)) {
            echo $result['cmenu_name']." - ";
        } else if(isset($articleid)) {
            echo $articla['article_title']." - ";
        } ?><?php echo $aboutrow['site_name']; ?>
            
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- css -->
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
                        <a class="navbar-brand iradu-nav" href="./" style="color: #fadbd8!important;"><?php echo $aboutrow['site_name']; ?></a>
                    </div>
                    <div class="navbar-collapse collapse ">
                        <ul class="nav navbar-nav">
                        <?php
                        $stmt2= $object->topMenus();
                        
                        while($menu= $stmt2->FETCH(PDO::FETCH_ASSOC)) { 
                            if($menu['has_submenu']=='Yes') {
                        ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="<?php echo $menu['menu_name']; ?>"><?php echo $menu['menu_name']; ?> <b class="caret"></b></a>
                                <div class="dropdown-menu" <?php if($object->countSubMenus($menu['menu_id'])!=1) {?>style="left: -100px!important;"<?php }?>>
                                    <!-- First level -->
                                    <div class="mega-row" <?php if($object->countSubMenus($menu['menu_id'])==1) {?>style="width: 250px!important;"<?php }?> >
                                       
                                        <?php
                                        $stmt3= $object->getSubMenus($menu['menu_id']);
                                        while($submenu= $stmt3->FETCH(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <div class="mega-column" <?php if($object->countSubMenus($menu['menu_id'])==1) {?>style="width: 100%!important;"<?php }?> >
                                            <h4><?php echo $submenu['sub_menu_title']; ?></h4>
                                            
                                            <!-- Last level -->
                                            <?php
                                            $stmt4=$object->getContentSubMenus($submenu['sub_menu_id']);
                                            while($csmenu= $stmt4->FETCH(PDO::FETCH_ASSOC)){
                                            ?>
                                            <a href="page/<?php echo $csmenu['cmenu_url']; ?>"><?php echo $csmenu['cmenu_name']; ?></a>
                                            <?php } ?>

                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </li>

                        <?php } else if($menu['menu_url']=='home') { ?>
                            <li><a href="index"><?php echo $menu['menu_name']; ?></a></li>
                        <?php } else { ?>
                            <li class=""><a href="page/<?php echo $menu['menu_url']; ?>"><?php echo $menu['menu_name']; ?></a></li>
                        <?php }} ?>

                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- end header -->