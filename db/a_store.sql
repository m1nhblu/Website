SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `biographical` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `admin` (`id`, `username`, `password`, `fullname`, `email`, `biographical`, `phone`, `created`) VALUES
(1, 'minhle', 'asdasdasd9', 'Le Anh Minh', 'minh40568@gmail.com', 'I\'m a web developer and I love to build things.', '0896746674', '2024-11-22 21:44:00');

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `currencies` (`id`, `currency`) VALUES
(2, 'VND'),
(1, 'USD');

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name_customer` varchar(20) NOT NULL,
  `email_customer` varchar(255) NOT NULL,
  `phone_customer` varchar(10) NOT NULL,
  `date_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `customers` (`id`, `name_customer`, `email_customer`, `phone_customer`, `date_at`) VALUES
(1, 'Le Anh Minh', 'minh40568@gmail.com', '0896746674', '2024-11-22 21:44:00'),
(2, 'Dam Vuong Tu', 'tu@gmail.com', '0896746675', '2024-11-22 21:44:00'),
(3, 'Nguyen Trong Tin', 'tin@gmail.com', '0896746676', '2024-11-22 21:44:00');

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orders_number` varchar(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `product_name` text NOT NULL,
  `product_quantity` varchar(20) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `currency` enum('VND','USD') NOT NULL DEFAULT 'USD',
  `subtotal` varchar(20) NOT NULL,
  `note_customer` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` enum('Chờ thanh toán','Đã hủy','Đang xử lý','Chờ thanh toán','Đã hoàn thành','Thất bại') NOT NULL DEFAULT 'Chờ thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `orders` (`id`, `orders_number`, `customer_id`, `product_name`, `product_quantity`, `product_price`, `currency`, `subtotal`, `note_customer`, `order_date`, `order_status`) VALUES
(4, '#23380', 5, 'Netflix Premium 4K 1 Month', '2', 4.49, 'USD', '8.98', 'minhle', '2023-06-20 22:32:10', 'Đã hoàn thành'),
(8, '#68817', 6, 'Netflix Premium 4K 1 Month', '1', 4.49, 'USD', '4.49', '', '2023-06-21 16:23:27', 'Đã hoàn thành'),
(9, '#18661', 7, 'Netflix Premium 4K 1 Month', '3', 4.49, 'USD', '13.47', 'tin', '2023-06-21 15:49:54', 'Đã hoàn thành');

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name_product` text NOT NULL,
  `description_product` text NOT NULL,
  `price_product` decimal(10,2) NOT NULL,
  `currency` enum('VND','USD') NOT NULL DEFAULT 'USD',
  `img_product` varchar(255) NOT NULL,
  `stock_product` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `products` (`id`, `name_product`, `description_product`, `price_product`, `currency`, `img_product`, `stock_product`, `created_at`) VALUES
(1, 'Canva Pro 1 Year', '✅ 1 year subscription\r\n\r\n✅ Non-stop\r\n\r\n✅ Auto renew\r\n\r\n✅ Upgrade your own account or give you a new one\r\n\r\n✅ Private account (You can change the email and password)\r\n\r\n✅ Full Warranty\r\n\r\n✅ If you need help or anything, you can contact us anytime, and we\'ll be happy to assist you.', 4.49, 'VND', '646d6246a868f.webp', '10', '2023-06-19 22:20:00'),
(3, 'Netflix Premium 4K 1 Month', '✅ Works on any device.\r\n\r\n✅ You can change the language while watching.\r\n\r\n✅ The account won\'t stop working if you don\'t change credentials (email, password).\r\n\r\n✅ Contact us for any issue, if the account stops working before the duration\r\n\r\n✅ Safety Account Warranty 100%\r\n\r\n✅ If you have any questions or need a custom deal you can contact us.\r\n\r\n✅ Support 24/7\r\n\r\n✅ Delivery Full Info when you made Purchase', 4.49, 'USD', '64920750bf3d4.jpg', '6', '2023-06-20 19:43:37');

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Chờ thanh toán'),
(2, 'Đã hủy'),
(3, 'Đang xử lý'),
(4, 'Chờ thanh toán'),
(5, 'Đã hoàn thành'),
(6, 'Thất bại');

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`,`phone`);

ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency` (`currency`);

ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

COMMIT;
