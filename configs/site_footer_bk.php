        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget">
                            <h5 class="widgetheading">
                                <?php
                                $stmt_version= $object->viewLangVersionText('more_about_us');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h5>
                            <address>
                                <strong><?php echo $aboutrow['site_name']; ?></strong><br><br>
                                <?php
                                if(!empty($aboutrow['po_box'])) {
                                    echo '<i class="fa fa-user"></i> '.$aboutrow['po_box'].'<br>';
                                }?>
                                <?php echo '<i class="fa fa-globe"></i> '.$aboutrow['location']; ?>.<br>
                            </address>
                            <p>
                                <i class="fa fa-phone"></i> <?php echo $aboutrow['contact_no']; ?><br>
                                <i class="fa fa-envelope"></i></i> <?php echo $aboutrow['contact_email']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget">
                            <h5 class="widgetheading">
                                <?php
                                $stmt_version= $object->viewLangVersionText('quick_links');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h5>
                            <ul class="link-list">
                                <?php
                                $stmt6= $object->bottomMenus();
                                while($menu= $stmt6->FETCH(PDO::FETCH_ASSOC)) { 
                                ?>
                                <li><a href="../page/<?php echo $menu['menu_url'];?>"><?php echo $menu['menu_name'];?></a></li>
                                <?php if($menu['menu_url']=='home') { ?>
                                    <li><a href="../index">Homepage</a></li>
                                <?php }} ?>

                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="widget">
                            <h5 class="widgetheading">
                                <?php
                                $stmt_version= $object->viewLangVersionText('most_viewed_stories');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h5>
                            <ul class="link-list">
                                <?php
                                if($active_lang=='lang_en') {
                                    $stmt4= $object->readTop5Articles();
                                } if($active_lang=='lang_rw') {
                                    $stmt4= $object->readTop5ArticlesRw();
                                }
                                
                                while($rowp=$stmt4->FETCH(PDO::FETCH_ASSOC)) { 
                                ?>
                                <li style="text-transform: capitalize!important;"><u><a href="../read/<?php echo $rowp['article_id'];?>"><?php echo $rowp['article_title'];?></a></u></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            <div id="sub-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="copyright">
                                <p>
                                    <span>&copy; <?php echo $aboutrow['site_name']; ?> <?php echo date('Y');?> 
                                    <?php
                                    $stmt_version= $object->viewLangVersionText('all_rights_reserved');
                                    $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                    echo $row_lang[$func->getLangRow($active_lang)];
                                    ?>
                                .</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="social-network">

                                <?php
                                $stmt= $object->viewSocials();
                                while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                                ?>
                                <li><a href="<?php echo $result['soc_url']; ?>" data-placement="top" title="<?php echo ucfirst($result['soc_name']); ?>" target="_blank"><i class="fa fa-<?php echo $result['soc_name']; ?>"></i></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.fancybox.pack.js"></script>
    <script src="../js/jquery.fancybox-media.js"></script>
    <script src="../js/jquery.flexslider.js"></script>
    <script src="../js/animate.js"></script>
    <!-- Vendor Scripts -->
    <script src="../js/modernizr.custom.js"></script>
    <script src="../js/jquery.isotope.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/animate.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/owl-carousel/owl.carousel.js"></script>
    <script src="../others/carousel/custom-slides.js"></script>
    <script src="../others/customix/coolscript.js"></script>
</body>
</html>