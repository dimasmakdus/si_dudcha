-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Jan 2022 pada 18.52
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelola_obat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akses`
--

CREATE TABLE `tbl_akses` (
  `id` int(11) NOT NULL,
  `nama_akses` varchar(25) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `path` varchar(25) NOT NULL,
  `no_order` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_akses`
--

INSERT INTO `tbl_akses` (`id`, `nama_akses`, `icon`, `path`, `no_order`) VALUES
(1, 'Dashboard', 'fa-database', 'dashboard', 'Beranda'),
(2, 'Data Pasien', 'fa-user-nurse', 'pasien', 'Data'),
(3, 'Data Supplier', 'fa-capsules', 'supplier', 'Data'),
(4, 'Data Obat', 'fa-capsules', 'obat-obatan', 'Data'),
(5, 'Stok Obat', 'fa-capsules', 'stok-obat', 'Transaksi'),
(6, 'Resep Obat', 'fa-pills ', 'resep-obat', 'Data'),
(7, 'LPLPO', 'fa-notes-medical', 'permintaan-obat', '7'),
(8, 'Data Pengeluaran Harian', 'fa-chart-area', 'pengeluaran-harian', '8'),
(9, 'Laporan Barang Keluar', 'fa-print', 'laporan-barang-keluar', '9'),
(10, 'Pemesanan Obat', 'fa-file-import', 'pesanan-obat', '10'),
(11, 'Kelola Pengguna', 'fa-users', 'pengguna', '11'),
(12, 'Role Pengguna', 'fa-user', 'role-pengguna', '12'),
(22, 'Data Pemakaian Obat', 'fa-capsules', 'pemakaian-obat', 'Data');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aturan_obat`
--

CREATE TABLE `tbl_aturan_obat` (
  `id` int(11) NOT NULL,
  `dosis_aturan_obat` varchar(50) NOT NULL,
  `khusus` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_aturan_obat`
--

