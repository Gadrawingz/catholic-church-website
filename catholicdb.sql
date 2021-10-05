-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 04:21 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catholicdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `given_role` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL,
  `picture` varchar(180) DEFAULT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `email`, `phone`, `given_role`, `bio`, `picture`, `password`) VALUES
(1, 'Paulin', 'Ndikumana', 'Paulizoo', 'someone100@gmail.com', '0784056999', 'Admin', 'Hello', 'picture1.jpg', '1212'),
(2, 'Sandra', 'Ingabire', 'Sandra', 'sandra2000@gmail.com', '0789456632', 'Author', 'Lorem ipsum whats going on now', 'picture1.jpg', '12345'),
(3, 'Gad', 'Iradufasha', 'Gadson', 'gadson@gmail.com', '0789456632', 'Author', 'Not much', 'picture2.jpg', '112233');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(10) NOT NULL,
  `article_title` varchar(200) NOT NULL,
  `article_image` varchar(200) NOT NULL,
  `publisher_id` int(10) NOT NULL,
  `article_category` varchar(200) NOT NULL,
  `article_post` mediumtext NOT NULL,
  `article_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_title`, `article_image`, `publisher_id`, `article_category`, `article_post`, `article_date`) VALUES
(1, 'This is the first post we attempted to make', 'people1', 2, 'News', 'We have described post like this We want to go like this', '2021-09-08 00:00:00'),
(2, 'Good morning we have much to sell How do you feel?', '20200423_104333.jpg', 2, 'News', '<ol>\r\n<li>Amakuru yemwe duherukana ubushuze tuganira ku nkuru yaaaa</li>\r\n<li style=\"text-align: justify;\">Go ahead now...</li>\r\n<li style=\"text-align: justify;\"><img src=\"reusable/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /></li>\r\n<li style=\"text-align: justify;\">Mahatma Ghand</li>\r\n</ol>\r\n<p><strong>Ghandi wacu</strong></p>\r\n<p><strong>Do you know my name?</strong></p>\r\n<ol>\r\n<li>Hari igihe wibwira ngo bizoroha arko bikanga!</li>\r\n<li>Go down</li>\r\n<li>What do you wish to know!</li>\r\n<li>Kandi Reka</li>\r\n</ol>\r\n<p><strong>What the fuck?</strong></p>\r\n<p>TinyMCE is a web-based WYSIWYG editor that enables you to convert HTML textarea fields or other HTML elements to an editor.</p>\r\n<p>You can easily embed a rich text editor in the web page using the TinyMCE plugin. In this tutorial, we will show you the simple</p>\r\n<p>steps to add TinyMCE editor to your website by writing a minimal JavaScript Code.</p>\r\n<p>Download the latest version of the TinyMCE jQuery plugin from here &ndash;&nbsp;<a href=\"https://www.tiny.cloud/get-tiny/self-hosted/\" target=\"_blank\" rel=\"noopener noreferrer\">Download TinyMCE</a>. Extract it and placed it into the web application directory. Note that, it doesn&rsquo;t need to download separately, you can get all files together in our source code package.</p>', '2021-09-08 06:17:51'),
(8, 'Good morning This post is sure?', 'nuns.jpg', 2, 'Trending', '<section class=\"module module-cta module-cta--1\">\r\n<div class=\"section-container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<h2>CKEditor 5 is an Open Source application.</h2>\r\n<p>All downloads are fully functional and subject to relevant open source license agreements or commercial license agreements (whichever is applicable).</p>\r\n<div class=\"module-cta__actions\"><a class=\"btn btn-cta btn-cta--long btn--frame\" href=\"https://ckeditor.com/legal/ckeditor-oss-license/\">Read the license conditions</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n<div class=\"startup-enterprise-boxes\">\r\n<div class=\"product-section__inner\">\r\n<div class=\"startup-enterprise-boxes__single\">\r\n<div class=\"startup-enterprise-boxes__single-ico\">&nbsp;</div>\r\n<h2>Enterprise Offer</h2>\r\n<p>Looking for an enterprise-grade rich text editor that can boost productivity? We offer rock-solid software with premium technical support and custom development services.</p>\r\n<a class=\"btn\" href=\"https://ckeditor.com/enterprise/\">Find out more</a></div>\r\n<div class=\"startup-enterprise-boxes__single\">\r\n<div class=\"startup-enterprise-boxes__single-ico\">&nbsp;</div>\r\n<h2>Startup Program</h2>\r\n<p>Want to have the best rich text editor in your startup project? We offer free development plans, flexible support models and licensing systems tailored to your business needs.</p>\r\n<a class=\"btn\" href=\"https://ckeditor.com/startups/\">Find out more</a></div>\r\n</div>\r\n</div>\r\n<section class=\"module-case-studies\">\r\n<div class=\"section-container\">\r\n<h2>Read the success stories of our product</h2>\r\n<div class=\"module-case-studies__wrapper\">\r\n<div class=\"module-case-studies__single\">\r\n<p>How Neos CMS saved time and boosted productivity with CKEditor</p>\r\n</div>\r\n<div class=\"module-case-studies__single\">\r\n<p>How CKEditor allowed Tablo to establish a new business model</p>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '2021-09-08 06:24:22'),
(9, 'Classrooms are now closed after pandemic of june', 'classroom.jpg', 2, 'News', 'Class room are closed since january december ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non                 proident, sunt in culpa qui officia deserunt ', '2021-09-08 06:28:28'),
(10, 'New catholic church is going down', 'temple.jpg', 2, 'Trending', 'Cathedral is built with contribution ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non                 proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2021-09-08 06:38:03'),
(11, 'LAst months new nuns received in cathedral ', 'graduation.jpg', 2, 'Trending', '<p>In this article, we have shown you how to use a</p>\r\n<p>BLOB data type to store images in your MySQL database hosted on Alibaba Cloud ECS or ApsaraDB.</p>\r\n<p>&nbsp;</p>\r\n<p>Although the PHP scripts we have used in this guide are for demonstration purposes,</p>\r\n<ul>\r\n<li style=\"text-align: justify;\">you can extend them further</li>\r\n<li style=\"text-align: justify;\">to accommodate binary data in your application. If you are new to Alibaba Cloud,</li>\r\n<li style=\"text-align: justify;\">you can sign up to get free credit of up to $1200 and test MySQL databases and over 40 products on their platform</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Although the PHP scripts we have used in this guide are for demonstration purposes,</p>\r\n<ol>\r\n<li style=\"text-align: justify;\">You can extend them further</li>\r\n<li style=\"text-align: justify;\">to accommodate binary data in your application. If you are new to Alibaba Cloud,</li>\r\n<li style=\"text-align: justify;\"><span style=\"color: #ff6600;\">You can sign up to get free credit of up to $1200 and test MySQL databases and over 40 products on their platfor</span></li>\r\n</ol>', '2021-09-08 06:40:53'),
(12, 'Papa Francis yasuye u Rwanda kuri uyu wa gatanu umva ibyo yavuze', 'abanyeshuri.png', 2, 'Trending', 'Ubwo twamenyaga ibyino nkuru twabajije icyatumye mu byukuri papa asuura urwanda batubwira ko yaje gusabira umugisha kiriziya nshya yubatswe i Huye Ubwo twamenyaga ibyino nkuru twabajije icyatumye mu byukuri papa asuura urwanda batubwira ko yaje gusabira umugisha kiriziya nshya yubatswe i Huye', '2021-09-09 16:10:20'),
(13, 'Wassap mwana rero sinzi uko bigenda', 'php-mysql-rest-api-for-android.png', 2, 'Trending', '<h3>Installing TinyMCE</h3>\r\n<p>Setting up TinyMCE is much like setting up CKEditor. The only difference is in the JavaScript that you add to your form. Here&rsquo;s how to do it:</p>\r\n<h4>1. Download TinyMCE</h4>\r\n<p><a href=\\\"http://tinymce.moxiecode.com/download.php\\\">Download the main TinyMCE package</a>, then extract the&nbsp;<code class=\\\"filename\\\">.zip</code>&nbsp;file to a&nbsp;<code class=\\\"filename\\\">tinymce</code>&nbsp;folder on your hard drive.</p>\r\n<p>Inside the&nbsp;<code class=\\\"filename\\\">tinymce</code>&nbsp;folder you&rsquo;ll find a&nbsp;<code class=\\\"filename\\\">jscripts</code>&nbsp;folder containing a&nbsp;<code class=\\\"filename\\\">tiny_mce</code>&nbsp;folder. Move this&nbsp;<code class=\\\"filename\\\">tiny_mce</code>&nbsp;folder to your website folder.</p>\r\n<h4>2. Include the TinyMCE code in your Web form</h4>\r\n<p>To make your form work with TinyMCE, you include the&nbsp;<code class=\\\"filename\\\">tiny_mce.js</code>&nbsp;file in the page containing the form. This file is inside the&nbsp;<code class=\\\"filename\\\">tiny_mce</code>&nbsp;folder you moved into your website folder.</p>\r\n<p>Add this line inside the page&rsquo;s&nbsp;<code>head</code>&nbsp;element:</p>\r\n<pre class=\\\"code\\\"><code>\r\n&lt;script type=\\\"text/javascript\\\" src=\\\"tiny_mce/tiny_mce.js\\\"&gt;&lt;/script&gt;\r\n</code></pre>\r\n<p>adjusting the path to your&nbsp;<code class=\\\"filename\\\">tiny_mce</code>&nbsp;folder if required.</p>\r\n<h4>3. Convert your form&rsquo;s&nbsp;<code>textarea</code>&nbsp;element into a TinyMCE instance</h4>\r\n<p>Finally, convert the&nbsp;<code>textarea</code>&nbsp;field into a TinyMCE field. To do this, add the following JavaScript to your form:</p>', '2021-09-30 07:25:20'),
(14, 'Ese ni muebue', '5021450.png', 2, 'News', '<p style=\\\"text-align: left;\\\"><a href=\\\"https://www.google.com\\\">Holla <span style=\\\"text-decoration: line-through;\\\">Damour</span></a></p>\r\n<table style=\\\"height: 180px; width: 395px;\\\">\r\n<tbody>\r\n<tr style=\\\"height: 19px;\\\">\r\n<td style=\\\"width: 163.477px; height: 19px;\\\"><strong>Gadson</strong></td>\r\n<td style=\\\"width: 19.5227px; height: 19px;\\\">Wass</td>\r\n</tr>\r\n<tr style=\\\"height: 19px;\\\">\r\n<td style=\\\"width: 163.477px; height: 19px;\\\">1</td>\r\n<td style=\\\"width: 19.5227px; height: 19px;\\\">Muhoza</td>\r\n</tr>\r\n<tr style=\\\"height: 19px;\\\">\r\n<td style=\\\"width: 163.477px; height: 19px;\\\">2</td>\r\n<td style=\\\"width: 19.5227px; height: 19px;\\\">ASA</td>\r\n</tr>\r\n<tr style=\\\"height: 19px;\\\">\r\n<td style=\\\"width: 163.477px; height: 19px;\\\">3</td>\r\n<td style=\\\"width: 19.5227px; height: 19px;\\\">Holla</td>\r\n</tr>\r\n<tr style=\\\"height: 19px;\\\">\r\n<td style=\\\"width: 163.477px; height: 19px;\\\">4</td>\r\n<td style=\\\"width: 19.5227px; height: 19px;\\\">Ganza</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2021-09-30 08:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(10) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_side` varchar(60) NOT NULL,
  `has_submenu` varchar(5) NOT NULL,
  `order_no` int(5) NOT NULL,
  `menu_header` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_url`, `menu_name`, `menu_side`, `has_submenu`, `order_no`, `menu_header`) VALUES
(1, 'home', 'Home', 'Top', 'No', 1, 'Homepage'),
(2, 'about', 'About Us', 'Top', 'Yes', 2, 'About Us'),
(3, 'what-we-do', 'What we do', 'Top', 'Yes', 3, 'What we do'),
(4, 'Ishishikariza', 'Ishishikariza', 'Top', 'Yes', 4, 'Ishishikariza'),
(5, 'youths', 'Youths', 'Top', 'No', 5, 'Youths'),
(6, 'videos', 'Our Videos', 'Top', 'No', 6, 'Our Videos'),
(7, 'terms', 'Terms and Conditions', 'Bottom', 'No', 7, 'Terms and conditions'),
(8, 'privacy', 'Privacy and Policy', 'Bottom', 'No', 8, 'Privacy and Policy'),
(9, 'contact', 'Contact Us', 'Bottom', 'No', 9, 'Contact Us'),
(10, 'history', 'History', 'Bottom', 'No', 10, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `menu_sub`
--

CREATE TABLE `menu_sub` (
  `cmenu_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `cmenu_name` varchar(200) NOT NULL,
  `cmenu_url` varchar(80) NOT NULL,
  `page_type` varchar(100) NOT NULL,
  `cmenu_header` varchar(200) NOT NULL,
  `page_picture` varchar(255) NOT NULL,
  `page_content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_sub`
--

INSERT INTO `menu_sub` (`cmenu_id`, `menu_id`, `cmenu_name`, `cmenu_url`, `page_type`, `cmenu_header`, `page_picture`, `page_content`) VALUES
(1, 1, 'Home', 'home', 'Static', 'Home', '', ''),
(2, 5, 'Youths', 'youths', 'Static', 'Youths', '', ''),
(3, 6, 'Videos', 'videos', 'Static', 'Videos', '', ''),
(4, 2, 'Stories', 'stories', 'Dynamic', 'Stories about Catholic', 'pic-stories.jpg', '<h2>Disadvantages of a WYSIWYG editor</h2>\r\n<p>One problem with WYSIWYG HTML editors is that they tend to churn out poor-quality, bloated HTML, although recent editors have improved their HTML output considerably.</p>\r\n<p>Another problem is that users of a content management system with a WYSIWYG editor can easily break the style conventions of a site by adding their own non-standard formatting (see&nbsp;<a href=\"http://www.elated.com/forums/topic/1243/\">Inline HTML editors ruin your brand</a>). For example, the site&rsquo;s style guide might stipulate that all headings should be green, but the user decides to create a red heading in the WYSIWYG editor. It&rsquo;s hard to prevent this kind of problem using WYSIWYG HTML editors (although you can lock them down to a certain extent).</p>\r\n<p class=\"infoBox\">For a different way to enter and format content, see&nbsp;<a href=\"https://www.elated.com/articles/textile-markdown-nice-alternatives-to-wysiwyg-editors/\">Textile and Markdown: 2 Nice Alternatives to WYSIWYG Editors</a>.</p>\r\n<h2>The 2 popular editors: CKEditor and TinyMCE</h2>\r\n<p>Although there are many JavaScript WYSIWYG editors available today, the 2 most popular editors are&nbsp;<a href=\"http://ckeditor.com/\">CKEditor</a>&nbsp;(formerly FCKeditor) and&nbsp;<a href=\"http://tinymce.moxiecode.com/\">TinyMCE</a>.</p>\r\n<p>Both editors are free to use, and very feature-rich. Both are excellent choices, and there isn&rsquo;t much to separate the two these days. The older FCKeditor was harder to work with and produced messier HTML than TinyMCE, but CKEditor is much better in these respects.</p>\r\n<p>You can try out the live demos of&nbsp;<a href=\"http://ckeditor.com/demo\">CKEditor</a>&nbsp;and&nbsp;<a href=\"http://tinymce.moxiecode.com/examples/full.php\">TinyMCE</a>&nbsp;and see which you prefer.</p>\r\n<h2>File management</h2>\r\n<p>Both CKEditor and TinyMCE have optional, paid plugins that allow you to upload files and manage files on the server:</p>\r\n<ul>\r\n<li><a href=\"http://ckfinder.com/\">CKFinder</a>&nbsp;for CKEditor</li>\r\n<li><a href=\"http://tinymce.moxiecode.com/plugins_filemanager.php\">MCFileManager</a>&nbsp;and&nbsp;<a href=\"http://tinymce.moxiecode.com/plugins_imagemanager.php\">MCImageManager</a>&nbsp;for TinyMCE</li>\r\n</ul>'),
(5, 2, 'About', 'about', 'Dynamic', 'About us', 'pic-about.jpg', '<header class=\"header header--ckeditor-5 header--new\">\r\n<div class=\"header-content\">\r\n<h1>CKEditor 5 download</h1>\r\n<p>Install, download or serve a ready-to-use rich text editor of your choice.</p>\r\n</div>\r\n</header>\r\n<section class=\"download__section download__section--gray\" data-download-package=\"ckeditor-5\" data-ga-event-scope=\"Download CKEditor 5\">\r\n<div class=\"section-container\">\r\n<div class=\"download-box__container download-box__container--top\">\r\n<div class=\"download-box__container-title\">\r\n<h2 id=\"choose-build\">1. Choose your build</h2>\r\n</div>\r\n<div class=\"download__middle-placeholder\"><select id=\"buildType\" class=\"form-control\" data-options=\"build\" data-subject=\"build\" data-ga-event-label=\"Build type\" data-ga-value=\"#buildType\" data-ga-on=\"change\">\r\n<option value=\"classic\">CKEditor 5 Classic</option>\r\n<option value=\"balloon\">CKEditor 5 Balloon</option>\r\n<option value=\"balloon-block\">CKEditor 5 Balloon Block</option>\r\n<option value=\"inline\">CKEditor 5 Inline</option>\r\n<option value=\"decoupled-document\">CKEditor 5 Document</option>\r\n</select></div>\r\n<div class=\"download__goto-custom-build\">\r\n<p>or&nbsp;<a href=\"https://ckeditor.com/ckeditor-5/online-builder/\">create a custom build</a></p>\r\n</div>\r\n</div>\r\n<div class=\"download-box__container\">\r\n<div class=\"download-box__container-title\">\r\n<h2>2. Download it</h2>\r\n</div>\r\n<div class=\"download-box\">\r\n<div class=\"row download__title\">\r\n<div class=\"col-xs-12\">\r\n<h3>Command line</h3>\r\n<p>CKEditor 5 Builds are installed and managed via npm, the Node.js package manager.Zip package</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"download-box\">\r\n<div class=\"row download__title\">\r\n<div class=\"col-xs-12\">\r\n<h3>CDN</h3>\r\n</div>\r\n</div>\r\n<div class=\"row\">&nbsp;</div>\r\n</div>\r\n</div>\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"download-box__link-list download-box__link-list--center download-box__link-list--last\"><span class=\"download-box__link\"><a href=\"https://ckeditor.com/blog/?category=releases&amp;tags=CKEditor-5\">Release notes</a></span><span class=\"download-box__link\"><a href=\"https://github.com/ckeditor/ckeditor5/blob/master/CHANGELOG.md\" target=\"_blank\" rel=\"noopener noreferrer\">Changelog</a></span><span class=\"download-box__link\"><a href=\"https://ckeditor.com/docs/ckeditor5/latest/builds/guides/quick-start.html\" target=\"_blank\" rel=\"noopener\">Quick Start Guide</a></span><span class=\"download-box__link\"><a href=\"https://ckeditor.com/legal/ckeditor-oss-license/\">License</a></span></div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n<section class=\"module module-cta module-cta--1\">\r\n<div class=\"section-container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<h2>CKEditor 5 is an Open Source application.</h2>\r\n<p>All downloads are fully functional and subject to relevant open source license agreements or commercial license agreements (whichever is applicable).</p>\r\n<div class=\"module-cta__actions\"><a class=\"btn btn-cta btn-cta--long btn--frame\" href=\"https://ckeditor.com/legal/ckeditor-oss-license/\">Read the license conditions</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n<div class=\"startup-enterprise-boxes\">\r\n<div class=\"product-section__inner\">\r\n<div class=\"startup-enterprise-boxes__single\">\r\n<div class=\"startup-enterprise-boxes__single-ico\">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>'),
(6, 3, 'Kwamamaza inkuru nziza 2', 'kwamamaza-inkuru-nziza', 'Dynamic', 'Kwamamaza inkuru nziza', 'pic-ishishikariza.jpg', '<p>Ishishikariza Ni iki ishishikariza ni igihe uba ushishikariza abandi...</p>\r\n<p>The full form of WYSIWYG is What You See Is What You Get, it lets users see what the end result will look like when the document is printed. Basically, WYSIWYG editor is driven by JavaScript that lets users enter the formatted text. The WYSIWYG editor is converting the formatted text to HTML when the web form is submitted to the server.</p>\r\n<p>When you need to accept formatted text content or HTML content from the users on your website, using WYSIWYG editor to textarea is required. There are many jQuery plugins are available for adding WYSIWYG editor to textarea. In this article, we&rsquo;ll provide the information about the best WYSIWYG HTML editor and show how to add HTML editor to textarea on the web page.</p>\r\n<p>TinyMCE is a web-based WYSIWYG editor that enables you to convert HTML textarea fields or other HTML elements to an editor. You can easily embed a rich text editor in the web page using the TinyMCE plugin. In this tutorial, we will show you the simple steps to add TinyMCE editor to your website by writing a minimal JavaScript Code.</p>\r\n<p>Download the latest version of the TinyMCE jQuery plugin from here &ndash;&nbsp;<a href=\"https://www.tiny.cloud/get-tiny/self-hosted/\" target=\"_blank\" rel=\"noopener noreferrer\">Download TinyMCE</a>. Extract it and placed it into the web application directory. Note that, it doesn&rsquo;t need to download separately, you can get all files together in our source code package.</p>\r\n<p>&nbsp;</p>'),
(7, 3, 'Prayers', 'prayers', 'Dynamic', 'Prayers', 'pic-', '<h2><img src=\"C:U/sers/Gadrawin/Pictures/SchoolBack.png\" alt=\"\" />HTML Code</h2>\r\n<p>Define a Textarea input HTML where the WYSIWYG HTML Editor will be added.</p>\r\n<pre><textarea id=\"myTextarea\" name=\"myTextarea\"></textarea></pre>\r\n<h2>JavaScript Code</h2>\r\n<p>Include the TinyMCE JS library.</p>\r\n<pre>&nbsp;</pre>\r\n<p>The following example code will replace the Textarea field with the TinyMCE editor instance using the selector&nbsp;<code>#myTextarea</code>. This code provides some default features of the TinyMCE editor for basic uses.</p>\r\n<pre>tinymce.init({\r\n    selector: <span class=\"hljs-string\">\'#myTextarea\'</span>\r\n});</pre>\r\n<p>Use&nbsp;<code>width</code>&nbsp;and&nbsp;<code>height</code>&nbsp;options to configure the size of the editor.</p>\r\n<pre class=\"hljs\">tinymce.init({\r\n    selector: <span class=\"hljs-string\">\'#myTextarea\'</span>,\r\n    width: <span class=\"hljs-number\">600</span>,\r\n    height: <span class=\"hljs-number\">300</span>\r\n});</pre>'),
(8, 7, 'Terms and Conditions', 'terms', 'Static', 'Terms and Conditions', '', '<p>Terms and Conditions</p>\r\n<p>Now now</p>'),
(9, 8, 'Privacy Policy', 'privacy', 'Static', 'Privacy Policy', '', '<p>Hello ladies and gendlemen</p> <ul> <li style=\"text-align: left;\">What can you say? by now</li> <li style=\"text-align: left;\">Do you believe in God</li> </ul>'),
(10, 9, 'Contact Us', 'contact', 'Static', 'Contact Us', '', ''),
(11, 10, 'History', 'history', 'Static', 'History', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `message_title` varchar(150) NOT NULL,
  `message_content` mediumtext NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `message_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `firstname`, `lastname`, `message_title`, `message_content`, `sender_email`, `message_date`) VALUES
(1, 'Muhoza', 'Daniel', 'Contact', 'Hello muraho murakomeye Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', 'muhoza@gmail.com', '2021-09-08 10:27:42'),
(2, 'Muhire', 'Kevin', 'Contact', 'Hello mwese', 'kevin@gmail.com', '2021-09-09 12:05:43'),
(3, 'Muhire', 'Kevin', 'Contact', 'Hello mwese', 'kevin@gmail.com', '2021-09-09 12:10:01'),
(4, 'Muhire', 'Kevin', 'Contact', 'Hello mwese', 'kevin@gmail.com', '2021-09-09 12:10:09'),
(5, 'Gad', 'Iradufasha', 'Contact', 'Hello nagirango mbasangize agatekerezo ko guhindura ibitagenda neza!', 'gadiradufasha@gmail.com', '2021-09-09 12:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `cmenu_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `menu_name` varchar(150) NOT NULL,
  `menu_url` varchar(150) NOT NULL,
  `content_first` mediumtext NOT NULL,
  `content_middle` mediumtext NOT NULL,
  `content_last` mediumtext NOT NULL,
  `menu_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(10) NOT NULL,
  `message_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `reply_text` text NOT NULL,
  `reply_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `message_id`, `admin_id`, `reply_text`, `reply_date`) VALUES
(1, 1, 2, 'Hello my brother, we have received your message!', '2021-09-08 12:46:31'),
(2, 1, 2, 'We are hoping to solve question carefully', '2021-09-08 12:49:41'),
(3, 5, 2, 'Okay we get Soon You will be happy ', '2021-09-09 12:37:28'),
(4, 1, 2, 'Hi, Muhoza, Hello muraho murakomeye Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. \r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', '2021-10-01 11:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setup_id` int(10) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `active_hours` varchar(100) NOT NULL,
  `main_quote` mediumtext NOT NULL,
  `mission` mediumtext NOT NULL,
  `date_started` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setup_id`, `site_name`, `contact_no`, `contact_email`, `location`, `address`, `active_hours`, `main_quote`, `mission`, `date_started`) VALUES
(1, 'Cathoricapp1', '0785234533', 'churchapp1@gmail.com', 'NGOMA1', 'Street 500 RANGO1', 'Closed', 'We believe in God Thats why we studied at IPRC HUYE  - Mark 03:22', '<p>WAZAAAAAAAAAAAAAAAAAAAAA</p>\r\n<p>WAZAAAAAAAAAAAAAAAAAAAAA1</p>', '2021-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `slide_id` int(10) NOT NULL,
  `slide_title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `slide_image` varchar(250) NOT NULL,
  `slide_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`slide_id`, `slide_title`, `description`, `slide_image`, `slide_date`) VALUES
(1, 'Picure of the day', 'We are watching this', 'slide-1.jpg', '2021-09-09'),
(2, 'Some caption Amazing', 'Some caption one is this and this one of this help me outta Gosh!', 'slide-picture2.jpg', '2021-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `soc_id` int(10) NOT NULL,
  `soc_name` varchar(80) NOT NULL,
  `soc_url` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`soc_id`, `soc_name`, `soc_url`) VALUES
(1, 'facebook', 'https://www.facebook.com/iprchuye'),
(2, 'twitter', 'https://www.twitter.com/iprchuye'),
(3, 'youtube', 'https://www.youtube.com/c/iprchuye'),
(4, 'linkedin', 'https://www.linkedin.com/iprchuye');

-- --------------------------------------------------------

--
-- Table structure for table `viewsbox`
--

CREATE TABLE `viewsbox` (
  `view_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `viewer_ip` varchar(60) NOT NULL,
  `date_viewed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `viewsbox`
--

INSERT INTO `viewsbox` (`view_id`, `post_id`, `viewer_ip`, `date_viewed`) VALUES
(3, 1, '::1', '2021-09-29 14:29:38'),
(4, 8, '192.168.1.1', '2021-09-29 14:31:30'),
(5, 7, '::1', '2021-09-29 14:34:24'),
(6, 3, '::1', '2021-09-29 14:34:34'),
(7, 2, '::1', '2021-09-29 14:34:43'),
(8, 8, '::1', '2021-09-29 15:31:38'),
(9, 11, '::1', '2021-09-29 15:33:28'),
(10, 0, '::1', '2021-09-29 15:38:21'),
(11, 80, '::1', '2021-09-29 16:04:39'),
(12, 10, '::1', '2021-09-29 16:07:34'),
(13, 100, '::1', '2021-09-29 16:09:27'),
(14, 5, '::1', '2021-09-29 20:20:02'),
(15, 12, '::1', '2021-09-30 07:28:15'),
(16, 13, '::1', '2021-09-30 07:30:32'),
(17, 14, '::1', '2021-09-30 08:19:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD PRIMARY KEY (`cmenu_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`cmenu_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setup_id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`soc_id`);

--
-- Indexes for table `viewsbox`
--
ALTER TABLE `viewsbox`
  ADD PRIMARY KEY (`view_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_sub`
--
ALTER TABLE `menu_sub`
  MODIFY `cmenu_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_content`
--
ALTER TABLE `page_content`
  MODIFY `cmenu_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setup_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `slide_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `soc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `viewsbox`
--
ALTER TABLE `viewsbox`
  MODIFY `view_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
