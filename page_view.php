<?php
include('configs/site_header_bk.php');
?>

<?php if($check_page!=0) { ?>

    <section id="inner-headline">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <h2 class="pageTitle">
                    <?php
                    if($menu_slug=='news' || $menu_slug=='stories' || $menu_slug=='projects' || $menu_slug=='others') {
                        echo "Posts | ";
                    }

                    // Translate page
                    if($active_lang=='lang_en') {
                        echo stripcslashes($result['cmenu_name']);
                    } if($active_lang=='lang_rw') {
                        if(empty($result['cmenu_name_rw'])) {
                            echo "No Kinyarwanda::".stripcslashes($result['cmenu_name']);
                        } else {
                            echo stripcslashes($result['cmenu_name_rw']);
                        }
                    }
                    ?>
                </h2>
            </div>
        </div>
    </section>

    <section id="content">
        <section class="section-padding">
            <div class="container">

                <?php 
                // No show this if its not tabbed
                if($result['page_type']!='Tabbed' && ($menu_slug!='videos' && $menu_slug!='posts' && $menu_slug!='contact' && $menu_slug!='news' && $menu_slug!='stories' && $menu_slug!='projects' && $menu_slug!='others')) {
                    if($result['page_picture']==null) { 
                ?>
                <div class="row showcase-section">
                    <div class="col-md-12">
                        <div class="about-text">
                            <p>
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
                </div><hr class="hr-small">
                <?php } else { ?>

                <div class="row showcase-section" style="background-color: #f5eef8;">
                    <div class="col-md-6">
                        <img src="../uploads/images/<?php echo $result['page_picture']; ?>" alt="showcase image" style="opacity: 70%; height: 100%; width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <div class="about-text">
                            <p>
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
            <?php }} ?>



            <?php if($menu_slug=='posts' || $menu_slug=='others'){ ?>
                <!-- End Info Bocks -->
                <div class="row service-v1 margin-bottom-40">
                    <?php
                    if($active_lang=='lang_en') {
                        $stmt2= $object->readArticleByCategory($menu_slug);
                    } if($active_lang=='lang_rw') {
                        $stmt2= $object->readArticleByCategoryRw($menu_slug);
                    }

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
                                <h3>
                                    <a href="../read/<?php echo $rowp['article_id'];?>">
                                        <?php echo $rowp['article_title'];?> 
                                    </a>
                                </h3>
                                <p><?php echo $object->showShortArticle(strip_tags($rowp['article_post']));?></p>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            

            <?php if($menu_slug=='contact') { ?>
            <div class="col-md-12">
            <?php
            if(isset($_POST['sendmessage'])) {
                if($object->contact($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['message'])) {
                    echo'<center><h5 class="btn btn-sm btn-success text-center">Thank you for contacting us!</h5></center>';
                } else {
                    echo'<center><h5 class="btn btn-sm btn-danger text-center">Sorry! Message has been sent!</h5></center>';
                }
            }
            ?>


            <div class="col-md-6">
                <?php
                if(isset($_POST['sendmessage'])) {
                    if($object->contact($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['message'])) {
                        echo'<center><h5 class="btn btn-sm btn-success text-center">Thank you for contacting us!</h5></center>';
                    } else {
                        echo'<center><h5 class="btn btn-sm btn-danger text-center">Sorry! Message has been sent!</h5></center>';
                    }
                }?>
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

                    <button type="submit" class="btn btn-primary pull-right" name="sendmessage" style="background: green!important; border: 0!important;">
                        <?php
                        $stmt_version= $object->viewLangVersionText('send');
                        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                        echo $row_lang[$func->getLangRow($active_lang)];
                        ?>
                    </button><br/>
                </form>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="about-text">
                    <h4 style="color: blue;">
                        <?php
                        $stmt_version= $object->viewLangVersionText('write_for_us');
                        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                        echo $row_lang[$func->getLangRow($active_lang)];
                        ?>
                    </h4><hr>
                    <p>
                        <?php
                        $stmt_version= $object->viewLangVersionText('contact_us_text');
                        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                        echo $row_lang[$func->getLangRow($active_lang)];
                        ?>                        
                    </p><hr>
                    <h4 style="color: cadetblue;">
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
            </div>
            </div><!--End of contact us 12 width -->
            <?php } else if($menu_slug=='communities') { ?>     
            <div class="container">
                <div class="about">
                    <div class="block-heading-six">
                        <h4 class="bg-color" style="text-align: center;">Team members</h4>
                    </div><br>
                    <div class="team-six">
                        <div class="row">
                            <?php
                            $stmt2= $object->viewAdmins();
                            while($row= $stmt2->FETCH(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="col-md-3 col-sm-6">
                                <!-- Team Member -->
                                <div class="team-member">
                                    <!-- Image -->
                                    <?php if(empty($row['picture'])) { ?>
                                    <center><div style="border: 1px solid brown;"><img class="img-responsive" src="../uploads/images/default.jpg" alt="<?php echo $row['username']; ?>" style="opacity: 6%;"></div></center>
                                    <?php } else { ?>
                                    <img class="img-responsive" src="../uploads/images/<?php echo $row['picture'];?>" alt="<?php echo $row['username']; ?>">
                                    <?php } ?>
                                    <!-- Name -->
                                    <h4><?php echo $row['firstname']." ".$row['lastname']; ?>(<?php echo $row['given_role']; ?>)</h4>
                                    <span class="deg"><?php echo $row['bio'];?></span> 
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php } else if($menu_slug=='videos') { ?>     
            <div class="container">
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
                                }?> 
                                </p><br>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php } else if($result['page_type']=='Tabbed') {
                $stmt46=$object->getTabbedContents($active_lang, $menu_slug);
                $histnum = 1;
                while($histpage= $stmt46->FETCH(PDO::FETCH_ASSOC)) {
            ?>
            <button class="tablink"onclick="openPage('<?php echo $histpage['tab_id']; ?>', this, 'white')" <?php if($histnum==1) { echo 'id="defaultOpen"'; } ?> >
                <?php
                if(empty($histpage['tab_title']) || $histpage['tab_title']=='') {
                    echo '<span class="text-danger">No translation</span>';
                } else {
                    echo $histpage['tab_title'];
                }
                ?>
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

            <?php } ?></div><br><br>


            <?php } else { ?>
                <section class="page-title-err">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="pageTitle page-title-inner">
                                    <?php
                                    $stmt_version= $object->viewLangVersionText('error_404');
                                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                    echo $row_lang[$func->getLangRow($active_lang)];
                                    ?>  
                                </h2>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="about-logo">
                    <div class="big-border" >
                        <br><br><br>
                        <center>
                            <?php
                            $stmt_version= $object->viewLangVersionText('req_not_found');
                            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                            echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                        </center>
                        <br><br><br>
                    </div>
                </div><hr class="hr-small">
            <?php } // Found ?>

        <!-- Main footer -->
        <?php include('configs/site_footer_bk.php'); ?>