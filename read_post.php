<?php
include('configs/site_header_bk.php');

$viewer_ip = $_SERVER['REMOTE_ADDR'];
$post_id = $_GET['article_id'];
$object->createArticleView($post_id, $viewer_ip);

if(!isset($post_id)) {
    echo "<script>window.location='index'</script>";
}

$stmt400= $object->readArticle($post_id, $viewer_ip);
$viewRow= $stmt400->FETCH(PDO::FETCH_ASSOC);

$stmt500= $object->readArticle($post_id);
$result= $stmt500->FETCH(PDO::FETCH_ASSOC);
$post_views = $object->countArticleViews($post_id);
$check_post = $object->check4ArticleExistance($post_id);
?>



<?php if($check_post!=0) { ?>
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="pageTitle page-title-inner"><?php echo $result['article_title'];?></h2>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container content">
            <div class="row">
                <div class="col-md-12 content-mains">
                    <div class="col-sm-4 info-blocks small-x-h">
                    <div class="info-blocks-in">
                        <h3>Published by:</h3>
                        <p><?php echo $result['firstname']." ".$result['lastname']."(".$result['given_role'].")"; ?></p>
                    </div>
                </div>
                <div class="col-sm-4 info-blocks small-x-h">
                    <div class="info-blocks-in">
                        <h3>Category</h3>
                        <p><?php echo $result['article_category'];?></p>
                    </div>
                </div>
                <div class="col-sm-4 info-blocks small-x-h">
                    <div class="info-blocks-in">
                        <p>
                                <?php if($post_views==0){ ?>No view
                                <?php } else if($post_views==1){ ?>
                                <strong><?php echo $post_views; ?></strong> view
                                <?php } else if($post_views > 0) { ?>
                                <strong><?php echo $post_views; ?></strong> views
                                <?php } ?>
                        </p>
                    </div>
                </div>
                </div>
             
                <div class="col-md-12">
                    <div class="about-logo">
                        <p><?php echo $result['article_post'];?></p>
                    </div><hr class="hr-small"><br>
                    
                </div>
            </div>
        </div>
    </section>


    <section id="content">
        <div class="container content">     
        <div class="row service-v1 margin-bottom-40">
            <?php
            $stmt2= $object->readRecentArticles();
            while($rowp= $stmt2->FETCH(PDO::FETCH_ASSOC)) { 
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper photography artwork">
                <div class="gallery-item">
                    <div class="gallery-thumb summary-image">
                        <img src="../uploads/posts/<?php echo $rowp['article_image'];?>" class="img-responsive" alt="<?php echo $rowp['article_title'];?>">
                        <div class="image-overlay"></div>
                        <a href="../uploads/posts/<?php echo $rowp['article_image'];?>" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                        <a href="../read/<?php echo $rowp['article_id'];?>" class="gallery-link"><i class="fa fa-link"></i></a>
                    </div>
                    <div>
                        <h3><a href="../read/<?php echo $rowp['article_id'];?>"><?php echo $rowp['article_title'];?></a></h3>
                        <p><?php echo $object->showShortArticle("Read More...");?></p>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
        <!-- End Service Blcoks -->
    </div>
    </section>
    <?php } else { ?>
    <section class="page-title-err">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="pageTitle page-title-inner">Oops, Its Error 404! </h2>
                </div>
            </div>
        </div>
    </section>
    <div class="about-logo">
        <div class="big-border">
            <br><br><br>
            Requested page is not found!
            <br><br><br>
        </div>
        </div><hr style="height: 5px!important; background-color: #b9770e!important;">
    <?php } ?>

        <!-- Main footer -->
        <?php include('configs/site_footer_bk.php'); ?>