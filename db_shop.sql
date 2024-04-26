SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
    AUTOCOMMIT = 0;

START TRANSACTION;

SET
    time_zone = "+00:00";

DROP DATABASE IF EXISTS `db_shop`;

CREATE DATABASE IF NOT EXISTS `db_shop` DEFAULT CHARACTER
SET
    utf8 COLLATE utf8_unicode_ci;

USE `db_shop`;

--
-- Database: `db_shop`
--
-- --------------------------------------------------------
--
-- Table structure for table `danhsach`
--
CREATE TABLE
    `danhsach` (
        `MaSP` int (10) NOT NULL AUTO_INCREMENT,
        `TenSP` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        `IdNSX` int (20) NOT NULL,
        `Gia` int (10) NOT NULL,
        `TiLeGiam` int (5),
        `SoLuong` int (11) NOT NULL,
        `MoTa` varchar(2000) COLLATE utf8_unicode_ci,
        `AnhSP` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        `LuotXem` int (11) NOT NULL,
        PRIMARY KEY (`MaSP`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT = 13;

--
-- Dumping data for table `danhsach`
--
INSERT INTO
    `danhsach` (`MaSP`, `TenSP`, `IdNSX`, `Gia`, `TiLeGiam`, `SoLuong`, `MoTa`, `AnhSP`, `LuotXem`)
VALUES
    (1, 'CONVERSE WHITE LOW', 2, 1200000, 0, 12, '', './assets/images/conver_white_low.jpg', 0),
    (2, 'CONVERSE 1970s ', 2, 1000000, 0, 8, '', './assets/images/converse_1970s.jpg', 0),
    (3, 'CONVERSE 1970s WHITE', 2, 1500000, 0, 5, '', './assets/images/converse_1970s_white.jpg', 0),
    (4, 'CONVERSE BLACK HIGH', 2, 900000, 0, 20, '', './assets/images/converse_black_high.jpg', 0),
    (5, 'JORDAN 1 RETRO BLACK', 5, 1400000, 0, 7, '', './assets/images/jordan_1_retro_black.jpg', 0),
    (6, 'JORDAN WHITE BLACK', 5, 1200000, 0, 16, '', './assets/images/jordan_black_white.jpg', 0),
    (7, 'JORDAN GREY', 5, 1200000, 0, 7, '', './assets/images/jordan_grey.jpg', 0),
    (8, 'JORDAN MOCHA', 5, 1100000, 0, 7, '', './assets/images/jordan_mocha.jpg', 0),
    (9, 'MLB BOSTON', 3, 1100000, 0, 7, '', './assets/images/MLB_Boston.jpg', 0),
    (10, 'MLB CLASSIC', 3, 1250000, 0, 7, '', './assets/images/MLB_Classic.jpeg', 0),
    (11, 'Nike AF1 DIOR', 1, 1100000, 5, 8, '', './assets/images/nike_af1_custom_dior.jpg', 0),
    (12, 'Nike AF1 SKYBLUE ', 1, 1100000, 0, 9, '', './assets/images/nike_af1_custom_skyblue.jpeg', 0);

(
    13,
    'Nike AF1 SMOKE GREY',
    1,
    1300000,
    10,
    9,
    '',
    './assets/images/nike_af1_custom_smoke_grey.jpeg',
    0
);

(14, 'Nike BLAZER WHITE ', 1, 1400000, 0, 9, '', './assets/images/nike_blazer_white.jpg', 0);

(15, 'Nike AF1 GUCCI ', 1, 1000000, 15, 9, '', './assets/images/nike_af1_Gucci.jpg', 0);

(16, 'Nike AF1 LV8 ', 1, 1100000, 0, 9, '', './assets/images/nike_af1_LV8.jpg', 0);

(17, 'Nike AF1 PANDA', 1, 1200000, 20, 9, '', './assets/images/nike_af1_panda.jpg', 0);

(18, 'Nike AF1 WHITE ', 1, 1150000, 5, 9, '', './assets/images/nike_af1_white.jpg', 0);

-- --------------------------------------------------------
--
-- Table structure for table `giohang`
--
CREATE TABLE
    `giohang` (
        `MaGio` int (11) NOT NULL AUTO_INCREMENT,
        `MaNguoiDung` int (11) NOT NULL,
        `MaSP` int (11) DEFAULT NULL,
        `TenSP` text COLLATE utf8_unicode_ci,
        `SoLuong` int (11) DEFAULT NULL,
        `Gia` int (11) DEFAULT NULL,
        `AnhSP` text COLLATE utf8_unicode_ci,
        PRIMARY KEY (`MaGio`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT = 3;

--
-- Dumping data for table `giohang`
--
INSERT INTO
    `giohang` (`MaGio`, `MaNguoiDung`, `MaSP`, `TenSP`, `SoLuong`, `Gia`, `AnhSP`)
VALUES
    (1, 3, 1, 'CONVERSE WHITE LOW', 1, 1200000, './assets/images/conver_white_low.jpg'),
    (2, 3, 2, 'CONVERSE 1970s ', 1, 1000000, './assets/images/converse_1970s.jpg');

-- --------------------------------------------------------
--
-- Table structure for table `nguoidung`
--
CREATE TABLE
    `nguoidung` (
        `MaNguoiDung` int (10) NOT NULL AUTO_INCREMENT,
        `QuyenHan` int (1) NOT NULL,
        `TenNguoiDung` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        `TenDangNhap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        `MatKhau` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        `DiaChi` text COLLATE utf8_unicode_ci NOT NULL,
        `Khoa` tinyint (1) NOT NULL,
        `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`MaNguoiDung`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT = 3;

--
-- Dumping data for table `nguoidung`
--
INSERT INTO
    `nguoidung` (`MaNguoiDung`, `QuyenHan`, `TenNguoiDung`, `TenDangNhap`, `MatKhau`, `DiaChi`, `Khoa`)
VALUES
    (1, 0, 'Thành Phong', 'phong', MD5 ('phong'), 'An Giang', 0),
    (2, 0, 'Phước Tuy', 'tuy', MD5 ('tuy'), 'An Giang', 0),
    (3, 1, 'Client', 'client', MD5 ('client'), 'Cần Thơ', 0);

CREATE TABLE
    `nhasanxuat` (
        `IdNSX` int (20) NOT NULL AUTO_INCREMENT,
        `TenNSX` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`IdNSX`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT = 6;

INSERT INTO
    `nhasanxuat` (`IdNSX`, `TenNSX`)
VALUES
    (1, 'NIKE'),
    (2, 'CONVERSE'),
    (3, 'MLB'),
    (4, 'ADIDAS'),
    (5, 'JORDAN');