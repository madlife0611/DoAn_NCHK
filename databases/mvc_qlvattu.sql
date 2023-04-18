-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 18, 2023 lúc 06:59 PM
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
  `anhdaidien` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `isAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`matk`, `hoten`, `email`, `sdt`, `diachi`, `mapb`, `anhdaidien`, `password`, `isAdmin`) VALUES
(1, 'Phạm Đức Minh', 'admin@gmail.com', '0123456789', 'Xuân Trường, Nam Định', 1, 'user1.jpg', '202cb962ac59075b964b07152d234b70', 1),
(2, 'Nguyễn Văn A', 'nva@gmail.com', '0123456789', 'Xuân Trường, Nam Định', 1, 'user2.jpg', '202cb962ac59075b964b07152d234b70', 0);

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
(1, 'suppliers', '2023-04-18 18:44:30', '{\"mancc\":\"1\",\"tenncc\":\"Công ty TNHH Vật liệu y tế Bông Sen Vàng\",\"diachi\":\"số 15, Quận Tân Phú, TP.Hồ Chí Minh\",\"sdt\":\"01111111111\",\"email\":\"goldenlotus@gmail.com\"}', 'mã ncc: 1,tên ncc: Công ty TNHH Vật liệu y tế Bông Sen Vàng,địa chỉ: số 15, Quận Tân Phú, TP.Hồ Chí Minh,số đt 0222222222,email: goldenlotus@gmail.com ', '1', 'update');

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
  `ngaynhap` datetime NOT NULL,
  `hanbaotri` date NOT NULL,
  `solansudungtoida` int(11) NOT NULL,
  `solansudung` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `madm` int(11) NOT NULL,
  `macty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`masp`, `tensp`, `anhsp`, `mota`, `soluong`, `gianhap`, `ngaynhap`, `hanbaotri`, `solansudungtoida`, `solansudung`, `trangthai`, `madm`, `macty`) VALUES
