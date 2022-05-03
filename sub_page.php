<?php
include('configs/site_header_bk.php');

// Generating views count
$current_ip= $_SERVER['REMOTE_ADDR'];
$object->createSubPageView($active_lang, $subpage_id, $current_ip);

// Fetch records for sub pages
$stmtSubpage= $object->viewRelatedPage($subpage_id);
$sp_row = $stmtSubpage->FETCH(PDO::FETCH_ASSOC);
?>

<?php if($object->countSingleSpecificRelPage($subpage_id)!=0) { ?>
<div class="inside-content">
    <div class="ct-wrapper">
        <header class="ct-header">
            <h1>
            <?php
                // Translate page
                if($active_lang=='lang_en') {
                    echo ucwords(strtolower(stripcslashes($sp_row['content_title_en'])));
                } if($active_lang=='lang_rw') {
                    echo ucwords(strtolower(stripcslashes($sp_row['content_title_rw'])));
                }
            ?>
            </h1>
            <nav>
                <ul class="ct-nav">
                    <li title="">
                        <a href="#">
                            <i class="fa fa-clock-o"></i>
                            <?php 
                            echo $func->gadsonDateTimeFormatter($sp_row['created_at']);?>
                        </a>
                    </li>
                    <li title="Page view(s)">
                        <a href="#" style="background-color: #000; border: none; margin: 2px!important" class="btn btn-md"><?php echo $sp_row['views']; ?> <i class="fa fa-eye"></i></a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </nav>
        </header>

 
        <main class="ct-main">
            <div class="col-md-12">
                <p class="border-left-gad">
                    <?php
                    if($active_lang=='lang_en') {
                        echo stripcslashes($sp_row['content_text_en']);
                    } if($active_lang=='lang_rw') {
                        echo stripcslashes($sp_row['content_text_rw']);
                    }
                    ?>
                </p>
            </div>
        </main>

        <aside class="ct-aside">
            <h5>
            <?php
            $stmt_version= $object->viewLangVersionText('most_viewed_stories');
            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
            echo $row_lang[$func->getLangRow($active_lang)];?>
            </h5>
            <ul>
                <?php
                $stmtQ= $object->readPopularArticles($active_lang);
                while($rowQ= $stmtQ->FETCH(PDO::FETCH_ASSOC)){ 
                ?>
                <li><a href="../read/<?php echo $rowQ['article_id']; ?>"><?php echo ucfirst(strtolower($rowQ['article_title'])); ?><span style="color: #a3ffd7"> (<?php echo $rowQ['views']; ?> views)</span></a></li>
                <?php } ?>

            </ul>
        </aside>
    </div>
</div>
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