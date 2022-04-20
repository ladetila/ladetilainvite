-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2022 pada 08.38
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ladetilainvite`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akad`
--

CREATE TABLE `akad` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link_maps` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akad`
--

INSERT INTO `akad` (`id`, `judul`, `jam`, `alamat`, `no_hp`, `image`, `link_maps`) VALUES
(1, 'Lamaran', '15:00', 'Jl. Sukadana - Garut', '087896467028', 'temu1.jpg', 'https://goo.gl/maps/eiBqmdu7vajPqyoa7'),
(2, 'Akad Nikah', '09:00', 'GOR PGRI - Jln. Sudirman Garut', '087896467028', 'IMG_20220119_172137_1611.jpg', 'https://goo.gl/maps/RE8MirwMnyqbY7KH8'),
(3, 'Resepsi', '11:00', 'GOR PGRI - Jln. Sudirman Garut', '087896467028', 'Remini202201191012475281.jpg', 'https://goo.gl/maps/RE8MirwMnyqbY7KH8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner_1`
--

CREATE TABLE `banner_1` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `banner_1`
--

INSERT INTO `banner_1` (`id`, `nama`, `link`, `image`) VALUES
(1, 'Hero Image', 'https://www.youtube.com/channel/UCTuyWM1V2AurGf5bT53_VLQ', 'bg1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner_utama`
--

CREATE TABLE `banner_utama` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `banner_utama`
--

INSERT INTO `banner_utama` (`id`, `nama`, `link`, `image`) VALUES
(0, 'Thank you', 'Telah Datang Di Pernikahan Kami', 'IMG_20210904_153841_841.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero_image`
--

CREATE TABLE `hero_image` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hero_image`
--

INSERT INTO `hero_image` (`id`, `nama`, `image`) VALUES
(6, 'Slider Image', 'IMG-20220105-WA00331.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero_judul`
--

CREATE TABLE `hero_judul` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `paragraph` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hero_judul`
--

INSERT INTO `hero_judul` (`id`, `judul`, `text`, `paragraph`) VALUES
(1, 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم', '  Menikah adalah solusi terbaik seorang pemuda karena dengannya sempurnalah separuh agama dan perjalanan hidup         ', '                    Karena kalau emang jodoh Allah akan mendekatkan bukan menjauhkan                                                              ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hitung_mundur`
--

CREATE TABLE `hitung_mundur` (
  `id` int(11) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `hari` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hitung_mundur`
--

INSERT INTO `hitung_mundur` (`id`, `tahun`, `bulan`, `hari`) VALUES
(1, '2022', '05', '14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laki-laki`
--

CREATE TABLE `laki-laki` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laki-laki`
--

INSERT INTO `laki-laki` (`id`, `nama`, `image`) VALUES
(1, 'Alvin Ramadhan', 'avin2.jpg'),
(2, 'Ali Ridho', 'ali2.jpg'),
(3, 'Asep Aji', '20482473_1560544737323882_4688589439381798912_n2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logo_web`
--

CREATE TABLE `logo_web` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `logo_web`
--

INSERT INTO `logo_web` (`id`, `nama`, `image`) VALUES
(1, 'Logo Web', 'Fearless1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_music` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `music`
--

INSERT INTO `music` (`id`, `nama`, `id_music`) VALUES
(1, 'Wedding Music', '27803131');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_mempelai`
--

CREATE TABLE `nama_mempelai` (
  `id` int(11) NOT NULL,
  `nama_lk` varchar(255) NOT NULL,
  `nama_pr` varchar(255) NOT NULL,
  `save_the_date` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nama_mempelai`
--

INSERT INTO `nama_mempelai` (`id`, `nama_lk`, `nama_pr`, `save_the_date`, `tanggal`, `image`, `alamat`) VALUES
(3, 'Amar', 'Oca', 'Save The Date ', '2022-05-14', 'IMG-20220105-WA00301.jpg', 'GOR PGRI - Jln. Sudirman Garut');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pr`
--

CREATE TABLE `pr` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pr`
--

INSERT INTO `pr` (`id`, `nama`, `image`) VALUES
(1, 'Febi Febrianti', 'febby1.jpg'),
(2, 'Alka Karina', 'alka1.jpg'),
(3, 'Dila Nurfadillah', 'dila1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qrcode`
--

CREATE TABLE `qrcode` (
  `id` int(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `qrcode`
--

INSERT INTO `qrcode` (`id`, `nama`, `image`) VALUES
(1, 'logoqr', 'qr.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rsvp`
--

CREATE TABLE `rsvp` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hadir_tidak` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `ucapan` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rsvp`
--

INSERT INTO `rsvp` (`id`, `nama`, `alamat`, `hadir_tidak`, `no_hp`, `ucapan`) VALUES
(9, 'Detila Rostilawati', 'Jln. Sumbersari ', 'Iya, Aku akan datang', '089624287015', 'Happy Wedding');

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `sosmed` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `fb_icon` varchar(255) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `ig_icon` varchar(255) NOT NULL,
  `yt` varchar(255) NOT NULL,
  `yt_icon` varchar(255) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `wa_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `social_media`
--

INSERT INTO `social_media` (`id`, `nama`, `sosmed`, `icon`, `fb_icon`, `ig`, `ig_icon`, `yt`, `yt_icon`, `wa`, `wa_icon`) VALUES
(0, 'Whatsapp', 'https://linktr.ee/ladetila_store', 'fab fa-whatsapp', '', '', '', '', '', '', ''),
(0, 'Instagram', 'https://www.instagram.com/salsabillaaaaans/', 'fab fa-instagram', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES
(1, 'Detila Rostilawati', 'detila@gmail.com', 'admin.png', '$2y$10$QdbWUgQZcw8sIMe2MdspWu/xJAvH3RVUAiVxBQDhGy3XSONJwFDuK', 1, 1, 1604323682);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `title`, `url`, `icon`) VALUES
(1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt'),
(19, 'Slider Image', 'admin/slider_image', 'fas fa-fw fa-images'),
(20, 'Social Media', 'admin/social_media', 'fas fa-fw fa-icons'),
(22, 'Hero Image', 'admin/hero_link', 'fas fa-fw fa-photo-video'),
(27, 'Logo Web', 'admin/logo_web', 'fas fa-fw fa-photo-video'),
(29, 'Mempelai', 'admin/mempelai', 'fas fa-fw fa-gifts'),
(30, 'Wedding Detail', 'admin/wedding_detail', 'fas fa-fw fa-info-circle'),
(31, 'Akad', 'admin/akad', 'fas fa-fw fa-handshake'),
(32, 'Laki-laki', 'admin/laki', 'fas fa-fw fa-male'),
(33, 'Perempuan', 'admin/perempuan', 'fas fa-fw fa-female'),
(34, 'Hitung Mundur', 'admin/mundur', 'fas fa-fw fa-stopwatch-20'),
(35, 'Terima Kasih', 'admin/thanks', 'fas fa-fw fa-handshake'),
(36, 'Music', 'admin/music', 'fas fa-fw fa-music'),
(37, 'QR Code', 'admin/qrcode', 'fas fa-qrcode');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wedding_detail`
--

CREATE TABLE `wedding_detail` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `text` varchar(500) NOT NULL,
  `paragraph` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wedding_detail`
--

INSERT INTO `wedding_detail` (`id`, `judul`, `text`, `paragraph`) VALUES
(1, 'Wedding Details', 'Kapan & Dimana', '                                        Kami harap anda melihat maps kami, kami akan mengadakan di 2 tempat berbeda');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akad`
--
ALTER TABLE `akad`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banner_1`
--
ALTER TABLE `banner_1`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hero_image`
--
ALTER TABLE `hero_image`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hero_judul`
--
ALTER TABLE `hero_judul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hitung_mundur`
--
ALTER TABLE `hitung_mundur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laki-laki`
--
ALTER TABLE `laki-laki`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logo_web`
--
ALTER TABLE `logo_web`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nama_mempelai`
--
ALTER TABLE `nama_mempelai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rsvp`
--
ALTER TABLE `rsvp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wedding_detail`
--
ALTER TABLE `wedding_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akad`
--
ALTER TABLE `akad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `banner_1`
--
ALTER TABLE `banner_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hero_image`
--
ALTER TABLE `hero_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `hero_judul`
--
ALTER TABLE `hero_judul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hitung_mundur`
--
ALTER TABLE `hitung_mundur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `laki-laki`
--
ALTER TABLE `laki-laki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `logo_web`
--
ALTER TABLE `logo_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `nama_mempelai`
--
ALTER TABLE `nama_mempelai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pr`
--
ALTER TABLE `pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rsvp`
--
ALTER TABLE `rsvp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `wedding_detail`
--
ALTER TABLE `wedding_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
