-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 11:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(9, '170.00', 'paid', 1, 2147483647, 'Bandung', 'Jl. PHH Mustafa No.23', '2022-10-21 01:41:46'),
(11, '60.00', 'not paid', 2, 823231131, 'Bandung', 'Arcamanik Residence', '2022-10-22 05:08:24'),
(13, '310.00', 'paid', 1, 2147483647, 'Bandung', 'Arcamanik Residence', '2022-10-22 06:54:20'),
(18, '300.00', 'paid', 1, 2147483647, 'Bandung', 'Arcamanik Residence', '2022-10-22 09:25:02'),
(19, '20.00', 'paid', 4, 2147483647, 'Bandung', 'Cisaranten Kulon', '2022-10-22 09:57:02'),
(20, '355.00', 'paid', 4, 2147483647, 'Bandung', 'Cisaranten Kulon', '2022-10-22 10:05:59'),
(21, '325.00', 'paid', 4, 2147483647, 'Bandung', 'Cisaranten Kulon', '2022-10-22 10:11:20'),
(22, '425.00', 'not paid', 4, 2147483647, 'Bandung', 'Cisaranten Kulon', '2022-10-22 10:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(8, 9, '6', 'Black T-Shirt', 'product-5.jpg', '15.00', 1, 1, '2022-10-21 01:41:46'),
(9, 9, '1', 'Blue Shoes', 'product-1.jpg', '155.00', 1, 1, '2022-10-21 01:41:46'),
(10, 11, '4', 'Cotton Jacket', 'product-4.jpg', '60.00', 1, 2, '2022-10-22 05:08:24'),
(11, 13, '1', 'Blue Shoes', 'product-1.jpg', '155.00', 2, 1, '2022-10-22 06:54:20'),
(15, 18, '5', 'Leather Bag', 'product-7.jpg', '300.00', 1, 1, '2022-10-22 09:25:02'),
(16, 19, '7', 'Basic Flowing Scarf', 'product-6.jpg', '20.00', 1, 4, '2022-10-22 09:57:02'),
(17, 20, '12', 'Army Jacket', 'product-12.jpg', '355.00', 1, 4, '2022-10-22 10:05:59'),
(18, 21, '14', 'Glamour Glasses', 'product-14.jpg', '325.00', 1, 4, '2022-10-22 10:11:20'),
(19, 22, '13', 'Leather Bag', 'product-13.jpg', '425.00', 1, 4, '2022-10-22 10:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `payment_date`) VALUES
(2, 9, 1, '4TK58035T44618232', '2022-10-23 02:09:27'),
(3, 18, 1, '0AA36803BY094483Y', '2022-10-23 02:35:30'),
(4, 19, 4, '64631854S4588353K', '2022-10-23 03:01:00'),
(5, 20, 4, '4RR784615H3908933', '2022-10-23 03:06:56'),
(6, 21, 4, '59418229FD818121W', '2022-10-22 22:11:47'),
(7, 13, 1, '7EE91499JC4506914', '2022-10-22 22:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_brand` varchar(100) DEFAULT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_criteria` varchar(100) DEFAULT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_brand`, `product_category`, `product_description`, `product_criteria`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Blue Shoes', 'Dior', 'Shoes', 'Awesome Blue Shoes', 'featured', 'product-1.jpg', 'product-1.jpg', 'product-1.jpg', 'product-1.jpg', '155.00', 0, 'Blue'),
(2, 'Black Shoes', 'Dior', 'Shoes', 'Awesome Black Shoes', 'none', 'product-3.jpg', 'product-3.jpg', 'product-3.jpg', 'product-3.jpg', '165.00', 0, 'Black'),
(3, 'Pique Biker Jacket', 'Louis Vuitton', 'Jacket', 'Awesome Jacket', 'featured', 'product-2.jpg', 'product-2.jpg', 'product-2.jpg', 'product-2.jpg', '67.00', 0, 'Brown'),
(4, 'Cotton Jacket', 'Louis Vuitton', 'Jacket', 'Awesome Cotton Jacket', 'featured', 'product-4.jpg', 'product-4.jpg', 'product-4.jpg', 'product-4.jpg', '60.90', 0, 'Dark Brown'),
(5, 'Leather Bag', 'Louis Vuitton', 'Bag', 'Awesome Leather Bag', 'featured', 'product-7.jpg', 'product-7.jpg', 'product-7.jpg', 'product-7.jpg', '300.00', 0, 'Brown'),
(6, 'Black T-Shirt', 'Chanel', 'T-Shirt', 'Awesome Black T-Shirt', 'none', 'product-5.jpg', 'product-5.jpg', 'product-5.jpg', 'product-5.jpg', '15.00', 0, 'Black'),
(7, 'Basic Flowing Scarf', 'Louis Vuitton', 'Scarf', 'An awesome Scarf', 'none', 'product-6.jpg', 'product-6.jpg', 'product-6.jpg', 'product-6.jpg', '20.00', 0, 'Brown'),
(8, 'Polo Shirt', 'Chanel', 'T-Shirt', 'Awesome Polo Shirt', 'none', 'product-8.jpg', 'product-8.jpg', 'product-8.jpg', 'product-8.jpg', '35.50', 0, 'Black'),
(9, 'Abstract Design T-Shirt', 'Chanel', 'T-Shirt', 'Awesome Abstract Design T-Shirt', 'none', 'product-9.jpg', 'product-9.jpg', 'product-9.jpg', 'product-9.jpg', '16.50', 0, 'Black'),
(10, 'Zara Fragrant Perfume', 'Hermes', 'Perfume', 'Awesome Zara Perfume', 'none', 'product-10.jpg', 'product-10.jpg', 'product-10.jpg', 'product-10.jpg', '100.00', 0, 'Yellow, Blue'),
(11, 'White Crystal Bag', 'Gucci', 'Bag', 'Awesome White Crystal Bag', 'none', 'product-11.jpg', 'product-11.jpg', 'product-11.jpg', 'product-11.jpg', '210.00', 0, 'White'),
(12, 'Army Jacket', 'Gucci', 'Jacket', 'Awsome Army Jacket', 'none', 'product-12.jpg', 'product-12.jpg', 'product-12.jpg', 'product-12.jpg', '355.50', 0, 'Green'),
(13, 'Leather Bag', 'Hermes', 'Bag', 'Awesome Leather Bag', 'none', 'product-13.jpg', 'product-13.jpg', 'product-13.jpg', 'product-13.jpg', '425.00', 0, 'Brown'),
(14, 'Glamour Glasses', 'Hermes', 'Glasses', 'Awesome Glamour Glasses', 'none', 'product-14.jpg', 'product-14.jpg', 'product-14.jpg', 'product-14.jpg', '325.50', 0, 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'User 1', 'user1@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759'),
(2, 'User 2', 'user2@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759'),
(4, 'User 3', 'user3@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
