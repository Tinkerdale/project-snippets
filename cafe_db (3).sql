-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2018 at 08:39 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL DEFAULT '1',
  `quantity` double NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(4, 'bevarages', '2018-09-03 00:00:00', '2018-09-02 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `permission`) VALUES
(1, 'Stardand User', ''),
(3, 'Admnistrator ', '{\"admin\" : 1 }'),
(4, 'cashier', '{\"cash\":2}');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='order to be added';

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `user_id`, `created`) VALUES
(152, '', '2018-09-03 17:33:55'),
(149, '', '2018-09-03 12:11:40'),
(150, '', '2018-09-03 13:51:23'),
(151, '', '2018-09-03 15:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(15) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(15) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='products that can be added to cart';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `quantity`, `price`, `created`, `modified`) VALUES
(54, 4, 'burger', 'sweeet', 12, '60.00', '2018-09-03 20:30:43', '2018-09-03 18:30:43'),
(53, 4, 'chapati', 'Yummy', 4, '10.00', '2018-09-03 20:25:27', '2018-09-03 18:25:27'),
(47, 0, 'beans', 'fresh beans', 20, '20.00', '0000-00-00 00:00:00', '2018-08-10 10:40:57'),
(48, 0, 'chapati', 'one is not enough', 0, '10.00', '0000-00-00 00:00:00', '2018-08-10 10:41:42'),
(49, 0, 'cabbage', 'steamed', 0, '20.00', '0000-00-00 00:00:00', '2018-08-10 10:42:13'),
(50, 0, 'mango juice', 'fresh and sweet', 0, '30.00', '0000-00-00 00:00:00', '2018-08-10 10:42:46'),
(51, 0, 'melon juice', 'fresh and sweet', 0, '30.00', '0000-00-00 00:00:00', '2018-08-10 10:43:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='image files related to a product';

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `name`, `created`, `modified`) VALUES
(105, 47, 'beans.jpg', '0000-00-00 00:00:00', '2018-08-10 12:04:58'),
(106, 43, 'samosa.jpg', '0000-00-00 00:00:00', '2018-08-10 12:10:59'),
(107, 42, 'burger.jpg', '0000-00-00 00:00:00', '2018-08-10 12:06:40'),
(108, 41, 'pizza.jpg', '0000-00-00 00:00:00', '2018-08-10 12:10:59'),
(109, 45, 'githeri.jpg', '0000-00-00 00:00:00', '2018-08-10 12:06:40'),
(110, 48, 'chapati.jpg', '0000-00-00 00:00:00', '2018-08-10 12:06:40'),
(111, 51, 'melonjuice.jpg', '0000-00-00 00:00:00', '2018-08-10 12:06:40'),
(112, 44, 'ndazi.jpg', '0000-00-00 00:00:00', '2018-08-10 12:12:40'),
(113, 46, 'ndengu.jpg', '0000-00-00 00:00:00', '2018-08-10 12:13:10'),
(114, 47, 'beans.jpg', '0000-00-00 00:00:00', '2018-08-10 12:13:29'),
(115, 49, 'cabbage.jpg', '0000-00-00 00:00:00', '2018-08-10 12:14:00'),
(116, 50, 'mangojuice.jpg', '0000-00-00 00:00:00', '2018-08-10 12:14:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `image`, `price`, `description`, `category_id`, `category_name`) VALUES
(6, 'biryani', 'images/biryani.jpg', 60.00, 'hot and steamy', 1, 'main dish'),
(7, 'chapati', 'images/chapati.jpg', 10.00, 'one is never enough', 2, 'snack'),
(8, 'samosa', 'images/samosa.jpg', 15.00, 'yummy', 2, 'snack'),
(9, 'pilau', 'images/pilau.jpg', 50.00, 'i bet you will come for more', 1, 'main dish'),
(10, 'rice', 'images/rice.jpg', 40.00, 'delicious', 1, 'main dish'),
(11, 'ugali', 'images/ugali.jpg', 20.00, 'hot and steamy', 1, 'main dish');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `regNo` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(65) NOT NULL,
  `rights` varchar(15) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `regNo`, `email`, `password`, `rights`, `created`) VALUES
(2, 'elvis', 'SP13/00820/15', 'elvismutende@gmail.com', '$2y$10$uI6tqHSKmw9cxUxNCXYFU.6ZUtYXNNXMqZxNxyxfM8N16PCZC8Vd2', 'user', '2018-08-13'),
(3, 'carol', '', 'carol@123', '87186c95c9366392597b7a4ce9b8c88e', 'cashier', '2018-09-03'),
(4, '', '', 'carol@gmail.com', 'a9a0198010a6073db96434f6cc5f22a8', 'cashier', '2018-09-03'),
(6, 'agaustine', '', '123@123', '$2y$10$wZsZNNN516GdP744kyV9veCqOG3BXBd/okoocu6DgG5xYWkBMIVAW', '', '2018-09-03'),
(7, 'mimi', '', 'nini@135', '$2y$10$i4vnsd5JOkb4fY9HbzXzZ.gkiTQE7WE69DaiDi/2tNd7lVoRXoo6a', '', '2018-09-03'),
(8, 'ian', '', 'ian@gmail.com', '$2y$10$DWuKVmFhK6q3tb76/qAvbel1fjurhcUYdvY2A4sohmpMjjXw/oRCu', 'user', '2018-09-03'),
(9, 'me', '', 'me@gmail.com', '787222bc43251c9d734eb4365b595ba6', 'cashier', '2018-09-03'),
(10, 'meme', '', 'meme@gmail.com', '$2y$10$h3d1mHe0uzDVYLgbQVehYeJQ6kpwIK8NWYzdyXfxyyjrs9j14IOpS', 'admin', '2018-09-03'),
(12, 'den', '', 'de@gmail.com', '$2y$10$ERuNnf0xBphu0r1MTDWUYOawIS9Zzg4MXxrpgNLmc6xZRLL4M5rNu', 'cashier', '2018-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
