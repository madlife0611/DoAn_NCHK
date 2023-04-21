-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 21, 2023 lúc 08:12 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mvc_qlvattu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `matk` int(11) NOT NULL,
  `hoten` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `sdt` varchar(13) NOT NULL,
  `diachi` varchar(500) NOT NULL,
  `mapb` int(11) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`matk`, `hoten`, `email`, `sdt`, `diachi`, `mapb`, `photo`, `password`, `isAdmin`) VALUES
(2, 'Nguyễn Văn A', 'nva@gmail.com', '0123456789', 'Xuân Trường, Nam Định', 1, 'user2.jpg', '202cb962ac59075b964b07152d234b70', 0),
(3, 'Phạm Đức Minh', 'admin@gmail.com', '0123456789', 'Xuân Trường, Nam Định', 1, 'user1.jpg', '202cb962ac59075b964b07152d234b70', 1),
(7, 'Pham Minh', 'test1121@gmail.com', '09999999999', 'hà nội', 2, 'user4.jpg', 'e10adc3949ba59abbe56e057f20f883e', 1),
(10, 'test', 'test@gmail.com', '12312412', 'test', 2, '1682012277_user5-128x128.jpg', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `madm` int(11) NOT NULL,
  `tendm` varchar(500) NOT NULL,
  `mota` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`madm`, `tendm`, `mota`) VALUES
