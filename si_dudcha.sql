-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Jul 2022 pada 18.31
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_dudcha`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `bulan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id`, `bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aturan_barang`
--

CREATE TABLE `tbl_aturan_barang` (
  `id` int(11) NOT NULL,
  `dosis_aturan_barang` varchar(50) NOT NULL,
  `khusus` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_aturan_barang`
--

INSERT INTO `tbl_aturan_barang` (`id`, `dosis_aturan_barang`, `khusus`, `created_at`, `updated_at`) VALUES
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
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` bigint(20) NOT NULL,
  `satuan` int(11) NOT NULL,
  `tgl_kadaluarsa` varchar(25) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `jenis_barang` int(11) DEFAULT NULL,
  `nilai_satuan` bigint(20) DEFAULT NULL,
  `harga_beli` bigint(20) DEFAULT NULL,
  `harga_jual` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`kode_barang`, `nama_barang`, `stok`, `satuan`, `tgl_kadaluarsa`, `created_at`, `updated_at`, `jenis_barang`, `nilai_satuan`, `harga_beli`, `harga_jual`) VALUES
('GFK0002', 'Green Tea', 2468, 1, '', '2022-01-11 05:15:35', '2022-07-17 22:55:56', 1, 400, 3890, 4000),
('GFK0003', 'Thai Tea', 174, 1, '2024-03-10', '2022-01-11 05:18:44', '2022-07-13 21:10:05', 1, 800, NULL, 2000),
('GFK0004', 'Milo', 2172, 1, '2024-07-09', '2022-01-11 05:18:44', '2022-07-13 21:08:49', 1, 28, NULL, 1000),
('GFK0006', 'Taro', 237, 1, '', '2022-01-11 05:20:30', '2022-07-13 21:08:27', 1, 20, NULL, 3000),
('GFK0007', 'Cheese', 404, 1, '', '2022-01-13 01:00:52', '2022-07-13 21:08:27', 1, 50, NULL, 3000),
('GFK0008', 'Kopi', 309, 1, '', '2022-01-15 03:38:44', '2022-07-13 23:56:00', 1, 600, 2500, 3000),
('GFK0009', 'Susu Cair', 0, 1, '', '2022-06-23 21:50:18', '2022-07-13 22:55:21', 2, 20, NULL, 2000),
('GFK0010', 'Cup', 110, 1, '', '2022-06-23 21:50:22', '2022-07-13 23:56:00', 3, 1, 500, 500),
('GFK0011', 'Boba', 151, 8, '', '2022-06-23 21:50:31', '2022-07-13 23:56:00', 2, 1, 1000, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_barang`
--

