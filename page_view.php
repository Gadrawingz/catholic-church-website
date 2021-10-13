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
                    ?>
                    <?php echo $result['cmenu_name']; ?>
                </h2>
            </div>
        </div>
    </section>

    <section id="content">
        <section class="section-padding">
            <div class="container">

                <?php 
                // No show this if its not tabbed
                if($result['page_type']!='Tabbed' && ($menu_slug!='news' && $menu_slug!='stories' && $menu_slug!='projects' && $menu_slug!='others')) {
                    if($result['page_picture']==null) { 
                ?>
                <div class="row showcase-section">
                    <div class="col-md-12">
                        <div class="about-text">
                            <h3><?php echo $result['cmenu_header']; ?></h3>
                            <p><?php echo stripcslashes($result['page_content']); ?></p>
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
                            <h3><?php echo $result['cmenu_header']; ?></h3>
                            <p><?php echo stripcslashes($result['page_content']); ?></p>
                        </div>
                    </div>
                </div>
            <?php }} ?>



            <?php if($menu_slug=='news' || $menu_slug=='stories' || $menu_slug=='projects' || $menu_slug=='others'){ ?>
                <!-- End Info Bocks -->
                <div class="row service-v1 margin-bottom-40">
                    <?php
                    $stmt2= $object->readArticleByCategory($menu_slug);
                    while($rowp= $stmt2->FETCH(PDO::FETCH_ASSOC)) { 
                    ?>
                    <div class="col-md-4 col-sm-6 col-xs-12 gallery-item-wrapper photography artwork">
                        <div class="gallery-item">
                            <div class="gallery-thumb summary-image">
                                <img src="../uploads/posts/<?php echo $rowp['article_image'];?>" class="img-responsive" alt="<?php echo $rowp['article_title'];?>">
                                <div class="image-overlay"></div>
                                <a href="../uploads/posts/<?php echo $rowp['article_image'];?>" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                                <a href="read/<?php echo $rowp['article_id'];?>" class="gallery-link"><i class="fa fa-link"></i></a>
                            </div>
                            <div>
                                <h3><a href="../read/<?php echo $rowp['article_id'];?>"><?php echo $rowp['article_title'];?></a></h3>
                                <p><?php echo $object->showShortArticle(strip_tags($rowp['article_post']));?></p>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
            

            <?php if($menu_slug=='contact') { ?>
            <div class="col-md-9">
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
                <h5><u>Write for us now!</u></h5>
                <div class="control-group">
                    <div class="controls">
                        <label>Firstname</label>
                        <input type="text" class="form-control" placeholder="Firstname" name="firstname" data-validation-required-message="Please enter your firstname" required/>
                    </div>
                </div><br>

                <div class="control-group">
                    <div class="controls">
                        <label>Lastname</label>
                        <input type="text" class="form-control" placeholder="Lastname" name="lastname" required data-validation-required-message="Please enter your lastname"/>
                    </div>
                </div><br>

                <div class="control-group">
                    <div class="controls">
                        <label>Email address</label>
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" required data-validation-required-message="Please enter your email" />
                    </div>
                </div><br>

                <div class="control-group">
                    <div class="controls">
                        <label>Suggestion</label>
                        <textarea rows="10" cols="100" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter your message" minlength="5" data-validation-minlength-message="Min 5 characters" maxlength="999" style="resize:none"></textarea>
                    </div>
                </div><br>

                <button type="submit" class="btn btn-primary pull-right" name="sendmessage">Send</button><br/>
            </form>
            </div>
            <?php } else if($menu_slug=='communities') { ?>     
            <div class="container">
                <div class="about">
                    <div class="block-heading-six">
                        <h4 class="bg-color" style="text-align: center;">Team members</h4>
                    </div><br>
                    <div class="team-six">
                        <div class="row">
                            <?php
                            $stmt2= $object->viewAllAuthors();
                            while($row= $stmt2->FETCH(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="col-md-3 col-sm-6">
                                <!-- Team Member -->
                                <div class="team-member">
                                    <!-- Image -->
                                    <img class="img-responsive" src="../uploads/images/<?php echo $row['picture'];?>" alt="<?php echo $row['username']; ?>">
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
            <?php } else if($result['page_type']=='Tabbed') {
                $stmt46=$object->getTabbedContents($menu_slug);
                $histnum = 1;
                while($histpage= $stmt46->FETCH(PDO::FETCH_ASSOC)) {
            ?>
            <button class="tablink" onclick="openPage('<?php echo $histpage['tab_id']; ?>', this, 'white')" <?php if($histnum==1) { echo 'id="defaultOpen"'; } ?> >
                <?php echo $histpage['tab_title']; ?>
            </button>
            <?php } ?>


            <?php
                $stmt47=$object->getTabbedContents($menu_slug);
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
                                <h2 class="pageTitle page-title-inner">Oops, Its Error 404! </h2>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="about-logo">
                    <div class="big-border">
                        <br><br><br>Requested page is not found!<br><br><br>
                    </div>
                </div><hr class="hr-small">
            <?php } // Found ?>

        <!-- Main footer -->
        <?php include('configs/site_footer_bk.php'); ?>