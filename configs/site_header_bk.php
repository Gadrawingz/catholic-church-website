<?php
session_start();
include('configs/adminquery.php');
$object = new AdminQuery;

$stmt= $object->viewWebsiteSetup();
$aboutrow= $stmt->FETCH(PDO::FETCH_ASSOC);

include('configs/functions.php');
$func = new Functions;

if(isset($_GET['cmenu_url'])) {
// Getting special url
$menu_slug = $_REQUEST['cmenu_url'];
$check_page= $object->check4PageExistance($menu_slug);
$stmt500= $object->getSpecificPageBySlug($menu_slug);
$result = $stmt500->FETCH(PDO::FETCH_ASSOC);
}


if(isset($_GET['article_id']) && !empty($_GET['article_id'])) {
// Getting special url
$articleid = $_REQUEST['article_id'];

if($_SESSION['active_lang']=='lang_en') {
    $stmt600= $object->readArticle($articleid);
} if($_SESSION['active_lang']=='lang_rw') {
    $stmt600= $object->readArticleRw($articleid);
}
$articla= $stmt600->FETCH(PDO::FETCH_ASSOC);
}


if(isset($_GET['subpage_id']) && !empty($_GET['subpage_id'])) {
$subpage_id = $_GET['subpage_id'];
$stmt740= $object->viewRelatedPage($subpage_id);
$sub_page_row= $stmt740->FETCH(PDO::FETCH_ASSOC);
}


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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        <?php
        if(isset($menu_slug)) {
            if(!empty($result['cmenu_name'])) {
                if($active_lang=='lang_en') {
                    echo $result['cmenu_name']." - ";
                } if($active_lang=='lang_rw') {
                    echo $result['cmenu_name_rw']." - ";
                }
            } else {
                echo "Error - ";
            }
        } else if(isset($articleid) && $articleid!='0' && $object->check4ArticleExistance($active_lang, $articleid)!=0) {
            echo $articla['article_title']." - ";

        } else if(isset($subpage_id) && $subpage_id!='0' && $object->countSingleSpecificRelPage($subpage_id)!=0) {
            echo $sub_page_row['content_title_en']." - ";
        } else {
            echo "Error - ";
        }?><?php echo $aboutrow['site_name']; ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- css -->
	 <link rel="shortcut icon" href="../images/profile/logo_black.gif">
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <!-- Vendor Styles -->
    <link href="../css/magnific-popup.css" rel="stylesheet">
  
    <link href="../css/gallery-1.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet" />
    <link href="../css/defined.css" rel="stylesheet" />  
		
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="../engine1/style.css" />
	<script type="text/javascript" src="../engine1/jquery.js"></script>
</head>

<body style="overflow-x: hidden!important;background:#dde">

<div class="wrapper">
<div class="container">
<!--<div class="topbar call-to-action-1" style="background-color:red"> -->
<section class="section-padding red-bg">	
    <div class="row">
	 <div class="col-md-9">	
	   <p style="width: 90%; height:auto;margin-bottom:-40px;">
        <img src="../images/profile/logocover.png" style="width: 90%; height:auto;">
      </p>
	  </div>
	  <div class="col-md-3 text-center">	
        <?php if(isset($_SESSION['active_lang']) && isset($_GET['article_id'])){
        // For good redirection go back to home page with id and language 
        // and return in a given language @gadrawingz
        ?>
        <p style="color:black"> <span class="flag-icon flag-icon-us"></span><a href="../?lang=en&return_art=<?php echo $_GET['article_id']; ?>"> English</a>&nbsp;|&nbsp;<span class="flag-icon flag-icon-rw"></span> <a href="../?lang=rw&return_art=<?php echo $_GET['article_id']; ?>">Kinyarwanda</a></p>
        <?php } else if(isset($_SESSION['active_lang']) && isset($_GET['cmenu_url'])){ ?>
        <p style="color:black"> <span class="flag-icon flag-icon-us"></span><a href="../?lang=en&return_page=<?php echo $_GET['cmenu_url']; ?>"> English</a>&nbsp;|&nbsp;<span class="flag-icon flag-icon-rw"></span> <a href="../?lang=rw&return_page=<?php echo $_GET['cmenu_url']; ?>">Kinyarwanda</a></p>
        <?php } else { ?>
        <p style="color:black"> <span class="flag-icon flag-icon-us"></span><a href="?lang=en"> English</a>&nbsp;|&nbsp;<span class="flag-icon flag-icon-rw"></span> <a href="?lang=rw">Kinyarwanda</a></p>
        <?php } ?>
        
		  </div>
			</div>
	 </section>
  <hr style="margin-bottom:-20px;background-color:#df100d">
 
<div id="wrapper" class="home-page">
        <!-- start header -->
<header>      
            <div class="navbar navbar-default navbar-static1-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
<p style="color:#ffffff;font-size:2rem;letter-spacing:6px;text-shadow:1px 1px 2px #000;word-spacing:2px;"> 
					  <a class="navbar-brand iradu-nav" href="../" style="color: #fadbd8!important;">
					  <?php echo $aboutrow['site_name']; ?></a>
</p>
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
                                            
                                            <?php
                                            $stmt4=$object->getContentSubMenus($submenu['sub_menu_id']);
                                            while($csmenu= $stmt4->FETCH(PDO::FETCH_ASSOC)){

                                                // Translate n show og or featured link
                                                if($csmenu['link_order']=='Original') {
                                                    echo '<a href="../page/'.$csmenu['cmenu_url'].'">';
                                                } else {
                                                    echo '<a href="'.$csmenu['featured_link'].'" target="_blank">';
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
                                <a href="../index">
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
                                <a href="../page/<?php echo $menu['menu_url']; ?>">
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