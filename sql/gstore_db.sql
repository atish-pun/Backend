-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 06:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gstore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `top_sale` tinyint(1) DEFAULT 0,
  `hot_sale` tinyint(1) DEFAULT 0,
  `home_screen_slide` tinyint(1) NOT NULL DEFAULT 0,
  `slide_image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `unit`, `image_path`, `details`, `top_sale`, `hot_sale`, `home_screen_slide`, `slide_image_path`, `created_at`) VALUES
(1, 1, 'Total Body Fuel, Fitness & Performance Drink, Lilikoi Lychee, 16 Fl Oz (Pack of 12)', '2100.00', 'PACK', 'e7c86d569adbcb17f1d73b80334b8d50_9.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque facilisis malesuada purus non cursus. Vivamus vitae augue tortor. Integer aliquet magna erat, non tincidunt dui varius ut. In aliquet tellus ut blandit auctor. Nam pretium ut diam auctor tempor. Quisque ultricies turpis urna, nec pulvinar metus aliquam malesuada. Aliquam vel nisi dolor. Nunc vehicula a lectus a consectetur. Aenean vestibulum massa ante. Fusce dignissim, justo eu sollicitudin pulvinar, nulla libero eleifend purus, ut pharetra nibh erat eget ex. Aliquam ornare, nisl vel fermentum luctus, lacus ante aliquet erat, ac viverra erat ipsum sed orci.\r\n\r\nQuisque tincidunt egestas aliquet. Nullam semper vulputate sapien, dignissim tempus ligula. Suspendisse a sem nec quam cursus maximus sit amet id justo. Cras sagittis semper sollicitudin. Vivamus quis feugiat lacus. Vivamus ultricies tellus risus, faucibus molestie purus ultricies ac. Sed nec commodo metus. Vivamus viverra eros et enim lacinia, eu sollicitudin diam interdum. Cras purus metus, convallis auctor massa ac, accumsan congue erat. Nullam id dolor molestie erat hendrerit elementum at ut tortor. Cras pretium eu metus sit amet congue. Integer ac sapien ante. Nulla tortor massa, iaculis id lacus at, gravida hendrerit odio. Fusce dapibus purus sed risus interdum lacinia.\r\n\r\nEtiam interdum, tellus ac viverra interdum, arcu massa porta lectus, non rhoncus magna felis ut arcu. Vestibulum tempor enim non lobortis feugiat. In hac habitasse platea dictumst. Duis vel euismod elit. Nulla rhoncus sapien vitae lorem varius, ac pretium purus ornare. Pellentesque lobortis turpis velit. Pellentesque facilisis varius lobortis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque molestie eros vel sodales tincidunt. Morbi non magna dapibus, varius odio sed, ornare purus. Ut gravida nisi venenatis justo consectetur, quis egestas justo dapibus. Duis volutpat ornare blandit. Etiam pellentesque velit luctus, facilisis odio a, scelerisque odio.\r\n\r\nPellentesque bibendum metus consequat, volutpat metus congue, sollicitudin enim. Praesent lorem turpis, vehicula ut iaculis vel, hendrerit at lectus. Aenean quis tincidunt eros, eget tempus erat. Cras sit amet viverra purus, et porttitor purus. Pellentesque efficitur dui velit, nec pharetra felis tincidunt vel. Fusce a est mi. Quisque consectetur condimentum condimentum. Praesent elementum felis id quam facilisis, vel pharetra nisi luctus. Morbi vel tincidunt sem. Quisque efficitur aliquam sagittis.', 0, 0, 1, '39c08d88875a78f70287f0674abc0dbf_regin-total-body-fuel.jpg', '2021-02-07 22:32:24'),
(2, 2, 'Non Shim Gourmet Spicy Shimramyun Family Pack(4+1) Noodles 120G', '280.00', 'PACK', '677270_2.jpg', 'READY IN MINUTES - A fulfilling yet simple meal that is easy to make and ready to eat in minutes\r\nMade in Korea\r\nIngredients: Wheat flour, stratches, Vegetable oil, salt , minerals, soy Sauce, Green tea extract, etc.', NULL, 1, 0, NULL, '2021-02-07 22:33:34'),
(4, 4, 'Tide Lemon & Fresh Detergent Powder (4Kg + 1Kg)', '520.00', 'PACK', '644341_3.jpg', 'Clean, shiny and trendy look to the clothes.\r\nHelps in washing away the toughest stains on the clothes\r\nClothes look bright and fresh.\r\nEliminates the toughest of stains, while being extremely gentle on your clothes', 1, 1, 0, NULL, '2021-02-07 22:35:12'),
(5, 5, 'Frontera Cabernet Sauvignon - 750 Ml', '1350.00', 'UNIT', '497853_4.jpg', 'Type:Forfited Wine\r\nBrand:td {border: 1.0px solid #cccccc;}br {mso-data-placement: same-cell;}Frontera\r\nSize: 750 ml\r\nCountry: Chile\r\nAlcohol: 12%\r\nColour: Deep garnet-red.\r\nNose: Fruity red plum and chocolate aromas.\r\nPalate: Very concentrated, rich in flavor, perfectly balanced, and a satisfying and lingering finish.', NULL, 1, 0, NULL, '2021-02-07 22:36:16'),
(6, 1, 'Milk Bread', '25.00', 'PACK', '477274_5.jpg', 'Duis et eros a arcu molestie vestibulum at quis eros. Sed ac est enim. Curabitur tempor non dolor et ultricies. Nam malesuada purus nec turpis venenatis gravida. Ut facilisis eu metus nec rhoncus. Aliquam lobortis rutrum nibh, quis tempus arcu fermentum accumsan. Ut venenatis, ipsum nec semper porta, risus ante aliquam ipsum, et egestas arcu orci ut ex. Morbi dictum lectus sit amet dapibus facilisis. Maecenas rhoncus mi a dui lacinia, vel dignissim risus suscipit.\r\n\r\nNunc interdum a massa quis pulvinar. Nulla scelerisque convallis venenatis. Vivamus laoreet nibh libero, nec euismod eros malesuada auctor. Pellentesque vitae nisi fermentum, vulputate augue vel, malesuada neque. Proin ullamcorper tellus id tortor ornare, eu iaculis nulla fringilla. Quisque non vulputate ipsum. Nulla sit amet dolor at est lobortis gravida. Maecenas odio eros, molestie in dui eu, efficitur faucibus massa. Suspendisse eleifend faucibus pharetra. Pellentesque lacus neque, venenatis lacinia', 1, 0, 0, NULL, '2021-02-07 22:53:43'),
(7, 2, 'Campbell Chunky - Grilled Chicken With Vegetables & Pasta', '123.00', 'ITEM', '374979_6.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus placerat leo in tincidunt. Nam rutrum felis diam, et interdum massa pellentesque in. Vivamus mattis tempus odio et ultricies. Nam mauris ligula, pharetra a neque eu, consectetur pellentesque elit. Duis nec turpis ac mauris interdum pellentesque ut at turpis. Mauris dapibus efficitur velit, a lobortis orci. Nunc eget porttitor sapien. Nullam ac auctor leo.\r\n\r\nNullam interdum orci erat, vitae gravida est condimentum vitae. Nunc eu condimentum odio. Morbi placerat eros enim, vitae eleifend velit pulvinar ac. Sed a gravida lectus. Morbi dui ligula, ornare id urna consectetur, ullamcorper condimentum purus. Duis fermentum dapibus lectus, et tempor nisi convallis et. Suspendisse sit amet erat a sapien iaculis cursus.', 1, 0, 0, NULL, '2021-02-09 00:12:18'),
(8, 1, 'Carnation Breakfast Essentials Ready-to-Drink, Creamy Strawberry, 8 Ounce Bottle (Pack of 24) (Packaging May Vary)', '250.00', 'UNIT', '183611_7.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus placerat leo in tincidunt. Nam rutrum felis diam, et interdum massa pellentesque in. Vivamus mattis tempus odio et ultricies. Nam mauris ligula, pharetra a neque eu, consectetur pellentesque elit. Duis nec turpis ac mauris interdum pellentesque ut at turpis. Mauris dapibus efficitur velit, a lobortis orci. Nunc eget porttitor sapien. Nullam ac auctor leo.\r\n\r\nNullam interdum orci erat, vitae gravida est condimentum vitae. Nunc eu condimentum odio. Morbi placerat eros enim, vitae eleifend velit pulvinar ac. Sed a gravida lectus. Morbi dui ligula, ornare id urna consectetur, ullamcorper condimentum purus. Duis fermentum dapibus lectus, et tempor nisi convallis et. Suspendisse sit amet erat a sapien iaculis cursus.', 1, 1, 0, NULL, '2021-02-09 00:15:01'),
(9, 1, 'Carnation Breakfast Essentials Powder Drink Mix, Classic French Vanilla, 10 Count Box of 1.26 oz Packets, (Pack of 6)', '570.00', 'UNIT', '473869_8.jpg', 'Carnation Breakfast Essentials Powder Drink Mix\r\nTreat your family to Carnation Breakfast Essentials Powder Drink Mix, which delivers balanced nutrition to start the day right. This nutritional drink is loaded with nutrition and flavor. A single serving mixed with one cup of skim milk provides 220 calories, 13 grams of protein, and 25% or more of the daily value for 21 essential vitamins and minerals, including calcium and vitamin D.\r\n\r\nAvailable in Café Mocha, Rich Milk Chocolate, Classic French Vanilla, Strawberry Sensation, Classic Chocolate Malt and Dark Chocolate flavors.\r\nPOWDERED NUTRITIONAL DRINK: Snack or breakfast, drink with skim milk or add to smoothies, Carnation Breakfast Essentials Powdered Drink Mix provides 13g of protein when mixed with 1 cup of fat-free milk.\r\nCARNATION BREAKFAST ESSENTIALS ORIGINAL: The nutritional drink you love at breakfast, available in two easy forms: a powdered drink mix, or a shake in a bottle, in vanilla, chocolate, or strawberry.\r\nPOWDER DRINK MIX: Mix Carnation Breakfast Essentials Powder Drink Mix with skim milk or mix in a smoothie for a tasty, easy snack or breakfast drink & start the day right, with protein & other nutrients.\r\nGOOD NUTRITION FROM THE START: Carnation Breakfast Essentials helps families get the vitamins & minerals they need to start the day, from powdered drink mixes to high protein ready-to-drink shakes.\r\nNUTRITIONAL DRINKS FOR BUSY LIVES: It\'s hard to balance a healthy lifestyle & a busy day. Carnation Breakfast Essentials nutritional drinks make it easy to start your day with good nutrition', 0, 0, 1, '89f728849f90160d55ef885cf6e60f29_carnation-breakfast-essentials-slide.jpg', '2021-02-09 00:18:20'),
(10, 1, 'Red Cherry Himalayan Arabica Coffee - Medium Roast Coarse Powder - 250 Gm', '700.00', 'PACK', '749151_1.jpg', 'This coffee is an arabica coffee grown in Lalipur area without using pesticide. It is medium roasted using slow roasting process that preserves more antioxidants that are naturally present in coffee beans. This process also enhances flavor and aroma of the coffee. Arabica coffee is believed to be the first species of coffee to be cultivated, and is by far the most dominant cultivar around the world. Arabica coffee is less acidic, more bitter, and more highly caffeinated. JUAS course ground coffee is an ideal coffee to drink during your morning fasting time.', 1, 0, 0, NULL, '2021-02-07 22:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `image_path`, `created_at`) VALUES
(1, 'Beverages', '313995_beverages.png', '2021-02-07 22:27:58'),
(2, 'Canned, Dry & Packaged Foods', '634251_canned-food.png', '2021-02-07 22:28:09'),
(3, 'Cooking Ingredients', '214114_cooking-pot.png', '2021-02-07 22:28:23'),
(4, 'Laundry & Household', '461292_washing-clothes.png', '2021-02-07 22:29:30'),
(5, 'Wines, Beers & Spirits', '114059_whisky.png', '2021-02-07 22:29:46'),
(6, 'Snacks', '736675_snack.png', '2021-02-07 22:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` decimal(11,2) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 10,
  `order_date` datetime DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `shipping_date` datetime DEFAULT NULL,
  `delivered_date` datetime DEFAULT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `esewa_transaction` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'CUSTOMER',
  `current_cart_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone`, `type`, `current_cart_token`, `created_at`) VALUES
(1, 'Admin', 'admin@gstore.com', '123456789', NULL, '', 'ADMIN', NULL, '2021-02-07 13:19:12'),
(2, 'Sushil Kandel', 'sushil@gmail.com', '123456789', 'Nepal, Pokhara', '98546857545', 'CUSTOMER', NULL, '2021-02-09 01:58:31'),
(3, 'Ram Thapa', 'ram@gmail.com', '123456789', 'Nepal, Pokhara, Zero KM', '98546854525', 'CUSTOMER', NULL, '2021-02-13 21:58:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
