SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS hutech_php;

USE hutech_php;

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` varchar(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quanity` int(11) NOT NULL,
  `isActive` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `cart` (`id`, `userid`, `itemid`, `quanity`, `isActive`) VALUES
(11, 'bevy', 3, 6, 0),
(10, 'bevy', 2, 3, 0),
(9, 'bevy', 1, 3, 0),
(8, 'admin', 1, 3, 0),
(12, 'gune', 2, 9, 0),
(13, 'admin', 6, 3, 0),
(14, 'admin', 7, 2, 1),
(15, 'admin', 5, 1, 1),
(16, 'admin', 6, 5, 1),
(17, 'bevy', 5, 10, 1),
(18, 'admin', 7, 5, 1),
(19, 'admin', 5, 4, 0),
(20, 'admin', 8, 7, 1),
(21, 'admin', 1, 3, 1),
(22, 'admin', 5, 1, 0),
(23, 'admin', 7, 2, 1),
(24, 'admin', 1, 2, 0),
(25, 'admin', 5, 2, 0),
(26, 'admin', 5, 3, 0),
(27, 'admin', 8, 9, 0);

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `unit_price` double NOT NULL,
  `image_url` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `items` (`id`, `name`, `unit_price`, `image_url`) VALUES
(1, 'Honda Ridgeline', 'Sports car with sleek lines, white racing stripes, and a powerful engine.', 6000000, 'https://article.images.consumerreports.org/prod/content/dam/CRO%20Images%202017/Magazine-Articles/April/CR-Inline-top-picks-Ridgeline-02-17'),
(5, 'Tesla V800', 'SUV with tinted windows, leather seats, and top-of-the-line safety features.', 2080000, 'https://article.images.consumerreports.org/prod/content/dam/CRO%20Images%202017/Magazine-Articles/April/CR-Inline-top-picks-Toyota-Yaris-02-17'),
(6, 'Ford F-150', 'Convertible with a retractable roof, chrome accents, and a high-tech stereo system.', 7000000, 'https://article.images.consumerreports.org/prod/content/dam/CRO%20Images%202018/Magazine/04April/CRM-Cars-Inline-TopTen-Ford-F150-2018-4-18'),
(7, 'Toyota Highlander', 'Sedan with a fuel-efficient hybrid engine, touchscreen navigation, and panoramic sunroof.', 9000000, 'https://article.images.consumerreports.org/prod/content/dam/CRO%20Images%202018/Magazine/04April/CRM-Cars-Inline-TopTen-Toyota-Highlander-2018-4-18'),
(8, 'Chevrolet Impala', 'Muscle car with racing-inspired decals, manual transmission, and a throaty exhaust note.', 75620000, 'https://article.images.consumerreports.org/prod/content/dam/CRO%20Images%202018/Magazine/04April/CRM-Cars-inline-TopTen-Chevrolet-Imapla-2018-4-18');

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `login` (`id`, `username`, `password`, `address`, `telephone`, `email`) VALUES
(1, 'srer', 'dfsfg', 'fdgf', 'dg`', 'gsg'),
(2, 'admin', '123', 'fdhgd', 'dgfj', 'gdfjh'),
(4, 'sumana', 'kk123', 'hsdl', '078986532', 'kaS@gmail.com'),
(5, '10', '', '', '', ''),
(6, 'bevy', '789', 'sdfda', '5656', 'bevylabs@gmail.com'),
(7, 'solo', '789', 'Sumana paya', '', 'solo@gmail.com'),
(8, 'gune', 'gune', 'hjkafkj', '89652', 'gune@gmail.com');

ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;