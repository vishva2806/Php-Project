-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 02:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `assignProduct` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `assignProduct`) VALUES
(4, 'Men', 1, '[\"55\",\"94\",\"101\",\"104\"]'),
(5, 'Women', 1, '[\"63\",\"94\",\"95\",\"96\",\"97\",\"98\",\"106\"]'),
(6, 'Home and Furniture', 1, '[\"39\",\"40\",\"98\",\"99\",\"100\"]'),
(7, 'Baby and Kids', 0, '[\"40\",\"41\",\"81\",\"82\",\"94\",\"96\",\"97\"]'),
(15, 'TV', 1, '[\"41\",\"42\",\"105\"]'),
(30, 'Dress', 0, '[\"98\",\"99\",\"100\"]'),
(32, 'Beauty', 1, '[\"81\",\"82\",\"94\"]'),
(34, 'Furniture', 1, '[\"39\",\"41\",\"103\"]'),
(35, 'Books', 1, '[\"81\",\"82\",\"94\"]'),
(36, 'Toys and games', 1, '[\"98\",\"99\",\"100\",\"103\"]'),
(37, 'Footwear', 0, '[\"40\",\"41\",\"42\",\"55\",\"81\",\"82\"]'),
(38, 'Electronics', 1, '[\"82\",\"94\",\"97\",\"102\",\"103\",\"105\"]'),
(39, 'Foods', 1, '[\"39\",\"81\",\"82\"]');

-- --------------------------------------------------------

--
-- Table structure for table `characteristics`
--

CREATE TABLE `characteristics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characteristics`
--

INSERT INTO `characteristics` (`id`, `name`) VALUES
(1, '5G Support'),
(2, 'Waterproof'),
(3, 'Water Resistance'),
(4, 'Dust Proof'),
(5, 'Curved Display');

-- --------------------------------------------------------

--
-- Table structure for table `mobile`
--

