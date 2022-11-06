-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 09:15 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_phone` varchar(15) DEFAULT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_photo` varchar(255) NOT NULL,
  `admin_photo2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_phone`, `admin_password`, `admin_photo`, `admin_photo2`) VALUES
(1, 'M. Maulana', 'admin@gmail.com', '62897765432', '0287040c474dbf44cdeb17eebb99d828', 'admin_profile.jpg', 'admin_profile2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(100) DEFAULT NULL,
  `blog_description` text DEFAULT NULL,
  `blog_quotes` text DEFAULT NULL,
  `blog_quotes_writer` varchar(100) DEFAULT NULL,
  `blog_image` varchar(100) DEFAULT NULL,
  `blog_image2` varchar(100) DEFAULT NULL,
  `blog_tags` varchar(255) DEFAULT NULL,
  `blog_date` date DEFAULT current_timestamp(),
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `blog_description`, `blog_quotes`, `blog_quotes_writer`, `blog_image`, `blog_image2`, `blog_tags`, `blog_date`, `admin_id`) VALUES
(1, 'GB-200 Technoplast', 'Spesifikasi Technoplast GB-200:\nTerbuat dari bahan plastik berkualitas( Food Grade), serta bebas dari bahan-bahan berbahaya(BPA free)\n\nTersedia dalam warna hitam, biru, merah\n\nTumbler ini sangat cocok untuk kalian yang ingin memberikan souvenir perusahaan, hadiah wisuda, ulang tahun atau bahkan sebagai koleksi pribadi.\n\nKalian bisa menggunakan desain buatan kalian sendiri untuk botol minum kalian nih. Caranya dengan\n1. order via chat Whatsapp\n2. Kirim desain kalian via email mfbinary18@gmail.com.\n3. Desain yang kalian kirim hanya dalam bentuk .eps ya\n', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-1.png', 'banner1.png', '#Poster #Tumbler #2022\n', '2022-11-04', 1),
(2, 'GB-400 Technoplast', 'Spesifikasi Technoplast GS-400:\nTerbuat dari bahan plastik berkualitas( Food Grade), serta bebas dari bahan-bahan berbahaya(BPA free)\n\nTersedia dalam warna Hitam\n\nTumbler ini sangat cocok untuk kalian yang ingin memberikan souvenir perusahaan, hadiah wisuda, ulang tahun atau bahkan sebagai koleksi pribadi.\n\nKalian bisa menggunakan desain buatan kalian sendiri untuk botol minum kalian nih. Caranya dengan\n1. order via chat Whatsapp\n2. Kirim desain kalian via email mfbinary18@gmail.com.\n3. Desain yang kalian kirim hanya dalam bentuk .eps ya\n', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-2.png', 'banner1.png', '#Poster #Tumbler #Edukasi #2022\n', '2022-11-05', 1),
(3, 'Tumbler Custom GS-400', 'Miliki sekarang Tumbler Custom GS-400 2 side.\nDimensi:\nVolume 370 ml\nTinggi 17.1 cm\nLebar 7.5 cm', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-3.png', 'banner1.png', '#Tumbler', '2022-11-05', 1),
(4, 'Tumbler Spesial Graduation', 'Tu kan Lucu banget, ayo meriahkan hari spesial sahabat mu dengan order sekarang juga tumbler cantik ini di @mfbinary ya', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-4.png', 'banner1.png', '#Tumbler', '2022-11-05', 1),
(5, 'DSWYT SWYD', '<p>Hydroderm is the highly desired anti-aging cream on the block. This serum restricts the\n                                occurrence of early aging sings on the skin and keeps the skin younger, tighter and\n                                healthier. It reduces the wrinkles and loosening of skin. This cream nourishes the skin\n                                and brings back the glow that had lost in the run of hectic years.</p>\n                            <p>The most essential ingredient that makes hydroderm so effective is Vyo-Serum, which is a\n                                product of natural selected proteins. This concentrate works actively in bringing about\n                                the natural youthful glow of the skin. It tightens the skin along with its moisturizing\n                                effect on the skin. The other important ingredient, making hydroderm so effective is\n                                “marine collagen” which along with Vyo-Serum helps revitalize the skin.</p>', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-5.png', 'banner1.png', '#Poster #Tumbler #Edukasi #2022\n', '2022-11-05', 1),
(6, 'Tumbler Quote Motivasi', 'Kamu bisa beli satuan ya. No min. Order.\r\nJadikan hari spesial keluargamu semakin berkesan, dengan hadiah spesial dari kamu nih.', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-6.png', 'banner1.png', '#Tumbler #Quotes', '2022-11-05', 1),
(7, 'Pulpen Desain Unik dan Lucu', 'Ada juga ni pulpen dengan desain unik dan lucu, bisa custom sesuai keinginan kamu, dan cocok banget ni buat hadiah perpisahan sekolah.', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-7.png', 'banner1.png', '#Pulpen', '2022-11-05', 1),
(8, 'Kalender dan Poster Edukasi', 'Kalender dan Poster Edukasi bisa kamu dapatkan dengan harga terjangkan, untuk desainnya bisa kamu tentukan sendiri loh.., ayo! tunggu apa lagi untuk berkunjung ke toko kami @mfbinary', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-8.png', 'banner1.png', '#Poster #Tumbler #Edukasi #2022\n', '2022-11-05', 1),
(9, 'Poster Edukasi Lagi Diskon', 'Khusus poster edukasi lagi diskon gede-gedean ini sampe 50%, kamu jangan sampai ketinggalan, promonya hanya bulan ini saja, ayo tunggu apa lagi :D.', '“When designing an advertisement for a particular product many things should be researched like where it should be displayed.”', 'JOHN SMITH', 'blog1-9.png', 'banner1.png', '#Poster', '2022-11-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(10,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, '1.60', 'paid', 1, '628763655111', 'Bandung', 'Arcamanik Residence Regency', '2022-11-04 06:24:17'),
(2, '2.41', 'paid', 1, '628763655111', 'Bandung', 'Arcamanik Residence Regency', '2022-11-06 05:37:59');

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
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, '5', 'Peta Indonesia', 'product-5.jpg', '0.80', 2, 1, '2022-11-04 06:24:17'),
(2, 2, '3', 'Mockup Calender Colorful', 'product-3.jpg', '0.80', 1, 1, '2022-11-06 05:37:59'),
(3, 2, '6', 'Peta Asean', 'product-6.jpg', '0.80', 1, 1, '2022-11-06 05:37:59'),
(4, 2, '170', 'Mockup Periodic Black', 'Mockup_Periodic_Black1.jpg', '0.81', 1, 1, '2022-11-06 05:37:59');

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
(1, 1, 1, '0X2436441V1111519', '2022-11-04 18:24:38'),
(2, 2, 1, '8NJ838983M4269316', '2022-11-06 05:38:31');

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
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_special_offer` decimal(10,2) DEFAULT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_brand`, `product_category`, `product_description`, `product_criteria`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Mengenal Alfabet', 'Art Paper', 'Alfabet', 'Mengenal alfabet seri menghapal nama hewan, checkout sekarang!', 'none', 'product-1.jpg', 'product-1.jpg', 'product-1.jpg', 'product-1.jpg', '0.80', '0.00', 'Putih'),
(2, 'Flower Alfabet', 'Art Paper', 'Alfabet', 'Belajar alfabet dengan desain bermotif bunga, checkout sekarang!', 'none', 'product-2.jpg', 'product-2.jpg', 'product-2.jpg', 'product-2.jpg', '0.80', '0.00', 'Putih'),
(3, 'Mockup Calender Colorful', 'Laminasi Glossy', 'Kalender', 'Calender berwarna dengan desain kekinian, checkout sekarang!', 'none', 'product-3.jpg', 'product-3.jpg', 'product-3.jpg', 'product-3.jpg', '0.80', '0.00', 'Black'),
(4, 'Mockup Calender Cute Cat', 'Laminasi Glossy', 'Kalender', 'Calender dengan desain kucing lucu, checkout sekarang!', 'featured', 'product-4.jpg', 'product-4.jpg', 'product-4.jpg', 'product-4.jpg', '0.83', '0.00', 'Dark Brown'),
(5, 'Peta Indonesia', 'NCR', 'Peta', 'Peta Indonesia lengkap 33 Provinsi, check out now!', 'none', 'product-5.jpg', 'product-5.jpg', 'product-5.jpg', 'product-5.jpg', '0.80', '0.00', 'Black'),
(6, 'Peta Asean', 'NCR', 'Peta', 'Peta Asean, mengenal negara tetangga Indonesi, checkout sekarang', 'none', 'product-6.jpg', 'product-6.jpg', 'product-6.jpg', 'product-6.jpg', '0.80', '0.00', 'Gray'),
(7, 'Mengenal Angka 1 - 50', 'Concorde', 'Angka', 'Mengenal angka dengan asyik dan menyenangka, cehckout sekarang!', 'none', 'product-7.jpg', 'product-7.jpg', 'product-7.jpg', 'product-7.jpg', '0.80', '0.00', 'Brown'),
(8, 'Belajar Pertambahan', 'Concorde', 'Angka', 'Belajar pertambahan menjadi mudah, ayo tunggu apa lagi? Checkout sekarang!', 'none', 'product-8.jpg', 'product-8.jpg', 'product-8.jpg', 'product-8.jpg', '0.80', '0.00', 'Black'),
(9, 'Dinasaurus', 'Art Carton', 'Hewan', 'Mengenal hewan jaman purba, dengan desain kekinian, checkout sekarang!', 'none', 'product-9.jpg', 'product-9.jpg', 'product-9.jpg', 'product-9.jpg', '0.82', '0.00', 'Yellow'),
(10, 'Mengenal Hewan', 'Ivory', 'Hewan', 'Mengenal berbagai macam jenis hewan', 'featured', 'product-10.jpg', 'product-10.jpg', 'product-10.jpg', 'product-10.jpg', '0.81', '10.00', 'Yellow'),
(11, 'Animal Alfabet', 'Ivory', 'Hewan', 'Belajar berbagai macam jenis hewan, checkout sekarang!', 'none', 'product-11.jpg', 'product-11.jpg', 'product-11.jpg', 'product-11.jpg', '0.80', '0.00', 'Yellow'),
(12, 'Mockup Periodic Gradasi', 'Matt Paper', 'Tabel Periodik', 'Mudah menghapal senyawa kimia, checkout sekarang!', 'featured', 'product-12.jpg', 'product-12.jpg', 'product-12.jpg', 'product-12.jpg', '0.83', '0.00', 'Green'),
(13, 'Mengenal Buah dan Sayur', 'Linen Jepang', 'Buah dan Sayur', 'Koleksi buah dan sayur, checkout sekarang!', 'none', 'product-13.jpg', 'product-13.jpg', 'product-13.jpg', 'product-13.jpg', '0.80', '0.00', 'Dark Brown'),
(14, 'Mengenal Sayuran', 'Linen Jepang', 'Buah dan Sayur', 'Mengenal berbagai macam sayuran agar si kecil tidak takut lagi makan sayuran, checkout sekarang!', 'featured', 'product-14.jpg', 'product-14.jpg', 'product-14.jpg', 'product-14.jpg', '0.82', '0.00', 'Gold'),
(15, 'Huruf Hijaiyah', 'HVS', 'Hijaiyah', 'Belajar huruf hijaiyah dengan menyenangkan, checkout sekarang!', 'none', 'product-15.jpg', 'product-15.jpg', 'product-15.jpg', 'product-15.jpg', '0.80', '0.00', 'White'),
(169, 'Suku Kata Huruf Kecil', 'Laminasi Glossy', 'Alfabet', 'Belajar suku kata huruf kecil, checkout sekarang!', 'none', 'Suku_Kata_Huruf_Kecil1.jpg', 'Suku_Kata_Huruf_Kecil2.jpg', 'Suku_Kata_Huruf_Kecil3.jpg', 'Suku_Kata_Huruf_Kecil4.jpg', '0.80', '0.10', 'White'),
(170, 'Mockup Periodic Black', 'Art Carton', 'Tabel Periodik', 'Mockup black periodic adalah tabel senyawa kimia yang dapat menyala dalam gelap karena dilengkapi dengan warna neon', 'none', 'Mockup_Periodic_Black1.jpg', 'Mockup_Periodic_Black2.jpg', 'Mockup_Periodic_Black3.jpg', 'Mockup_Periodic_Black4.jpg', '0.81', '0.15', 'Black'),
(171, 'Mockup Periodic White', 'Concorde', 'Tabel Periodik', 'Mockup white periodic adalah tabel senyawa kimia dengan tampilan warna putih yang lebih elegan.', 'none', 'Mockup_Periodic_White1.jpg', 'Mockup_Periodic_White2.jpg', 'Mockup_Periodic_White3.jpg', 'Mockup_Periodic_White4.jpg', '0.80', '0.00', 'White');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_city` varchar(100) DEFAULT NULL,
  `user_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_address`, `user_city`, `user_photo`) VALUES
(1, 'Raihan Hanafi', 'user1@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '628763655111', 'Arcamanik Residence Regency', 'Bandung', 'user_profile1.jpg'),
(2, 'Ridwan Hanif', 'user2@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '628763655222', 'Green Garden Regency', 'Bandung', 'user_profile2.jpg'),
(4, 'Daffa Ismail', 'user3@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '628763655333', 'Bandung City View', 'Bandung', 'user_profile3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
