-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Nov 2021 pada 03.35
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
-- Struktur dari tabel `tbl_bukti_barang_keluar`
--

CREATE TABLE `tbl_bukti_barang_keluar` (
  `id` int(11) NOT NULL,
  `penerima` varchar(20) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `laporan_bulan` varchar(10) NOT NULL,
  `permintaan_bulan` varchar(10) NOT NULL,
  `nama_barang` varchar(15) NOT NULL,
  `expire` varchar(15) NOT NULL,
  `batch` varchar(15) NOT NULL,
  `anggaran` varchar(20) NOT NULL,
  `pemberian` varchar(15) NOT NULL,
  `satuan` int(11) NOT NULL,
  `kemasan` varchar(15) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `kode_obat` varchar(5) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `dosis_aturan_obat` varchar(40) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_obat`
--

INSERT INTO `tbl_obat` (`kode_obat`, `nama_obat`, `jenis_obat`, `dosis_aturan_obat`, `satuan`, `created_at`, `updated_at`) VALUES
('A-282', 'Anexsamol', 'Kapsul', '2x1 Sehari', 'Strip', NULL, NULL),
('A-989', 'Salicyl', 'Bedak', '3 x 1 sehari', 'Buah', NULL, NULL),
('D-118', 'Dextrane', 'Tablet', '3x1 Sehari', 'Strip', NULL, NULL),
('MP-29', 'Sun', 'Makanan PG', '-', 'Buah', NULL, NULL),
('P-332', 'PoliSaxechon', 'Cairan Alkohol', 'Setiap pakai 10 ml', 'Botol', NULL, NULL),
('PG-58', 'Pil Vitamin A', 'Suplemen', '3 x 1 Sehari', 'Strip', NULL, NULL),
('SD-65', 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 'Botol ', NULL, NULL),
('SN-11', 'Alpara', 'Kapsul', '3x1 Sehari', 'Strip', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `no_rekamedis` char(6) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `no_bpjs` varchar(20) NOT NULL,
  `nama_pasien` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `status_pasien` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`no_rekamedis`, `no_ktp`, `no_bpjs`, `nama_pasien`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `status_pasien`, `created_at`, `updated_at`) VALUES
('000001', '3215021831771822', '28287188196112', 'Niko Rahmad', 'L', 'Bandung', '29-03-1992', 'Serang', 'BPJS', NULL, NULL),
('000002', '3215021621771800', '28287188196128', 'Oman', 'L', 'Cirebon', '19-07-1989', 'OK', 'BPJS', NULL, NULL),
('000003', '3335021831771822', '28287188196156', 'Muhammad Yogi', 'L', 'Surabaya', '09-02-1993', 'okkk', 'BPJS', NULL, NULL),
('000004', '3215089831777722', '28287188196139', 'Yulia', 'P', 'Cicaheum', '06-07-1994', 'Serdang', 'BPJS', NULL, NULL),
('000005', '3015021831271822', '28287188196145', 'Diana', 'P', 'See Do Are Jo', '09-07-1995', 'CKM', 'BPJS', NULL, NULL),
('000006', '3015021899271822', '28287134996145', 'Maulida Fitria', 'P', 'Karawang', '26-12-1984', 'Jatirasa', 'BPJS', NULL, NULL),
('000007', '3218291973381903', '28287188096166', 'Rian', 'L', 'Kuningan', '18-07-1978', 'Kosambi', 'BPJS', NULL, NULL),
('000008', '3349021991771822', '-', 'Maulana', 'L', 'Lamongan', '19-03-1999', 'Pamelang', 'Umum', NULL, NULL);

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
('0001', 'S-180710-0001', 'Diana', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 2, 'Botol', 'ok', '10-07-2018', NULL, NULL);

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
-- Struktur dari tabel `tbl_permintaan_obat`
--

CREATE TABLE `tbl_permintaan_obat` (
  `id_permintaan` varchar(6) NOT NULL,
  `no_trans` varchar(15) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `kode_obat` varchar(5) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_transaksi` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_permintaan_obat`
--

INSERT INTO `tbl_permintaan_obat` (`id_permintaan`, `no_trans`, `supplier`, `kode_obat`, `nama_obat`, `jenis_obat`, `harga_beli`, `jumlah`, `satuan`, `keterangan`, `total`, `tgl_transaksi`, `created_at`, `updated_at`) VALUES
('0002', 'B-180621-0002', 'Bentoman', 'A-989', 'Salicyl', 'Bedak', 320000, 3, 'Buah', 'ok', 960000, '21-06-2018', NULL, NULL),
('0001', 'B-180623-0001', 'Novita', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 679000, 5, 'Botol', 'ok', 3395000, '23-06-2018', NULL, NULL),
('0001', 'B-180624-0001', 'Novita', 'SN-11', 'Alpara', 'Tablet', 565000, 20, 'Strip', 'ok', 11300000, '24-06-2018', NULL, NULL),
('0004', 'B-180624-0004', 'Novita', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 1230000, 25, 'Botol', 'ok', 30750000, '24-06-2018', NULL, NULL),
('0001', 'B-180706-0001', 'Novita', 'SD-65', 'Polivanol', 'Obat Tetes Luka', 479000, 3, 'Botol', 'ok', 1437000, '06-07-2018', NULL, NULL),
('0001', 'B-180710-0001', 'Saomanz', 'SN-11', 'Alpara', 'Tablet', 190000, 190, 'Botol', 'ok', 36100000, '10-07-2018', NULL, NULL),
('0001', 'B-180717-0001', 'Novita', 'D-118', 'Dextrane', 'Tablet', 3450, 2000, 'Strip', 'Ok', 6900000, '17-07-2018', NULL, NULL),
('0001', 'B-180726-0001', 'Bentoman', 'P-332', 'PoliSaxechon', 'Cairan Alkohol', 50000, 4, 'Botol', 'ok', 200000, '26-07-2018', NULL, NULL);

--
-- Trigger `tbl_permintaan_obat`
--
DELIMITER $$
CREATE TRIGGER `pengadaan_obat` AFTER INSERT ON `tbl_permintaan_obat` FOR EACH ROW BEGIN
INSERT into tbl_stok_obat SET
kode_obat = NEW.kode_obat, jumlah = New.jumlah
ON DUPLICATE KEY UPDATE jumlah=jumlah+New.jumlah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_resep_obat`
--

CREATE TABLE `tbl_resep_obat` (
  `kode_resep` int(4) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `dosis_aturan_obat` varchar(40) NOT NULL,
  `jumlah_obat` int(2) NOT NULL,
  `no_rawat` varchar(18) NOT NULL,
  `no_rekamedis` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_resep_obat`
--

INSERT INTO `tbl_resep_obat` (`kode_resep`, `nama_obat`, `jenis_obat`, `dosis_aturan_obat`, `jumlah_obat`, `no_rawat`, `no_rekamedis`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Salicyl', 'Bedak', '3 x 1 sehari', 2, '2018/06/24/0001', '000002', '2018-06-24', NULL, NULL),
(2, 'Salicyl', 'Bedak', '3 x 1 sehari', 4, '2018/06/24/0001', '000002', '2018-06-24', NULL, NULL),
(3, 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 1, '2018/06/25/0001', '000002', '2018-06-25', NULL, NULL),
(4, 'Alpara', 'Tablet', '3x1 Sehari', 1, '2018/06/30/0001', '000002', '2018-06-30', NULL, NULL),
(5, 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 2, '2018/07/03/0001', '000003', '2018-07-03', NULL, NULL),
(6, 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 1, '2018/07/04/0001', '000003', '2018-07-04', NULL, NULL),
(7, 'Alpara', 'Tablet', '3x1 Sehari', 1, '2018/07/06/0002', '000003', '2018-07-06', NULL, NULL),
(8, 'Polivanol', 'Obat Tetes Luka', 'Setiap pakai 50 ml', 1, '2018-07-14-0001', '000001', '2018-07-14', NULL, NULL),
(9, 'Anexsamol', 'Kapsul', '2x1 Sehari', 1, '2018-07-17-0002', '000003', '2018-07-17', NULL, NULL);

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
(2, 'Apoteker', NULL, NULL),
(3, 'Dokter', NULL, NULL),
(4, 'Pendaftar', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_stok_obat`
--

CREATE TABLE `tbl_stok_obat` (
  `kode_obat` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_stok_obat`
--

INSERT INTO `tbl_stok_obat` (`kode_obat`, `jumlah`, `satuan`, `created_at`, `updated_at`) VALUES
('A-989', 22, 'Buah', NULL, NULL),
('D-118', 2000, 'Strip', NULL, NULL),
('SD-65', 24, 'Botol', NULL, NULL),
('SN-11', 213, 'Strip', NULL, NULL),
('P-332', 4, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `kode_supplier` varchar(6) NOT NULL,
  `nama_supplier` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(13) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `no_telpon`, `created_at`, `updated_at`) VALUES
('AW-189', 'Novita', 'Perum Pemda', '082872878219', NULL, NULL),
('B-2827', 'Bentoman', 'Johar', '0828728726', NULL, NULL);

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
(1, 'Administrator', 'admin@pusmaung.com', '$2y$04$IhTaAEVp51NVhMPeAiOeZOrT.6ViccXtycqDBY1sGb3hUBYG7itsS', 1, 'y', '2021-11-12 11:57:30', '2021-11-12 22:38:39'),
(6, 'Pak Camat', 'camat@123.com', '$2y$10$RP5t/NkpIb.6WUL2UCkCc.N1acLt9dLLUWA6ZS5JBHmOV.dXmTyOS', 4, 'y', '2021-11-14 02:51:27', '2021-11-14 02:51:27'),
(7, 'Dimas', 'userTest@gmail.com', '$2y$10$Sg67fzEJ1Gg9Gh9TFAvkLeFoe6yUcvA7wSYGRppiRsEaNE6hiF1IG', 2, 'n', '2021-11-14 02:59:28', '2021-11-14 02:59:28'),
(8, 'Babang', 'bababababang@gmail.com', '$2y$10$plvVM7tkfySMHOOqx2dpOeqSCW5M4x2D.G5tP5AKtB4/a0hYcSR8K', 3, 'n', '2021-11-14 03:00:11', '2021-11-14 03:00:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bukti_barang_keluar`
--
ALTER TABLE `tbl_bukti_barang_keluar`
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
  ADD PRIMARY KEY (`no_rekamedis`);

--
-- Indeks untuk tabel `tbl_pengeluaran_obat`
--
ALTER TABLE `tbl_pengeluaran_obat`
  ADD PRIMARY KEY (`no_terima_obat`);

--
-- Indeks untuk tabel `tbl_permintaan_obat`
--
ALTER TABLE `tbl_permintaan_obat`
  ADD PRIMARY KEY (`no_trans`);

--
-- Indeks untuk tabel `tbl_resep_obat`
--
ALTER TABLE `tbl_resep_obat`
  ADD PRIMARY KEY (`kode_resep`);

--
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tbl_stok_obat`
--
ALTER TABLE `tbl_stok_obat`
  ADD PRIMARY KEY (`kode_obat`);

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
-- AUTO_INCREMENT untuk tabel `tbl_bukti_barang_keluar`
--
ALTER TABLE `tbl_bukti_barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_resep_obat`
--
ALTER TABLE `tbl_resep_obat`
  MODIFY `kode_resep` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
