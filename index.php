<?php include('configs/site_header.php'); ?>
        
        <section id="call-to-action-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-sm-9">
                        <h3>Quote of the day</h3>
                        <p>&laquo; <?php echo $aboutrow['main_quote']; ?> &raquo;</p>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <a href="page/prayers" class="btn btn-primary">More prayers</a>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="slide-container">
        <?php
        $stmt= $object->viewAllSlides();
        while($row= $stmt->FETCH(PDO::FETCH_ASSOC)) {
        ?>
            <!-- Full-width images with caption text -->
            <div class="image-sliderfade sfade">
                <img src="uploads/slides/<?php echo $row['slide_image']; ?>" alt="<?php echo $row['slide_title']; ?>" class="slide-img">
                <div class="slide-text">
                    <h3 style="color:#FFF;"><?php echo $row['slide_title']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                </div>
                
            </div>
        <?php } ?>
        </div><br>
    
        <!-- The dots/circles -->
        <div style="text-align:center">
            <?php
            $stmt4= $object->viewAllSlides();
            while($row4= $stmt4->FETCH(PDO::FETCH_ASSOC)) {
            ?>
            <span class="sdot"></span>
            <?php } ?>
        </div><br>


        <section id="content">
        <div class="container content">     

        <!-- End Info Bocks -->
        <h2 class="aligncenter">Recent posts</h2>
        <div class="row service-v1 margin-bottom-40">
            <?php
            $stmt2= $object->readRecentArticles();
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
                            <h2 class="aligncenter">Who are we?</h2>
                            
                            <hr><a href="page/about" class="btn btn-sm btn-success">More about us</a>
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
                            <h2>Contact Us</h2>
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
                                    <label>Sugestion</label>
                                    <textarea rows="10" cols="100" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter your message" minlength="5" data-validation-minlength-message="Min 5 characters" maxlength="999" style="resize:none"></textarea>
                                </div>
                            </div><br/>
                            <button type="submit" class="btn btn-primary pull-right" name="sendmessage" style="background: green!important; border: 0!important;">Send</button><br/>
                        </form>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="about-text">
                            <h4 style="color: white;">Ni gute watugeraho</h4><hr>
                            <p><!----></p>

                            <ul class="withArrow">
                                <li><span class="fa fa-angle-right"></span> Anything 1</li>
                                <li><span class="fa fa-angle-right"></span> Anything 2</li>
                                <li><span class="fa fa-angle-right"></span> Anything 3</li>
                                <li><span class="fa fa-angle-right"></span> Anything 4</li>
                            </ul>
                            <a href="page/contact" class="btn btn-primary">Visit contact page</a>
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
                            <h2>Encouragement</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="about-text">
                            <p>On becoming bishop, Father Lavigerie took the motto "Caritas" and as his episcopal coat of arms, a pelican. The Pelican is a bird which feeds its young with its own blood. His life illustrated the motto and coat of arms he had chosen. Arriving in Algiers, he addressed the Muslim Algerians: "I claim the privilege of loving you like sons " At the bishop's house he welcomed orphans and he founded two missionary societies to help them - the Missionaries of Africa (White Fathers) and the Missionary Sisters of Our Lady of Africa (White Sisters). He required from their members the same compassion that he himself had towards the Africans. "For our love to bear fruit, we must see Our Lord Himself in the patients we care for and in those touched by our charity and our patience"(Lavigerie).</p>

                            <ul class="withArrow">
                                <li><span class="fa fa-angle-right"></span> Encouragement of Word of God</li>
                                <li><span class="fa fa-angle-right"></span> Peace and Justice</li>
                                <li><span class="fa fa-angle-right"></span> Conversations between different religions such as those of other religions</li>
                                <li><span class="fa fa-angle-right"></span> Etc.</li>
                            </ul>
                            <a href="page/god-is-calling-you" class="btn btn-primary">More info</a>
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
                            <h3><span class="fa fa-bookmark"></span> Our mission</h3>

                        </div>
                        <p style="text-transform: capitalize!important;"><?php echo ($aboutrow['mission']); ?></p>
                    </div>

                    <div class="col-md-6">
                        <div class="timetable">
                            <h3><span class="fa fa-clock-o"></span> More....</h3>
                            <hr>
                            <dl>
                                <dt>Working hours</dt>
                                <dd><?php echo $aboutrow['active_hours']; ?></dd>
                            </dl>

                            <dl>
                                <dt>Aho duherereye</dt>
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