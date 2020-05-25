-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2019 lúc 04:33 PM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `canboquanly`
--

CREATE TABLE `canboquanly` (
  `mscb` int(11) NOT NULL,
  `nscb` date DEFAULT NULL,
  `gtcb` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qqcb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdt` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_khu` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `canboquanly`
--

INSERT INTO `canboquanly` (`mscb`, `nscb`, `gtcb`, `qqcb`, `sdt`, `email`, `id_khu`) VALUES
(1001, '1970-06-01', 'nu', 'Hà Nội', '0983774999', 'cb1@gmail.com', 1),
(1002, '1965-08-12', 'nam', 'Ha Noi', '0989666877', 'cb2@gmail.com', 2),
(1003, '1972-02-26', 'nam', 'Ha Noi', '0989123456', 'cb3@gmail.com', 3),
(1004, '1972-03-21', 'nu', 'Ha Noi', '0989123448', 'cb4@gmail.com', 1),
(1005, '1965-07-08', 'nam', 'Nam Định', '0988009999', 'hung123@gmail.com', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuktx`
--

CREATE TABLE `khuktx` (
  `id` int(11) NOT NULL,
  `tenkhu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `giaphong` int(11) NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuktx`
--

INSERT INTO `khuktx` (`id`, `tenkhu`, `giaphong`) VALUES
(1, 'B1', 400000),
(2, 'B2', 300000),
(3, 'B3', 200000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieudangky`
--

CREATE TABLE `phieudangky` (
  `id_phong` int(11) NOT NULL,
  `mssv` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nam` int(11) NOT NULL,
  `trangthaidk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaydk` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `lephi` int(11) NOT NULL,
  `mscb` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieudangky`
--

INSERT INTO `phieudangky` (`id_phong`, `mssv`, `name`, `nam`, `trangthaidk`, `ngaydk`, `updated_at`, `lephi`, `mscb`) VALUES
(1, 20160001, 'Sinh vien 1', 2019, 'success', '2019-07-08', '2019-07-08', 2400000, 1001),
(1, 20160003, 'Sinh vien 3', 2019, 'registered', '2019-07-09', NULL, 2400000, NULL),
(1, 20166256, 'hung', 2019, 'success', '2019-07-08', '2019-07-08', 2400000, 1001),
(6, 20171111, 'Trần Thu Huyền', 2019, 'success', '2019-07-08', '2019-07-08', 2400000, 1001);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id` int(11) NOT NULL,
  `sophong` int(11) NOT NULL,
  `id_khu` int(11) NOT NULL,
  `sncur` int(11) NOT NULL,
  `snmax` int(11) NOT NULL,
  `gioitinh` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id`, `sophong`, `id_khu`, `sncur`, `snmax`, `gioitinh`) VALUES
(1, 101, 1, 3, 3, 'nam'),
(2, 102, 1, 0, 3, 'nam'),
(3, 103, 1, 0, 3, 'nam'),
(4, 104, 1, 0, 3, 'nam'),
(5, 105, 1, 0, 3, 'nam'),
(6, 201, 1, 1, 3, 'nu'),
(7, 202, 1, 0, 3, 'nu'),
(8, 203, 1, 0, 3, 'nu'),
(9, 204, 1, 0, 3, 'nu'),
(10, 205, 1, 0, 3, 'nu'),
(11, 301, 1, 0, 3, 'nu'),
(12, 302, 1, 0, 3, 'nu'),
(13, 303, 1, 0, 3, 'nu'),
(14, 304, 1, 0, 3, 'nu'),
(15, 305, 1, 0, 3, 'nu'),
(16, 401, 1, 0, 3, 'nam'),
(17, 402, 1, 0, 3, 'nam'),
(18, 403, 1, 0, 3, 'nam'),
(19, 404, 1, 0, 3, 'nam'),
(20, 405, 1, 0, 3, 'nam'),
(21, 101, 2, 0, 4, 'nu'),
(22, 102, 2, 0, 4, 'nu'),
(23, 103, 2, 0, 4, 'nu'),
(24, 104, 2, 0, 4, 'nu'),
(25, 105, 2, 0, 4, 'nu'),
(26, 201, 2, 0, 4, 'nu'),
(27, 202, 2, 0, 4, 'nu'),
(28, 203, 2, 0, 4, 'nu'),
(29, 204, 2, 0, 4, 'nu'),
(30, 205, 2, 0, 4, 'nu'),
(31, 301, 2, 0, 4, 'nu'),
(32, 302, 2, 0, 4, 'nu'),
(33, 303, 2, 0, 4, 'nu'),
(34, 304, 2, 0, 4, 'nu'),
(35, 305, 2, 0, 4, 'nu'),
(36, 401, 2, 0, 4, 'nu'),
(37, 402, 2, 0, 4, 'nu'),
(38, 403, 2, 0, 4, 'nu'),
(39, 404, 2, 0, 4, 'nu'),
(40, 405, 2, 0, 4, 'nu'),
(41, 101, 3, 0, 6, 'nam'),
(42, 102, 3, 0, 6, 'nam'),
(43, 103, 3, 0, 6, 'nam'),
(44, 104, 3, 0, 6, 'nam'),
(45, 105, 3, 0, 6, 'nam'),
(46, 201, 3, 0, 6, 'nam'),
(47, 202, 3, 0, 6, 'nam'),
(48, 203, 3, 0, 6, 'nam'),
(49, 204, 3, 0, 6, 'nam'),
(50, 205, 3, 0, 6, 'nam'),
(51, 301, 3, 0, 6, 'nam'),
(52, 302, 3, 0, 6, 'nam'),
(53, 303, 3, 0, 6, 'nam'),
(54, 304, 3, 0, 6, 'nam'),
(55, 305, 3, 0, 6, 'nam'),
(56, 401, 3, 0, 6, 'nam'),
(57, 402, 3, 0, 6, 'nam'),
(58, 403, 3, 0, 6, 'nam'),
(59, 404, 3, 0, 6, 'nam'),
(60, 405, 3, 0, 6, 'nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `mssv` int(11) NOT NULL,
  `nssv` date DEFAULT NULL,
  `gtsv` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khoa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qqsv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`mssv`, `nssv`, `gtsv`, `lop`, `khoa`, `qqsv`, `email`, `sdt`) VALUES
(20160001, '1998-01-01', 'nam', 'CNTT', 'k61', 'Hà Nội', 'sv1@gmail.com', '0300000001'),
(20160002, '1998-01-01', 'nam', 'CNTT-k61', NULL, 'Ha Noi', 'sv2@gmail.com', '0300000002'),
(20160003, '1998-01-01', 'nam', 'CNTT-k61', 'k61', 'Hà Nội', 'sv3@gmail.com', '0300000003'),
(20160004, '1998-01-01', 'nam', 'CNTT-k61', NULL, 'Ha Noi', 'sv4@gmail.com', '0300000004'),
(20160005, '1998-01-01', 'nam', 'CNTT-k61', NULL, 'Ha Noi', 'sv5@gmail.com', '0300000005'),
(20166256, '1998-08-28', 'nam', 'CNTT', 'k61', 'Quảng Ninh', 'hung@gmail.com', '0333987789'),
(20171111, '1999-08-09', 'nu', 'KTHH', 'k61', 'Quảng Ninh', 'huyen@gmail.com', '11111111111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ltk` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `ltk`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Thu Hà', 'cb1@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(2, 'Nguyễn Văn Nam', 'cb2@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(3, 'Lê Thanh Bình', 'cb3@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(4, 'Bùi Thị Thu', 'cb4@gmail.com', 'user.jpg', 'quanly', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(5, 'admin', 'admin@gmail.com', 'user.jpg', 'admin', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(6, 'hung', 'hung@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, '2019-07-08 02:53:18', '2019-07-08 03:28:59'),
(7, 'Sinh vien 1', 'sv1@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(8, 'Sinh vien 2', 'sv2@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(9, 'Sinh vien 3', 'sv3@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(10, 'Sinh vien 4', 'sv4@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(11, 'Sinh vien 5', 'sv5@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$8Pxb7kZemFjFdIOTxUjaBOXc8ap0oE4Rlaj5A7U6CQXR5GLXysF8a', NULL, NULL, NULL),
(12, 'Trần Thu Huyền', 'huyen@gmail.com', 'user.jpg', 'sinhvien', NULL, '$2y$10$cEDLdFzpJXSaj7HI0HC.eeZY5rxyfF/RFREFBrrwU4VZRfscX6bFO', NULL, '2019-07-08 03:58:56', '2019-07-08 03:58:56');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `canboquanly`
--
ALTER TABLE `canboquanly`
  ADD PRIMARY KEY (`mscb`),
  ADD KEY `fk_c_k` (`id_khu`);

--
-- Chỉ mục cho bảng `khuktx`
--
ALTER TABLE `khuktx`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `phieudangky`
--
ALTER TABLE `phieudangky`
  ADD PRIMARY KEY (`id_phong`,`mssv`,`nam`),
  ADD KEY `fk_pdk_s` (`mssv`),
  ADD KEY `fk_pdk_c` (`mscb`),
  ADD KEY `fk_pdk_p` (`id_phong`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_p_k` (`id_khu`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`mssv`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `canboquanly`
--
ALTER TABLE `canboquanly`
  ADD CONSTRAINT `fk_c_k` FOREIGN KEY (`id_khu`) REFERENCES `khuktx` (`id`);

--
-- Các ràng buộc cho bảng `phieudangky`
--
ALTER TABLE `phieudangky`
  ADD CONSTRAINT `fk_pdk_c` FOREIGN KEY (`mscb`) REFERENCES `canboquanly` (`mscb`),
  ADD CONSTRAINT `fk_pdk_p` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id`),
  ADD CONSTRAINT `fk_pdk_s` FOREIGN KEY (`mssv`) REFERENCES `sinhvien` (`mssv`);

--
-- Các ràng buộc cho bảng `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `fk_p_k` FOREIGN KEY (`id_khu`) REFERENCES `khuktx` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
