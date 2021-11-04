-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 31, 2021 lúc 01:40 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopwatch`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_info`
--

CREATE TABLE `admin_info` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_info`
--

INSERT INTO `admin_info` (`id`, `name`, `email`, `password`) VALUES
(4, '', 'quy17787@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `id_sanpham`, `quantity`) VALUES
(63, 26, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_chitiet`
--

CREATE TABLE `order_chitiet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datetimea` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_product` int(11) NOT NULL,
  `tongtien` float NOT NULL,
  `trangthai` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_chitiet`
--

INSERT INTO `order_chitiet` (`id`, `user_id`, `fname`, `lname`, `mobile`, `address`, `datetimea`, `total_product`, `tongtien`, `trangthai`) VALUES
(1, 27, 'Nguyễn Đạo ', 'Quý', '0889461246', '470 Trần Đại Nghĩa, Hòa Quý, Ngũ Hành Sơn, Đà Nẵng', '2021-05-31 08:55:22', 2, 985, 'YES'),
(2, 27, 'Nguyễn Anh ', 'Tài', '0889461246', '470 Trần Đại Nghĩa, Hòa Quý, Ngũ Hành Sơn, Đà Nẵng', '2021-05-31 08:55:43', 1, 250, 'YES'),
(3, 27, 'Nguyễn Đỗ', 'Thế Huynh', '0889461246', '470 Trần Đại Nghĩa, Hòa Quý, Ngũ Hành Sơn, Đà Nẵng', '2021-05-31 09:16:12', 2, 980, 'YES');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_sanpham`
--

CREATE TABLE `order_sanpham` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tongtien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_sanpham`
--

INSERT INTO `order_sanpham` (`id`, `id_order`, `id_product`, `soluong`, `tongtien`) VALUES
(37, 1, 1, 2, 400),
(38, 1, 2, 1, 185),
(39, 2, 3, 1, 250),
(40, 3, 3, 1, 250),
(41, 3, 9, 1, 730);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `nameproduct` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `nameproduct`, `price`, `img`, `date_added`) VALUES
(1, 'Swarovski City Mother of Pearl Watch 38mm', '400', 'dongho.jpg', '2021-05-23 15:56:36'),
(2, 'Frederique Constant Classic FC-715V4H4 Moonphase 40.5mm\r\n', '185', 'dh2.jpg', '2021-05-23 17:10:15'),
(3, 'Omega De Ville Trésor 428.18.36.60.04.002 Quartz 36', '250', 'dh3.jpg', '2021-05-23 17:10:15'),
(4, 'Calvin Klein Infinite Men\'s Watch 42mm\r\n', '110', 'dh4.jpg', '2021-05-23 17:22:49'),
(5, 'Michael Kors Sofie Three-Hand Watch 36mm', '600', 'dh5.jpg', '2021-05-23 17:22:49'),
(6, 'Versace Medusa Frame Watch 36mm', '310', 'dh6.jpg', '2021-05-23 17:24:07'),
(7, '88 Rue du Rhone Swiss Quartz Watch 42mm', '900', 'dh7.jpg', '2021-05-23 17:24:07'),
(8, 'Hamilton Jazzmaster Maestro Automatic Watch 40mm', '280', 'dh8.jpg', '2021-05-23 17:25:05'),
(9, 'Longines Master L2.628.5.77.7 Watch 38.5mm', '730', 'dh9.jpg', '2021-05-23 17:25:05'),
(10, 'Montblanc Heritage 112648 Chronométrie Automatic 43', '920', 'dh10.jpg', '2021-05-23 17:35:05'),
(11, 'Longines Conquest L2.785.8.76.3 Watch 40mm\r\n', '165', 'dh11.jpg\r\n', '2021-05-23 17:35:05'),
(14, 'Michael Kors Jaryn Pav Watch 38mm', '600', 'dh12.jpg', '2021-05-29 15:12:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_info`
--

INSERT INTO `user_info` (`id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(26, 'Nguyễn Đạo', 'Quý', 'quy17787@gmail.com', '123', '0889461246', 'Hải Lăng', 'Quảng Trị'),
(27, 'Nguyễn Anh', 'Tài', 'AnhTai1604@gmail.com', '123', '0889461246', 'Đại Lộc', 'Quảng Nam'),
(28, 'Nguyễn Đỗ', 'TheHuymh', 'huynhdo123@gmail.com', '123', '0919424091', 'Quy Nhơn ', 'Bình Định');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_sanpham` (`id_sanpham`);

--
-- Chỉ mục cho bảng `order_chitiet`
--
ALTER TABLE `order_chitiet`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_sanpham`
--
ALTER TABLE `order_sanpham`
  ADD PRIMARY KEY (`id`,`id_order`,`id_product`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_order` (`id_order`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `order_sanpham`
--
ALTER TABLE `order_sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_sanpham`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `order_sanpham`
--
ALTER TABLE `order_sanpham`
  ADD CONSTRAINT `order_sanpham_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_sanpham_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `order_chitiet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
