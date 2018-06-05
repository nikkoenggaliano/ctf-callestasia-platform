-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2018 pada 19.00
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbctf`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'informasi'),
(2, 'rules'),
(3, 'prize');

-- --------------------------------------------------------

--
-- Struktur dari tabel `last_solved`
--

CREATE TABLE `last_solved` (
  `id` int(11) NOT NULL,
  `peserta_id` int(11) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `nama_soal` varchar(100) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `nick` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `universitas` varchar(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id`, `username`, `email`, `nick`, `password`, `universitas`, `score`, `time`, `status`) VALUES
(982526, 'test', '', 'test', '098f6bcd4621d373cade4e832627b4f6', '', 10, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `posted`
--

CREATE TABLE `posted` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posted`
--

INSERT INTO `posted` (`id`, `isi`, `kategori_id`) VALUES
(13, 'Halo Selamat Datang. Selamat Belajar sambil Belajar. Berikut Adalah peraturan yang wajib ditaati pengguna CTF Callestasia.  \r\n<br>\r\n1. Dilarang Melakukan Serangan Pada Server <br>\r\n<br>\r\n2. Dilarang Bertukar Flag Sesama Pemain <br>\r\n<br>\r\n3. Jika Menemukan BUG harap dilapor. Hadiah = Point <br>\r\n<br>\r\n4. Jangan Sungkan Bertanya jika Kesusahan. <br>\r\n<br>\r\n5. Wajib Bahagia Saat Bermain! <br>\r\n<br>\r\n6. Melaporlah Jika FLAG yang kalian temukan tidak bisa di Submit\r\n<br>', 2),
(14, 'Found Bug Mission = 10 Points <br> Found Bug Server = 100 Points', 3),
(16, 'Selamat datang di Callestasia CTF. Jika menemukan Bug atau Cacat Soal, Silahkan di laporkan pada telegram @NepSka', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `submit`
--

CREATE TABLE `submit` (
  `id` int(11) NOT NULL,
  `nama_soal` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `score` int(11) NOT NULL,
  `flag` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `submit`
--

INSERT INTO `submit` (`id`, `nama_soal`, `deskripsi`, `kategori`, `score`, `flag`, `level`, `file`) VALUES
(4, '[C] Halo Web', 'You can try view this source first <br> <a href=\"https://callestasia.org/soal/1\" target=\"_blank\">Here</a>', 'Web', 2, 'Callesta{V1ew_Sourc3_F1rst}', 'Easy', ''),
(9, '[C] Halo Web 2', 'Halo Halo? <br> <a href=\"http://callestasia.org/soal/2/\" target=\"_blank\">Here</a>', 'Web', 10, 'Callesta{N0w_Y0u_Kn0w_Header_website}', 'Easy', ''),
(10, '[E] Siapa ini?', 'Si Cantik ini punya flag buat kalian. Tapi bisakah kalian Menemukannya? <br> <a href=\"http://callestasia.org/soal/file/eunha.rar\" target=\"_blank\"> Download Disini </a>', 'Stegano', 10, 'Callesta{Ciiiiieeeeee_Bis4_Scan_Barc0d3}', 'Easy', ''),
(12, '[C] Halo Web 3', 'Bisakah Menebak Flag Admin? <br> \r\n<a href=\"http://callestasia.org/soal/3/\" target=\"_blank\"\">HERE!</a>', 'Web', 12, 'Callesta{000h_1tss_JS_S00_34asy}', 'Easy', ''),
(13, '[B] Gooooyanggg', 'Ini flag buat kalian. Tapi ini sudah digoyang sama Caesar. <br>\r\n<br>\r\n<b>TRCCVJKR{TR3J4I_X0P4EX}</b> ', 'Crypto', 11, 'CALLESTA{CA3S4R_G0Y4NG}', 'Easy', ''),
(14, '[B] A B A S A?', 'Admin hanya tau cara bacanya aja nih, Abasa gitu <br>\r\n<br>\r\n<b>XZOOVHGZ{ZGYZHS_OZGRM}</b>', 'Crypto', 11, 'CALLESTA{ATBASH_LATIN}', 'Easy', ''),
(17, '[B] Paaaanjjjaaaaaang', '<a href=\"http://callestasia.org/soal/panjang.txt\"  target=\"_blank\"> Paaanjaaaaanggg </a>', 'Crypto', 17, 'Callesta{ANJAY_M4Ntappppp_Panjang}', 'Easy', ''),
(18, '[C] Tebak Tebakan', ' Halo. Admin punya permainan tebak tebakan angka. Kalian cukup memasukan input paramater ?tebak=(angka) <br>\r\ncontoh ?tebak=1 <br>\r\ncontoh ?tebak=2 <br>\r\nTebakan angkamu mulai dari 1 - 99. <br>\r\n\r\nMainkan disini <a href=\"http://dcua.tk/soal/tebak/\" target=\"_blank\"> Tebak! </a>', 'Web', 12, 'Callesta{Th1nk_0ut_of_th3_B0x}', 'Easy', ''),
(22, '[F] Try Linux Live?', 'Belajar Command Dasar linux juga perlu loh. <br> Kalian bisa mencoba disini <br>\r\n\r\n<a href=\"http://dcua.tk/soal/cmd/\" target=\"_blank\"> Linux Online </a> ', 'Programming', 5, 'Callestasia{L1nux_so_fUn_h3h3}', 'Easy', ''),
(23, '[C] Step 1', ' Ini sedikit membingungkan memang. \r\n<br>\r\n<b><a href=\"http://dcua.tk/soal/strcmp/\" target=\"_blank\"> Kalian Bisa kan? </a></b>', 'Web', 20, 'Callesta{Byp4sss_Term4Suk_Hack1ng}', 'Medium', ''),
(25, '[C] Step 2', 'Break MD5   <br>\r\n<a href=\"http://dcua.tk/soal/md5/\" target=\"_blank\"> Here </a>', 'Web', 25, 'Callesta{H4cker_Br3ak_MD5}', 'Medium', ''),
(27, '[C] Agent Callestasia', 'Hanya identitas \"callestasia\" saja yang bisa memasuki web <br>\r\n<a href=\"http://dcua.tk/soal/agen\" target=\"_blank\"> ini</a>.', 'Web', 10, 'Callesta{User_Agent_Changer}', 'Easy', ''),
(28, '[E] Ini Juga Cantik', ' Si Cantik ini punya FLAG buat kalian, Tapi sengaja di Edit admin biar gak kelihatan. <br>\r\n<a href=\"https://drive.google.com/open?id=0B6_asJlnJhBEOVlxbU1WNUktUGc\" target=\"_blank\"> Disini </a>', 'Stegano', 12, 'Callesta{Tersembunyi_Di_Kecantikan_Dahyun}', 'Easy', ''),
(29, '[B] MD5 and SHA1 This', 'Mari belajar Enskripsi 1 Arah. <br>\r\nEnkripsi kata \"Admin\" dengan MD5 <br>\r\nEnkripsi kata \"Ganteng\" dengan SHA1 <br>\r\n\r\nLalu gabungkan hasil dari kedua enksripsi tersebut menjadi <br>\r\n\r\n<b>Callesta{Admin_Ganteng}</b> \r\nIngat itu jangan disubmit, Tapi hasil dari kedua enskripsi itu. ', 'Crypto', 3, 'Callesta{e3afed0047b08059d0fada10f400c1e5_9ed395a1ea8f6d0320a8b9a0862934b23551fe6b}', 'Easy', ''),
(30, '[Cyber Jawara] Bonus', 'Halo, Saya baru saja menyelesaikan penyisihan Kompetisi CTF Cyber Jawara Tingkat Nasional. <br>\r\n\r\nBermain Bersama lebih dari 100 Team Sangat Seru dan menyenangkan. <br>\r\n\r\nIni saya bawahkan oleh oleh buat kalian. <br>\r\n\r\n<a href=\"https://drive.google.com/open?id=0B6_asJlnJhBEaEdxWkM4YVNJVnc\" target=\"_blank\"> Bonus </a> <br>\r\n\r\nSubmit dengan kepala Flag <b>CJ2017{}</b> Semua Soal Cyber Jawara akan memiliki kepala flag itu. <br>\r\n\r\nSoal Cyber Jawara Akan di tandai dengan Tag Soal [Cyber Jawara]\r\n', 'Misc', 75, 'CJ2017{ini_bonus_untuk_kamu}', 'Easy', ''),
(31, '[Cyber Jawara]  NHA-13', ' Sepertinya disk image ini dikunci. Dapatkah Anda membongkarnya? <br>\r\n<br>\r\n<a href=\"https://drive.google.com/open?id=0B6_asJlnJhBEeFdmcnZuSGdPYXM\" target=\"_blank\"> Bonus </a> <br>\r\n\r\n<center><mark style=color: red;>Hint</mark></center>\r\n<b> EFS Recovery </b>', 'Forensic', 225, 'CJ2017{knights_&_magic}', 'Hard', ''),
(32, '[Cyber Jawara] What The Flag', '  Temukan sesuatu dari berkas ini <br>\r\n\r\n<a href=\"https://drive.google.com/open?id=0B6_asJlnJhBEWUxoLWdXQ0xDZ2M\" target=\"_blank\"> Berkas Ini</a> <br>', 'Forensic', 175, 'CJ2017{HAA-RF-NHA}', 'Medium', ''),
(33, '[G ]Ini Cantik!', 'Si cantik ini. Lagi lagi punya flag buat kalian XXD haha.\r\n<br>\r\n\r\n<a href=\"https://drive.google.com/file/d/0B6_asJlnJhBETVBlVXFFY3VCM3c/view\" target=\"_blank\"> Klik Disini Untuk Melihat Kecantikanya</a>', 'Reversing', 25, 'Callesta{Cantik_Kan?_Haha_XXD}', 'Medium', ''),
(34, '[G] Perkalian', 'Admin membantu adik admin dalam mengerjakan tugas matematika. Jadi admin membuat program yang langsung bisa menjumlahkan luas dan keliling persegi. Kalian bisa mencobanya dibawah ini. Eh tapi ini dijalankan dilinux ya. Minimal ada bash. <br>\r\n\r\n<a href=\"https://drive.google.com/file/d/0B6_asJlnJhBEUlJsbTF3Vk1lTGc/view\" target=\"_blank\"> Persegi </a>', 'Reversing', 30, 'Callesta{Reverse_wow}', 'Medium', ''),
(35, '[D] Lagu Kesukaan Admin', 'Ini lagu kesukaan mimin, Tapi ada orang jahat yang merusak lagu admin. Bisakah kalian membantu admin mengembalikan lagunya?  <br>\r\n\r\nJangan lupa ikut bernyayi ya. Ada liriknya kok :D \r\n\r\n<a href=\"https://drive.google.com/open?id=0B6_asJlnJhBELWxEZjU2d0dsbHc\" target=\"_blank\"> Lagu </a>', 'Forensic', 50, 'Callesta{For3ns1c_Its_B3st}', 'Medium', ''),
(36, '[C] L E N ', 'Tak kasat mata.\r\n<br>\r\n<a href=\"http://officecentersurabaya.com/css/str.php\" target=\"_blank\"> Uhhh </a> ', 'Web', 30, 'Callesta{H0w_Y0u_D0_THis?}', 'Medium', ''),
(37, '[C] Kue Kering', 'Kamu siapa? \r\n<br>\r\n\r\n<a href=\"http://www.dcua.tk/soal/cookies.php\" target=\"_blank\"> Kamu siapa? </a> ', 'Web', 15, 'Callesta{Cook1es_Our_fri3nd}', 'Easy', ''),
(38, '[C] 1337 Tebak Tebakan', 'Ayo main tebak tebakan lagi yuk :* \r\n<br>\r\n\r\n<b> ?tebak= </b>\r\n<br>\r\n<a href=\"http://dcua.tk/soal/tebak2/?tebak=0\"  target=\"_blank\"> Tebak Kuy </a>', 'Web', 40, 'Callesta{Brut3_Forc3_Yes_Or_Try_Onc3}', 'Medium', ''),
(39, '[C] Validate Your flag here', 'Kami sudah menyiapkan flag untuk kamu. Tapi validasi dulu ya\r\n<br>\r\n<a href=\"http://dcua.tk/soal/val\" target=\"_blank\"> Here </a>', 'Web', 200, 'Callesta{2018_AutoM@t1C_its_N3ed3D_Agr33?}', 'Normal', ''),
(40, 'Learn Pwn', 'Yuk belajar mini pwn :D\r\n<br>\r\nFIle : <a href=\"http://dcua.tk/file/soal1\" target=\"_blank\"> Ini </a>\r\nConnect : <b> nc -vv 45.63.107.196 11331 </b>', 'Pwn', 100, 'Callesta{Mini_Bof_Ok}', 'Easy', ''),
(41, 'Newbie Here', 'Hai getting started with Swiss Army Knife\r\n<br>\r\n<b>nc 45.63.107.196 11330</b> ', 'Pwn', 10, 'Callesta{NC_NC_Nice}', 'Easy', ''),
(42, '[B] Who Is Her?', 'You know my girlfriend name? Its key to open it!\r\n<br>\r\n<a href=\"http://dcua.tk/file/gf.txt\" target=\"_blank\"> Here </a>', 'Crypto', 50, 'Callesta{ImNayeonTwice_My_Beauty_Gurl}', 'Normal', ''),
(43, '[G] Callestasia Land', 'What music you hear before doing activity guys?\r\n<br>\r\n<a href=\"http://dcua.tk/file/game.pyc\" target=\"_blank\"> Games </a>', 'Reversing', 70, 'Callesta{KimDahyun}', 'Easy', ''),
(44, 'Robots', 'Guess My Number\r\n<br>\r\n<b>nc 45.63.107.196 11332 </b>\r\n', 'Pwn', 50, 'Callesta{Need_help_from_robots}', 'Easy', ''),
(45, '[H] What A Missing Char', ' <b>19518485e*81fb04a601*aba736abc31</b>\r\n<br>\r\nSaya kehilangan 2 string itu (*) bisakah kalian menemukan? oh iya saya ingat punya MD5 dan SHA1 nya\r\n<br>\r\nMD5 = <b>d3b93396ce41f7de23581607f5e00698</b>\r\nSHA1=<b>742e4ad2a1c96cc56d8f450f82d559f2f87e8687</b>\r\n<br>\r\nFlag adalah full strings!', 'Misc', 100, 'Callesta{19518485e881fb04a601eaba736abc31}', 'Easy', ''),
(46, '[H] What A Key Now?', 'I Have secret Box for you. The Key is everything about her!\r\n<br>\r\n <a href=\"http://dcua.tk/soal/box/\" target=\"_blank\"> Come </a>', 'Misc', 350, 'Callesta{Recon_Every_Day_Evey_Night_Right?}', 'Normal', ''),
(47, 'Free Pentest Tools', 'Here we go, Free pentest tools for you for recon.\r\n<br>\r\n<b>nc 45.63.107.196 11333</b> ', 'Pwn', 150, 'Callesta{Upsss_Some_Injection_And_Bypassed}', 'Easy', ''),
(48, '[C] Our Profile is Up. Check', 'Wanna Know Twice? Read their profile on:\r\n<b>\r\n<a href=\"http://dcua.tk/soal/chain/\" target=\"_blank\"> Come </a>', 'Web', 200, 'Callesta{Chain_Vuln_Its_So_fun}', 'Normal', ''),
(49, '[H] Mitha Need Help', 'Mitha lose the flag. Help her find that!\r\n\r\n<a href=\"http://dcua.tk/file/twice.zip\" target=\"_blank\"> Come </a>', 'Misc', 100, 'Callesta{The_D3v1L_With_An_Ang3L_W1ngS}', 'Easy', ''),
(50, '[C] Welcome To The Jungle', 'Heyyyy\r\n<a href=\"http://dcua.tk/soal/session/\" target=\"_blank\">Semangat</a> ', 'Web', 100, 'Callesta{SESSION_On_PHP_Unccchhhhh!}', 'Normal', ''),
(51, '[C] Pusing', 'Gak tau lah.\r\n<br>\r\n<a href=\"http://dcua.tk/soal/pusing/\" target=\"_blank\">Pusing</a> ', 'Web', 100, 'Callesta{Tau_AH_PHP_KIN_KZLLLLL}', 'Normal', ''),
(52, '[C] Callestasia Data Profile', 'Hello We Need to list our member, here we go!\r\n<br>\r\n<a href=\"http://dcua.tk/soal/hehe\" target=\"_blank\"> Register Here </a>\r\n<br>\r\nNeed Source? I give you free!\r\n<br> \r\n<b>wget http://dcua.tk/soal/hehe/hack.zip</b>', 'Web', 200, 'Callesta{S0m3_Sql1_And_L1ttl3_3NC}', 'Hard', ''),
(53, '[D] Roloc', ' Her name in Nancy from Momoland. Shes 17 Y.O wow.\r\n<a href=\"http://dcua.tk/soal/roloc.html\" target=\"_blank\"> Nancy </a>', 'Forensic', 100, 'Callesta{Color_Your_Life}', 'Easy', ''),
(54, 'Callestasia Random String Generator', 'Admin baru saja mendapat source Random Generator kalian bisa coba di \r\n<br>\r\n<b>nc -vv 45.63.107.196 11338</b>\r\nKalian membutuhkan source? Kami kasih!\r\n<br>\r\n<a href=\"http://dcua.tk/soal/random.txt\" target=\"_blank\"> Here for you! </a> ', 'Pwn', 100, 'Callesta{Th3_Sh33ll_XD}', 'Easy', ''),
(55, 'Callestasia Random String Generator 2', 'You are a bad boys guys. Why hack our service?\r\n<br>\r\nYou can try our new service! Dont hack it. we hide in callesta extension!\r\n<b>nc -vv 45.63.107.196 33113 </b> \r\n<br>\r\n<a href=\"http://dcua.tk/soal/r2.txt\" target=\"_blank\"> Come! </a>', 'Pwn', 200, 'Callesta{Acc3s_L1mit3d_N0t_Big_Problem}', 'Normal', ''),
(56, '[G] Windows activate here.', 'Guys wanna help Activated our windows? ill so thankfull <br>\r\nHere our detail : <br>\r\nName : Callesta <br>\r\nEmail : Callesta@email.com <br>\r\n<a href=\"http://dcua.tk/soal/activate\" target=\"_blank\"> Come </a>\r\n', 'Reversing', 200, 'Callesta{6686-4093-4491-3295-5334-6684}', 'Hard', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tutor`
--

CREATE TABLE `tutor` (
  `id` int(11) NOT NULL,
  `nama_tutor` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `last_solved`
--
ALTER TABLE `last_solved`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `posted`
--
ALTER TABLE `posted`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submit`
--
ALTER TABLE `submit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `last_solved`
--
ALTER TABLE `last_solved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1289;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=982532;

--
-- AUTO_INCREMENT untuk tabel `posted`
--
ALTER TABLE `posted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `submit`
--
ALTER TABLE `submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
