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
            $qry= "INSERT INTO `article`(`article_title`, `article_image`, `publisher_id`, `article_category`, `article_post`) VALUES ('$title', '$name', '$admin', '$category', '".addslashes($a_post)."')";

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

    public function check4ArticleExistance($article_id) {
        $sql = "SELECT COUNT(*) FROM `article` WHERE article_id='$article_id'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;

    }

    public function readArticlesByPublisher($id) {
        $stmt=$this->con->prepare("SELECT * FROM article art LEFT JOIN admin adm ON adm.admin_id= art.publisher_id WHERE publisher_id='$id' ORDER BY article_id DESC LIMIT 25 ");
        $stmt->execute();
        return $stmt;
    }


    public function readArticlesAll() {
        $stmt=$this->con->prepare("SELECT * FROM article art LEFT JOIN admin adm ON adm.admin_id= art.publisher_id ORDER BY article_id DESC LIMIT 35 ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticle($article_id) {
        $stmt=$this->con->prepare("SELECT * FROM `article`art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE article_id='$article_id' ");
        $stmt->execute();
        return $stmt;
    }

    public function readArticleByCategory($category) {
        $stmt=$this->con->prepare("SELECT * FROM `article`art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE article_category='$category' ");
        $stmt->execute();
        return $stmt;
    }


    public function readOneArticle($article_id, $admin_id) {
        $stmt=$this->con->prepare("SELECT * FROM `article`art LEFT JOIN admin adm ON adm.admin_id = art.publisher_id WHERE publisher_id='$admin_id' AND article_id ='$article_id' ");
        $stmt->execute();
        return $stmt;
    }

    public function readRecentArticles() {
        $stmt=$this->con->prepare("SELECT * FROM article ORDER BY article_date DESC LIMIT 3");
        $stmt->execute();
        return $stmt;
    }

    public function readTop5Articles() {
        $stmt=$this->con->prepare("SELECT * FROM article ORDER BY article_date ASC LIMIT 5");
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

    public function showShortText12($string) {
        if (strlen($string) > 12) {
            $string = substr($string, 0, 12) . '...';
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
    public function setupWebsite($siteName, $contactNo, $email, $location, $address, $hours, $quote, $mission, $date) {
        
        // Validate
        $sql= "INSERT INTO `settings`(`site_name`, `contact_no`, `contact_email`, `location`, `address`, `active_hours`, `main_quote`, `mission`, `date_started`) VALUES('".addslashes($siteName)."', '$contactNo', '$email', '$location', '$address', '$hours', '".addslashes($quote)."', '".addslashes($mission)."', '$date')";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count; 
    }

    public function updateUpWebsite($id, $siteName, $contactNo, $email, $location, $address, $hours, $quote, $mission, $date) {
        // UPDATING
        $qry= "UPDATE `settings` SET `site_name`='".addslashes($siteName)."' , `contact_no`='$contactNo', `contact_email`='$email', `location`='$location', `address`='$address', `active_hours`='$hours', `main_quote`='".addslashes($quote)."', `mission`='".addslashes($mission)."', `date_started`='$date' WHERE setup_id='$id' ";
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
    public function addSlide($title, $description, $picture) {

        $stmt=$this->con->prepare("SELECT COUNT(*) FROM slide WHERE slide_title='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $name = $picture['name'];
            $temp = $picture['tmp_name'];
            $finalname = "slide-".$name;
            $sql= "INSERT INTO `slide`(`slide_title`, `description`, `slide_image`) VALUES ('$title', '".addslashes($description)."', '$finalname')";

            if(is_uploaded_file($temp)) {
                move_uploaded_file($temp, "../uploads/slides/".$finalname);
            }

            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            return $count = 0;
        } 
    }


    public function updateSlide($id, $title, $description, $picture) {

        $stmt=$this->con->prepare("SELECT COUNT(*) FROM slide WHERE slide_title='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) { 
            $name = $picture['name'];
            $temp = $picture['tmp_name'];
            $finalname = "slide-".$name;
            $sql= "UPDATE `slide` SET `slide_title`='$title', `description`='".addslashes($description)."', `slide_image`='$finalname' WHERE slide_id='$id' ";

            if(is_uploaded_file($temp)) {
                move_uploaded_file($temp, "../uploads/slides/".$finalname);
            }

            $query= $this->con->prepare($sql);
            $query->execute();
            $count= $query->rowCount();
            return $count;
        } else {
            return $count = 0;
        } 
    }

    public function viewAllSlides() {
        $stmt=$this->con->prepare("SELECT * FROM slide ORDER BY slide_id DESC LIMIT 4");
        $stmt->execute();
        return $stmt;
    }

    public function viewOneSlide($id) {
        $stmt=$this->con->prepare("SELECT * FROM slide WHERE slide_id='$id' ");
        $stmt->execute();
        return $stmt;
    }

    public function regSubContentMenu($id, $sm, $title, $header, $format) {
        $stmt=$this->con->prepare("SELECT COUNT(*) FROM menu_sub_sub WHERE cmenu_name='$title' ");
        $stmt->execute(); 
        if($stmt->fetchColumn()==0) {

            function urlMaker($string) {
                $makeAshit= strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));
                $regex= "/[.*?!@#$&-_ ]+$/";
                return preg_replace($regex, "", $makeAshit); 
            }

            $sql= "INSERT INTO `menu_sub_sub`(`menu_id`, `sub_menu_id`, `cmenu_name`, `cmenu_url`, `page_type`, `cmenu_header`) VALUES ('$id', '$sm', '$title', '".urlMaker($title)."', '$format', '".addslashes($header)."')";
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

    public function getTabsDataPerPage($page) {
        $stmt=$this->con->prepare("SELECT * FROM `menu_tabs` WHERE page_id='$page' ");
        $stmt->execute();
        return $stmt;
    }

    public function getTabbedContents($url) {
        $stmt=$this->con->prepare("SELECT * FROM `menu_tabs` LEFT JOIN menu_sub_sub ON menu_sub_sub.cmenu_id= menu_tabs.page_id WHERE cmenu_url='$url' ");
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

    public function check4TabbedContent($id) {
        $sql = "SELECT COUNT(*) FROM `menu_tabs` WHERE page_id='$id'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }


    public function regSubContentMenuD($id, $sm, $title, $header, $picture, $content) {
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

    public function updateSubMenu($id, $title, $header, $content) {
        $qry= "UPDATE `menu_sub_sub` SET `cmenu_name`='$title' , `cmenu_header`='$header', `page_content`='".addslashes($content)."' WHERE cmenu_id='$id' ";
        $query= $this->con->prepare($qry);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function updateContentTabs($id, $title, $content) {
        $qry= "UPDATE `menu_tabs` SET `tab_title`='$title' , `tab_content`='".addslashes($content)."' WHERE tab_id='$id' ";
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


    // Sub menus
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


    // Get sub-sub menus
    public function getContentSubMenus($submenu) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub_sub WHERE sub_menu_id='$submenu' ");
        $stmt->execute();
        return $stmt;
    }

    public function getContentSubMenusByMenu($menu) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub_sub WHERE menu_id='$menu' ");
        $stmt->execute();
        return $stmt;
    }

    public function getSpecificPageBySlug($slug) {
        $stmt=$this->con->prepare("SELECT * FROM menu_sub_sub WHERE cmenu_url='$slug' ");
        $stmt->execute();
        return $stmt;
    }

    public function check4PageExistance($slug) {
        $sql = "SELECT COUNT(*) FROM `menu_sub_sub` WHERE cmenu_url='$slug'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;

    }


    // Articles
    public function createArticleView($post_id, $ip) {
        // check for unique ip
        $sql1 = "SELECT COUNT(*) FROM viewsbox WHERE post_id='$post_id' AND viewer_ip='$ip'";
        $stmt = $this->con->prepare($sql1);
        $stmt->execute();
        if($stmt->fetchColumn()<'1') {
            $query ="INSERT INTO `viewsbox`(`post_id`, `viewer_ip`, `date_viewed`) VALUES('$post_id', '$ip', NOW())";
            $query = $this->con->prepare($query);
            $query->execute();
            $count = $query->rowCount();
            return $count;
        }
    }

    public function countArticleViews($post_id) {
        $sql= "SELECT COUNT(post_id) FROM viewsbox WHERE post_id='$post_id'";
        $count = $this->con->query($sql)->fetchColumn();
        return $count;
    }



    // End all Queries
}
?>