INSERT INTO `tbl_aturan_obat` (`id`, `dosis_aturan_obat`, `khusus`, `created_at`, `updated_at`) VALUES
(1, '1X SEHARI 0.5 TABLET (MALAM)', 'Anak-Anak', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '1X SEHARI 0.5 TABLET, SEBELUM MAKAN (MALAM)', 'Anak-Anak', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '5X SEHARI 2 KAPSUL', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'BILA SAKIT KEPALA', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '1X SEHARI 1 SEMPROT HIDUNG', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '1X SEHARI 3 TETES PADA MATA KANAN', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '1X SEHARI 4 ML', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '1X SEHARI 3 SEMPROT HIDUNG', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '1X SEHARI 5 INHALASI', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '1X SEHARI 6 ML', 'Dewasa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dokter`
--

CREATE TABLE `tbl_dokter` (
  `kode_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `tgl_lahir` varchar(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `poli` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`kode_dokter`, `nama_dokter`, `jenis_kelamin`, `nid`, `tgl_lahir`, `alamat`, `poli`, `created_at`, `updated_at`) VALUES
(2, 'Fitri', 'Perempuan', '4929029033291', '1995-08-26', 'Kalimalang', 'POLI KIA', '0000-00-00 00:00:00', '2022-01-11 09:21:41'),
(3, 'Sunarya', 'Laki-Laki', '71816828738790', '1977-07-12', 'Sukaluyu', 'POLI UMUM', '0000-00-00 00:00:00', '2022-01-11 09:22:37'),
(4, 'Karsa', 'Laki-Laki', '71816838738718', '1982-06-15', 'Adiarsa', 'POLI GIGI', '0000-00-00 00:00:00', '2022-01-11 09:23:20'),
(5, 'Samsul', 'Laki-Laki', '48916838738757', '1993-11-26', 'Ciraos', 'POLI GIGI', '0000-00-00 00:00:00', '2022-01-11 09:23:56'),
(6, 'Maryudi', 'Laki-Laki', '71816838888718', '1993-08-21', 'Santiong', 'POLI UMUM', '2022-01-11 09:18:25', '2022-01-11 09:24:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(19, 3, 2),
(20, 3, 4),
(21, 3, 5),
(22, 3, 6),
(23, 5, 1),
(24, 5, 7),
(25, 5, 8),
(26, 5, 9),
(27, 3, 1),
(28, 5, 3),
(29, 5, 4),
(30, 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `kode_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `tgl_kadaluarsa` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_obat`
--

INSERT INTO `tbl_obat` (`kode_obat`, `nama_obat`, `stok`, `satuan`, `tgl_kadaluarsa`, `created_at`, `updated_at`) VALUES
('GFK0001', 'Amlodipine Tablet 10 mg', 2397, 'Tablet', '', '2022-01-11 05:15:35', '2022-01-15 22:36:14'),
('GFK0002', 'Amoxicilin Sirup Kering 250 mg/5 ml', 380, 'Botol', '', '2022-01-11 05:15:35', '2022-01-14 04:46:32'),
('GFK0003', 'Antasida DOEN Tablet', 6192, 'Tablet', '', '2022-01-11 05:18:44', '2022-01-15 22:55:59'),
('GFK0004', 'Asam Askorbat (Vit. C) Tablet 50 mg', 2195, 'Tablet', '', '2022-01-11 05:18:44', '2022-01-16 00:35:17'),
('GFK0005', 'Bedak Salisil 2% - 50 gram', 38, 'Sachet', '', '2022-01-11 05:20:30', '2022-01-15 22:55:59'),
('GFK0006', 'Multivitamin Tablet', 3262, 'Tablet', '', '2022-01-11 05:20:30', '2022-01-16 00:35:17'),
('GFK0007', 'Acetylcystein Tablet 200 mg', 0, 'Tablet', '', '2022-01-13 01:00:52', '2022-01-13 01:00:52'),
('GFK0008', 'askdjalksjdlasd', 0, 'Ampul', '', '2022-01-15 03:38:44', '2022-01-15 03:38:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `no_resep` varchar(100) NOT NULL,
  `status_pasien` varchar(100) NOT NULL,
  `no_bpjs` varchar(100) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`no_resep`, `status_pasien`, `no_bpjs`, `nama_pasien`, `jenis_kelamin`, `umur`, `alamat`, `nama_dokter`, `created_at`, `updated_at`) VALUES
('000001', 'BPJS', '28287188196112', 'Niko Rahmad', 'Laki-Laki', 25, 'Serang', 'Fitri', '2022-01-11 06:02:44', '2022-01-11 06:02:44'),
('000002', 'BPJS', '28287188196156', 'Muhammad Yogi', 'Laki-Laki', 40, 'Surabaya', 'Sunarya', '2022-01-11 06:02:44', '2022-01-11 06:02:44'),
('000003', 'BPJS', '28287134996145', 'Maulida Fitria', 'Perempuan', 30, 'Karawang', 'Maryudi', '2022-01-11 06:07:17', '2022-01-11 06:07:17'),
('000004', 'UMUM', '', 'Maulana', 'Laki-Laki', 25, 'Pamulang', 'Karsa', '2022-01-11 06:07:17', '2022-01-11 06:07:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id` int(11) NOT NULL,
  `faktur` varchar(255) NOT NULL,
  `kode_pemesanan` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` bigint(60) DEFAULT NULL,
  `kode_supplier` int(11) DEFAULT NULL,
  `status_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id`, `faktur`, `kode_pemesanan`, `tanggal`, `total`, `kode_supplier`, `status_pembayaran`) VALUES
(1, '000.14.1234567', 'P20210700001', '2021-07-17 20:22:58', 20500, 1, 'true'),
(2, '1030985734956', 'P20210700001', '2021-07-20 01:28:47', 290000, 1, 'true'),
(3, 'Contoh', 'P20210700002', '2021-07-25 21:58:04', 275000, 1, 'false'),
(4, '1234575765786578645675', 'P20210700006', '2021-09-05 00:21:09', 350000, 1, 'false'),
(5, 'aasdasd123123', 'P20220100010', '2022-01-15 11:48:21', 20000, 1, 'false'),
(6, '123123hkjhkjh', 'P20210900009', '2022-01-15 11:49:22', 700000, 2, 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian_detail`
--

CREATE TABLE `tbl_pembelian_detail` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kode_obat` varchar(255) DEFAULT NULL,
  `harga_beli` bigint(60) DEFAULT NULL,
  `stok_masuk` bigint(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembelian_detail`
--

INSERT INTO `tbl_pembelian_detail` (`id`, `id_pembelian`, `kode_obat`, `harga_beli`, `stok_masuk`) VALUES
(1, 1, 'GFK0003', 8500, 1),
(2, 1, 'GFK0002', 12000, 1),
(3, 2, 'GFK0003', 8500, 20),
(4, 2, 'GFK0002', 12000, 10),
(5, 3, 'GFK0001', 5500, 50),
(6, 4, 'GFK0003', 70000, 5),
(7, 5, 'GFK0001', 2000, 10),
(8, 6, 'GFK0004', 10000, 70);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengeluaran_obat`
--

CREATE TABLE `tbl_pengeluaran_obat` (
  `id_pengeluaran` varchar(6) NOT NULL,
  `no_terima_obat` char(15) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `kode_obat` varchar(5) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `dosis_aturan_obat` varchar(50) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tgl_serah_obat` char(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengeluaran_obat`
--

INSERT INTO `tbl_pengeluaran_obat` (`id_pengeluaran`, `no_terima_obat`, `nama_pasien`, `kode_obat`, `nama_obat`, `jenis_obat`, `dosis_aturan_obat`, `jumlah`, `satuan`, `keterangan`, `tgl_serah_obat`, `created_at`, `updated_at`) VALUES
('0001', 'S-180620-0001', 'Oman', 'K-198', 'Paracetamol', 'Tablet', '3 x 1 Sehari Setelah Makan', 5, 'Strip', 'ok', '20-06-2018', NULL, NULL),
('0002', 'S-180620-0002', 'Niko Rahmad', 'A-989', 'Salicyl', 'Bedak', '3 x 1 sehari', 1, 'Buah', 'ok', '20-06-2018', NULL, NULL),
('0001', 'S-180621-0001', 'Niko Rahmad', 'A-989', 'Salicyl', 'Bedak', '3 x 1 sehari', 4, 'Buah', 'an', '21-06-2018', NULL, NULL),
('0002', 'S-180621-0002', 'Oman', 'K-198', 'Paracetamol', 'Tablet', '3 x 1 Sehari Setelah Makan', 2, 'Strip', 'ad', '21-06-2018', NULL, NULL),
('0001', 'S-180624-0001', 'Muhammad Yogi', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 3, 'Botol', 'ok', '24-06-2018', NULL, NULL),
('0002', 'S-180624-0002', 'Oman', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 3, 'Botol', 'ok', '24-06-2018', NULL, NULL),
('0001', 'S-180630-0001', 'Niko Rahmad', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 1, 'Botol', 'ok', '30-06-2018', NULL, NULL),
('0001', 'S-180710-0001', 'Diana', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 2, 'Botol', 'ok', '10-07-2018', NULL, NULL),
('0001', 'S-211222-0001', 'Muhammad Yogi', 'P-332', 'PoliSaxechona', 'Cairan Alkohol', 'Setiap pakai 10 ml', 6, 'Botol', 'Di minum setelah makan', '22-12-2021', '2021-12-22 03:41:40', '2021-12-22 03:41:40'),
('0002', 'S-211222-0002', 'Maulida Fitria', 'MP-29', 'Sun', 'Makanan PG', '-', 8, 'Buah', 'Makanan PG', '22-12-2021', '2021-12-22 03:42:30', '2021-12-22 03:42:30');

--
-- Trigger `tbl_pengeluaran_obat`
--
DELIMITER $$
CREATE TRIGGER `pengeluaran_obat` AFTER INSERT ON `tbl_pengeluaran_obat` FOR EACH ROW BEGIN
UPDATE tbl_stok_obat
SET jumlah = jumlah - new.jumlah
WHERE kode_obat= new.kode_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_permintaan`
--

CREATE TABLE `tbl_permintaan` (
  `id` int(11) NOT NULL,
  `kode_pesanan` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kode_supplier` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `proses` int(1) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_permintaan`
--

INSERT INTO `tbl_permintaan` (`id`, `kode_pesanan`, `tanggal`, `kode_supplier`, `status`, `proses`, `keterangan`, `total`) VALUES
(1, 'P20220100001', '2022-01-16 10:54:54', 3, 'approved', 0, NULL, NULL),
(2, 'P20220100002', '2022-01-17 16:20:25', 1, 'approved', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_permintaan_detail`
--

CREATE TABLE `tbl_permintaan_detail` (
  `id` int(11) NOT NULL,
  `id_permintaan` int(11) DEFAULT NULL,
  `kode_obat` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_permintaan_detail`
--

INSERT INTO `tbl_permintaan_detail` (`id`, `id_permintaan`, `kode_obat`, `stok`) VALUES
(1, 1, 'GFK0007', 3000),
(2, 1, 'GFK0008', 2500),
(3, 1, 'GFK0005', 1400),
(4, 1, 'GFK0006', NULL),
(5, 2, 'GFK0005', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kode_obat` varchar(30) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(30) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `email_supplier` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `kode_obat`, `nama_obat`, `jenis_obat`, `satuan`, `jumlah`, `nama_supplier`, `email_supplier`, `status`, `created_at`, `updated_at`) VALUES
(1, 'P-332', 'PoliSaxechona', 'Cairan Alkohol', 'Botol', '500', 'Novita', 'novita@gmail.com', 'Terkirim', '2021-12-20 10:12:39', '2021-12-20 10:12:39'),
(2, 'SD-65', 'Polivanol', 'Obat Tetes Luka', 'Botol', '200', 'Novita', 'novita@gmail.com', 'Terkirim', '2021-12-20 10:13:10', '2021-12-20 10:13:10'),
(3, 'SN-11', 'Alpara', 'Kapsul', 'Strip', '50', 'Bentoman', 'bentoman@gmail.com', 'Terkirim', '2021-12-20 10:13:24', '2021-12-20 10:13:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_resep`
--

CREATE TABLE `tbl_resep` (
  `id_transaksi` int(11) NOT NULL,
  `kode_resep` varchar(50) NOT NULL,
  `status_pasien` varchar(50) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama_dokter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_resep`
--

INSERT INTO `tbl_resep` (`id_transaksi`, `kode_resep`, `status_pasien`, `nama_pasien`, `umur`, `alamat`, `tanggal`, `nama_dokter`) VALUES
(1, '000002', 'BPJS', 'Muhammad Yogi', 40, 'Surabaya', '2022-01-16 00:35:17', 'Sunarya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_resep_detail`
--

CREATE TABLE `tbl_resep_detail` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `dosis_aturan_obat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_resep_detail`
--

INSERT INTO `tbl_resep_detail` (`id`, `id_transaksi`, `kode_obat`, `nama_obat`, `jumlah`, `satuan`, `dosis_aturan_obat`) VALUES
(1, 1, 'GFK0004', 'Asam Askorbat (Vit. C) Tablet 50 mg', 1, 'Tablet', 'BILA SAKIT KEPALA'),
(2, 1, 'GFK0006', 'Multivitamin Tablet', 1, 'Tablet', '1X SEHARI 5 INHALASI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_role`
--

INSERT INTO `tbl_role` (`id_role`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(3, 'Dokter', NULL, NULL),
(5, 'Kepala Puskesmas', '2021-12-18 07:42:38', '2021-12-18 07:42:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_stok_obat`
--

CREATE TABLE `tbl_stok_obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `stok_awal` bigint(60) DEFAULT NULL,
  `stok_masuk` bigint(60) DEFAULT NULL,
  `stok_keluar` bigint(60) DEFAULT NULL,
  `stok_akhir` bigint(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_stok_obat`
--

INSERT INTO `tbl_stok_obat` (`id`, `kode_obat`, `tanggal`, `stok_awal`, `stok_masuk`, `stok_keluar`, `stok_akhir`) VALUES
(1, 'GFK0002', '2021-07-20 01:27:58', 21, NULL, 1, 20),
(2, 'GFK0003', '2021-07-20 01:28:47', 15, 20, NULL, 25),
(3, 'GFK0002', '2021-07-20 01:28:47', 20, 10, NULL, 30),
(4, 'GFK0001', '2021-07-25 21:58:04', 0, 50, NULL, 50),
(5, 'GFK0001', '2021-08-09 20:41:27', 50, NULL, 11, 39),
(6, 'GFK0002', '2021-08-09 20:41:27', 30, NULL, 1, 29),
(7, 'GFK0003', '2021-08-09 20:41:27', 25, NULL, 1, 24),
(8, 'GFK0003', '2021-09-05 00:21:09', 24, 5, NULL, 29),
(9, 'GFK0001', '2022-01-12 01:54:55', 39, NULL, 1, 38),
(10, 'GFK0002', '2022-01-12 01:54:55', 29, NULL, 1, 28),
(11, 'GFK0003', '2022-01-12 01:54:55', 29, NULL, 1, 28),
(12, 'GFK0003', '2022-01-12 10:52:02', 28, NULL, 1, 27),
(13, 'GFK0001', '2022-01-15 11:48:21', 38, 10, NULL, 48),
(14, 'GFK0004', '2022-01-15 11:49:22', 0, 70, NULL, 70),
(15, 'GFK0003', '2022-01-16 10:50:47', 27, NULL, 10, 17),
(16, 'GFK0003', '2022-01-16 10:51:17', 17, NULL, 8, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `kode_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(13) NOT NULL,
  `email` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `no_telpon`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Novita', 'Perum Pemda', '082872878219', 'novita@gmail.com', '2021-12-20 23:10:02', '2022-01-10 23:33:24'),
(2, 'Bentoman', 'Johar', '0828728726', 'johar@gmail.com', NULL, '2022-01-10 23:33:24'),
(3, 'Dimas Mohammad', 'Bandung', '085723520217', 'dimas@gmail.com', NULL, '2022-01-10 23:33:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_user_role` int(11) NOT NULL,
  `is_active` enum('y','n') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `full_name`, `email`, `password`, `id_user_role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Puskesmas', 'kepala@pusmaung.com', '$2y$10$Q0rG00LgNyaEtqwnNF4MOuExTwKWVm5yDnb5QN1Lq6wDR3zZLxF4a', 5, 'y', '2022-01-11 12:47:30', '2022-01-11 12:47:30'),
(2, 'Administrator', 'admin@pusmaung.com', '$2y$10$zLYQ46r.GOCv6WihCkxqwOmhywTTKJoHFN8DpXTjFgnroAkWJmlmm', 1, 'y', '2022-01-11 12:47:57', '2022-01-11 12:47:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_akses`
--
ALTER TABLE `tbl_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_aturan_obat`
--
ALTER TABLE `tbl_aturan_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  ADD PRIMARY KEY (`kode_dokter`);

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indeks untuk tabel `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`no_resep`);

--
-- Indeks untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id`,`faktur`) USING BTREE;

--
-- Indeks untuk tabel `tbl_pembelian_detail`
--
ALTER TABLE `tbl_pembelian_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `tbl_pengeluaran_obat`
--
ALTER TABLE `tbl_pengeluaran_obat`
  ADD PRIMARY KEY (`no_terima_obat`),
  ADD KEY `no_terima_obat` (`no_terima_obat`),
  ADD KEY `no_terima_obat_2` (`no_terima_obat`),
  ADD KEY `no_terima_obat_3` (`no_terima_obat`);

--
-- Indeks untuk tabel `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_permintaan_detail`
--
ALTER TABLE `tbl_permintaan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `tbl_resep`
--
ALTER TABLE `tbl_resep`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_resep_detail`
--
ALTER TABLE `tbl_resep_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tbl_stok_obat`
--
ALTER TABLE `tbl_stok_obat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_akses`
--
ALTER TABLE `tbl_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tbl_aturan_obat`
--
ALTER TABLE `tbl_aturan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  MODIFY `kode_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian_detail`
--
ALTER TABLE `tbl_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_permintaan_detail`
--
ALTER TABLE `tbl_permintaan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_resep_detail`
--
ALTER TABLE `tbl_resep_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_stok_obat`
--
ALTER TABLE `tbl_stok_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `kode_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
