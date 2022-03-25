<?php include('configs/site_header.php');?>
        
        <section class="shit-container">
            <!-- Full-width images with number and caption text -->
            <?php
            $numSlide = 1;
            $stmt= $object->viewAllSlides();
            while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
            ?>

            <div class="iSlides fading" style="max-height: 100%!important;">
                <div class="numbertexto"><?php echo $numSlide;?> / 4</div>
                <img src="uploads/slides/<?php echo $row['slide_image']; ?>" alt="<?php echo $row['slide_title']; ?>" style="width:100%">
                <div class="slide-text"><b><?php echo $row['slide_title']; ?></b><br>
                    <span style="color: white; font-size: 12.5px; font-style: normal;"><?php echo $row['description']; ?></span>
                </div>
            </div>
            <?php $numSlide++; } ?>        

            <!-- Next and previous buttons -->
            <a class="prevShit" onclick="plusSlides(-1)">&#10094;</a>
            <a class="nextShit" onclick="plusSlides(1)">&#10095;</a>
        </section>
        <br>
    
        <!-- The dots/circles -->
        <div style="text-align:center">
            <?php
            $numShit = 1;
            $stmt4= $object->viewAllSlides();
            while($row4= $stmt4->FETCH(PDO::FETCH_ASSOC)) {
            ?>
            <span class="bdot" onclick="currentSlide($numShit)"></span>
            <?php $numShit++; } ?>
        </div><br>
        <section id="call-to-action-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-sm-9">
                        <?php
                        $stmt_version= $object->viewLangVersionText('daily_quote');
                        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                        echo $row_lang[$func->getLangRow($active_lang)];
                        ?>
                        <p style="color: aliceblue!important;">&laquo;
                            <?php
                            if($active_lang=='lang_en') {
                                echo $aboutrow['main_quote'];
                            } if($active_lang=='lang_rw') {
                                echo $aboutrow['main_quote_rw'];
                            }
                            ?> &raquo;
                        </p>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <?php
                        // Get specific menu data
                        $stmt88= $object->getSpecificPageBySlug('prayers');
                        $Mmenu= $stmt88->FETCH(PDO::FETCH_ASSOC);
                        if($Mmenu['link_order']=='Original') {
                            echo '<a href="page/prayers" class="btn btn-primary">';
                        } else {
                            echo '<a href="'.$Mmenu['featured_link'].'" class="btn btn-primary">';
                        }

                        $stmt_version= $object->viewLangVersionText('prayers');
                        $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                        echo $row_lang[$func->getLangRow($active_lang)];
                        ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="content">
        <div class="container content">     

        <!-- End Info Bocks -->
        <h2 class="aligncenter">
            <?php
            $stmt_version= $object->viewLangVersionText('recent_posts');
            $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
            echo $row_lang[$func->getLangRow($active_lang)];
            ?>
        </h2>
        <div class="row service-v1 margin-bottom-40">
            <?php
            $stmt2= $object->readRecentArticles($active_lang);
            while($rowp= $stmt2->FETCH(PDO::FETCH_ASSOC)) { 
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper photography artwork">
                <div class="gallery-item">
                    <div class="gallery-thumb summary-image">
                        <img src="uploads/posts/<?php echo $rowp['article_image'];?>" class="img-responsive" alt="<?php echo $rowp['article_title'];?>">
                        <div class="image-overlay"></div>
                        <a href="uploads/posts/<?php echo $rowp['article_image'];?>" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                        <a href="read/<?php echo $rowp['article_id'];?>" class="gallery-link"><i class="fa fa-link"></i></a>
                    </div>
                    <div>
                        <h3><a href="read/<?php echo $rowp['article_id'];?>"><?php echo $rowp['article_title'];?></a></h3>
                        <p><?php echo $object->showShortArticle(strip_tags($rowp['article_post']));?></p>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
        <!-- End Service Blcoks -->
    </div>
    </section>


        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aligncenter">
                            <h2 class="aligncenter">
                                <?php
                                $stmt_version= $object->viewLangVersionText('who_are_we');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h2>
                            
                            <hr><a href="page/who-are-we" class="btn btn-sm btn-success">
                                <?php
                                $stmt_version= $object->viewLangVersionText('more_about_us');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>
        </section>

        <section class="section-padding gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2>
                            <?php
                                $stmt_version= $object->viewLangVersionText('contact_us');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                            ?>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <?php
                        if(isset($_POST['sendmessage'])) {
                            if($object->contact($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['message'])) {
                                echo'<center><h5 class="btn btn-sm btn-success text-center">Thank you for contacting us!</h5></center>';
                            } else {
                                echo'<center><h5 class="btn btn-sm btn-danger text-center">Sorry! Message has been sent!</h5></center>';
                            }
                        }
                        ?>
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
                            <button type="submit" class="btn btn-primary pull-right" name="sendmessage" style="background: green!important; border: 0!important;"><?php
                                $stmt_version= $object->viewLangVersionText('send');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                            ?></button><br/>
                        </form>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="about-text">
                            <h4 style="color: #FFF;">
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

                            <a href="page/contact" class="btn btn-primary">
                                <?php
                                $stmt_version= $object->viewLangVersionText('visit_contact_page');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section><br>




        <section class="section-padding gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2>
                                <?php
                                $stmt_version= $object->viewLangVersionText('encouragement');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="about-text">
                            <p>
                                <?php
                                    $stmt_version= $object->viewLangVersionText('enc_large');
                                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                    echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </p>

                            <ul class="withArrow">
                                <li><span class="fa fa-angle-right"></span> 
                                <?php
                                    $stmt_version= $object->viewLangVersionText('enc_text_1');
                                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                    echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                                </li>
                                <li><span class="fa fa-angle-right"></span> 
                                <?php
                                    $stmt_version= $object->viewLangVersionText('enc_text_2');
                                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                    echo $row_lang[$func->getLangRow($active_lang)];
                                ?></li>
                                <li><span class="fa fa-angle-right"></span> 
                                <?php
                                    $stmt_version= $object->viewLangVersionText('enc_text_3');
                                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                    echo $row_lang[$func->getLangRow($active_lang)];
                                ?></li>
                                <li><span class="fa fa-angle-right"></span> 
                                <?php
                                    $stmt_version= $object->viewLangVersionText('enc_text_etc');
                                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                    echo $row_lang[$func->getLangRow($active_lang)];
                                ?></li>
                            </ul>
                            <a href="page/who-are-we" class="btn btn-primary">
                                <?php
                                $stmt_version= $object->viewLangVersionText('more_info');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="about-image">
                            <img src="uploads/images/ishishikariza.jpg" alt="About Images">
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="about home-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Heading and para -->
                        <div class="block-heading-two">
                            <h3><span class="fa fa-bookmark"></span> 
                                <?php
                                $stmt_version= $object->viewLangVersionText('mission');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h3>

                        </div>
                        <p style="text-transform: capitalize!important;">
                            <?php
                            if($active_lang=='lang_en') {
                                echo $aboutrow['mission'];
                            } if($active_lang=='lang_rw') {
                                echo $aboutrow['mission_rw'];
                            }
                            ?>
                        </p>
                    </div>

                    <div class="col-md-6">
                        <div class="timetable">
                            <h3><span class="fa fa-clock-o"></span> 
                                <?php
                                $stmt_version= $object->viewLangVersionText('more');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h3>
                            <hr>
                            <dl>
                                <dt>
                                <?php
                                $stmt_version= $object->viewLangVersionText('working_hours');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                                </dt>
                                <dd><?php echo $aboutrow['active_hours']; ?></dd>
                            </dl>

                            <dl>
                                <dt>
                                <?php
                                $stmt_version= $object->viewLangVersionText('address');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                                </dt>
                                <dd><?php echo $aboutrow['address']; ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <br>
            </div>

        </div>

        <!-- Main footer -->
        <?php include('configs/site_footer.php'); ?>