CREATE TABLE `mobile` (
  `id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Categories` int(11) DEFAULT NULL,
  `ModelName` varchar(100) NOT NULL,
  `ShortDesc` varchar(500) NOT NULL,
  `DetailedDesc` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Characteristics` varchar(255) DEFAULT NULL,
  `Stock` varchar(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sku` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobile`
--

INSERT INTO `mobile` (`id`, `Title`, `Categories`, `ModelName`, `ShortDesc`, `DetailedDesc`, `Price`, `Characteristics`, `Stock`, `image`, `sku`) VALUES
(39, 'we', 6, 'gf', 'Making an Editable HTML Element. Making a editable element in HTML isn\'t all that difficult. You can add the contenteditable=\"true\" HTML attribute to the element (a <div> for example) that you want to', 'The contenteditable attribute specifies whether the content of an element is editable or not. Note: When the contenteditable attribute is not set on an element, the element will inherit it from its parent.', 744.00, '[\"5G Support\",\"Water Resistance\",\"Curved Display\"]', 'out of sto', '[\"uploads/oppo1.jpg\"]', 'SKU1003'),
(40, 'dsjiou', 7, 'koisd', 'Making an Editable HTML Element. Making a editable element in HTML isn\'t all that difficult. You can add the contenteditable=\"true\" HTML attribute to the element (a <div> for example) that you want to', 'The contenteditable attribute specifies whether the content of an element is editable or not. Note: When the contenteditable attribute is not set on an element, the element will inherit it from its parent.', 200.00, '[\"Water Resistance\",\"Curved Display\"]', 'out of sto', '[\"uploads/OPPO.jpg\"]', 'SKU1004'),
(41, 'uuyu', 15, 'gf', 'The contenteditable attribute specifies whether the content of an element is editable or not. Note: When the contenteditable attribute is not set on an element, the element will inherit it from its pa', 'The contenteditable attribute specifies whether the content of an element is editable or not. Note: When the contenteditable attribute is not set on an element, the element will inherit it from its parent.', 100.00, '[\"5G Support\",\"Waterproof\",\"Dust Proof\"]', 'in stock', '[\"uploads/vivo.png\"]', 'SKU1005'),
(42, 'ees', 30, 'h8888', 'Making an Editable HTML Element. Making a editable element in HTML isn\'t all that difficult. You can add the contenteditable=\"true\" HTML attribute to the element (a <div> for example) that you want to', 'The contenteditable attribute specifies whether the content of an element is editable or not. Note: When the contenteditable attribute is not set on an element, the element will inherit it from its parent.', 4222.00, '[\"Water Resistance\",\"Dust Proof\"]', 'out of sto', '[\"uploads/pop.jpg\"]', 'SKU1006'),
(43, 'as', 32, 'gf', 'Making an Editable HTML Element. Making a editable element in HTML isn\'t all that difficult. You can add the contenteditable=\"true\" HTML attribute to the element (a <div> for example) that you want to', 'Making an Editable HTML Element. Making a editable element in HTML isn\'t all that difficult. You can add the contenteditable=\"true\" HTML attribute to the element (a <div> for example) that you want to be editable', 8551.00, '[\"Waterproof\",\"Water Resistance\",\"Dust Proof\",\"Curved Display\"]', 'in stock', '[\"uploads/OPPO.jpg\"]', 'SKU1007'),
(55, 'qwq', 34, 'koisd', 'fgFind your new smartphone in the latest mobile phone list from OPPO India with smartphone models like the OPPO Find X8 Pro, OPPO Reno12 Pro 5G and more.', 'Find your new smartphone in the latest mobile phone list from OPPO India with smartphone models like the OPPO Find X8 Pro, OPPO Reno12 Pro 5G and more.', 2369.00, '[\"Waterproof\",\"Dust Proof\",\"Curved Display\"]', 'out of sto', '[\"uploads/oppo1.jpg\"]', 'SKU1008'),
(63, 'dsjiou', 15, 'sd', 'Learn how to process forms with simple validations to enhance the security of our application.Learn how to process forms with simple validations to enhance the security of our application.Learn how to', 'Learn how to process forms with simple validations to enhance the security of our application.Learn how to process forms with simple validations to enhance the security of our application.Learn how to process forms with simple validations to enhance the security of our application.', 8555.00, '[\"Water Resistance\",\"Dust Proof\"]', 'out of sto', '[\"uploads/oppo1.jpg\"]', 'SKU1009'),
(81, 'dswq', 35, 'koisd', 'poA constant cannot be changed once it is declared.\r\n\r\nClass constants are case-sensitive. However, it is recommended to name the constants in all uppercase letters.\r\n\r\nWe can access a constant from outsi', 'A constant cannot be changed once it is declared.\r\n\r\nClass constants are case-sensitive. However, it is recommended to name the constants in all uppercase letters.\r\n\r\nWe can access a constant from outside the class by using the class name followed by the scope resolution operator (::) followed by the constant name, like here:', 8999.00, '[\"Dust Proof\"]', 'out of sto', '[\"uploads/images.jpg\"]', 'SKU1010'),
(82, 'dsjiou', 36, 'sdw', 'A constant cannot be changed once it is declared.\r\n\r\nClass constants are case-sensitive. However, it is recommended to name the constants in all uppercase letters.\r\n\r\nWe can access a constant from outsid', 'A constant cannot be changed once it is declared.\r\n\r\nClass constants are case-sensitive. However, it is recommended to name the constants in all uppercase letters.\r\n\r\nWe can access a constant from outside the class by using the class name followed by the scope resolution operator (::) followed by the constant name, like here:', 700.00, '[\"Waterproof\"]', 'in stock', '[\"uploads/OPPO.jpg\"]', 'SKU1011'),
(94, 'fdjsd', 37, 'koisd', 'Learn PHP\r\nPHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\nPHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'', 'Learn PHP\r\nPHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\nPHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'s ASP.\r\n\r\n', 900.00, '[\"Waterproof\"]', 'out of sto', '[\"uploads/OPPO.jpg\"]', 'SKU1012'),
(95, 'sdjhkj', 38, 'cv', 'Learn PHP\r\nPHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\nPHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'', 'Learn PHP\r\nPHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\nPHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'s ASP.\r\n\r\n', 200.00, '[\"Waterproof\"]', 'out of sto', '[\"uploads/iphone.jpg\"]', 'SKU1013'),
(96, 'dsjiou', 4, 'koisd', 'Learn PHP\r\nPHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\nPHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'', 'Learn PHP\r\nPHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.\r\n\r\nPHP is a widely-used, free, and efficient alternative to competitors such as Microsoft\'s ASP.\r\n\r\n', 522.00, '[\"Dust Proof\",\"Curved Display\"]', 'out of sto', '[\"uploads/vivo1.png\"]', 'SKU1015'),
(97, 'gdsjg', 39, 'qw', 'Some predefined variables in PHP are \"superglobals\", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do an', 'Some predefined variables in PHP are \"superglobals\", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do anything special.\r\n\r\nThe PHP superglobal variables are:', 300.00, '[\"Waterproof\",\"Dust Proof\"]', 'out of sto', '[\"uploads/OPPO.jpg\"]', 'SKU1014'),
(98, 'trtvggg', 15, 're', 'ASome predefined variables in PHP are \"superglobals\", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do a', 'Some predefined variables in PHP are \"superglobals\", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do anything special.\r\n\r\nThe PHP superglobal variables are:', 410.00, '[\"Dust Proof\"]', 'in stock', '[\"uploads/oppo1.jpg\"]', 'SKU1016'),
(99, 'ujjki', 30, 'xch', 'Superglobals were introduced in PHP 4.1.0, and are built-in variables that are always available in all scopes.\r\n\r\nPHP Global Variables - Superglobals\r\nSome predefined variables in PHP are \"superglobals\",', 'Superglobals were introduced in PHP 4.1.0, and are built-in variables that are always available in all scopes.\r\n\r\nPHP Global Variables - Superglobals\r\nSome predefined variables in PHP are \"superglobals\", which means that they are always accessible, regardless of scope - and you can access them from any function, class or file without having to do anything special.\r\n\r\nThe PHP superglobal variables are:', 666.00, '[\"Waterproof\"]', 'out of sto', '[\"uploads/oppo1.jpg\"]', 'SKU1017'),
(100, 'ew', 5, 'koisd', 'Creation of Field Selection Group for MM\r\n\r\nSAP Community\r\nhttps://community.sap.com › ... › ERP Q&A\r\n17 Aug 2011 — Create field selection group in OMSR by clicking new entries-->give field, check the pro', 'Creation of Field Selection Group for MM\r\n\r\nSAP Community\r\nhttps://community.sap.com › ... › ERP Q&A\r\n17 Aug 2011 — Create field selection group in OMSR by clicking new entries-->give field, check the propose field cont box and give maint.status.\r\nField Selection Group for Material Master\r\n\r\nSAP Community', 700.00, '[\"Waterproof\"]', 'out of sto', '[\"uploads/84198940-computer-device-on-work-desk-top-view.jpg\"]', 'SKU1001'),
(101, 'hfgd', 15, 'fdhjh', 'How to add multiple products in cart in PHP\r\nAdd to cart using PHP session\r\nCart update in php\r\nSession variable in PHP\r\nCart\r\nShopping cart', 'How to add multiple products in cart in PHP\r\nAdd to cart using PHP session\r\nCart update in php\r\nSession variable in PHP\r\nCart\r\nShopping cart', 899.00, '[\"Water Resistance\"]', 'instock', '[\"uploads/a9abe0e830bd476682d2707e4fab10e2.png\"]', 'SKU1024'),
(102, 'dshuy', 5, 'koisd', '\r\nStack Overflow\r\n1 answer · 5 years ago\r\nYou can use GROUP_CONCAT() to get all the sellers and categories in each row. SELECT product.id, product.name, GROUP_CONCAT(DISTINCT ...\r\nDisplay products exactly', '\r\nStack Overflow\r\n1 answer · 5 years ago\r\nYou can use GROUP_CONCAT() to get all the sellers and categories in each row. SELECT product.id, product.name, GROUP_CONCAT(DISTINCT ...\r\nDisplay products exactly below the categories to which ...\r\n2 answers\r\n6 Feb 2020\r\nHow to display multiple categories and products ...\r\n3 answers\r\n16 May 2010\r\nMore results from stackoverflow.com', 8999.00, '[\"Water Resistance\"]', 'instock', '[\"uploads/oppo12.jpg\"]', 'SKU1002'),
(103, 'wdgsh', 38, 'sdw', ' \r\n\r\nExample 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all courses\r\n\r\n\r\n\r\n\r\n<!DOCTYPE ', ' \r\n\r\nExample 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all courses\r\n\r\n\r\n\r\n\r\n<!DOCTYPE ', 999.00, '[\"Waterproof\",\"Water Resistance\"]', 'out of sto', '[\"uploads/OPPO.jpg\"]', 'SKU1018'),
(104, 'dsjiou', 4, 'hg', ' \r\n\r\nExample 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all courses\r\n', ' \r\n\r\nExample 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all courses\r\n', 2999.00, '[\"Waterproof\",\"Water Resistance\"]', 'in stock', '[\"uploads/iphone.jpg\"]', 'SKU1019'),
(105, 'dsjiou', 5, 'koisd', 'Example 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all courses\r\n', 'xample 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all cours', 1999.00, '[\"Dust Proof\",\"Curved Display\"]', 'out of sto', '[\"uploads/pixels-photo-1903702.jpeg\"]', 'SKU1020'),
(106, 'wq', 6, 'cv', 'Example 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all courses\r\n\r\n', 'Example 2: In this example, we will use the footer with the dark theme using class .table-dark to calculate the sum of the price of all courses\r\n\r\n', 6999.00, '[\"Water Resistance\"]', 'in stock', '[\"uploads/desktop-backgrounds-nawpic-14.jpg\"]', 'SKU1021'),
(107, 'rereer', 7, 'wq', 'Bootstrap 5 Table foot is used to create a section where we can calculate the whole column’s sum. Like if we create a table that contains two columns one holding the product and another holding the va', 'Bootstrap 5 Table foot is used to create a section where we can calculate the whole column’s sum. Like if we create a table that contains two columns one holding the product and another holding the va', 650.00, '[\"Water Resistance\"]', 'out of sto', '[\"uploads/84198940-computer-device-on-work-desk-top-view.jpg\"]', 'SKU1022'),
(110, 'wqq343re', 35, 'do wq', 'W3Schools\r\nhttps://www.w3schools.com\r\nFull Access Best Value! ... Data Analytics ... What is a Certificate? ×. All Our Services ... W3Schools offers a wide range of services and products for beginners ', 'W3Schools\r\nhttps://www.w3schools.com\r\nFull Access Best Value! ... Data Analytics ... What is a Certificate? ×. All Our Services ... W3Schools offers a wide range of services and products for beginners and ...', 320.00, '[\"Water Resistance\"]', 'in stock', '[\"uploads/a9abe0e830bd476682d2707e4fab10e2_thumb.png\"]', 'SKU1023'),
(124, 'IPHONE', 7, 'ModelY', 'Comma Separated Value (CSV) is a text file containing data contents. It facilitates the storage of data in a table like structure. CSV files are stored with a CSV extension. A CSV file can be created ', 'Comma Separated Value (CSV) is a text file containing data contents. It facilitates the storage of data in a table like structure. CSV files are stored with a CSV extension. A CSV file can be created with the use of any text editor such as notepad, notepad++, etc. After adding content to a text file in the notepad, store it as a csv file with the use of .csv extension.', 1999.00, '[]', 'out of sto', '[\"uploads/OPPO.jpg\"]', 'SKU1030'),
(125, 'Home', 7, 'mhyus', 'Comma Separated Value (CSV) is a text file containing data contents. It facilitates the storage of data in a table like structure. CSV files are stored with a CSV extension. A CSV file can be created ', 'Comma Separated Value (CSV) is a text file containing data contents. It facilitates the storage of data in a table like structure. CSV files are stored with a CSV extension. A CSV file can be created with the use of any text editor such as notepad, notepad++, etc. After adding content to a text file in the notepad, store it as a csv file with the use of .csv extension.', 200.00, '[]', 'out of sto', '[\"uploads/vivo.png\"]', 'SKU1027'),
(131, 'cdf', 5, 'uy', '', NULL, 400.00, '[]', 'out of sto', '[\"uploads/iphone.jpg\"]', 'SKU1028'),
(132, 'ty', 38, 'ui', '', NULL, 200.00, '[]', 'out of sto', '[\"uploads/oppo1.jpg\"]', 'SKU1029');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characteristics`
--
ALTER TABLE `characteristics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile`
--
ALTER TABLE `mobile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`) USING HASH,
  ADD UNIQUE KEY `sku_2` (`sku`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `characteristics`
--
ALTER TABLE `characteristics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mobile`
--
ALTER TABLE `mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
