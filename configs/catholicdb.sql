-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 05:58 PM
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
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(10) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `verse_text` text NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `about_us` mediumtext NOT NULL,
  `mission` mediumtext NOT NULL,
  `date_started` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `site_name`, `verse_text`, `contact_no`, `contact_email`, `location`, `address`, `about_us`, `mission`, `date_started`) VALUES
(1, 'ChurchApp', '', '1234567890', 'churchapp@gmail.com', 'HUYE, Ngoma', 'K400-Ngoma Center', 'About: Lorem ipsum dolor sit amet, consectetur adiipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Mission is this About: Lorem ipsum dolor sit amet, consectetur adiipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2021-09-01');

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
(2, 'Good morning we have much to sell How do you feel?', '20200423_104333.jpg', 2, 'Trending', 'Amakuru yemwe duherukana ubushuze tuganira ku nkuru yaaaa', '2021-09-08 06:17:51'),
(8, 'Good morning This post is sure?', 'nuns.jpg', 2, 'Trending', 'Centralized repository for your application data. Utilizing BLOB allows you to have a central database for all your application \r\ndata and this means less pain when dealing with portability and backup issues. This also leads to data integrity', '2021-09-08 06:24:22'),
(9, 'Classrooms are now closed after pandemic of june', 'classroom.jpg', 2, 'News', 'Class room are closed since january december ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non                 proident, sunt in culpa qui officia deserunt ', '2021-09-08 06:28:28'),
(10, 'New catholic church is going down', 'temple.jpg', 2, 'Trending', 'Cathedral is built with contribution ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,                 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo                 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse                 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non                 proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2021-09-08 06:38:03'),
(11, 'LAst months new nuns received in cathedral ', 'graduation.jpg', 2, 'Trending', 'In this article, we have shown you how to use a BLOB data type to store images in your MySQL database hosted on Alibaba Cloud ECS or ApsaraDB. Although the PHP scripts we have used in this guide are for demonstration purposes, you can extend them further to accommodate binary data in your application. If you are new to Alibaba Cloud, you can sign up to get free credit of up to $1200 and test MySQL databases and over 40 products on their platform', '2021-09-08 06:40:53'),
(12, 'Papa Francis yasuye u Rwanda kuri uyu wa gatanu umva ibyo yavuze', 'abanyeshuri.png', 2, 'Trending', 'Ubwo twamenyaga ibyino nkuru twabajije icyatumye mu byukuri papa asuura urwanda batubwira ko yaje gusabira umugisha kiriziya nshya yubatswe i Huye Ubwo twamenyaga ibyino nkuru twabajije icyatumye mu byukuri papa asuura urwanda batubwira ko yaje gusabira umugisha kiriziya nshya yubatswe i Huye', '2021-09-09 16:10:20');

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
(3, 5, 2, 'Okay we get Soon You will be happy ', '2021-09-09 12:37:28');

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
(2, 'Some caption', 'Some caption one is this and this one of this help me outta!', 'slide-2.jpg', '2021-08-10');

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
(1, 'facebook', 'https //www.facebook.com/gadrawingz'),
(2, 'twitter', 'https //www.twitter.com/gadrawingz'),
(3, 'youtube', 'https //www.youtube.com/c/gadrawingz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `admin_id` (`admin_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `slide_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `soc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
