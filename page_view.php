<?php
include('configs/site_header_bk.php');

// Generating views count
$current_ip= $_SERVER['REMOTE_ADDR'];
$page_id   = $result['cmenu_id'];
$object->createPageView($active_lang, $page_id, $current_ip);
?>



<?php if($check_page!=0 || !empty($check_page)) { ?>

<div class="inside-content">
    <div class="ct-wrapper">
        <header class="ct-header">
            <h1>
                <?php
                    if($menu_slug=='news' || $menu_slug=='stories' || $menu_slug=='projects' || $menu_slug=='others') {
                        echo "Posts | ";
                    }

                    // Translate page
                    if($active_lang=='lang_en') {
                        echo ucwords(strtolower(stripcslashes($result['cmenu_name'])));
                    } if($active_lang=='lang_rw') {
                        if(empty($result['cmenu_name_rw'])) {
                            echo ucwords(strtolower("No Kinyarwanda::".stripcslashes($result['cmenu_name'])));
                        } else {
                            echo ucwords(strtolower(stripcslashes($result['cmenu_name_rw'])));
                        }
                    }
                ?>
            </h1>

            <nav>
                <ul class="ct-nav">
                    <li title="">
                        <a href="#">&laquo;</a>
                    </li>

                    <?php if($menu_slug=='contact' || $menu_slug=='videos') { ?>
                    <li title="">
                        <a href="#" style="background-color: #000; border: none; margin: 2px!important" class="btn btn-md"><i class="fa fa-list"></i></a>
                    </li>

                    <?php } else if($menu_slug=='posts' || $menu_slug=='others') { ?>
                    <li title="#">
                        <a href="#" style="background-color: #000; border: none; margin: 2px!important" class="btn btn-md"><i class="fa fa-book"></i></a>
                    </li>

                    <?php } else { ?>
                    <li title="Page view(s)">
                        <a href="#" style="background-color: #000; border: none; margin: 2px!important" class="btn btn-md"><?php echo $result['views']; ?> <i class="fa fa-eye"></i></a>
                    </li>
                    <?php } ?>

                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </nav>
        </header>

        <?php
        // Do not show this if its not tabbed
        // Sect600
        if($result['page_type']!='Tabbed' && ($menu_slug!='videos' && $menu_slug!='posts' && $menu_slug!='contact' && $menu_slug!='news' && $menu_slug!='stories' && $menu_slug!='projects' && $menu_slug!='others')) {
            // Sect601
            if($result['page_picture']==null) { 
        ?>
        <div class="row">
            <main class="ct-main">
                <div class="col-md-12">
                    <p class="border-left-gad">
                    <?php
                    if($active_lang=='lang_en') {
                        echo stripcslashes($result['page_content']);
                    } if($active_lang=='lang_rw') {
                        if(empty($result['page_content_rw'])) {
                            echo "No Kinyarwanda::".stripcslashes($result['page_content']);
                        } else {
                            echo stripcslashes($result['page_content_rw']);
                        }
                    }
                    ?>
                    </p>
                </div>
            </main>
        </div>
        <hr style="background-color: #0c4270; height: 2px;">
        <h5 style="margin: 0!important; font-weight: bolder;">Related Posts</h5>
        <div class="row">
            <?php
            $stmtRel= $object->view6TopRelatedPages($page_id);
            while($rowRel= $stmtRel->FETCH(PDO::FETCH_ASSOC)) { 
            ?>
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-lightbulb-o"></i>
                <div class="info-blocks-in" style="text-align: left!important;">
                    <h3>
                        <?php
                        if($active_lang=='lang_en') {
                            echo ucwords(strtolower($rowRel['content_title_en']));
                        } if ($active_lang=='lang_rw') {
                            echo ucwords(strtolower($rowRel['content_title_rw']));
                        }
                        ?>
                    </h3>
                    <p>
                        <i class="fa fa-eye"></i>&nbsp;
                        <?php
                        $statement5= $object->viewRelatedPage($rowRel['page_id']);
                        $view_row= $statement5->FETCH(PDO::FETCH_ASSOC);
                        echo $view_row['views']." ";
                        echo $view_row['views']==1?" view":" view(s)";
                        ?>
                    </p>
                    <p>
                        <a href="../subpage/<?php echo $rowRel['page_id']; ?>">
                            <?php
                            $stmt_version= $object->viewLangVersionText('read_post');
                            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                            echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                        </a>
                    </p>
                    
                </div>
            </div>
            <?php } ?>
        </div>

        <?php } else { // No picture in heading ?>

        <main class="ct-main">
            <div class="row showcase-section" style="background-color: #f5eef8;">
                <div class="col-md-6">
                    <img src="../uploads/images/<?php echo $result['page_picture']; ?>" alt="showcase image" style="opacity: 70%; height: 100%; width: 100%;">
                </div>

                <div class="col-md-6">
                    <div class="about-text">
                        <p class="border-left-gad">
                            <?php
                            if($active_lang=='lang_en') {
                                echo stripcslashes($result['page_content']);
                            } if($active_lang=='lang_rw') {
                                if(empty($result['page_content_rw'])) {
                                    echo "No Kinyarwanda::".stripcslashes($result['page_content']);
                                } else {
                                    echo stripcslashes($result['page_content_rw']);
                                }
                            }
                            ?>    
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <aside class="ct-aside">

            <?php
            if($object->countRelatedPages($page_id)!=0) {
                echo "<h5>";
                $stmt_version= $object->viewLangVersionText('related_pages');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo $row_lang[$func->getLangRow($active_lang)];
                echo "</h5>";
            ?>

            <ul>
                <?php
                $stmtRel= $object->view8TopRelatedPages($page_id);
                  while($rowRel= $stmtRel->FETCH(PDO::FETCH_ASSOC)) { 
                ?>
                <li>
                    <a href="../subpage/<?php echo $rowRel['page_id']; ?>">
                    <?php 
                    if($active_lang=='lang_en') {
                        echo ucwords(strtolower($rowRel['content_title_en']));
                    } if ($active_lang=='lang_rw') {
                        echo ucwords(strtolower($rowRel['content_title_rw']));
                    } ?>&nbsp;<i class="fa fa-eye"></i>
                    <?php
                      $statement5= $object->viewRelatedPage($rowRel['page_id']);
                      $view_row= $statement5->FETCH(PDO::FETCH_ASSOC);
                      echo "&nbsp; ".$view_row['views'];
                      ?>
                    </a>
                </li>
                <?php } ?>
            </ul><hr>
            <?php } ?>

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
                <li><a href="../read/<?php echo $rowQ['article_id']; ?>"><?php echo ucwords(strtolower($rowQ['article_title'])); ?><span style="color: #a3ffd7"> (<?php echo $rowQ['views']; ?> views)</span></a></li>
                <?php } ?>
            </ul>
        </aside>
        <?php } /* End Sect601 */ } /* End Sect600 */ ?>











        <?php if(($menu_slug=='posts' || $menu_slug=='others') && (!isset($_GET['s_keyword']))){ /* P48 */ ?>
        <!-- End Info Blcoks -->
        <h3>
            <?php
            $stmt_version= $object->viewLangVersionText('recent_articles');
            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
            echo $row_lang[$func->getLangRow($active_lang)];
            ?>
        </h3>

        <?php
        if(isset($_POST['search_p_btn'])) {
            echo "<script>window.location='../res_post/".$_POST['search_kwd']."'</script>";
        }
        ?>
        <form class="" method="POST">
            <div class="search-sect">
                <label for="text">
                <?php
                $stmt_version= $object->viewLangVersionText('search_label');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo stripslashes($row_lang[$func->getLangRow($active_lang)]);
                ?>
                </label>
                <input type="text" id="text" name="search_kwd">
                <input type="submit" name="search_p_btn" value="<?php $stmt_version= $object->viewLangVersionText('search'); $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC); echo $row_lang[$func->getLangRow($active_lang)];?>">
            </div>
        </form><hr style="background-color: #ddddde;">


        <div class="row service-v1">
            <?php
            $lim = 15;
            $page = '';
            if(isset($_GET["page"])) {
                $page= $_GET["page"];
            } else { 
                $page = 1;
            } 
            $start= ($page-1) * $lim;

            $stmt2= $object->readMinimumArticles($active_lang, $start, $lim);
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
                        <h5><a href="../read/<?php echo $rowp['article_id'];?>" style="color: #2874a6!important; font-weight: bold!important; font-size: 16px; font-family: cambria;"><?php echo ucwords(strtolower($rowp['article_title']));?></a></h5>
                        <!-- <p><?php echo strip_tags($object->showShortArticle($rowp['article_post'])); ?></p> -->
                    </div>
                </div>
            </div>
            <?php } ?>     
        </div>

        <ul class="ct-pagin">
            <?php
            $t_recs = $object->articlesPagination($active_lang);
            // T.Number required
            $t_pages = ceil($t_recs / $lim); 
            $start_lp = $page;
            $diff = $t_pages - $page;
            if($diff <= 15) {
                $start_lp = $t_pages - 15;
            }
            $end_lp = $start_lp + 14;
            if($page > 1) { 
            ?>
            <li title="Previous">
                <a href="../paging/<?php echo $page-1; ?>">&laquo; 
                    <?php
                    $stmt_version= $object->viewLangVersionText('previous');
                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                    echo $row_lang[$func->getLangRow($active_lang)];
                    ?>
                </a>
            </li>
            <?php } if($diff = $page) { ?>
            <li title="Current">
                <a href="#"> Page <?php echo $page; ?> </a>
            </li>
            <?php } if($page<=$end_lp) { ?>
            <li title="Next">
                <a href="../paging/<?php echo $page+1; ?>">
                    <?php
                    $stmt_version= $object->viewLangVersionText('next');
                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                    echo $row_lang[$func->getLangRow($active_lang)];
                    ?>
                 &raquo;</a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>







        <?php if(isset($_GET['s_keyword']) && !empty($_GET['s_keyword'])) { ?>
        <h3>
            <?php
            $stmt_version= $object->viewLangVersionText('result_found');
            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
            echo stripcslashes($row_lang[$func->getLangRow($active_lang)]);
            ?>
        </h3>

        <?php
        if(isset($_POST['search_p_btn'])) {
            echo "<script>window.location='../res_post/".$_POST['search_kwd']."'</script>";
        }
        ?>
        <form class="" method="POST">
            <div class="search-sect">
                <label for="text">
                <?php
                $stmt_version= $object->viewLangVersionText('search_label');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo stripslashes($row_lang[$func->getLangRow($active_lang)]);
                ?>
                </label>
                <input type="text" id="text" name="search_kwd">
                <input type="submit" name="search_p_btn" value="<?php $stmt_version= $object->viewLangVersionText('search'); $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC); echo $row_lang[$func->getLangRow($active_lang)];?>">
            </div>
        </form><hr style="background-color: #ddddde;">

        <div class="row service-v1">
            <?php
            $stmt99= $object->readArticlesBySearch($active_lang, $_GET['s_keyword']);
            while($rowp= $stmt99->FETCH(PDO::FETCH_ASSOC)){ 
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
                        <h5><a href="../read/<?php echo $rowp['article_id'];?>" style="color: #2874a6!important; font-weight: bold!important; font-size: 16px; font-family: cambria;"><?php echo ucwords(strtolower($rowp['article_title']));?></a></h5>
                        <!-- <p><?php echo strip_tags($object->showShortArticle($rowp['article_post'])); ?></p> -->
                    </div>
                </div>
            </div>
            <?php } ?>            
        </div>
        <!-- End Service Blcoks -->
        <?php } ?>















        <?php if($menu_slug=='contact') { /* P49 */ ?>
        <main class="ct-main">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if(isset($_POST['sendmessage'])) {
                        if($object->contact($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['message'])) {
                            echo'<center><h5 class="btn btn-sm btn-success text-center">Thank you for contacting us!</h5></center>';
                        } else {
                            echo'<center><h5 class="btn btn-sm btn-danger text-center">Sorry! Message has been sent!</h5></center>';
                        }
                    }?>
                </div>
            </div>

            <!-- Form row -->
            <div class="">
                <div class="col-md-6">
                <?php
                if(isset($_POST['sendmessage'])) {
                    if($object->contact($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['message'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Thank you for contacting us!</h5></center>';
                    } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Sorry! Message has been sent!</h5></center>';
                    }
                } ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="control-group">
                        <div class="controls">
                            <label>
                            <?php
                            $stmt_version= $object->viewLangVersionText('firstname');
                            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                            echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                            </label>
                            <input type="text" class="form-control" placeholder="Firstname" name="firstname" data-validation-required-message="Please enter your firstname" required/>
                        </div>
                    </div><br>

                    <div class="control-group">
                        <div class="controls">
                            <label>
                            <?php
                            $stmt_version= $object->viewLangVersionText('lastname');
                            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                            echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                            </label>
                            <input type="text" class="form-control" placeholder="Lastname" name="lastname" required data-validation-required-message="Please enter your lastname"/>
                        </div>
                    </div><br>

                    <div class="control-group">
                        <div class="controls">
                            <label>
                            <?php
                            $stmt_version= $object->viewLangVersionText('email');
                            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                            echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                            </label>
                            <input type="email" class="form-control" placeholder="Email" id="email" name="email" required data-validation-required-message="Please enter your email" />
                        </div>
                    </div><br>

                    <div class="control-group">
                        <div class="controls">
                            <label>
                            <?php
                            $stmt_version= $object->viewLangVersionText('suggestion');
                            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                            echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                            </label>
                            <textarea rows="10" cols="100" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter your message" minlength="5" data-validation-minlength-message="Min 5 characters" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div><br/>

                    <div class="control-group">
                        <button type="submit" class="btn btn-primary pull-right" name="sendmessage" style="background: green!important; border: 0!important;">
                        <?php
                        $stmt_version= $object->viewLangVersionText('send');
                        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                        echo $row_lang[$func->getLangRow($active_lang)];
                        ?>
                        </button><br/>
                    </div>
                </form>
            </div>
            
            <div class="col-md-6 col-sm-6">             
                <h4 style="color: blue;">
                <?php
                $stmt_version= $object->viewLangVersionText('write_for_us');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo $row_lang[$func->getLangRow($active_lang)];
                ?>
                </h4><hr>
                
                <p style="margin-right:20px">
                <?php
                $stmt_version= $object->viewLangVersionText('contact_us_text');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo $row_lang[$func->getLangRow($active_lang)];
                ?>                        
                </p><hr>
                
                <h4 style="color: green;">
                <?php
                $stmt_version= $object->viewLangVersionText('contact_us');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo $row_lang[$func->getLangRow($active_lang)];
                ?>
                </h4>
                
                <div>
                    <address>
                        <strong>&laquo;<?php echo $aboutrow['site_name']; ?>&raquo;</strong><br><br>
                        <?php
                        if(!empty($aboutrow['po_box'])) {
                            echo '<i class="fa fa-user"></i> '.$aboutrow['po_box'].'<br>';
                            }
                        ?>
                        <?php echo '<i class="fa fa-globe"></i> '.$aboutrow['location']; ?>.<br>
                    </address>
                    
                    <p>
                        <i class="fa fa-phone"></i> <?php echo $aboutrow['contact_no']; ?><br>
                        <i class="fa fa-envelope"></i></i> <?php echo $aboutrow['contact_email']; ?>
                    </p>
                </div>
            </div>
        </main>
        

        <?php } /* END P49 */ else if($menu_slug=='videos') { ?> 
        <main class="ct-main">
        <div class="about">
            <div class="block-heading-six" style="margin-bottom: 5px">
                <h3 class="bg-color" style="text-align: center;">
                <?php
                $stmt_version= $object->viewLangVersionText('youtube_videos');
                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                echo $row_lang[$func->getLangRow($active_lang)];
                ?>
                </h3>
            </div>
                
            <div class="team-six">
                <div class="channel-box">
                    <?php
                    if($object->checkSocialMedia('youtube')) {
                        $stmt= $object->readOneSocial('youtube');
                        $result= $stmt->FETCH(PDO::FETCH_ASSOC);
                        echo '<br>';
                        echo '<a class="button-sub" href="'.$result['soc_url'].'?sub_confirmation=1">Subscribe</a>';
                    } else { 
                        echo '<p class="channel-title text-warning">No Youtube channel</p>';
                    }?>
                </div>
                    
                <div class="row">
                    <center>
                        <?php
                        $stmt= $object->viewAllVideos();
                        while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                        ?>
                        <iframe class="iframe-vid" frameborder="0" width="400" height="280" src="<?php echo "https://www.youtube.com/embed/".explode('v=', $row['video_url'], 2)[1]."?autoplay=1&mute=1"; ?>"></iframe>
                        <p style="color: blue!important;">
                        <?php
                            if($active_lang=='lang_en') {
                                echo stripcslashes($row['description']);
                            } else {
                                echo stripcslashes($row['description_rw']);
                            }
                        ?>
                        </p><br>
                        <?php } ?>
                    </center>
                </div>
            </div>
        </div>
        </main>




        <?php } else if($result['page_type']=='Tabbed') {
        $stmt46=$object->getTabbedContents($active_lang, $menu_slug);
        ?>
        <div class="row">
        <main class="ct-main" style="margin: 0  8px!important">
        <?php
        $histnum = 1;
        while($histpage= $stmt46->FETCH(PDO::FETCH_ASSOC)) {
        ?>
            <button class="tablink"onclick="openPage('<?php echo $histpage['tab_id']; ?>', this, 'white')" <?php if($histnum==1) { echo 'id="defaultOpen"'; } ?> >
            <?php
            if(empty($histpage['tab_title']) || $histpage['tab_title']=='') {
                echo '<span class="text-danger">No translation</span>';
            } else {
                echo $histpage['tab_title'];
            } ?>
            </button>
        <?php } ?>

            <?php
            $stmt47=$object->getTabbedContents($active_lang, $menu_slug);
            while($histpage2= $stmt47->FETCH(PDO::FETCH_ASSOC)) {
                error_reporting(E_ERROR | E_PARSE);
                header("Content-type: multipart/form-data");
            ?>
            <div id="<?php echo $histpage2['tab_id']; ?>" class="tabcontent">
                <h3><?php echo $histpage2['tab_title']; ?></h3>
                <p><?php echo ($histpage2['tab_content']); ?></p>
            </div>

        <?php } ?>
        </main>
        </div>
        <hr style="background-color: #0c4270; height: 2px;">
        <h5 style="margin: 0!important; font-weight: bolder;">Related Posts</h5>
        <div class="row">
            <?php
            $stmtRel= $object->view6TopRelatedPages($page_id);
            while($rowRel= $stmtRel->FETCH(PDO::FETCH_ASSOC)) { 
            ?>
            <div class="col-sm-4 info-blocks">
                <i class="icon-info-blocks fa fa-lightbulb-o"></i>
                <div class="info-blocks-in" style="text-align: left!important;">
                    <h3>
                        <?php
                        if($active_lang=='lang_en') {
                            echo ucwords(strtolower($rowRel['content_title_en']));
                        } if ($active_lang=='lang_rw') {
                            echo ucwords(strtolower($rowRel['content_title_rw']));
                        }
                        ?>
                    </h3>
                    <p>
                        <i class="fa fa-eye"></i>&nbsp;
                        <?php
                        $statement5= $object->viewRelatedPage($rowRel['page_id']);
                        $view_row= $statement5->FETCH(PDO::FETCH_ASSOC);
                        echo $view_row['views']." ";
                        echo $view_row['views']==1?" view":" view(s)";
                        ?>
                    </p>
                    <p>
                        <a href="../subpage/<?php echo $rowRel['page_id']; ?>">
                            <?php
                            $stmt_version= $object->viewLangVersionText('read_post');
                            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                            echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                        </a>
                    </p>
                    
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } /* End Tabbed */ ?>
        <br><br>




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