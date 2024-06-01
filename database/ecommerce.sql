-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2024 pada 18.12
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `name`, `description`) VALUES
(1, 'Bag', 'Inspiring your solution'),
(2, 'test', 'test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `charts`
--

CREATE TABLE `charts` (
  `id_chart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `charts`
--

INSERT INTO `charts` (`id_chart`, `id_user`, `id_product`, `quantity`) VALUES
(1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `myfavorite`
--

CREATE TABLE `myfavorite` (
  `id_myfavorite` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `myfavorite`
--

INSERT INTO `myfavorite` (`id_myfavorite`, `id_user`, `id_product`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `delivery_address` text NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `delivery_address`, `total_amount`, `status`) VALUES
(1, 2, 'test', '0', ''),
(2, 2, 'test', '0', 'test'),
(3, 2, 'test', '0', 'test'),
(4, 2, 'test', '0', 'test'),
(5, 2, 'test', '0', 'test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_details`
--

CREATE TABLE `order_details` (
  `id_order_detail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id_payment` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `stock`, `id_category`, `foto`) VALUES
(1, 'NOELLE TOP ZIP SHOULDER BAG', 'ZG787918\nMaterial: Saffiano pu\nMeasurements: L:29 W: 6 H: 18 cm', '1.799', 4, 1, ''),
(2, 'NOELLE TOP ZIP SHOULDER BAG', 'ZG787918\nMaterial: Saffiano pu\nMeasurements: L:29 W: 6 H: 18 cm', '179000', 4, 1, ''),
(3, 'NOELLE TOP ZIP SHOULDER BAG', 'ZG787918\nMaterial: Saffiano pu\nMeasurements: L:29 W: 6 H: 18 cm', '179000', 4, 1, ''),
(5, 'NOELLE TOP ZIP SHOULDER BAG', 'ZG787918\nMaterial: Saffiano pu\nMeasurements: L:29 W: 6 H: 18 cm', '179000', 4, 1, ''),
(6, 'NOELLE TOP ZIP SHOULDER BAG', 'ZG787918\nMaterial: Saffiano pu\nMeasurements: L:29 W: 6 H: 18 cm', '179000', 4, 1, ''),
(7, 'NOELLE TOP ZIP SHOULDER BAG', 'ZG787918\nMaterial: Saffiano pu\nMeasurements: L:29 W: 6 H: 18 cm', '179000', 4, 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id_shipping_address` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `kode_pos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `shipping_address`
--

INSERT INTO `shipping_address` (`id_shipping_address`, `id_user`, `nama_pengirim`, `nohp`, `provinsi`, `kota`, `kecamatan`, `kelurahan`, `alamat_lengkap`, `kode_pos`) VALUES
(1, 2, 'Anda', '12345', 'sumatera utara', 'tebing tinggi', 'serdang bedagai', 'pabatu', 'jl. pulau sumatera', '567');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `fullname`, `email`, `password`, `phone`, `address`, `role`) VALUES
(1, 'administrator', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '082293763630', 'padang', '1'),
(2, 'Cakra', 'cakra@gmail.com', '202cb962ac59075b964b07152d234b70', '123', 'jakarta', '2'),
(3, 'Anda', 'anda@gmail.com', '202cb962ac59075b964b07152d234b70', '082293763630', 'padang', '2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`id_chart`);

--
-- Indeks untuk tabel `myfavorite`
--
ALTER TABLE `myfavorite`
  ADD PRIMARY KEY (`id_myfavorite`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id_order_detail`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id_shipping_address`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `charts`
--
ALTER TABLE `charts`
  MODIFY `id_chart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `myfavorite`
--
ALTER TABLE `myfavorite`
  MODIFY `id_myfavorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id_shipping_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
