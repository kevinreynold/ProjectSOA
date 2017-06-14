-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2017 at 08:56 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soa`
--
CREATE DATABASE IF NOT EXISTS `soa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `soa`;

-- --------------------------------------------------------

--
-- Table structure for table `d_like_video`
--

DROP TABLE IF EXISTS `d_like_video`;
CREATE TABLE IF NOT EXISTS `d_like_video` (
  `id_video` int(11) NOT NULL,
  `id_user` varchar(32) NOT NULL,
  `date_like` date NOT NULL,
  `time_like` time NOT NULL,
  `like_or_dislike` varchar(1) NOT NULL,
  PRIMARY KEY (`id_video`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_subscribe`
--

DROP TABLE IF EXISTS `d_subscribe`;
CREATE TABLE IF NOT EXISTS `d_subscribe` (
  `id_user_subscriber` varchar(32) NOT NULL,
  `id_user2_subscribed` varchar(32) NOT NULL,
  PRIMARY KEY (`id_user_subscriber`,`id_user2_subscribed`),
  KEY `FK_USER_SUBSCRIBED` (`id_user2_subscribed`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_subscribe`
--

INSERT INTO `d_subscribe` (`id_user_subscriber`, `id_user2_subscribed`) VALUES
('ccc', 'aaaa'),
('rio123', 'aaaa'),
('rio1235', 'aaaa'),
('vvv', 'aaaa');

-- --------------------------------------------------------

--
-- Table structure for table `h_comment`
--

DROP TABLE IF EXISTS `h_comment`;
CREATE TABLE IF NOT EXISTS `h_comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `message` text NOT NULL,
  `status_read` varchar(1) NOT NULL,
  `id_video` int(11) NOT NULL,
  `id_user` varchar(32) NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_video` (`id_video`),
  KEY `FK_USER_COMMENT` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_comment`
--

INSERT INTO `h_comment` (`id_comment`, `date`, `time`, `message`, `status_read`, `id_video`, `id_user`) VALUES
(1, '2017-05-28', '12:07:09', 'haha elerk', 'T', 18, 'riorio1'),
(4, '2017-05-28', '12:10:55', 'haha elerk', 'T', 18, 'riorio1'),
(5, '2017-05-28', '12:13:19', 'haha elerk', 'T', 18, 'riorio1'),
(13, '2017-05-28', '12:19:38', 'haha elerk', 'a', 18, 'riorio1'),
(14, '2017-05-28', '00:00:00', 'haha elerk', 'F', 18, 'riorio1'),
(15, '2017-05-28', '12:21:46', 'haha elerk', 'F', 18, 'riorio1'),
(16, '2017-05-28', '12:23:51', 'haha elerk', 'F', 18, 'riorio1'),
(17, '2017-05-28', '12:24:10', 'haha elerk', 'F', 18, 'riorio1'),
(19, '2017-05-28', '12:27:12', 'haha elerk', 'T', 18, 'riorio1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `password` varchar(255) NOT NULL,
  `id_user` varchar(32) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `date_created` date NOT NULL,
  `profile_foto_url` varchar(75) NOT NULL,
  `status` varchar(1) NOT NULL,
  `description_channel` varchar(144) NOT NULL,
  `subscriber_count` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`password`, `id_user`, `nama_user`, `email`, `tanggal_lahir`, `date_created`, `profile_foto_url`, `status`, `description_channel`, `subscriber_count`, `api_key`) VALUES
('', 'aaaa', 'edo', '', '0000-00-00', '0000-00-00', '', 'F', '', 7, '74b87337454200d4d33f80c4663dc5e5'),
('', 'ccc', 'ian', '', '0000-00-00', '0000-00-00', '', 'F', '', 0, ''),
('30fe3c9d643e5161f421fd02e5fa5236', 'rio123', 'rio adianto priadi', 'rioadiantopriadi@yahoo.com', '1995-03-14', '2017-05-26', '', 'T', '', 0, 'f237aef579ff90dcd9b528115cb25c32'),
('30fe3c9d643e5161f421fd02e5fa5236', 'rio1235', 'rio adianto priadi', 'rioadiantopriadi@yahoo.com', '1995-03-14', '2017-05-26', '', 'T', '', 0, ''),
('30fe3c9d643e5161f421fd02e5fa5236', 'rio12356', 'rio adianto priadi', 'rioadiantopriadi@yahoo.com', '1995-03-14', '2017-05-26', '', 'T', '', 0, ''),
('', 'riorio1', 'rio adianto', 'rioadiantopriadi@yahoo.com', '1995-03-14', '2017-04-02', '', 'T', '-', 0, '263ea34261f653a36749f35ddaac9696'),
('', 'vvv', '', '', '0000-00-00', '0000-00-00', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id_video` int(11) NOT NULL AUTO_INCREMENT,
  `judul_video` varchar(50) NOT NULL,
  `description` varchar(144) NOT NULL,
  `date_publish` date NOT NULL,
  `time_publish` time NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL,
  `viewers_count` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL,
  `video_path` varchar(75) NOT NULL,
  `id_user` varchar(32) NOT NULL,
  PRIMARY KEY (`id_video`),
  KEY `FK_USER_VIDEO` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `judul_video`, `description`, `date_publish`, `time_publish`, `like_count`, `dislike_count`, `viewers_count`, `comment_count`, `video_path`, `id_user`) VALUES
(1, 'rio', 'mencari', '2012-12-31', '12:03:39', 0, 0, 0, 0, '', 'riorio1'),
(2, 'rio', 'mencari', '2017-05-22', '12:04:15', 0, 0, 0, 0, '', 'riorio1'),
(3, 'rio', 'mencari', '2017-05-22', '12:09:15', 0, 0, 0, 0, '', 'riorio1'),
(8, 'aaaa', 'aaaa', '0000-00-00', '00:00:00', 0, 0, 0, 0, 'aa', 'riorio1'),
(9, 'aaaa', 'aaaa', '0000-00-00', '00:00:00', 0, 0, 0, 0, 'aa', 'riorio1'),
(10, 'aaaa', 'aaaa', '2017-05-27', '08:15:46', 0, 0, 0, 0, 'aa', 'riorio1'),
(12, 'aaaa', 'aaaa', '2017-05-27', '08:17:29', 0, 0, 0, 0, 'aa', 'riorio1'),
(14, 'aaaa', 'aaaa', '2017-05-27', '08:28:13', 0, 0, 0, 0, 'aa', 'riorio1'),
(15, 'aaaa', 'aaaa', '2017-05-28', '07:50:52', 0, 0, 0, 0, 'aa', 'riorio1'),
(16, 'aaaa', 'aaaa', '2017-05-28', '07:51:31', 0, 0, 0, 0, 'aa', 'riorio1'),
(17, 'aaaa', 'aaaa', '2017-05-28', '07:53:49', 0, 0, 0, 0, 'aa', 'riorio1'),
(18, 'aku anak gembala', 'hahaha begitulah kisahku', '2017-05-28', '08:09:28', 0, 0, 0, 0, 'jcobasda saja.xls', 'riorio1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_like_video`
--
ALTER TABLE `d_like_video`
  ADD CONSTRAINT `d_like_video_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `video` (`id_video`),
  ADD CONSTRAINT `d_like_video_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `d_subscribe`
--
ALTER TABLE `d_subscribe`
  ADD CONSTRAINT `FK_USER_SUBSCRIBED` FOREIGN KEY (`id_user2_subscribed`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FK_USER_SUBSCRIBER` FOREIGN KEY (`id_user_subscriber`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `h_comment`
--
ALTER TABLE `h_comment`
  ADD CONSTRAINT `FK_USER_COMMENT` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `h_comment_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `video` (`id_video`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_USER_VIDEO` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
