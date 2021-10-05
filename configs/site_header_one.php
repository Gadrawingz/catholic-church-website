<?php
include('configs/adminquery.php');
$object = new AdminQuery;

$stmt= $object->viewMainAbout();
$aboutrow= $stmt->FETCH(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $aboutrow['site_name']; ?></title>
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

</head>
<body>

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
                        <a class="navbar-brand" href="#"><img src="img/logo.png" alt="<?php echo $aboutrow['site_name']; ?>"/><?php echo $aboutrow['site_name']; ?></a>
                    </div>
                    <div class="navbar-collapse collapse ">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Ibitwerekeyeho">Turi bande? <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="abot">Abo turibo</a></li>
                                    <li><a href="contact">Twandikire</a></li>
                                    <li><a href="articles">Inkuru</a></li>
                                    <li><a href="#">Amateka</a></li>
                                    <li><a href="#">Ababikira ba mbere</a></li>
                                    <li><a href="#">Isabukuru y'imyaka 50</a></li>
                                    <li><a href="#">Umwihariko wacu,Ubuzima bwa roho</a></li>
                                    <li><a href="#">Aho tubarizwa</a></li>
                                    <li><a href="community">Abanditsi</a></li>
                                    <li><a href="#">Uburyo bwo kutugeraho </a></li> 
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Ibitwerekeyeho">Dukora iki? <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Kwamamaza inkuru nziza</a></li>
                                    <li><a href="#">Ubufatanye n'abali n'abategarugoli</a></li>
                                    <li><a href="#">Ubufatanye n'urubyiruko</a></li>
                                    <li><a href="#">Kwakira abitegura kwiha Imana</a></li>
                                    <li><a href="#">Kwamamaza Inkuru Nziza</a></li>
                                    <li><a href="#">Ibiganiro hagati y’amadini atandukanye</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" title="Ibitwerekeyeho">Ishishikariza <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Umuhamagaro n'iki?</a></li>
                                    <li><a href="#">Ngwino urebe</a></li>
                                    <li><a href="#">Kwimenyereza kwiha Imana</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Urubyiruko</a></li>
                            <li><a href="#">Videwo zacu</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- end header -->