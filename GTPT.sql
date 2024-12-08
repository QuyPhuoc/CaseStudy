-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 08, 2024 lúc 05:22 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `GTPT`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Account`
--

CREATE TABLE `Account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Account`
--

INSERT INTO `Account` (`username`, `password`) VALUES
('tuan', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DISTRICTS`
--

CREATE TABLE `DISTRICTS` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `DISTRICTS`
--

INSERT INTO `DISTRICTS` (`ID`, `Name`) VALUES
(1, 'Quận 2'),
(2, 'Quận 3'),
(3, 'Quận 4'),
(4, 'Quận 2'),
(5, 'Quận 3'),
(6, 'Quận 4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Motel`
--

CREATE TABLE `Motel` (
  `ID` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `count_view` int(11) NOT NULL DEFAULT 0,
  `address` varchar(255) NOT NULL,
  `latlng` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `images` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `utilities` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(255) NOT NULL,
  `approve` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `Motel`
--

INSERT INTO `Motel` (`ID`, `title`, `description`, `price`, `area`, `count_view`, `address`, `latlng`, `images`, `user_id`, `category_id`, `district_id`, `utilities`, `created_at`, `phone`, `approve`) VALUES
(1, 'Phòng trọ cao cấp', 'Phòng trọ đầy đủ tiện nghi', 3000000, 20, 0, '123 Đường ABC, Quận 1, TP.HCM', '2024-10-19 13:19:25', NULL, 1, 1, 1, NULL, '2024-10-19 06:19:25', '0987654321', NULL),
(2, 'Phòng trọ giá rẻ', 'Phòng trọ gần trường học', 2000000, 15, 0, '456 Đường XYZ, Quận 5, TP.HCM', '2024-10-19 13:19:25', NULL, 2, 2, 2, NULL, '2024-10-19 06:19:25', '0912345678', NULL),
(3, 'Phòng trọ cho nữ', 'Phòng trọ an toàn, sạch sẽ', 2500000, 18, 0, '789 Đường MNP, Quận 3, TP.HCM', '2024-10-19 13:19:25', NULL, 3, 3, 3, NULL, '2024-10-19 06:19:25', '0934567890', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `USER`
--

CREATE TABLE `USER` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` int(11) NOT NULL DEFAULT 2,
  `Phone` varchar(255) NOT NULL,
  `Avatar` varchar(255) NOT NULL DEFAULT '../asset/img/defaultlogo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `USER`
--

INSERT INTO `USER` (`ID`, `Name`, `Username`, `Email`, `Password`, `Role`, `Phone`, `Avatar`) VALUES
(1, 'Nguyen Thi D', 'nguyend', 'nguyend@example.com', 'password123', 2, '0987654321', 'https://'),
(2, 'Nguyen Thi C', 'nguyend', 'nguyen@example.com', 'password123', 2, '0987654322', 'https://'),
(3, 'Nguyen Thi E', 'nguyend', 'nguyene@example.com', 'password123', 2, '0987654323', 'https://'),
(4, 'Thai Tuan', 'tuan', 'tuanthai902@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, '0376214140', '../asset/img/defaultlogo.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `DISTRICTS`
--
ALTER TABLE `DISTRICTS`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `Motel`
--
ALTER TABLE `Motel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `district_id` (`district_id`);

--
-- Chỉ mục cho bảng `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `DISTRICTS`
--
ALTER TABLE `DISTRICTS`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `Motel`
--
ALTER TABLE `Motel`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `USER`
--
ALTER TABLE `USER`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `Motel`
--
ALTER TABLE `Motel`
  ADD CONSTRAINT `Motel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `USER` (`ID`),
  ADD CONSTRAINT `Motel_ibfk_2` FOREIGN KEY (`district_id`) REFERENCES `DISTRICTS` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
