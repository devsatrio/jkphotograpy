-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2021 at 04:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jkphotograpy`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `kode_transaksi` text DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `metode` varchar(50) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `kode_transaksi`, `jumlah`, `keterangan`, `tgl_bayar`, `gambar`, `metode`, `created_by`, `created_at`) VALUES
(26, 'TRX-IX-21-001', 1000000, 'Pembayaran pertama / DP', '2021-09-11 17:57:54', '1631357874-pengurutan.jpg', NULL, 1, '2021-09-11 17:57:54'),
(27, 'TRX-IX-21-002', 2000000, 'Pembayaran pertama / DP', '2021-09-11 18:17:44', 'gambar_kosong', 'Transfer', 1, '2021-09-11 18:17:44'),
(28, 'TRX-IX-21-003', 2000000, 'Pembayaran pertama / DP', '2021-09-11 18:23:15', '1631359395-ss_repo.png', 'Transfer', 1, '2021-09-11 18:23:15'),
(29, 'TRX-IX-21-003', 3710000, 'pembayaran kedua', '2021-09-11 18:42:00', 'gambar_kosong', 'Cash', 1, '2021-09-11 18:43:23'),
(30, 'TRX-IX-21-002', 3500000, 'asdfsadf', '2021-09-11 18:43:00', 'gambar_kosong', 'Transfer', 1, '2021-09-11 18:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `pricelist`
--

CREATE TABLE `pricelist` (
  `id` int(11) NOT NULL,
  `nama` varchar(300) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `album` int(11) DEFAULT 0,
  `cetak` int(11) DEFAULT 0,
  `flashdisk` int(11) DEFAULT 0,
  `box` int(11) DEFAULT 0,
  `duavg` int(11) DEFAULT 0,
  `satuvg` int(11) DEFAULT 0,
  `jumlah_vg` int(11) DEFAULT NULL,
  `jumlah_pg` int(11) DEFAULT NULL,
  `jumlah_as` int(11) DEFAULT NULL,
  `asisten` int(11) DEFAULT 0,
  `editor` int(11) DEFAULT 0,
  `transport` int(11) DEFAULT 0,
  `diskon` int(11) DEFAULT 0,
  `total_biaya_produksi` int(11) DEFAULT 0,
  `harga_paket` int(11) DEFAULT 0,
  `laba` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricelist`
--