CREATE TABLE `tbl_jenis_barang` (
  `jenis_barang_id` int(11) NOT NULL,
  `jenis_barang_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jenis_barang`
--

INSERT INTO `tbl_jenis_barang` (`jenis_barang_id`, `jenis_barang_name`, `created_at`, `updated_at`) VALUES
(1, 'Serbuk', '2022-06-26 23:50:02', '2022-06-26 23:50:04'),
(2, 'Topping', '2022-06-26 23:52:27', '2022-07-03 15:11:29'),
(3, 'Gelas', '2022-06-26 23:57:37', '2022-06-26 23:57:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_notifikasi`
--

CREATE TABLE `tbl_notifikasi` (
  `notifikasi_id` int(11) NOT NULL,
  `notifikasi_user_id` int(11) DEFAULT NULL,
  `notifikasi_judul` varchar(255) DEFAULT NULL,
  `notifikasi_pesan` varchar(255) DEFAULT NULL,
  `notifikasi_tanggal` datetime DEFAULT NULL,
  `notifikasi_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_outlet`
--

CREATE TABLE `tbl_outlet` (
  `outlet_id` int(11) NOT NULL,
  `outlet_name` varchar(255) DEFAULT NULL,
  `outlet_alamat` varchar(255) DEFAULT NULL,
  `outlet_status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_outlet`
--

INSERT INTO `tbl_outlet` (`outlet_id`, `outlet_name`, `outlet_alamat`, `outlet_status`, `created_at`, `updated_at`) VALUES
(1, 'Outlet 1', 'Cimindi', 1, NULL, '2022-06-23 20:59:45'),
(2, 'Outlet 2', 'Pakuhaji Cimahi', 1, NULL, NULL),
(3, 'Outlet 3', 'Rancamanyar', 1, NULL, NULL),
(4, 'Outlet 4', 'Sindanglaya', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id` int(11) NOT NULL,
  `faktur` varchar(255) NOT NULL,
  `kode_pemesanan` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `kode_supplier` int(11) DEFAULT NULL,
  `status_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian_detail`
--

CREATE TABLE `tbl_pembelian_detail` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `stok_masuk` bigint(20) DEFAULT NULL,
  `tgl_kadaluarsa` varchar(255) NOT NULL,
  `harga_beli` bigint(20) DEFAULT NULL,
  `satuan_barang_id` int(11) DEFAULT NULL,
  `stok_pemesanan` bigint(20) DEFAULT NULL,
  `harga_pemesanan` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan_barang`
--

CREATE TABLE `tbl_penjualan_barang` (
  `id_transaksi` int(11) NOT NULL,
  `outlet_id` varchar(50) NOT NULL,
  `outlet_name` varchar(50) NOT NULL,
  `outlet_alamat` varchar(50) NOT NULL,
  `total` bigint(20) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `no_nota` varchar(255) DEFAULT NULL,
  `sales` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan_barang_detail`
--

CREATE TABLE `tbl_penjualan_barang_detail` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_jual` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `proses` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_permintaan_detail`
--

CREATE TABLE `tbl_permintaan_detail` (
  `id` int(11) NOT NULL,
  `id_permintaan` int(11) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `satuan_barang_id` varchar(255) DEFAULT NULL,
  `harga_beli` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 'Operasional', NULL, NULL),
(5, 'Atasan', '2021-12-18 07:42:38', '2021-12-18 07:42:38'),
(6, 'Manajemen', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satuan_barang`
--

CREATE TABLE `tbl_satuan_barang` (
  `satuan_barang_id` int(11) NOT NULL,
  `satuan_barang_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_satuan_barang`
--

INSERT INTO `tbl_satuan_barang` (`satuan_barang_id`, `satuan_barang_name`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', NULL, '2022-06-25 12:54:53'),
(2, 'Roll', NULL, '2022-06-25 12:54:53'),
(3, 'Dus', NULL, '2022-06-25 12:54:53'),
(4, 'Kg', NULL, '2022-06-25 12:54:53'),
(5, 'Pack', '2022-06-25 12:54:49', '2022-06-25 12:54:53'),
(8, 'Kaleng', '2022-07-13 21:26:28', '2022-07-13 21:26:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_stok_barang`
--

CREATE TABLE `tbl_stok_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `stok_awal` bigint(20) DEFAULT NULL,
  `stok_masuk` bigint(20) DEFAULT NULL,
  `stok_keluar` bigint(20) DEFAULT NULL,
  `stok_akhir` bigint(20) DEFAULT NULL,
  `tgl_kadaluarsa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 'Supplier 1', 'Bandung', '01829382032', 'supplier1@gmail.com', '2022-06-23 20:27:59', '2022-01-18 18:23:22'),
(4, 'Supplier 2', 'Bandung', '01982093812', 'supplier2@gmail.com', '2022-06-23 20:28:01', '2022-06-23 20:41:12'),
(5, 'Supplier 3', 'Bandung', '09182093802', 'supplier3@gmail.com', '2022-06-23 20:28:05', '2022-06-23 20:41:17'),
(6, 'Supplier 4', 'Bandung', '09182039829', 'supplier4@gmail.com', '2022-06-23 20:28:25', '2022-06-23 20:41:21');

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
  `updated_at` datetime DEFAULT NULL,
  `user_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `full_name`, `email`, `password`, `id_user_role`, `is_active`, `created_at`, `updated_at`, `user_photo`) VALUES
(1, 'Operasional', 'operasional@email.com', '$2y$10$Q0rG00LgNyaEtqwnNF4MOuExTwKWVm5yDnb5QN1Lq6wDR3zZLxF4a', 1, 'y', '2022-01-11 12:47:30', '2022-06-26 21:28:55', '1656253735_73df1d4d878f9a02f66e.jpg'),
(2, 'Atasan Langsung', 'atasan@email.com', '$2y$10$kB.zztxfwwRI4gPGm6a8RONemTrGXg6DtoZbxuDHjFjJfXhSNZABa', 5, 'y', '2022-01-11 12:47:57', '2022-07-08 20:02:35', NULL),
(3, 'Manajemen', 'manajemen@email.com', '$2y$10$zLYQ46r.GOCv6WihCkxqwOmhywTTKJoHFN8DpXTjFgnroAkWJmlmm', 6, 'y', '2022-07-04 23:59:31', '2022-07-07 20:45:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `tbl_aturan_barang`
--
ALTER TABLE `tbl_aturan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `tbl_jenis_barang`
--
ALTER TABLE `tbl_jenis_barang`
  ADD PRIMARY KEY (`jenis_barang_id`);

--
-- Indeks untuk tabel `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  ADD PRIMARY KEY (`notifikasi_id`);

--
-- Indeks untuk tabel `tbl_outlet`
--
ALTER TABLE `tbl_outlet`
  ADD PRIMARY KEY (`outlet_id`);

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
-- Indeks untuk tabel `tbl_penjualan_barang`
--
ALTER TABLE `tbl_penjualan_barang`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tbl_penjualan_barang_detail`
--
ALTER TABLE `tbl_penjualan_barang_detail`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tbl_satuan_barang`
--
ALTER TABLE `tbl_satuan_barang`
  ADD PRIMARY KEY (`satuan_barang_id`);

--
-- Indeks untuk tabel `tbl_stok_barang`
--
ALTER TABLE `tbl_stok_barang`
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
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_aturan_barang`
--
ALTER TABLE `tbl_aturan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_barang`
--
ALTER TABLE `tbl_jenis_barang`
  MODIFY `jenis_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `notifikasi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_outlet`
--
ALTER TABLE `tbl_outlet`
  MODIFY `outlet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian_detail`
--
ALTER TABLE `tbl_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan_barang_detail`
--
ALTER TABLE `tbl_penjualan_barang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_permintaan_detail`
--
ALTER TABLE `tbl_permintaan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_satuan_barang`
--
ALTER TABLE `tbl_satuan_barang`
  MODIFY `satuan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_stok_barang`
--
ALTER TABLE `tbl_stok_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `kode_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