(1, 'Bông y tế', 'b1.PNG', '100gr', 0, 2000, '2022-10-28 00:00:00', '0000-00-00', 100, 1, 1, 1, 1),
(7, 'Bông viên', 'b2.PNG', '50gr', 0, 1000, '2022-11-21 08:09:50', '0000-00-00', 100, 1, 0, 1, 1),
(8, 'Băng thun y tế', 'b3.PNG', 'Size: 0,1m x 3m', 0, 3000, '2022-11-21 08:09:50', '0000-00-00', 100, 1, 0, 1, 1),
(9, 'Băng AID FIRST', 'b4.PNG', 'Hộp 100 cái', 0, 20000, '2022-11-21 08:09:50', '0000-00-00', 0, 1, 0, 1, 2),
(10, 'Bông Bạch Tuyết', 'b5.png', 'W: 500g', 0, 5000, '2022-11-01 14:10:04', '0000-00-00', 0, 1, 0, 1, 3),
(11, 'Bông bạch tuyết', 'b6.PNG', 'W: 25g', 0, 1000, '2022-11-16 14:10:04', '0000-00-00', 0, 0, 0, 1, 3),
(12, 'Bông y tế cắt miếng', 'b7.PNG', 'Size: 7cm x 7cm \r\nTrọng lượng: 1kg', 0, 15000, '2021-11-01 08:17:26', '0000-00-00', 0, 0, 0, 1, 4),
(13, 'Bông tẩm cồn', 'b8.PNG', 'Hộp 100 cái', 0, 25000, '2022-01-02 08:17:26', '0000-00-00', 0, 1, 0, 1, 4),
(14, 'Dung dịch sát khuẩn CLINCARE', 'k1.PNG', '50ml', 0, 2000, '2022-05-21 08:17:26', '0000-00-00', 0, 0, 0, 1, 2),
(15, 'Rửa vết thương BETADINE', 'k2.PNG', '125ml', 0, 2500, '2022-11-21 08:17:26', '0000-00-00', 0, 0, 0, 1, 2),
(16, 'Cồn 75 độ', 'k3.PNG', '100ml', 0, 2000, '2022-12-09 03:33:00', '0000-00-00', 0, 0, 1, 1, 0),
(17, 'Dung dịch cồn khử khuẩn tay', 'k4.PNG', '500ml', 0, 10000, '2022-09-12 14:17:38', '0000-00-00', 0, 0, 0, 1, 1),
(18, 'Bình xịt khử trùng', 'k5.PNG', '650ml', 0, 10000, '2022-11-21 08:17:26', '0000-00-00', 0, 0, 0, 1, 2),
(19, 'Multidex Bột', 'n21.PNG', '45grams', 0, 12000, '2022-11-21 08:27:25', '0000-00-00', 0, 0, 0, 2, 1),
(20, 'Băng UGO tanna', 'n22.PNG', '1,25cm x 4m', 0, 3000, '2022-01-11 08:27:25', '0000-00-00', 0, 0, 0, 2, 1),
(21, 'Gạc UrgoTul', 'n23.PNG', '10cm x 10cm', 0, 1000, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 2, 2),
(22, 'Gạc vết thương', 'n24.PNG', 'Miếng to', 0, 1000, '2018-11-21 08:29:44', '0000-00-00', 0, 0, 0, 2, 1),
(23, 'Gạc miếng loại to', 'n25.PNG', '1kg', 0, 20000, '2019-01-02 08:29:44', '0000-00-00', 0, 0, 0, 2, 4),
(24, 'Gạc cuộn', 'n26.PNG', '5m x 10cm', 0, 5000, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 2, 3),
(25, 'Găng tay y tế', 'n28.PNG', 'Cao su non', 0, 1000, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 2, 2),
(26, 'Sát trùng Povidine', 's1.PNG', '20ml', 0, 2000, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 1, 2),
(27, 'Lọ xịt Nacurgo', 's2.PNG', 'Sát khuẩn, tái tạo ra', 0, 10000, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 1, 2),
(28, 'Sát trùng Dettol', 's3.PNG', 'Sát trùng diệt khuẩn', 0, 5000, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 1, 1),
(29, 'Cồn sát trùng', 's4.PNG', '100ml', 0, 2000, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 1, 2),
(30, 'Kim tiêm', 't1.png', 'Loại nhỏ 2cc', 0, 500, '2022-11-21 08:29:44', '0000-00-00', 0, 0, 0, 3, 2),
(31, 'Bộ đồ y tế', 'v1.PNG', 'Đầy đủ quần áo, găng tay, khẩu trang', 0, 25000, '2022-11-21 08:29:44', '0000-00-00', 0, 1, 1, 3, 2),
(32, 'Ống thông', 'v2.PNG', '1m', 0, 2000, '2022-11-21 08:29:44', '0000-00-00', 0, 1, 0, 3, 2),
(33, 'Bộ dây truyền dịch', 'v3.PNG', '1 bộ', 0, 3000, '2022-11-21 08:44:56', '0000-00-00', 0, 0, 0, 3, 1),
(34, 'Dây nịt', 'v4.PNG', 'Loại nhỏ', 0, 1000, '2022-11-21 08:44:56', '0000-00-00', 0, 0, 0, 3, 2),
(35, 'Ống nghe', 'v5.PNG', 'Made in Japan', 0, 50000, '2022-11-21 08:44:56', '0000-00-00', 0, 0, 0, 3, 2),
(36, 'Máy đo nhiệt', 'v6.PNG', 'Sử dụng pin', 0, 30000, '2022-11-21 08:44:56', '0000-00-00', 0, 0, 0, 3, 3),
(37, 'Cố định cổ', 'v9.PNG', 'Màu trắng', 0, 10000, '2022-11-21 08:44:56', '0000-00-00', 0, 0, 0, 3, 2),
(38, 'Trùm tóc', 'v8.PNG', 'Dùng 1 lần', 0, 500, '2022-11-21 08:44:56', '0000-00-00', 0, 0, 0, 3, 2),
(39, 'Ống thông', 'v7.PNG', 'Kim loại', 0, 10000, '2022-11-21 08:44:56', '0000-00-00', 0, 0, 0, 3, 4),
(40, 'ỐNG DẪN NƯỚC TIỂU SONDE', '44.JPG', '2 nhánh', 0, 12000, '2022-12-08 15:55:35', '0000-00-00', 10, 1, 0, 4, 2),
(41, 'Ống Nghe Y Tế Spirit', '41.JPG', '2 mặt', 0, 35000, '2022-12-08 15:55:35', '0000-00-00', 0, 0, 0, 4, 4),
(42, 'Ống lưu trữ lạnh tế bào', '42.JPG', '5ml', 0, 1000, '2022-12-08 16:02:30', '0000-00-00', 10, 1, 0, 4, 1),
(43, 'Dao phẫu thuật', '51.JPG', 'kèm cán', 0, 10000, '2022-12-08 16:15:22', '0000-00-00', 0, 0, 0, 5, 3),
(44, 'Chỉ khâu y tế', '5.JPG', '10m', 0, 3000, '2022-12-08 16:15:22', '0000-00-00', 0, 0, 0, 5, 2),
(45, 'Kim châm cứu', 'k1.JPG', '10 kim 1 gói', 0, 5000, '2022-12-08 16:15:22', '0000-00-00', 0, 0, 0, 5, 1),
(46, 'Kẹp y tế', 'k2.JPG', '16cm', 0, 20000, '2022-12-08 16:15:22', '0000-00-00', 0, 100, 0, 5, 4),
(47, 'Kéo cắt chỉ', 'k5.JPG', 'Loại nhỏ', 0, 10000, '2022-12-08 16:15:22', '0000-00-00', 0, 100, 0, 5, 3),
(48, 'Kéo y tế', 'k4.JPG', 'Loại vừa', 0, 25000, '2022-12-08 16:15:22', '0000-00-00', 0, 200, 0, 5, 0),
(49, 'Cốc y tế', '61.JPG', 'Inox 50ml', 0, 10000, '2022-12-08 16:30:26', '0000-00-00', 0, 0, 0, 6, 2),
(50, 'Khay y tế', '62.JPG', 'inox 30x40cm', 0, 30000, '2022-12-08 16:30:26', '0000-00-00', 0, 0, 0, 6, 3),
(51, 'Hộp đựng dụng cụ', '63.JPG', '30x40cm', 0, 20000, '2022-12-08 16:30:26', '0000-00-00', 0, 0, 0, 6, 2),
(52, 'Máy nội soi tai mũi họng', 'm1.JPG', 'Japan', 0, 20000000, '2022-12-08 16:44:37', '0000-00-00', 0, 0, 0, 10, 4),
(53, 'Máy siêu âm', 'm3.JPG', 'USA', 0, 35000000, '2022-12-08 16:44:37', '0000-00-00', 0, 0, 0, 10, 1),
(54, 'Máy siêu âm S2', 'm4.JPG', 'Japan', 0, 30000000, '2022-12-08 16:44:37', '0000-00-00', 0, 0, 0, 10, 2),
(55, 'Máy chụp X quang', 'm5.JPG', 'USA', 0, 40000000, '2022-12-08 16:44:37', '0000-00-00', 0, 0, 0, 10, 2),
(56, 'Máy chụp cát lớp', 'm6.JPG', 'USA', 0, 100000000, '2022-12-08 16:44:37', '0000-00-00', 0, 0, 1, 10, 2),
(58, 'test', 'm6.JPG', 'Cái này để test thôi', 0, 22222, '2022-12-09 22:49:00', '0000-00-00', 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `requestdetails`
--

CREATE TABLE `requestdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `requests`
--

CREATE TABLE `requests` (
  `id` int(25) NOT NULL,
  `date` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `manv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 'Công ty TNHH Vật liệu y tế Bông Sen Vàng', 'số 15, Quận Tân Phú, TP.Hồ Chí Minh', '0222222222', 'goldenlotus@gmail.com'),
(2, 'Công ty TNHH Thiết bị Y tế Sóng Mới', 'số 53, phường Cổ Nhuế, Quận Bắc Từ Liêm, TP.Hà Nội', '087552468', 'newwave2008@gmail.com'),
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
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `matk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `madm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `changelog`
--
ALTER TABLE `changelog`
  MODIFY `macl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `mapb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `masp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `requestdetails`
--
ALTER TABLE `requestdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `mancc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
