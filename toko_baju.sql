-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 02:26 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_baju`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pelanggan`
--

CREATE TABLE `detail_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `umur` tinyint(2) NOT NULL,
  `Jenis_Kelamin` tinyint(1) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `No_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pelanggan`
--

INSERT INTO `detail_pelanggan` (`id_pelanggan`, `umur`, `Jenis_Kelamin`, `Alamat`, `No_telp`) VALUES
(1, 17, 1, 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', '089504753863'),
(7, 21, 1, 'grandline,wano', '081333333333');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Celana'),
(2, 'Topi'),
(3, 'Kaos'),
(5, 'Sepatu'),
(6, 'Sandal'),
(7, 'Aksesoris Pria'),
(8, 'Aksesoris wanita'),
(9, 'Kemeja'),
(10, 'Jacket'),
(11, 'Tas Sekolah'),
(12, 'Batik'),
(13, 'Hijab');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pelangan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `komen`
--

CREATE TABLE `komen` (
  `id_komen` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `isi_komen` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komen`
--

INSERT INTO `komen` (`id_komen`, `id_produk`, `nama`, `isi_komen`, `tanggal`) VALUES
(120, 52, 'rafi', 'bagus', '2022-03-31 14:18:09'),
(121, 52, 'rafi', 'bagus banget', '2022-03-31 14:20:00'),
(122, 53, 'rafi', 'bagus', '2022-04-02 05:31:41'),
(123, 53, 'rafi', 'keren', '2022-04-02 05:31:55'),
(124, 54, 'rafi', 'Keren', '2022-04-02 05:35:43'),
(125, 50, 'rafi', 'bagus banget', '2022-04-02 05:36:55'),
(126, 49, 'Rafi Gusti', 'bagus', '2022-04-02 08:24:46'),
(127, 54, 'rafi', 'Bagus banget ', '2022-04-02 14:29:50'),
(128, 54, 'rafi', 'Bagus banget ', '2022-04-02 14:29:57'),
(129, 53, 'rafi', 'Jadi pengen', '2022-04-02 14:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `masukan`
--

CREATE TABLE `masukan` (
  `id_masukan` int(11) NOT NULL,
  `nama_pengirim` varchar(20) NOT NULL,
  `isi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masukan`
--

INSERT INTO `masukan` (`id_masukan`, `nama_pengirim`, `isi`) VALUES
(1, 'rafi', ''),
(2, 'gusti', ''),
(3, 'kurniawan', 'tambahi apa gitu'),
(4, 'sanji', 'yknts');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `ukuran_produk` varchar(100) NOT NULL,
  `status_produk` tinyint(1) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `deskripsi`, `gambar`, `ukuran_produk`, `status_produk`, `tanggal`) VALUES
(29, 3, 'Kaos Putih', 50000, ' Kaos putih polos nyaman dipakai,dijamain akan menambah kegantenganmu jika anda ganteng. :                     ', '6229a01444859.jpg', 'M ,L ,XL ,XXL ,XXXL ', 1, '2022-04-02 07:44:22'),
(30, 5, 'Sepatu Dhgs', 200000, '            Sepatu Dhgs ukuran 36 warna hitam,nyaman dipakai               ', '620759dd8234d.jpg', '40,43,45,46', 1, '2022-04-02 07:43:34'),
(31, 2, 'Topi mengkeren', 20000, '            Topi mengkeren aneka warna cocok dipakai cewek ataupun cowok ,MENG-KEREN               ', '6207629a693e5.jpg', 'anak-anak,remaja,dewasa', 1, '2022-04-02 07:43:14'),
(32, 1, 'Celana chino', 100000, 'Celana ini cocok buat kamu yang ingin tampil stylist ,buruan beli                                                                                                                                                        ', '620763aa705a5.jpg', '35,36,37,40', 1, '2022-04-05 14:23:15'),
(47, 5, 'sepatu unnamed', 200000, '            bagus banget tersedia ukuran 36-45               ', '622221b0bc6c4.jpg', '30,32,35,36,38,40,43', 1, '2022-04-02 07:42:59'),
(48, 10, 'jaket pria', 150000, '            dijamin bagus terbuat dari bahan terbaik nyaman dipakai,tersedia dalam warna merah,hitam,dan biru            ', '622618dc087b9.jpg', 'xl,xxl,xxxl', 1, '2022-04-02 07:42:36'),
(49, 7, 'Jam rolex', 50000, '                                    Sangat amat bagus dan keren                                ', '62299f2b7d1ef.jpg', 'anak-anak,remaja,dewasa', 1, '2022-04-02 07:42:20'),
(50, 11, 'tas hydsa', 70000, '            tersedia dalam warna hitam,putih,biru dan merah                ', '62274a0049c9d.jpg', 'anak-anak,remaja,dewasa', 1, '2022-04-02 07:42:06'),
(51, 6, 'Sandal  BCA', 20000, '                        sangat nyaman dipakai                     ', '62274a393a684.jpg', '20,30,25,26,27,40', 1, '2022-04-02 07:41:49'),
(52, 9, 'Kemeja formal', 100000, '             cocok digunakan untuk acaara formal dan non formal tersedia ukuran xl              ', '62274a867cc04.jpg', 'l,xl,xxl.xxxl', 1, '2022-04-02 07:41:21'),
(53, 8, 'gelang wanita', 10000, '                        nyaman di pakai,cocok dipakai dimana saja                                     ', '62274ab73307a.jpg', 'anak-anak,remaja,dewasa', 1, '2022-04-02 07:40:56'),
(54, 12, 'Baju batik', 100000, 'elit. Laudantium numquam perferendis aut vitae tenetur error velit atque, possimus labore, quaerat beatae. Sint, consequatur perspiciatis        ', '62274ae3b6876.jpg', 'm,s,l,xl,xxl,xxxl', 1, '2022-04-15 03:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_pelangan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `id_pelangan`, `id_produk`, `nama_pembeli`, `no_telp`, `jumlah`, `ukuran`, `Alamat`, `catatan`, `total_harga`) VALUES
(1, 1, 32, 'gusti', '085768987657', 3, '36', 'bantul', 'yang satu diganti warna hitam', 300000),
(2, 1, 47, 'gusti', '085768987657', 1, '43', 'bantul', 'tali diganti warna merah', 200000),
(5, 1, 31, 'gusti', '085768987657', 1, 'remaja', 'bantul', 'warna hitam', 20000),
(7, 1, 54, 'Rafi gusti', '089504753863', 2, 'xxl', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 200000),
(8, 1, 50, 'Rafi gusti', '089504753863', 1, 'remaja', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 70000),
(10, 1, 52, 'gust', '085789333', 2, 'xxl', 'Bantul', 'tidak ada', 200000),
(11, 1, 54, 'Rafi gusti', '089504753863', 1, 'xxl', 'tegallurung', 'tidak ada', 100000),
(12, 1, 53, 'Rafi gusti', '089504753863', 1, 'remaja', 'tegallurung', 'tidak ada', 10000),
(15, 1, 52, 'Rafi gusti', '089504753863', 1, 'xxl', 'tegallurung', 'tidak ada', 100000),
(17, 1, 47, 'Rafi gusti', '089504753863', 1, '43', 'tegallurung', 'tidak ada', 200000),
(18, 1, 32, 'Rafi gusti', '089504753863', 1, '40', 'tegallurung', 'tidak ada', 100000),
(19, 7, 50, 'Vinsmoke Sanji', '089504753863', 1, 'Dewsa', 'Barratie', 'tidak ada', 70000),
(20, 7, 53, 'Vinsmoke Sanji', '089504753863', 1, 'dewasa', 'Barratie', 'tidak ada', 10000),
(21, 7, 49, 'Vinsmoke Sanji', '089504753863', 3, 'dewasa', 'Barratie', 'tidak ada', 150000),
(22, 7, 54, 'Vinsmoke Sanji', '085789333', 1, 'xxl', 'Barratie', 'tidak ada', 100000),
(23, 7, 49, 'Vinsmoke Sanji', '085789333', 1, 'remaja', 'Barratie', 'tidak ada', 50000),
(24, 7, 54, 'vc', '085789333', 1, 'xl', 'Barratie', 'tidak ada', 100000),
(25, 7, 32, 'kurniawan', '085768987657', 2, '40', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 200000),
(26, 7, 48, 'kurniawan', '085768987657', 1, 'xxl', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 150000),
(27, 7, 29, 'zoro', '085789333997', 1, 'xxl', 'wano', 'tidak ada', 50000),
(28, 7, 30, 'zoro', '085789333997', 1, '43', 'wano', 'tidak ada', 200000),
(29, 7, 51, 'zoro', '086766768687998', 2, '40', 'wano', 'ngga ada', 40000),
(30, 7, 53, 'zoro', '086766768687998', 1, 'dewasa', 'wano', 'tidak ada', 10000),
(31, 7, 50, 'otama', '085789333997', 1, 'remaja', 'wano', 'tidak ada', 70000),
(32, 7, 32, 'franky', '085224732', 1, '40', 'water 7', 'tidak ada', 100000),
(33, 7, 29, 'franky', '085224732', 2, 'xxl', 'water 7', 'tidak ada', 100000),
(34, 7, 48, 'usop', '085789333997', 1, 'xxl', 'syrup', 'tidak ada', 150000),
(35, 7, 54, 'sanji', '085789333', 1, 'xxl', 'Pandak', 'tidak ada', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_produk`, `nama_pembeli`, `no_telp`, `jumlah`, `ukuran`, `Alamat`, `catatan`, `total_harga`) VALUES
(281, 32, 'luffy', '100010', 3, '36', 'fusha', 'yang satu diganti warna hitam', 300000),
(282, 47, 'luffy', '100010', 1, '43', 'fusha', 'tali diganti warna merah', 200000),
(283, 48, 'luffy', '100010', 1, 'xxl', 'fusha', 'tidak ada', 150000),
(284, 29, 'luffy', '100010', 2, 'xl', 'fusha', 'tidak ada', 100000),
(285, 31, 'luffy', '100010', 1, 'remaja', 'fusha', 'warna hitam', 20000),
(286, 54, 'luffy', '100010', 1, 'xl', 'fusha', 'qwertyuiop', 100000),
(287, 32, 'Rafi gusti', '089504753863', 3, '36', 'tegallurung', 'yang satu diganti warna hitam', 300000),
(288, 47, 'Rafi gusti', '089504753863', 1, '43', 'tegallurung', 'tali diganti warna merah', 200000),
(289, 48, 'Rafi gusti', '089504753863', 1, 'xxl', 'tegallurung', 'tidak ada', 150000),
(290, 29, 'Rafi gusti', '089504753863', 2, 'xl', 'tegallurung', 'tidak ada', 100000),
(291, 31, 'Rafi gusti', '089504753863', 1, 'remaja', 'tegallurung', 'warna hitam', 20000),
(292, 54, 'Rafi gusti', '089504753863', 1, 'xl', 'tegallurung', 'qwertyuiop', 100000),
(293, 32, 'gusti', '085768987657', 3, '36', 'bantul', 'yang satu diganti warna hitam', 300000),
(294, 47, 'gusti', '085768987657', 1, '43', 'bantul', 'tali diganti warna merah', 200000),
(295, 48, 'gusti', '085768987657', 1, 'xxl', 'bantul', 'tidak ada', 150000),
(296, 29, 'gusti', '085768987657', 2, 'xl', 'bantul', 'tidak ada', 100000),
(297, 31, 'gusti', '085768987657', 1, 'remaja', 'bantul', 'warna hitam', 20000),
(298, 54, 'gusti', '085768987657', 1, 'xl', 'bantul', 'qwertyuiop', 100000),
(299, 54, 'Rafi gusti', '089504753863', 2, 'xxl', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 200000),
(300, 50, 'Rafi gusti', '089504753863', 1, 'remaja', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 70000),
(301, 51, 'gust', '085789333', 1, '43', 'Bantul', 'tidak ada', 20000),
(302, 52, 'gust', '085789333', 2, 'xxl', 'Bantul', 'tidak ada', 200000),
(303, 54, 'Rafi Gusti', '08957486779686', 1, 'xl', 'tegallurung', 'tidak ada', 100000),
(304, 54, 'Rafi gusti', '089504753863', 1, 'xxl', 'tegallurung', 'tidak ada', 100000),
(305, 53, 'Rafi gusti', '089504753863', 1, 'remaja', 'tegallurung', 'tidak ada', 10000),
(306, 53, 'Rafi gusti', '089504753863', 1, 'remaja', 'tegallurung', 'tidak ada', 10000),
(307, 50, 'Rafi gusti', '089504753863', 1, 'remaja', 'tegallurung', 'tidak ada', 70000),
(308, 52, 'Rafi gusti', '089504753863', 1, 'xxl', 'tegallurung', 'tidak ada', 100000),
(309, 54, 'Rafi gusti', '089504753863', 1, 'xxl', 'tegallurung', 'tidak ada', 100000),
(310, 47, 'Rafi gusti', '089504753863', 1, '43', 'tegallurung', 'tidak ada', 200000),
(311, 32, 'Rafi gusti', '089504753863', 1, '40', 'tegallurung', 'tidak ada', 100000),
(312, 53, 'Rafi Gusti', '08957486779686', 1, 'Remaja', 'tegallurung', 'tidak ada', 10000),
(313, 50, 'Vinsmoke Sanji', '089504753863', 1, 'Dewsa', 'Barratie', 'tidak ada', 70000),
(314, 53, 'Vinsmoke Sanji', '089504753863', 1, 'dewasa', 'Barratie', 'tidak ada', 10000),
(315, 49, 'Vinsmoke Sanji', '089504753863', 3, 'dewasa', 'Barratie', 'tidak ada', 150000),
(316, 54, 'Vinsmoke Sanji', '085789333', 1, 'xxl', 'Barratie', 'tidak ada', 100000),
(317, 49, 'Vinsmoke Sanji', '085789333', 1, 'remaja', 'Barratie', 'tidak ada', 50000),
(318, 54, 'vc', '085789333', 1, 'xl', 'Barratie', 'tidak ada', 100000),
(319, 32, 'kurniawan', '085768987657', 2, '40', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 200000),
(320, 48, 'kurniawan', '085768987657', 1, 'xxl', 'Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta', 'tidak ada', 150000),
(321, 31, 'krf', '08089757824', 2, 'remaja', 'Barratie', 'raono', 40000),
(322, 29, 'zoro', '085789333997', 1, 'xxl', 'wano', 'tidak ada', 50000),
(323, 30, 'zoro', '085789333997', 1, '43', 'wano', 'tidak ada', 200000),
(324, 51, 'zoro', '086766768687998', 2, '40', 'wano', 'ngga ada', 40000),
(325, 53, 'zoro', '086766768687998', 1, 'dewasa', 'wano', 'tidak ada', 10000),
(326, 50, 'otama', '085789333997', 1, 'remaja', 'wano', 'tidak ada', 70000),
(327, 32, 'franky', '085224732', 1, '40', 'water 7', 'tidak ada', 100000),
(328, 29, 'franky', '085224732', 2, 'xxl', 'water 7', 'tidak ada', 100000),
(329, 48, 'usop', '085789333997', 1, 'xxl', 'syrup', 'tidak ada', 150000),
(330, 54, 'sanji', '085789333', 1, 'xxl', 'Pandak', 'tidak ada', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id_admin` int(11) NOT NULL,
  `name_admin` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id_admin`, `name_admin`, `username`, `password`) VALUES
(12, 'Rafi Gusti', 'admin', '$2y$10$JAGKwxZLJMgSz2e9XwSXiux4Tt5M0Aw9Fe26KFUlR89PSfjpKLsKK'),
(14, 'coba', 'test', '$2y$10$CdbgYN.p7zGCxWx0nUz29.JNWQdzLz/o/5mHbOMgdH0c6WwHQSc36');

-- --------------------------------------------------------

--
-- Table structure for table `user_pelanggan`
--

CREATE TABLE `user_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_pelanggan`
--

INSERT INTO `user_pelanggan` (`id_pelanggan`, `Nama`, `Username`, `Email`, `Password`) VALUES
(1, 'Rafi Gusti', 'Gusti', 'gustirafi49@gmail.com', '$2y$10$bTBSD.IozhF8zkwI5RzgweXHw.iUvdSc7vSykcHl55CTGkeNXbvd.'),
(7, 'sanji', 'kuro ashi', 'sanjisan@gmail.com', '$2y$10$4xSfKLHR7mccgLFIpb1teeTC5WmAZiwl.UnC9jGk4R7Pz4SLWGleW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pelanggan`
--
ALTER TABLE `detail_pelanggan`
  ADD UNIQUE KEY `id_pelangan` (`id_pelanggan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD UNIQUE KEY `id_produk` (`id_produk`,`id_pelangan`),
  ADD KEY `id_pelangan` (`id_pelangan`);

--
-- Indexes for table `komen`
--
ALTER TABLE `komen`
  ADD PRIMARY KEY (`id_komen`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `masukan`
--
ALTER TABLE `masukan`
  ADD PRIMARY KEY (`id_masukan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_pelangan` (`id_pelangan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `user_pelanggan`
--
ALTER TABLE `user_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `komen`
--
ALTER TABLE `komen`
  MODIFY `id_komen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `masukan`
--
ALTER TABLE `masukan`
  MODIFY `id_masukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_pelanggan`
--
ALTER TABLE `user_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pelanggan`
--
ALTER TABLE `detail_pelanggan`
  ADD CONSTRAINT `detail_pelanggan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `user_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_pelangan`) REFERENCES `user_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komen`
--
ALTER TABLE `komen`
  ADD CONSTRAINT `komen_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_ibfk_1` FOREIGN KEY (`id_pelangan`) REFERENCES `user_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