INSERT INTO `pricelist` (`id`, `nama`, `deskripsi`, `album`, `cetak`, `flashdisk`, `box`, `duavg`, `satuvg`, `jumlah_vg`, `jumlah_pg`, `jumlah_as`, `asisten`, `editor`, `transport`, `diskon`, `total_biaya_produksi`, `harga_paket`, `laba`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'Paket satu', 'klasdfj', 0, 5000, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, 5000, 2000000, 1995000, '2021-08-26 14:13:50', '2021-08-27 19:46:23', 1, 1),
(3, 'Paket Dua', NULL, 0, 200000, 0, 0, 0, 0, NULL, NULL, NULL, 0, 200000, 0, 10, 400000, 3000000, 2300000, '2021-08-27 19:46:54', '2021-08-30 08:02:54', 1, 1),
(4, 'Paket Tiga', 'asdf', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 0, 500000, 20, 500000, 4500000, 3100000, '2021-08-27 19:47:28', NULL, 1, NULL),
(5, 'pricelist empat', 'sdafds', 50000, 20000, 15000, 10000, 0, 0, NULL, NULL, NULL, 10000, 200000, 50000, 5, 355000, 3000000, 2495000, '2021-09-09 19:18:25', '2021-09-09 19:19:27', 1, 1),
(6, 'pricelist baru', 'sakdfjklasd', 1000, 2000, 2000, 5000, 500000, 500000, 1, 2, 1, 100000, 200000, 400000, 0, 1710000, 5000000, 3290000, '2021-09-11 12:25:19', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `owner` text DEFAULT NULL,
  `nama_apps` varchar(100) DEFAULT NULL,
  `nama_company` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rekening` text DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `note_invoice` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `owner`, `nama_apps`, `nama_company`, `meta`, `logo`, `alamat`, `rekening`, `instagram`, `cp`, `note_invoice`) VALUES
(4, 'deva', 'coba', 'coba', 'coba', '1631368586-qw.png', 'cobaa', 'coba', 'coba', 'coba', '<p>coba</p>');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode` text DEFAULT NULL,
  `nama_customer` varchar(300) DEFAULT NULL,
  `alamat_customer` text DEFAULT NULL,
  `telp_customer` varchar(300) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `ppn` int(11) DEFAULT 0,
  `potongan` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `laba` int(11) DEFAULT NULL,
  `dibayar` int(11) DEFAULT 0,
  `charge` int(11) DEFAULT NULL,
  `ket_charge` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tgl_buat` date DEFAULT NULL,
  `angsur` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode`, `nama_customer`, `alamat_customer`, `telp_customer`, `subtotal`, `ppn`, `potongan`, `total`, `laba`, `dibayar`, `charge`, `ket_charge`, `status`, `tgl_buat`, `angsur`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(15, 'TRX-IX-21-001', 'halo', 'asdfsdf', '08187324992387', 2000000, 0, 0, 2000000, 1995000, 1000000, 0, '-', 'Belum Lunas', '2021-09-11', 1, '2021-09-11 17:57:54', NULL, 1, NULL),
(16, 'TRX-IX-21-002', 'asdf', 'asdf', '08120938902380', 5000000, 0, 0, 5000000, 3290000, 3500000, 0, 'sdf', 'Belum Lunas', '2021-09-11', 3, '2021-09-11 18:17:44', '2021-09-11 18:44:19', 1, 1),
(17, 'TRX-IX-21-003', 'halo', 'dsfjl', '08120938902380', 3600000, 10000, 0, 3710000, 3100000, 3710000, 100000, '-', 'Lunas', '2021-09-11', 2, '2021-09-11 18:23:15', '2021-09-11 18:30:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` bigint(20) NOT NULL,
  `kode_transaksi` text DEFAULT NULL,
  `id_pricelist` int(11) DEFAULT NULL,
  `nama_pricelist` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `laba` int(11) DEFAULT 0,
  `tgl_eksekusi` datetime DEFAULT NULL,
  `lokasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `kode_transaksi`, `id_pricelist`, `nama_pricelist`, `harga`, `diskon`, `jumlah`, `total`, `laba`, `tgl_eksekusi`, `lokasi`) VALUES
(36, 'TRX-IX-21-001', 2, 'Paket satu', 2000000, 0, 1, 2000000, 1995000, '2021-09-11 12:00:00', 'kediri'),
(40, 'TRX-IX-21-003', 4, 'Paket Tiga', 4500000, 20, 1, 3600000, 3100000, '2021-09-11 12:00:00', 'gurah'),
(41, 'TRX-IX-21-002', 6, 'pricelist baru', 5000000, 0, 1, 5000000, 3290000, '2021-09-11 12:00:00', 'gurah');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail_thumb`
--

CREATE TABLE `transaksi_detail_thumb` (
  `id` bigint(20) NOT NULL,
  `kode_transaksi` text DEFAULT NULL,
  `id_pricelist` int(11) DEFAULT NULL,
  `nama_pricelist` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `laba` int(11) DEFAULT 0,
  `tgl_eksekusi` datetime DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `pembuat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_log`
--

CREATE TABLE `transaksi_log` (
  `id` bigint(20) NOT NULL,
  `kode_transaksi` text DEFAULT NULL,
  `aksi` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_log`
--

INSERT INTO `transaksi_log` (`id`, `kode_transaksi`, `aksi`, `keterangan`, `admin`, `tgl`) VALUES
(40, 'TRX-IX-21-001', 'pay', 'Menambahkan data pembayaran transaksi ke-1 / DP', 1, '2021-09-11 17:57:54'),
(41, 'TRX-IX-21-001', 'add', 'Menambahkan data transaksi', 1, '2021-09-11 17:57:54'),
(42, 'TRX-IX-21-002', 'pay', 'Menambahkan data pembayaran transaksi ke-1 / DP', 1, '2021-09-11 18:17:43'),
(43, 'TRX-IX-21-002', 'add', 'Menambahkan data transaksi', 1, '2021-09-11 18:17:44'),
(44, 'TRX-IX-21-003', 'pay', 'Menambahkan data pembayaran transaksi ke-1 / DP', 1, '2021-09-11 18:23:15'),
(45, 'TRX-IX-21-003', 'add', 'Menambahkan data transaksi', 1, '2021-09-11 18:23:15'),
(46, 'TRX-IX-21-003', 'edit', 'Mengubah data transaksi', 1, '2021-09-11 18:30:08'),
(47, 'TRX-IX-21-003', 'edit', 'Mengubah data transaksi', 1, '2021-09-11 18:30:32'),
(48, 'TRX-IX-21-003', 'pay', 'Menambahkan data pembayaran transaksi ke-2', 1, '2021-09-11 18:43:23'),
(49, 'TRX-IX-21-002', 'pay', 'Menambahkan data pembayaran transaksi ke-2', 1, '2021-09-11 18:44:07'),
(50, 'TRX-IX-21-002', 'edit', 'Mengubah data transaksi', 1, '2021-09-11 18:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `level`, `email`, `telp`, `gambar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'deva satrio damara', 'devasatrio', 'Super Admin', 'satrio@gmail.com', '0234890', '1591507920-love.png', NULL, '$2y$10$sQIyYXne5mnsZ3rEE6MNwOGweJXyWzCtFQZDWhgTNZSIjiYwvxuti', NULL, '2020-06-06 21:36:35', '2020-06-06 22:32:00'),
(2, 'arya', 'admin', 'Admin', 'anakmbarep999@gmail.com', '90284092', '1631189772-3.jpg', NULL, '$2y$10$DFc5eAV862JVdJXcQ6DbhOOboA5VJFcmzPxYCNqAYWVEJDPhApboW', NULL, NULL, '2021-09-11 14:13:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricelist`
--
ALTER TABLE `pricelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_detail_thumb`
--
ALTER TABLE `transaksi_detail_thumb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_log`
--
ALTER TABLE `transaksi_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pricelist`
--
ALTER TABLE `pricelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaksi_detail_thumb`
--
ALTER TABLE `transaksi_detail_thumb`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `transaksi_log`
--
ALTER TABLE `transaksi_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
