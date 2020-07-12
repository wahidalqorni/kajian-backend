-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jul 2020 pada 13.56
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `id_admin` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `level` enum('1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`id_admin`, `nama`, `alamat`, `email`, `password`, `jk`, `no_hp`, `status`, `level`) VALUES
('201804280001', 'Didin', 'Jl. Sentosa Lr. Pribadi no. 439 plaju', 'Abidgrafis@gmail.com', 'ffa914c435c63b355a5ef3234b96c080', 'L', '081278555330', 'Y', '1'),
('201804040001', 'Adi', 'Palembang', 'tridi.com@gmail.com', '467b617fec4d9fcb63505734ee224851', 'L', '089649908378', 'Y', '1'),
('201804040002', 'Jehan', 'Palembang', 'jehansoulthany@gmail.com', 'fb18ecfe7389a0322c1c9bd8a4c72166', 'L', '082183680685', 'Y', '1'),
('201802220006', 'M. Wahid Alqorni', 'Palembang', 'wahidalqorni@gmail.com', '855889a1a0c753e2fb6e825a4195d674', 'L', '08991334254', 'Y', '1'),
('201802260001', 'Alif Sahreza', 'Palembang', 'alif_rez@gmail.com', '099a147c0c6bcd34009896b2cc88633c', 'L', '0932', 'Y', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `facebook`
--

CREATE TABLE `facebook` (
  `id_facebook` int(11) NOT NULL,
  `url_facebook` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `facebook`
--

INSERT INTO `facebook` (`id_facebook`, `url_facebook`) VALUES
(1, 'https://www.facebook.com/PalembangMengaji/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `id_info` varchar(12) NOT NULL,
  `judul_info` varchar(200) NOT NULL,
  `waktu_upload` datetime NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` varchar(12) NOT NULL,
  `id_masjid` varchar(12) NOT NULL,
  `id_ustad` varchar(12) NOT NULL,
  `id_jenis_kajian` varchar(12) NOT NULL,
  `judul_kajian` varchar(500) NOT NULL,
  `waktu_kajian` datetime NOT NULL,
  `bada` enum('','Shubuh','zuhur','Asar','Maghrib','Isya') NOT NULL,
  `deskripsi_kajian` text NOT NULL,
  `tgl_upload` date NOT NULL,
  `kelompok` enum('akhwat','ikhwan','umum') NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `video_url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_masjid`, `id_ustad`, `id_jenis_kajian`, `judul_kajian`, `waktu_kajian`, `bada`, `deskripsi_kajian`, `tgl_upload`, `kelompok`, `gambar`, `video_url`) VALUES
('Jadwal_00005', 'Masjd_00001', 'Ust_0001', 'Jns_0001', 'Lanjutan Rahasia Do\'a', '2018-04-04 10:00:00', '', 'Ikhwan dan akhwat', '2018-03-07', 'umum', 'Jadwal_000111.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00010', 'Masjd_00006', 'Ust_0001', 'Jns_0001', 'Jangan Engkau Merasa Aman dari Azab-NYA', '2018-03-30 10:30:00', '', 'Safari Dakwah', '2018-03-10', 'umum', 'Jadwal_000102.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00011', 'Masjd_00001', 'Ust_0001', 'Jns_0001', 'Benteng Keluarga, Siapa yang menjaganya !', '2018-03-30 09:30:00', '', 'Safari Dakwah', '2018-03-10', 'umum', 'Jadwal_000112.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00122', 'Masjd_00024', 'Ust_0004', 'Jns_0005', 'Hadist | Riyadhus Shalihin', '2018-04-27 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-27', 'umum', 'Jadwal_00122.jpg', ''),
('Jadwal_00013', 'Masjd_00013', 'Ust_0010', 'Jns_0005', 'Bantahan Untuk Orang yang Menyimpang', '2018-04-03 18:30:00', 'Maghrib', 'Yokk ... hadirilah dan perbanyak doa di majelis-majelis ilmu. Dalam hadits qudsi, Allah ta\'ala berfirman,\"Sungguh Aku telah mengampuni mereka (yang hadir di majelis ilmu) maka Aku berikan kepada mereka apa yang mereka minta (surga) dan Aku lindungi mereka dari neraka.\" [HR. Muslim dari Abu Hurairah radhiyallahu’anhu].\r\n.\r\nSebarkan.\r\nSemoga menjadi ladang kebaikan bagi kita semua. .\r\nJazakumullah khayran', '2018-03-28', 'umum', 'Jadwal_00013.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00019', 'Masjd_00016', 'Ust_0005', 'Jns_0005', 'Adzan, Iqomah dan Kunut Shubuh', '2018-04-06 13:15:00', 'zuhur', 'THE GHUROBA PALEMBANG', '2018-03-29', 'ikhwan', 'Jadwal_00019.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00020', 'Masjd_00006', 'Ust_0006', 'Jns_0001', 'Dua Syarat diterimanya Ibadah', '2018-04-06 13:10:00', '', '*HADIRILAH* ????\r\n*TABLIGH AKBAR KOTA PALEMBANG*', '2018-03-29', 'umum', 'Jadwal_00020.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00015', 'Masjd_00013', 'Ust_0014', 'Jns_0005', 'Kitab Bulughul Maram', '2018-04-01 09:00:00', '', 'Yokk ... hadirilah dan perbanyak doa di majelis-majelis ilmu. Dalam hadits qudsi, Allah ta\'ala berfirman,\r\n.\r\n???? ???????? ?????? ???????????????? ??? ????????? ?????????????? ?????? ????????????\r\n.\r\n???? \"Sungguh Aku telah mengampuni mereka (yang hadir di majelis ilmu) maka Aku berikan kepada mereka apa yang mereka minta (surga) dan Aku lindungi mereka dari neraka.\" [HR. Muslim dari Abu Hurairah radhiyallahu’anhu]\r\n.\r\nSebarkan.\r\nSemoga menjadi ladang kebaikan bagi kita semua. .\r\nJazakumullah khayran', '2018-03-28', 'umum', 'Jadwal_00015.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00049', 'Masjd_00014', 'Ust_0029', 'Jns_0001', 'Kesombongan itu menolak Haq (Kebenaran) dan meremehkan Manusia', '2018-04-03 09:00:00', '', '*Gratis.* Terbuka untuk Umum (Ikhwan & akhwat)\r\n\r\nBersama:\r\n:bust_in_silhouette: _*Ustadz Dr. Aspri Rahmat Azai, MA* (Alumnus S3 Universitas Islam Madinah, KSA)_\r\n:bust_in_silhouette: _*Ustadz Ali Ahmad, Lc* (Pemateri Radio Hang Batam, Penulis Buku Islam)\r\n\r\nPerhatian!!\r\nMohon maaf jika Banner tidak sesuai dengan jadwal kajian, ini dikarenakan terdapat kesalahan pada sistem.', '2018-04-02', 'umum', 'Jadwal_000492.jpg', 'https://www.youtube.com/embed/S8WbM17Ccsk'),
('Jadwal_00021', 'Masjd_00016', 'Ust_0018', 'Jns_0005', 'Kitab Ushul Atsalasah', '2018-03-31 13:30:00', '', 'Kajian membahas Kitab Ushul Atsalasah Khusus Akhwat', '2018-03-29', 'akhwat', 'Jadwal_00021.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00054', 'Masjd_00025', 'Ust_0023', 'Jns_0008', 'Tafsir Juz Amma', '2018-04-10 14:00:00', '', '', '2018-04-10', 'akhwat', 'Jadwal_000551.jpg', ''),
('Jadwal_00055', 'Masjd_00016', 'Ust_0008', 'Jns_0005', 'At-Tibyan fi Adab Hamalatil Qur\'an', '2018-04-10 18:30:00', 'Maghrib', '', '2018-04-10', 'umum', 'Jadwal_00057.jpg', ''),
('Jadwal_00056', 'Masjd_00013', 'Ust_0036', 'Jns_0008', '-', '2018-04-10 18:30:00', 'Maghrib', '', '2018-04-10', 'umum', 'Jadwal_00056.jpg', ''),
('Jadwal_00023', 'Masjd_00014', 'Ust_0012', 'Jns_0001', 'Ahli As-Sunnah Waljamaah', '2018-03-31 06:00:00', '', 'Kupas Tuntas Ahli As-Sunnah Waljamaah', '2018-03-29', 'umum', 'Jadwal_00023.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00024', 'Masjd_00016', 'Ust_0013', 'Jns_0005', 'Cantik Istri atau Bidadari Surga..?', '2018-04-14 13:20:00', '', 'Penasaran Cantik Istri atau Bidadari Surga..?\r\nSimak Pembahasan di sini', '2018-03-29', 'akhwat', 'Jadwal_00024.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00025', 'Masjd_00011', 'Ust_0023', 'Jns_0001', 'Melihat Keindahan Surga', '2018-03-29 11:14:00', 'Shubuh', 'Dari Sahl bin Sa’d Radhiyallahu anhu : Rasûlullâh Shallallahu ‘alaihi wa sallam bersabda kepada ‘Ali bin Abi Thalib Radhiyallahu anhu : \"Demi Allâh, bila Allâh memberi petunjuk (hidayah) lewat dirimu kepada satu orang saja, lebih baik (berharga) bagimu daripada unta-unta yang merah.\"\r\n[ Hadits Shahih: HR. Al-Bukhâri, no. 2942, 3701 dan Muslim, no. 2406 ]\r\n.\r\nSebarkan.\r\nSemoga menjadi ladang kebaikan bagi kita semua. .\r\nJazakumullah khayran', '2018-03-29', 'umum', 'Jadwal_00027.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00031', 'Masjd_00005', 'Ust_0019', 'Jns_0001', 'Jangan Letih Menuntut Ilmu', '2018-03-30 19:00:00', 'Maghrib', 'Khusus bagi yang dari luar kota (Safar). Kami menyediakan tempat untuk menginap. Silahkan hubungi CP Panitia dibawah.\r\n\r\nDari Abu Hurairah radhiallahu’anhu, sesungguhnya Rasulullah shallallahu’alaihi wasallam bersabda : \"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim No.2699).\r\n\r\nSilahkan disebarkan. Semoga menjadi ladang kebaikan bagi kita semua.\r\n\r\nJazakumullah Khairan.', '2018-03-29', 'umum', 'Jadwal_00031.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00030', 'Masjd_00021', 'Ust_0022', 'Jns_0001', 'Bahaya Riba', '2018-04-05 18:30:00', 'Maghrib', 'Menyadarkan Bahaya Riba', '2018-03-29', 'umum', 'Jadwal_00030.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00028', 'Masjd_00021', 'Ust_0022', 'Jns_0001', 'Urgensi dan Fitnah Harta', '2018-04-08 05:15:00', 'Shubuh', 'Pembahasan Urgensi dan Fitnah Harta', '2018-03-29', 'ikhwan', 'Jadwal_00028.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00029', 'Masjd_00008', 'Ust_0022', 'Jns_0001', 'Jangan jadi Orang Terlaknat', '2018-04-07 09:00:00', '', 'Kajian mengenai Jangan jadi Orang Terlaknat', '2018-03-29', 'umum', 'Jadwal_00029.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00032', 'Masjd_00021', 'Ust_0022', 'Jns_0001', 'Generasi Terbaik Umat Islam', '2018-04-06 09:00:00', '', 'Generasi Terbaik Umat Islam kajian untuk umum', '2018-03-29', 'umum', 'Jadwal_00032.jpg', ''),
('Jadwal_00033', 'Masjd_00021', 'Ust_0022', 'Jns_0001', 'Buktikan Cintamu', '2018-04-06 10:00:00', '', 'Note : Aplikasi ini masih dalam tahap pengembangan, jadwal ini hanya untuk percobaan sementara (belum jadwal sebenarnya).\r\n\r\nBuktikan Cintamu (Beginilah Mencintai Nabi Sholollahu\'alaihi Wassalam)', '2018-03-29', 'umum', 'Jadwal_00033.jpg', ''),
('Jadwal_00034', 'Masjd_00013', 'Ust_0019', 'Jns_0005', 'Peran Manhaj Salaf Bagi Aqidah', '2018-04-06 19:00:00', 'Maghrib', 'Note : Aplikasi ini masih dalam tahap pengembangan, jadwal ini hanya untuk percobaan sementara (belum jadwal sebenarnya).\r\n\r\nYokk ... hadirilah dan perbanyak doa di majelis-majelis ilmu. Dalam hadits qudsi, Allah ta\'ala berfirman,\r\n\r\n\"Sungguh Aku telah mengampuni mereka (yang hadir di majelis ilmu) maka Aku berikan kepada mereka apa yang mereka minta (surga) dan Aku lindungi mereka dari neraka.\" [HR. Muslim dari Abu Hurairah radhiyallahu’anhu]\r\n.\r\nSebarkan.\r\nSemoga menjadi ladang kebaikan bagi kita semua. .\r\nJazakumullah khayran', '2018-03-29', 'umum', 'Jadwal_00034.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00035', 'Masjd_00008', 'Ust_0026', 'Jns_0005', 'Kajian Islam Ilmiah', '2018-04-04 13:00:00', '', 'Yokk ... hadirilah dan perbanyak doa di majelis-majelis ilmu. Dalam hadits qudsi, Allah ta\'ala berfirman,\r\n\r\n\"Sungguh Aku telah mengampuni mereka (yang hadir di majelis ilmu) maka Aku berikan kepada mereka apa yang mereka minta (surga) dan Aku lindungi mereka dari neraka.\" [HR. Muslim dari Abu Hurairah radhiyallahu’anhu]\r\n.\r\nDiselenggarakan oleh Group Kajian The Ghuroba dan Group WA Belajar Ilmu Syar\'i (BIS) Palembang\r\n.\r\nSilahkan bergabung untuk mendapatkan manfaat ilmu syar\'i dan info kajian seputar palembang', '2018-03-29', 'umum', 'Jadwal_00035.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00036', 'Masjd_00022', 'Ust_0012', 'Jns_0001', 'Andai si Mayit bisa Bicara', '2018-04-02 13:30:00', '', 'Note : Aplikasi ini masih dalam tahap pengembangan, jadwal ini hanya untuk percobaan sementara (belum jadwal sebenarnya).\r\n\r\nAndai si Mayit bisa Bicara! Tabligh Akbar', '2018-03-29', 'umum', 'Jadwal_00036.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00037', 'Masjd_00022', 'Ust_0027', 'Jns_0005', 'Tasyabbuh', '2018-04-14 13:20:00', '', 'Note : Aplikasi ini masih dalam tahap pengembangan, jadwal ini hanya untuk percobaan sementara (belum jadwal sebenarnya).\r\n\r\nHadirilah Kajian Ilmiah Kota Palembang', '2018-03-29', 'umum', 'Jadwal_000491.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00038', 'Masjd_00013', 'Ust_0028', 'Jns_0001', 'Nasehat Untuk Penuntut Ilmu', '2018-04-02 10:00:00', '', 'Note : \"Aplikasi ini masih dalam tahap pengembangan, jadwal ini hanya untuk percobaan sementara (belum jadwal sebenarnya)\".\r\n\r\nHadirilah Kajian Ilmiah Kota Palembang\r\n\r\nDari Sahl bin Sa’d Radhiyallahu anhu : Rasulullah Shallallahu ‘alaihi wa sallam bersabda kepada ‘Ali bin Abi Thalib Radhiyallahu anhu : \"Demi Allah, bila Allah memberi petunjuk (hidayah) lewat dirimu kepada satu orang saja, lebih baik (berharga) bagimu daripada unta-unta yang merah.\"\r\n[ Hadits Shahih: HR. Al-Bukhâri, no. 2942, 3701 dan Muslim, no. 2406 ]\r\n.\r\nSebarkan.\r\nSemoga menjadi ladang kebaikan bagi kita semua. .\r\nJazakumullah khayran', '2018-03-29', 'umum', 'Jadwal_00049.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00039', 'Masjd_00013', 'Ust_0030', 'Jns_0001', 'Aturan-aturan Dalam Hutang Piutang', '2018-04-16 18:00:00', 'Maghrib', 'Note : Aplikasi ini masih dalam tahap pengembangan, jadwal ini hanya untuk percobaan sementara (belum jadwal sebenarnya), \"untuk jadwal sebenarnya akan segera di - update\"\r\n\r\nHadirilah Kajian Ilmiah Kota Palembang\r\n\r\nYokk ... hadirilah dan perbanyak doa di majelis-majelis ilmu. Dalam hadits qudsi, Allah ta\'ala berfirman,\r\n.\r\n\"Sungguh Aku telah mengampuni mereka (yang hadir di majelis ilmu) maka Aku berikan kepada mereka apa yang mereka minta (surga) dan Aku lindungi mereka dari neraka.\" [HR. Muslim dari Abu Hurairah radhiyallahu’anhu]\r\n.\r\nSebarkan.\r\nSemoga menjadi ladang kebaikan bagi kita semua. .\r\nJazakumullah khayran', '2018-03-29', 'umum', 'Jadwal_00041.jpg', 'https://www.youtube.com/embed/ay0FzwryPho'),
('Jadwal_00051', 'Masjd_00030', 'Ust_0034', 'Jns_0001', 'Berjalan Bersamanya', '2018-04-07 08:30:00', '', '', '2018-04-07', 'umum', 'Jadwal_00051.jpg', 'https://m.youtube.com/embed/h9n9_vxI8K8'),
('Jadwal_00052', 'Masjd_00017', 'Ust_0034', 'Jns_0001', 'Stampel Muslim', '2018-04-07 00:00:00', 'Maghrib', '', '2018-04-07', 'umum', 'Jadwal_00052.jpg', ''),
('Jadwal_00123', 'Masjd_00016', 'Ust_0031', 'Jns_0005', 'Aqidah | Ushul Tsalatsah', '2018-04-27 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-27', 'umum', 'Jadwal_00123.jpg', ''),
('Jadwal_00124', 'Masjd_00025', 'Ust_0005', 'Jns_0005', 'Adab | Ma\'alim fi Thariq Thalabil Ilm', '2018-04-27 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-27', 'umum', 'Jadwal_00124.jpg', ''),
('Jadwal_00047', 'Masjd_00013', 'Ust_0017', 'Jns_0001', 'Jagalah Lisanmu...!', '2018-04-01 05:30:00', 'Shubuh', '*Gratis.* Terbuka untuk Umum (Ikhwan & akhwat)\r\n\r\nBersama:\r\n:bust_in_silhouette: _*Ustadz Dr. Aspri Rahmat Azai, MA* (Alumnus S3 Universitas Islam Madinah, KSA)_\r\n:bust_in_silhouette: _*Ustadz Ali Ahmad, Lc* (Pemateri Radio Hang Batam, Penulis Buku Islam)\r\n\r\nPerhatian!!\r\nMohon maaf jika Banner tidak sesuai dengan jadwal kajian, ini dikarenakan terdapat kesalahan pada sistem.', '2018-03-31', 'umum', 'Jadwal_000481.png', 'https://www.youtube.com/embed/S8WbM17Ccsk'),
('Jadwal_00046', 'Masjd_00020', 'Ust_0017', 'Jns_0001', 'Buktikan Cintamu Pada-Nya', '2018-03-31 18:30:00', 'Maghrib', '???? Masjid Darul Ridhwan, Komperta, Plaju\r\n:alarm_clock: Bakda salat Magrib \r\n:bust_in_silhouette: Ust. Dr. Aspri Rahmat dan Ust. Ali Ahmad\r\n:books: *Tablig Akbar:* Buktikan Cintamu Pada-Nya\r\n:busts_in_silhouette: Ikhwan/Akhwat\r\n\r\nPerhatian!!\r\nMohon maaf jika Banner tidak sesuai dengan jadwal kajian, ini dikarenakan terdapat kesalahan pada sistem.', '2018-03-31', 'umum', 'Jadwal_000491.png', 'https://www.youtube.com/embed/S8WbM17Ccsk'),
('Jadwal_00044', 'Masjd_00024', 'Ust_0004', 'Jns_0005', 'Hadist | Riyadhus Shalihin', '2018-03-30 18:30:00', 'Maghrib', 'Masjid Firqotun Najiyah, Perumahan Pondok Palem Indah, dekat Grant City, Talang Kelapa, Alang-Alang Lebar\r\nBa\'da shalat Magrib\r\nUst. Abu Hamzah, S.Ag\r\nHadis | Riyadhus Shalihin\r\nIkhwan/Akhwat', '2018-03-30', 'umum', 'Jadwal_000451.png', ''),
('Jadwal_00057', 'Masjd_00016', 'Ust_0037', 'Jns_0005', 'Arbain Nawawi', '2018-04-11 18:30:00', 'Maghrib', '', '2018-04-11', 'umum', 'Jadwal_000571.jpg', ''),
('Jadwal_00058', 'Masjd_00025', 'Ust_0007', 'Jns_0005', 'Riyadhus Shalihin', '2018-04-11 18:30:00', 'Maghrib', '', '2018-04-11', 'umum', 'Jadwal_00058.jpg', ''),
('Jadwal_00053', 'Masjd_00029', 'Ust_0034', 'Jns_0001', 'Jujurlah Padaku', '2018-04-08 09:00:00', '', '', '2018-04-08', 'umum', 'Jadwal_00053.jpg', 'https://m.youtube.com/embed/ewtAcH927xU'),
('Jadwal_00059', 'Masjd_00031', 'Ust_0009', 'Jns_0005', 'Al - Ushul as - Sittah', '2018-04-11 18:30:00', 'Maghrib', '', '2018-04-11', 'umum', 'Jadwal_00059.jpg', ''),
('Jadwal_00060', 'Masjd_00032', 'Ust_0008', 'Jns_0005', 'Aqidah Ahlussunnah wal Jama\'ah', '2018-04-12 14:00:00', '', '', '2018-04-12', 'umum', 'Jadwal_000654.jpg', ''),
('Jadwal_00061', 'Masjd_00016', 'Ust_0006', 'Jns_0005', 'Aqidah Wasithiyah', '2018-04-12 18:30:00', 'Maghrib', '', '2018-04-12', 'umum', 'Jadwal_000653.jpg', ''),
('Jadwal_00062', 'Masjd_00027', 'Ust_0038', 'Jns_0005', 'Al - Wajiz / Riyadhus Shalihin', '2018-04-12 18:30:00', 'Maghrib', '', '2018-04-12', 'umum', 'Jadwal_000655.jpg', ''),
('Jadwal_00063', 'Masjd_00034', 'Ust_0008', 'Jns_0008', '-', '2018-04-12 18:30:00', 'Maghrib', '', '2018-04-12', 'umum', 'Jadwal_000651.jpg', ''),
('Jadwal_00064', 'Masjd_00035', 'Ust_0008', 'Jns_0008', 'Pertanyaan - pertanyaan tentang Islam', '2018-04-12 12:30:00', '', '', '2018-04-12', 'umum', 'Jadwal_00065.jpg', ''),
('Jadwal_00065', 'Masjd_00013', 'Ust_0035', 'Jns_0001', 'Jual Beli Solusi Atasi Riba', '2018-04-13 05:00:00', 'Shubuh', '', '2018-04-13', 'umum', 'Jadwal_000681.jpg', ''),
('Jadwal_00066', 'Masjd_00013', 'Ust_0035', 'Jns_0007', 'Riba Jahilia (DIBATALKAN) ', '2018-04-13 12:00:00', '', '', '2018-04-13', 'ikhwan', 'Jadwal_00068.jpg', ''),
('Jadwal_00067', 'Masjd_00024', 'Ust_0004', 'Jns_0005', 'Riyadhus Shalihin', '2018-04-13 18:30:00', 'Maghrib', '', '2018-04-13', 'umum', 'Jadwal_00067.jpg', ''),
('Jadwal_00068', 'Masjd_00016', 'Ust_0031', 'Jns_0005', 'Ushul Tsalatsah', '2018-04-13 18:31:00', 'Maghrib', '', '2018-04-13', 'umum', 'Jadwal_000682.jpg', ''),
('Jadwal_00069', 'Masjd_00025', 'Ust_0005', 'Jns_0005', 'Ma\'alim fi Thariq Thalabil Ilm', '2018-04-13 18:31:00', 'Maghrib', '', '2018-04-13', 'umum', 'Jadwal_00069.jpg', ''),
('Jadwal_00070', 'Masjd_00027', 'Ust_0007', 'Jns_0008', '-', '2018-04-13 18:31:00', 'Maghrib', '', '2018-04-13', 'umum', 'Jadwal_00070.jpg', ''),
('Jadwal_00071', 'Masjd_00029', 'Ust_0035', 'Jns_0001', 'Tanpa Bank Kita Bisa', '2018-04-14 09:00:00', '', '', '2018-04-14', 'umum', 'Jadwal_00071.jpg', ''),
('Jadwal_00072', 'Masjd_00016', 'Ust_0013', 'Jns_0008', 'KAJIAN AKHWAT', '2018-04-14 13:30:00', 'zuhur', '', '2018-04-14', 'akhwat', 'Jadwal_00072.jpg', ''),
('Jadwal_00073', 'Masjd_00013', 'Ust_0008', 'Jns_0005', 'Syarh Manzhumah Ushul Fiqih wa Qawaidih', '2018-04-14 18:33:00', 'Maghrib', '', '2018-04-14', 'umum', 'Jadwal_00073.jpg', ''),
('Jadwal_00074', 'Masjd_00016', 'Ust_0018', 'Jns_0005', 'Tazkiyatun Nufus', '2018-04-14 18:30:00', 'Maghrib', '', '2018-04-14', 'umum', 'Jadwal_00074.jpg', ''),
('Jadwal_00075', 'Masjd_00013', 'Ust_0023', 'Jns_0005', 'Kitabut Tauhid', '2018-04-15 10:30:00', '', 'Jangan lupa bawa catatan & Mushaf', '2018-04-15', 'umum', 'Jadwal_00075.jpg', ''),
('Jadwal_00076', 'Masjd_00016', 'Ust_0038', 'Jns_0005', 'Kasyfusy Syubuhat', '2018-04-15 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan & Mushaf Al - Qur\'an', '2018-04-15', 'umum', 'Jadwal_00076.jpg', ''),
('Jadwal_00077', 'Masjd_00025', 'Ust_0031', 'Jns_0005', 'Al - Wajiz', '2018-04-15 18:34:00', 'Maghrib', 'Jangan lupa bawa catatan & Mushaf', '2018-04-15', 'umum', 'Jadwal_00077.jpg', ''),
('Jadwal_00078', 'Masjd_00037', 'Ust_0006', 'Jns_0005', 'Amdatul Ahkam', '2018-04-15 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan & Mushaf', '2018-04-15', 'ikhwan', 'Jadwal_00078.jpg', ''),
('Jadwal_00079', 'Masjd_00036', 'Ust_0008', 'Jns_0005', 'Raudhatul Anwar', '2018-04-15 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan & Mushaf', '2018-04-15', 'umum', 'Jadwal_00079.jpg', ''),
('Jadwal_00080', 'Masjd_00013', 'Ust_0004', 'Jns_0005', 'Arbain Nawawi', '2018-04-16 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan dan Mushaf Al - Qur\'an', '2018-04-16', 'umum', 'Jadwal_00080.jpg', ''),
('Jadwal_00081', 'Masjd_00016', 'Ust_0005', 'Jns_0005', 'Fathul Qaribil Mujib', '2018-04-16 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan dan Mushaf Al - Qur\'an', '2018-04-16', 'umum', 'Jadwal_00081.jpg', ''),
('Jadwal_00082', 'Masjd_00025', 'Ust_0023', 'Jns_0005', 'Ushul Tsalatsah', '2018-04-16 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan dan Mushaf Al - Qur\'an', '2018-04-16', 'umum', 'Jadwal_00082.jpg', ''),
('Jadwal_00083', 'Masjd_00038', 'Ust_0006', 'Jns_0005', 'Kitabut Tauhid', '2018-04-16 18:31:00', 'Maghrib', 'Jangan lupa bawa catatan dan Mushaf Al - Qur\'an', '2018-04-16', 'ikhwan', 'Jadwal_00083.jpg', ''),
('Jadwal_00084', 'Masjd_00025', 'Ust_0007', 'Jns_0005', 'Kitabut Tauhid', '2018-04-17 14:00:00', 'zuhur', 'Jangan lupa bawa catatan dan Mushaf Al - Qur\'an', '2018-04-17', 'akhwat', 'Jadwal_00084.jpg', ''),
('Jadwal_00085', 'Masjd_00013', 'Ust_0007', 'Jns_0008', '-', '2018-04-17 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan dan Mushaf Al - Qur\'an', '2018-04-17', 'umum', 'Jadwal_00085.jpg', ''),
('Jadwal_00086', 'Masjd_00016', 'Ust_0008', 'Jns_0005', 'At Tibyan fi Adab Hamalatil Qur\'an', '2018-04-17 18:30:00', 'Maghrib', 'Jangan lupa bawa catatan dan Mushaf Al - Qur\'an', '2018-04-17', 'umum', 'Jadwal_00086.jpg', ''),
('Jadwal_00087', 'Masjd_00016', 'Ust_0037', 'Jns_0005', 'Arbain Nawawi', '2018-04-18 18:30:00', 'Maghrib', 'Jangan lupa bawa buku catatan dan Mushaf Al Qur\'an', '2018-04-18', 'umum', 'Jadwal_00087.jpg', ''),
('Jadwal_00088', 'Masjd_00025', 'Ust_0007', 'Jns_0005', 'Riyadhus Shalihin', '2018-04-18 18:30:00', 'Maghrib', 'Jangan lupa bawa buku catatan dan Mushaf Al - Qur\'an', '2018-04-18', 'umum', 'Jadwal_00088.jpg', ''),
('Jadwal_00089', 'Masjd_00031', 'Ust_0009', 'Jns_0005', 'Al - Ushul as - Sittah', '2018-04-18 18:30:00', 'Maghrib', 'Jangan lupa bawa buku catatan dan Mushaf Al - Qur\'an', '2018-04-18', 'umum', 'Jadwal_00089.jpg', 'https://www.youtube.com/embed/_ltK9eV3uVc'),
('Jadwal_00090', 'Masjd_00029', 'Ust_0006', 'Jns_0008', 'Menggapai Kebahagiaan Dunia dan Akhirat', '2018-04-18 18:30:00', 'Maghrib', 'Jangan lupa bawa buku catatan dan Mushaf Al - Qur\'an', '2018-04-18', 'umum', 'Jadwal_00090.jpg', ''),
('Jadwal_00091', 'Masjd_00016', 'Ust_0006', 'Jns_0005', 'Aqidah Wasithiyah', '2018-04-19 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-19', 'umum', 'Jadwal_00091.jpg', ''),
('Jadwal_00092', 'Masjd_00033', 'Ust_0008', 'Jns_0005', 'Ad - Durr an - Natsir (Tafsir Ibnu Katsir) ', '2018-04-19 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-19', 'umum', 'Jadwal_00092.jpg', ''),
('Jadwal_00093', 'Masjd_00034', 'Ust_0007', 'Jns_0008', '-', '2018-04-19 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-19', 'umum', 'Jadwal_00093.jpg', ''),
('Jadwal_00094', 'Masjd_00032', 'Ust_0013', 'Jns_0008', 'Sukses Menuntut Ilmu ', '2018-04-19 14:00:00', '', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-19', 'umum', 'Jadwal_00094.jpg', ''),
('Jadwal_00095', 'Masjd_00024', 'Ust_0004', 'Jns_0005', 'Riyadhus Shalihin', '2018-04-20 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan & Mushaf Al - Qur\'an', '2018-04-20', 'umum', 'Jadwal_00095.jpg', ''),
('Jadwal_00096', 'Masjd_00016', 'Ust_0031', 'Jns_0005', 'Ushul Tsalatsah', '2018-04-20 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan & Mushaf Al - Qur\'an', '2018-04-20', 'umum', 'Jadwal_00096.jpg', ''),
('Jadwal_00097', 'Masjd_00025', 'Ust_0032', 'Jns_0005', 'Kitabul Ilmi', '2018-04-20 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan & Mushaf Al - Qur\'an', '2018-04-20', 'umum', 'Jadwal_00097.jpg', ''),
('Jadwal_00098', 'Masjd_00039', 'Ust_0036', 'Jns_0008', '-', '2018-04-20 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan & Mushaf Al - Qur\'an', '2018-04-20', 'umum', 'Jadwal_00098.jpg', ''),
('Jadwal_00099', 'Masjd_00034', 'Ust_0039', 'Jns_0001', 'Solusi Permodalan Dalam Islam', '2018-04-21 12:30:00', 'zuhur', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-21', 'umum', 'Jadwal_00099.jpg', ''),
('Jadwal_00100', 'Masjd_00016', 'Ust_0018', 'Jns_0005', 'Ushul Tsalatsah', '2018-04-21 13:30:00', 'zuhur', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-21', 'akhwat', 'Jadwal_00100.jpg', ''),
('Jadwal_00101', 'Masjd_00013', 'Ust_0026', 'Jns_0005', 'Tarbiyah Al-Aulad / Pendidikan Anak', '2018-04-21 18:34:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-21', 'umum', 'Jadwal_00101.jpg', ''),
('Jadwal_00102', 'Masjd_00016', 'Ust_0018', 'Jns_0005', 'Tazkiyatun Nufus', '2018-04-21 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an', '2018-04-21', 'umum', 'Jadwal_00102.jpg', ''),
('Jadwal_00103', 'Masjd_00013', 'Ust_0014', 'Jns_0005', 'Bulughul Maram', '2018-04-22 09:00:00', 'Shubuh', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta kitabnya jika ada', '2018-04-22', 'umum', 'Jadwal_00103.jpg', ''),
('Jadwal_00104', 'Masjd_00016', 'Ust_0038', 'Jns_0005', 'Kasyfusy Syubuhat', '2018-04-22 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-22', 'umum', 'Jadwal_00104.jpg', ''),
('Jadwal_00105', 'Masjd_00025', 'Ust_0040', 'Jns_0005', 'Al - Wajiz', '2018-04-22 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-22', 'umum', 'Jadwal_00105.jpg', ''),
('Jadwal_00106', 'Masjd_00037', 'Ust_0006', 'Jns_0005', 'Fiqih | Amdatul Ahkam', '2018-04-22 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-22', 'ikhwan', 'Jadwal_00106.jpg', ''),
('Jadwal_00107', 'Masjd_00036', 'Ust_0008', 'Jns_0005', 'Sejarah Nabi | Raudhatul Anwar', '2018-04-22 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-22', 'umum', 'Jadwal_00107.jpg', ''),
('Jadwal_00108', 'Masjd_00013', 'Ust_0004', 'Jns_0005', 'Hadist | Arbain Nawawi', '2018-04-23 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-23', 'umum', 'Jadwal_00108.jpg', ''),
('Jadwal_00109', 'Masjd_00016', 'Ust_0005', 'Jns_0005', 'Fiqih Shalat | Fathul Qaribil Mujib', '2018-04-23 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-23', 'umum', 'Jadwal_00109.jpg', ''),
('Jadwal_00110', 'Masjd_00025', 'Ust_0023', 'Jns_0005', 'Aqidah | Ushul Tsalatsah', '2018-04-23 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-23', 'umum', 'Jadwal_00110.jpg', ''),
('Jadwal_00111', 'Masjd_00038', 'Ust_0006', 'Jns_0005', 'Aqidah | Kitabut Tauhid', '2018-04-23 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-23', 'ikhwan', 'Jadwal_00111.jpg', ''),
('Jadwal_00112', 'Masjd_00013', 'Ust_0007', 'Jns_0008', '- ', '2018-04-24 18:30:00', 'Maghrib', '', '2018-04-24', 'umum', 'Jadwal_00112.jpg', ''),
('Jadwal_00113', 'Masjd_00016', 'Ust_0008', 'Jns_0005', 'Adab | Tibyan fi Adab', '2018-04-24 18:30:00', 'Maghrib', '', '2018-04-24', 'umum', 'Jadwal_00113.jpg', ''),
('Jadwal_00114', 'Masjd_00025', 'Ust_0007', 'Jns_0005', 'Aqidah | Kita but Tauhid', '2018-04-24 14:00:00', 'zuhur', '', '2018-04-24', 'akhwat', 'Jadwal_00114.jpg', ''),
('Jadwal_00115', 'Masjd_00016', 'Ust_0037', 'Jns_0005', 'Hadist | Arbain Nawawi', '2018-04-25 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-25', 'umum', 'Jadwal_00115.jpg', ''),
('Jadwal_00116', 'Masjd_00025', 'Ust_0007', 'Jns_0005', 'Hadist | Riyadhus Shalihin', '2018-04-25 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-25', 'umum', 'Jadwal_00116.jpg', ''),
('Jadwal_00117', 'Masjd_00031', 'Ust_0009', 'Jns_0005', 'Al Ushul as - Sittah', '2018-04-25 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada', '2018-04-25', 'umum', 'Jadwal_00117.jpg', ''),
('Jadwal_00118', 'Masjd_00013', 'Ust_0005', 'Jns_0005', 'Fiqih Nikah | \"Shahih Fiqhis Sunnah\"', '2018-04-26 14:00:00', 'zuhur', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-26', 'umum', 'Jadwal_00118.jpg', ''),
('Jadwal_00119', 'Masjd_00016', 'Ust_0006', 'Jns_0005', 'Aqidah | \"Aqidah Wasithiyah\"', '2018-04-26 18:00:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-26', 'umum', 'Jadwal_00119.jpg', ''),
('Jadwal_00120', 'Masjd_00027', 'Ust_0038', 'Jns_0005', 'Fiqih / Hadist | \"Al - Wajiz / Riyadhus Shalihin\"', '2018-04-26 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-26', 'umum', 'Jadwal_00120.jpg', ''),
('Jadwal_00121', 'Masjd_00034', 'Ust_0007', 'Jns_0005', 'Hadist | \"Bulughul Maram\"', '2018-04-26 18:00:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-26', 'umum', 'Jadwal_00121.jpg', ''),
('Jadwal_00125', 'Masjd_00029', 'Ust_0009', 'Jns_0008', 'Hijrah dan Konsekuensinya', '2018-04-27 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-27', 'umum', 'Jadwal_00125.jpg', ''),
('Jadwal_00126', 'Masjd_00039', 'Ust_0026', 'Jns_0005', 'Aqidah', '2018-04-27 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an serta Kitabnya jika ada.', '2018-04-27', 'umum', 'Jadwal_00126.jpg', 'https://m.youtube.com/embed/BTwiRzIxBI4'),
('Jadwal_00127', 'Masjd_00040', 'Ust_0007', 'Jns_0008', 'Rahasia dibalik Isra Mi\'raj', '2018-04-28 19:30:00', 'Isya', 'KAJIAN TEMATIK : RAHASIA DIBALIK ISRA MI\'RAJ (UNTUK UMUM)', '2018-04-27', 'umum', 'Jadwal_00127.jpg', 'https://m.youtube.com/embed/Mhr1w1xpp5Y'),
('Jadwal_00129', 'Masjd_00016', 'Ust_0013', 'Jns_0009', 'Kajian Akhwat', '2018-04-28 13:30:00', 'zuhur', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-28', 'akhwat', 'Jadwal_001291.jpg', ''),
('Jadwal_00128', 'Masjd_00035', 'Ust_0009', 'Jns_0005', 'Amdatul Ahkam | Bab. Mengetahui waktu Sholat (Khusus Ummahat)', '2018-04-28 14:00:00', '', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n\r\n', '2018-04-28', 'akhwat', 'Jadwal_001311.jpg', 'https://www.youtube.com/watch/O52eUzz5YRU'),
('Jadwal_00130', 'Masjd_00015', 'Ust_0005', 'Jns_0005', 'Fiqih Muamalat | Shahih Fiqhis Sunnah', '2018-04-28 13:30:00', '', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-28', 'umum', 'Jadwal_00130.jpg', 'https://m.youtube.com/embed/J9UptGOMJhU'),
('Jadwal_00131', 'Masjd_00016', 'Ust_0041', 'Jns_0008', 'Indahnya Memuji Allah', '2018-04-28 18:30:00', 'Maghrib', 'Jangan lupa bawa Buku Catatan dan Mushaf Al - Qur\'an\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-28', 'umum', 'Jadwal_00131.jpg', ''),
('Jadwal_00132', 'Masjd_00017', 'Ust_0041', 'Jns_0008', 'Buktikan Cintamu', '2018-04-29 05:30:00', 'Shubuh', '', '2018-04-29', 'umum', 'Jadwal_001331.jpg', ''),
('Jadwal_00133', 'Masjd_00013', 'Ust_0042', 'Jns_0005', 'Aqidah | Lum\'atul I\'tiqad', '2018-04-29 09:00:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-29', 'umum', 'Jadwal_00133.jpg', ''),
('Jadwal_00134', 'Masjd_00016', 'Ust_0038', 'Jns_0005', 'Aqidah | Kasyfusy Syubuhat', '2018-04-29 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-29', 'umum', 'Jadwal_00134.jpg', ''),
('Jadwal_00135', 'Masjd_00025', 'Ust_0040', 'Jns_0005', 'Fiqih | Al - Wajiz', '2018-04-29 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-29', 'umum', 'Jadwal_00135.jpg', ''),
('Jadwal_00136', 'Masjd_00037', 'Ust_0006', 'Jns_0005', 'Fiqih | Amdatul Ahkam', '2018-04-29 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-29', 'ikhwan', 'Jadwal_00136.jpg', ''),
('Jadwal_00137', 'Masjd_00036', 'Ust_0008', 'Jns_0005', 'Sirah Nabawiyah | Raudhatul Anwar', '2018-04-29 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-29', 'umum', 'Jadwal_00137.jpg', ''),
('Jadwal_00138', 'Masjd_00029', 'Ust_0041', 'Jns_0008', 'Apa yang Menjadikanmu Terpedaya', '2018-04-29 09:00:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-29', 'umum', 'Jadwal_00138.jpg', ''),
('Jadwal_00139', 'Masjd_00013', 'Ust_0004', 'Jns_0005', 'Hadist | Arbain Nawawi', '2018-04-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-30', 'umum', 'Jadwal_00139.jpg', ''),
('Jadwal_00140', 'Masjd_00016', 'Ust_0005', 'Jns_0005', 'Fiqih Shalat | Fathul Qaribil Mujib', '2018-04-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-30', 'umum', 'Jadwal_00140.jpg', ''),
('Jadwal_00141', 'Masjd_00025', 'Ust_0023', 'Jns_0005', 'Aqidah | Ushul Tsalatsah', '2018-04-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-30', 'umum', 'Jadwal_00141.jpg', ''),
('Jadwal_00142', 'Masjd_00037', 'Ust_0006', 'Jns_0005', 'Aqidah | Kitabut Tauhid', '2018-04-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-04-30', 'ikhwan', 'Jadwal_00142.jpg', ''),
('Jadwal_00143', 'Masjd_00025', 'Ust_0007', 'Jns_0005', 'Aqidah | Kitabut Tauhid', '2018-05-01 14:00:00', 'zuhur', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-01', 'akhwat', 'Jadwal_00143.jpg', ''),
('Jadwal_00144', 'Masjd_00013', 'Ust_0010', 'Jns_0005', 'Manhaj | Kun Salafiyan \'Alal Jaddah', '2018-05-01 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-01', 'umum', 'Jadwal_00144.jpg', ''),
('Jadwal_00145', 'Masjd_00016', 'Ust_0008', 'Jns_0005', 'Adab | At-Tibyan fi Adab Hamalatil Qur\'an', '2018-05-01 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-01', 'umum', 'Jadwal_00145.jpg', ''),
('Jadwal_00146', 'Masjd_00031', 'Ust_0009', 'Jns_0005', 'Al-Ushul as-Sittah - Muhammad bin \'Abdul Wahhab rahimahullah | Syarh Syaikh Shalih bin Fauzan', '2018-05-02 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-02', 'umum', 'Jadwal_00147.jpg', ''),
('Jadwal_00147', 'Masjd_00025', 'Ust_0007', 'Jns_0005', 'Hadist | Riyadhus Shalihin', '2018-05-02 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-02', 'umum', 'Jadwal_001471.jpg', ''),
('Jadwal_00148', 'Masjd_00016', 'Ust_0037', 'Jns_0005', 'Hadist | Arbain Nawawi', '2018-05-02 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-02', 'umum', 'Jadwal_00148.jpg', ''),
('Jadwal_00149', 'Masjd_00013', 'Ust_0036', 'Jns_0008', '-', '2018-05-03 14:00:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-03', 'umum', 'Jadwal_00150.jpg', ''),
('Jadwal_00150', 'Masjd_00016', 'Ust_0006', 'Jns_0005', 'Aqidah | Wasithiyah', '2018-05-03 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-03', 'umum', 'Jadwal_001501.jpg', ''),
('Jadwal_00153', 'Masjd_00024', 'Ust_0004', 'Jns_0005', '[KAJIAN RUTIN KITAB]  Masjid Fiqotun Najiah - Ustadz Abu Hamzah, S. Ag - Riyadhus Shalihin', '2018-05-04 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-04', 'umum', 'Jadwal_00153.jpg', ''),
('Jadwal_00152', 'Masjd_00034', 'Ust_0007', 'Jns_0005', 'Hadist | Bulughul Maram', '2018-05-03 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-03', 'umum', 'Jadwal_00152.jpg', ''),
('Jadwal_00154', 'Masjd_00016', 'Ust_0031', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Edi Suarno, S. Sy - Ushul Tsalatsah [Aqidah]', '2018-05-04 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim).', '2018-05-04', 'umum', 'Jadwal_00154.jpg', ''),
('Jadwal_00155', 'Masjd_00025', 'Ust_0032', 'Jns_0009', '[---] Masjid Sulaiman Al-Kuraida - Ustadz Abdul Muhsin', '2018-05-04 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-04', 'umum', 'Jadwal_00155.jpg', ''),
('Jadwal_00156', 'Masjd_00039', 'Ust_0008', 'Jns_0009', '[---] Musalla Nurul Iman - Ustadz Bambang Ahmad Wafly, M. Pd. I', '2018-05-04 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-04', 'umum', 'Jadwal_00156.jpg', ''),
('Jadwal_00157', 'Masjd_00006', 'Ust_0023', 'Jns_0008', '[KAJIAN RUTIN TEMATIK]  Masjid Al-Raiyyah DPRD Sumsel - Ustadz Abu Dzar - `Tauhid Is My Way`', '2018-05-04 19:00:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-04', 'umum', 'Jadwal_00157.jpg', ''),
('Jadwal_00158', 'Masjd_00016', 'Ust_0018', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Firdaus, S. Ag - Ushul Tsalatsah [Akhwat]', '2018-05-05 13:30:00', 'zuhur', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-05', 'umum', 'Jadwal_00158.jpg', ''),
('Jadwal_00159', 'Masjd_00016', 'Ust_0018', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Firdaus, S. Ag - Tazkiyatun Nufush ', '2018-05-05 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-05', 'umum', 'Jadwal_00159.jpg', ''),
('Jadwal_00162', 'Masjd_00040', 'Ust_0026', 'Jns_0005', '[KAJIAN TEMATIK SUBUH] Bersama Ustadz Abu Harits Iswandi S. Ag - Syarah Aqidah Ahlus Sunnah Wal Jama\'ah | Masjid Nurhayunah', '2018-05-06 04:30:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-06', 'umum', 'Jadwal_00162.jpg', ''),
('Jadwal_00161', 'Masjd_00013', 'Ust_0007', 'Jns_0008', '[INFORMASI] Kajian Tematik, Ustad Akhirudin, Lc - Masjid Bakti [DILIBURKAN]  ', '2018-05-05 18:30:00', 'Maghrib', 'DILIBURKAN', '2018-05-05', 'umum', 'Jadwal_00161.jpg', ''),
('Jadwal_00163', 'Masjd_00013', 'Ust_0023', 'Jns_0005', '[KAJIAN RUTIN KITAB] Ustadz Abu Dzar - Kitabut Tauhid | Masjid Bakti Palembang', '2018-05-06 10:00:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-06', 'umum', 'Jadwal_00163.jpg', ''),
('Jadwal_00164', 'Masjd_00025', 'Ust_0040', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Eko Iswanto, S. Sy - Fiqih | Al-Wajiz', '2018-05-06 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-06', 'umum', 'Jadwal_00164.jpg', ''),
('Jadwal_00165', 'Masjd_00037', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Kediaman Ustadz Aidil - Ustadz Aidil Fitriansyah, B.A - [FIQIH] : Amdatul Ahkam', '2018-05-06 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-06', 'ikhwan', 'Jadwal_00165.jpg', ''),
('Jadwal_00166', 'Masjd_00036', 'Ust_0008', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Ar Rahma 2 - Ustadz Bambang Ahmad Wafly, M. Pd. I - Sejarah Nabi | Raudhatul Anwar', '2018-05-06 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-06', 'umum', 'Jadwal_00166.jpg', ''),
('Jadwal_00167', 'Masjd_00016', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Roni Nuryusmansyah, S. Sy - Kitab Fathul Qaribil Mujib [Fiqih Shalat]', '2018-05-07 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-07', 'umum', 'Jadwal_00167.jpg', ''),
('Jadwal_00168', 'Masjd_00025', 'Ust_0023', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Abu Dzar - Ushul Tsalatsah [Aqidah]', '2018-05-07 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim\r\n', '2018-05-07', 'umum', 'Jadwal_00168.jpg', ''),
('Jadwal_00169', 'Masjd_00038', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Darul Asykar - Ustadz Aidil Fitriansyah, B. A - Kitabut Tauhid [Aqidah]', '2018-05-07 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim\r\n', '2018-05-07', 'umum', 'Jadwal_00169.jpg', ''),
('Jadwal_00170', 'Masjd_00013', 'Ust_0004', 'Jns_0005', 'INFORMASI ! [KAJIAN RUTIN KITAB] Masjid Bakti- Ustadz Abu Hamzah, S. Ag - Hadist | Arbain Nawawi [DILIBURKAN]', '2018-05-07 18:30:00', 'Maghrib', 'DILIBURKAN', '2018-05-07', 'umum', 'Jadwal_00170.jpg', ''),
('Jadwal_00171', 'Masjd_00025', 'Ust_0007', 'Jns_0005', '[KAJIAN RUTIN KITAB] Ustadz Akhirudin, Lc - Kitabut Tauhid [AKHWAT] | Masjid Sulaiman Al Kuraida', '2018-05-08 14:00:00', 'zuhur', '-', '2018-05-08', 'akhwat', 'Jadwal_00173.jpg', ''),
('Jadwal_00172', 'Masjd_00013', 'Ust_0010', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti - Ustadz Hidayatullah, S. Sy - [Manhaj] Kun Salafiyan \'Alal Jaddah - `Kaidah dalam Memperingatkan Umat dari Penyimpangan Kelompok /  Individu`', '2018-05-08 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-08', 'umum', 'Jadwal_00172.jpg', ''),
('Jadwal_00173', 'Masjd_00016', 'Ust_0008', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Bambang Ahmad Wafly, M. Pd. I - [Adab] At Tibyan fi Adab Hamalatil Qu\'ran ', '2018-05-08 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-08', 'umum', 'Jadwal_001731.jpg', ''),
('Jadwal_00174', 'Masjd_00031', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Jabal Nur - Ustadz Nurfitri Hadi, MA Hafizahullah - [Aqidah] Syarh Al Ushul as-Sittah [Muhammad \'bin Abdul Wahhab] - Syaikh Shalih bin Fauzan', '2018-05-09 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-09', 'umum', 'Jadwal_00174.jpg', ''),
('Jadwal_00175', 'Masjd_00025', 'Ust_0007', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman al-Kuraida - Ustadz Akhirudin, Lc Hafizahullah - [Hadist] Riyadhus Shalihin', '2018-05-09 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-09', 'umum', 'Jadwal_00175.jpg', ''),
('Jadwal_00176', 'Masjd_00016', 'Ust_0037', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Dhika Wiratrisno, S. Sy Hafizahullah - [Hadist] Arbain Nawawi', '2018-05-09 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-09', 'umum', 'Jadwal_00176.jpg', ''),
('Jadwal_00177', 'Masjd_00016', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Aidil Fitriansyah, B.A Hafizahullah - [Aidah] Aqidah Wasithiyah', '2018-05-10 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-10', 'umum', 'Jadwal_00177.jpg', ''),
('Jadwal_00178', 'Masjd_00034', 'Ust_0036', 'Jns_0008', '[KAJIAN [...] Masjid Asy Sudais - Ustadz [...] Hafizahullah - [...]', '2018-05-10 18:30:00', 'Maghrib', '\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-10', 'umum', 'Jadwal_00178.jpg', ''),
('Jadwal_00179', 'Masjd_00039', 'Ust_0007', 'Jns_0008', '[KAJIAN TEMATIK] Musalla Nurul Iman - Ustadz Akhirudin, Lc - [...]', '2018-05-11 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-11', 'umum', 'Jadwal_00184.jpg', ''),
('Jadwal_00180', 'Masjd_00029', 'Ust_0014', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Al Rai\'yah DPRD Sumsel - Ustadz Nasirudin Irfan Lc Hafizahullah - Ramadhan Bersama Rasulullah', '2018-05-11 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-11', 'umum', 'Jadwal_001841.jpg', ''),
('Jadwal_00181', 'Masjd_00025', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Nuryusmansyah, S. Sy Hafizahullah - [Adab] Ma\'alim fi Thariq Thalabil Ilm', '2018-05-11 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-11', 'umum', 'Jadwal_001842.jpg', ''),
('Jadwal_00182', 'Masjd_00016', 'Ust_0031', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Edi Suarno, S. Sy Hafizahullah - [Aqidah] Ushul Tsalatsah', '2018-05-11 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-11', 'umum', 'Jadwal_001843.jpg', ''),
('Jadwal_00183', 'Masjd_00024', 'Ust_0042', 'Jns_0008', '[KAJIAN [...] Masjid Firqotun Najiyah - Ustadz Faisal Abdul Basith Hafizahullah - [...]', '2018-05-11 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-11', 'umum', 'Jadwal_001845.jpg', ''),
('Jadwal_00184', 'Masjd_00016', 'Ust_0013', 'Jns_0005', '[KAJIAN RUTIN AKHWAT] Masjid Imam Syafi\'i - Ustadz Yusuf Solihin, S. Pd. I Hafizahullah [...]', '2018-05-12 13:30:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-12', 'akhwat', 'Jadwal_001861.jpg', '');
INSERT INTO `jadwal` (`id_jadwal`, `id_masjid`, `id_ustad`, `id_jenis_kajian`, `judul_kajian`, `waktu_kajian`, `bada`, `deskripsi_kajian`, `tgl_upload`, `kelompok`, `gambar`, `video_url`) VALUES
('Jadwal_00185', 'Masjd_00035', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Ar Razzaq - Ustadz Nurfitri Hadi, M. A - [Fiqih] Umdatul Ahkam - BAB SHOLAT', '2018-05-12 14:00:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-12', 'umum', 'Jadwal_001862.jpg', ''),
('Jadwal_00186', 'Masjd_00016', 'Ust_0018', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Firdaus, S. Ag Hafizahullah - Tazkiyyatun Nafs | Dr. Ahmad Farid', '2018-05-12 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-12', 'umum', 'Jadwal_00188.jpg', ''),
('Jadwal_00187', 'Masjd_00013', 'Ust_0042', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Bakti - Ustadz Faisal Abdul Basith Hafizahullah - [Aqidah]', '2018-05-12 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-12', 'umum', 'Jadwal_00187.jpg', ''),
('Jadwal_00188', 'Masjd_00013', 'Ust_0042', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti - Ustadz Faisal Abdul Basith Hafizahullah - [Aqidah] Li\'matul I\'tiqad ', '2018-05-13 09:00:00', 'Shubuh', '-', '2018-05-13', 'umum', 'Jadwal_00189.jpg', ''),
('Jadwal_00189', 'Masjd_00036', 'Ust_0008', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Ar-Rahmah 2 - Ustadz Bambang Ahmad Wafly, M. Pd. I Hafizahullah - [Sirah Nabawiyah] Raudhatul Anwar', '2018-05-13 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-13', 'umum', 'Jadwal_001891.jpg', ''),
('Jadwal_00190', 'Masjd_00037', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Kediaman Ustadz Aidil - Ustadz Aidil Fitriansyah, B. A Hafizahullah - [Fiqih] Umdatul Ahkam [Ikhwan]', '2018-05-13 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-13', 'ikhwan', 'Jadwal_00190.jpg', ''),
('Jadwal_00191', 'Masjd_00025', 'Ust_0036', 'Jns_0005', '[INFORMASI] KAJIAN RUTIN - Masjid Sulaiman Al Kuraida, Talang Jambe [DILIBURKAN]', '2018-05-13 18:30:00', 'Maghrib', '[LIBUR]', '2018-05-13', 'umum', 'Jadwal_00191.jpg', ''),
('Jadwal_00192', 'Masjd_00016', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - [Fiqih Sholat] Fathul Qaribil Mujib', '2018-05-14 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-14', 'umum', 'Jadwal_00192.jpg', ''),
('Jadwal_00193', 'Masjd_00038', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Darul Asykar - Ustadz Aidil Fitriansyah, B. A Hafidzahullah - [Aqidah] Kitabut Tauhid | Ikhwan', '2018-05-14 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-14', 'ikhwan', 'Jadwal_00193.jpg', ''),
('Jadwal_00194', 'Masjd_00025', 'Ust_0036', 'Jns_0005', '[INFORMASI] KAJIAN RUTIN - Masjid Sulaiman Al Kuraida, Talang Jambe [DILIBURKAN]', '2018-05-14 18:30:00', 'Maghrib', 'DILIBURKAN', '2018-05-14', 'umum', 'Jadwal_00194.jpg', ''),
('Jadwal_00195', 'Masjd_00013', 'Ust_0036', 'Jns_0005', '[INFORMASI] KAJIAN RUTIN - Masjid Bakti, Palembang [DILIBURKAN]', '2018-05-14 18:30:00', 'Maghrib', 'DILIBURKAN', '2018-05-14', 'umum', 'Jadwal_00195.jpg', ''),
('Jadwal_00196', 'Masjd_00013', 'Ust_0007', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Bakti - Ustadz Akhirudin, Lc, Hafidzahullah - [...]', '2018-05-15 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-15', 'umum', 'Jadwal_00196.jpg', ''),
('Jadwal_00197', 'Masjd_00025', 'Ust_0023', 'Jns_0005', '[KAJIAN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Abu Dzar Hafidzahullah - [Tafsir] Tafsir Juz Ama (Akhwat)', '2018-05-15 14:00:00', 'zuhur', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-15', 'akhwat', 'Jadwal_00197.jpg', ''),
('Jadwal_00198', 'Masjd_00016', 'Ust_0008', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Bambang Ahmad Wafly, M. Pd. I Hafidzahullah - [Adab] At-Tibyan fi Adab Hamalatil Qur\'an', '2018-05-15 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-15', 'umum', 'Jadwal_00198.jpg', ''),
('Jadwal_00199', 'Masjd_00029', 'Ust_0036', 'Jns_0008', '[RAMADHAN MUBARAK] Buka Bersama & Kajian Rutin [Jum\'at] + I\'tikaf 10 Malam Terakhir Ramadhan - Masjid Al-Ra\'iyyah (Koplek DPRD Sumsel) - 16.30 s/d SELESAI [TERBUKA UNTUK UMUM]', '2018-05-25 16:30:00', 'Asar', 'Rangkaian Acara [RAMADHAN MUBARAK] :\r\n- Kajian Islam menjelang Buka Puasa\r\n- Iftor bersama\r\n- I\'tikaf 10 Malam Terakhir Ramadhan\r\n\r\n[KAJIAN JUMAT]\r\n1. 25 Mei 2018 - `Sudahkan anda benar - benar berpuasa` Ustadz Aidil Fitriansyah, B. A Hafidzahullah\r\n2. 01 Juni 2018 - `Kemenangan Kaum Muslimin dibulan Ramadhan` Ustadz Nurfitri Hadi, M. A Hafidzahullah\r\n3. 08 Juni 2018 - Andaikan ini Ramadhan terakhir ku` Ustadz Abu Dzar Hafidzahullah\r\n\r\nDONASI [Buka Puasa Ramadhan]\r\nBANK BCA Syariah\r\n(Kode BANK : 536)\r\n05 2000 4466\r\nAtas Nama\r\nIswardi', '2018-05-21', 'umum', 'Jadwal_00199.jpg', ''),
('Jadwal_00200', 'Masjd_00016', 'Ust_0037', 'Jns_0008', '[KAJIAN RAMADHAN] Masjid Imam Syafi\'i - Ustadz Dhika Wiratrisno, S.Sy Hafidzahullah - [...]', '2018-05-23 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-23', 'umum', 'Jadwal_00200.jpg', ''),
('Jadwal_00201', 'Masjd_00013', 'Ust_0005', 'Jns_0008', '[KAJIAN RAMADHAN] Masjid Bakti - Ustadz Roni Nuryusmansyah S.Sy Hafidzahullah - Move On bersama Ramadhan', '2018-05-24 14:00:00', 'zuhur', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-24', 'umum', 'Jadwal_00201.jpg', ''),
('Jadwal_00202', 'Masjd_00006', 'Ust_0006', 'Jns_0008', '[RAMADHAN MUBARAK] Kajian Islam Ilmiah Palembang & Iftar Bersama - Masjid Besar Al Ra\'iyah DPRD Provinsi Sumsel - Ustadz Aidil Fitriansyah B.A Hafidzahullah - `Sudahkah Anda benar-benar berpuasa`', '2018-05-25 16:30:00', 'Asar', '???? Ramadhan Mubarak ????\r\nKajian Islam Ilmiah Palembang & Iftar Bersama\r\n.\r\nGratis. Terbuka untuk Umum (Ikhwan & Akhwat)\r\nBersama) :\r\n???? Ustadz Aidil Fitriansyah B.A ???? ???? .\r\nTema : Sudahkah Anda benar-benar berpuasa\r\n.\r\n.\r\n???? Jum\'at, 25 Mei 2018.\r\n.\r\n???? Pukul 16.30 wib\r\n.\r\n???? Masjid Besar Al Ra\'iyah DPRD Provinsi Sumsel. .\r\nDILANJUTKAN. ..\r\n???? Sholat Isya & Tarawih Berjama\'ah ???? Imam : Ust. Roni Nuryusmansyah S,Sy Hafizhahuahu Ta\'ala\r\n.\r\n.\r\nKomplek DPRD Provinsi Sumsel, Jalan POM 9 Kampus, Lorok Pakjo, Ilir Barat I, Palembang.\r\nhttps://goo.gl/maps/5uFmEQ14mpM2.\r\n\r\nDari Abu Hurairah radhiallahu’anhu, sesungguhnya Rasulullah shallallahu’alaihi wasallam bersabda : \r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim No.2699).\r\n.\r\nSilahkan disebarkan...Semoga menjadi ladang kebaikan bagi kita semua.\r\n.\r\nJazakumullah Khairan.\r\n.\r\nCP. Panitia\r\n???? *WA 0812-7804-5229\r\n???? *WA 0812-7855-5330\r\n.\r\n???? Acara ini terselenggara oleh :\r\n? The “CREW” al Ghuroba\r\n? ”KIPS\" Komunitas Ikhwan Polda Sumsel\r\n.\r\n???? Dapatkan Info Kajian Palembang di channel telegram @KajianPalembang dan fans page Info Kajian Palembang di facebook serta download jadwal kajian palembang di playstore the ghuroba.\r\n\r\nSilahkan bergabung untuk mendapatkan manfaat ilmu syar\'i dan info kajian seputar Palembang dengan Like, Subcribe, Follow dan Cek Akun kami di bawah ini\r\n.\r\n???? Instagram : @the.Ghuroba\r\n???? Facebook : Al Ghuroba Palembang (Fanspage)\r\n???? Youtube : THE CREW al GHUROBA\r\n???? Telegram : Info Kajian Palembang\r\n???? What’sApp : +6281278045229 (Ikhwan) - +62895373416253 (Akhwat)\r\n.\r\n? Mari berdakwah dengan menyebarluaskan info kajian ini\r\n.\r\n#sunnah #kajianislam #kajiansunnah #kajiansalaf #kajianpalembang #dakwahsunnah #dakwahtauhid #dakwahsalaf #manhajsalaf #palembangmengaji #hadits #muslim #islam #ky_palembang #kajianyuk #palembang #kajianyuk #ky_sumsel #kajianselasa #ghuroba #alghuroba #belajarilmusyari #BIS #BISPalembang', '2018-05-25', 'umum', 'Jadwal_00202.jpg', ''),
('Jadwal_00203', 'Masjd_00035', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Ar  Razzaq - Ustadz Nurfitri Hadi M. A Hafidzahullah - [Fiqih] Umdatul Ahkam', '2018-05-26 10:00:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-26', 'umum', 'Jadwal_00203.jpg', ''),
('Jadwal_00204', 'Masjd_00016', 'Ust_0018', 'Jns_0005', '[KAJIAN RUTIN AKHWAT] Masjid Imam Syafi\'i - Ustadz Firdaus S. Ag / Yusuf Solihin S. Pd. I Hafidzahullah - [...]', '2018-05-26 13:30:00', 'zuhur', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-26', 'akhwat', 'Jadwal_00204.jpg', ''),
('Jadwal_00205', 'Masjd_00021', 'Ust_0022', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Al Hijrah - Ustadz Fuad Hamzah Baraba, Lc Hafidzahullah - Rida Allah Tergantung Rida Orang Tua', '2018-05-26 15:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-26', 'umum', 'Jadwal_00205.jpg', ''),
('Jadwal_00206', 'Masjd_00021', 'Ust_0022', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Al Hijrah - Ustadz Fuad Hamzah Baraba, Lc Hafidzahullah - Islam Mengecam Terorisme', '2018-05-26 20:00:00', 'Isya', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-26', 'umum', 'Jadwal_00206.jpg', ''),
('Jadwal_00207', 'Masjd_00025', 'Ust_0007', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Sulaiman Al Kuraida - Ustadz Achirudin, Lc Hafidzahullah - Perniagaan yang tidak pernah Rugi', '2018-05-28 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-05-28', 'umum', 'Jadwal_00207.jpg', ''),
('Jadwal_00208', 'Masjd_00031', 'Ust_0009', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Djabal Nur - Ustadz Nurfitri Hadi, M. A Hafidzahullah - Tafsir Al - Fatihah', '2018-05-28 17:00:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n\r\nInfo Kajian Menjelang berbuka \r\n\r\nGRATIS, terbuka untuk umum: ikhwan dan akhwat  \r\n\r\nMATERI:\r\nTafsir Surah Al-Fatihah\r\n\r\nPEMATERI:\r\nUst. Nurfitri Hadi,M.A\r\n\r\nTANGGAL: \r\nSenin, 12 Ramadan 1439 H / 28 Mei 2018 M\r\n\r\nWAKTU: \r\nPukul 17:00\r\n(Dilanjutkan Buka Bersama)\r\n\r\nTEMPAT:  \r\nMasjid Djabal Nur JL Seruni, No. 07 RT 03 RW 01, Bukit Lama, Bukit Lama, Ilir Bar. I, Kota Palembang, Sumatera Selatan 30137\r\n\r\nPETA: \r\n https://g.co/kgs/Qdq1za\r\n\r\n\r\n? Silakan ajak keluarga, karib kerabat, tetangga, teman, dan yang lainnya, dengan cara menyebarluaskan info ini\r\n\r\nCp : \r\n- 081277744689 (Ari)\r\n- 082279290151 (Kiki)\r\n', '2018-05-28', 'umum', 'Jadwal_00208.jpg', ''),
('Jadwal_00209', 'Masjd_00016', 'Ust_0009', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Imam Syafi\'i - Ustadz Nurfitri Hadi, M. A Hafidzahullah - [...]', '2018-05-29 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-29', 'umum', 'Jadwal_00209.jpg', ''),
('Jadwal_00210', 'Masjd_00029', 'Ust_0009', 'Jns_0008', '[RAMADHAN MUBARAK] Kajian Islam Ilmiah Palembang & Iftar Bersama - Masjid Besar Al Ra\'iyah DPRD Provinsi Sumsel - Ustadz Nurfitri Hadi, M. A Hafidzahullah - `Kemenangan kaum muslimin dibulan Ramadhan`', '2018-05-31 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-05-31', 'umum', 'Jadwal_00210.jpg', ''),
('Jadwal_00211', 'Masjd_00025', 'Ust_0005', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Sulaiman Al Kuraida - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - `Ramadhan : THE ENDING`', '2018-06-01 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-06-01', 'umum', 'Jadwal_00211.jpg', ''),
('Jadwal_00212', 'Masjd_00016', 'Ust_0005', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Imam Syafi\'i - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - `Ramadhan.. Cinta diatas Segala Cinta`', '2018-06-06 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-06-06', 'umum', 'Jadwal_00212.jpg', ''),
('Jadwal_00213', 'Masjd_00029', 'Ust_0023', 'Jns_0008', 'INFORMASI : [RAMADHAN MUBARAK] Buka Bersama & Kajian Rutin + I\'tikaf 10 Malam Terakhir Ramadhan - Masjid Al-Ra\'iyyah (Koplek DPRD Sumsel) - 16.30 s/d SELESAI [DILIBURKAN]', '2018-06-07 16:30:00', 'Asar', '-', '2018-06-07', 'umum', 'Jadwal_00213.jpg', ''),
('Jadwal_00214', 'Masjd_00013', 'Ust_0020', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Bakti Palembang - Ustadz Umar Fanani, Lc Hafidzahullah - `Menjalin Ukhuwah Islamiyah`', '2018-06-09 16:00:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-06-09', 'umum', 'Jadwal_00214.jpg', ''),
('Jadwal_00215', 'Masjd_00036', 'Ust_0009', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Ar Rahmah 2 - Ustadz Nurfitri Hadi, M. A Hafidzahullah - `Bulan yang dirindukan`', '2018-06-09 17:00:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-06-09', 'umum', 'Jadwal_00215.jpg', ''),
('Jadwal_00216', 'Masjd_00013', 'Ust_0042', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Bakti Palembang - Ustadz Faishol Abdul Basit, Hafidzahullah - `...`', '2018-06-10 10:00:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-06-10', 'umum', 'Jadwal_00216.jpg', ''),
('Jadwal_00217', 'Masjd_00016', 'Ust_0043', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Imam Syafi\'i - Ustadz Edi Purwanto, BA Hafidzahullah - `Mencapai Istiqomah`', '2018-06-10 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-06-10', 'umum', 'Jadwal_002191.jpg', ''),
('Jadwal_00218', 'Masjd_00024', 'Ust_0042', 'Jns_0008', '[KAJIAN TEMATIK RAMADHAN] Masjid Firqotun Najiyah - Ustadz Faishol Abdul Basit, Hafidzahullah - `TAQDIR MANUSIA`', '2018-06-10 16:30:00', 'Asar', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-06-10', 'umum', 'Jadwal_00218.jpg', ''),
('Jadwal_00219', 'Masjd_00013', 'Ust_0005', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Bakti - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - [...]', '2018-06-26 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-06-26', 'umum', 'Jadwal_00219.jpg', ''),
('Jadwal_00220', 'Masjd_00013', 'Ust_0007', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Bakti - Ustadz Achirudin, Lc Hafidzhahullah - [...]', '2018-07-03 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-07-03', 'umum', 'Jadwal_00220.jpg', ''),
('Jadwal_00221', 'Masjd_00029', 'Ust_0044', 'Jns_0001', '[TABLIGH AKBAR] Masjid Al Rai\'yah DPRD Sumsel - Ustadz dr. Raehanul Bahren  Hafizhahullah - PENYAKIT JIWA Dan KESURUPAN', '2018-07-06 18:00:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-07-06', 'umum', 'Jadwal_00221.jpg', ''),
('Jadwal_00222', 'Masjd_00041', 'Ust_0044', 'Jns_0001', '[TABLIGH AKBAR] Masjid Darul Muttaqin - Ustadz dr. Raehanul Bahren Hafizhahullah - BAHAGIA dan SEHAT ALA RASULULLAH', '2018-07-07 10:00:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-07-07', 'umum', 'Jadwal_00222.jpg', ''),
('Jadwal_00223', 'Masjd_00042', 'Ust_0044', 'Jns_0001', '[TABLIGH AKBAR] Masjid At Taqwa Palembang - Ustadz dr. Raehanul Bahraen Hafizhahullah - SAKARATUL MAUT DALAM TINJAUAN SYARIAT DAN MEDIS', '2018-07-08 10:00:00', 'Shubuh', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-07-08', 'umum', 'Jadwal_00223.jpg', ''),
('Jadwal_00224', 'Masjd_00013', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti - Ustadz Roni Nuryusmansyah, S. Sy Hafidzhahullah - [FIQIH DAKWAH] #DULUKITAJUGAGITU', '2018-07-10 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-10', 'umum', 'Jadwal_00224.jpg', ''),
('Jadwal_00225', 'Masjd_00031', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Djabal Nur - Ustadz Nurfitri Hadi, M. A Hafidzahullah - Al-Ushul as-Sittah - Muhammad bin \'Abdul Wahhab rahimahullah | Syarh Syaikh Shalih bin Fauzan', '2018-07-11 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-11', 'umum', 'Jadwal_00225.jpg', ''),
('Jadwal_00226', 'Masjd_00034', 'Ust_0005', 'Jns_0005', '[KAJIAN KITAB] Masjid Al Sudays - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - [Fiqih Taharah] Sahih Fiqhis Sunnah', '2018-07-11 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-11', 'umum', 'Jadwal_00226.jpg', ''),
('Jadwal_00227', 'Masjd_00013', 'Ust_0045', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti - Ustadz Oper Jakse, Lc Hafidzahullah - `Kemana Niatmu Menuju ?` [HADIST] Arbain An Nawawi | Hadist ke-1 ', '2018-07-12 14:00:00', 'zuhur', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim', '2018-07-12', 'umum', 'Jadwal_00227.jpg', ''),
('Jadwal_00228', 'Masjd_00029', 'Ust_0023', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Al Rai\'yah DPRD Sumsel - Ustadz Abu Dzar Hafidzahullah - BAHAGIA DIDUNIA, BAHAGIA DIAKHIRAT', '2018-07-13 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-13', 'umum', 'Jadwal_00229.jpg', ''),
('Jadwal_00229', 'Masjd_00035', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Ar  Razzaq - Ustadz Nurfitri Hadi M. A Hafidzhahullah - [FIQIH] Umdatul Ahkam - [BAB. SHOLAT] Menghadap Kiblat & Fiqih Shaf dalam Sholat Berjama’ah', '2018-07-14 14:00:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-14', 'umum', 'Jadwal_00230.jpg', ''),
('Jadwal_00230', 'Masjd_00015', 'Ust_0007', 'Jns_0008', '[KAJIAN TEMATIK] Masjid Al - Furqon - Ustadz Achirudin, Lc Hafidzhahullah - Keutamaan Bulan Haram', '2018-07-14 14:00:00', 'zuhur', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-07-14', 'umum', 'Jadwal_002301.jpg', ''),
('Jadwal_00231', 'Masjd_00013', 'Ust_0008', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Bakti Palembang - Ustadz Bambang Ahmad Wafly, M. Pd. I Hafidzahullah - [...] ', '2018-07-14 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-14', 'umum', 'Jadwal_00231.jpg', ''),
('Jadwal_00232', 'Masjd_00025', 'Ust_0023', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Abu Dzar Hafidzahullah - [Aqidah] Ushul Tsalatsah', '2018-07-16 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-16', 'umum', 'Jadwal_00232.jpg', ''),
('Jadwal_00233', 'Masjd_00038', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Darul Asykar - Ustadz Aidil Fitriansyah, B. A Hafidzahullah - [Aqidah] Kitabut Tauhid [IKHWAN]', '2018-07-16 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-16', 'ikhwan', 'Jadwal_00233.jpg', ''),
('Jadwal_00234', 'Masjd_00016', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - [Fiqih Sholat] Fathul Qaribil Mujib ', '2018-07-16 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-16', 'umum', 'Jadwal_00234.jpg', ''),
('Jadwal_00235', 'Masjd_00016', 'Ust_0008', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Bambang Ahmad Wafly, M. Pd. I Hafidzahullah - At Tibyan fi Adab Hamalatil Qur’an | Imam Abu Zakaria Yahya bin Syaraf an Nawawi', '2018-07-17 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\"', '2018-07-17', 'umum', 'Jadwal_00235.jpg', ''),
('Jadwal_00236', 'Masjd_00013', 'Ust_0010', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti Palembang - Ustadz Hidayatullah, S. Sy Hafidzahullah - Ushulus Sunnah | Imam Ahmad Ibn Hanbal', '2018-07-17 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\"\r\n', '2018-07-17', 'umum', 'Jadwal_00236.jpg', ''),
('Jadwal_00237', 'Masjd_00031', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Djabal Nur - Ustadz Nurfitri Hadi, M. A Hafidzahullah - Al-Ushul as-Sittah - Muhammad bin \'Abdul Wahhab rahimahullah | Syarh Syaikh Shalih bin Fauzan', '2018-07-18 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\"\r\n', '2018-07-18', 'umum', 'Jadwal_00237.jpg', ''),
('Jadwal_00238', 'Masjd_00016', 'Ust_0037', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Dhika Wiratrisno, S. Sy Hafidzahullah - Arbain Nawawi -  Al-Imam al-Allamah Abu Zakaria Muhyuddin bin Syaraf an-Nawawi ad-Dimasyqi', '2018-07-18 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-18', 'umum', 'Jadwal_00238.jpg', ''),
('Jadwal_00239', 'Masjd_00034', 'Ust_0008', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Al Sudays - Ustadz Bambang Ahmad Wafly, M. Pd. I Hafidzahullah - [TEMATIK]', '2018-07-18 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-18', 'umum', 'Jadwal_00239.jpg', ''),
('Jadwal_00240', 'Masjd_00013', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti Palembang - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - [FIQIH NIKAH] Shahih Fiqh as Sunnah - MAS KAWIN ', '2018-07-19 14:00:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-19', 'umum', 'Jadwal_00240.jpg', ''),
('Jadwal_00241', 'Masjd_00016', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Aidil Fitriansyah, B. A Hafidzahullah - [Aqidah] Syarh Aqidah Wasithiyah | Abul Abbas Taqiyuddin Ahmad bin Abdus Salam bin Abdullah bin Taimiyah al Harrani', '2018-07-19 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-19', 'umum', 'Jadwal_00241.jpg', ''),
('Jadwal_00242', 'Masjd_00029', 'Ust_0046', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Al Rai\'yah DPRD Sumsel - Ustadz Ibnu Hajar Hafidzahullah - Pertolonganmu Ya Rabb', '2018-07-20 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-07-20', 'umum', 'Jadwal_00242.jpg', ''),
('Jadwal_00243', 'Masjd_00016', 'Ust_0036', 'Jns_0009', '[KAJIAN AKHWAT] Masjid Imam Syafi\'i -  [...] - [...]', '2018-07-21 13:30:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-21', 'akhwat', 'Jadwal_00243.jpg', ''),
('Jadwal_00244', 'Masjd_00035', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Ar Razzaq - UstadzNurfitri Hadi, M. A Hafidzahullah - [Fiqih] Umdatul Ahkam - `Hak & Kewajiban Imam dalam Sholat`', '2018-07-21 14:00:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-21', 'umum', 'Jadwal_00244.jpg', ''),
('Jadwal_00245', 'Masjd_00013', 'Ust_0008', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Bakti Palembang - Ustadz Bambang Ahmad Wafly, M. Pd. I Hafidzahullah - Kaidah Fiqih', '2018-07-21 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-21', 'umum', 'Jadwal_00245.jpg', ''),
('Jadwal_00246', 'Masjd_00016', 'Ust_0018', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Firdaus, S. Ag Hafidzahullah - Tazkiyatun Nafs', '2018-07-21 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-21', 'umum', 'Jadwal_00246.jpg', ''),
('Jadwal_00247', 'Masjd_00025', 'Ust_0023', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Abu Dzar Hafidzahullah - [Aqidah] Ushul Tsalatsah | Muhammad bin Abdul Wahhab rahimahullah', '2018-07-23 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-23', 'umum', 'Jadwal_00247.jpg', ''),
('Jadwal_00248', 'Masjd_00038', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Darul Asykar - Ustadz Aidil Fitriansyah, B. A Hafidzahullah - [Aqidah] Kitabut Tauhid [IKHWAN] | Muhammad bin Abdul Wahhab rahimahullah', '2018-07-23 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-23', 'ikhwan', 'Jadwal_00248.jpg', ''),
('Jadwal_00249', 'Masjd_00016', 'Ust_0036', 'Jns_0009', '[KAJIAN RUTIN] Masjid Imam Syafi\'i - [...] - [...]', '2018-07-23 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-23', 'umum', 'Jadwal_00249.jpg', ''),
('Jadwal_00250', 'Masjd_00013', 'Ust_0007', 'Jns_0008', '[KAJIAN RUTIN KITAB] Masjid Bakti Palembang - Ustadz Akhirudin, Lc Hafidzahullah - [TEMATIK]', '2018-07-24 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-24', 'umum', 'Jadwal_00253.jpg', ''),
('Jadwal_00251', 'Masjd_00016', 'Ust_0008', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Bambang Ahmad Wafly, M. Pd. I Hafidzahullah - At Tibyan fi Adab Hamalatil Qur’an | Imam Abu Zakaria Yahya bin Syaraf an Nawawi', '2018-07-24 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-24', 'umum', 'Jadwal_00251.jpg', ''),
('Jadwal_00252', 'Masjd_00043', 'Ust_0023', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Al Aqobah I - Ustadz Abu Dzar, Lc Hafidzahullah - [Aqidah] Kitabut Tauhid | Fathul Majid - Syaikh Muhammad ibn Abdul Wahhab rahimahullah', '2018-07-24 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-24', 'umum', 'Jadwal_00252.jpg', ''),
('Jadwal_00253', 'Masjd_00031', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Djabal Nur - Ustadz Nurfitri Hadi, M. A Hafidzahullah - Al-Ushul as-Sittah - Syaikh Muhammad bin \'Abdul Wahhab rahimahullah | Syarh Syaikh Shalih bin Fauzan', '2018-07-25 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-25', 'umum', 'Jadwal_002531.jpg', ''),
('Jadwal_00254', 'Masjd_00016', 'Ust_0037', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Dhika Wiratrisno, S. Sy Hafidzahullah - Arbain Nawawi -  Al-Imam al-Allamah Abu Zakaria Muhyuddin bin Syaraf an-Nawawi ad-Dimasyqi', '2018-07-25 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-25', 'umum', 'Jadwal_00254.jpg', ''),
('Jadwal_00255', 'Masjd_00034', 'Ust_0007', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Al Sudays - Ustadz Akhirudin, Lc Hafidzahullah - [...]', '2018-07-25 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-25', 'umum', 'Jadwal_002561.jpg', ''),
('Jadwal_00256', 'Masjd_00029', 'Ust_0007', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Al Rai\'yah DPRD Sumsel - Ustadz Akhirudin, Lc Hafidzahullah - `Inilah Jalaku yang Lurus` [Tafsir : QS. Yusuf - 108]', '2018-07-27 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-27', 'umum', 'Jadwal_00256.jpg', ''),
('Jadwal_00257', 'Masjd_00016', 'Ust_0031', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Edi Suarno, S. Sy Hafidzahullah - Ushul Tsalatsa | Syaikh Muhammad bin Abdul Wahhab rahimahullah', '2018-07-27 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-27', 'umum', 'Jadwal_00257.jpg', ''),
('Jadwal_00258', 'Masjd_00016', 'Ust_0018', 'Jns_0008', '[KAJIAN RUTIN AKHWAT] Masjid Imam Syafi\'i - Ustadz Firdaus, S. Ag Hafidzahullah -  [Aqidah]', '2018-07-28 13:30:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-28', 'akhwat', 'Jadwal_00258.jpg', ''),
('Jadwal_00259', 'Masjd_00015', 'Ust_0007', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Al Furqon - Ustadz Akhirudin, Lc Hafidzahullah - [Manhaj] Syarhus Sunnah | Abu Muhammad Al-Hasan bin Ali bin Khalaf Al-Barbahari', '2018-07-28 13:30:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-28', 'umum', 'Jadwal_00259.jpg', ''),
('Jadwal_00260', 'Masjd_00035', 'Ust_0045', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Ar Razzaq - Ustadz Oper Jakse, Lc Hafidzahullah - `Istiqomah diatas Ilmu dan Amal`', '2018-07-28 14:00:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-07-28', 'umum', 'Jadwal_002611.jpg', ''),
('Jadwal_00261', 'Masjd_00016', 'Ust_0018', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Firdaus, S. Ag Hafidzahullah - Tazkiyyatun Nafs | Dr. Ahmad Farid', '2018-07-28 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-28', 'umum', 'Jadwal_002632.jpg', ''),
('Jadwal_00262', 'Masjd_00013', 'Ust_0026', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti - Ustadz Abu Harits, S. Ag Hafidzhahullah - Pendidikan Anak | Tarbiyatul Aulad', '2018-07-28 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\"', '2018-07-28', 'umum', 'Jadwal_002631.jpg', ''),
('Jadwal_00263', 'Masjd_00025', 'Ust_0023', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Abu Dzar Hafidzahullah - [Aqidah] Ushul Tsalatsah', '2018-07-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-30', 'umum', 'Jadwal_00263.jpg', ''),
('Jadwal_00264', 'Masjd_00038', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Darul Asykar - Ustadz Aidil Fitriansyah, B. A Hafidzahullah - [Aqidah] Kitabut Tauhid [IKHWAN]', '2018-07-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-30', 'ikhwan', 'Jadwal_00264.jpg', ''),
('Jadwal_00265', 'Masjd_00016', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Roni Nuryusmansyah, S. Sy Hafidzahullah - [Fiqih Sholat] Fathul Qaribil Mujib ', '2018-07-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-30', 'umum', 'Jadwal_00265.jpg', ''),
('Jadwal_00266', 'Masjd_00013', 'Ust_0004', 'Jns_0005', '[KAJIAN RUTIN TEMATIK] Masjid Bakti Palembang - Ustadz Abu Hamzah, S. Ag Hafidzahullah - [Hadist] Arbain Nawawi', '2018-07-30 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-07-30', 'umum', 'Jadwal_00266.jpg', ''),
('Jadwal_00267', 'Masjd_00031', 'Ust_0009', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Djabal Nur - Ustadz Nurfitri Hadi, M. A Hafidzahullah - `Ma\' na Thaghut` ', '2018-08-01 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-08-01', 'umum', 'Jadwal_00267.jpg', ''),
('Jadwal_00268', 'Masjd_00016', 'Ust_0037', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Dhika Wiratrisno, S. Sy Hafidzahullah - Arbain Nawawi -  Al-Imam al-Allamah Abu Zakaria Muhyuddin bin Syaraf an-Nawawi ad-Dimasyqi', '2018-08-01 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-08-01', 'umum', 'Jadwal_00268.jpg', ''),
('Jadwal_00269', 'Masjd_00034', 'Ust_0007', 'Jns_0005', '[KAJIAN RUTIN TEMATIK] Masjid Al Sudays - Ustadz Akhirudin, Lc Hafidzahullah - [Aqidah] Ushul Tsalatsa', '2018-08-01 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-08-01', 'umum', 'Jadwal_00269.jpg', ''),
('Jadwal_00270', 'Masjd_00025', 'Ust_0036', 'Jns_0009', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz [...] Hafidzahullah - [...] ', '2018-08-01 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)\r\n', '2018-08-01', 'umum', 'Jadwal_00270.jpg', ''),
('Jadwal_00271', 'Masjd_00013', 'Ust_0007', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Bakti Palembang - Ustadz Akhirudin, Lc Hafidzahullah - [Aqidah] Syarh Aqidah Ahlusunah wal Jamaah', '2018-08-02 14:00:00', '', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-08-02', 'umum', 'Jadwal_00271.jpg', ''),
('Jadwal_00272', 'Masjd_00016', 'Ust_0006', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Aidil Fitriansyah, B. A Hafidzahullah - [Aqidah] Syarh Aqidah Wasithiyah | Abul Abbas Taqiyuddin Ahmad bin Abdus Salam bin Abdullah bin Taimiyah al Harrani', '2018-08-02 14:00:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-08-02', 'umum', 'Jadwal_00272.jpg', ''),
('Jadwal_00273', 'Masjd_00025', 'Ust_0005', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Sulaiman Al Kuraida - Ustadz Rony Nuryusmansyah, S. Sy Hafidzahullah - [Adab]  Ma\'alim fi Thariq Thalabil Ilm ', '2018-08-02 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-08-02', 'umum', 'Jadwal_00273.jpg', ''),
('Jadwal_00274', 'Masjd_00016', 'Ust_0031', 'Jns_0005', '[KAJIAN RUTIN KITAB] Masjid Imam Syafi\'i - Ustadz Edi Suarno, S. Sy Hafidzahullah - Ushul Tsalatsa | Syaikh Muhammad bin Abdul Wahhab rahimahullah', '2018-08-03 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan serta Kitabnya jika ada.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-08-03', 'umum', 'Jadwal_00274.jpg', ''),
('Jadwal_00275', 'Masjd_00029', 'Ust_0009', 'Jns_0008', '[KAJIAN RUTIN TEMATIK] Masjid Al Rai\'yah DPRD Sumsel - Ustadz Nurfitri Hadi, M. A Hafidzahullah - `Ummul Mukminin` (Khadijah bintu Khuwailid)', '2018-08-03 18:30:00', 'Maghrib', 'Jangan lupa bawa Mushaf Al - Qur\'an dan Buku Catatan.\r\n\r\n\"Barangsiapa menempuh jalan untuk mencari ilmu, Allah akan mempermudah baginya jalan menuju surga” (H.R Muslim)', '2018-08-03', 'umum', 'Jadwal_00275.jpg', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kajian`
--

CREATE TABLE `jenis_kajian` (
  `id_jenis_kajian` varchar(12) NOT NULL,
  `jenis_kajian` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_kajian`
--

INSERT INTO `jenis_kajian` (`id_jenis_kajian`, `jenis_kajian`) VALUES
('Jns_0001', 'Tabligh Akbar'),
('Jns_0002', 'Ramadhan'),
('Jns_0003', 'Idul Fitri'),
('Jns_0004', 'Idul Adha'),
('Jns_0005', 'Kitab'),
('Jns_0006', 'Tausiyah'),
('Jns_0007', 'Khutbah'),
('Jns_0008', 'Tematik'),
('Jns_0009', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kajian`
--

CREATE TABLE `kajian` (
  `id_kajian` varchar(12) NOT NULL,
  `id_jenis_kajian` varchar(12) NOT NULL,
  `judul_kajian` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kajian`
--

INSERT INTO `kajian` (`id_kajian`, `id_jenis_kajian`, `judul_kajian`, `deskripsi`) VALUES
('Kajn_00001', 'Jns_0001', 'Membangun Pribadi Muslim', ''),
('Kajn_00002', 'Jns_0002', 'Keutamaan Malam Qadar untuk Umat Islam', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` varchar(12) NOT NULL,
  `id_kota_kab` varchar(12) NOT NULL,
  `nama_kecamatan` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `id_kota_kab`, `nama_kecamatan`) VALUES
('Kect_00001', 'Kot_0001', 'Ilir Barat 1'),
('Kect_00002', 'Kot_0001', 'Ilir Barat 2'),
('Kect_00003', 'Kot_0001', 'Alang-alang Lebar'),
('Kect_00004', 'Kot_0001', 'Bukit Kecil'),
('Kect_00005', 'Kot_0001', 'Gandus'),
('Kect_00006', 'Kot_0001', 'Ilir Timur 1'),
('Kect_00007', 'Kot_0001', 'Ilir Timur 2'),
('Kect_00008', 'Kot_0003', 'Indralaya 1'),
('Kect_00009', 'Kot_0003', 'Indralaya 2'),
('Kect_00010', 'Kot_0003', 'Indralaya 3'),
('Kect_00011', 'Kot_0001', 'Kemuning'),
('Kect_00012', 'Kot_0001', 'Seberang Ulu 1'),
('Kect_00013', 'Kot_0001', 'Kalidoni'),
('Kect_00014', 'Kot_0001', 'Kertapati'),
('Kect_00015', 'Kot_0001', 'Plaju'),
('Kect_00016', 'Kot_0001', 'Sako'),
('Kect_00017', 'Kot_0001', 'Seberang Ulu 2'),
('Kect_00018', 'Kot_0001', 'Sematang Borang'),
('Kect_00019', 'Kot_0001', 'Sukarami');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id_kelurahan` varchar(12) NOT NULL,
  `id_kota_kab` varchar(12) NOT NULL,
  `id_kecamatan` varchar(12) NOT NULL,
  `nama_kelurahan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelurahan`
--

INSERT INTO `kelurahan` (`id_kelurahan`, `id_kota_kab`, `id_kecamatan`, `nama_kelurahan`) VALUES
('Kelr_00001', 'Kot_0001', 'Kect_00003', 'Karya Baru'),
('Kelr_00002', 'Kot_0001', 'Kect_00002', '27 Ilir'),
('Kelr_00003', 'Kot_0001', 'Kect_00002', '29 Ilir'),
('Kelr_00004', 'Kot_0001', 'Kect_00003', 'Talang Kelapa'),
('Kelr_00006', 'Kot_0001', 'Kect_00001', 'Bukit Baru'),
('Kelr_00007', 'Kot_0001', 'Kect_00002', '30 Ilir'),
('Kelr_00008', 'Kot_0003', 'Kect_00008', 'Indralaya Ujung'),
('Kelr_00009', 'Kot_0003', 'Kect_00009', 'Indralaya Pangkal'),
('Kelr_00010', 'Kot_0001', 'Kect_00002', '32 Ilir'),
('Kelr_00011', 'Kot_0001', 'Kect_00004', '19 Ilir'),
('Kelr_00012', 'Kot_0001', 'Kect_00012', '15 Ulu'),
('Kelr_00013', 'Kot_0001', 'Kect_00003', 'Srijaya'),
('Kelr_00014', 'Kot_0001', 'Kect_00003', 'Alang-alang Lebar'),
('Kelr_00015', 'Kot_0001', 'Kect_00004', '22 Ilir'),
('Kelr_00016', 'Kot_0001', 'Kect_00004', '23 Ilir'),
('Kelr_00017', 'Kot_0001', 'Kect_00004', '24 Ilir'),
('Kelr_00018', 'Kot_0001', 'Kect_00004', 'Talang Semut'),
('Kelr_00019', 'Kot_0001', 'Kect_00004', '26 Ilir'),
('Kelr_00020', 'Kot_0001', 'Kect_00005', '36 Ilir'),
('Kelr_00021', 'Kot_0001', 'Kect_00005', 'Karang Anyar'),
('Kelr_00022', 'Kot_0001', 'Kect_00005', 'Gandus'),
('Kelr_00023', 'Kot_0001', 'Kect_00005', 'Karang Jaya'),
('Kelr_00024', 'Kot_0001', 'Kect_00005', 'Pulo Kerto'),
('Kelr_00025', 'Kot_0001', 'Kect_00001', 'Demang Lebar Daun'),
('Kelr_00026', 'Kot_0001', 'Kect_00001', '26 Ilir D. I'),
('Kelr_00027', 'Kot_0001', 'Kect_00001', 'Lorok Pakjo'),
('Kelr_00028', 'Kot_0001', 'Kect_00001', 'Siring Agung'),
('Kelr_00029', 'Kot_0001', 'Kect_00001', 'Bukit Lama'),
('Kelr_00030', 'Kot_0001', 'Kect_00002', '28 Ilir'),
('Kelr_00031', 'Kot_0001', 'Kect_00002', 'Kemang Manis'),
('Kelr_00032', 'Kot_0001', 'Kect_00002', '35 Ilir'),
('Kelr_00033', 'Kot_0001', 'Kect_00006', '18 Ilir'),
('Kelr_00034', 'Kot_0001', 'Kect_00006', 'Sei Pangeran'),
('Kelr_00035', 'Kot_0001', 'Kect_00006', '16 Ilir'),
('Kelr_00036', 'Kot_0001', 'Kect_00006', '13 Ilir'),
('Kelr_00037', 'Kot_0001', 'Kect_00006', '15 Ilir'),
('Kelr_00038', 'Kot_0001', 'Kect_00006', '14 Ilir'),
('Kelr_00039', 'Kot_0001', 'Kect_00006', '17 Ilir'),
('Kelr_00040', 'Kot_0001', 'Kect_00001', 'Kepandean Baru'),
('Kelr_00041', 'Kot_0001', 'Kect_00006', '20 Ilir I'),
('Kelr_00042', 'Kot_0001', 'Kect_00006', '20 Ilir IV'),
('Kelr_00043', 'Kot_0001', 'Kect_00001', '20 Ilir III'),
('Kelr_00044', 'Kot_0001', 'Kect_00007', '10 Ilir'),
('Kelr_00045', 'Kot_0001', 'Kect_00007', 'Duku'),
('Kelr_00046', 'Kot_0001', 'Kect_00007', 'Kota Batu'),
('Kelr_00047', 'Kot_0001', 'Kect_00007', 'Lawang Kidul'),
('Kelr_00048', 'Kot_0001', 'Kect_00007', 'Sungai Buah'),
('Kelr_00049', 'Kot_0001', 'Kect_00007', '11 Ilir'),
('Kelr_00050', 'Kot_0001', 'Kect_00007', '9 Ilir'),
('Kelr_00051', 'Kot_0001', 'Kect_00007', '8 Ilir'),
('Kelr_00052', 'Kot_0001', 'Kect_00007', '5 Ilir'),
('Kelr_00053', 'Kot_0001', 'Kect_00007', '3 Ilir'),
('Kelr_00054', 'Kot_0001', 'Kect_00007', '1 Ilir'),
('Kelr_00055', 'Kot_0001', 'Kect_00007', '2 Ilir'),
('Kelr_00056', 'Kot_0001', 'Kect_00013', 'Bukit Sangkal'),
('Kelr_00057', 'Kot_0001', 'Kect_00013', 'Kalidoni'),
('Kelr_00058', 'Kot_0001', 'Kect_00013', 'Sei Lais'),
('Kelr_00059', 'Kot_0001', 'Kect_00013', 'Sei Selayur'),
('Kelr_00060', 'Kot_0001', 'Kect_00013', 'Sei Selincah'),
('Kelr_00061', 'Kot_0001', 'Kect_00011', '20 Ilir II'),
('Kelr_00062', 'Kot_0001', 'Kect_00011', 'Ario Kemuning'),
('Kelr_00063', 'Kot_0001', 'Kect_00011', 'Pahlawan'),
('Kelr_00064', 'Kot_0001', 'Kect_00011', 'Pipa Reja'),
('Kelr_00065', 'Kot_0001', 'Kect_00011', 'Sekip Jaya'),
('Kelr_00066', 'Kot_0001', 'Kect_00011', 'Talang Aman'),
('Kelr_00067', 'Kot_0001', 'Kect_00014', 'Kemang Agung'),
('Kelr_00068', 'Kot_0001', 'Kect_00014', 'Kemas Rindo'),
('Kelr_00069', 'Kot_0001', 'Kect_00014', 'Kertapati'),
('Kelr_00070', 'Kot_0001', 'Kect_00014', 'Ogan Baru'),
('Kelr_00071', 'Kot_0001', 'Kect_00014', 'Karya Jaya'),
('Kelr_00072', 'Kot_0001', 'Kect_00014', 'Keramasan'),
('Kelr_00073', 'Kot_0001', 'Kect_00015', 'Plaju Ulu'),
('Kelr_00074', 'Kot_0001', 'Kect_00015', 'Plaju Darat'),
('Kelr_00075', 'Kot_0001', 'Kect_00015', 'Bagus Kuning'),
('Kelr_00076', 'Kot_0001', 'Kect_00015', 'Komperta'),
('Kelr_00077', 'Kot_0001', 'Kect_00015', 'Plaju Ilir'),
('Kelr_00078', 'Kot_0001', 'Kect_00015', 'Talang'),
('Kelr_00079', 'Kot_0001', 'Kect_00015', 'Talang Putri'),
('Kelr_00080', 'Kot_0001', 'Kect_00016', 'Sialang'),
('Kelr_00081', 'Kot_0001', 'Kect_00016', 'Sako'),
('Kelr_00082', 'Kot_0001', 'Kect_00016', 'Sako Baru'),
('Kelr_00083', 'Kot_0001', 'Kect_00016', 'Sukamaju'),
('Kelr_00084', 'Kot_0001', 'Kect_00012', '9/10 Ulu'),
('Kelr_00087', 'Kot_0001', 'Kect_00012', 'Tuang Kentang'),
('Kelr_00086', 'Kot_0001', 'Kect_00012', 'Silaberanti'),
('Kelr_00088', 'Kot_0001', 'Kect_00012', '8 Ulu'),
('Kelr_00089', 'Kot_0001', 'Kect_00012', '7 Ulu'),
('Kelr_00090', 'Kot_0001', 'Kect_00012', '5 Ulu'),
('Kelr_00091', 'Kot_0001', 'Kect_00012', '3-4 Ulu'),
('Kelr_00092', 'Kot_0001', 'Kect_00012', '1 Ulu'),
('Kelr_00093', 'Kot_0001', 'Kect_00012', '2 Ulu'),
('Kelr_00094', 'Kot_0001', 'Kect_00017', 'Sentosa'),
('Kelr_00095', 'Kot_0001', 'Kect_00017', '12 Ulu'),
('Kelr_00096', 'Kot_0001', 'Kect_00017', '13 Ulu'),
('Kelr_00097', 'Kot_0001', 'Kect_00017', '14 Ulu'),
('Kelr_00098', 'Kot_0001', 'Kect_00017', 'Tangga Takat'),
('Kelr_00099', 'Kot_0001', 'Kect_00017', '16 Ulu'),
('Kelr_00100', 'Kot_0001', 'Kect_00017', '11 Ulu'),
('Kelr_00101', 'Kot_0001', 'Kect_00018', 'Karya Mulya'),
('Kelr_00102', 'Kot_0001', 'Kect_00018', 'Lebung Gajah'),
('Kelr_00103', 'Kot_0001', 'Kect_00018', 'Suka Mulya'),
('Kelr_00104', 'Kot_0001', 'Kect_00018', 'Srimulya'),
('Kelr_00105', 'Kot_0001', 'Kect_00019', 'Jambe'),
('Kelr_00106', 'Kot_0001', 'Kect_00019', 'Kebun Bunga'),
('Kelr_00107', 'Kot_0001', 'Kect_00019', 'Suka Bangun'),
('Kelr_00108', 'Kot_0001', 'Kect_00019', 'Suka Jaya'),
('Kelr_00109', 'Kot_0001', 'Kect_00019', 'Sukodadi'),
('Kelr_00110', 'Kot_0001', 'Kect_00019', 'Sukarami'),
('Kelr_00111', 'Kot_0001', 'Kect_00019', 'Talang Betutu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirhadir`
--

CREATE TABLE `konfirhadir` (
  `id_konfir` varchar(12) NOT NULL,
  `id_user` varchar(12) DEFAULT NULL,
  `id_jadwal` varchar(12) NOT NULL,
  `konfirmasi` enum('Insya Allah','Tidak') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirhadir`
--

INSERT INTO `konfirhadir` (`id_konfir`, `id_user`, `id_jadwal`, `konfirmasi`) VALUES
('Konf_00025', '201804100001', 'Jadwal_00056', 'Insya Allah'),
('Konf_00026', '201804110001', 'Jadwal_00059', 'Tidak'),
('Konf_00027', '201804110016', 'Jadwal_00059', 'Insya Allah'),
('Konf_00028', '201804120001', 'Jadwal_00061', 'Insya Allah'),
('Konf_00029', '201804120001', 'Jadwal_00059', 'Insya Allah'),
('Konf_00030', '201804120004', 'Jadwal_00064', 'Insya Allah'),
('Konf_00031', '201804110020', 'Jadwal_00065', 'Tidak'),
('Konf_00032', '201804130009', 'Jadwal_00070', 'Tidak'),
('Konf_00033', '201804130005', 'Jadwal_00070', 'Insya Allah'),
('Konf_00015', '201803290002', 'Jadwal_00040', 'Insya Allah'),
('Konf_00016', '201803290002', 'Jadwal_00039', 'Tidak'),
('Konf_00017', '201803280001', 'Jadwal_00043', 'Insya Allah'),
('Konf_00018', '201803280001', 'Jadwal_00041', 'Insya Allah'),
('Konf_00019', '201803280001', 'Jadwal_00042', 'Insya Allah'),
('Konf_00020', '201804030003', 'Jadwal_00047', 'Insya Allah'),
('Konf_00021', '201803140001', 'Jadwal_00047', 'Insya Allah'),
('Konf_00022', '201804060001', 'Jadwal_00044', 'Insya Allah'),
('Konf_00023', '201804040001', 'Jadwal_00051', 'Insya Allah'),
('Konf_00024', '201803140001', 'Jadwal_00051', 'Insya Allah'),
('Konf_00034', '201804130013', 'Jadwal_00070', 'Tidak'),
('Konf_00035', '201804130013', 'Jadwal_00069', 'Tidak'),
('Konf_00036', '201804130013', 'Jadwal_00068', 'Tidak'),
('Konf_00037', '201804130013', 'Jadwal_00067', 'Tidak'),
('Konf_00038', '201804140001', 'Jadwal_00071', 'Insya Allah'),
('Konf_00039', '201804120003', 'Jadwal_00079', 'Insya Allah'),
('Konf_00040', '201804180003', 'Jadwal_00090', 'Tidak'),
('Konf_00041', '201804180004', 'Jadwal_00089', 'Insya Allah'),
('Konf_00042', '201804180004', 'Jadwal_00090', 'Tidak'),
('Konf_00043', '201804200001', 'Jadwal_00098', 'Insya Allah'),
('Konf_00044', '201804130002', 'Jadwal_00103', 'Insya Allah'),
('Konf_00045', '201804260001', 'Jadwal_00121', 'Tidak'),
('Konf_00046', '201804260001', 'Jadwal_00120', 'Tidak'),
('Konf_00047', '201803070003', 'Jadwal_00125', 'Insya Allah'),
('Konf_00048', '201803070003', 'Jadwal_00126', 'Insya Allah'),
('Konf_00049', '201803070003', 'Jadwal_00124', 'Insya Allah'),
('Konf_00050', '201803140001', 'Jadwal_00131', 'Insya Allah'),
('Konf_00051', '201804280003', 'Jadwal_00131', 'Insya Allah'),
('Konf_00052', '201804300001', 'Jadwal_00141', 'Tidak'),
('Konf_00053', '201803070003', 'Jadwal_00148', 'Insya Allah'),
('Konf_00054', '201803070003', 'Jadwal_00146', 'Insya Allah'),
('Konf_00055', '201803070003', 'Jadwal_00145', 'Insya Allah'),
('Konf_00056', '201804300001', 'Jadwal_00147', 'Tidak'),
('Konf_00057', '201803070003', 'Jadwal_00157', 'Insya Allah'),
('Konf_00058', '201803070003', 'Jadwal_00158', 'Tidak'),
('Konf_00059', '201804040002', 'Jadwal_00163', 'Insya Allah'),
('Konf_00060', '201803140001', 'Jadwal_00169', 'Insya Allah'),
('Konf_00061', '201805050001', 'Jadwal_00176', 'Tidak'),
('Konf_00062', '201804100001', 'Jadwal_00153', 'Insya Allah'),
('Konf_00063', '201805080001', 'Jadwal_00185', 'Insya Allah'),
('Konf_00064', '201805200001', 'Jadwal_00197', 'Tidak'),
('Konf_00065', '201804270001', 'Jadwal_00198', 'Insya Allah'),
('Konf_00066', '201804300001', 'Jadwal_00199', 'Insya Allah'),
('Konf_00067', '201805240002', 'Jadwal_00199', 'Insya Allah'),
('Konf_00068', '201805250001', 'Jadwal_00201', 'Tidak'),
('Konf_00069', '201805250001', 'Jadwal_00202', 'Insya Allah'),
('Konf_00070', '201804130008', 'Jadwal_00202', 'Insya Allah'),
('Konf_00071', '201805250001', 'Jadwal_00209', 'Insya Allah'),
('Konf_00072', '201804270001', 'Jadwal_00212', 'Insya Allah'),
('Konf_00073', '201804100001', 'Jadwal_00212', 'Insya Allah'),
('Konf_00074', '201804100001', 'Jadwal_00214', 'Insya Allah'),
('Konf_00075', '201806070001', 'Jadwal_00218', 'Insya Allah'),
('Konf_00076', '201806250001', 'Jadwal_00217', 'Tidak'),
('Konf_00077', '201805240001', 'Jadwal_00220', 'Insya Allah'),
('Konf_00078', '201804120004', 'Jadwal_00220', 'Insya Allah'),
('Konf_00079', '201804120004', 'Jadwal_00217', 'Tidak'),
('Konf_00080', '201807060001', 'Jadwal_00221', 'Tidak'),
('Konf_00081', '201807080004', 'Jadwal_00224', 'Tidak'),
('Konf_00082', '201807080003', 'Jadwal_00227', 'Insya Allah'),
('Konf_00083', '201804270001', 'Jadwal_00228', 'Insya Allah'),
('Konf_00084', '201807130001', 'Jadwal_00228', 'Insya Allah'),
('Konf_00085', '201807130001', 'Jadwal_00223', 'Insya Allah'),
('Konf_00086', '201807130001', 'Jadwal_00221', 'Insya Allah'),
('Konf_00087', '201807080003', 'Jadwal_00229', 'Insya Allah'),
('Konf_00088', '201804270001', 'Jadwal_00229', 'Insya Allah'),
('Konf_00089', '201807200001', 'Jadwal_00242', 'Insya Allah'),
('Konf_00090', '201807200002', 'Jadwal_00242', 'Insya Allah'),
('Konf_00091', '201805250001', 'Jadwal_00249', 'Insya Allah'),
('Konf_00092', '201805240001', 'Jadwal_00249', 'Tidak'),
('Konf_00093', '201807260001', 'Jadwal_00256', 'Insya Allah'),
('Konf_00094', '201804110024', 'Jadwal_00258', 'Insya Allah'),
('Konf_00095', '201807040002', 'Jadwal_00269', 'Insya Allah'),
('Konf_00096', '201808030001', 'Jadwal_00275', 'Tidak'),
('Konf_00097', '201804130008', 'Jadwal_00273', 'Tidak'),
('Konf_00098', '201807070001', 'Jadwal_00275', 'Tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota_kab`
--

CREATE TABLE `kota_kab` (
  `id_kota_kab` varchar(12) NOT NULL,
  `nama_kota_kab` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota_kab`
--

INSERT INTO `kota_kab` (`id_kota_kab`, `nama_kota_kab`) VALUES
('Kot_0001', 'Palembang'),
('Kot_0002', 'Prabumulih'),
('Kot_0003', 'Indralaya'),
('Kot_0004', 'Linggau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masjid`
--

CREATE TABLE `masjid` (
  `id_masjid` varchar(12) NOT NULL,
  `nama_masjid` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `id_kota_kab` varchar(12) NOT NULL,
  `id_kecamatan` varchar(12) NOT NULL,
  `id_kelurahan` varchar(12) NOT NULL,
  `longitude` varchar(300) NOT NULL,
  `latitude` varchar(300) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `masjid`
--

INSERT INTO `masjid` (`id_masjid`, `nama_masjid`, `alamat`, `id_kota_kab`, `id_kecamatan`, `id_kelurahan`, `longitude`, `latitude`, `deskripsi`, `gambar`) VALUES
('Masjd_00001', 'Nurus Saadah', 'Jl Ki Gede Ing Suro', 'Kot_0001', 'Kect_00002', 'Kelr_00010', '104.750265', '-2.999693', 'Masjid Suro Palembang', 'Masjd_00003.JPG'),
('Masjd_00032', 'Masjid Al Hidayah', 'Jl. Lunjuk Jaya, samping kiri Universitas Sriwijaya, Bukit', 'Kot_0001', '', '', '', '', '', ''),
('Masjd_00003', 'Masjid Darul Jannah', 'Jl. Prof Zainal', 'Kot_0001', '', '', '104.748415', '-2.961434', 'Masjid Darul Jannah', 'Masjd_000031.JPG'),
('Masjd_00005', 'Masjid Agung Palembang', 'Jl. Jend. Sudirman', 'Kot_0001', 'Kect_00004', 'Kelr_00011', '104.760282', '-2.987951', 'Masjid Agung Palembang', 'Masjd_00005.jpg'),
('Masjd_00033', 'Musalla Darussalam', 'Jl. May Zen Lrg. Cendana, depan Bank Mandiri PT. Pusri', '', '', '', '', '', '', ''),
('Masjd_00006', 'Masjid Besar Al Ra\'iyah', 'Komplek DPRD Provinsi Sumsel, Jalan POM 9 Kampus, Lorok Pakjo, Ilir Barat I, Palembang City, South Sumatra 30137', 'Kot_0001', 'Kect_00001', 'Kelr_00006', '104.743802', '-2.979336', 'Masjid Komplek DPRD', 'Masjd_00006.jpg'),
('Masjd_00007', 'Masjid Chengho Palembang', '15 Ulu, Seberang Ulu I, Kota Palembang, Sumatera Selatan 3026', 'Kot_0001', 'Kect_00012', 'Kelr_00012', '104.780071', '-3.024451', 'Masjid Chengho Palembang', 'Masjd_00007.jpg'),
('Masjd_00009', 'Masjid Ar Rahman', 'Jl. Harapan Jaya, Kalidoni, Kota Palembang, Sumatera Selatan 30161, Indonesia', 'Kot_0001', '', '', '104.806227', '-2.960448', '', ''),
('Masjd_00017', 'Masjid Al Qobah Pusri', 'Komplek PT Pusri', '', '', '', '104.799779', '-2.974613', '', ''),
('Masjd_00011', 'Masjid Annur', 'Palembang Square Extantion Mall', 'Kot_0001', '', '', '104.742021', '-2.975993', '', ''),
('Masjd_00013', 'Masjid Bakti Palembang', 'Jl.Sukabakti, Seberang Graha Sumeks, dekat Puntikayu, Km.6 Palembang', 'Kot_0001', '', '', '104.729342', '-2.939609', '', ''),
('Masjd_00014', 'Faza Islamic School', 'Jl. Sapta Marga Ruko Andalas Blok 075 - Kalidoni', 'Kot_0001', '', '', '104.777040', '-2.941360', '', ''),
('Masjd_00015', 'Masjid Al Furqon', '8 Ilir, Ilir Tim. II, Kota Palembang, Sumatera Selatan 30164', 'Kot_0001', '', '', '104.769196', '-2.921889', '', ''),
('Masjd_00016', 'Masjid Imam Syafi\'i', 'Jl. Ki Anwar Mangku, Lr. Sikam, RT. 17, RW.05, Seberang Ulu, Kel. Sentosa, Plaju, Palembang', 'Kot_0001', '', '', '104.797046', '-2.998666', '', ''),
('Masjd_00031', 'Masjid Jabar Nur', 'Jl. Seruni, belakang SD N 8, belakang Bukit Siguntang, Bukit Besar', 'Kot_0001', '', '', '-2.997173', '104.725161', '', ''),
('Masjd_00021', 'Masjid Al-Hijrah', 'Jl. Sukabangun I, Suka Bangun, Sukarami, Kota Palembang, Sumatera Selatan 30151', 'Kot_0001', 'Kect_00019', 'Kelr_00107', '104.736403', '-2.942608', '', ''),
('Masjd_00022', 'Masjid Al Huda', 'JL. POM IX Kampus PLM ', 'Kot_0001', '', '', '104.743802', '-2.979336', '', ''),
('Masjd_00023', 'Masjid Darul Ridhwan Komperta Palembang', 'JL. MASJID RT.13 KOMPERTA PLAJU', 'Kot_0001', '', '', '104.821831', '-3.006076', 'Masjid Darul Ridhwan Komperta Palembang', ''),
('Masjd_00024', 'Masjid Firqotun Najiyah', 'Perumahan Pondok Palem Indah, dekat Grant City, Talang Kelapa, Alang-Alang Lebar', 'Kot_0001', '', '', '104.683048', '-2.944592', '', ''),
('Masjd_00025', 'Masjid Sulaiman Al-Kuraida', 'Ponpes Zaadul Ma\'ad, Jl. Padat Karya, Lrg. Melati, Sugiwaras, Talang Jambe', '', '', '', '104.703601', '-2.881193', '', ''),
('Masjd_00027', 'Musalla Darussalam', ' Jl. May Zen, Lrg. Cendana, depan Bank Mandiri PT. Pusri', '', '', '', '104.734308', '-2.918810', '', ''),
('Masjd_00030', 'Rumah Limas', 'Jl. Demang Lebar Daun depan RS. Bunda Palembang', 'Kot_0001', '', '', '104.733887', '-2.967759', '', ''),
('Masjd_00034', 'Masjid As-Sudays', 'Jl. Lintas Barat, Sukabangun II, Sukajaya, KM. 6', '', '', '', '-2.933125', '104.732426', '', ''),
('Masjd_00029', 'Masjid Al Ra\'iyah DPRD Sumsel', 'Komplek DPRD Provinsi Sumsel, Jalan POM 9 Kampus, Lorok Pakjo, Ilir Barat I, Palembang.', '', '', '', '104.743802', '-2.979336 ', '', ''),
('Masjd_00035', 'Masjid Ar Razzaq', 'Jalan Dokter Hakim, Sungai Pangeran, Ilir Tim. I, Kota Palembang, Sumatera Selatan 30114', 'Kot_0001', 'Kect_00006', 'Kelr_00034', '-2.973622', '104.751074', '', ''),
('Masjd_00036', 'Masjid Ar - Rahmah 2', 'Green Forest Residence, Jl. Sulthan Mas Mansyur, Bukit Lama', 'Kot_0001', 'Kect_00002', '', '-3.001238', '104.733807', '', ''),
('Masjd_00037', 'Kediaman Ustadz Aidil', 'Supersemar, samping gedung Graha 66, Angkatan 66', '', '', '', '', '', '', ''),
('Masjd_00038', 'Masjid Darul Asykar', 'Kompleks Perumdam, Jl. R. A Abusamah, simpang 5', '', '', '', '', '', '', ''),
('Masjd_00039', 'Musalla Nurul Iman', 'Jl. Kol. Atmo / Jl. Jendral Sudirman, Belakang Gramedia.', 'Kot_0001', '', '', '', '', '', ''),
('Masjd_00040', 'Masjid Nur Hayunah', 'Komplek Bandara Residence Palembang', '', '', '', '', '', '', ''),
('Masjd_00041', 'Masjid Darul Muttaqin', 'Komp. Bagus Kuning Plaju', '', '', '', '', '', '', ''),
('Masjd_00042', 'Masjid At-Taqwa Palembang', 'JL Telaga, Ilir Barat II Palembang Sumatera Selatan', 'Kot_0001', '', '', '-2.988581', '104.743356', '', ''),
('Masjd_00043', 'Masjid Al - Aqobah I PT PUSRI PALEMBANG', 'PT Pusri, Jl. Bayam, Sei Selayur, Kalidoni, Kota Palembang, Sumatera Selatan 30118', 'Kot_0001', 'Kect_00013', '', '-2.974613', '104.799779', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` varchar(12) NOT NULL,
  `nama_slider` varchar(100) NOT NULL,
  `gambar_slider` varchar(255) NOT NULL,
  `ket_slider` text NOT NULL,
  `tipe` enum('hompage','depan') NOT NULL,
  `status_slider` enum('on','off') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `id_token` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `email`, `password`, `jk`, `no_hp`, `status`, `id_token`) VALUES
('201803140002', 'Widi', 'Kancil', 'Wahyuadii516@gmail.com', 'ce561e8e3db3a99aed8a61f244516c6d', 'P', '081224925681', 'Y', 'MjAxODAzMTQwMDAy.MjAxODAzMTQxMDQxNDc='),
('201803140001', 'Widi', 'Kancil', 'Wahyuadii516@gmail.com', 'f936e6010fec57ff2f73e9e97cf98b55', 'L', '081224925681', 'Y', 'MjAxODAzMTQwMDAx.MjAxODA2MDcxNDM1MjA='),
('201804110001', 'Muhammad Jodi Pratama', 'Palembang', 'mjp.jodi@gmail.com', '0725ef3f25cee9c56673515d8f75772a', 'L', '082182511825', 'Y', 'MjAxODA0MTEwMDAx.MjAxODA0MjMwNDAyMzc='),
('201804030002', 'Test', 'Test', 'test@test.com', 'fcea920f7412b5da7be0cf42b8c93759', 'L', '12345', 'Y', ''),
('201804030001', 'Azhary Arliansyah', 'Gang Lampung 1', 'arliansyah_azhary@yahoo.com', '985fabf8f96dc1c4c306341031569937', 'L', '12345', 'Y', 'MjAxODA0MDMwMDAx.MjAxODA2MDcxNDU4Mzg='),
('201803070003', 'Adi', 'Jalan kancil putih', 'marningcurup@gmail.com', 'e172dd95f4feb21412a692e73929961e', 'L', '085268500109', 'Y', 'MjAxODAzMDcwMDAz.MjAxOTAyMjYxMzI5MDY='),
('201803070004', 'Wahyu', 'Kancil', 'Wahyuadii516@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'L', '081224925681', 'Y', 'MjAxODAzMDcwMDA0.MjAxODAzMDcxODExMzQ='),
('201803070005', 'M. Wahid Alqorni', 'Jl. Ki Gede Ing Suro Lrg. Pahlawan Palembang', 'idunalqorni@gmail.com', 'e172dd95f4feb21412a692e73929961e', 'L', '08991334254', 'Y', 'MjAxODAzMDcwMDA1.MjAxODA1MjUwOTQwMzk='),
('201803070002', 'Bxbbxx', 'Bxhxhbx', 'Bxbbxbdhdhhhd', '47a1c81581d55e088e82c93ee28b9257', 'L', 'Gxgxggx', 'Y', ''),
('201804100001', 'Ibnu Ridwan AS', 'Jl. Syakyakirti Lr. Lumajang RT. 35 RW. 08 Kel. Karang Anyar Kec. Gandus Palembang', 'ahmadjehansoulthany_ptmbs@yahoo.com', 'fb18ecfe7389a0322c1c9bd8a4c72166', 'L', '082183680685', 'Y', 'MjAxODA0MTAwMDAx.MjAxODA3MTcxNzA3MTc='),
('201803280001', 'Adi wijaya', 'Kancil putih', 'marningcurup@gmail.com', 'a8e52217c48d055fb98e2732c587d056', 'P', '085268500', 'Y', 'MjAxODAzMjgwMDAx.MjAxODA0MDMxMzA0MDA='),
('201803280002', 'Haura', 'Kancil coklat', 'marningcurup@gmail.com', 'a8e52217c48d055fb98e2732c587d056', 'P', '085268500', 'Y', ''),
('201803290001', 'SAID ABU SYFA', 'komplek Angkasa Pura 2, Tangerang', 'kotaksurat.imam@gmail.com', 'e628f534fd11ce3c5e19610a749b4e94', 'P', '081278700330', 'Y', 'MjAxODAzMjkwMDAx.MjAxODAzMjkyMDEyNTg='),
('201803290002', 'Ummah haaqa', 'Lorong rusa, kancil putih', 'Sancahijau@gmail.com', '1aa2cf4ccf78b6bd39121c0d1b75e087', 'P', '085368777883', 'Y', 'MjAxODAzMjkwMDAy.MjAxODA2MjYyMDA5MDQ='),
('201803300001', 'Jhon', 'Bukit besar', '1233@eee', '202cb962ac59075b964b07152d234b70', 'P', 'Ewww', 'Y', 'MjAxODAzMzAwMDAx.MjAxODAzMzAwNzE5Mjc='),
('201804030003', 'Hendry Ibrahiem', 'Kebon palem e1 plaju', 'henryesatria@gmail.com', '149eae1377331e421ea34df6fc288ec1', 'L', '081927772009', 'Y', 'MjAxODA0MDMwMDAz.MjAxODA0MDQxMDUwMDg='),
('201804040001', 'Jemi', 'Jalan Tanjung Barangan Lorong Temiyang 8', 'jemirobinson@ymail.com', 'd4989c694e79d12ddf6efd575f90e040', 'L', '081371921262', 'Y', 'MjAxODA0MDQwMDAx.MjAxODA0MDcwNzM0Mzk='),
('201804040002', 'Nyayu diya', 'Jl.super semar', 'uminyayu@gmail.com', 'a603f09810a488d50b84b43cf2ef7b7f', 'P', '0895339081956', 'Y', 'MjAxODA0MDQwMDAy.MjAxODA3MjUxODUyMzI='),
('201804060001', 'Iskandar', 'Palembang', 'iskandarsyafaruddin@gmail.com', '6c7d4a9f34411bc483417776912a43fd', 'L', '082175431112', 'Y', 'MjAxODA0MDYwMDAx.MjAxODA0MTcyMTQwNTY='),
('201804070001', 'Alpiandi Ibrahim', 'Jln banten plaju', 'alpiandiibrahim@gmail.com', '1a71b8beccde69ee1865a946d0383e82', 'L', '082374670269', 'Y', 'MjAxODA0MDcwMDAx.MjAxODA0MDcyMjU0MDc='),
('201804110002', 'Restie Amelia', 'Indralaya Utara, Ogan Ilir', 'restongmamal@gmai.com', '25ac97f2108856394cd870fcc28d4c1f', 'P', '085709317248', 'Y', ''),
('201804110003', 'Restie Amelia', 'Indralaya Utara, Ogan Ilir', 'restongmamal@gmail.com', '3d2502c1764868ec20da128267f74562', 'P', '085709317248', 'Y', 'MjAxODA0MTEwMDAz.MjAxODA0MTExNjE3NTM='),
('201804110004', 'Wiwin Indah Sari', 'Jl.Lettu H.A Karim Kadir Perumahan PNS Pemkot Blok BM 13 Gandus Palembang', 'wiwinindahsari20@gmail.com', '34e2dae9a623a1b0e0e4ea9b62023135', 'P', '089687602439', 'Y', 'MjAxODA0MTEwMDA0.MjAxODA0MTMxNDU2NDQ='),
('201804110005', 'Ahmad Fauzan', 'Jl. MP Mangkunegara Lr. Sukatani 2 No.28', 'ahmdfauznn@gmail.com', '9f1ab4a76d28b1209c6e147a09a53b7b', 'L', '082380614751', 'Y', 'MjAxODA0MTEwMDA1.MjAxODA3MjExNDUyMjI='),
('201804110006', 'Gustra Nugraha', 'jln jogja no 4012', 'haramaintour.palembang@gmail.com', '3983b568bc8ec7cc2e7575f26d6d92d8', 'L', '081271030600', 'Y', 'MjAxODA0MTEwMDA2.MjAxODA2MDYwNTMzMDM='),
('201804110007', 'Andika Pramadita', 'Jl. Prof. Dr. Emil Salim No. 14B', 'andhika.pramadita@yahoo.co.id', 'd78d71c00c1e9ad8d021d8d2af5fee23', 'L', '085366621834', 'Y', 'MjAxODA0MTEwMDA3.MjAxODA1MDEwNjA1NDE='),
('201804110008', 'Ikbal', 'Jln aiptu a wahab rt 03', 'ikbalbeck13@gmail.com', '03f0602c1c7866a26c8929dc3d93a947', 'L', '081929425824', 'Y', 'MjAxODA0MTEwMDA4.MjAxODA0MTkxNTIzNDc='),
('201804110009', 'Kidon rezeki al pemulutanii', 'Desa pemulutan ilir dusun 11', 'kidoo82@gmail.com', 'ee2f47cfa500443b2b71d8d8aa89d65f', 'L', '082154794656', 'Y', ''),
('201804110010', 'Alensa', 'Jl. Torpedo 91 sekip ujung palembang', 'alensaae101@gmail.com', '04ec668a4f8a9ebec167ba9f016f1ca1', 'P', '082278821812', 'Y', 'MjAxODA0MTEwMDEw.MjAxODA2MDEwNjA0MjE='),
('201804110011', 'Deni Afandi', 'Jln.Tanjung api-api talang don-dong didekat Apotek K-24', 'd.afandi1306@gmail.com', '2d178881c068d9760b6982df80f6de7d', 'L', '081933326347', 'Y', 'MjAxODA0MTEwMDEx.MjAxODA0MTExNjUxMTE='),
('201804110012', 'Amrullah', 'Palembang', 'amrullah.solimin@gmail.com', '158f67bf260e69a997d3d706c68f7203', 'L', '082177170727', 'Y', 'MjAxODA0MTEwMDEy.MjAxODA0MTExNjU0MjU='),
('201804110013', 'Arif Rakhman', 'Jln. Lebak Murni ', 'arif.rakhman@pusri.co.id', '85bf5f84b50453d269c58328916c6ebf', 'L', '081929266703', 'Y', 'MjAxODA0MTEwMDEz.MjAxODA0MTExNzA0Mjg='),
('201804110014', 'Ummu saniyyah', 'Indralaya', 'ameysadilabara30@gmail.com', '307dec9d3377abcab06babae847c7fd6', 'P', '082278224512', 'Y', 'MjAxODA0MTEwMDE0.MjAxODA4MDMxNzU0MTU='),
('201804110015', 'Neiska nadha tiarani putri', 'Palembang', 'neiskanadha1@gmail.com', '294963375b6e66f2e5431760b42d7c02', 'P', '082177245743', 'Y', 'MjAxODA0MTEwMDE1.MjAxODA1MTMwODQzMTI='),
('201804110016', 'Derri supandi', 'Jl. Syakyakirti lrg. Kakap I No. 100 Palembang', 'derry.supandi@gmail.com', '8a30399f5d38ee0ef1eff2bbae4c5297', 'L', '081273248045', 'Y', 'MjAxODA0MTEwMDE2.MjAxODA0MTQwOTM3MzI='),
('201804110017', 'Wildarifa Aljuna Mawarni', 'Indralaya', 'wildarifa@gmail.com', '24d790136b3794ed8b5304a614575f28', 'P', '081366132971', 'Y', 'MjAxODA0MTEwMDE3.MjAxODA0MTExNzQwMzc='),
('201804110018', 'Hadi', 'Ogan ilir', 'tusno.hadi@gmail.com', 'dc98bbed324a23cf580c109937f5bb7b', 'L', '085375834088', 'Y', 'MjAxODA0MTEwMDE4.MjAxODA0MTExODUxMjU='),
('201804110019', 'Diah RMC', 'Perum bukit sejahtera', 'diahrosida2000@gmail.com', '4d61a8932396c9ca39ba7a1b00533dfc', 'P', '085266771253', 'Y', 'MjAxODA0MTEwMDE5.MjAxODA0MTIyMDQ0MjM='),
('201804110020', 'Alex sanjaya', 'Perumahan bukit sejahtera poligon blok u 1', 'radenabdulhamidsanjaya@gmail.com', '67a15963dfab425da39456f2c8e67473', 'L', '083177767736', 'Y', 'MjAxODA0MTEwMDIw.MjAxODA1MjExMzQwNDI='),
('201804110021', 'Eko prasetyo', 'Jl. Gotong royong 1 Purwodadi No. 022 RT 04 / RW 01 kecamatan sukarami kelurahan sukodadi km.12 Palembang', 'vhrasetyo@gmail.com', 'ea3b6e450ca0c990bc6cd150d663b667', 'L', '08980941410', 'Y', 'MjAxODA0MTEwMDIx.MjAxODA0MjIwODM4MjY='),
('201804110022', 'Jack John', 'Palembang', 'mr.jackjohn90@gmail.com', 'd86557dcba83c2c20b2bd70519a48956', 'L', '081278905087', 'Y', 'MjAxODA0MTEwMDIy.MjAxODA2MzAwNTIyMDA='),
('201804110023', 'MD Qushayyi F', 'Jln cindewelan lr kebon ', 'abangcinde1998@gmail.com', '1304f5c7bbf6cbe46ac87b4f41b3cda4', 'L', '085758805223', 'Y', ''),
('201804110024', 'Arinancy Zefrelly', 'Perumnas talang kelapa', 'relly0703@gmail.com', '77d5e0cc53f47e08418ea8166710d37b', 'L', '081366632281', 'Y', 'MjAxODA0MTEwMDI0.MjAxODExMjkxNzUzNTk='),
('201804110025', 'Nuraini', 'Indralaya', 'nainun001@gmail.com', '765a7910de649fbd7a90ad6c46c4dc05', 'P', '085269258527', 'Y', 'MjAxODA0MTEwMDI1.MjAxODA2MjUyMTU4MjY='),
('201804110026', 'Jun', 'Palembang', 'junaididigima@gmail.com', 'fa8dbeb3eec45e7d315b6781c77e2929', 'L', '085273833129', 'Y', 'MjAxODA0MTEwMDI2.MjAxODA0MzAwODUwMzk='),
('201804110027', 'Nuraini', 'Indralaya', 'nainun001@gmail.com', '765a7910de649fbd7a90ad6c46c4dc05', 'P', '085269258527', 'Y', ''),
('201804110028', 'Hanif Maghfur', 'Jl. Syakyakirti No 1037 karang anyar', 'hnifmaghfur@gmail.com', '32ddb99ec40a2c2b1a7bfe21fd10ff59', 'L', '081314646445', 'Y', 'MjAxODA0MTEwMDI4.MjAxODA1MTcxNjEwMjI='),
('201804120001', 'aliakbar', 'plaju 16 ulu plg', 'aliakbar75@gmail.com', '4100ec0f39cab8105a51e4f014092ceb', 'L', '081278045229', 'Y', 'MjAxODA0MTIwMDAx.MjAxODA0MjAwODM1NDg='),
('201804120002', 'Opry', 'Plaju,palembang', 'opry.opry@energibiz.com', 'd550f68938f3797930612105d03b568a', 'L', '081215874043', 'Y', 'MjAxODA0MTIwMDAy.MjAxODA0MTIxNzI0MTM='),
('201804120003', 'Verry', 'Palembang', 'gaptekpeople@yahoo.co.id', '18c6a866f38c8621bb4e21801fb323c1', 'L', '087764079009', 'Y', 'MjAxODA0MTIwMDAz.MjAxODA0MTUxODQ3MTE='),
('201804120004', 'Budi', 'Jalan', 'gileluh444@gmail.com', '87d55a041b00ab4e2dd576bf936693e0', 'L', '0888', 'Y', 'MjAxODA0MTIwMDA0.MjAxODA3MDUxODQ3MTU='),
('201804130001', 'Sya\'ban', 'Perumahan OPI jakabaring palembang', 'syabanm0@gmail.com', '5a72d308410a9e63239bd33a4a7d43f8', 'L', '081272321527', 'Y', 'MjAxODA0MTMwMDAx.MjAxODA0MTMwMDM1NDM='),
('201804130002', 'Muhammad Rizqi Alherli', 'Perumnas talang kelapa blok 6 rt 23 no 1019, Palembang', 'edogawa14.com@gmail.com', '3c12a5ea9d79255ba0f1fb35ad7ed674', 'L', '085709875680', 'Y', 'MjAxODA0MTMwMDAy.MjAxODA1MjIyMDMzMjc='),
('201804130003', 'Dita', 'Jl. Ariodillah Ilir Timur I Palembang', 'ditaekap99@gmail.com', 'd9455956d76d716329707951a8d1e10e', 'P', '082282171437', 'Y', 'MjAxODA0MTMwMDAz.MjAxODA1MDcxMTA3MDA='),
('201804130004', 'Budi', 'Palembang', 'bhudi89182@gmail.com', '468b9d72784edbd936c0b306a45d426b', 'L', '081273829726', 'Y', 'MjAxODA0MTMwMDA0.MjAxODA2MDExOTQ1Mzc='),
('201804130005', 'Amiruddin', 'Palembang', 'kedaiamirle04@gmail.com', 'a051724378264f0eac4a6a603e4cef71', 'L', '08127144894', 'Y', 'MjAxODA0MTMwMDA1.MjAxODA1MDQwNjI2MDM='),
('201804130006', 'Pilkel', 'Jl. Jaya Perum Griya Paras Jaya 1 Blok. E11 Plaju', 'pilkerrs@gmail.com', 'd67f20ee1d7fac65cdf67f6ed0409913', 'L', '082245401119', 'Y', 'MjAxODA0MTMwMDA2.MjAxODA1MDIxNjQ5NTc='),
('201804130007', 'Elvira Belinda', 'Kenten permai', 'vira.060797@gmail.com', '4021dd7c2ca8df867620b2ee393b2723', 'P', '081278819002', 'Y', 'MjAxODA0MTMwMDA3.MjAxODA1MjcyMzMyMzI='),
('201804130008', 'Muhammad Fadlillah', 'Komp kenten permai blok A3 no 4', 'fadildesu@yahoo.com', 'a7e34fb6fd2c424fe9f83063f9caf096', 'L', '081367651083', 'Y', 'MjAxODA0MTMwMDA4.MjAxODEwMTMwNTEyNDM='),
('201804130009', 'Ayu Winda Lestari', 'Indralaya', 'ayuwindalestari38@gmail.com', '292b963aaae535befdf89b14bbeafda7', 'P', '085211349897', 'Y', 'MjAxODA0MTMwMDA5.MjAxODA1MDkyMzA1MTc='),
('201804130010', 'Naura Nazifa', 'Jalan Ki Anwar Mangku Talang Karet II RT 40 RW 11 Kelurahan Sentosa Kecamatan Seberang Ulu ii Kabupaten Kota Palembang', 'nauranazifa123@gmail.com', '10c23705e46583b3d45c1e457114e630', 'P', '081929497486', 'Y', 'MjAxODA0MTMwMDEw.MjAxODA0MTMxNTUzNTk='),
('201804130011', 'Aria Pratama ', 'Lemabang ', 'ayik.perak@gmail.com', 'f19b5c4a2e280a3d19af0b7cdbbefa91', 'L', '08158923000 ', 'Y', 'MjAxODA0MTMwMDEx.MjAxODA0MjgyMzA1NTY='),
('201804130012', 'Zulkirom', 'Jalan Macan Lindungan No. 128 RT. 03/05 Palembang', 'zulkirom02@gmail.com', '29773a26d1b990a582c012db07ee19bf', 'L', '081274830681', 'Y', 'MjAxODA0MTMwMDEy.MjAxODA2MzAwNzU5NDg='),
('201804130013', 'ferdy', 'lorong keuangan III, Sukabangun  II', 'ferdy.andriansyah2004@gmail.com', '7a5f903f3717547a2550b65f87eeb6cd', 'L', '085227142004', 'Y', 'MjAxODA0MTMwMDEz.MjAxODA0MTcxNzUzNTA='),
('201804140001', 'bella nopiani', 'muara enim', 'bellanoviani14@gmail.com', '583e1b84012c4c7f9174ab5bf528cefb', 'P', '081271320480', 'Y', 'MjAxODA0MTQwMDAx.MjAxODA0MjMyMDIxMTk='),
('201804140002', 'Wahyudin', 'Jl.mawar lr.pandan talang ratu ujung. Palembang', 'wahyudinsidik00@gmail.com', '7175f052d8f684ed053be7a1923601fe', 'L', '085267912928', 'Y', 'MjAxODA0MTQwMDAy.MjAxODA0MTQwOTM4NDk='),
('201804140003', 'AGUS MARYADI', 'Jalan kasnariansyah palembang', 'agusmaryadikss@gmail.com', '443f1f5227ef2b56adc4bbaf950a0179', 'L', '08125124654', 'Y', 'MjAxODA0MTQwMDAz.MjAxODA1MjAwOTUxNDM='),
('201804140004', 'Nadya Ayu Satriani', 'Silaberanti, Seberang Ulu I', 'nadya.satriani@gmail.com', 'cb1bd696794a051c704f4e5c560a049c', 'P', '089673997117', 'Y', 'MjAxODA0MTQwMDA0.MjAxODA1MjEwNTQ1NDY='),
('201804140005', 'Ummu Wulan Nurindah Sari', 'Jl.Sei selan no 69 RT/RW 001/001 desa/kcamatan Siring Agung Ilir barat 1 kota palembang ', 'wajizahhalimafatin@gmail.com', '8787c9ac79935c12d59cb9e96e029bda', 'P', '0895706483216', 'Y', ''),
('201804150001', 'pietra jaya', 'perum pusri sako jalan pupuk 4', 'pietrajaya91@gmail.com', 'c629155d72853fe3a285658db481d369', 'L', '081373874478', 'Y', 'MjAxODA0MTUwMDAx.MjAxODA1MDExODE3MDY='),
('201804150002', 'Wulan Nurindah sari', 'Jl sei selan No 69 Siring agung ilir barat 1', 'wajizahhalimafatin@gmail.com', '759350fceb10e26938af521aa1353699', 'P', '0895706483216', 'Y', 'MjAxODA0MTUwMDAy.MjAxODA0MTUxMzI3MTE='),
('201804150003', 'Cahyo Bayu Subianto', 'Jln. Kebun bunga Lrg Tirta Mulya Rt 57 Rw 13 no 2095 kecamatan sukarami.', 'cahyobayu48@gmail.com', '7078ca805ced91a6a409123c0e0371f7', 'L', '083177414671', 'Y', 'MjAxODA0MTUwMDAz.MjAxODA0MTkxMTEwMzA='),
('201804160001', 'Ummu Hurairah', 'Indralaya', 'melsymarlina15@gmail.com', '2730739800aee5839d5f33d52eba198e', 'P', '089624929599', 'Y', 'MjAxODA0MTYwMDAx.MjAxODA0MTYxOTIyMjM='),
('201804170001', 'Angga  Arzandy Arsyaf', 'Km5 jalan sukawinatan lorong adiyaksa', 'angga123@gmail.com', '0016f7f080b0c9f393b628a1d46762fd', 'L', '089619949982', 'Y', 'MjAxODA0MTcwMDAx.MjAxODA1MjEwNDI2MjE='),
('201804170002', 'Reno Hasibuan', 'Palembang', 'Renohasibuan4@gmail.com', '4632960943422ddf527572ffe5c9eb1c', 'L', '085279700812', 'Y', 'MjAxODA0MTcwMDAy.MjAxODA0MTgwNTEzMDM='),
('201804180001', 'Emma Liana_Ummu Khadijah', 'Jalan Gotong Royong 4 kelurahan sukamaju kecamatan sako kuburan cina', 'caliphlia@yahoo.com', '449de48a5ebf424544d277cee2e5aa1c', 'P', ' 6281272443356', 'Y', 'MjAxODA0MTgwMDAx.MjAxODA0MjIwOTMyMDU='),
('201804180002', 'Kiagus Masjhon', 'Jln puncak sekuning lr swadaya', 'kgsmazjhon@rocketmail.com', '8cd70f97839785d29e4fd4863f794fe9', 'L', '085383972777', 'Y', 'MjAxODA0MTgwMDAy.MjAxODA0MTgxNTAxMjY='),
('201804180003', 'Meta Amida', 'Jl. Srijaya Negara Lr. Hasan AS', 'metaamida1@gmail.com', '0851fb264fd2f157447704c7b2da36fe', 'P', '081366470088', 'Y', 'MjAxODA0MTgwMDAz.MjAxODA4MDMxNzU4MDQ='),
('201804180004', 'Ardian Saputra ', 'Kertapati ', 'ardiansaputra44@gmail.com', '2eaca6ef8fb3b1e66f41bbc330f5ab15', 'L', '081367125676', 'Y', 'MjAxODA0MTgwMDA0.MjAxODA0MTgxODM0MDk='),
('201804200001', 'Muhammad Muchlis', 'Jalan dipo lorong pelita nomor 613 kertapati palembang', 'muchlism642@gmail.com', '74c733f5a554066f17614bdbb52938ed', 'L', '082186868940', 'Y', 'MjAxODA0MjAwMDAx.MjAxODA1MDMxMTQwMTc='),
('201804210001', 'cyndi khumairoh', 'jalan tunas muda,perumahan griya taman kencana blok b.8', 'cyndikhumairah@gmail.com', 'ddef2fa082541f841796ce59c5609b3a', 'P', '082175658631', 'Y', 'MjAxODA0MjEwMDAx.MjAxODA0MjExNjQ0MDk='),
('201804260001', 'Oktariandi', 'jl. ki merogan lr wijaya rt 36 rw 007 no2157 kemang agung kertapati palembang', 'oktariandi1010@gmail.com', '56528d3faee41156158fd70f86f89229', 'L', '082176801775', 'Y', 'MjAxODA0MjYwMDAx.MjAxODA3MTAxMzU4Mzk='),
('201804270001', 'Adi', 'Bukit', 'afriadi_s@yahoo.com', '839e9c1a49e7ebdeddf258630a89a2bc', 'L', '089649908378', 'Y', 'MjAxODA0MjcwMDAx.MjAxOTAyMDgyMzQ0NDg='),
('201804270002', 'Maulana', 'Komp. Sukarami Indah Blok D No. 16-300 ', 'ayiswizer86@gmail.com', 'efa82c28273e40e54268581de33b201b', 'L', '082182883788', 'Y', 'MjAxODA0MjcwMDAy.MjAxODA3MjEwNzE1Mzk='),
('201804280001', 'Iwan B Saputra', 'Sukodadi KM.12', 'iwan84saputra@gmail.com', '46dbd6a7c57761184a31f77e32d9aa64', 'L', '081927723457', 'Y', 'MjAxODA0MjgwMDAx.MjAxODExMTgxMTMyMTI='),
('201804280002', 'Rio Awallur Rizal', 'Jl. Kresna 1 blok j-9 No. 07', 'ryoballer97@gmail.com', '63131857288624cb8723df972faff890', 'L', '082272681657', 'Y', 'MjAxODA0MjgwMDAy.MjAxODA3MTAxNjUzMjg='),
('201804280003', 'Abuzikri', 'Jl. Sentosa lr. Pribadi no. 493 Plaju ', 'abidgrafis@gmail.com', 'ffa914c435c63b355a5ef3234b96c080', 'L', '081278555330', 'Y', 'MjAxODA0MjgwMDAz.MjAxODEwMjQxNTU4MTA='),
('201804300001', 'Roffyjoe', 'Jl pasundan kalidoni', 'roffyjoe@gmail.com', 'eed89d0988e611af67237dff90e44c5c', 'L', '081278348854', 'Y', 'MjAxODA0MzAwMDAx.MjAxODA2MDgxNDI4MTg='),
('201804300002', 'Alex sanjaya', 'Perum bukit sejahtera poligon U 1 bukit lama', 'radenabdulhamidsanjaya@gmail.com', '67a15963dfab425da39456f2c8e67473', 'L', '083177767736', 'Y', ''),
('201804300003', 'sunardi', 'km 16', 'soenardi034@yahoo.com', '766ac83d4e627a1ebe16648cee4e6161', 'L', '08127894349', 'Y', 'MjAxODA0MzAwMDAz.MjAxODA3MTkxNDUzMzE='),
('201805010001', 'Eka', 'Palembang', 'soerie.eka@gmail.com', 'd63b9b66a11e37ed841b2ce53a9b190a', 'L', '0817204063', 'Y', 'MjAxODA1MDEwMDAx.MjAxODA1MjYxMDQ3MTQ='),
('201805020001', 'Reno Nurcahyadi ', 'Jln depati hasyim tanjung aro pagaralam ', 'rnurcahyadi1996@gmail.com', 'e095d9255a8451b592c164cb47230fd5', 'L', '085767044321', 'Y', 'MjAxODA1MDIwMDAx.MjAxODA1MDMxNDM0MDk='),
('201805030001', 'Adien', 'Jalan betawi raya perumahan griya kencana indah', 'cunkring49@gmail.com', '37ba09375c309864d825b47d99110586', 'L', '081288008805', 'Y', 'MjAxODA1MDMwMDAx.MjAxODA3MDUyMTQ0Mjg='),
('201805030002', 'Agus Diman Syaputra', 'Jalan Kol. H. Burlian Lr. Peristiwa KM. 5 Palembang', 'agusds.17@gmail.com', '914eaaf2aa3fad331d49cd165f77139b', 'L', '081367781881', 'Y', 'MjAxODA1MDMwMDAy.MjAxODA1MDMwODE3Mjg='),
('201805030003', 'Dita', 'Jl. Pdam tirta musi no237 palembang', 'bagassariditaamalia@gmail.com', '44535796d05de4798a7c9488423bd7e4', 'P', '08996368905', 'Y', 'MjAxODA1MDMwMDAz.MjAxODA1MDMyMDI4Mjg='),
('201805030004', 'Wina Artika', 'Ma\'had Aljami\'ah UIN Raden Fatah Palembang', 'winaartika22@gmail.com', 'ee9604065c2dbbca1a678a7f969f5462', 'P', '082178187384', 'Y', 'MjAxODA1MDMwMDA0.MjAxODA3MTExNjAyNTA='),
('201805030005', 'Wina Artika', 'Ma\'had Aljami\'ah UIN Raden Fatah Palembang', 'winaartika22@gmail.com', 'ee9604065c2dbbca1a678a7f969f5462', 'P', '082178187384', 'Y', ''),
('201805050001', 'Abu An Nafii\'', 'Palembang', 'herrogama1420h@gmail.com', '0b25313888c462091a67dbacb78d39f3', 'L', '083178507366', 'N', 'MjAxODA1MDUwMDAx.MjAxODA1MTAxMjQ5NTk='),
('201805080001', 'Nurul setiawan', 'Jl taqwa desa Merah mata Balai makmur Lrg Gotong Royong RT. 06 Kec. Banyuasin', 'nurullsetiawan4@gmail.com', 'a477067fcbaba00d549878c16a8c6468', 'L', '0895631578491', 'Y', 'MjAxODA1MDgwMDAx.MjAxODA1MTMxMDUxNDg='),
('201805090001', 'YUDI MAHENDRA', 'Plaju', 'yudi_110@yahoo.co.id', '381629d1ab57a7477c1afd914227f200', 'L', '081273601062', 'Y', 'MjAxODA1MDkwMDAx.MjAxODA1MjkxNjE2NTQ='),
('201805100001', 'Muhammad al hafiz', 'Jalan lakitan 2 no 347 perumnas sako palembang', 'muhammadalhafiz39@gmail.com', 'a1536158cf8d8818ae9f3fe4de0af729', 'L', '089669237216', 'Y', 'MjAxODA1MTAwMDAx.MjAxODA1MTMwODQxMTA='),
('201805100002', 'Firdialamsyah', 'Jl. Teuku umar koba kabupaten bangka tengah provinsi kepulauan bangka belitung', 'firdialamsya@gmail.com', '87b4e674ea8cf03f62a53c50179f4269', 'L', '083185821459', 'Y', ''),
('201805100003', 'Muhammad diyan ', 'Jl macan lindungan lorong tunggal 5 no71', 'diyan.saputra11.ds@gmail.com', '47a39ff74c85a05d8295b548022d35dc', 'L', '082377500405', 'Y', ''),
('201805110001', 'Jemmi Elfayer Alfa Putra ', 'Jl. Lintas sumatera desa muara ', 'alfaputra873@gmail.com', '2273f6eda4c6e9c384f8a5fc39a06195', 'L', '082280619635 ', 'Y', 'MjAxODA1MTEwMDAx.MjAxODA1MjExMzU2MzM='),
('201805130001', 'Muhammad firli pratama', 'Jl bougenvile', 'drgfirli@gmail.com', 'f9b6873394b09a667a5203f06f93ae53', 'L', '087898322864', 'Y', 'MjAxODA1MTMwMDAx.MjAxODEwMzAxNTAzMzY='),
('201805130002', 'Juliantono', 'Jln. Irian Gg. Ternate No. 27 Rt. 09 Kel. Jawa Kanan SS Kec. Lubuklinggau Timur 2', 'djuliantono28@gmail.com', '717cb44845900e41f06af417b8a70f9e', 'L', '081377768767 ', 'Y', 'MjAxODA1MTMwMDAy.MjAxOTAxMDIxODE5MzA='),
('201805200001', 'Afriansyah', 'Palembang', 'afriansyah0909@gmail.com', '2d1d53f2b87f89afcd5aa71c1e134ac4', 'L', '082178876789', 'Y', 'MjAxODA1MjAwMDAx.MjAxODA5MjkxNTAwMDM='),
('201805230001', 'Monamanan', 'Tanjung raja ogan ilir sumatera selatan', 'monamanan5@gmail.com', '57d20ef0afc2b272560f38f36d2c3d2f', 'P', '085758034513', 'Y', 'MjAxODA1MjMwMDAx.MjAxODA2MDEwNjM5MDA='),
('201805240001', 'Dwi Prananda', 'Jl. AKBP H. Umar No.58 RT.001 RW.001 Kel. Aryo Kemuning Kec. Kemuning Palembang', 'dwiprananda2@gmail.com', 'ca2937fbc57404e01b0309c7d0d6d956', 'L', '085832026549', 'Y', 'MjAxODA1MjQwMDAx.MjAxODA3MjgxMjA2MDA='),
('201805240002', 'Bintu Fulan', 'Jalan.mayor zen', 'limahtwinbee08@gmail.com', '37b92c4f7a7d9c569ad92486b1774c1d', 'P', '0895631547009', 'Y', 'MjAxODA1MjQwMDAy.MjAxODA3MDYxODUyMTE='),
('201805250001', 'Mgs Muhammad Arief', 'Jl Jaya 7 Lr lematang', 'arief170299@gmail.com', 'e93c3f4abed297ee7baf295e54c8fa1f', 'L', '089602770718', 'Y', 'MjAxODA1MjUwMDAx.MjAxODA3MjMxNzI3MTE='),
('201805250002', 'Idil Fitriadi', 'Komp.graha damai lestari blok a6 lebak jaya3  jl.m.zen pusri palembang', 'idil.fitriadi@yahoo.co.id', 'b1c1139d15fb3f3d0a64b9acf8688f3c', 'L', '089633814882', 'Y', 'MjAxODA1MjUwMDAy.MjAxODA5MjcxMzM2MTc='),
('201805300001', 'Sonny Steven', 'Jln.Lematang 3 No 18 RT 31 RW 08 Kel Lebong Gajah Kec Sematang Borang', 'boyson19@gmail.com', '4007201386c6929a40deb4fb5f4a06f9', 'L', '085295772187', 'Y', 'MjAxODA1MzAwMDAx.MjAxODA1MzEyMjE3MzU='),
('201805310001', 'Rafli Prayoga', 'Sekio bendung palembang', 'rflipryga29@gmail.com', 'ee5aed56d7c80df50b000db575b2e8b2', 'L', '08561827821', 'Y', 'MjAxODA1MzEwMDAx.MjAxODA1MzEyMDUwMzQ='),
('201806020001', 'Jean', 'Palembang', 'jeannesavitri@gmail.com', '510c75f235a9bab936e937fe688957b9', 'P', '085783416898', 'Y', 'MjAxODA2MDIwMDAx.MjAxODA2MDIwNTMzMDc='),
('201806070001', 'Sandika Wijaya', 'Jl. Palembang Betung, Km 18. Banyuasin-Sumsel.', 'sandikawijaya15@gmail.com', 'f5d430db9e604e4dd263f317768c81b8', 'L', '081368066330', 'Y', 'MjAxODA2MDcwMDAx.MjAxODA2MTYxODUwNTQ='),
('201806110001', 'Sultoni Siregar', 'Cikampak, labuhanbatu Selatan, Sumut', 'ucokmaslae@gmail.com', 'f089a57f42ddbf58ffe9f864d9d0cbad', 'L', '085362761000', 'Y', 'MjAxODA2MTEwMDAx.MjAxODA2MTExNDIzNTE='),
('201806120001', 'Nyimas nur asnia', 'Jl. Tulang bawang v no. 2197 rt.33  perumnas sako', 'nias_ainsa@rocketmail.com', '1ad20a7cb93d017ffccccda8eb348cab', 'P', '085367804019', 'Y', 'MjAxODA2MTIwMDAx.MjAxODA3MDcxMzU4MDk='),
('201806200001', 'Faiz', 'Lr. Hanan', 'faizyahya39@gmail.com', 'b2ed3163c0efd85116dd67b25f1c237c', 'L', '081369712908', 'Y', 'MjAxODA2MjAwMDAx.MjAxODA3MDIxMTMwNDI='),
('201806240001', 'Agus', 'Palembang ', 'agussubekti098@gmail.com', '301383f783f75c59c045108d8702d2d0', 'L', '089626805880', 'Y', 'MjAxODA2MjQwMDAx.MjAxODA5MDkxODAwMDg='),
('201806250001', 'Annisa', 'kampung lalang, MEDAN', 'annisa.lailiah@gmail.com', 'ac66d637ddf9cf52e9dfe72d1a5e92c5', 'P', '082366967377', 'Y', 'MjAxODA2MjUwMDAx.MjAxODA2MjUyMTE0MDQ='),
('201806280001', 'Iwan Kurniawan', 'Jl.Kapt. A.Rivai Lr. Muawanah no 370 Palembang', 'koerniaone221213@gmail.com', 'bb5f2ed6498eb3e6ebd9d7f19476d62f', 'L', '085268353424', 'Y', 'MjAxODA2MjgwMDAx.MjAxODA2MjgxODE0MTg='),
('201807010001', 'Agus', 'Jl mayorzen lr segaran ', 'agustriantojayakusuma@gmail.com', '11c4571e611b1aa3e8bccf5d5d1c61d1', 'L', '085369104754', 'Y', ''),
('201807040001', 'Abu Haniyfah', 'Palembang', 'abuhaniyfah@gmail.com', '9c6865354af47284de025476a10e8eab', 'L', '085268779707', 'Y', 'MjAxODA3MDQwMDAx.MjAxODA3MDQyMDU0NTM='),
('201807040002', 'Ummu Aisyah', 'Palembang', 'nurul_husna1504@yahoo.com', 'b5b7a56d91469aabd19865d9e3297781', 'P', '081272068554', 'Y', 'MjAxODA3MDQwMDAy.MjAxODA4MDMxODA4MzA='),
('201807050001', 'Aditya Pratama', 'jln.betawi raya no 5', 'aditkaka212@gmail.com', '018b0170cff66071b74a5612da2dff35', 'L', '081586186005', 'Y', 'MjAxODA3MDUwMDAx.MjAxODA3MDUwNjU1MzU='),
('201807060001', 'Jerry Ilham', 'Jl. Jakabaring No. 30', 'mendybeatrice21@gmail.com', '78a40d98d200c614493cd3f9b01ec842', 'L', '082282869343', 'Y', 'MjAxODA3MDYwMDAx.MjAxODA3MDYxOTIyNTM='),
('201807070001', 'Deny Syaputra', 'Komplek Megahasri 1 Blok F No 9, Sukajadi, Talang Kelapa, Banyuasin.', 'denisaputra1892@gmail.com', 'b820955fe473e72b93e66ba96de5054f', 'L', '08127147713', 'Y', 'MjAxODA3MDcwMDAx.MjAxODEyMzExMDU2NTY='),
('201807070002', 'Aji Zakaria', 'Ppi blok D1 No 9 ', 'ajizakaria999@gmail.com', '375777a6c0fc1ad6f1268ba62fa3eaec', 'L', '082183992603', 'Y', 'MjAxODA3MDcwMDAy.MjAxODA3MjUxMjU2MzA='),
('201807080001', 'merry', 'palembang', 'merryjupana6@yahoo.co.id', '4ac0083ef1816410dac3136d435db177', 'P', '08992399555', 'Y', 'MjAxODA3MDgwMDAx.MjAxODA3MDgwOTUxMjk='),
('201807080002', 'Ria oktarina', 'Kenten', 'riaoktarina1992@gmail.com', 'a420b4839d819147a011d21ba1dcc809', 'P', '085783861128', 'Y', 'MjAxODA3MDgwMDAy.MjAxODA3MjExMzE4NTE='),
('201807080003', 'Dinda putri meliani ', 'Sekip ujung ', 'dindapm1305@gmail.com', '78237f9d0b425d12d6f0134f2e0a55b1', 'P', '082279975387 ', 'Y', 'MjAxODA3MDgwMDAz.MjAxODA3MzEwNjA2NDM='),
('201807080004', 'Robybyandreyada', 'Jalan kapten ceks syeh lorong sekolah 24ilir palembang', 'robbyandreyada281001@gmail.com', '19d4a4564b8eab02f33386488b145e27', 'L', '08525335652', 'Y', 'MjAxODA3MDgwMDA0.MjAxODA3MTYxODA4MzE='),
('201807110001', 'Ichan', 'Jln perindustrian 2', 'ichanscrm@gmail.com', '9c486214ceba261c7584586d350dbecb', 'L', '08980818858', 'Y', 'MjAxODA3MTEwMDAx.MjAxODA3MTExMjM1MTc='),
('201807110002', 'Jehan', 'Palembang', 'jehansoulthany@gmail.com', 'fb18ecfe7389a0322c1c9bd8a4c72166', 'L', '082103680865', 'Y', 'MjAxODA3MTEwMDAy.MjAxODA5MTYxMzE1MjA='),
('201807120001', 'Heryadi', 'Komp.Griya Mitra I, Bukit Lama-IB I, Palembang', 'heryadi.fish82@gmail.com', '663e26b56bbdee56d335b1836859b28d', 'L', '081317283186', 'Y', 'MjAxODA3MTIwMDAx.MjAxODA3MTIxNjQ5MjY='),
('201807130001', 'Agus mahri', 'Jl.ponorogo palembang', 'agusmahri@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'L', '081367481888', 'Y', 'MjAxODA3MTMwMDAx.MjAxODEwMTAyMTM3MjE='),
('201807140001', 'Ahmad zulfakar rahmadi', 'Perum.griya asri gandus, blok b.17', 'ahmad.zulfakar.azr@gmail.com', '041e3e24a6484ff2b35fbc68e9931a4f', 'L', '085788039527', 'Y', 'MjAxODA3MTQwMDAx.MjAxODA3MjYxODEwMTQ='),
('201807140002', 'abufirli', 'Komp bumi nusa cendana blok e16 Plb', 'deddy272003@gmail.com', 'af7815faeb5577bd7851572843a89287', 'L', '081278919611', 'Y', 'MjAxODA3MTQwMDAy.MjAxODA3MTcxNjUwMjM='),
('201807150001', 'Muhammad eko', 'Palembang ', 'muhammadekoa@gmail.com', 'cb7031e17cc2e82d3e834b57067933e0', 'L', '085279775150', 'Y', 'MjAxODA3MTUwMDAx.MjAxODA3MTkxNzQ0NTE='),
('201807160001', 'melisawias', 'Palembang', 'izdiharmelisa@gmail.com', '4272f0953a52bdbb815f56600e9f6ec1', 'P', '082380959585', 'Y', 'MjAxODA3MTYwMDAx.MjAxODA3MTYxNjM0MzY='),
('201807160002', 'melisawias', 'Palembang', 'izdiharmelisa@gmail.com', '4272f0953a52bdbb815f56600e9f6ec1', 'P', '082380959585', 'Y', ''),
('201807180001', 'akhyar', 'jl.sukabangun km 6,5 komplek pepaya indah 2 rt 05 rw 01 no 2105A', 'akhyar.agung02@yahoo.co.id', '73cf692bbe9db12b732a504703e64b55', 'L', '082281063570', 'Y', 'MjAxODA3MTgwMDAx.MjAxODA3MTkxNjA3MzE='),
('201807190001', 'Imam Hambali', 'Ds. 1 Desa Benuang Kecamatan Talang Ubi Kabupaten PALI', 'imamhambali381@gmail.com', '751a39f76742f5cc1e4dafd351bda756', 'L', '081996513237', 'Y', 'MjAxODA3MTkwMDAx.MjAxODEyMDcwMjIyNDQ='),
('201807200001', 'Yuni Widayani', 'Sungai lilin', 'yuni.widayani5@gmail.com', '88100f92d66deb5f6ec2146e0b047cce', 'P', '081273324621', 'Y', 'MjAxODA3MjAwMDAx.MjAxODA3MjAwOTI2MTY='),
('201807200002', 'Iriani Santi Dewi ', 'Jalan Krio Rozali No 425 RT 05 Desa Merah Mata Banyuasin I Kabupaten Banyuasin Palembang ', 'dewiirianisanti@gmail.com', '524f807f924b0672ea8dd01f26631e6d', 'P', '082186604806', 'Y', 'MjAxODA3MjAwMDAy.MjAxODA3MjAxNjQ2NTY='),
('201807210001', 'Resti Ayu Widianti', 'Jl. Sukabangun 2 Lrg. Akasia', 'restiayuwidianti21@gmail.com', '32a4cae8dca9d3cada38db64f224a900', 'P', '081369489492', 'Y', 'MjAxODA3MjEwMDAx.MjAxODA5MTUxMzA0MTU='),
('201807210002', 'winda aprilia', 'jl. perjuangan sukawinatan no 771 rt.62, sukajaya, sukarami, palembang', 'apriliawinda6@gmail.com', 'c5514be187f6a444e16a683ec11197ee', 'P', '081278209891', 'Y', 'MjAxODA3MjEwMDAy.MjAxODExMDkxNzQ4MTk='),
('201807210003', 'Linggara Saputra', 'Km 6 sukabangun 1 palembang', 'vipcell2711@gmail.com', '661027f13958ea9a8d0a2dbe84076709', 'L', '081367302220', 'Y', 'MjAxODA3MjEwMDAz.MjAxODA3MjExNDM2Mjg='),
('201807250001', 'Rusnandi', 'Jln tari klasik kelapa gading timur II kelapa gading jakarta utara', 'rusnandimita@gmail.com', '6328be7f8fdeb604d5604f40218716ff', 'L', '081294752412', 'Y', 'MjAxODA3MjUwMDAx.MjAxODA3MjUxNTIzMzM='),
('201807260001', 'Yovie prayoga widianto', 'Mie aceh bireun, jln talang kerangga', 'yovieprayoga178@gmail.com', '560685179f8dc32453a8803aaeffcba1', 'L', '082282996855', 'Y', 'MjAxODA3MjYwMDAx.MjAxODExMDYxNzMxMzY='),
('201807270001', 'Nuansyah putra situmorang', 'Jalan palembang betung km11 rt28/rw06', 'nuanrif12@gmail.com', 'cee5e9e212d8303d5fe425d82ed32dd2', 'L', '089609580259', 'Y', 'MjAxODA3MjcwMDAx.MjAxODA4MDMwNzUzNDk='),
('201808010001', 'Edwin Aldrin Saputra', 'Km.6 Palembang', 'aldrinedwin06@gmail.com', '95093024a0eb7621f854941ad8b5bc01', 'L', '081271310997', 'Y', 'MjAxODA4MDEwMDAx.MjAxODA4MDMxOTQ0MDQ='),
('201808030001', 'Rani Dianti', 'Jl.Pendawa Lr.Tentram No.74 IT II Palembang', 'rani.dianti17@gmail.com', 'b89027e0d71a9f6dad5ed410756a801b', 'P', '081271744363', 'Y', 'MjAxODA4MDMwMDAx.MjAxODA5MTgyMDI4Mzg='),
('201809090001', 'Abu Uwais', 'Palembang', 'paishal.msyah@gmail.com', 'd86557dcba83c2c20b2bd70519a48956', 'L', '081377594359', 'Y', 'MjAxODA5MDkwMDAx.MjAxODA5MDkxOTAyMTg='),
('201809150001', 'Rika Purnamasari', 'Plaju', 'rikavilia0111@gmail.com', 'b76a67a3a7ecbb6ae5be14ebd4a0d0de', 'P', '085384081717', 'Y', 'MjAxODA5MTUwMDAx.MjAxODEwMjcxODI2Mjc='),
('201809180001', 'Lisna', 'Jln Lakitan raya no 2 perumnas Palembang 30163 Sako ', 'lisnawatiacc@yahoo.com', '4a3014d4e3e65849bf00ffcd4b0df753', 'P', '085377455559', 'Y', 'MjAxODA5MTgwMDAx.MjAxODEwMDgxNzM5Mzg='),
('201812260001', 'dedialyubi', 'Km14', 'dedialyubi@gmail.com', 'f8db2cdd89d1b18aad136e1e9d360909', 'L', '081278601110', 'Y', 'MjAxODEyMjYwMDAx.MjAxODEyMjYwODQzNTM='),
('201902190001', 'Ummu Syadza Farida Adenan', 'Kayuagung Sumsel', 'faridaoekda1969@gmail.com', '541100f13e5859b3d1a038e4e6467b7f', 'P', '082289387818', 'Y', ''),
('201903020001', 'Erison', 'Sako, Palembang', 'ererison2@gmail.com', 'c1b9f5e311f3c255732791e135e45401', 'L', '081273025093', 'Y', 'MjAxOTAzMDIwMDAx.MjAxOTAzMDIwODQzMjc=');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ustad`
--

CREATE TABLE `ustad` (
  `id_ustad` varchar(12) NOT NULL,
  `nama_ustad` varchar(80) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tpt_lahir` varchar(50) NOT NULL,
  `pendidkan` enum('SMA/Sederajat','D3','D4','S1','S2','S3') NOT NULL,
  `universitas` varchar(80) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ustad`
--

INSERT INTO `ustad` (`id_ustad`, `nama_ustad`, `tgl_lahir`, `tpt_lahir`, `pendidkan`, `universitas`, `alamat`, `no_hp`) VALUES
('Ust_0001', 'DR. Syafiq Reza Basalamah, L.c., M.A', '1989-01-25', 'Palembang', 'S3', 'USNRI', 'Palembang', '09834324'),
('Ust_0007', 'Ustadz Akhirudin, Lc', '2017-05-03', 'Palembang', 'S1', 'Universitas', 'Palembang', '0852'),
('Ust_0006', 'Ustadz Aidil Fitriansyah, B.A', '2017-05-01', 'Palembang', 'S1', 'Universitas', 'Palembang', '0852'),
('Ust_0004', 'Ustadz Abu Hamzah, S.Ag', '2017-05-07', 'Palembang', 'S1', 'Univesitas', 'Palembang', '0852685001111'),
('Ust_0005', 'Ustadz Roni Nuryusmansyah, S.Sy', '2017-05-01', 'Palembang', 'S1', 'STDI Jember', 'Palembang', '0852'),
('Ust_0008', 'Ustadz Bambang Ahmad Wafiy, M.Pd.I', '2017-05-02', 'Palembang', 'S2', 'Universitas', 'Palembang', '0852'),
('Ust_0009', 'Ustadz Nurfitri Hadi, M.A', '2017-05-03', 'Palembang', 'S2', 'Universitas', 'Palembang', '0852'),
('Ust_0010', 'Ustadz Hidayatullah, S.sy', '2017-05-04', 'Palembang', 'S1', 'STDI Jember', 'Palembang', '0852'),
('Ust_0011', 'Ustadz Abu Hamzah', '0000-00-00', '', '', '', '', ''),
('Ust_0012', 'Ustadz Umar Fanani, Lc', '0000-00-00', '', '', '', '', ''),
('Ust_0013', 'Ustadz Yusuf Solihin', '0000-00-00', '', '', '', '', ''),
('Ust_0014', 'Ustadz Nasirudin Irfan Lc', '0000-00-00', '', '', '', '', ''),
('Ust_0020', 'Ustadz Umar Fanani Lc', '0000-00-00', '', '', '', '', ''),
('Ust_0016', ' Dr. Aspri Rahmat Azai, MA', '0000-00-00', '', 'S3', 'Universitas Islam Madinah', '', ''),
('Ust_0017', 'Ustadz Ali Ahmad, Lc', '0000-00-00', '', '', '', '', ''),
('Ust_0018', 'Ustadz Firdaus S. Ag', '0000-00-00', '', '', '', '', ''),
('Ust_0036', '-', '0000-00-00', '', '', '', '', ''),
('Ust_0037', 'Ustadz Dhika Wiratrisno, S. Sy', '0000-00-00', '', '', '', '', ''),
('Ust_0021', 'Ustadz Ammi Nur Baitz', '0000-00-00', '', '', '', '', ''),
('Ust_0022', 'Ustadz Fuad Hamzah', '0000-00-00', '', '', '', '', ''),
('Ust_0023', 'Ustadz Abu Dzar', '0000-00-00', '', '', '', '', ''),
('Ust_0035', 'DR. Erwandi Tarmizi, MA,', '0000-00-00', '', 'S3', '', '', ''),
('Ust_0025', 'Ustadz Abu Usamah, Lc.', '0000-00-00', '', '', '', '', ''),
('Ust_0026', 'Ustadz Abu Harits Iswandi S.Ag', '0000-00-00', '', '', '', '', ''),
('Ust_0028', 'Ustadz Abu Ihsan Al-Maidany ', '0000-00-00', '', '', '', '', ''),
('Ust_0030', 'Ustadz Said Ya’i Imanul Huda Hafizhahullah', '0000-00-00', '', '', '', '', ''),
('Ust_0031', 'Ustadz Edi Suarno, S.Sy', '0000-00-00', '', '', '', '', ''),
('Ust_0032', 'Ustadz Abdul Muhsin', '0000-00-00', '', '', '', '', ''),
('Ust_0034', 'Ustadz Subhan Bawazier', '0000-00-00', '', '', '', '', ''),
('Ust_0038', 'Ustadz Mujiburrahim, B. A', '0000-00-00', '', '', '', '', ''),
('Ust_0039', 'Ustadz Said Yai Ardiansyah, MA', '0000-00-00', '', '', '', '', ''),
('Ust_0040', 'Ustadz Eko Iswanto, S. Sy', '0000-00-00', '', '', '', '', ''),
('Ust_0041', 'Ustadz Nizar Sa\'ad Jabal, Lc, M. Pd', '0000-00-00', '', 'S2', '', '', ''),
('Ust_0042', 'Ustadz Faisal Abdul Basith', '0000-00-00', '', '', '', '', ''),
('Ust_0043', 'Ustadz Edi Purwanto, BA', '0000-00-00', '', '', '', '', ''),
('Ust_0044', 'Ustadz dr. Raehanul Bahraen', '0000-00-00', '', '', '', '', ''),
('Ust_0045', 'Ustadz Oper Jakse, Lc', '0000-00-00', '', '', '', '', ''),
('Ust_0046', 'Ustadz Ibnu Hajar', '0000-00-00', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id_video`, `url`) VALUES
(1, 'UCW-4tOwjHOgmxY0PGfqktRQ');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `facebook`
--
ALTER TABLE `facebook`
  ADD PRIMARY KEY (`id_facebook`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id_info`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_masjid` (`id_masjid`),
  ADD KEY `id_ustadz` (`id_ustad`),
  ADD KEY `id_jenis_kajian` (`id_jenis_kajian`);

--
-- Indeks untuk tabel `jenis_kajian`
--
ALTER TABLE `jenis_kajian`
  ADD PRIMARY KEY (`id_jenis_kajian`);

--
-- Indeks untuk tabel `kajian`
--
ALTER TABLE `kajian`
  ADD PRIMARY KEY (`id_kajian`),
  ADD KEY `id_jenis_kajian` (`id_jenis_kajian`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD KEY `id_kota_kab` (`id_kota_kab`);

--
-- Indeks untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `id_kota_kab` (`id_kota_kab`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indeks untuk tabel `konfirhadir`
--
ALTER TABLE `konfirhadir`
  ADD PRIMARY KEY (`id_konfir`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `kota_kab`
--
ALTER TABLE `kota_kab`
  ADD PRIMARY KEY (`id_kota_kab`);

--
-- Indeks untuk tabel `masjid`
--
ALTER TABLE `masjid`
  ADD PRIMARY KEY (`id_masjid`),
  ADD KEY `id_kota_kab` (`id_kota_kab`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_kelurahan` (`id_kelurahan`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `ustad`
--
ALTER TABLE `ustad`
  ADD PRIMARY KEY (`id_ustad`);

--
-- Indeks untuk tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `facebook`
--
ALTER TABLE `facebook`
  MODIFY `id_facebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