(1, 'Nhóm 1', 'Bông, dung dịch sát khuẩn, rửa vết thương'),
(2, 'Nhóm 2', 'Băng, gạc, vật liệu cầm máu, điều trị vết thương'),
(3, 'Nhóm 3', 'Bơm, kim tiêm, dây truyền, găng tay và vật tư y tế sử dụng trong chăm sóc người bệnh'),
(4, 'Nhóm 4', 'Ống thông, ống dẫn lưu, ống nối, dây nối, chạc nối, catheter'),
(5, 'Nhóm 5', 'Kim khâu, chỉ khâu, dao phẫu thuật'),
(6, 'Nhóm 6', 'Vật liệu thay thế, vật liệu cấy ghép nhân tạo'),
(7, 'Nhóm 7', 'Vật tư y tế sử dụng trong một số chuyên khoa'),
(8, 'Nhóm 8', 'Vật tư y tế sử dụng trong chẩn đoán, điều trị khác'),
(9, 'Nhóm 9', 'Các loại vật tư y tế thay thế sử dụng trong một số thiết bị chẩn đoán, điều trị'),
(10, 'Nhóm 10', 'Các Vật tư y tế khác chưa có trong 9 nhóm của TT 04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `changelog`
--

CREATE TABLE `changelog` (
  `macl` int(11) NOT NULL,
  `tenbang` varchar(500) NOT NULL,
  `thoigian` datetime NOT NULL,
  `dulieucu` varchar(500) NOT NULL,
  `dulieumoi` varchar(500) NOT NULL,
  `matk` varchar(500) NOT NULL,
  `trangthaithaydoi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `changelog`
--

INSERT INTO `changelog` (`macl`, `tenbang`, `thoigian`, `dulieucu`, `dulieumoi`, `matk`, `trangthaithaydoi`) VALUES
(1, 'suppliers', '2023-04-19 16:06:01', '{\"mancc\":\"2\",\"tenncc\":\"Công ty TNHH Thiết bị Y tế Sóng Mới\",\"diachi\":\"số 53, phường Cổ Nhuế, Quận Bắc Từ Liêm, TP.Hà Nội\",\"sdt\":\"0121311313\",\"email\":\"newwave2008@gmail.com\"}', '{\"mancc\":\"2\",\"tenncc\":\"Công ty TNHH Thiết bị Y tế Sóng Mới\",\"diachi\":\"số 55, phường Cổ Nhuế, Quận Bắc Từ Liêm, TP.Hà Nội\",\"sdt\":\"0121311313\",\"email\":\"newwave2009@gmail.com\"}', '1', 'update'),
(2, 'suppliers', '2023-04-19 16:16:04', '[]', '{\"tenncc\":\"test\",\"diachi\":\"Nam Định\",\"sdt\":\"01121111111\",\"email\":\"test@gmail.com\"}', '1', 'create'),
(3, 'suppliers', '2023-04-19 16:17:07', '{\"mancc\":\"12\",\"tenncc\":\"test\",\"diachi\":\"Nam Định\",\"sdt\":\"01121111111\",\"email\":\"test@gmail.com\"}', '[]', '1', 'delete'),
(4, 'accounts', '2023-04-19 17:18:54', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn Abc\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nva@gmail.com\",\"isAdmin\":0,\"mapb\":null,\"anhdaidien\":null}', '1', 'update'),
(5, 'accounts', '2023-04-19 17:19:57', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn Abd\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nva@gmail.com\",\"isAdmin\":0,\"mapb\":null,\"anhdaidien\":null}', '1', 'update'),
(6, 'accounts', '2023-04-19 17:20:08', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nva@gmail.com\",\"isAdmin\":0,\"mapb\":null,\"anhdaidien\":null}', '1', 'update'),
(7, 'accounts', '2023-04-19 17:20:31', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"0\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Acd\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nva@gmail.com\",\"isAdmin\":0,\"mapb\":null,\"anhdaidien\":null}', '1', 'update'),
(8, 'accounts', '2023-04-19 17:20:54', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Acd\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"0\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nva@gmail.com\",\"isAdmin\":0,\"mapb\":null,\"anhdaidien\":null}', '1', 'update'),
(9, 'accounts', '2023-04-19 17:21:07', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"0\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nvaa@gmail.com\",\"isAdmin\":0,\"mapb\":null,\"anhdaidien\":null}', '1', 'update'),
(10, 'accounts', '2023-04-19 17:21:18', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"email\":\"nvaa@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"0\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nvaa@gmail.com\",\"isAdmin\":0,\"mapb\":null,\"anhdaidien\":null}', '1', 'update'),
(11, 'accounts', '2023-04-19 17:23:00', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"email\":\"nvaa@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"0\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nvaa@gmail.com\",\"isAdmin\":0,\"mapb\":\"1\",\"anhdaidien\":null}', '1', 'update'),
(12, 'accounts', '2023-04-19 17:23:27', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn Abc\",\"email\":\"nvaa@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"diachi\":\"Xuân Trường, Nam Định\",\"sdt\":\"0123456789\",\"email\":\"nvb@gmail.com\",\"isAdmin\":0,\"mapb\":\"2\",\"anhdaidien\":null}', '1', 'update'),
(13, 'accounts', '2023-04-19 17:26:52', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"isAdmin\":0,\"mapb\":\"2\",\"anhdaidien\":null}', '1', 'update'),
(14, 'accounts', '2023-04-19 17:28:22', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":null,\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(15, 'accounts', '2023-04-19 17:32:14', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":null,\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '1', 'update'),
(16, 'accounts', '2023-04-19 17:32:32', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":null,\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(17, 'accounts', '2023-04-19 17:33:55', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"81dc9bdb52d04dc20036dbd8313ed055\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"81dc9bdb52d04dc20036dbd8313ed055\",\"isAdmin\":0}', '1', 'update'),
(18, 'accounts', '2023-04-19 17:39:54', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn B\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"81dc9bdb52d04dc20036dbd8313ed055\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '1', 'update'),
(19, 'accounts', '2023-04-19 17:45:48', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(20, 'accounts', '2023-04-19 17:46:08', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(21, 'accounts', '2023-04-19 17:50:36', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(22, 'accounts', '2023-04-19 17:54:42', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(23, 'accounts', '2023-04-19 17:55:41', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(24, 'accounts', '2023-04-19 17:57:40', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(25, 'accounts', '2023-04-19 18:02:13', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(26, 'accounts', '2023-04-19 18:04:44', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(27, 'accounts', '2023-04-19 18:04:57', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(28, 'accounts', '2023-04-19 18:11:01', '[]', '{\"hoten\":\"Pham Minh\",\"email\":\"phamminh@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":1}', '1', 'create'),
(29, 'accounts', '2023-04-19 18:12:33', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '1', 'update'),
(30, 'accounts', '2023-04-19 18:31:29', '[]', '{\"hoten\":\"test\",\"email\":\"test1@gmail.com\",\"sdt\":\"121221212\",\"diachi\":\"1122112\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '1', 'create'),
(31, 'accounts', '2023-04-19 18:35:12', '[]', '{\"hoten\":\"test\",\"email\":\"test@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '1', 'create'),
(32, 'accounts', '2023-04-19 18:40:01', '{\"matk\":\"6\",\"hoten\":\"test\",\"email\":\"test@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '[]', '1', 'delete'),
(33, 'accounts', '2023-04-19 18:40:05', '{\"matk\":\"5\",\"hoten\":\"test\",\"email\":\"test1@gmail.com\",\"sdt\":\"121221212\",\"diachi\":\"1122112\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '[]', '1', 'delete'),
(34, 'accounts', '2023-04-19 18:41:23', '[]', '{\"hoten\":\"Pham Minh\",\"email\":\"test1121@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"hà nội\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'create'),
(35, 'accounts', '2023-04-19 18:42:08', '{\"matk\":\"4\",\"hoten\":\"Pham Minh\",\"email\":\"phamminh@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"1\"}', '{\"matk\":\"4\",\"hoten\":\"Pham Minh\",\"email\":\"phamminh@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":0}', '3', 'update'),
(36, 'accounts', '2023-04-19 18:42:24', '{\"matk\":\"7\",\"hoten\":\"Pham Minh\",\"email\":\"test1121@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"hà nội\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"7\",\"hoten\":\"Pham Minh\",\"email\":\"test1121@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"hà nội\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"isAdmin\":1}', '3', 'update'),
(37, 'accounts', '2023-04-19 18:45:36', '{\"matk\":\"7\",\"hoten\":\"Pham Minh\",\"email\":\"test1121@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"hà nội\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"isAdmin\":\"1\"}', '{\"matk\":\"7\",\"hoten\":\"Pham Minh\",\"email\":\"test1121@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"hà nội\",\"mapb\":\"2\",\"anhdaidien\":\"\",\"password\":\"\",\"isAdmin\":1}', '3', 'update'),
(38, 'accounts', '2023-04-19 18:45:42', '{\"matk\":\"1\",\"hoten\":\"Nguyễn Văn BD\",\"email\":\"nvb@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"2\",\"anhdaidien\":\"user1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '[]', '3', 'delete'),
(39, 'accounts', '2023-04-19 18:48:22', '{\"matk\":\"4\",\"hoten\":\"Pham Minh\",\"email\":\"phamminh@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user3.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '[]', '3', 'delete'),
(40, 'accounts', '2023-04-19 18:54:44', '[]', '{\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'create'),
(41, 'accounts', '2023-04-19 18:54:58', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(42, 'accounts', '2023-04-19 18:56:15', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(43, 'accounts', '2023-04-19 18:56:39', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(44, 'accounts', '2023-04-19 18:59:02', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(45, 'accounts', '2023-04-19 19:00:14', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(46, 'accounts', '2023-04-19 19:01:22', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(47, 'accounts', '2023-04-19 19:07:28', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(48, 'accounts', '2023-04-19 19:08:09', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(49, 'accounts', '2023-04-19 19:08:17', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(50, 'accounts', '2023-04-19 19:21:32', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(51, 'accounts', '2023-04-19 19:23:03', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(52, 'accounts', '2023-04-19 19:23:13', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"anhdaidien\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(53, 'accounts', '2023-04-19 19:34:18', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"photo\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"photo\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(54, 'accounts', '2023-04-19 19:34:29', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"photo\":\"user2.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"2\",\"hoten\":\"Nguyễn Văn A\",\"email\":\"nva@gmail.com\",\"sdt\":\"0123456789\",\"diachi\":\"Xuân Trường, Nam Định\",\"mapb\":\"1\",\"photo\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(55, 'accounts', '2023-04-19 19:34:52', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"photo\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"photo\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'update'),
(56, 'accounts', '2023-04-19 19:34:58', '{\"matk\":\"8\",\"hoten\":\"Pham Minh\",\"email\":\"nva@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"Hà Nội\",\"mapb\":\"1\",\"photo\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '[]', '3', 'delete'),
(57, 'accounts', '2023-04-19 19:35:07', '{\"matk\":\"7\",\"hoten\":\"Pham Minh\",\"email\":\"test1121@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"hà nội\",\"mapb\":\"2\",\"photo\":\"user4.jpg\",\"password\":\"e10adc3949ba59abbe56e057f20f883e\",\"isAdmin\":\"1\"}', '{\"matk\":\"7\",\"hoten\":\"Pham Minh\",\"email\":\"test1121@gmail.com\",\"sdt\":\"09999999999\",\"diachi\":\"hà nội\",\"mapb\":\"2\",\"photo\":\"\",\"password\":\"\",\"isAdmin\":1}', '3', 'update'),
(58, 'accounts', '2023-04-20 09:14:26', '[]', '{\"hoten\":\"test\",\"email\":\"test@gmail.com\",\"sdt\":\"0987654322\",\"diachi\":\"Vĩnh Phúc\",\"mapb\":\"2\",\"photo\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'create'),
(59, 'accounts', '2023-04-20 09:14:33', '{\"matk\":\"9\",\"hoten\":\"test\",\"email\":\"test@gmail.com\",\"sdt\":\"0987654322\",\"diachi\":\"Vĩnh Phúc\",\"mapb\":\"2\",\"photo\":\"\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '[]', '3', 'delete'),
(60, 'categories', '2023-04-20 09:31:04', '[]', '{\"mota\":\"Cái này để test thôi\",\"tendm\":\"Nhóm 11\"}', '3', 'create'),
(61, 'categories', '2023-04-20 09:35:07', '[]', '{\"mota\":\"Cái này để test thôi\",\"tendm\":\"Nhóm 11\"}', '3', 'create'),
(62, 'categories', '2023-04-20 09:35:13', '{\"madm\":\"12\",\"tendm\":\"Nhóm 11\",\"mota\":\"Cái này để test thôi\"}', '[]', '3', 'delete'),
(63, 'categories', '2023-04-20 09:37:07', '[]', '{\"mota\":\"Cái này để test thôi\",\"tendm\":\"Nhóm 11\"}', '3', 'create'),
(64, 'categories', '2023-04-20 09:37:19', '{\"madm\":\"13\",\"tendm\":\"Nhóm 11\",\"mota\":\"Cái này để test thôi\"}', '{\"madm\":\"13\",\"mota\":\"Cái này để test thôi 111111\",\"tendm\":\"Nhóm 12\"}', '3', 'update'),
(65, 'categories', '2023-04-20 09:37:31', '{\"madm\":\"13\",\"tendm\":\"Nhóm 12\",\"mota\":\"Cái này để test thôi 111111\"}', '[]', '3', 'delete'),
(66, 'products', '2023-04-20 19:00:37', '[]', '{\"tensp\":\"test 112122\",\"madm\":\"1\",\"mancc\":\"1\",\"mota\":\"Cái này để test thôi 1111111111111111111111111\",\"trangthai\":\"1\",\"gianhap\":\"12222\",\"hanbaotri\":\"2023-05-28\",\"solansudung\":0,\"tansuatsudung\":0,\"ngaynhap\":\"2023-04-23\",\"anhsp\":\"\"}', '3', 'create'),
(67, 'products', '2023-04-20 19:10:06', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"macty\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test 112122\",\"madm\":\"1\",\"mancc\":\"1\",\"mota\":\"Cái này để test thôi 111111\",\"trangthai\":\"1\",\"gianhap\":\"2222222222222\",\"hanbaotri\":\"2023-07-31\",\"ngaynhap\":\"2022-12-09\"}', '3', 'update'),
(68, 'products', '2023-04-20 19:13:22', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"macty\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test 112122\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"trangthai\":\"1\",\"madm\":\"1\",\"mancc\":\"1\"}', '3', 'update'),
(69, 'products', '2023-04-20 19:15:04', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"macty\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test 112122\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"trangthai\":\"1\",\"madm\":\"1\",\"mancc\":\"1\",\"anhsp\":\"\"}', '3', 'update'),
(70, 'products', '2023-04-20 19:17:25', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"macty\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test 112122\",\"anhsp\":\"\",\"mota\":\"Cái này để test thôi 1111111111111111111111111\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"3\",\"madm\":\"1\",\"mancc\":\"1\"}', '3', 'update'),
(71, 'products', '2023-04-20 19:26:27', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"macty\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test 112122\",\"anhsp\":null,\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"1\",\"madm\":\"1\",\"mancc\":\"1\"}', '3', 'update'),
(72, 'products', '2023-04-20 19:30:35', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"macty\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test 112122\",\"anhsp\":\"\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"3\",\"madm\":\"1\",\"mancc\":\"1\"}', '3', 'update'),
(73, 'accounts', '2023-04-20 19:36:36', '[]', '{\"hoten\":\"test\",\"email\":\"test@gmail.com\",\"sdt\":\"12312412\",\"diachi\":\"test\",\"mapb\":\"2\",\"photo\":\"prod-1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":0}', '3', 'create'),
(74, 'accounts', '2023-04-20 19:37:57', '{\"matk\":\"10\",\"hoten\":\"test\",\"email\":\"test@gmail.com\",\"sdt\":\"12312412\",\"diachi\":\"test\",\"mapb\":\"2\",\"photo\":\"prod-1.jpg\",\"password\":\"202cb962ac59075b964b07152d234b70\",\"isAdmin\":\"0\"}', '{\"matk\":\"10\",\"hoten\":\"test\",\"email\":\"test@gmail.com\",\"sdt\":\"12312412\",\"diachi\":\"test\",\"mapb\":\"2\",\"photo\":\"1682012277_user5-128x128.jpg\",\"password\":\"\",\"isAdmin\":0}', '3', 'update'),
(75, 'products', '2023-04-20 19:38:18', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"macty\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"prod-2.jpg\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"0\",\"madm\":\"1\",\"mancc\":\"1\"}', '3', 'update'),
(76, 'products', '2023-04-20 19:39:28', '[]', '{\"tensp\":\"test\",\"madm\":\"1\",\"mancc\":\"1\",\"mota\":\"Cái này để test thôi\",\"trangthai\":\"1\",\"gianhap\":\"2222222222222\",\"hanbaotri\":\"2023-04-30\",\"solansudung\":0,\"tansuatsudung\":0,\"ngaynhap\":\"2023-04-23\",\"anhsp\":\"avatar.png\"}', '3', 'create'),
(77, 'products', '2023-04-20 19:53:12', '[]', '{\"tensp\":\"test 112122\",\"anhsp\":\"avatar.png\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"2222222222222\",\"ngaynhap\":\"2023-04-30\",\"hanbaotri\":\"2023-06-30\",\"solansudung\":0,\"tansuatsudung\":0,\"trangthai\":\"1\",\"madm\":\"2\",\"mancc\":\"1\"}', '3', 'create'),
(78, 'products', '2023-04-20 20:02:11', '[]', '{\"tensp\":\"test 112122\",\"anhsp\":\"avatar5.png\",\"mota\":\"Cái này để test thôi 1111111111111111111111111\",\"soluong\":\"1\",\"gianhap\":\"12222\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"solansudung\":0,\"tansuatsudung\":0,\"trangthai\":\"1\",\"madm\":\"10\",\"mancc\":\"2\"}', '3', 'create'),
(79, 'products', '2023-04-20 20:04:50', '[]', '{\"tensp\":\"test 112122\",\"anhsp\":\"avatar.png\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"solansudung\":0,\"tansuatsudung\":0,\"trangthai\":\"1\",\"madm\":\"10\",\"mancc\":\"2\"}', '3', 'create'),
(80, 'products', '2023-04-20 20:05:10', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"avatar.png\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"1\",\"madm\":\"10\",\"mancc\":\"2\"}', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"boxed-bg.jpg\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"1\",\"madm\":\"1\",\"mancc\":\"2\"}', '3', 'update'),
(81, 'products', '2023-04-20 20:05:21', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"boxed-bg.jpg\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"1\",\"madm\":\"1\",\"mancc\":\"2\"}', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"3\",\"madm\":\"1\",\"mancc\":\"2\"}', '3', 'update'),
(82, 'products', '2023-04-20 20:07:55', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"3\",\"madm\":\"1\",\"mancc\":\"2\"}', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"avatar.png\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"0\",\"madm\":\"1\",\"mancc\":\"2\"}', '3', 'update'),
(83, 'products', '2023-04-20 20:08:02', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"avatar.png\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"mancc\":\"2\"}', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"0\",\"madm\":\"9\",\"mancc\":\"2\"}', '3', 'update'),
(84, 'products', '2023-04-20 20:08:09', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"avatar.png\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"9\",\"mancc\":\"2\"}', '{\"masp\":\"60\",\"tensp\":\"test 112122\",\"anhsp\":\"\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"1\",\"gianhap\":\"20000\",\"ngaynhap\":\"2023-04-21\",\"hanbaotri\":\"2023-04-30\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"3\",\"madm\":\"9\",\"mancc\":\"2\"}', '3', 'update'),
(85, 'products', '2023-04-20 20:10:36', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"m6.JPG\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":\"0\",\"solansudung\":\"0\",\"trangthai\":\"0\",\"madm\":\"1\",\"mancc\":\"1\"}', '{\"masp\":\"58\",\"tensp\":\"test\",\"anhsp\":\"prod-1.jpg\",\"mota\":\"Cái này để test thôi\",\"soluong\":\"0\",\"gianhap\":\"22222\",\"ngaynhap\":\"2022-12-09\",\"hanbaotri\":\"2023-07-31\",\"tansuatsudung\":null,\"solansudung\":null,\"trangthai\":\"0\",\"madm\":\"1\",\"mancc\":\"1\"}', '3', 'update');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

CREATE TABLE `departments` (
  `mapb` int(11) NOT NULL,
  `tenpb` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `departments`
--

INSERT INTO `departments` (`mapb`, `tenpb`) VALUES
(1, 'Kho vật tư'),
(2, 'Phòng 101');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `masp` int(11) NOT NULL,
  `tensp` varchar(500) NOT NULL,
  `anhsp` varchar(500) NOT NULL,
  `mota` varchar(500) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gianhap` int(11) NOT NULL,
  `ngaynhap` date NOT NULL,
  `hanbaotri` date NOT NULL,
  `tansuatsudung` float NOT NULL,
  `solansudung` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `loaisp` int(11) NOT NULL,
  `madm` int(11) NOT NULL,
  `mancc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`masp`, `tensp`, `anhsp`, `mota`, `soluong`, `gianhap`, `ngaynhap`, `hanbaotri`, `tansuatsudung`, `solansudung`, `trangthai`, `loaisp`, `madm`, `mancc`) VALUES
(1, 'Bông y tế', 'b1.PNG', '100gr', 100, 2000, '2022-10-28', '2023-07-31', 10, 1, 1, 1, 1, 1),
(7, 'Bông viên', 'b2.PNG', '50gr', 100, 1000, '2022-11-21', '2023-08-31', 10, 1, 3, 1, 1, 1),
(8, 'Băng thun y tế', 'b3.PNG', 'Size: 0,1m x 3m', 100, 3000, '2022-11-21', '2023-07-21', 8, 1, 2, 1, 1, 1),
(9, 'Băng AID FIRST', 'b4.PNG', 'Hộp 100 cái', 100, 20000, '2022-11-21', '2023-06-30', 0, 1, 1, 1, 1, 2),
(10, 'Bông Bạch Tuyết', 'b5.png', 'W: 500g', 100, 5000, '2022-11-01', '2023-05-31', 0, 1, 0, 1, 1, 3),
(11, 'Bông bạch tuyết', 'b6.PNG', 'W: 25g', 100, 1000, '2022-11-16', '2023-03-31', 0, 0, 0, 1, 1, 3),
(12, 'Bông y tế cắt miếng', 'b7.PNG', 'Size: 7cm x 7cm \r\nTrọng lượng: 1kg', 100, 15000, '2021-11-01', '2023-07-16', 0, 0, 0, 1, 1, 4),
(13, 'Bông tẩm cồn', 'b8.PNG', 'Hộp 100 cái', 100, 25000, '2022-01-02', '2023-09-30', 0, 1, 0, 1, 1, 4),
(14, 'Dung dịch sát khuẩn CLINCARE', 'k1.PNG', '50ml', 100, 2000, '2022-05-21', '2023-07-31', 0, 0, 0, 1, 1, 2),
(15, 'Rửa vết thương BETADINE', 'k2.PNG', '125ml', 100, 2500, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 1, 2),
(16, 'Cồn 75 độ', 'k3.PNG', '100ml', 100, 2000, '2022-12-09', '2023-07-31', 0, 0, 1, 1, 1, 0),
(17, 'Dung dịch cồn khử khuẩn tay', 'k4.PNG', '500ml', 100, 10000, '2022-09-12', '2023-07-31', 0, 0, 0, 1, 1, 1),
(18, 'Bình xịt khử trùng', 'k5.PNG', '650ml', 100, 10000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 1, 2),
(19, 'Multidex Bột', 'n21.PNG', '45grams', 100, 12000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 2, 1),
(20, 'Băng UGO tanna', 'n22.PNG', '1,25cm x 4m', 100, 3000, '2022-01-11', '2023-07-31', 0, 0, 0, 1, 2, 1),
(21, 'Gạc UrgoTul', 'n23.PNG', '10cm x 10cm', 100, 1000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 2, 2),
(22, 'Gạc vết thương', 'n24.PNG', 'Miếng to', 100, 1000, '2018-11-21', '2023-07-31', 0, 0, 0, 1, 2, 1),
(23, 'Gạc miếng loại to', 'n25.PNG', '1kg', 100, 20000, '2019-01-02', '2023-07-31', 0, 0, 0, 1, 2, 4),
(24, 'Gạc cuộn', 'n26.PNG', '5m x 10cm', 100, 5000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 2, 3),
(25, 'Găng tay y tế', 'n28.PNG', 'Cao su non', 100, 1000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 2, 2),
(26, 'Sát trùng Povidine', 's1.PNG', '20ml', 100, 2000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 1, 2),
(27, 'Lọ xịt Nacurgo', 's2.PNG', 'Sát khuẩn, tái tạo ra', 100, 10000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 1, 2),
(28, 'Sát trùng Dettol', 's3.PNG', 'Sát trùng diệt khuẩn', 100, 5000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 1, 1),
(29, 'Cồn sát trùng', 's4.PNG', '100ml', 100, 2000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 1, 2),
(30, 'Kim tiêm', 't1.png', 'Loại nhỏ 2cc', 100, 500, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 3, 2),
(31, 'Bộ đồ y tế', 'v1.PNG', 'Đầy đủ quần áo, găng tay, khẩu trang', 100, 25000, '2022-11-21', '2023-07-31', 0, 1, 1, 1, 3, 2),
(32, 'Ống thông', 'v2.PNG', '1m', 100, 2000, '2022-11-21', '2023-07-31', 0, 1, 0, 1, 3, 2),
(33, 'Bộ dây truyền dịch', 'v3.PNG', '1 bộ', 100, 3000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 3, 1),
(34, 'Dây nịt', 'v4.PNG', 'Loại nhỏ', 100, 1000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 3, 2),
(35, 'Ống nghe', 'v5.PNG', 'Made in Japan', 100, 50000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 3, 2),
(36, 'Máy đo nhiệt', 'v6.PNG', 'Sử dụng pin', 100, 30000, '2022-11-21', '2023-07-31', 0, 0, 0, 3, 3, 3),
(37, 'Cố định cổ', 'v9.PNG', 'Màu trắng', 100, 10000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 3, 2),
(38, 'Trùm tóc', 'v8.PNG', 'Dùng 1 lần', 100, 500, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 3, 2),
(39, 'Ống thông', 'v7.PNG', 'Kim loại', 100, 10000, '2022-11-21', '2023-07-31', 0, 0, 0, 1, 3, 4),
(40, 'ỐNG DẪN NƯỚC TIỂU SONDE', '44.JPG', '2 nhánh', 25, 12000, '2022-12-08', '2023-07-31', 10, 1, 0, 2, 4, 2),
(41, 'Ống Nghe Y Tế Spirit', '41.JPG', '2 mặt', 25, 35000, '2022-12-08', '2023-07-31', 0, 0, 0, 2, 4, 4),
(42, 'Ống lưu trữ lạnh tế bào', '42.JPG', '5ml', 25, 1000, '2022-12-08', '2023-07-31', 10, 1, 0, 2, 4, 1),
(43, 'Dao phẫu thuật', '51.JPG', 'kèm cán', 25, 10000, '2022-12-08', '2023-11-30', 0, 0, 0, 2, 5, 3),
(44, 'Chỉ khâu y tế', '5.JPG', '10m', 25, 3000, '2022-12-08', '2023-07-31', 0, 0, 0, 2, 5, 2),
(45, 'Kim châm cứu', 'k1.JPG', '10 kim 1 gói', 25, 5000, '2022-12-08', '2023-07-31', 0, 0, 0, 2, 5, 1),
(46, 'Kẹp y tế', 'k2.JPG', '16cm', 25, 20000, '2022-12-08', '2023-07-31', 0, 100, 0, 2, 5, 4),
(47, 'Kéo cắt chỉ', 'k5.JPG', 'Loại nhỏ', 25, 10000, '2022-12-08', '2023-07-31', 0, 100, 0, 2, 5, 3),
(48, 'Kéo y tế', 'k4.JPG', 'Loại vừa', 25, 25000, '2022-12-08', '2023-07-31', 0, 200, 0, 2, 5, 0),
(49, 'Cốc y tế', '61.JPG', 'Inox 50ml', 25, 10000, '2022-12-08', '2023-07-31', 0, 0, 0, 2, 6, 2),
(50, 'Khay y tế', '62.JPG', 'inox 30x40cm', 25, 30000, '2022-12-08', '2023-07-31', 0, 0, 0, 2, 6, 3),
(51, 'Hộp đựng dụng cụ', '63.JPG', '30x40cm', 25, 20000, '2022-12-08', '2023-07-31', 0, 0, 0, 2, 6, 2),
(52, 'Máy nội soi tai mũi họng', 'm1.JPG', 'Japan', 1, 20000000, '2022-12-08', '2024-09-30', 0, 0, 0, 3, 10, 4),
(53, 'Máy siêu âm', 'm3.JPG', 'USA', 1, 35000000, '2022-12-08', '2024-07-31', 0, 0, 0, 3, 10, 1),
(54, 'Máy siêu âm S2', 'm4.JPG', 'Japan', 1, 30000000, '2022-12-08', '2024-07-31', 0, 0, 0, 3, 10, 2),
(55, 'Máy chụp X quang', 'm5.JPG', 'USA', 1, 40000000, '2022-12-08', '2024-05-31', 0, 0, 0, 3, 10, 2),
(56, 'Máy chụp cát lớp', 'm6.JPG', 'USA', 1, 100000000, '2022-12-08', '2024-06-30', 0, 0, 1, 3, 10, 2),
(58, 'test', 'prod-1.jpg', 'Cái này để test thôi', 100, 22222, '2022-12-09', '2023-07-31', 0, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `requestdetails`
--

CREATE TABLE `requestdetails` (
  `request_detail_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `gianhap` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `requestdetails`
--

INSERT INTO `requestdetails` (`request_detail_id`, `request_id`, `masp`, `soluong`, `gianhap`) VALUES
(1, 2, 25, 1, 1000),
(2, 2, 41, 1, 35000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `requests`
--

CREATE TABLE `requests` (
  `request_id` int(25) NOT NULL,
  `ngaylap` varchar(500) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL DEFAULT 0,
  `matk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `requests`
--

INSERT INTO `requests` (`request_id`, `ngaylap`, `tongtien`, `trangthai`, `matk`) VALUES
(1, '2023-04-22 00:31:30', 59444, 0, 2),
(2, '2023-04-22 00:32:51', 36000, 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `mancc` int(11) NOT NULL,
  `tenncc` varchar(500) NOT NULL,
  `diachi` varchar(500) NOT NULL,
  `sdt` varchar(13) NOT NULL,
  `email` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`mancc`, `tenncc`, `diachi`, `sdt`, `email`) VALUES
(1, 'Công ty TNHH Vật liệu y tế Bông Sen Vàng', 'số 15, Quận Tân Phú, TP.Hồ Chí Minh', '011111111', 'goldenlotus@gmail.com'),
(2, 'Công ty TNHH Thiết bị Y tế Sóng Mới', 'số 55, phường Cổ Nhuế, Quận Bắc Từ Liêm, TP.Hà Nội', '0121311313', 'newwave2009@gmail.com'),
(3, 'Công ty TNHH Tâm An', 'Số 11, Vũ Trọng Phụng, Quận Hoàn Kiếm, Hà Nội', '0123456891', 'TamanMedic@gmail.com'),
(4, 'Công ty TNHH Y Dược Tràng An', 'Số 125, Quận Bến Nghé, TP.Hồ Chí Minh', '08745568745', 'yduoctrangan@gmail.com'),
(5, 'Công ty TNHH 1 Thành Viên Tín Phát', 'số 111, Huỳnh Thúc Kháng, TP. Hà Nội', '0942651648616', 'tinphatmedic@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`matk`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`madm`);

--
-- Chỉ mục cho bảng `changelog`
--
ALTER TABLE `changelog`
  ADD PRIMARY KEY (`macl`);

--
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`mapb`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`masp`);

--
-- Chỉ mục cho bảng `requestdetails`
--
ALTER TABLE `requestdetails`
  ADD PRIMARY KEY (`request_detail_id`);

--
-- Chỉ mục cho bảng `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`mancc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `matk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `madm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `changelog`
--
ALTER TABLE `changelog`
  MODIFY `macl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `mapb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `masp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `requestdetails`
--
ALTER TABLE `requestdetails`
  MODIFY `request_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `mancc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
