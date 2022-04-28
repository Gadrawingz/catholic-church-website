<?php
include('dbconnection.php');

class AdminQuery extends DbConnection {
    // Calling ***********
    // Contribution from Gadrawingz
    // https://github.com/Gadrawingz
    public function __construct() {
        $object = new DbConnection;
        $this->con= $object->connection();
    }


    // All queries
    public function adminLogin($email, $pass) {
        $sql= "SELECT * FROM admin WHERE email='$email' AND password='$pass' ";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function registerAdmin($first, $last, $username, $email, $phone, $role, $password) {
        // validate
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM admin WHERE email='$email' OR password= '$password'");
        $stmt->execute(); 
        if($stmt->fetchColumn() <'1') { 
            $qry= "INSERT INTO `admin`(`firstname`, `lastname`, `username`, `email`, `phone`, `given_role`, `password`) VALUES ('$first', '$last', '$username', '$email', '$phone', '$role', '$password')";
            $query= $this->con->prepare($qry);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            return $count= "This admin exists!";
        } 
    }

    public function viewAdmins() {
        $stmt=$this->con->prepare("SELECT * FROM admin");
        $stmt->execute();
        return $stmt;
    }

    public function viewAllAuthors() {
        $stmt=$this->con->prepare("SELECT * FROM admin WHERE given_role='Author' ORDER BY admin_id ASC LIMIT 100");
        $stmt->execute();
        return $stmt;
    }

    public function viewTop5Authors() {
        $stmt=$this->con->prepare("SELECT * FROM admin WHERE given_role='Author' ORDER BY admin_id LIMIT 5");
        $stmt->execute();
        return $stmt;
    }

    public function viewOneAdmin($id) {
        $stmt=$this->con->prepare("SELECT * FROM admin WHERE admin_id='$id' ");
        $stmt->execute();
        return $stmt;
    }

    public function updateAdmin($id, $first, $last, $username, $email, $phone, $role) {
        $qry= "UPDATE `admin` SET `firstname`='$first' , `lastname`='$last', `username`='$username', `email`='$email', `phone`='$phone', `given_role`='$role' WHERE admin_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function changePassword($id, $password) {
        $qry= "UPDATE `admin` SET `password`='$password' WHERE admin_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function updateBio($id, $bio, $pic) {
        $name = $pic['name'];
        $temp = $pic['tmp_name'];
        $bio2 = addslashes($bio);

        $sql= "UPDATE `admin` SET `bio`='$bio2', `picture`='$name' WHERE `admin_id`='$id' ";
        if(is_uploaded_file($temp)) {
            move_uploaded_file($temp, "../uploads/images/".$name);
        }

        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function createArticle($admin, $title, $picture, $category, $a_post) {
        $name = $picture['name'];
        $temp = $picture['tmp_name'];
    
        // validate
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM article WHERE article_title='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $qry= "INSERT INTO `article`(`article_title`, `article_image`, `publisher_id`, `article_category`, `article_post`) VALUES ('".$title."', '$name', '$admin', '$category', '".addslashes($a_post)."')";

            if(is_uploaded_file($temp)) {
                move_uploaded_file($temp, "../uploads/posts/".$name);
            }

            $query= $this->con->prepare($qry);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            echo $count= "This post already exists!";
        } 
    }

    public function createArticleRw($admin, $ref, $title, $picture, $category, $a_post) {
        $name = $picture['name'];
        $temp = $picture['tmp_name'];
        // validate
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM article_rw WHERE article_title='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $qry= "INSERT INTO `article_rw`(`article_title`, `article_ref`, `article_image`, `publisher_id`, `article_category`, `article_post`) VALUES ('$title', '$ref', '$name', '$admin', '$category', '".addslashes($a_post)."')";

            if(is_uploaded_file($temp)) {
                move_uploaded_file($temp, "../uploads/posts/".$name);
            }

            $query= $this->con->prepare($qry);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            echo $count= "This post already exists!";
        } 
    }

    public function check4ArticleExistance($lang, $article_id) {
        if($lang=='lang_en') {
            $table = "article";
        } if($lang=='lang_rw') {
            $table = "article_rw";
        }
        $sql = "SELECT COUNT(*) FROM $table WHERE article_id='$article_id'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function check4ArticleExistanceRw($article_id) {
        $sql = "SELECT COUNT(*) FROM `article_rw` WHERE article_id='$article_id'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function removeArticle($id) {
        $sql= "DELETE FROM article WHERE article_id='$id' ";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();

        // Remove Reference also!
        $sql2= "DELETE FROM article_rw WHERE article_ref='$id' ";
        $stmt2=$this->con->prepare($sql2);
        $stmt2->execute();

        $count= $stmt->rowCount();
        return $count;
    }


