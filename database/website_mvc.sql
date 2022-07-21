-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220525.c1e393abce
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 05:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `adminAddress` varchar(255) NOT NULL,
  `adminPhone` varchar(255) NOT NULL,
  `adminBirth` date DEFAULT NULL,
  `adminImage` varchar(255) NOT NULL,
  `adminPermissions` varchar(525) NOT NULL,
  `level` int(30) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminID`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `adminAddress`, `adminPhone`, `adminBirth`, `adminImage`, `adminPermissions`, `level`) VALUES
(1, 'hiep', 'hiep@gmail.com', 'hieptd', 'e10adc3949ba59abbe56e057f20f883e', 'hh', 'hh', '2022-06-22', '543d7bac07.png', 'listBill', 0),
(23, 'x', 'x', 'x', 'x', 'x', 'x', '2003-06-04', '6ba7c5ce2b.png', '', 1),
(26, 'c', 'c', 'c', 'c', 'c', 'c', '2022-06-01', '16dc85494f.png', 'addCate, listCate, updateCate, deleteCate, addBrand, listBrand, updateBrand, deleteBrand, addProduct, listProduct, updateProduct, deleteProduct, listBill, confirmBill, deleteBill, listCustomer, deleteCustomer, addAdmin, listAdmin, updateAdmin, deleteAdmin, listStatistics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandID` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandID`, `brandName`) VALUES
(2, 'Apple'),
(4, 'Asus'),
(6, 'Dell'),
(7, 'Lenovo'),
(15, 'Samsung'),
(16, 'Oppo'),
(17, 'Xiaomi'),
(18, 'Logitech'),
(19, 'Razer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `sessionID` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catID` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catID`, `catName`) VALUES
(58, 'Điện thoại'),
(60, 'Laptop'),
(61, 'Chuột'),
(62, 'Tai  nghe'),
(63, 'Máy tính bàn');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `customerPassword` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customerID`, `customerName`, `customerAddress`, `phone`, `email`, `customerPassword`) VALUES
(12, 'hggg', 'Hà Nội', '0114554322', 'hn@', '2510c39011c5be704182423e3a695e91'),
(13, 'Ngô Tân', 'Cầu Giấy', '0685421304', 'letan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(16, 'd', 'd', 'd', 'd', '8277e0910d750195b448797616e091ad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customerID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `orderStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderID`, `productID`, `productName`, `customerID`, `quantity`, `price`, `productImage`, `orderDate`, `orderStatus`) VALUES
(38, 50, 'Laptop Asus Gaming TUF FX506LHB-HN188W (i5 10300H/8GB RAM/512GB SSD/15.6 FHD 144Hz /GTX 1650 4GB/Win11/Đen)', 12, 2, '16299000', '5aa2148f4e.jpeg', '2022-07-19 16:40:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catID` int(11) NOT NULL,
  `brandID` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `featured` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productID`, `productName`, `catID`, `brandID`, `product_desc`, `featured`, `price`, `product_image`) VALUES
(50, 'Laptop Asus Gaming TUF FX506LHB-HN188W (i5 10300H/8GB RAM/512GB SSD/15.6 FHD 144Hz /GTX 1650 4GB/Win11/Đen)', 60, 4, 'CPU: Intel® Core™ i5-10300H 2.5 GHZ (8M Cache, up to 4.5 GHz, 4 nhân 8 luồng)\r\nRAM: 8GB DDR4 SO-DIMM 2933MHz\r\nỔ cứng: 512GB M.2 NVMe™ PCIe® 3.0 SSD\r\nVGA: NVIDIA GTX 1650 4GB\r\nMàn hình: 15.6-inch, FHD (1920 x 1080) 144hz, 16:9,NTSC: 45%, Độ sáng :250nits\r\nPhím: có đèn led\r\nHĐH: Win 11\r\nMàu: Đen', 1, '16299000', '5aa2148f4e.jpeg'),
(51, 'Chuột game Logitech G203 Lilac (910-005853) (USB/RGB)', 61, 18, 'Logitech G203 Lilac\r\nThiết kế đối xứng nhỏ gọn\r\nĐộ phân giải : 8000 DPI\r\nLed RGB 16.8 triệu màu với tính năng Lightsync đồng bộ led của Logitech\r\nBổ sung hiệu ứng sóng cho dải led RGB của chuột\r\nMắt đọc được nâng cấp cho gia tốc tốt hơn\r\nSử dụng switch Omron cho độ bền cao hơn', 0, '409000', '81a254ba26.jpg'),
(52, 'PC Asus All in One M3200WU (R3 5300U/4GB RAM/512GB SSD/21.5 inch Full HD/WL+BT/K+M/Win 11) (M3200WUAK-BA015W)', 63, 4, 'CPU: AMD Ryzen R3 5300U\r\nRAM: 4GB\r\nỔ cứng: 512GB SSD\r\nMàn hình: 21.5 inch Full HD\r\nHệ điều hành: Windows 11 Home SL\r\nTính năng: Wifi+ Bluetooth\r\nBàn phím chuột đi kèm', 1, '13000000', '404a1a852f.jpg'),
(53, 'Tai nghe Razer Kraken Tournament Edition Wired Gaming Headset Green RZ04-02051100-R3M1', 62, 19, 'Tai nghe chơi game Razer Kraken Tournament Edition\r\nMàng loa kích cỡ 50mm\r\nCông nghệ âm thanh THX Spartial\r\nBộ điều khiển âm thanh tiện lợi, nút bấm kích hoạt HX Spartial tiện lợi\r\nThiết kế đệm tai nghe siêu mềm và độ đàn hồi cao.', 1, '2199000', 'c7fb816c62.jpg'),
(54, 'iPhone 13 Pro Max 128GB', 58, 2, '6.7-inch, OLED, Super Retina XDR, 2778 x 1284 Pixels\r\n12.0 MP + 12.0 MP + 12.0 MP\r\n12.0 MP\r\nApple A15 Bionic\r\n128 GB', 1, '28999000', 'f5029ed3cb.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlistID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlistID`, `customerID`, `productID`, `productName`, `price`, `productImage`) VALUES
(6, 9, 25, 'Laptop Acer Gaming Nitro 5 AN515-57-5669 (NH.QEHSV.001) (i5 11400H/8GBRam/512GB SSD/GTX1650 4G/15.6 inch FHD 144Hz/Win 11/Đen)', '18599000', '45a3d51467.png'),
(7, 9, 28, 'Tai nghe Gaming Rapoo VH160', '419000', '4e077bb71d.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlistID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



