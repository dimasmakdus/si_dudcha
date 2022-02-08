/*
 Navicat Premium Data Transfer

 Source Server         : phpMyAdmin
 Source Server Type    : MySQL
 Source Server Version : 80028
 Source Host           : localhost:3306
 Source Schema         : kelola_obat

 Target Server Type    : MySQL
 Target Server Version : 80028
 File Encoding         : 65001

 Date: 08/02/2022 01:00:27
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ----------------------------
-- Table structure for bulan
-- ----------------------------
DROP TABLE IF EXISTS `bulan`;
CREATE TABLE `bulan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bulan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bulan
-- ----------------------------
BEGIN;
INSERT INTO `bulan` VALUES (1, 'Januari');
INSERT INTO `bulan` VALUES (2, 'Februari');
INSERT INTO `bulan` VALUES (3, 'Maret');
INSERT INTO `bulan` VALUES (4, 'April');
INSERT INTO `bulan` VALUES (5, 'Mei');
INSERT INTO `bulan` VALUES (6, 'Juni');
INSERT INTO `bulan` VALUES (7, 'Juli');
INSERT INTO `bulan` VALUES (8, 'Agustus');
INSERT INTO `bulan` VALUES (9, 'September');
INSERT INTO `bulan` VALUES (10, 'Oktober');
INSERT INTO `bulan` VALUES (11, 'November');
INSERT INTO `bulan` VALUES (12, 'Desember');
COMMIT;

-- ----------------------------
-- Table structure for tbl_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akses`;
CREATE TABLE `tbl_akses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_akses` varchar(25) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `path` varchar(25) NOT NULL,
  `no_order` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_akses
-- ----------------------------
BEGIN;
INSERT INTO `tbl_akses` VALUES (1, 'Dashboard', 'fa-database', 'dashboard', 'Beranda');
INSERT INTO `tbl_akses` VALUES (2, 'Data Pasien', 'fa-user-nurse', 'pasien', 'Data');
INSERT INTO `tbl_akses` VALUES (3, 'Data Supplier', 'fa-capsules', 'supplier', 'Data');
INSERT INTO `tbl_akses` VALUES (4, 'Data Obat', 'fa-capsules', 'obat-obatan', 'Data');
INSERT INTO `tbl_akses` VALUES (5, 'Stok Obat', 'fa-capsules', 'stok-obat', 'Transaksi');
INSERT INTO `tbl_akses` VALUES (6, 'Resep Obat', 'fa-pills ', 'resep-obat', 'Data');
INSERT INTO `tbl_akses` VALUES (7, 'LPLPO', 'fa-notes-medical', 'permintaan-obat', '7');
INSERT INTO `tbl_akses` VALUES (8, 'Data Pengeluaran Harian', 'fa-chart-area', 'pengeluaran-harian', '8');
INSERT INTO `tbl_akses` VALUES (9, 'Laporan Barang Keluar', 'fa-print', 'laporan-barang-keluar', '9');
INSERT INTO `tbl_akses` VALUES (10, 'Pemesanan Obat', 'fa-file-import', 'pesanan-obat', '10');
INSERT INTO `tbl_akses` VALUES (11, 'Kelola Pengguna', 'fa-users', 'pengguna', '11');
INSERT INTO `tbl_akses` VALUES (12, 'Role Pengguna', 'fa-user', 'role-pengguna', '12');
INSERT INTO `tbl_akses` VALUES (22, 'Data Pemakaian Obat', 'fa-capsules', 'pemakaian-obat', 'Data');
COMMIT;

-- ----------------------------
-- Table structure for tbl_ambil_obat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ambil_obat`;
CREATE TABLE `tbl_ambil_obat` (
  `id_transaksi` int NOT NULL,
  `kode_resep` varchar(50) NOT NULL,
  `status_pasien` varchar(50) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `umur` int NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `total` bigint NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_ambil_obat
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_ambil_obat_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ambil_obat_detail`;
CREATE TABLE `tbl_ambil_obat_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jumlah` int NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `dosis_aturan_obat` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_ambil_obat_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_aturan_obat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_aturan_obat`;
CREATE TABLE `tbl_aturan_obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosis_aturan_obat` varchar(50) NOT NULL,
  `khusus` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_aturan_obat
-- ----------------------------
BEGIN;
INSERT INTO `tbl_aturan_obat` VALUES (1, '1X SEHARI 0.5 TABLET (MALAM)', 'Anak-Anak', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (2, '1X SEHARI 0.5 TABLET, SEBELUM MAKAN (MALAM)', 'Anak-Anak', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (3, '5X SEHARI 2 KAPSUL', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (4, 'BILA SAKIT KEPALA', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (5, '1X SEHARI 1 SEMPROT HIDUNG', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (6, '1X SEHARI 3 TETES PADA MATA KANAN', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (7, '1X SEHARI 4 ML', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (8, '1X SEHARI 3 SEMPROT HIDUNG', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (9, '1X SEHARI 5 INHALASI', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_aturan_obat` VALUES (10, '1X SEHARI 6 ML', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
-- Table structure for tbl_dokter
-- ----------------------------
DROP TABLE IF EXISTS `tbl_dokter`;
CREATE TABLE `tbl_dokter` (
  `kode_dokter` int NOT NULL AUTO_INCREMENT,
  `nama_dokter` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `poli` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`kode_dokter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_dokter
-- ----------------------------
BEGIN;
INSERT INTO `tbl_dokter` VALUES (2, 'Fitri', 'Perempuan', '4929029033291', '1995-08-26', 'Kalimalang', 'POLI KIA', '0000-00-00 00:00:00', '2022-01-11 09:21:41');
INSERT INTO `tbl_dokter` VALUES (3, 'Sunarya', 'Laki-Laki', '71816828738790', '1977-07-12', 'Sukaluyu', 'POLI UMUM', '0000-00-00 00:00:00', '2022-01-11 09:22:37');
INSERT INTO `tbl_dokter` VALUES (4, 'Karsa', 'Laki-Laki', '71816838738718', '1982-06-15', 'Adiarsa', 'POLI GIGI', '0000-00-00 00:00:00', '2022-01-11 09:23:20');
INSERT INTO `tbl_dokter` VALUES (5, 'Samsul', 'Laki-Laki', '48916838738757', '1993-11-26', 'Ciraos', 'POLI GIGI', '0000-00-00 00:00:00', '2022-01-11 09:23:56');
INSERT INTO `tbl_dokter` VALUES (6, 'Maryudi', 'Laki-Laki', '71816838888718', '1993-08-21', 'Santiong', 'POLI UMUM', '2022-01-11 09:18:25', '2022-01-11 09:24:42');
COMMIT;

-- ----------------------------
-- Table structure for tbl_hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hak_akses`;
CREATE TABLE `tbl_hak_akses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_role` int NOT NULL,
  `id_menu` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_hak_akses
-- ----------------------------
BEGIN;
INSERT INTO `tbl_hak_akses` VALUES (1, 1, 1);
INSERT INTO `tbl_hak_akses` VALUES (2, 1, 2);
INSERT INTO `tbl_hak_akses` VALUES (3, 1, 3);
INSERT INTO `tbl_hak_akses` VALUES (4, 1, 4);
INSERT INTO `tbl_hak_akses` VALUES (5, 1, 5);
INSERT INTO `tbl_hak_akses` VALUES (6, 1, 6);
INSERT INTO `tbl_hak_akses` VALUES (7, 1, 7);
INSERT INTO `tbl_hak_akses` VALUES (8, 1, 8);
INSERT INTO `tbl_hak_akses` VALUES (9, 1, 9);
INSERT INTO `tbl_hak_akses` VALUES (10, 1, 10);
INSERT INTO `tbl_hak_akses` VALUES (11, 1, 11);
INSERT INTO `tbl_hak_akses` VALUES (12, 1, 12);
INSERT INTO `tbl_hak_akses` VALUES (19, 3, 2);
INSERT INTO `tbl_hak_akses` VALUES (20, 3, 4);
INSERT INTO `tbl_hak_akses` VALUES (21, 3, 5);
INSERT INTO `tbl_hak_akses` VALUES (22, 3, 6);
INSERT INTO `tbl_hak_akses` VALUES (23, 5, 1);
INSERT INTO `tbl_hak_akses` VALUES (24, 5, 7);
INSERT INTO `tbl_hak_akses` VALUES (25, 5, 8);
INSERT INTO `tbl_hak_akses` VALUES (26, 5, 9);
INSERT INTO `tbl_hak_akses` VALUES (27, 3, 1);
INSERT INTO `tbl_hak_akses` VALUES (28, 5, 3);
INSERT INTO `tbl_hak_akses` VALUES (29, 5, 4);
INSERT INTO `tbl_hak_akses` VALUES (30, 5, 5);
COMMIT;

-- ----------------------------
-- Table structure for tbl_obat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_obat`;
CREATE TABLE `tbl_obat` (
  `kode_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `stok` int NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `tgl_kadaluarsa` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_obat
-- ----------------------------
BEGIN;
INSERT INTO `tbl_obat` VALUES ('GFK0001', 'Amlodipine Tablet 10 mg', 2397, 'Tablet', '2025-11-04', '2022-01-11 05:15:35', '2022-01-15 22:36:14');
INSERT INTO `tbl_obat` VALUES ('GFK0002', 'Amoxicilin Sirup Kering 250 mg/5 ml', 380, 'Botol', '2025-09-09', '2022-01-11 05:15:35', '2022-01-14 04:46:32');
INSERT INTO `tbl_obat` VALUES ('GFK0003', 'Antasida DOEN Tablet', 6185, 'Tablet', '2024-03-10', '2022-01-11 05:18:44', '2022-02-07 21:58:19');
INSERT INTO `tbl_obat` VALUES ('GFK0004', 'Asam Askorbat (Vit. C) Tablet 50 mg', 2183, 'Tablet', '2024-07-09', '2022-01-11 05:18:44', '2022-02-07 21:58:19');
INSERT INTO `tbl_obat` VALUES ('GFK0005', 'Bedak Salisil 2% - 50 gram', 3026, 'Ampul', '2023-06-13', '2022-01-11 05:20:30', '2022-02-07 21:58:19');
INSERT INTO `tbl_obat` VALUES ('GFK0006', 'Multivitamin Tablet', 41, 'Tablet', '2027-06-12', '2022-01-11 05:20:30', '2022-02-08 00:37:22');
INSERT INTO `tbl_obat` VALUES ('GFK0007', 'Acetylcystein Tablet 200 mg', 0, 'Tablet', '2027-06-12', '2022-01-13 01:00:52', '2022-02-08 00:37:22');
INSERT INTO `tbl_obat` VALUES ('GFK0008', 'askdjalksjdlasd', 0, 'Strip', '2027-06-12', '2022-01-15 03:38:44', '2022-02-08 00:37:22');
COMMIT;

-- ----------------------------
-- Table structure for tbl_pasien
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pasien`;
CREATE TABLE `tbl_pasien` (
  `no_resep` varchar(100) NOT NULL,
  `status_pasien` varchar(100) NOT NULL,
  `no_bpjs` varchar(100) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `umur` int NOT NULL,
  `alamat` text NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`no_resep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_pasien
-- ----------------------------
BEGIN;
INSERT INTO `tbl_pasien` VALUES ('000001', 'BPJS', '28287188196112', 'Niko Rahmad', 'Laki-Laki', 25, 'Serang', 'Fitri', '2022-01-11 06:02:44', '2022-01-11 06:02:44');
INSERT INTO `tbl_pasien` VALUES ('000002', 'BPJS', '28287188196156', 'Muhammad Yogi', 'Laki-Laki', 40, 'Surabaya', 'Sunarya', '2022-01-11 06:02:44', '2022-01-11 06:02:44');
INSERT INTO `tbl_pasien` VALUES ('000003', 'BPJS', '28287134996145', 'Maulida Fitria', 'Perempuan', 30, 'Karawang', 'Maryudi', '2022-01-11 06:07:17', '2022-01-11 06:07:17');
INSERT INTO `tbl_pasien` VALUES ('000004', 'UMUM', '', 'Maulana', 'Laki-Laki', 25, 'Pamulang', 'Karsa', '2022-01-11 06:07:17', '2022-01-11 06:07:17');
COMMIT;

-- ----------------------------
-- Table structure for tbl_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pembelian`;
CREATE TABLE `tbl_pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faktur` varchar(255) NOT NULL,
  `kode_pemesanan` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `kode_supplier` int DEFAULT NULL,
  `status_pembayaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`faktur`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_pembelian
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_pembelian_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pembelian_detail`;
CREATE TABLE `tbl_pembelian_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pembelian` int NOT NULL,
  `kode_obat` varchar(255) DEFAULT NULL,
  `stok_masuk` bigint DEFAULT NULL,
  `tgl_kadaluarsa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_pembelian_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_permintaan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_permintaan`;
CREATE TABLE `tbl_permintaan` (
  `id` int NOT NULL,
  `kode_pesanan` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kode_supplier` int DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `proses` int DEFAULT NULL,
  `keterangan` text,
  `total` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_permintaan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_permintaan_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_permintaan_detail`;
CREATE TABLE `tbl_permintaan_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_permintaan` int DEFAULT NULL,
  `kode_obat` varchar(255) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_permintaan_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_resep
-- ----------------------------
DROP TABLE IF EXISTS `tbl_resep`;
CREATE TABLE `tbl_resep` (
  `id_transaksi` int NOT NULL,
  `kode_resep` varchar(50) NOT NULL,
  `status_pasien` varchar(50) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `umur` int NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `total` bigint NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_resep
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_resep_detail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_resep_detail`;
CREATE TABLE `tbl_resep_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jumlah` int NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `dosis_aturan_obat` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_resep_detail
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_role
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE `tbl_role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_role
-- ----------------------------
BEGIN;
INSERT INTO `tbl_role` VALUES (1, 'Admin', NULL, NULL);
INSERT INTO `tbl_role` VALUES (3, 'Dokter', NULL, NULL);
INSERT INTO `tbl_role` VALUES (5, 'Kepala Puskesmas', '2021-12-18 07:42:38', '2021-12-18 07:42:38');
COMMIT;

-- ----------------------------
-- Table structure for tbl_stok_obat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_stok_obat`;
CREATE TABLE `tbl_stok_obat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_obat` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `stok_awal` bigint DEFAULT NULL,
  `stok_masuk` bigint DEFAULT NULL,
  `stok_keluar` bigint DEFAULT NULL,
  `stok_akhir` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_stok_obat
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tbl_supplier`;
CREATE TABLE `tbl_supplier` (
  `kode_supplier` int NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(13) NOT NULL,
  `email` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_supplier
-- ----------------------------
BEGIN;
INSERT INTO `tbl_supplier` VALUES (1, 'Novita', 'Perum Pemda', '082872878219', 'novita@gmail.com', '2021-12-20 23:10:02', '2022-01-10 23:33:24');
INSERT INTO `tbl_supplier` VALUES (2, 'Bentoman', 'Johar', '0828728726', 'johar@gmail.com', NULL, '2022-01-10 23:33:24');
INSERT INTO `tbl_supplier` VALUES (3, 'Dimas Mohammad', 'Bandung', '085723520217', 'dimasmakdus@gmail.com', NULL, '2022-01-18 18:23:22');
COMMIT;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user_role` int NOT NULL,
  `is_active` enum('y','n') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
BEGIN;
INSERT INTO `tbl_user` VALUES (1, 'Kepala Puskesmas', 'kepala@pusmaung.com', '$2y$10$Q0rG00LgNyaEtqwnNF4MOuExTwKWVm5yDnb5QN1Lq6wDR3zZLxF4a', 5, 'y', '2022-01-11 12:47:30', '2022-01-11 12:47:30');
INSERT INTO `tbl_user` VALUES (2, 'Administrator', 'admin@pusmaung.com', '$2y$10$zLYQ46r.GOCv6WihCkxqwOmhywTTKJoHFN8DpXTjFgnroAkWJmlmm', 1, 'y', '2022-01-11 12:47:57', '2022-01-11 12:47:57');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