    public function readArticlesByPublisher($id) {
        $stmt=$this->con->prepare("SELECT * FROM article art LEFT JOIN admin adm ON adm.admin_id= art.publisher_id WHERE publisher_id='$id' ORDER BY article_id DESC LIMIT 25 ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticlesByPublisherRw($id) {
        $stmt=$this->con->prepare("SELECT * FROM article_rw art LEFT JOIN admin adm ON adm.admin_id= art.publisher_id WHERE publisher_id='$id' ORDER BY article_id DESC LIMIT 25 ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticlesAll() {
        $stmt=$this->con->prepare("SELECT * FROM article art LEFT JOIN admin adm ON adm.admin_id= art.publisher_id ORDER BY article_id DESC LIMIT 35 ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticlesAllRw() {
        $stmt=$this->con->prepare("SELECT * FROM article_rw art LEFT JOIN admin adm ON adm.admin_id= art.publisher_id ORDER BY article_id DESC LIMIT 35 ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticle($article_id) {
        $stmt=$this->con->prepare("SELECT * FROM `article`art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE article_id='$article_id' ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticleRw($article_id) {
        $stmt=$this->con->prepare("SELECT * FROM `article_rw` art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE article_id='$article_id' ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticleByCategory($category) {
        $stmt=$this->con->prepare("SELECT * FROM `article`art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE article_category='$category' ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticleByCategoryRw($category) {
        $stmt=$this->con->prepare("SELECT * FROM `article_rw`art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE article_category='$category' ");
        $stmt->execute();
        return $stmt;
    }

    public function readOneArticle($article_id, $admin_id) {
        $stmt=$this->con->prepare("SELECT * FROM `article`art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE publisher_id='$admin_id' AND article_id ='$article_id'");
        $stmt->execute();
        return $stmt;
    }
    // has 2 args
    public function readOneArticleRwByRef($article_id, $admin_id) {
        $stmt=$this->con->prepare("SELECT * FROM `article_rw` art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE publisher_id='$admin_id' AND article_ref ='$article_id'");
        $stmt->execute();
        return $stmt;
    }

    // has 1 arg
    public function readOneArticleRwByRefOnly($article_id) {
        $stmt=$this->con->prepare("SELECT * FROM `article_rw` art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE article_ref ='$article_id'");
        $stmt->execute();
        return $stmt;
    }

    public function readUntranslatedArts() {
        $stmt=$this->con->prepare("SELECT art.article_id, art.article_title, art.article_image, art.publisher_id, art.article_category, art.article_post, art.article_date FROM `article` art LEFT JOIN article_rw arw ON arw.article_ref=art.article_id WHERE arw.article_ref IS NULL ORDER BY art.article_id DESC LIMIT 50");
        $stmt->execute();
        return $stmt;
    }

    public function readUntranslatedArt($art) {
        $stmt=$this->con->prepare("SELECT art.article_id, art.article_title, art.article_image, art.publisher_id, art.article_category, art.article_post, art.article_date FROM `article` art LEFT JOIN article_rw arw ON arw.article_ref=art.article_id WHERE arw.article_ref IS NULL ORDER BY art.article_id DESC LIMIT 50");
        $stmt->execute();
        return $stmt;
    }

    public function check4TranslatedPost($id) {
        $sql = "SELECT count(*) FROM article_rw WHERE article_ref='$id' ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function readRecentArticles($lang) {
        if($lang=='lang_en') {
            $table = "article";
        } if($lang=='lang_rw') {
            $table = "article_rw";
        }
        $stmt=$this->con->prepare("SELECT * FROM $table ORDER BY article_date DESC LIMIT 3");
        $stmt->execute();
        return $stmt;
    }

    public function readPopularArticles($lang) {
        if($lang=='lang_en') {
            $table_a = "article";
            $table_v = "viewsbox";
        } if($lang=='lang_rw') {
            $table_a = "article_rw";
            $table_v = "viewsbox_rw";
        }

        // Sophisticated Query based on Gadrawingz @gadrawingz logic spec
        $sql = "SELECT DISTINCT *, COUNT(vw.post_id) AS views FROM $table_a art LEFT JOIN $table_v vw ON vw.post_id=art.article_id GROUP BY vw.post_id ORDER BY views DESC LIMIT 8";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function readPopularArticlesLimit15($lang) {
        if($lang=='lang_en') {
            $table_a = "article";
            $table_v = "viewsbox";
        } if($lang=='lang_rw') {
            $table_a = "article_rw";
            $table_v = "viewsbox_rw";
        }
        // Sophisticated Query based on Gadrawingz @gadrawingz logic spec
        $sql = "SELECT DISTINCT *, COUNT(vw.post_id) AS views FROM $table_a art LEFT JOIN $table_v vw ON vw.post_id=art.article_id GROUP BY vw.post_id ORDER BY views DESC LIMIT 15";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // Not prepared
    public function readArticlesByAuthor($id) {
        $sql = "SELECT cou(*) FROM article WHERE publisher_id='$admin_id' ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function readTop5Articles() {
        $stmt=$this->con->prepare("SELECT * FROM article ORDER BY article_date ASC LIMIT 5");
        $stmt->execute();
        return $stmt;
    }

    public function readTop5ArticlesRw() {
        $stmt=$this->con->prepare("SELECT * FROM article_rw ORDER BY article_date ASC LIMIT 5");
        $stmt->execute();
        return $stmt;
    }

    public function updateArticle($id, $title, $category, $a_post) {

        $sql= "UPDATE `article` SET `article_title`='$title', `article_category`='$category', `article_post`= '".addslashes($a_post)."' WHERE article_id= '$id' ";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function updateArticleRw($id, $title, $category, $a_post) {
        $sql= "UPDATE `article_rw` SET `article_title`='$title', `article_category`='$category', `article_post`= '".addslashes($a_post)."' WHERE article_id= '$id' ";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function contact($firstname, $lastname, $email, $message) {
        
    // validate
    $stmt=$this->con->prepare("SELECT COUNT(*) FROM message WHERE message_content='$message' ");
    $stmt->execute(); 
    if($stmt->fetchColumn()==0) { 
        $sql= "INSERT INTO `message`(`firstname`, `lastname`, `message_title`, `message_content`, `sender_email`) VALUES ('$firstname', '$lastname', 'Contact', '$message', '$email')";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count;
        }
    }

    public function readOneMessage($message_id) {
        $stmt=$this->con->prepare("SELECT * FROM message WHERE message_id ='$message_id' ");
        $stmt->execute();
        return $stmt;
    }

    public function readAllMessages() {
        $stmt=$this->con->prepare("SELECT * FROM message ORDER BY message_id DESC ");
        $stmt->execute();
        return $stmt;
    }


    public function removeMessage($id) {
        $sql= "DELETE FROM message WHERE message_id='$id' ";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        $count= $stmt->rowCount();
        return $count;
    }

    public function showShortText12($string) {
        if (strlen($string) > 12) {
            $string = substr($string, 0, 12) . '...';
            return $string;
        } else {
            return $string;
        }
    }

    public function showShortText18($string) {
        if (strlen($string) > 18) {
            $string = substr($string, 0, 18) . '...';
            return $string;
        } else {
            return $string;
        }
    }

    public function showShortText25($string) {
        if (strlen($string) > 25) {
            $string = substr($string, 0, 25) . '...';
            return $string;
        } else {
            return $string;
        }
    }

    public function showShortTextByNum($num, $string) {
        if (strlen($string) > $num) {
            $string = substr($string, 0, $num) . '...';
            return $string;
        } else {
            return $string;
        }
    }

    public function showMediumText($string) {
        if (strlen($string) > 300) {
            $string = substr($string, 0, 300) . '...';
            return $string;
        } else {
            return $string;
        }
    }

    public function showShortArticle($string) {
        if (strlen($string) > 150) {
            $string = substr($string, 0, 150) . '...';
            return $string;
        } else {
            return $string;
        }
    }

    public function replyToMessage($text, $message_id, $admin) {

        // validate
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM reply WHERE reply_text='$text' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $sql= "INSERT INTO `reply`(`message_id`, `admin_id`, `reply_text`) VALUES('$message_id', '".addslashes($admin)."', '$text')";
            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            echo $count= "The reply is duplicated!";
        } 
    }

    public function regSocialMedia($name, $url) {

        // validate
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM social_media WHERE soc_name='$name' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $sql= "INSERT INTO `social_media`(`soc_name`, `soc_url`) VALUES ('".$name."', '".addslashes($url)."')";
            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            return $count = 0;
        } 
    }

    public function updateSocialMedia($name, $url) {

        $sql= "UPDATE `social_media` SET `soc_url`='$url' WHERE `soc_name`= '".$name."' ";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function checkSocialMedia($name) {
        $sql = "SELECT count(*) FROM social_media WHERE soc_name='$name' ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function readOneSocial($name) {
        $stmt=$this->con->prepare("SELECT * FROM social_media WHERE soc_name='$name' ");
        $stmt->execute();
        return $stmt;
    }

    public function viewSocials() {
        $stmt=$this->con->prepare("SELECT * FROM social_media ");
        $stmt->execute();
        return $stmt;
    }

    // Site setup
    public function setupWebsite($siteName, $contactNo, $email, $po_box, $location, $address, $hours, $quote, $quote_rw, $mission, $mission_rw, $date) {
        
        // Validate
        $sql= "INSERT INTO `settings`(`site_name`, `contact_no`, `contact_email`, `po_box`, `location`, `address`, `active_hours`, `main_quote`, `main_quote_rw`, `mission`, `mission_rw`, `date_started`) VALUES('".addslashes($siteName)."', '$contactNo', '$email', '$po_box','$location', '$address', '$hours', '".addslashes($quote)."', '".addslashes($quote_rw)."', '".addslashes($mission)."', '".addslashes($mission_rw)."', '$date')";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count; 
    }

    public function updateUpWebsite($id, $siteName, $contactNo, $email, $po_box, $location, $address, $hours, $quote, $quote_rw, $mission, $mission_rw, $date) {
        // UPDATING
        $qry= "UPDATE `settings` SET `site_name`='".addslashes($siteName)."' , `contact_no`='$contactNo', `contact_email`='$email', `po_box`='$po_box', `location`='$location', `address`='$address', `active_hours`='$hours', `main_quote`='".addslashes($quote)."', `main_quote_rw`='".addslashes($quote_rw)."', `mission`='".addslashes($mission)."', `mission_rw`='".addslashes($mission_rw)."', `date_started`='$date' WHERE setup_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function viewWebsiteSetup() {
        $stmt=$this->con->prepare("SELECT * FROM settings ");
        $stmt->execute();
        return $stmt;
    }

    public function checkWebsiteSetup() {
        $sql = "SELECT COUNT(*) FROM settings";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function websiteSetupOne($id) {
        $stmt=$this->con->prepare("SELECT * FROM settings WHERE setup_id='$id' ");
        $stmt->execute();
        return $stmt;
    }


    // Counts!
    public function countAllArticles() {
        $sql = "SELECT count(*) FROM article ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function countArticleForAuthor($admin_id) {
        $sql = "SELECT count(*) FROM article WHERE publisher_id='$admin_id' ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function countArticleCategory($category) {}

    public function countAdmins() {
        $sql = "SELECT count(*) FROM admin ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function countMessages() {
        $sql = "SELECT count(*) FROM message ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }


    // Slides
    public function addSlide($title, $description, $picture_max, $picture_min) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM slide WHERE slide_title='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $namemax = $picture_max['name'];
            $tempmax = $picture_max['tmp_name'];
            $finalnamemax = "slide-".$namemax;
			
			$namemin = $picture_min['name'];
            $tempmin = $picture_min['tmp_name'];
            $finalnamemin = "slide-".$namemin;
			
			
            $sql= "INSERT INTO `slide`(`slide_title`, `description`, `slide_image_max`,`slide_image_min`)
			VALUES ('$title', '".addslashes($description)."', '$finalnamemax','$finalnamemin')";

            if(is_uploaded_file($tempmax) && is_uploaded_file($tempmin)) {
				 move_uploaded_file($tempmin, "../uploads/slidesmin/".$finalnamemin);
                 move_uploaded_file($tempmax, "../uploads/slides/".$finalnamemax);			
            }			
		

            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            return $count = 0;
        } 
    }

    public function updateSlide($id,$title,$description,$picturemax,$picturemin) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM slide WHERE slide_title='$title'");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $namemax = $picturemax['name'];
            $tempmax = $picturemax['tmp_name'];
            $finalnamemax = "slide-".$namemax;

			$namemin = $picturemin['name'];
            $tempmin = $picturemin['tmp_name'];
            $finalnamemin = "slide-".$namemin;

            $sql= "UPDATE `slide` SET `slide_title`='$title', `description`='".addslashes($description)."', `slide_image_max`='$finalnamemax',`slide_image_min`='$finalnamemin' WHERE slide_id='$id' ";

            if(is_uploaded_file($tempmax) && is_uploaded_file($tempmin)) {
                move_uploaded_file($tempmax, "../uploads/slides/".$finalnamemax);
                move_uploaded_file($tempmin, "../uploads/slidesmin/".$finalnamemin);
            }

            // Remove shit
            $stmtZ=$this->con->prepare("SELECT slide_image_max, slide_image_min FROM slide WHERE slide_id=? ");
            $stmtZ->execute([$id]);
            $returnedRow = $stmtZ->fetch(PDO::FETCH_ASSOC);

            unlink("../uploads/slides/".$returnedRow['slide_image_max']);
            unlink("../uploads/slidesmin/".$returnedRow['slide_image_min']);

            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            return $count = 0;
        } 
    }

    public function deleteSlide($id) {
        $sql= "DELETE FROM slide WHERE slide_id='$id' ";

        // Remove shit
        $stmtZ=$this->con->prepare("SELECT slide_image_max,slide_image_min FROM slide WHERE slide_id=? ");
        $stmtZ->execute([$id]);
        $returnedRow = $stmtZ->fetch(PDO::FETCH_ASSOC);
        unlink("../uploads/slides/".$returnedRow['slide_image_max']);
        unlink("../uploads/slidesmin/".$returnedRow['slide_image_min']);

        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        $count= $stmt->rowCount();
        return $count; 
    }

    public function viewAllSlides() {
        $stmt=$this->con->prepare("SELECT * FROM slide ORDER BY slide_id DESC LIMIT 10");
        $stmt->execute();
        return $stmt;
    }

    public function viewOneSlide($id) {
        $stmt=$this->con->prepare("SELECT * FROM slide WHERE slide_id='$id' ");
        $stmt->execute();
        return $stmt;
    }


    // Caring about videos
    public function addNewVideoLink($url, $desc, $desc_rw) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM video_table WHERE video_url='$url' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) {
            $sql= "INSERT INTO `video_table`(`video_url`, `description`, `description_rw`) VALUES ('$url', '".addslashes($desc)."', '".addslashes($desc_rw)."')";
            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            return $count='0';
        }
    }

    public function updateVideoLink($id, $url, $desc, $desc_rw) {
        $sql= "UPDATE `video_table` SET `video_url`='$url', `description`='".addslashes($desc)."', `description_rw`='".addslashes($desc_rw)."' WHERE video_id='$id'";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function viewAllVideos() {
        $stmt=$this->con->prepare("SELECT * FROM video_table ORDER BY video_id DESC LIMIT 10");
        $stmt->execute();
        return $stmt;
    }

    public function viewOneVideo($id) {
        $stmt=$this->con->prepare("SELECT * FROM video_table WHERE video_id='$id' ");
        $stmt->execute();
        return $stmt;
    }

    public function countVideosNum() {
        $sql = "SELECT count(*) FROM video_table ";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function deleteVideo($id) {
        $sql= "DELETE FROM video_table WHERE video_id='$id' ";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        $count= $stmt->rowCount();
        return $count; 
    }







    public function regSubContentMenu($id, $sm, $title, $title_rw, $title_fr, $format) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM menu_sub_sub WHERE cmenu_name='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) {

            function urlMaker($string) {
                $makeAshit= strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));
                $regex= "/[.*?!@#$&-_ ]+$/";
                return preg_replace($regex, "", $makeAshit); 
            }

            $sql= "INSERT INTO `menu_sub_sub`(`menu_id`, `sub_menu_id`, `cmenu_name`, `cmenu_name_rw`, `cmenu_name_fr`, `cmenu_url`, `page_type`) VALUES ('$id', '$sm', '".addslashes($title)."', '".addslashes($title_rw)."', '".addslashes($title_fr)."', '".urlMaker($title)."', '$format')";
            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        }
    }

    public function addNewTab($id, $title, $content) {
        
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM menu_tabs WHERE tab_content='$content' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) {
            $sql= "INSERT INTO `menu_tabs`(`page_id`, `tab_title`, `tab_content`) VALUES ('$id', '".addslashes($title)."', '".addslashes($content)."')";
            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        }
    }

    // Get tabs infp by using page : English
    public function getTabsDataPerPage($page) {
        $stmt=$this->con->prepare("SELECT * FROM `menu_tabs` WHERE page_id='$page' ");
        $stmt->execute();
        return $stmt;
    }

    // Get tabs infp by using page : Kinyarwanda
    public function getTabsDataPerPageRw($page) {
        // THIS JOIN IS UNUSUAL BECAUSE BOTH TABLE HAS NO RELATIONSHIP ABOUT PK AND FOREIGN KEY
        // INSTEAD IS USED THIS JOIN TO TARGET tab_id, BE CAREFUL ITS COMPLICATED @gadrawingz 
        $stmt=$this->con->prepare("SELECT mt_rw.tab_id, mt_rw.page_id, mt_rw.tab_title, mt_en.tab_title as tab_title_en_ref, mt_rw.tab_content FROM `menu_tabs_rw` mt_rw JOIN menu_tabs mt_en ON mt_en.tab_id=mt_rw.tab_id WHERE mt_rw.page_id='$page' ");
        $stmt->execute();
        return $stmt;
    }


    public function getTabbedContents($lang, $url) {
        if($lang=='lang_en') {
            $table = "menu_tabs";
        } if($lang=='lang_rw') {
            $table = "menu_tabs_rw";
        }
        $stmt=$this->con->prepare("SELECT * FROM $table LEFT JOIN menu_sub_sub ON menu_sub_sub.cmenu_id= $table.page_id WHERE cmenu_url='$url' ");
        $stmt->execute();
        return $stmt;
    }


    public function removeSpecificPage($id) {
      $sql= "DELETE FROM menu_sub_sub WHERE cmenu_id='$id' ";
      $stmt=$this->con->prepare($sql);
      $stmt->execute();
      $count= $stmt->rowCount();
      return $count; 
    }

    public function removeSpecificMenu($id) {
      $sql= "DELETE FROM menu WHERE menu_id='$id' ";
      $stmt=$this->con->prepare($sql);
      $stmt->execute();
      $count= $stmt->rowCount();
      return $count; 
    }

    public function check4TabbedContent($id) {
        $sql = "SELECT COUNT(*) FROM `menu_tabs` WHERE page_id='$id'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }


    public function regSubContentMenuNotFixed($id, $sm, $title, $header, $picture, $content) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM menu_sub WHERE cmenu_name='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) {

            $name = $picture['name'];
            $temp = $picture['tmp_name'];
            if(!empty($name)) {
                $finalname = "pic-".$name;
            } else {
                $finalname = "";
            }

            function shit($string) {
                $makeAshit= strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));
                $regex= "/[.*?!@#$&-_ ]+$/";
                return preg_replace($regex, "", $makeAshit); 
            }

            $sql= "INSERT INTO `menu_sub_sub`(`menu_id`, `sub_menu_id`, `cmenu_name`, `cmenu_url`, `page_type`, `cmenu_header`, `page_picture`, `page_content`) VALUES ('$id', '$sm', '$title', '".shit($title)."', 'Dynamic', '".addslashes($header)."', '$finalname', '".addslashes($content)."')";

            if(is_uploaded_file($temp)) {
                move_uploaded_file($temp, "../uploads/images/".$finalname);
            }

            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        }
    }


    public function regMainMenu($name, $name_rw, $name_fr, $behavior, $side) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM menu WHERE menu_name='$name'");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) {

            function shit($string) {
                $makeAshit= strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));
                $regex= "/[.*?!@#$&-_ ]+$/";
                return preg_replace($regex, "", $makeAshit); 
            }

            $sql= "INSERT INTO `menu`(`menu_url`, `menu_name`, `menu_name_rw`, `menu_name_fr`, `menu_side`, `has_submenu`, `order_no`) VALUES('".shit($name)."', '".addslashes($name)."', '".addslashes($name_rw)."', '".addslashes($name_fr)."', '$side', '$behavior', '77')";

            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        }
    }

    // UPDATION: TITLES ONLY:
    public function updateSubMenuTitleAndLinks($id, $title, $title_rw, $flink, $order) {
        $qry= "UPDATE `menu_sub_sub` SET `cmenu_name`='".addslashes($title)."' , `cmenu_name_rw`='".addslashes($title_rw)."', featured_link='".$flink."', link_order='".$order."' WHERE cmenu_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function updateSubMenuContent($id, $tbl_column, $content) {
        $qry= "UPDATE `menu_sub_sub` SET $tbl_column='".addslashes($content)."' WHERE cmenu_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    // UPDATE TAB WHICH IS IN ENGLISH
    public function updateContentTabs($id, $title, $content) {
        $qry= "UPDATE `menu_tabs` SET `tab_title`='".addslashes($title)."' , `tab_content`='".addslashes($content)."' WHERE tab_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    // UPDATE TAB WHICH IS IN KINYARWANDA
    public function updateContentTabsRw($id, $title, $content) {
        $qry= "UPDATE `menu_tabs_rw` SET `tab_title`='".addslashes($title)."' , `tab_content`='".addslashes($content)."' WHERE tab_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function getAllMenus() {
        $stmt=$this->con->prepare("SELECT * FROM menu ORDER BY order_no ASC ");
        $stmt->execute();
        return $stmt;
    }

    public function topMenus() {
        $stmt=$this->con->prepare("SELECT * FROM menu WHERE menu_side='Top' ORDER BY order_no ASC ");
        $stmt->execute();
        return $stmt;
    }

    public function bottomMenus() {
        $stmt=$this->con->prepare("SELECT * FROM menu WHERE menu_side='Bottom' AND menu_url!='home' LIMIT 10 ");
        $stmt->execute();
        return $stmt;
    }

    public function getSingleMenu($id) {
        $stmt=$this->con->prepare("SELECT * FROM menu WHERE menu_id='$id' ");
        $stmt->execute();
        return $stmt;
    }


    // Sub menus by cmenu_id (Primary key considered)
    public function getSubMenuData($id) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub_sub WHERE cmenu_id='$id'");
        $stmt->execute();
        return $stmt;
    }

    // Sub menus per menu 
    public function getSubMenus($menu) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub WHERE menu_id='$menu' ORDER BY sub_menu_id ASC ");
        $stmt->execute();
        return $stmt;
    }

    // Sections per single page 
    public function getSubMenusItem($menu) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub WHERE sub_menu_id='$menu' ");
        $stmt->execute();
        return $stmt;
    }

    public function countSubMenus($menu) {
        $sql= "SELECT COUNT(*) FROM menu_sub WHERE menu_id='$menu'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;

    }


    // Get sub-sub menus by sub-menu-id
    public function getContentSubMenus($submenu) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub_sub WHERE sub_menu_id='$submenu' ");
        $stmt->execute();
        return $stmt;
    }

    // BY MENU ID::
    public function getContentSubMenusByMenu($menu) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub_sub WHERE menu_id='$menu' ");
        $stmt->execute();
        return $stmt;
    }

    public function getSpecificPageBySlug($slug) {
        $stmt=$this->con->prepare("SELECT DISTINCT *, COUNT(vw.page_id) AS views FROM menu_sub_sub pg LEFT JOIN views_pages vw ON vw.page_id=pg.cmenu_id WHERE cmenu_url='$slug' ");
        $stmt->execute();
        return $stmt;
    }

    public function check4PageExistance($slug) {
        $sql = "SELECT COUNT(*) FROM `menu_sub_sub` WHERE cmenu_url='$slug'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;

    }


    // Article v
    public function createArticleView($lang, $post_id, $ip) {
        if($lang=='lang_en') {
            $views_table = "viewsbox";
        } if($lang=='lang_rw') {
            $views_table = "viewsbox_rw";
        }
        // check for unique ip
        $sql1 = "SELECT COUNT(*) FROM $views_table WHERE post_id='$post_id' AND viewer_ip='$ip'";
        $stmt = $this->con->prepare($sql1);
        $stmt->execute();
        // @gadrawingz avoiding localhost damn ip address
        if($stmt->fetchColumn()<'1' && $ip!='' && $ip!='::1') {
            error_reporting(0);
            $url = "http://ip-get-geolocation.com/api/json/$ip";
            $locArr1 = json_decode(file_get_contents($url), true);

            $query ="INSERT INTO $views_table (`post_id`, `viewer_ip`, `country`, `city`) VALUES ('$post_id', '$ip', '".addslashes($locArr1['country'])."', '".addslashes($locArr1['city'])."')";

            $query = $this->con->prepare($query);
            $query->execute();
            $count = $query->rowCount();
            return $count;
        }
    }

    public function createPageView($lang, $post_id, $ip) {

        if($lang=='lang_en') {
            $views_table = "views_pages";
        } if($lang=='lang_rw') {
            $views_table = "views_pages";
        }
        // check for unique ip
        $sql1 = "SELECT COUNT(*) FROM $views_table WHERE page_id='$post_id' AND viewer_ip='$ip'";
        $stmt = $this->con->prepare($sql1);
        $stmt->execute();
        // @gadrawingz execution
        // @gadrawingz avoiding localhost damn ip address
        if($stmt->fetchColumn()<'1' && $ip!='' && $ip!='::1') {
            error_reporting(0);
            $url2 = "http://ip-get-geolocation.com/api/json/$ip";
            $locArr2 = json_decode(file_get_contents($url2), true);

            $query ="INSERT INTO $views_table (`page_id`, `viewer_ip`, `country`, `city`) VALUES ('$post_id', '$ip', '".addslashes($locArr2['country'])."', '".addslashes($locArr2['city'])."')";
            $query = $this->con->prepare($query);
            $query->execute();
            $count = $query->rowCount();
            return $count;
        }
    }


    public function createSubPageView($lang, $page_id, $ip) {

        if($lang=='lang_en') {
            $views_table = "views_subpage";
        } if($lang=='lang_rw') {
            $views_table = "views_subpage";
        }
        // check for unique ip
        $sql1 = "SELECT COUNT(*) FROM $views_table WHERE page_id='$page_id' AND viewer_ip='$ip'";
        $stmt = $this->con->prepare($sql1);
        $stmt->execute();
        // @gadrawingz avoiding localhost damn ip address
        if($stmt->fetchColumn()<'1' && $ip!='' && $ip!='::1') {
            error_reporting(0);
            $url3 = "http://ip-get-geolocation.com/api/json/$ip";
            $locArr3 = json_decode(file_get_contents($url3), true);

            $query ="INSERT INTO $views_table (`page_id`, `viewer_ip`, `country`, `city`) VALUES ('$page_id', '$ip', '".addslashes($locArr3['country'])."', '".addslashes($locArr3['city'])."')";

            $query = $this->con->prepare($query);
            $query->execute();
            $count = $query->rowCount();
            return $count;
        }
    }

    public function renameMenuLabel($id, $title, $title_rw, $title_fr) {
        $qry="UPDATE `menu_sub` SET `sub_menu_title`='".addslashes($title)."', `sub_menu_title_rw`='".addslashes($title_rw)."', `sub_menu_title_fr`='".addslashes($title_fr)."' WHERE sub_menu_id='$id'";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function renameMainMenu($id, $name, $name_rw, $name_fr, $side) {
        $qry= "UPDATE `menu` SET `menu_name`='".addslashes($name)."', `menu_name_rw`='".addslashes($name_rw)."', `menu_name_fr`='".addslashes($name_fr)."', `menu_side`='$side' WHERE menu_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function countArticleViews($lang, $post_id) {
        if($lang=='lang_en') {
            $views_table = "viewsbox";
        } if($lang=='lang_rw') {
            $views_table = "viewsbox_rw";
        }
        $sql= "SELECT COUNT(post_id) FROM $views_table WHERE post_id='$post_id'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }

    // LANG VERSION
    public function viewLangVersionText($text) {
        $stmt=$this->con->prepare("SELECT * FROM keywords WHERE kwd_text='$text'");
        $stmt->execute();
        return $stmt;
    }

    public function updateEcouragementByKeyword($keyword, $en, $rw) {
        $qry= "UPDATE `keywords` SET `kwd_english`='".addslashes($en)."', `kwd_kinya`='".addslashes($rw)."' WHERE kwd_text='".$keyword."' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function checkLangVersionText($text) {
        $sql="SELECT COUNT(kwd_text) FROM keywords WHERE kwd_text='$text'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }



    // Recent Queries
    public function addRelatedPage($page_ref, $title_en, $title_rw, $ct_en, $ct_rw) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM related_pages WHERE content_title_en='$title_en' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) {

            $sql= "INSERT INTO `related_pages`(`page_ref`, `content_title_en`, `content_title_rw`, `content_text_en`, `content_text_rw`) VALUES ('".$page_ref."', '".addslashes($title_en)."', '".addslashes($title_rw)."', '".addslashes($ct_en)."', '".addslashes($ct_rw)."')";
            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        }
    }

    public function updateRelatedPage($id, $title_en, $title_rw, $ct_en, $ct_rw) {
        $qry= "UPDATE `related_pages` SET `content_title_en`='".addslashes($title_en)."', `content_title_rw`='".addslashes($title_rw)."', `content_text_en`='".addslashes($ct_en)."', `content_text_rw`='".addslashes($ct_rw)."' WHERE page_id='".$id."' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function viewRelatedPages($id) {
        $stmt=$this->con->prepare("SELECT * FROM related_pages WHERE page_ref='$id' ORDER BY created_at DESC LIMIT 30 ");
        $stmt->execute();
        return $stmt;
    }

    public function view8TopRelatedPages($id) {
        $stmt=$this->con->prepare("SELECT * FROM related_pages WHERE page_ref='$id' ORDER BY created_at DESC LIMIT 8 ");
        $stmt->execute();
        return $stmt;
    }

    public function readPopularPages() {
        $sql = "SELECT DISTINCT *, COUNT(vw.page_id) AS views FROM menu_sub_sub pg LEFT JOIN views_pages vw ON vw.page_id=pg.cmenu_id GROUP BY vw.page_id ORDER BY views DESC LIMIT 15";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function readPopularSubPages() {
        $sql = "SELECT DISTINCT *, COUNT(vw.page_id) AS views FROM related_pages pg LEFT JOIN views_subpage vw ON vw.page_id=pg.page_id GROUP BY vw.page_id ORDER BY views DESC LIMIT 15";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function viewRelatedPage($id) {
        $sql= "SELECT *, COUNT(vw.page_id) AS views FROM related_pages pg LEFT JOIN views_subpage vw ON vw.page_id=pg.page_id WHERE pg.page_id='$id' ";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function deleteRelatedPage($id) {
      $sql= "DELETE FROM related_pages WHERE page_id='$id' ";
      $stmt=$this->con->prepare($sql);
      $stmt->execute();
      $count= $stmt->rowCount();
      return $count; 
    }

    public function countRelatedPages($id) {
        $sql= "SELECT COUNT(*) FROM related_pages WHERE page_ref='$id' ";
        $count= $this->con->query($sql)->fetchColumn();
        return $count;
    }

    public function countSingleSpecificRelPage($id) {
        $sql = "SELECT COUNT(*) FROM related_pages WHERE page_id='$id' ";
        $count= $this->con->query($sql)->fetchColumn();
        return $count;
    }

    // @gadrawingz getting stats to ch page traffikaaa
    public function getArticleStatsByCountry($lang, $page) {
        if($lang=='lang_en') {
            $views_table = "viewsbox";
            $article_table= "article";
        } if($lang=='lang_rw') {
            $views_table = "viewsbox_rw";
            $article_table= "article_rw";
        }

        $sql= "SELECT DISTINCT vw.country, vw.city, COUNT(vw.post_id) AS counting FROM $article_table pg LEFT JOIN $views_table vw ON vw.post_id=pg.article_id WHERE vw.post_id='$page' GROUP BY vw.country ORDER BY counting DESC LIMIT 30;";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function getPostStatsByCountry($page) {
        $sql= "SELECT DISTINCT vw.country, vw.city, COUNT(vw.page_id) AS counting FROM menu_sub_sub pg LEFT JOIN views_pages vw ON vw.page_id=pg.cmenu_id WHERE vw.page_id='$page' GROUP BY vw.country ORDER BY counting DESC LIMIT 30";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function getSubPageStatsByCountry($page) {
        $sql= "SELECT DISTINCT vw.country, vw.city, COUNT(vw.page_id) AS counting FROM related_pages pg LEFT JOIN views_subpage vw ON vw.page_id=pg.page_id WHERE vw.page_id='$page' GROUP BY vw.country ORDER BY counting DESC LIMIT 30;";
        $stmt=$this->con->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // End all Queries
}
?>