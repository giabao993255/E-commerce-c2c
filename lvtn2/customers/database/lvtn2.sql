-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 09, 2022 lúc 12:00 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lvtn2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `MADANHGIA` int(11) NOT NULL,
  `MASANPHAM` varchar(100) NOT NULL,
  `TAIKHOAN` varchar(100) NOT NULL,
  `DIEMDANHGIA` int(11) NOT NULL,
  `NOIDUNG` text NOT NULL,
  `THOIGIANDANHGIA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danhgia`
--

INSERT INTO `danhgia` (`MADANHGIA`, `MASANPHAM`, `TAIKHOAN`, `DIEMDANHGIA`, `NOIDUNG`, `THOIGIANDANHGIA`) VALUES
(1, 'MWP22', 'taikhoanKH3', 5, 'test danh gia', '2022-04-08'),
(2, 'Edra-387W', 'taikhoanKH3', 5, 'test danh gia', '2022-04-09'),
(3, 'Edra-387W', 'taikhoanKH3', 3, 'test 2', '2022-04-09'),
(4, 'Edra-387W', 'taikhoanKH3', 3, 'test 2', '2022-04-09'),
(5, 'Edra-387W', 'taikhoanKH3', 0, '', '2022-04-12'),
(6, 'Edra-387W', 'taikhoanKH3', 4, 'test 4s\r\n', '2022-04-12'),
(7, 'Edra-387W', 'taikhoanKH3', 5, '', '2022-04-12'),
(8, 'Edra-387W', 'dangky', 5, 'test', '2022-05-07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giamgia`
--

CREATE TABLE `giamgia` (
  `MAGIAMGIA` varchar(10) NOT NULL,
  `TENGIAMGIA` varchar(50) NOT NULL,
  `TILEGIAMGIA` varchar(2) NOT NULL,
  `THOIGIANAPDUNG` date NOT NULL,
  `THOIGIANKETTHUC` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giamgia`
--

INSERT INTO `giamgia` (`MAGIAMGIA`, `TENGIAMGIA`, `TILEGIAMGIA`, `THOIGIANAPDUNG`, `THOIGIANKETTHUC`) VALUES
('ggt5', 'ma giam gia t5', '10', '2022-05-04', '2022-05-31'),
('MGG2022', 'test', '5', '2022-03-28', '2022-03-29'),
('MGG42022', 'Tên mã giảm giá 2', '3', '2022-04-01', '2022-04-30'),
('mgg9/5', 'mgg9/5', '5', '2022-05-09', '2022-05-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `SOLUONGSANPHAM` varchar(5) NOT NULL,
  `TAIKHOAN` varchar(30) NOT NULL,
  `MASANPHAM` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhsanpham`
--

CREATE TABLE `hinhanhsanpham` (
  `DUONGDAN` varchar(100) NOT NULL,
  `MASANPHAM` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hinhanhsanpham`
--

INSERT INTO `hinhanhsanpham` (`DUONGDAN`, `MASANPHAM`) VALUES
('361W.jpg', 'Edra-361W'),
('361W.jpg', 'Edra-368W'),
('234_z2240192256160_79aae0d2908b49282c9756d31de19a24.jpg', 'Edra-387W'),
('bluetooth-airpods-3-1.jpg', 'MME73'),
('tai-nghe-bluetooth-airpods-2-wireless-charge-mrxj2-thiet-ke.jpg', 'MRXJ2'),
('tai-nghe-bluetooth-airpods-pro-apple-mwp22-trang12.jpg', 'MWP22'),
('tai-nghe-bluetooth-airpods-2-apple-mv7n2-trang-6.jpg', 'MV7N2'),
('chuot-khong-day-logitech-mx-master-3-den-2-1.jpg', 'Master3'),
('chuot-khong-day-logitech-m185-080420-090427.jpg', 'LogitechM1'),
('chuot-gaming-logitech-g102-gen2-lightsync-den-1-org.jpg', 'LogitechG1'),
('vi-tinh-microlab-b26-den-note.jpg', 'MicrolabB2'),
('loa-vi-tinh-microlab-m600bt-den-1-org.jpg', 'MicrolabM6'),
('vi-tinh-microlab-m108-note.jpg', 'MicrolabX2'),
('vi-tinh-microlab-m108-note.jpg', 'MicrolabM1'),
('bluetooth-dareu-ek868-2-1.jpg', 'EK868'),
('thumb-800x500.jpg', 'LogitechMX'),
('bluetooth-dareu-ek868-2-1.jpg', 'Edra-400W'),
('LVTN-Page-47.drawio.png', 'Edra5'),
('LVTN-Page-79.drawio.png', 'TEST'),
('LVTN-USECASE-Signup.drawio.png', 'TEST'),
('LVTN-USECASE-Signup.drawio.png', 'test');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonnhap`
--

CREATE TABLE `hoadonnhap` (
  `MADONNHAP` varchar(10) NOT NULL,
  `THOIGIANNHAP` date NOT NULL DEFAULT current_timestamp(),
  `MASANPHAM` varchar(10) NOT NULL,
  `SOLUONGNHAP` varchar(10) NOT NULL,
  `GIASANPHAM` varchar(10) NOT NULL,
  `MANHASANXUAT` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadonnhap`
--

INSERT INTO `hoadonnhap` (`MADONNHAP`, `THOIGIANNHAP`, `MASANPHAM`, `SOLUONGNHAP`, `GIASANPHAM`, `MANHASANXUAT`) VALUES
('Apple', '2022-04-02', 'MME73', '1000', '3490000', 'Apple '),
('Apple2', '2022-04-02', 'MRXJ2', '1000', '3290000', 'Apple '),
('Apple3', '2022-04-02', 'MWP22', '10000', '3999000', 'Apple '),
('Apple4', '2022-04-02', 'MV7N2', '10000', '999000', 'Apple '),
('Edra1', '2022-03-28', 'Edra-361W', '5', '5', 'Edra'),
('Edra2', '2022-03-28', 'Edra-368W', '20', '999000', 'Edra'),
('Edra3', '2022-04-01', 'Edra-387W', '100', '500000', 'Edra'),
('Edra4', '2022-04-09', 'EK868', '10', '1000000', 'Edra'),
('Logitech1', '2022-04-09', 'Master3', '10000', '100000', 'Logitech'),
('Logitech2', '2022-04-09', 'LogitechM1', '10000', '1000000', 'Logitech'),
('Logitech3', '2022-04-09', 'LogitechM1', '10000', '2000000', 'Logitech'),
('Logitech4', '2022-04-09', 'LogitechG1', '200000', '2000000', 'Logitech'),
('Logitech5', '2022-04-09', 'LogitechMX', '100000', '1000000', 'Logitech'),
('Microlab1', '2022-04-09', 'MicrolabB2', '2000', '2000000', 'Microlab'),
('Microlab2', '2022-04-09', 'MicrolabX2', '3000', '3000000', 'Microlab'),
('Microlab3', '2022-04-09', 'MicrolabM1', '4000', '4000000', 'Microlab'),
('Microlab4', '2022-04-09', 'MicrolabM6', '20000', '4000000', 'Microlab'),
('Edra5', '2022-05-04', 'Edra-400W', '500', '500000', 'Edra'),
('Edra7/5', '2022-05-07', 'Edra-361W', '5', '500000', 'Edra'),
('test', '2022-05-09', 'test', '1', '1', 'test');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonxuat`
--

CREATE TABLE `hoadonxuat` (
  `MADONXUAT` varchar(50) NOT NULL,
  `TAIKHOAN` varchar(30) NOT NULL,
  `NGAYXUAT` date NOT NULL DEFAULT current_timestamp(),
  `MASANPHAM` varchar(10) NOT NULL,
  `GIATIEN` varchar(20) NOT NULL,
  `SOLUONGSANPHAM` varchar(10) NOT NULL,
  `TRANGTHAI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadonxuat`
--

INSERT INTO `hoadonxuat` (`MADONXUAT`, `TAIKHOAN`, `NGAYXUAT`, `MASANPHAM`, `GIATIEN`, `SOLUONGSANPHAM`, `TRANGTHAI`) VALUES
('1', 'taikhoanKH', '2022-03-31', 'Edra-361W', '919000', '1', 'đã giao'),
('10', 'taikhoanKH3', '2022-04-06', 'Edra-361W', '919000', '1', 'đã giao'),
('11', 'taikhoanKH3', '2022-04-06', 'MWP22', '5000000', '1', 'đã giao'),
('12', 'taikhoanKH3', '2022-04-06', 'Edra-368W', '999000', '1', 'đã giao'),
('13', 'taikhoanKH3', '2022-04-06', 'MV7N2', '4850000', '1', 'đã giao'),
('14', 'taikhoanKH3', '2022-04-06', 'MWP22', '5000000', '1', 'đã giao'),
('15', 'taikhoanKH3', '2022-04-08', 'Edra-361W', '919000', '1', 'đã giao'),
('16', 'taikhoanKH3', '2022-04-09', 'MV7N2', '4850000', '10', 'đã giao'),
('17', 'taikhoanKH3', '2022-04-09', 'MV7N2', '4850000', '20', 'đã giao'),
('18', 'taikhoanKH3', '2022-04-11', 'Edra-368W', '999000', '15', 'đã giao'),
('19', 'taikhoanKH3', '2022-04-16', 'Edra-387W', '500000', '1', 'đã giao'),
('2', 'taikhoanKH', '2022-03-31', 'Edra-361W', '919000', '1', 'đã giao'),
('20', 'taikhoanKH3', '2022-04-16', 'Edra-387W', '500000', '1', 'đã giao'),
('3', 'taikhoanKH3', '2022-04-01', 'Edra-368W', '999000', '1', 'đã giao'),
('4', 'taikhoanKH3', '2022-04-01', 'Edra-368W', '949050', '1', 'đã giao'),
('5', 'demo', '2022-04-02', 'MV7N2', '4750000', '1', 'đã giao'),
('6', 'taikhoanKH3', '2022-04-02', 'Edra-368W', '949050', '1', 'đã giao'),
('7', 'taikhoanKH3', '2022-04-02', 'Edra-368W', '999000', '1', 'đã giao'),
('8', 'taikhoanKH3', '2022-04-02', 'MV7N2', '4850000', '2', 'đã giao'),
('9', 'taikhoanKH3', '2022-04-02', 'MRXJ2', '5000000', '1', 'đã giao'),
('1651671418_taikhoanKH3', 'taikhoanKH3', '2022-05-04', 'Edra-387W', '450000', '1', 'đã giao'),
('1651671418_taikhoanKH3', 'taikhoanKH3', '2022-05-04', 'MWP22', '5000000', '1', 'đã giao'),
('1651671418_taikhoanKH3', 'taikhoanKH3', '2022-05-04', 'Edra-387W', '450000', '1', 'đã giao'),
('1651672008_taikhoanKH3', 'taikhoanKH3', '2022-05-04', 'Edra-387W', '450000', '2', 'đã giao'),
('1651672008_taikhoanKH3', 'taikhoanKH3', '2022-05-04', 'MicrolabX2', '5000000', '1', 'đã giao'),
('1651803593_taikhoanKH3', 'taikhoanKH3', '2022-05-06', 'MV7N2', '5000000', '1', 'soạn hàng'),
('1651803593_taikhoanKH3', 'taikhoanKH3', '2022-05-06', 'MicrolabX2', '5000000', '2', 'soạn hàng'),
('1651803593_taikhoanKH3', 'taikhoanKH3', '2022-05-06', 'MME73', '4490000', '1', 'soạn hàng'),
('1651899910_taikhoanKH3', 'taikhoanKH3', '2022-05-07', 'Edra-361W', '919000', '1', 'soạn hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MALOAISANPHAM` varchar(10) NOT NULL,
  `TENLOAISANPHAM` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`MALOAISANPHAM`, `TENLOAISANPHAM`) VALUES
('BanPhim', 'Bàn Phím'),
('CapSac', 'Cáp sạc'),
('Chuot', 'Chuột'),
('Loa', 'Loa'),
('TaiNghe', 'Tai Nghe');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `HOTEN` varchar(50) NOT NULL,
  `TAIKHOAN` varchar(30) NOT NULL,
  `MATKHAU` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `SDT` varchar(15) NOT NULL,
  `DIACHI` varchar(200) NOT NULL,
  `MAQUYEN` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`HOTEN`, `TAIKHOAN`, `MATKHAU`, `EMAIL`, `SDT`, `DIACHI`, `MAQUYEN`) VALUES
('dangky', 'dangky', 'c1534de9d226e13c8ffcb520d1667395', 'dangky@gmail.com', '000000000000000', 'Cần thơ', 'KH'),
('demo', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@gmail.com', '123123123', 'demo', 'KH'),
('sinh vien1', 'sinhvien1', 'd9b1d7db4cd6e70935368a1efb10e377', 'thangb1704850@student.ctu.edu.vn', '0944928214', '1', 'NV'),
('t', 't', 'c4ca4238a0b923820dcc509a6f75849b', 'thangb1704850@student.ctu.edu.vn', '1231231233', 'Cần thơ', 'QTV'),
('t1', 't1', 't1', 't1', 't1', 't1', 'QTV'),
('sinh vien2', 't2', '5cbfda3eaf5f1e17073fcc7b99027d2a', 'thangb1704850@student.ctu.edu.vn', '0944928214', '1', 'NV'),
('Tên khách hàng', 'taikhoanKH', 'taikhoanKH', 'emailKH@gmail.com', '0123123123', 'dia chi KH', 'KH'),
('taikhoanKH2', 'taikhoanKH2', 'b9d3e5f1ba4305f4fb5a671a85938d20', 'taikhoanKH2@gmail.com', '0123456789', 'taikhoanKH2', 'KH'),
('taikhoanKH3', 'taikhoanKH3', '6646410cbc8097d91f98939dd070479c', 'lqtad1999@gmail.com', '3', 'taikhoanKH3', 'KH'),
('taikhoanNV12', 'taikhoanNV12', 'b068560d0aa37bc5bc13d5f1d5a8fc8e', 'taikhoanNV12@gmail.com', '1231231233', 'taikhoanNV12', 'NV'),
('taikhoanNV2', 'taikhoanNV2', '05d5e82c5d0df943e8d5c349ab74441c', 'taikhoanNV2@gmail.com', '123123123', 'taikhoanNV2', 'NV');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhasanxuat`
--

CREATE TABLE `nhasanxuat` (
  `MANHASANXUAT` varchar(10) NOT NULL,
  `TENNHASANXUAT` varchar(50) NOT NULL,
  `DIACHINSX` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhasanxuat`
--

INSERT INTO `nhasanxuat` (`MANHASANXUAT`, `TENNHASANXUAT`, `DIACHINSX`) VALUES
('Apple ', 'Apple ', 'Cupertino, California, Hoa Kỳ'),
('Edra', 'Edra', 'Số 104, đường 14, khu đô thị mới Him Lam, phường Tân Hưng, Quận 7, TP Hồ Chí Minh'),
('Logitech', 'Logitech', 'Tòa nhà Centec Tower Phòng 21, Lầu 4, 72 - 74 Nguyễn Thị Minh Khai, Phường 6, Quận 3, TP.HCM, Việt Nam'),
('Microlab', 'Microlab', 'Microlab Microlab ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyencuanguoidung`
--

CREATE TABLE `quyencuanguoidung` (
  `MAQUYEN` varchar(10) NOT NULL,
  `TENQUYEN` varchar(20) NOT NULL,
  `MOTA` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `quyencuanguoidung`
--

INSERT INTO `quyencuanguoidung` (`MAQUYEN`, `TENQUYEN`, `MOTA`) VALUES
('KH', 'Khách hàng', 'Khách hàng'),
('NV', 'Nhân viên', 'Nhân viên'),
('QTV', 'Quản trị viên', 'Quản trị viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MASANPHAM` varchar(10) NOT NULL,
  `TENSANPHAM` varchar(100) NOT NULL,
  `GIASANPHAM` varchar(20) NOT NULL,
  `CHITIETSANPHAM` varchar(1000) NOT NULL,
  `MALOAISANPHAM` varchar(10) NOT NULL,
  `MANHASANXUAT` varchar(10) NOT NULL,
  `MAGIAMGIA` varchar(10) DEFAULT NULL,
  `HIENTHI` bit(1) NOT NULL,
  `THOIGIANHIENTHI` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MASANPHAM`, `TENSANPHAM`, `GIASANPHAM`, `CHITIETSANPHAM`, `MALOAISANPHAM`, `MANHASANXUAT`, `MAGIAMGIA`, `HIENTHI`, `THOIGIANHIENTHI`) VALUES
('Edra-361W', 'Bàn phím cơ E-DRA EK361W Bluet', '919000', 'E-DRA - EK361W - Bàn phím cơ 60%, 61 phím\r\n- Giao diện: USB 2.0; Bluetooth\r\n- Số lượng phím: 61 phím\r\n- Cáp bàn phím dài: Type C\r\n- Top cover: ABS top cover\r\n- Bottom cover: ABS\r\n- Key caps: ABS Double injection key caps\r\n- Logo: laser Logo\r\n- Antighosting: full antishosting keys\r\n- Tương thích hệ điều hành: Windows 98 / 2000 / ME / NT / XP / win 7,8,10\r\n- Cân nặng: 900g\r\n- Màu sắc: màu đen;\r\n- Switch Outemu: Blue Sw, Brown Sw, Red Sw\r\nKey thích hợp cho Game thủ với mức giá phù hợp.', 'BanPhim', 'Edra', '', b'1', '2022-03-27'),
('Edra-368W', 'Bàn phím cơ E-DRA EK368W Bluetooth Blue switch', '999000', 'Bàn phím cơ E-DRA EK368W Bluetooth Kailhbox Red switch\r\nBàn phím cơ không dây\r\nSwitch Kailhbox chất lượng cao\r\nKết nối Bluetooth thông dụng\r\nLayout 68 phím vừa nhỏ gọn vừa tiện lợi\r\nKeycap PBT DyeSub profile XDA siêu đẹp\r\nPin sạc dung lượng cao', 'BanPhim', 'Edra', 'MGG2022', b'0', '2022-03-28'),
('Edra-387W', 'Bàn phím cơ E-DRA EK387W Bluetooth Blue switch', '500000', 'Bàn phím cơ E-DRA EK387W Bluetooth Blue switch', 'BanPhim', 'Edra', 'ggt5', b'1', '2022-04-01'),
('Edra-400W', 'Bàn phím cơ E-DRA EK400W Bluetooth Blue switch', '650000', 'test', 'BanPhim', 'Edra', NULL, b'1', '2022-05-04'),
('EK868', 'Bàn Phím Bluetooth DareU EK868', '2000000', 'Thông số kỹ thuật Bàn Phím Bluetooth DareU EK868\r\n\r\nTương thích:\r\n\r\nAndroidiOSMacOSWindows\r\nCách kết nối:\r\n\r\nBluetoothDây cắm USB\r\nĐèn LED:\r\n\r\nCó\r\nSố phím:\r\n\r\n68 Phím\r\nThương hiệu của:\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nDareU. Xem thông tin hãng', 'BanPhim', 'Edra', NULL, b'1', '2022-04-09'),
('LogitechG1', 'Chuột Gaming Logitech G102 Gen2 Lightsync', '2500000', 'Thông số kỹ thuật Chuột Gaming Logitech G102 Gen2 Lightsync\r\n\r\nTương thích\r\n\r\nWindows\r\nĐộ phân giải mặc định\r\n\r\n8000 DPI\r\nCách kết nối\r\n\r\nDây cắm USB\r\nĐộ dài dây/Khoảng cách kết nối\r\n\r\nDây dài 209 cm\r\nĐèn LED\r\n\r\nRGB 16.8 triệu màu\r\nỨng dụng điều khiển\r\n\r\nLogitech G HUB\r\nTrọng lượng\r\n\r\n85 g\r\nThương hiệu của\r\n\r\nThụy Sĩ\r\nSản xuất tại\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nLogitech. Xem thông tin hãng', 'Chuot', 'Logitech', NULL, b'1', '2022-04-09'),
('LogitechM1', 'Chuột Không Dây Logitech M185', '2000000', 'Thông số kỹ thuật Chuột Không Dây Logitech M185\r\n\r\nTương thích\r\n\r\nMacOS (MacBook, iMac)Windows\r\nĐộ phân giải mặc định\r\n\r\n1000 DPI\r\nCách kết nối\r\n\r\nĐầu thu USB Receiver\r\nĐộ dài dây/Khoảng cách kết nối\r\n\r\n10 m\r\nĐèn LED\r\n\r\nKhông có\r\nỨng dụng điều khiển\r\n\r\nKhông có\r\nLoại pin\r\n\r\n1 viên pin AA\r\nThời gian\r\n\r\nDùng Không có - Sạc Không có\r\nTrọng lượng\r\n\r\n75.2 g\r\nThương hiệu của\r\n\r\nThụy Sĩ\r\nSản xuất tại\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nLogitech. Xem thông tin hãng', 'Chuot', 'Logitech', NULL, b'1', '2022-04-09'),
('LogitechMX', 'Chuột không dây Logitech MX Anywhere 3 Xám', '10000000', 'Thông số kỹ thuật Chuột không dây Logitech MX Anywhere 3 Xám\r\n\r\nTương thích\r\n\r\nChromeOS\r\n\r\nMacOS (MacBook, iMac)\r\n\r\nWindows\r\n\r\nĐộ phân giải mặc định\r\n\r\n4000 DPI\r\nCách kết nối\r\n\r\nBluetoothĐầu thu USB Receiver\r\nĐộ dài dây/Khoảng cách kết nối\r\n\r\n10 m\r\nĐèn LED\r\n\r\nKhông có\r\nỨng dụng điều khiển\r\n\r\nLogitech Options\r\nLoại pin\r\n\r\nPin sạc\r\nThời gian\r\n\r\nDùng 70 ngày/ 1 lần sạc - Sạc Hãng không công bố\r\nCổng sạc\r\n\r\nUSB Type-C\r\nTrọng lượng\r\n\r\n99 g\r\nThương hiệu của\r\n\r\nThụy Sĩ\r\nSản xuất tại\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nLogitech. Xem thông tin hãng', 'Chuot', 'Logitech', 'MGG42022', b'1', '2022-04-09'),
('Master3', 'Chuột không dây Logitech MX Master 3 Đen', '1000000', 'Thông số kỹ thuật Chuột không dây Logitech MX Master 3 Đen\r\n\r\nTương thích\r\n\r\nMacOS (MacBook, iMac)Windows\r\nĐộ phân giải mặc định\r\n\r\n4000 DPI\r\nCách kết nối\r\n\r\nBluetoothĐầu thu USB Receiver\r\nĐộ dài dây/Khoảng cách kết nối\r\n\r\n10 m\r\nĐèn LED\r\n\r\nKhông có\r\nỨng dụng điều khiển\r\n\r\nLogitech Options\r\nLoại pin\r\n\r\nPin sạc\r\nThời gian\r\n\r\nDùng 70 ngày/ 1 lần sạc - Sạc 3 giờ\r\nCổng sạc\r\n\r\nUSB Type-C\r\nTrọng lượng\r\n\r\n141 g\r\nThương hiệu của\r\n\r\nThụy Sĩ\r\nSản xuất tại\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nLogitech. Xem thông tin hãng', 'Chuot', 'Logitech', NULL, b'1', '2022-04-09'),
('MicrolabB2', 'Loa vi tính Microlab B26', '3000000', 'Thông tin chung\r\n\r\nLoại sản phẩm:\r\n\r\nLoa vi tính\r\nSố lượng kênh:\r\n\r\n2.0 kênh\r\nTổng công suất:\r\n\r\n4 W\r\nNguồn:\r\n\r\nCắm điện dùng\r\nCông nghệ âm thanh:\r\n\r\nKhông có\r\nPhím điều khiển:\r\n\r\nNút vặn chỉnh âm lượng nhạc\r\nTiện ích:\r\n\r\nKhông có\r\nKết nối\r\n\r\nKết nối khác:\r\n\r\nAUXUSB\r\nThông tin sản phẩm\r\n\r\nLoa sub (loa Bass):\r\n\r\nDài 11 cm - Rộng 7 cm - Cao 8 cm - Nặng 0.5 Kg\r\nCông suất loa sub:\r\n\r\n2W\r\nKích thước loa Bass:\r\n\r\nKhông có\r\nSố lượng loa Treble:\r\n\r\nKhông có\r\nSố lượng loa Mid:\r\n\r\nKhông có\r\nLoa sau (loa Surround):\r\n\r\nDài 11 cm - Rộng 7.8 cm - Cao 8 cm - Nặng 0.5 kg\r\nChất liệu loa:\r\n\r\nNhựa\r\nThương hiệu của:\r\n\r\nTrung Quốc\r\nSản xuất tại:\r\n\r\nTrung Quốc\r\nDòng sản phẩm:\r\n\r\nKhông có\r\nHãng:\r\n\r\nMicrolab. Xem thông tin hãng', 'Loa', 'Microlab', NULL, b'1', '2022-04-09'),
('MicrolabM1', 'Loa vi tính Microlab M108', '5000000', 'Thông số kỹ thuật Loa vi tính Microlab M108\r\n\r\nTổng công suất:\r\n\r\n11 W\r\nNguồn:\r\n\r\nCắm điện dùng\r\nSố lượng kênh:\r\n\r\n2.1 kênh\r\nKết nối khác:\r\n\r\nJack 3.5 mm\r\nPhím điều khiển:\r\n\r\nChỉnh BassTăng/giảm âm lượng\r\nThương hiệu của:\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nMicrolab. Xem thông tin hãng', 'Loa', 'Microlab', 'MGG42022', b'1', '2022-04-09'),
('MicrolabM6', 'Loa vi tính Bluetooth Microlab M600BT Đen', '5000000', 'Thông số kỹ thuật Loa vi tính Bluetooth Microlab M600BT Đen\r\n\r\nTổng công suất:\r\n\r\n40 W\r\nNguồn:\r\n\r\nCắm điện dùng\r\nSố lượng kênh:\r\n\r\n2.1 kênh\r\nKết nối không dây:\r\n\r\nBluetooth 5.0\r\nKết nối khác:\r\n\r\nJack 3.5mm ra 2 đầu RCAJack bông sen trắng đỏ\r\nPhím điều khiển:\r\n\r\nChỉnh Bass\r\nThương hiệu của:\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nMicrolab. Xem thông tin hãng', 'Loa', 'Microlab', 'MGG42022', b'1', '2022-04-09'),
('MicrolabX2', 'Loa vi tính Microlab X2', '5000000', 'Thông số kỹ thuật Loa vi tính Microlab M108\r\n\r\nTổng công suất:\r\n\r\n11 W\r\nNguồn:\r\n\r\nCắm điện dùng\r\nSố lượng kênh:\r\n\r\n2.1 kênh\r\nKết nối khác:\r\n\r\nJack 3.5 mm\r\nPhím điều khiển:\r\n\r\nChỉnh BassTăng/giảm âm lượng\r\nThương hiệu của:\r\n\r\nTrung Quốc\r\nHãng\r\n\r\nMicrolab. Xem thông tin hãng', 'Loa', 'Microlab', 'MGG42022', b'1', '2022-04-09'),
('MME73', 'Tai nghe Bluetooth AirPods 3 Apple MME73 Trắng', '4490000', 'Thời gian sử dụng hộp sạc:\r\n\r\nDùng 24 giờ - Sạc Hãng không công bố\r\nCổng sạc:\r\n\r\nLightningSạc không dây\r\nCông nghệ âm thanh:\r\n\r\nAdaptive EQ\r\n\r\nCustom high-excursion Apple driver\r\n\r\nHigh Dynamic Range\r\n\r\nSpatial Audio\r\n\r\nTương thích:\r\n\r\nAndroid\r\n\r\niOS (iPhone)\r\n\r\niPadOS (iPad)\r\n\r\nMacOS (Macbook, iMac)\r\n\r\nTiện ích:\r\n\r\nChống nước IPX4\r\n\r\nCó mic thoại\r\n\r\nSạc không dây\r\n\r\nKết nối cùng lúc:\r\n\r\n1 thiết bị\r\nCông nghệ kết nối:\r\n\r\nBluetooth 5.0\r\nĐiều khiển:\r\n\r\nCảm ứng chạm\r\nPhím điều khiển:\r\n\r\nBật trợ lí ảo\r\n\r\nChuyển bài hát\r\n\r\nNghe/nhận cuộc gọi\r\n\r\nPhát/dừng chơi nhạc\r\n\r\nKích thước:\r\n\r\nDài 3.79 cm - Rộng 1.8 cm - Cao 1.9 cm\r\nTrọng lượng:\r\n\r\n4.2 g\r\nThương hiệu của:\r\n\r\nMỹ\r\nSản xuất tại:\r\n\r\nViệt Nam / Trung Quốc (tùy lô hàng)\r\nHãng:\r\n\r\nApple. Xem thông tin hãng', 'TaiNghe', 'Apple', NULL, b'1', '2022-04-02'),
('MRXJ2', 'Tai nghe Bluetooth AirPods 2 Wireless charge Apple MRXJ2', '5000000', 'asd1231231', 'TaiNghe', 'Apple', 'MGG2022', b'1', '2022-04-02'),
('MV7N2', 'Tai nghe Bluetooth AirPods 2 Apple MV7N2', '5000000', 'Thời gian sử dụng hộp sạc:\r\n\r\nDùng 24 giờ - Sạc 2 giờ\r\nCổng sạc:\r\n\r\nLightning\r\nCông nghệ âm thanh:\r\n\r\nChip Apple H1\r\nTương thích:\r\n\r\nAndroidiOS (iPhone)\r\nTiện ích:\r\n\r\nCó mic thoại\r\nKết nối cùng lúc:\r\n\r\n1 thiết bị\r\nCông nghệ kết nối:\r\n\r\nBluetooth 5.0\r\nĐiều khiển:\r\n\r\nCảm ứng chạm\r\nPhím điều khiển:\r\n\r\nBật trợ lí ảo\r\n\r\nChuyển bài hát\r\n\r\nMic thoại\r\n\r\nNghe/nhận cuộc gọi\r\n\r\nPhát/dừng chơi nhạc\r\n\r\nKích thước:\r\n\r\nDài 1.65 cm - Rộng 1.8 cm - Cao 4.05 cm\r\nTrọng lượng:\r\n\r\n4 g\r\nThương hiệu của:\r\n\r\nMỹ\r\nSản xuất tại:\r\n\r\nViệt Nam / Trung Quốc (tùy lô hàng)\r\nHãng:\r\n\r\nApple. Xem thông tin hãng', 'TaiNghe', 'Apple', 'MGG42022', b'1', '2022-04-02'),
('MWP22', 'Tai nghe Bluetooth AirPods Pro Wireless Charge Apple MWP22', '5000000', 'Thời gian sử dụng hộp sạc:\r\n\r\nDùng 24 giờ - Sạc 3 giờ\r\nCổng sạc:\r\n\r\nLightningSạc không dây\r\nCông nghệ âm thanh:\r\n\r\nActive Noise Cancellation\r\n\r\nAdaptive EQ\r\n\r\nChip Apple H1\r\n\r\nCustom high-excursion Apple driver\r\n\r\nHigh Dynamic Range\r\n\r\nSpatial Audio\r\n\r\nTransparency Mode\r\n\r\nTương thích:\r\n\r\nAndroid\r\n\r\niOS (iPhone)\r\n\r\niPadOS (iPad)\r\n\r\nMacOS\r\n\r\nỨng dụng kết nối:\r\n\r\nHãng không công bố\r\nTiện ích:\r\n\r\nChống nước IPX4\r\n\r\nChống ồn\r\n\r\nCó mic thoại\r\n\r\nHỗ trợ sạc không dây Qi\r\n\r\nKết nối cùng lúc:\r\n\r\n1 thiết bị\r\nCông nghệ kết nối:\r\n\r\nBluetooth 5.0\r\nĐiều khiển:\r\n\r\nCảm ứng chạm\r\nPhím điều khiển:\r\n\r\nChuyển bài hát\r\n\r\nChuyển chế độ\r\n\r\nMic thoại\r\n\r\nNghe/nhận cuộc gọi\r\n\r\nPhát/dừng chơi nhạc\r\n\r\nKích thước:\r\n\r\nDài 2.4 cm - Rộng 2.18 cm - Cao 3.09 cm\r\nTrọng lượng:\r\n\r\n5.4 g\r\nThương hiệu của:\r\n\r\nMỹ\r\nSản xuất tại:\r\n\r\nViệt Nam / Trung Quốc (tùy lô hàng)\r\nHãng:\r\n\r\nApple. Xem thông tin hãng', 'TaiNghe', 'Apple', NULL, b'1', '2022-04-02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `traloidanhgia`
--

CREATE TABLE `traloidanhgia` (
  `MADANHGIA` int(11) NOT NULL,
  `TAIKHOAN` varchar(100) NOT NULL,
  `NOIDUNGTRALOI` text NOT NULL,
  `THOIGIANTRALOI` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `traloidanhgia`
--

INSERT INTO `traloidanhgia` (`MADANHGIA`, `TAIKHOAN`, `NOIDUNGTRALOI`, `THOIGIANTRALOI`) VALUES
(1, 'taikhoanNV2', 'Cảm ơn bạn đã mua sản phẩm', '2022-04-11'),
(2, 'taikhoanNV2', 'Cảm ơn bạn đã mua sản phẩm\r\n', '2022-04-12'),
(2, 'taikhoanNV2\r\n', 'Cảm ơn bạn đã mua sản phẩm 2', '2022-04-11'),
(3, 'taikhoanKH3', '$test rep cmt', '2022-04-12'),
(3, 'taikhoanKH3', '$test', '2022-04-12'),
(1, 't', 'cảm ơn anh', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(1, 't', 'cảm ơn anh 2', '2022-05-05'),
(4, 't', 'tks', '2022-05-05'),
(4, 't', 't', '2022-05-05'),
(7, 't', 't', '2022-05-05'),
(6, 't', 't', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(5, 't', 'ths', '2022-05-05'),
(6, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(7, 't', 'test', '2022-05-05'),
(2, 't', 'tset', '2022-05-05'),
(2, 't', 'tset', '2022-05-05'),
(6, 't', 'test 3', '2022-05-05'),
(6, 't', 'test 4', '2022-05-05'),
(3, 't', 'test 3', '2022-05-05'),
(5, 't', '', '2022-05-07'),
(8, 'dangky', '', '2022-05-07'),
(8, 'dangky', 'test', '2022-05-07');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`MADANHGIA`);

--
-- Chỉ mục cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`MAGIAMGIA`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MALOAISANPHAM`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`TAIKHOAN`),
  ADD KEY `quyen` (`MAQUYEN`);

--
-- Chỉ mục cho bảng `nhasanxuat`
--
ALTER TABLE `nhasanxuat`
  ADD PRIMARY KEY (`MANHASANXUAT`);

--
-- Chỉ mục cho bảng `quyencuanguoidung`
--
ALTER TABLE `quyencuanguoidung`
  ADD PRIMARY KEY (`MAQUYEN`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MASANPHAM`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `MADANHGIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `quyen` FOREIGN KEY (`MAQUYEN`) REFERENCES `quyencuanguoidung` (`MAQUYEN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
