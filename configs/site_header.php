<?php
session_start();
include('configs/adminquery.php');
$object = new AdminQuery;

$stmt= $object->viewWebsiteSetup();
$aboutrow= $stmt->FETCH(PDO::FETCH_ASSOC);

include('configs/functions.php');
$func = new Functions;

// TRANSLATE SHIT
if(!isset($_SESSION['active_lang'])) {
    $_SESSION['active_lang'] = "lang_en";
    $active_lang = $_SESSION['active_lang'];
} else {
    $active_lang = $_SESSION['active_lang'];
}

if(isset($_GET['lang']) && $_GET['lang']=='en') {
    $_SESSION['active_lang'] = "lang_en";
    $active_lang = $_SESSION['active_lang'];
} else if(isset($_GET['lang']) && $_GET['lang']=='rw') {
    $_SESSION['active_lang'] = "lang_rw";
    $active_lang = $_SESSION['active_lang'];
} else if(isset($_GET['lang']) && $_GET['lang']=='fr') {
    $_SESSION['active_lang'] = "lang_fr";
    $active_lang = $_SESSION['active_lang'];
} else {
    $_SESSION['active_lang'] = $_SESSION['active_lang'];
    $active_lang = $_SESSION['active_lang'];
}

if(isset($_GET['cmenu_url']) || isset($_GET['article_id'])) {
// Getting special url
$menu_slug = $_REQUEST['cmenu_url'];
$articleid = $_REQUEST['article_id'];

$check_page= $object->check4PageExistance($menu_slug);
$stmt500= $object->getSpecificPageBySlug($menu_slug);
$result = $stmt500->FETCH(PDO::FETCH_ASSOC);

if($active_lang=='lang_en') {
    $stmt600= $object->readArticle($articleid);
} if($active_lang=='lang_rw') {
    $stmt600= $object->readArticleRw($articleid);
}

$articla= $stmt600->FETCH(PDO::FETCH_ASSOC);
}

// FOR HOMEPAGE ONLY
// Making redirection at home page according to a given
// URL and language after setting it then back to view article
// In final set language, after checking if article is translated
if(isset($_GET['return_art'])){
    // Check if Art is translated...
    if(isset($_GET['lang']) && $_GET['lang']=='rw') {
        $stmt45= $object->readOneArticleRwByRefOnly($_GET['return_art']);
        $art_rw= $stmt45->FETCH(PDO::FETCH_ASSOC);
        // If it comes set in ENGLISH LANG....
        if($object->check4TranslatedPost($_GET['return_art'])!=0) {
            echo "<script>window.location='read/".$art_rw['article_id']."'</script>";
        } else {
            // Return original id 
            echo "<script>window.location='read/".$_GET['return_art']."'</script>";
        }
    } else if(isset($_GET['lang']) && $_GET['lang']=='en') {
        // SERIOUS LOGIC: REMINDER
        // If it comes set in ENGLISH LANG....
        // Get article in english by using this returned (return_art(id)) is the pk(article_id)
        // In order to output reference (article_ref) bcz its PK in its table of english post
        $stmt46= $object->readArticleRw($_GET['return_art']);
        $art_rw2= $stmt46->FETCH(PDO::FETCH_ASSOC);
        echo "<script>window.location='read/".$art_rw2['article_ref']."'</script>";
    }
}

// Redirection from content page
if(isset($_GET['return_page']) && isset($_GET['lang']) && $_GET['lang']!=''){
    echo "<script>window.location='page/".$_GET['return_page']."'</script>";
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
	 <link rel="shortcut icon" href="./images/profile/logo_black.gif">
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
    <link href="others/carousel/slideshow.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>
</head>
<body style="overflow-x: hidden!important;">

<div id="wrapper">
<div class="topbar call-to-action-2" style="background:#fff;">
  <div class="container">
    <div class="row">
     <div class="col-md-8">	
        <img src="./images/profile/logo_og.png" style="width: 25%; height:auto;">
      </div>
	  <div class="col-md-4 text-right">
        <p style="color:black"> <span class="flag-icon flag-icon-us"></span><a href="?lang=en"> English</a>&nbsp;|&nbsp;<span class="flag-icon flag-icon-rw"></span> <a href="?lang=rw">Kinyarwanda</a></p>
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
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="<?php echo $menu['menu_name']; ?>">
                                    <?php
                                    if($active_lang=='lang_en') {
                                        echo $menu['menu_name'];
                                    } if($active_lang=='lang_rw') {
                                        echo $menu['menu_name_rw'];
                                    }?>
                                    <b class="caret"></b>
                                </a>
                                <div class="dropdown-menu" <?php if($object->countSubMenus($menu['menu_id'])!=1) {?>style="left: -100px!important;"<?php }?>>
                                    <!-- First level -->
                                    <div class="mega-row" <?php if($object->countSubMenus($menu['menu_id'])==1) {?>style="width: 250px!important;"<?php }?> >
                                       
                                        <?php
                                        $stmt3= $object->getSubMenus($menu['menu_id']);
                                        while($submenu= $stmt3->FETCH(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <div class="mega-column" <?php if($object->countSubMenus($menu['menu_id'])==1) {?>style="width: 100%!important;"<?php }?> >
                                            <h4>
                                                <?php
                                                if($active_lang=='lang_en') {
                                                    echo $submenu['sub_menu_title'];
                                                } if($active_lang=='lang_rw') {
                                                    echo $submenu['sub_menu_title_rw'];
                                                }?>
                                            </h4>
                                            
                                            <!-- Last level -->
                                            <?php
                                            $stmt4=$object->getContentSubMenus($submenu['sub_menu_id']);
                                            while($csmenu= $stmt4->FETCH(PDO::FETCH_ASSOC)){
                                                // Translate n show og or featured link
                                                if($csmenu['link_order']=='Original') {
                                                    echo '<a href="page/'.$csmenu['cmenu_url'].'">';
                                                } else {
                                                    echo '<a href="'.$csmenu['featured_link'].'">';
                                                }
                                                
                                                if($active_lang=='lang_en') {
                                                    echo $csmenu['cmenu_name'];
                                                } if($active_lang=='lang_rw') {
                                                    if(!empty($csmenu['cmenu_name_rw'])) {
                                                        echo $csmenu['cmenu_name_rw'];
                                                    } else {
                                                        echo '<span class="text-warning">'.$csmenu['cmenu_name']."<span>";
                                                    }
                                                }
                                                echo '</a>';
                                            }
                                            ?>
                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </li>

                        <?php } else if($menu['menu_url']=='home') { ?>
                            <li>
                                <a href="index">
                                    <?php
                                    if($active_lang=='lang_en') {
                                        echo $menu['menu_name'];
                                    } if($active_lang=='lang_rw') {
                                        echo $menu['menu_name_rw'];
                                    }?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="">
                                <a href="page/<?php echo $menu['menu_url']; ?>">
                                    <?php
                                    if($active_lang=='lang_en') {
                                        echo $menu['menu_name'];
                                    } if($active_lang=='lang_rw') {
                                        echo $menu['menu_name_rw'];
                                    }?>
                                </a>
                            </li>
                        <?php }} ?>

                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- end header -->