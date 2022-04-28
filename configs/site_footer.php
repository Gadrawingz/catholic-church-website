            <section class="section-padding black-bg">
              <div>
                <div class="row">
                    <div class="col-lg-3">
                        <div>
                            <h3 class="h3-justified">
                                <?php
                                $stmt_version= $object->viewLangVersionText('more_about_us');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h3>

                            <div class="widget">
                                <address>
                                    <strong>
                                       <?php echo $aboutrow['site_name']; ?> 
                                    </strong><br>
                                    
                                    <?php
                                    if(!empty($aboutrow['po_box'])) {
                                    echo '<i class="fa fa-user"></i> '.$aboutrow['po_box'].'<br>';
                                    } ?>
                                    <?php echo '<i class="fa fa-globe"></i> '.$aboutrow['location']; ?>.<br>
                                </address>
                                <p>
                                    <span style="font-size: 11.5px;">
                                        <i class="fa fa-phone"></i> <?php echo $aboutrow['contact_no']; ?>
                                    </span><br>
                                    <i class="fa fa-envelope"></i></i> <?php echo $aboutrow['contact_email']; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div>
                            <h3 class="h3-justified">
                                <?php
                                $stmt_version= $object->viewLangVersionText('quick_links');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h3>
                            <ul class="link-list">
                                <?php
                                $stmt6= $object->bottomMenus();
                                while($menu= $stmt6->FETCH(PDO::FETCH_ASSOC)) { 
                                ?>
                                <li><a class="bottom-link" href="page/<?php echo $menu['menu_url'];?>"><?php echo $menu['menu_name'];?></a></li>
                                <?php if($menu['menu_url']=='home') { ?>
                                    <li><a href="index">Homepage</a></li>
                                <?php }} ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <p>
                            <h3 class="text-center h3-justified">
                                <?php
                                $stmt_version= $object->viewLangVersionText('most_viewed_stories');
                                $row_lang= $stmt_version->FETCH(PDO::FETCH_ASSOC);
                                echo $row_lang[$func->getLangRow($active_lang)];
                                ?>
                            </h3>
                            
                            <ul class="link-list">
                                <?php
                                if($active_lang=='lang_en') {
                                    $stmt4= $object->readTop5Articles();
                                } if($active_lang=='lang_rw') {
                                    $stmt4= $object->readTop5ArticlesRw();
                                }
                                while($rowp=$stmt4->FETCH(PDO::FETCH_ASSOC)) { 
                                ?>
                                <li style="text-transform: capitalize!important;"><a class="bottom-link" href="read/<?php echo $rowp['article_id'];?>"><?php echo ucwords(strtolower($rowp['article_title'])); ?></a></li>
                                <?php } ?>
                            </ul>
                        </p>
                    </div>
                </div>        
            
                <br><br><br>
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
                                </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
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
            
          </section>
    </div>
    <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.fancybox.pack.js"></script>
    <script src="js/jquery.fancybox-media.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/animate.js"></script>
    <!-- Vendor Scripts -->
    <script src="js/modernizr.custom.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
   
    <script src="js/custom.js"></script>
    <script src="others/customix/coolscript.js"></script>
    <script type="text/javascript" src="engine1/wowslider.js"></script>
    <script type="text/javascript" src="engine1/script.js"></script>

</body>
</html>