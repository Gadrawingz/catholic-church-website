<?php
include('configs/site_header_bk.php');

$viewer_ip = $_SERVER['REMOTE_ADDR'];
$post_id = $_GET['article_id'];
$object->createArticleView($active_lang, $post_id, $viewer_ip);


if(!isset($post_id)) {
    echo "<script>window.location='index'</script>";
}

if($active_lang=='lang_en') {
    $stmt400= $object->readArticle($post_id);
} if($active_lang=='lang_rw') {
    $stmt400= $object->readArticleRw($post_id);
}

$viewRow= $stmt400->FETCH(PDO::FETCH_ASSOC);

if($active_lang=='lang_en') {
    $stmt500= $object->readArticle($post_id);
} if($active_lang=='lang_rw') {
    $stmt500= $object->readArticleRw($post_id);
}

$result= $stmt500->FETCH(PDO::FETCH_ASSOC);

$post_views = $object->countArticleViews($active_lang, $post_id);
$check_post = $object->check4ArticleExistance($active_lang, $post_id);
?>

<?php if($check_post!=0) { ?>
<div class="inside-content">
    <div class="ct-wrapper">
        <header class="ct-header">
            <h1>
                <?php echo ucwords(strtolower($result['article_title']));?>
            </h1>
            <nav>
                <ul class="ct-nav">
                    <li title=
                    <?php
                    $stmt_version= $object->viewLangVersionText('published_by');
                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                    echo $row_lang[$func->getLangRow($active_lang)];
                    ?>>
                        <a href="#">
                            <i class="fa fa-pencil"></i>
                            <?php echo " ".$result['firstname']." ".$result['lastname']."(".$result['given_role'].")";
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                        title=
                        <?php
                        $stmt_version= $object->viewLangVersionText('category');
                        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                        echo $row_lang[$func->getLangRow($active_lang)];
                        ?>
                        >
                            <i class="fa fa-clock-o"></i>
                            <?php echo $func->gadsonDateTimeFormatter($result['article_date']);?>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-eye"></i>  
                        <?php
                            if($active_lang=='lang_en') { 
                                if($post_views==0){ echo "No view";
                                } else if($post_views==1){
                                    echo "<strong>".$post_views."</strong> view";
                                } else if($post_views > 0) {
                                    echo "<strong>".$post_views."</strong> views";
                                }
                            } else {
                                if($post_views==0){ echo "Ntawurebisoma";
                                } else if($post_views==1){
                                    echo "<strong> Byasomwe na <u>".$post_views."</u></strong>";
                                } else if($post_views > 0) {
                                    echo "<strong> Byasomwe na <u>".$post_views."</u></strong>";
                                }             
                            }
                        ?>   
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="ct-main">
            <p style="border-left: 1px solid cadetblue!important;"><?php echo stripcslashes($result['article_post']);?></p>
        </main>
        <aside class="ct-aside ct-aside-extra">
            <h5>
            <?php
            $stmt_version= $object->viewLangVersionText('most_viewed_stories');
            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
            echo $row_lang[$func->getLangRow($active_lang)];?>
            </h5>
            <ul class="">
                <?php
                $stmtQ= $object->readPopularArticles($active_lang);
                while($rowQ= $stmtQ->FETCH(PDO::FETCH_ASSOC)){ 
                ?>
                <li class="">
                    <a href="../read/<?php echo $rowQ['article_id']; ?>"><?php echo ucwords(strtolower($rowQ['article_title'])); ?><span style="color: #a3ffd7"> (<?php echo $rowQ['views']; ?> views)</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </aside>
    </div>
</div>

<!-- Bottom section -->
<section id="content" style="padding: 5px!important; margin-bottom: 0px!important; border-bottom: 2px solid blue;">
    <div class="row service-v1">
        <h4 style="text-align: center!important;">
            <strong>
            <?php
            $stmt_version= $object->viewLangVersionText('recent_posts');
            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
            echo $row_lang[$func->getLangRow($active_lang)];
            ?>
            </strong>
        </h4>

        <?php
        $stmt2= $object->readRecentArticles($active_lang);
        while($rowp= $stmt2->FETCH(PDO::FETCH_ASSOC)){ 
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
                    <h3><a href="../read/<?php echo $rowp['article_id'];?>"><?php echo ucwords(strtolower($rowp['article_title']));?></a></h3>
                    <p><?php echo strip_tags($object->showShortArticle($rowp['article_post'])); ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>
<?php } else { ?>
<div class="inside-content">
    <div class="ct-wrapper">
        <header class="ct-header">
            <h1>
                <?php
                $stmt_version= $object->viewLangVersionText('error_404');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo $row_lang[$func->getLangRow($active_lang)];
                ?>
            </h1>
        </header>
        <p class="ct-main" style="color: red; text-align: center!important; line-height: 70px; height: 200px">
        
        <?php
        $stmt_version= $object->viewLangVersionText('req_not_found');
        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
        echo $row_lang[$func->getLangRow($active_lang)];
        ?>
        
        </p>
    </div>
</div>
<?php } ?>


<!-- Main footer -->
<?php include('configs/site_footer_bk.php'); ?>