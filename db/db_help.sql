-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2022 pada 07.12
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_help`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `nm_faq` text NOT NULL,
  `waktu_faq` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `faq`
--

INSERT INTO `faq` (`id_faq`, `nm_faq`, `waktu_faq`) VALUES
(1, 'Kenapa Jaringan Tiba-tiba mati?', '2020-07-25 11:44:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `nm_pengumuman` text NOT NULL,
  `status_pengumuman` varchar(30) NOT NULL,
  `waktu_pengumuman` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `nm_pengumuman`, `status_pengumuman`, `waktu_pengumuman`) VALUES
(1, 'Terjadi Gangguan Massal disebabkan terjadinya bencana alam yang mengakibatkan kabel putus pada sambungan kabel utama kota Padang', 'nonaktif', '2020-07-25 18:19:59'),
(2, 'Bagi Pelanggan Setia Kami, Telkom Akses Menyediakan Paket Phoenix khusus untuk pelanggan setia kami dengan cara login ke dalam website helpdesk.telkom.akses.co.id dapatkan harga dengan potongan yang luar biasa. ', 'nonaktif', '2020-07-25 18:21:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nm_perusahaan` varchar(100) NOT NULL,
  `init_perusahaan` varchar(10) NOT NULL,
  `desk_perusahaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nm_perusahaan`, `init_perusahaan`, `desk_perusahaan`) VALUES
(1, 'Indihome', 'IH', 'Adalah Perusahaan yang bergerak penyediaan jasa internet Indonesia dan juga merupakan anak perusahaan dari Telkom Indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `nolayanan` varchar(16) DEFAULT NULL,
  `judul_pengaduan` varchar(100) NOT NULL,
  `isi_pesan` text NOT NULL,
  `file` text NOT NULL,
  `status_pesan` varchar(20) NOT NULL,
  `tanggal_pesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `nolayanan`, `judul_pengaduan`, `isi_pesan`, `file`, `status_pesan`, `tanggal_pesan`) VALUES
(1, 5, 7, '', 'Router Terbakar', 'Router saya terbakar saat saya coba lemparkan ke neraka', '5f1da9fa29824.jpeg', 'selesai', '2020-07-26 18:06:18'),
(20, 7, 5, '', 'Pengaduan diproses', 'Selamat Siang Bapak/Ibu Kami dari Telkom Akses Mengabarkan bahwa Pengaduan anda sedang kami proses. Semoga dalam keadaan bahagia dan sehat selalu :-)', '', '', '2020-08-07 11:36:32'),
(21, 5, 7, '', 'SOP HRS', 'sdasdasdasdasd', '', 'terkirim', '2020-08-19 18:39:06'),
(22, 5, 7, '', 'SOP HRS', 'sdasdasdasdasd', '', 'selesai', '2020-08-19 18:39:06'),
(23, 9, 7, '', 'Router Terbakar', 'Pak Tolong Router Saya Terbakar', '', 'proses', '2020-09-12 05:01:33'),
(24, 7, 9, '', 'Pengaduan diproses', 'Selamat Siang Bapak/Ibu Kami dari Teknisi PT Telkom Akses Mengabarkan bahwa Pengaduan anda sedang kami proses, ditunggu konfirmasi dari kami yaa!. Semoga dalam keadaan bahagia dan sehat selalu :-)', '', '', '2020-09-12 05:05:40'),
(27, 9, 7, '075109120391', 'Telepon Rusak', 'Pak Mohon Dibantu Pak Telepon Saya Rusak', '', 'terkirim', '2020-09-12 05:38:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi`
--

CREATE TABLE `solusi` (
  `id_solusi` int(11) NOT NULL,
  `id_faq` int(11) NOT NULL,
  `nm_solusi` text NOT NULL,
  `desk_solusi` text NOT NULL,
  `waktu_solusi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `solusi`
--

INSERT INTO `solusi` (`id_solusi`, `id_faq`, `nm_solusi`, `desk_solusi`, `waktu_solusi`) VALUES
(2, 1, 'Restart Router', '<ol><li>Langkah Pertama Tekan Tombol Power pada Router&nbsp;</li></ol><p style=\"text-align: center; \"><img src=\"https://th.bing.com/th/id/OIP.psh6MqFTvmnlzFBw1ZU1WgHaHa?w=177&amp;h=180&amp;c=7&amp;o=5&amp;dpr=1.1&amp;pid=1.7\" alt=\"Image result for router\"></p><p style=\"text-align: left;\">&nbsp;&nbsp;&nbsp; &nbsp; 2. Setelah ditekan diamkan beberapa saat</p><p style=\"text-align: left;\">&nbsp; &nbsp; &nbsp; 3. Lalu Hidupkan kembali<br></p><p>&nbsp;</p>', '2020-09-14 12:36:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nm_lengkap` varchar(100) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `pass` text NOT NULL,
  `level` varchar(100) NOT NULL,
  `waktu_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nm_lengkap`, `nm_user`, `email`, `no_hp`, `alamat`, `pass`, `level`, `waktu_user`) VALUES
(5, 'Fazila Aleena', 'jiji', 'jiji@gmail.com', '81281738018', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'user', ''),
(8, 'gaga', 'gaga', 'gaga@gmail.com', '81270389862', 'jl kaki no.20020', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'teknisi', '11-09-2020 17:20:56'),
(9, 'jaja', 'jaja', 'jaja@gmail.com', '0812891283918', 'jl kampung durian runtuh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'user', '12-09-2020 04:55:18'),
(10, 'tries', 'tries', 'tries@gmail.com', '82169123912', 'Jl Kaki', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', '2022-07-05 03:30:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`id_solusi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `solusi`
--
ALTER TABLE `solusi`
  MODIFY `id_solusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
