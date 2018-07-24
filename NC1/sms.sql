-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 24, 2018 lúc 07:30 PM
-- Phiên bản máy phục vụ: 10.1.32-MariaDB
-- Phiên bản PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sms`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `port` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `datetime` datetime NOT NULL,
  `content` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `inbox`
--



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inbsent`
--

CREATE TABLE `inbsent` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `port` varchar(2) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `sender` text NOT NULL,
  `receiver` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `inbsent`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `recharge`
--

CREATE TABLE `recharge` (
  `id` int(3) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `history_recharge` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `recharge`
--



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rp_final`
--

CREATE TABLE `rp_final` (
  `id` int(11) NOT NULL,
  `id_user` int(2) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `date` varchar(20) DEFAULT NULL,
  `money` varchar(50) NOT NULL,
  `receiver` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `rp_final`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rp_inbox`
--

CREATE TABLE `rp_inbox` (
  `id` int(2) NOT NULL,
  `port` int(2) NOT NULL,
  `number` varchar(12) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rp_user`
--

CREATE TABLE `rp_user` (
  `id` int(11) NOT NULL,
  `id_user` int(5) NOT NULL,
  `phone` int(12) NOT NULL,
  `lastest_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `port` varchar(11) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sms`
--



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `port` varchar(2) NOT NULL,
  `number` varchar(12) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `system`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `token` varchar(5) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fund` int(5) NOT NULL,
  `fund_add` int(5) NOT NULL,
  `fund_result` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--



--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `inbsent`
--
ALTER TABLE `inbsent`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rp_final`
--
ALTER TABLE `rp_final`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rp_inbox`
--
ALTER TABLE `rp_inbox`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rp_user`
--
ALTER TABLE `rp_user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `inbox`
--


--
-- AUTO_INCREMENT cho bảng `inbsent`
--
ALTER TABLE `inbsent`
  
--
ALTER TABLE `rp_inbox`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `rp_user`
--
ALTER TABLE `rp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
