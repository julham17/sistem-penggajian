-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 08:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-sistem-penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `status` enum('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `karyawan_id`, `tanggal_mulai`, `tanggal_selesai`, `alasan`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-06-01', '2025-06-02', 'Nikah', 'disetujui', '2025-06-02 15:08:56', '2025-06-02 16:45:10'),
(3, 1, '2025-06-03', '2025-06-04', 'Sakit', 'ditolak', '2025-06-02 15:17:10', '2025-06-02 16:46:04'),
(5, 2, '2025-06-01', '2025-06-04', 'Nikah', 'disetujui', '2025-06-02 16:53:32', '2025-06-02 16:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` date NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tunjangan` int(11) NOT NULL DEFAULT 0,
  `potongan_cuti` int(11) NOT NULL DEFAULT 0,
  `status_kelola` varchar(255) NOT NULL DEFAULT 'belum_dibayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `karyawan_id`, `bulan`, `gaji_pokok`, `tunjangan`, `potongan_cuti`, `status_kelola`, `created_at`, `updated_at`) VALUES
(3, 3, '2025-05-01', 3200000, 300000, 0, 'sudah_dibayar', '2025-06-02 14:35:45', '2025-06-02 17:07:26'),
(4, 1, '2025-06-01', 4000000, 500000, 200000, 'belum_dibayar', '2025-06-02 16:52:02', '2025-06-02 16:52:02'),
(6, 2, '2025-06-01', 3000000, 100000, 400000, 'belum_dibayar', '2025-06-02 17:08:34', '2025-06-02 17:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `divisi` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `user_id`, `nama_lengkap`, `nip`, `jabatan`, `divisi`, `nomor_telepon`, `alamat`, `tanggal_masuk`, `created_at`, `updated_at`) VALUES
(1, 2, 'Indah Susanti', '1987001', 'Staff HR', 'HRD', '085444037154', 'Jl. Peta No. 30, Bojongloa Kaler, Bandung', '2021-06-01', '2025-06-01 07:26:07', '2025-06-01 07:26:07'),
(2, 3, 'Farhan Kurniawan', '1987002', 'Admin Gudang', 'Logistik', '083988133320', 'Jl. Pasteur No. 5, Sukajadi, Bandung', '2022-01-12', '2025-06-01 07:26:08', '2025-06-01 07:26:08'),
(3, 4, 'Eka Sari', '1987003', 'Staff Keuangan', 'Keuangan', '085033604000', 'Jl. Pasteur No. 5, Sukajadi, Bandung', '2023-02-18', '2025-06-01 07:26:08', '2025-06-01 11:00:59'),
(4, 5, 'Rizki Maulana', '1987004', 'Operator Produksi', 'Produksi', '085792304785', 'Jl. Cibaduyut No.10, Bandung', '2020-03-14', '2025-06-01 07:26:08', '2025-06-01 07:26:08'),
(5, 6, 'Dian Safitri', '1987005', 'Staff Marketing', 'Pemasaran', '085733917231', 'Jl. Braga No.27, Bandung', '2019-07-22', '2025-06-01 07:26:09', '2025-06-01 07:26:09'),
(6, 7, 'Bagas Dwi Nugroho', '1987006', 'Teknisi', 'IT Support', '087823445113', 'Jl. Sukajadi No.123, Bandung', '2021-10-05', '2025-06-01 07:26:09', '2025-06-01 11:02:59'),
(7, 8, 'Sari Wulandari', '1987007', 'Customer Service', 'Layanan Pelanggan', '081234567891', 'Jl. Setiabudi No.45, Bandung', '2022-01-10', '2025-06-01 07:26:09', '2025-06-01 07:26:09'),
(8, 9, 'Agus Hidayat', '1987008', 'Staff Logistik', 'Logistik', '085655984341', 'Jl. Kopo No.67, Bandung', '2018-09-18', '2025-06-01 07:26:09', '2025-06-01 07:26:09'),
(9, 10, 'Intan Amalia', '1987009', 'Staff Administrasi', 'Administrasi', '087734985621', 'Jl. Buah Batu No.88, Bandung', '2020-08-21', '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(10, 11, 'Yoga Permana', '1987010', 'Driver', 'Operasional', '085299773421', 'Jl. Riau No.39, Bandung', '2017-05-11', '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(11, 12, 'Nina Kartika', '1987011', 'Staff Produksi', 'Produksi', '083873456012', 'Jl. Sukarno Hatta No.25, Bandung', '2021-03-09', '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(12, 13, 'Rehan Fauzan', '1987012', 'Keamanan', 'Security', '082345678901', 'Jl. Ciumbuleuit No.12, Bandung', '2019-12-01', '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(13, 14, 'Fitri Rahmawati', '1987013', 'Analis Keuangan', 'Keuangan', '081224785421', 'Jl. Antapani No.30, Bandung', '2020-06-25', '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(14, 15, 'Indra Putra', '1987014', 'HR Staff', 'SDM', '082234875623', 'Jl. Cimindi No.19, Bandung', '2018-10-01', '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(15, 16, 'Mega Rizky', '1987015', 'Content Creator', 'Pemasaran', '083123498732', 'Jl. Sukamulya No.54, Bandung', '2022-04-17', '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(16, 17, 'Andi Sutrisna', '1987016', 'Staff Pengadaan', 'Logistik', '085723498123', 'Jl. Batununggal No.7, Bandung', '2021-07-08', '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(17, 18, 'Tika Marlina', '1987017', 'Desainer Grafis', 'Kreatif', '081233498122', 'Jl. Cisaranten No.78, Bandung', '2019-11-13', '2025-06-01 07:26:12', '2025-06-01 07:26:12'),
(18, 19, 'Budi Santoso', '1987018', 'Staff Warehouse', 'Gudang', '082122348764', 'Jl. Rancasari No.44, Bandung', '2020-12-30', '2025-06-01 07:26:12', '2025-06-01 07:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_01_122941_remove_name_from_users_table', 1),
(5, '2025_06_01_133951_create_karyawan_table', 1),
(6, '2025_06_01_142305_add_username_to_users_table', 2),
(7, '2025_06_02_143549_create_gaji_table', 3),
(8, '2025_06_02_172409_create_cuti_table', 4),
(9, '2025_06_02_193932_create_gaji_table', 5),
(10, '2025_06_02_201720_create_pembayaran_gajis_table', 6),
(11, '2025_06_02_210827_add_status_kelola_to_gaji_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_gaji`
--

CREATE TABLE `pembayaran_gaji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gaji_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_gaji`
--

INSERT INTO `pembayaran_gaji` (`id`, `gaji_id`, `tanggal_pembayaran`, `metode_pembayaran`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(3, 3, '2025-06-03', 'Transfer', 'bukti_pembayaran/rA9FT1K5OosRzWbh1chQo3wEs42umCx5qNcaeLfq.jpg', '2025-06-02 17:07:26', '2025-06-02 17:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7Rrf7H8uZf69MgTlXsECqJboi22yFL9udjwK6ONF', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1cwS2JkRU4yVER0U3VHckdKRU5KYVZMbU9oNDNBR1NKaEcwSm5hRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jdXRpL3Jpd2F5YXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyMjt9', 1748927636),
('96IjWEU7h3SRP0AoJY7OF8nX9iDsnMqbbRFp5mWn', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ0dna01FMHZQTndCNVVETWY1Vko0SHZScG9XbnJSdThTWnB0OVdKOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9nYWppIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjI7fQ==', 1748917355),
('plH9lziq6cYdWWxHkZqhJEl1CFrCWqnsN4qENGFj', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMFhTbjRYYnFPMU1USTZES1EyUk1Kd0hYR2JsVFhZQnhHMGxQc2hERyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3BlbWJheWFyYW4iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjI7fQ==', 1748917312),
('SVRTc8RIonzuKrjEd6fvsykGdUD3gBRKFeocBTLx', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV1NhTDg0dUhrUmZtUmdPTjV1bzBqRDIwVlZibW00QVQxbVNIMFh1VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9nYWppIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjI7fQ==', 1748909314);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','karyawan') NOT NULL DEFAULT 'karyawan',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'indah', 'indah.susanti@example.com', NULL, '$2y$12$a1cDmgYYKEYyzLGJD73GreXijlz/7pRGWm3p8e5dhh0uyBUOabrVG', 'karyawan', NULL, '2025-06-01 07:26:07', '2025-06-01 07:26:07'),
(3, 'farhan', 'farhan.kurniawan@example.com', NULL, '$2y$12$T6Y2OJzqJAAo9aPEi9qwEOVT681NtsSmDcXnhfmwQacK.2jemx5oe', 'karyawan', NULL, '2025-06-01 07:26:08', '2025-06-01 07:26:08'),
(4, 'eka', 'eka.sari@example.com', NULL, '$2y$12$jLxvjJlQNRGOqEnmrCdLzuVTcJbVyu0gVGPLiEqyzl5Gcef..qkii', 'karyawan', NULL, '2025-06-01 07:26:08', '2025-06-01 07:26:08'),
(5, 'rizki', 'rizki.maulana@example.com', NULL, '$2y$12$Qp2cu.Ok1SHsIixnjEBpCu4UTwoMfLl.ybDboNFxvCd7wwzpBDRdq', 'karyawan', NULL, '2025-06-01 07:26:08', '2025-06-01 07:26:08'),
(6, 'dian', 'dian.safitri@example.com', NULL, '$2y$12$sirTZmqm/SlmfPccAUyLY.xXRuuPDPcTQN4m0qV.J.tM1tJLokwr2', 'karyawan', NULL, '2025-06-01 07:26:09', '2025-06-01 07:26:09'),
(7, 'bagas', 'bagas.tri@example.com', NULL, '$2y$12$2fSGuzhYoxqBsxUG.IMTVeZyZ192ksn5J9xHbUwstA4ck/okHZyA2', 'karyawan', NULL, '2025-06-01 07:26:09', '2025-06-01 07:26:09'),
(8, 'sari', 'sari.wulandari@example.com', NULL, '$2y$12$pSfrTy18gWwXlx6pMtYj7eEjFTQ3r.fpN0ladRmOssEeY26yiPeKu', 'karyawan', NULL, '2025-06-01 07:26:09', '2025-06-01 07:26:09'),
(9, 'agus', 'agus.hidayat@example.com', NULL, '$2y$12$9oBkBnp35aAcQm/96sfcYOAfOVjrtMlZbW6KLNo1fhQOt2O8/koYK', 'karyawan', NULL, '2025-06-01 07:26:09', '2025-06-01 07:26:09'),
(10, 'intan', 'intan.amalia@example.com', NULL, '$2y$12$QgRs4CTTXb6.3BGNeUVh1uQGYjPwf8TVpsMhibBDlb90F770Ydip2', 'karyawan', NULL, '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(11, 'yoga', 'yoga.permana@example.com', NULL, '$2y$12$Z1QLszQN9LbaDefnTIuP/eFENW517bM5w/yxGNuHDzyXJKNNV6Kae', 'karyawan', NULL, '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(12, 'nina', 'nina.kartika@example.com', NULL, '$2y$12$R/EeJ4R3vX0fu1uccxf1Cu/ieEvz5uSTryRXgdzUhb488bgvk1Yea', 'karyawan', NULL, '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(13, 'rehan', 'rehan.fauzan@example.com', NULL, '$2y$12$UY3qciEd5eW5N6ZT6AyMCewq0zF.ZzUApEo9KzsbKfsXiJ7JYehoa', 'karyawan', NULL, '2025-06-01 07:26:10', '2025-06-01 07:26:10'),
(14, 'fitri', 'fitri.rahmawati@example.com', NULL, '$2y$12$vT/EAbwWOGDJCOXgal7TgOyXZJnesqg0N0xVrFQ6Cng5n/hHuGvwi', 'karyawan', NULL, '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(15, 'indra', 'indra.putra@example.com', NULL, '$2y$12$KliUI7y3s3knETNbzSgVAuSkd.iWNGy6hL6rbrjfZ4h27l4aFqOle', 'karyawan', NULL, '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(16, 'mega', 'mega.rizky@example.com', NULL, '$2y$12$BVt4mKvOa/ifFGUD9eTEYeJQBEN6UcJKu/q.s8iFuoYDtYsQ8R3lS', 'karyawan', NULL, '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(17, 'andi', 'andi.sutrisna@example.com', NULL, '$2y$12$HZl54nJVqTSe92VKsUYnM.YM04sOpZiQj0Qz4VG2e28fXu4/fmQC.', 'karyawan', NULL, '2025-06-01 07:26:11', '2025-06-01 07:26:11'),
(18, 'tika', 'tika.marlina@example.com', NULL, '$2y$12$StQZXSNkT.dqXaBNK94bP.9LWKgp/GAm2XyeH4KQlvyNclTk.Kg2y', 'karyawan', NULL, '2025-06-01 07:26:12', '2025-06-01 07:26:12'),
(19, 'budi', 'budi.santoso@example.com', NULL, '$2y$12$2gEsvwbmjAs9Jq.oEUUSUeMxDcBNYAB9R4v1QnyoHdhxChWYZcbg2', 'karyawan', NULL, '2025-06-01 07:26:12', '2025-06-01 07:26:12'),
(22, 'admin', 'admin@admin.com', NULL, '$2y$12$JHxkAnVMAPPuviihYilcgugwIVAnBESLL3DkESFswsrnDePAx.fqS', 'admin', NULL, '2025-06-01 07:28:56', '2025-06-01 07:28:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuti_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawan_nip_unique` (`nip`),
  ADD KEY `karyawan_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran_gaji`
--
ALTER TABLE `pembayaran_gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_gaji_gaji_id_foreign` (`gaji_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembayaran_gaji`
--
ALTER TABLE `pembayaran_gaji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_gaji`
--
ALTER TABLE `pembayaran_gaji`
  ADD CONSTRAINT `pembayaran_gaji_gaji_id_foreign` FOREIGN KEY (`gaji_id`) REFERENCES `gaji` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
