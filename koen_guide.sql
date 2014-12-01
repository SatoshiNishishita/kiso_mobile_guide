-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: 2014 年 10 月 21 日 10:20
-- サーバのバージョン： 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koen_guide`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `movie`
--

CREATE TABLE `movie` (
  `spot_id` int(11) NOT NULL,
  `movie_url` text NOT NULL,
  `created` date NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `movie`
--

INSERT INTO `movie` (`spot_id`, `movie_url`, `created`, `modified`) VALUES
(1, 'spot_movie1_1', '2014-10-02', '2014-10-02 09:43:41'),
(1, 'spot_movie1_2', '2014-10-02', '2014-10-02 09:44:13'),
(1, 'spot_movie1_3', '2014-10-02', '2014-10-02 09:44:31'),
(1, 'spot_movie1_4', '2014-10-02', '2014-10-02 09:44:49'),
(2, 'spot_movie2_1', '2014-10-02', '2014-10-02 09:45:10'),
(2, 'spot_movie2_2', '2014-10-02', '2014-10-02 09:45:26'),
(2, 'spot_movie2_3', '2014-10-02', '2014-10-02 09:45:42'),
(3, 'spot_movie3_1', '2014-10-02', '2014-10-02 09:45:57'),
(4, 'spot_movie4_1', '2014-10-02', '2014-10-02 09:46:32');

-- --------------------------------------------------------

--
-- テーブルの構造 `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spot_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `post_comment` varchar(200) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- テーブルのデータのダンプ `post`
--

INSERT INTO `post` (`id`, `spot_id`, `user_name`, `post_comment`, `photo_id`, `created`, `modified`) VALUES
(2, 1, '小学生', 'aaaaaa', 0, '0000-00-00', '2014-10-07 11:48:43'),
(5, 2, '小学校の先生', 'aaa', 0, '0000-00-00', '2014-10-07 12:53:22'),
(6, 1, '小学生', 'おもしろかったです♡', 0, '0000-00-00', '2014-10-11 04:55:28'),
(19, 4, '小学校の先生', '車の通りが激しいので注意が必要です。', 0, '0000-00-00', '2014-10-15 04:34:01'),
(20, 2, '小学生', '川がまっすぐでした', 0, '0000-00-00', '2014-10-15 04:42:29'),
(21, 2, '小学生', '川が綺麗です', 0, '0000-00-00', '2014-10-17 05:55:53'),
(22, 2, '小学生', '景色が綺麗です', 0, '0000-00-00', '2014-10-20 14:13:33');

-- --------------------------------------------------------

--
-- テーブルの構造 `spot`
--

CREATE TABLE `spot` (
  `spot_id` int(11) NOT NULL,
  `spot_name` char(80) NOT NULL,
  `spot_text` varchar(300) NOT NULL,
  `spot_latitude` float NOT NULL,
  `spot_longitude` float NOT NULL,
  `created` date NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`spot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `spot`
--

INSERT INTO `spot` (`spot_id`, `spot_name`, `spot_text`, `spot_latitude`, `spot_longitude`, `created`, `modified`) VALUES
(1, '農家と水屋', '低地に暮らす人々は、水害に苦しんできました。これは輪中の農家を復元した建物ですが、いくつか水と闘う人々の知恵や工夫が見られます。\r\n(1)石垣を積み上げ、高くした母屋\r\n(2)軒先にある避難用の「上げ船」\r\n(3)母屋の上げ仏壇\r\n(4)さらに高く立てた水屋', 35.1474, 136.666, '0000-00-00', '2014-10-15 06:32:55'),
(2, '治水タワー', '約60メートルの展望台からは木曽三川の豊かな流れと高須輪中の農地が良く見えます。西から揖斐川、真ん中が長良川、さらに東が木曽川です。中央の整備された農地が広がるのが高須輪中ですが、古くからまわりを堤防で囲い、家や土地を水害から守って暮らしてきました。\r\n現在高須輪中は、米作りや野菜作りなどが盛んですが、豊な水が農業を支えています。\r\nこの土地を水害から守るため、江戸時代の薩摩藩の工事、明治時代のデ・レーケによる改修工事などが行われました。その様子は治水神社で知る事ができます。', 35.1462, 136.668, '0000-00-00', '2014-10-15 06:33:48'),
(3, '治水神社', '江戸時代の中ごろに行われた薩摩藩の治水工事、そのあらましを紹介しているのが、このパネルです。今のような機会のない時代でしたから、多くの人達が人の力だけで働き、工事を完成させました。\r\n工事責任者だった平田靭負をはじめ、多くの人が亡くなりました。その人々への感謝をこめて、この神社が建てられました。今も春と秋に盛大なお祭りが行われています。', 35.1443, 136.668, '0000-00-00', '2014-10-15 06:34:51'),
(4, '締切堤', '薩摩藩士たちが工事完了後に訴えたといわれているのがこの松林です。千本松原と呼び、揖斐川と長良側を分ける堤の上に植えられました。松並木は今も神社から約1キロメートル先、岐阜県と三重県の県境付近まで続いています。さらに明治改修で、その先まで堤が完成し、揖斐川と長良川の分流が完成しました。', 35.1431, 136.668, '0000-00-00', '2014-10-15 06:35:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
