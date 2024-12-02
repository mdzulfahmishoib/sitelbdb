-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sitelbdb
CREATE DATABASE IF NOT EXISTS `sitelbdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sitelbdb`;

-- Dumping structure for table sitelbdb.backup
CREATE TABLE IF NOT EXISTS `backup` (
  `id_backup` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori_backup` int unsigned NOT NULL,
  `tanggal_backup` date NOT NULL,
  `metode_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_file_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `validasi_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_petugas_validasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_backup`),
  KEY `backup_id_kategori_backup_foreign` (`id_kategori_backup`),
  CONSTRAINT `backup_id_kategori_backup_foreign` FOREIGN KEY (`id_kategori_backup`) REFERENCES `kategori_backup` (`id_kategori_backup`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.backup: ~0 rows (approximately)
INSERT INTO `backup` (`id_backup`, `id_kategori_backup`, `tanggal_backup`, `metode_backup`, `jenis_backup`, `waktu_backup`, `nama_file_backup`, `nama_petugas_backup`, `validasi_backup`, `nama_petugas_validasi`, `keterangan_backup`, `created_at`, `updated_at`) VALUES
	(6, 4, '2024-10-15', 'Cold', 'Online', '21', 'bojonegoro_system_2024-10-15_21.sql.gz', 'Fahmi', 'Berhasil', 'Adit', 'Tes', '2024-10-20 20:22:09', '2024-10-20 21:11:22');

-- Dumping structure for table sitelbdb.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.cache: ~1 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:135:{i:0;a:4:{s:1:"a";i:108;s:1:"b";s:12:"view_kendala";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:1;a:4:{s:1:"a";i:109;s:1:"b";s:14:"create_kendala";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:"a";i:110;s:1:"b";s:12:"read_kendala";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:3;a:4:{s:1:"a";i:111;s:1:"b";s:14:"update_kendala";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:"a";i:112;s:1:"b";s:14:"delete_kendala";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:5;a:4:{s:1:"a";i:114;s:1:"b";s:25:"view_maintenance_hardware";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:6;a:4:{s:1:"a";i:115;s:1:"b";s:27:"create_maintenance_hardware";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:"a";i:116;s:1:"b";s:25:"read_maintenance_hardware";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:8;a:4:{s:1:"a";i:117;s:1:"b";s:27:"update_maintenance_hardware";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:"a";i:118;s:1:"b";s:27:"delete_maintenance_hardware";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:10;a:4:{s:1:"a";i:119;s:1:"b";s:29:"kategori_maintenance_hardware";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:11;a:4:{s:1:"a";i:120;s:1:"b";s:25:"view_maintenance_software";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:12;a:4:{s:1:"a";i:121;s:1:"b";s:27:"create_maintenance_software";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:"a";i:122;s:1:"b";s:25:"read_maintenance_software";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:14;a:4:{s:1:"a";i:123;s:1:"b";s:27:"update_maintenance_software";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:"a";i:124;s:1:"b";s:27:"delete_maintenance_software";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:16;a:4:{s:1:"a";i:125;s:1:"b";s:29:"kategori_maintenance_software";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:17;a:4:{s:1:"a";i:126;s:1:"b";s:23:"view_maintenance_server";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:18;a:4:{s:1:"a";i:127;s:1:"b";s:25:"create_maintenance_server";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:"a";i:128;s:1:"b";s:23:"read_maintenance_server";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:20;a:4:{s:1:"a";i:129;s:1:"b";s:25:"update_maintenance_server";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:"a";i:130;s:1:"b";s:25:"delete_maintenance_server";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:22;a:4:{s:1:"a";i:131;s:1:"b";s:27:"kategori_maintenance_server";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:23;a:4:{s:1:"a";i:132;s:1:"b";s:20:"view_pengecekan_suhu";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:24;a:4:{s:1:"a";i:133;s:1:"b";s:22:"create_pengecekan_suhu";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:"a";i:134;s:1:"b";s:20:"read_pengecekan_suhu";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:26;a:4:{s:1:"a";i:135;s:1:"b";s:22:"update_pengecekan_suhu";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:"a";i:136;s:1:"b";s:22:"delete_pengecekan_suhu";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:28;a:4:{s:1:"a";i:137;s:1:"b";s:26:"view_register_ruang_server";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:29;a:4:{s:1:"a";i:138;s:1:"b";s:28:"create_register_ruang_server";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:"a";i:139;s:1:"b";s:26:"read_register_ruang_server";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:31;a:4:{s:1:"a";i:140;s:1:"b";s:28:"update_register_ruang_server";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:"a";i:141;s:1:"b";s:28:"delete_register_ruang_server";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:33;a:4:{s:1:"a";i:142;s:1:"b";s:11:"view_kantor";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:34;a:4:{s:1:"a";i:143;s:1:"b";s:13:"create_kantor";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:35;a:4:{s:1:"a";i:144;s:1:"b";s:11:"read_kantor";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:36;a:4:{s:1:"a";i:145;s:1:"b";s:13:"update_kantor";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:37;a:4:{s:1:"a";i:146;s:1:"b";s:13:"delete_kantor";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:38;a:4:{s:1:"a";i:147;s:1:"b";s:20:"view_management_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:39;a:4:{s:1:"a";i:148;s:1:"b";s:22:"create_management_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:40;a:4:{s:1:"a";i:149;s:1:"b";s:20:"read_management_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:41;a:4:{s:1:"a";i:150;s:1:"b";s:22:"update_management_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:42;a:4:{s:1:"a";i:151;s:1:"b";s:22:"delete_management_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:43;a:4:{s:1:"a";i:155;s:1:"b";s:11:"view_backup";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:44;a:4:{s:1:"a";i:156;s:1:"b";s:13:"create_backup";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:45;a:4:{s:1:"a";i:157;s:1:"b";s:11:"read_backup";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:46;a:4:{s:1:"a";i:158;s:1:"b";s:13:"update_backup";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:47;a:4:{s:1:"a";i:159;s:1:"b";s:13:"delete_backup";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:48;a:4:{s:1:"a";i:160;s:1:"b";s:15:"kategori_backup";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:49;a:4:{s:1:"a";i:162;s:1:"b";s:20:"kategori_unit_bagian";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:50;a:4:{s:1:"a";i:163;s:1:"b";s:16:"view_rekomendasi";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:51;a:4:{s:1:"a";i:164;s:1:"b";s:18:"create_rekomendasi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:52;a:4:{s:1:"a";i:165;s:1:"b";s:16:"read_rekomendasi";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:53;a:4:{s:1:"a";i:166;s:1:"b";s:18:"update_rekomendasi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:54;a:4:{s:1:"a";i:167;s:1:"b";s:18:"delete_rekomendasi";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:55;a:4:{s:1:"a";i:168;s:1:"b";s:28:"view_evaluasi_kinerja_sistem";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:56;a:4:{s:1:"a";i:169;s:1:"b";s:30:"create_evaluasi_kinerja_sistem";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:57;a:4:{s:1:"a";i:170;s:1:"b";s:28:"read_evaluasi_kinerja_sistem";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:58;a:4:{s:1:"a";i:171;s:1:"b";s:30:"update_evaluasi_kinerja_sistem";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:59;a:4:{s:1:"a";i:172;s:1:"b";s:30:"delete_evaluasi_kinerja_sistem";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:60;a:4:{s:1:"a";i:173;s:1:"b";s:32:"kategori_evaluasi_kinerja_sistem";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:61;a:4:{s:1:"a";i:174;s:1:"b";s:27:"view_pengecekan_unit_bagian";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:62;a:4:{s:1:"a";i:175;s:1:"b";s:29:"create_pengecekan_unit_bagian";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:63;a:4:{s:1:"a";i:176;s:1:"b";s:27:"read_pengecekan_unit_bagian";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:64;a:4:{s:1:"a";i:177;s:1:"b";s:29:"update_pengecekan_unit_bagian";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:65;a:4:{s:1:"a";i:178;s:1:"b";s:29:"delete_pengecekan_unit_bagian";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:66;a:4:{s:1:"a";i:182;s:1:"b";s:24:"view_sistem_pengembangan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:67;a:4:{s:1:"a";i:183;s:1:"b";s:26:"create_sistem_pengembangan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:68;a:4:{s:1:"a";i:184;s:1:"b";s:24:"read_sistem_pengembangan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:69;a:4:{s:1:"a";i:185;s:1:"b";s:26:"update_sistem_pengembangan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:70;a:4:{s:1:"a";i:186;s:1:"b";s:26:"delete_sistem_pengembangan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:71;a:4:{s:1:"a";i:187;s:1:"b";s:28:"kategori_sistem_pengembangan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:72;a:4:{s:1:"a";i:188;s:1:"b";s:23:"view_pelaporan_keuangan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:73;a:4:{s:1:"a";i:189;s:1:"b";s:25:"create_pelaporan_keuangan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:74;a:4:{s:1:"a";i:190;s:1:"b";s:23:"read_pelaporan_keuangan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:75;a:4:{s:1:"a";i:191;s:1:"b";s:25:"update_pelaporan_keuangan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:76;a:4:{s:1:"a";i:192;s:1:"b";s:25:"delete_pelaporan_keuangan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:77;a:4:{s:1:"a";i:193;s:1:"b";s:24:"view_pelaporan_isidentil";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:78;a:4:{s:1:"a";i:194;s:1:"b";s:26:"create_pelaporan_isidentil";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:79;a:4:{s:1:"a";i:195;s:1:"b";s:24:"read_pelaporan_isidentil";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:80;a:4:{s:1:"a";i:196;s:1:"b";s:26:"update_pelaporan_isidentil";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:81;a:4:{s:1:"a";i:197;s:1:"b";s:26:"delete_pelaporan_isidentil";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:82;a:4:{s:1:"a";i:198;s:1:"b";s:21:"view_pelaporan_pemkab";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:83;a:4:{s:1:"a";i:199;s:1:"b";s:23:"create_pelaporan_pemkab";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:84;a:4:{s:1:"a";i:200;s:1:"b";s:21:"read_pelaporan_pemkab";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:85;a:4:{s:1:"a";i:201;s:1:"b";s:23:"update_pelaporan_pemkab";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:86;a:4:{s:1:"a";i:202;s:1:"b";s:23:"delete_pelaporan_pemkab";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:87;a:4:{s:1:"a";i:203;s:1:"b";s:18:"view_pelaporan_ojk";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:88;a:4:{s:1:"a";i:204;s:1:"b";s:20:"create_pelaporan_ojk";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:89;a:4:{s:1:"a";i:205;s:1:"b";s:18:"read_pelaporan_ojk";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:23;}}i:90;a:4:{s:1:"a";i:206;s:1:"b";s:20:"update_pelaporan_ojk";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:91;a:4:{s:1:"a";i:207;s:1:"b";s:20:"delete_pelaporan_ojk";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:92;a:4:{s:1:"a";i:208;s:1:"b";s:18:"view_pelaporan_lps";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:93;a:4:{s:1:"a";i:209;s:1:"b";s:20:"create_pelaporan_lps";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:94;a:4:{s:1:"a";i:210;s:1:"b";s:18:"read_pelaporan_lps";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:95;a:4:{s:1:"a";i:211;s:1:"b";s:20:"update_pelaporan_lps";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:96;a:4:{s:1:"a";i:212;s:1:"b";s:20:"delete_pelaporan_lps";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:97;a:4:{s:1:"a";i:213;s:1:"b";s:20:"view_pelaporan_ppatk";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:98;a:4:{s:1:"a";i:214;s:1:"b";s:22:"create_pelaporan_ppatk";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:99;a:4:{s:1:"a";i:215;s:1:"b";s:20:"read_pelaporan_ppatk";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:100;a:4:{s:1:"a";i:216;s:1:"b";s:22:"update_pelaporan_ppatk";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:101;a:4:{s:1:"a";i:217;s:1:"b";s:22:"delete_pelaporan_ppatk";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:102;a:4:{s:1:"a";i:218;s:1:"b";s:27:"view_pelaporan_dirjen_pajak";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:103;a:4:{s:1:"a";i:219;s:1:"b";s:29:"create_pelaporan_dirjen_pajak";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:104;a:4:{s:1:"a";i:220;s:1:"b";s:27:"read_pelaporan_dirjen_pajak";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:105;a:4:{s:1:"a";i:221;s:1:"b";s:29:"update_pelaporan_dirjen_pajak";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:106;a:4:{s:1:"a";i:222;s:1:"b";s:29:"delete_pelaporan_dirjen_pajak";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:107;a:4:{s:1:"a";i:223;s:1:"b";s:19:"view_pelaporan_bpjs";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:108;a:4:{s:1:"a";i:224;s:1:"b";s:21:"create_pelaporan_bpjs";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:109;a:4:{s:1:"a";i:225;s:1:"b";s:19:"read_pelaporan_bpjs";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:110;a:4:{s:1:"a";i:226;s:1:"b";s:21:"update_pelaporan_bpjs";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:111;a:4:{s:1:"a";i:227;s:1:"b";s:21:"delete_pelaporan_bpjs";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:112;a:4:{s:1:"a";i:228;s:1:"b";s:34:"view_pelaporan_dukcapil_perbarindo";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:113;a:4:{s:1:"a";i:229;s:1:"b";s:36:"create_pelaporan_dukcapil_perbarindo";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:114;a:4:{s:1:"a";i:230;s:1:"b";s:34:"read_pelaporan_dukcapil_perbarindo";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:115;a:4:{s:1:"a";i:231;s:1:"b";s:36:"update_pelaporan_dukcapil_perbarindo";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:116;a:4:{s:1:"a";i:232;s:1:"b";s:36:"delete_pelaporan_dukcapil_perbarindo";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:117;a:4:{s:1:"a";i:233;s:1:"b";s:27:"view_kategori_produk_kredit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:118;a:4:{s:1:"a";i:234;s:1:"b";s:29:"create_kategori_produk_kredit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:119;a:4:{s:1:"a";i:235;s:1:"b";s:27:"read_kategori_produk_kredit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:120;a:4:{s:1:"a";i:236;s:1:"b";s:29:"update_kategori_produk_kredit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:121;a:4:{s:1:"a";i:237;s:1:"b";s:29:"delete_kategori_produk_kredit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:122;a:4:{s:1:"a";i:238;s:1:"b";s:22:"kategori_produk_kredit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:123;a:4:{s:1:"a";i:239;s:1:"b";s:25:"view_kategori_produk_dana";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:124;a:4:{s:1:"a";i:240;s:1:"b";s:27:"create_kategori_produk_dana";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:125;a:4:{s:1:"a";i:241;s:1:"b";s:25:"read_kategori_produk_dana";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:126;a:4:{s:1:"a";i:242;s:1:"b";s:27:"update_kategori_produk_dana";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:127;a:4:{s:1:"a";i:243;s:1:"b";s:27:"delete_kategori_produk_dana";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:128;a:4:{s:1:"a";i:244;s:1:"b";s:20:"kategori_produk_dana";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:129;a:4:{s:1:"a";i:245;s:1:"b";s:35:"view_kategori_produk_mobile_banking";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:130;a:4:{s:1:"a";i:246;s:1:"b";s:37:"create_kategori_produk_mobile_banking";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:131;a:4:{s:1:"a";i:247;s:1:"b";s:35:"read_kategori_produk_mobile_banking";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:132;a:4:{s:1:"a";i:248;s:1:"b";s:37:"update_kategori_produk_mobile_banking";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:133;a:4:{s:1:"a";i:249;s:1:"b";s:37:"delete_kategori_produk_mobile_banking";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:134;a:4:{s:1:"a";i:250;s:1:"b";s:30:"kategori_produk_mobile_banking";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}}s:5:"roles";a:3:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:11:"super-admin";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:7:"petugas";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:23;s:1:"b";s:4:"user";s:1:"c";s:3:"web";}}}', 1733207516);

-- Dumping structure for table sitelbdb.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.cache_locks: ~0 rows (approximately)

-- Dumping structure for table sitelbdb.evaluasi_kinerja_sistem
CREATE TABLE IF NOT EXISTS `evaluasi_kinerja_sistem` (
  `id_evaluasi_kinerja_sistem` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_evaluasi_kinerja_sistem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_vendor` int unsigned NOT NULL,
  `kepatuhan_kontrak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keandalan_kualitas_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketepatan_waktu_pelayanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsif_keluhan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepuasan_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standar_kualitas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sumber_daya_kualitas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proses_pengujian_pengendalian_kualitas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kualitas_laporan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketersediaan_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat_kegagalan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu_pemulihan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepatuhan_standar_bpr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepatuhan_persyaratan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepatuhan_kode_etik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepatuhan_bcp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kemudahan_berkomunikasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat_kerjasama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat_keterbukaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kemampuan_solusi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontribusi_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_evaluasi_kinerja_sistem`),
  KEY `evaluasi_kinerja_sistem_id_vendor_foreign` (`id_vendor`),
  CONSTRAINT `evaluasi_kinerja_sistem_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `vendor` (`id_vendor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.evaluasi_kinerja_sistem: ~0 rows (approximately)
INSERT INTO `evaluasi_kinerja_sistem` (`id_evaluasi_kinerja_sistem`, `tanggal_evaluasi_kinerja_sistem`, `id_vendor`, `kepatuhan_kontrak`, `keandalan_kualitas_layanan`, `ketepatan_waktu_pelayanan`, `responsif_keluhan`, `kepuasan_layanan`, `standar_kualitas`, `sumber_daya_kualitas`, `proses_pengujian_pengendalian_kualitas`, `kualitas_laporan`, `ketersediaan_layanan`, `tingkat_kegagalan`, `waktu_pemulihan`, `kepatuhan_standar_bpr`, `kepatuhan_persyaratan`, `kepatuhan_kode_etik`, `kepatuhan_bcp`, `kemudahan_berkomunikasi`, `tingkat_kerjasama`, `tingkat_keterbukaan`, `kemampuan_solusi`, `kontribusi_layanan`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(4, '2024-11-27', 1, 'Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', '1731391762_displayDesktop.png,1731391762_homePage.png', '2024-11-12 06:08:59', '2024-11-12 06:09:22');

-- Dumping structure for table sitelbdb.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table sitelbdb.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.jobs: ~0 rows (approximately)

-- Dumping structure for table sitelbdb.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.job_batches: ~0 rows (approximately)

-- Dumping structure for table sitelbdb.kantor
CREATE TABLE IF NOT EXISTS `kantor` (
  `id_kantor` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_kantor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kantor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kantor: ~4 rows (approximately)
INSERT INTO `kantor` (`id_kantor`, `nama_kantor`, `jenis_kantor`, `telepon_kantor`, `email_kantor`, `alamat_kantor`, `created_at`, `updated_at`) VALUES
	(1, 'KANTOR PUSAT', 'PUSAT', '(0353) 883956', 'bpr_daerah_bjn@yahoo.co.id', 'Jl. Mastrip No.35, Kauman, Kec. Bojonegoro, Kabupaten Bojonegoro, Jawa Timur 62113', '2024-06-13 04:14:33', '2024-06-19 06:50:33'),
	(2, 'KANTOR KEDUNGADEM', 'CABANG', '(0353) 3234005', 'bankda_bjncabkdm@yahoo.co.id', 'Jl. Raya Drokilo RT. 06/02 Ds. Drokilo Kec. Kedungadem', '2024-06-13 04:19:07', '2024-06-19 06:50:38'),
	(3, 'KANTOR KALITIDU', 'CABANG', '(0353) 512329', 'bank_daerah_bjn_kalitidu@yahoo.co.id', 'Jl. Raya Bojonegoro - Cepu No. 1688 Ds. Panjunan Kec. Kalitidu', '2024-06-13 07:28:53', '2024-06-19 06:50:41'),
	(4, 'KANTOR SUMBERREJO', 'CABANG', '(0353) 3416038', 'bdbsumberrejo@gmail.com', 'Jl. Timur Koramil Sumberrejo No. 37 Ds. Sumuragung Kec. Sumberrejo', '2024-06-19 06:55:11', '2024-06-19 06:55:11');

-- Dumping structure for table sitelbdb.kategori_backup
CREATE TABLE IF NOT EXISTS `kategori_backup` (
  `id_kategori_backup` int unsigned NOT NULL AUTO_INCREMENT,
  `kategori_backup` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_backup`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_backup: ~3 rows (approximately)
INSERT INTO `kategori_backup` (`id_kategori_backup`, `kategori_backup`, `created_at`, `updated_at`) VALUES
	(4, 'Server CBS banking.net', '2024-10-14 22:30:09', '2024-10-14 22:30:09'),
	(5, 'Server SIAK', '2024-10-14 22:30:21', '2024-10-14 22:30:21'),
	(7, 'Server SIAK V3', '2024-10-17 03:10:24', '2024-10-17 03:10:24');

-- Dumping structure for table sitelbdb.kategori_maintenance_hardware
CREATE TABLE IF NOT EXISTS `kategori_maintenance_hardware` (
  `id_kategori_maintenance_hardware` int unsigned NOT NULL AUTO_INCREMENT,
  `kategori_maintenance_hardware` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_maintenance_hardware`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_maintenance_hardware: ~10 rows (approximately)
INSERT INTO `kategori_maintenance_hardware` (`id_kategori_maintenance_hardware`, `kategori_maintenance_hardware`, `created_at`, `updated_at`) VALUES
	(10, 'Smart TV', '2024-06-11 08:45:27', '2024-06-11 08:45:27'),
	(11, 'Proyektor', '2024-06-11 08:45:37', '2024-06-11 08:45:37'),
	(12, 'Microphone', '2024-06-11 08:45:50', '2024-06-11 08:45:50'),
	(13, 'Conference Cam', '2024-06-11 08:46:01', '2024-06-11 08:46:01'),
	(14, 'Drone DJI Mavic', '2024-06-11 08:46:11', '2024-06-12 10:58:16'),
	(15, 'Kamera', '2024-06-11 08:46:16', '2024-06-11 08:46:16'),
	(16, 'Stabilizer', '2024-06-11 08:46:25', '2024-06-11 08:46:25'),
	(17, 'Fingerspot', '2024-06-11 08:46:45', '2024-06-11 08:46:45'),
	(18, 'Shredder (Penghancur Kertas)', '2024-06-11 08:46:58', '2024-06-11 08:46:58'),
	(19, 'Handphone', '2024-06-11 08:47:06', '2024-06-11 08:54:05');

-- Dumping structure for table sitelbdb.kategori_maintenance_server
CREATE TABLE IF NOT EXISTS `kategori_maintenance_server` (
  `id_kategori_maintenance_server` int unsigned NOT NULL AUTO_INCREMENT,
  `kategori_maintenance_server` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_maintenance_server`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_maintenance_server: ~13 rows (approximately)
INSERT INTO `kategori_maintenance_server` (`id_kategori_maintenance_server`, `kategori_maintenance_server`, `created_at`, `updated_at`) VALUES
	(1, 'SERVER 1', '2024-06-13 08:15:28', '2024-06-13 08:15:28'),
	(2, 'SERVER 2', '2024-06-13 08:15:34', '2024-06-13 08:15:34'),
	(3, 'SERVER 3', '2024-06-13 08:16:03', '2024-06-13 08:16:03'),
	(4, 'SERVER 4', '2024-06-13 08:16:07', '2024-06-13 08:16:07'),
	(5, 'SERVER 5', '2024-06-13 08:16:12', '2024-06-13 08:16:12'),
	(6, 'SERVER 6', '2024-06-13 08:16:16', '2024-06-13 08:16:16'),
	(7, 'Jaringan ICON+', '2024-06-13 08:16:34', '2024-06-13 08:16:34'),
	(8, 'Jaringan Biznet', '2024-06-13 08:16:42', '2024-06-13 08:16:42'),
	(9, 'Jaringan Telkom', '2024-06-13 08:16:49', '2024-06-13 08:16:49'),
	(10, 'DVR CCTV', '2024-06-13 08:17:01', '2024-06-13 08:17:01'),
	(11, 'UPS STABILIZER', '2024-06-13 08:17:08', '2024-06-13 08:17:08'),
	(12, 'DRC', '2024-06-13 08:17:13', '2024-06-13 08:17:13'),
	(13, 'MIKROTIK', '2024-06-13 08:17:18', '2024-06-13 08:17:18');

-- Dumping structure for table sitelbdb.kategori_maintenance_software
CREATE TABLE IF NOT EXISTS `kategori_maintenance_software` (
  `id_kategori_maintenance_software` int unsigned NOT NULL AUTO_INCREMENT,
  `kategori_maintenance_software` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_maintenance_software`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_maintenance_software: ~6 rows (approximately)
INSERT INTO `kategori_maintenance_software` (`id_kategori_maintenance_software`, `kategori_maintenance_software`, `created_at`, `updated_at`) VALUES
	(1, 'CBS', '2024-06-13 03:10:51', '2024-06-13 03:10:51'),
	(2, 'Website', '2024-06-13 03:11:25', '2024-06-13 03:11:25'),
	(3, 'SIAK', '2024-06-13 03:11:30', '2024-06-13 03:11:30'),
	(4, 'Sistem Arsip', '2024-06-13 03:11:39', '2024-06-13 03:11:39'),
	(5, 'Sistem Jaringan (cisco, prtg, winbox)', '2024-06-13 03:11:46', '2024-06-13 03:11:46'),
	(6, 'Ticketing Komplain', '2024-06-13 03:11:52', '2024-06-13 03:11:52');

-- Dumping structure for table sitelbdb.kategori_produk_dana
CREATE TABLE IF NOT EXISTS `kategori_produk_dana` (
  `id_kategori_produk_dana` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `dokumentasi_db` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_produk_dana`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_produk_dana: ~0 rows (approximately)
INSERT INTO `kategori_produk_dana` (`id_kategori_produk_dana`, `judul`, `deskripsi`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(1, 'Tabungan', 'Tabungan merupakan produk dana atau simpanan yang memberikan fleksibilitas dalam mengelola keuangan sehari-hari. Dengan setoran awal yang terjangkau dan suku bunga yang kompetitif, tabungan di PD. BPR Bank Daerah Bojonegoro merupakan cara yang aman dan mudah untuk menabung dan mengakumulasi dana untuk masa depan.', '1732595746_element5-digital-z6i_UCBuu5Q-unsplash.jpg', '2024-11-26 04:35:46', '2024-11-26 04:44:28');

-- Dumping structure for table sitelbdb.kategori_produk_kredit
CREATE TABLE IF NOT EXISTS `kategori_produk_kredit` (
  `id_kategori_produk_kredit` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `dokumentasi_db` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_produk_kredit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_produk_kredit: ~1 rows (approximately)
INSERT INTO `kategori_produk_kredit` (`id_kategori_produk_kredit`, `judul`, `deskripsi`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(1, 'Pertanian/Peternakan Pola Musiman', 'Produk Kredit Peternakan dan Pertanian di PD. BPR Bank Daerah Bojonegoro adalah solusi finansial yang disesuaikan dengan kebutuhan para peternak dan petani untuk mendukung pertumbuhan dan pengembangan usaha mereka. BPR memahami peran vital sektor pertanian dan peternakan dalam perekonomian lokal, dan berkomitmen untuk menyediakan akses mudah dan terjangkau terhadap pembiayaan yang dibutuhkan.', '1732593226_Screenshot 2024-03-25 124710.png', '2024-11-26 03:53:46', '2024-11-29 01:38:01');

-- Dumping structure for table sitelbdb.kategori_produk_mobile_banking
CREATE TABLE IF NOT EXISTS `kategori_produk_mobile_banking` (
  `id_kategori_produk_mobile_banking` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `dokumentasi_db` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_produk_mobile_banking`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_produk_mobile_banking: ~0 rows (approximately)
INSERT INTO `kategori_produk_mobile_banking` (`id_kategori_produk_mobile_banking`, `judul`, `deskripsi`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(1, 'Mobile Banking', 'Layanan perbankan yang memungkinkan nasabah untuk mengakses dan melakukan berbagai transaksi perbankan melalui perangkat seluler, seperti smartphone atau tablet. \r\n\r\nDengan Mobile Banking, nasabah dapat melakukan aktivitas perbankan kapan saja dan di mana saja tanpa harus pergi ke kantor. Ini adalah bentuk layanan digital banking yang memberikan kenyamanan dan fleksibilitas kepada nasabah.', '1732597380_macos-big-sur-apple-layers-fluidic-colorful-wwdc-stock-3840x2160-1455.jpg', '2024-11-26 05:03:00', '2024-11-26 05:09:36');

-- Dumping structure for table sitelbdb.kategori_sistem_pengembangan
CREATE TABLE IF NOT EXISTS `kategori_sistem_pengembangan` (
  `id_kategori_sistem_pengembangan` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori_sistem_pengembangan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kategori_sistem_pengembangan: ~5 rows (approximately)
INSERT INTO `kategori_sistem_pengembangan` (`id_kategori_sistem_pengembangan`, `judul`, `deskripsi`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(1, 'Core Banking System (CBS) - MARSTECH', 'Dirancang untuk mengelola dan mengotomatisasi sebagian besar operasi perbankan. Sistem ini menjadi inti atau pusat dari seluruh infrastruktur teknologi informasi BPR dan bertugas untuk mengelola data dasar BPR serta menyediakan berbagai layanan perbankan kepada nasabah dan cabang-cabang bank. Core Banking System memiliki peran penting dalam mendukung fungsi operasional secara efektif dan efesien.', 'k5UNTtMemL6tgzzNQbXuPVJFxrE31K05IIk7xTNb.jpg', '2024-10-29 21:14:09', '2024-10-29 21:14:09'),
	(2, 'Cash Deposit Machine (CDM) - M PAY MARSTECH', 'Adalah layanan setor uang tunai dan penjemputan uang tunai dalam mata uang Rupiah dari lokasi nasabah, penyetoran uang /dana langsung masuk ke rekening nasabah secara realtime.', '5t6cah8r04gNKqVQkryjyGhcGUud6yJOJNOEatTM.jpg', '2024-10-29 21:51:52', '2024-10-29 21:51:52'),
	(3, 'Mobile Otorisasi - MOTO MARSTECH', 'Yaitu alat otorisasi melalui ponsel, yaitu alat yang bisa memberikan persetujuan atas suatu transaksi atau aktivitas keuangan tertentu. Otorisasi ini bertujuan untuk memastikan bahwa setiap transaksi atau tindakan keuangan yang dilakukan adalah sah, dan diizinkan oleh pihak yang berwenang. Proses otorisasi ini merupakan langkah penting dalam menjaga keamanan dan keandalan sistem perbankan secara efektif dan efesien.', '8GVJB7U0wlsGOrlhczzVyoAMzpWauHsIe9b0xILT.jpg', '2024-10-29 21:52:13', '2024-11-12 03:21:53'),
	(4, 'FastPay', 'FastPay yang menjalin kerjasama dengan PD. BPR Bank Daerah Bojonegoro untuk menyediakan layanan pembayaran digital kepada masyarakat. Melalui kemitraan ini, FastPay memungkinkan pelanggan untuk melakukan berbagai transaksi keuangan di PD. BPR Bank Daerah Bojonegoro secara mudah dan cepat menggunakan aplikasi seluler atau platform digital.\r\n\r\nLayanan yang ditawarkan oleh FastPay mencakup berbagai jenis pembayaran, termasuk pembayaran tagihan, transfer antarbank, top up saldo e-money, pembelian pulsa, pembelian token listrik, dan layanan lainnya yang terkait dengan kebutuhan keuangan sehari-hari. \r\n\r\nFastPay melalui PD. BPR Bank Daerah Bojonegoro membuka keagenan, hal ini adalah kesempatan bisnis yang unik yang memungkinkan individu atau usaha kecil untuk menjadi mitra dalam menyediakan layanan pembayaran digital kepada masyarakat, dengan dukungan dari bank lokal yang terpercaya di wilayah Bojonegoro dan sekitarnya.', 'Qg9KdR3H3DN8jUtQU1IYWHWqDaK1FG4m8MQzmSHm.png', '2024-10-29 21:53:06', '2024-10-29 21:53:06'),
	(5, 'Virtual Account (VA)', 'pembayaran yang memungkinkan nasabah untuk melakukan setoran atau transfer melalui nomor rekening virtual yang diberikan oleh BPR. Nomer VA akan membuat saluran pembayaran yang efektif dan efisien yang terintegrasi ke sistem CBS BPR secara realtime. VA BPR sudah bekerjasama dengan :\r\n\r\nBRI (SUDAH)\r\n\r\nBank Jatim (SUDAH)\r\n\r\nPermata (ON PROGRESS)', 'wokxWiBTcCoN76KYCslNTbnh2eSPHWJaD6wbVAVc.jpg', '2024-10-29 21:54:10', '2024-10-29 21:54:10');

-- Dumping structure for table sitelbdb.kendala
CREATE TABLE IF NOT EXISTS `kendala` (
  `id_kendala` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_kendala` date NOT NULL,
  `urgensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `klasifikasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_kendala` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelapor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kantor` int unsigned NOT NULL,
  `id_unit_bagian` int unsigned NOT NULL,
  `diselesaikan_oleh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan_tambahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kendala`),
  KEY `kendala_id_kantor_foreign` (`id_kantor`),
  KEY `kendala_id_unit_bagian_foreign` (`id_unit_bagian`),
  CONSTRAINT `kendala_id_kantor_foreign` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`),
  CONSTRAINT `kendala_id_unit_bagian_foreign` FOREIGN KEY (`id_unit_bagian`) REFERENCES `unit_bagian` (`id_unit_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.kendala: ~83 rows (approximately)
INSERT INTO `kendala` (`id_kendala`, `tanggal_kendala`, `urgensi`, `klasifikasi`, `keterangan_kendala`, `pelapor`, `id_kantor`, `id_unit_bagian`, `diselesaikan_oleh`, `status`, `tanggal_selesai`, `keterangan_tambahan`, `dokumentasi_db`, `user_name`, `created_at`, `updated_at`) VALUES
	(52, '2024-04-16', 'Menengah', 'Jaringan', 'Modem Indihome CS Tidak Ada Internet', 'Salsa', 1, 4, 'Teknisi INDIHOME', 'Selesai', '2024-04-16', 'Perbaikan kabel fiber optik oleh teknisi Indihome', 'Qt3KDOP9Fvv3WASc7tpxsZtOZAmkGX3hH6XIGt9l.jpg', NULL, '2024-06-03 08:50:40', '2024-11-15 02:34:08'),
	(53, '2024-04-19', 'Menengah', 'Hardware', 'Hardisk Tidak Terdeteksi', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-04-19', 'Tukar kabel power dari ssd ke hdd', '7NSpX31YtGFZDR4BgozmRiaNHYpQ6rPKjL5nWmnT.jpg', NULL, '2024-06-03 08:52:04', '2024-10-21 18:55:14'),
	(54, '2024-04-22', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Nunung', 1, 8, 'TIM IT', 'Selesai', '2024-04-22', 'Dilakukan head cleaning', 'rh6Sw1oKVLtAvxwi6VjhaBWZm8sM9BxAzt1wxYoI.jpg', NULL, '2024-06-03 09:06:51', '2024-10-21 18:55:25'),
	(55, '2024-04-23', 'Menengah', 'Software', 'Install Antivirus', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-04-23', 'Install Avast Antivirus Free', 'lg3vYurfodyicBeZ9F9DAbUuCUnOhs46wnlppGDU.jpg', NULL, '2024-06-03 09:29:04', '2024-10-21 18:55:35'),
	(56, '2024-04-24', 'Menengah', 'Software', 'Backup data', 'Lila', 1, 15, 'TIM IT', 'Selesai', '2024-04-24', 'Backup data ke Flashdisk', 'OQKn2KTC4ohTxCfWtfxQIr68uwhqoJFM7KhwztV6.jpg', NULL, '2024-06-03 09:31:35', '2024-10-21 18:55:44'),
	(57, '2024-04-24', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Didik', 1, 8, 'TIM IT', 'Selesai', '2024-04-24', 'Restart switch pada kredit, legal, teller + Disable enable LAN', 'nwkDO7pSTQmXnYJFPxsGfvKagkCBTaNUYRNLgP0t.jpg', NULL, '2024-06-03 09:32:50', '2024-10-21 18:56:14'),
	(58, '2024-04-24', 'Rendah', 'Software', 'Printer tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-04-24', 'Cabut kabel usb serta close aplikasi USB share dan buka kembali USB Share, lalu pasang kembali kabel usb', 'D9zjKhoEhPcyEbS4wvTZqvgXpSjFA4ur8pvcP5BG.jpg', NULL, '2024-06-03 09:49:56', '2024-10-21 18:57:25'),
	(61, '2024-04-26', 'Rendah', 'Hardware', 'Printer kertasnya tidak mau keluar', 'Partiwik', 1, 1, 'Service Printer', 'Selesai', '2024-04-29', 'Diserahkan ke service printer', '24KjJ3RUKxWCeaeLlUkHy78lvhEZemdVRyZsVxvt.jpg', NULL, '2024-06-03 10:43:39', '2024-06-07 06:14:54'),
	(66, '2024-04-26', 'Menengah', 'Hardware', 'Komputer tidak tampil display', 'Aris', 1, 9, 'TIM IT', 'Selesai', '2024-04-26', 'Memindahkan hardisk ke mainboard komputer lain', 'iYWw1U26r7MQjPJdLMoPwWBq31p3hBm8y2MTdzut.jpg', NULL, '2024-06-03 10:50:07', '2024-10-21 18:57:49'),
	(67, '2024-04-26', 'Menengah', 'Jaringan', 'Koneksi Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-04-26', 'Restart switch pada bagian kredit, legal, dan teller', 'sht0ogAFWshH9ViK3IABRt2YEepkrGGRYKLnyr7E.jpg', NULL, '2024-06-03 10:51:53', '2024-10-21 18:57:59'),
	(68, '2024-04-26', 'Rendah', 'Hardware', 'Printer tidak terhubung', 'Salsa', 1, 4, 'TIM IT', 'Selesai', '2024-04-26', 'Cabut pasang kabel 2 port usb switch', '7ffXemt5xHRm09DwHCJ4kjHWwOzXO2VxrRkhL1qt.jpg', NULL, '2024-06-03 10:57:05', '2024-10-21 18:58:47'),
	(70, '2024-04-29', 'Menengah', 'Hardware', 'Komputer lambat', 'Partiwik', 1, 1, 'TIM IT', 'Selesai', '2024-04-29', 'Tambah RAM 2GB menjadi total 4GB', 'n2xClZVozyXu0Ip5dn87WRRAWTa7ApFgjZNwOYEK.jpg', NULL, '2024-06-03 11:08:43', '2024-06-07 06:15:39'),
	(71, '2024-04-30', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Partiwik', 1, 1, 'TIM IT', 'Selesai', '2024-04-30', 'Dilakukan head cleaning', 'nggU6K7RyFF6zvKjVDfATvxiMTAmnIi7V4fymqiw.jpg', NULL, '2024-06-03 11:09:34', '2024-06-07 06:15:52'),
	(72, '2024-05-02', 'Tinggi', 'CBS', 'CBS dan Jaringan Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-05-02', 'Reboot modem internet dan CBS', 'TMud8MkfmQyvSJY9Dnph0n5JCfPVEQzrVw4AWAa7.jpg', NULL, '2024-06-03 11:11:12', '2024-10-21 18:59:06'),
	(73, '2024-05-06', 'Rendah', 'Hardware', 'Printer tidak terhubung', 'Salsa', 1, 4, 'TIM IT', 'Selesai', '2024-05-06', 'Cabut pasang kabel 2 port usb switch', 's2XTr9pE5mVHcxkkhybpho88nPSzs5EPQJgcRDCn.jpg', NULL, '2024-06-03 11:13:07', '2024-10-21 18:59:12'),
	(74, '2024-05-07', 'Rendah', 'Software', 'Microsoft Activation', 'Ikevina', 1, 17, 'TIM IT', 'Selesai', '2024-05-07', 'Aktivasi KMS Auto', '6ebdKc0aLsfovvQGCWkxIkLwOzBjlRkk0rdr3dVG.jpg', NULL, '2024-06-03 11:14:11', '2024-10-21 19:00:21'),
	(80, '2024-05-07', 'Menengah', 'Jaringan', 'Komputer bagian kredit tidak terhubung', 'Krisna', 1, 2, 'TIM IT', 'Selesai', '2024-05-07', 'Barel kabel lan terputus', 'rDdzj68K9VpA5bDpCueuGrEzMkb7hKhOQ9vjTAiQ.jpg', NULL, '2024-06-04 01:36:22', '2024-10-21 19:00:31'),
	(81, '2024-05-13', 'Rendah', 'Hardware', 'Printer offline', 'Mala', 1, 16, 'TIM IT', 'Selesai', '2024-05-13', 'Cabut pasang USB HUB', 'GmXDP6pybT26ujbppO1pZDh8rMHcM5UN83FBUDkH.jpg', NULL, '2024-06-04 01:37:30', '2024-10-21 19:00:37'),
	(82, '2024-05-14', 'Menengah', 'Jaringan', 'Koneksi Internet tidak terhubung', 'Iman', 1, 5, 'TIM IT', 'Selesai', '2024-05-14', 'Cabut pasang port ethernet di belakang teller', 'rolrAKU1x2WxDlyMx8qAsw3KE1tpH1a8u5KK8OMb.jpg', NULL, '2024-06-04 01:38:36', '2024-10-21 19:00:47'),
	(83, '2024-05-17', 'Menengah', 'Software', 'Muncul Microsoft Activation padahal original', 'Gita', 1, 5, 'TIM IT', 'Selesai', '2024-05-17', 'Restart komputer', '99kDNygL5De7TQL3MHsxsHBhEU2iJvhmt4nG1fLR.jpg', NULL, '2024-06-04 01:39:52', '2024-10-21 19:00:52'),
	(84, '2024-05-18', 'Menengah', 'Jaringan', 'Merapikan jaringan kantor cabang kalitidu', 'IT', 3, 15, 'TIM IT', 'Selesai', '2024-05-18', 'Menambahkan rak gantung untuk tempat mikrotik', 'g5vg0Qu8jJNactPvauEOLotB52zQhYx0ANhJzbyG.jpg', NULL, '2024-06-04 01:42:07', '2024-10-21 19:01:12'),
	(85, '2024-05-18', 'Tinggi', 'Hardware', 'Setting CCTV dan DVR Kantor Kas Kasiman', 'IT', 1, 15, 'TIM IT', 'Selesai', '2024-05-18', 'Menambahkan monitor ke dvr kantor kasiman', 'zneovKNoZQAb6p5sBnSmeLnwSkZBmsU0bbYc7ax7.jpg', NULL, '2024-06-04 01:42:57', '2024-10-21 19:01:26'),
	(86, '2024-05-22', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Devy', 1, 5, 'TIM IT', 'Selesai', '2024-05-22', 'Power cleaning dan head cleaning', '6CDRFfLAaOsz1OTqdc8hvQK4Ci3xITwpaS8absVM.jpg', NULL, '2024-06-04 01:53:23', '2024-10-21 19:01:34'),
	(87, '2024-05-30', 'Rendah', 'Hardware', 'Power cleaning dan head cleaning', 'Salsa', 1, 4, 'TIM IT', 'Selesai', '2024-05-30', 'Dilakukan head cleaning', 'Cshe8kvgj71xIHgOmRTDSTaqua1bDGM1xwCWfRa0.jpg', NULL, '2024-06-04 01:54:33', '2024-10-21 19:01:40'),
	(88, '2024-05-31', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Didik', 1, 8, 'TIM IT', 'Selesai', '2024-05-31', 'Cabut pasang kabel LAN', 'B2ihQHpgROfeQ1Vz9xZIScELzCBEP99F93ofWOqC.jpg', NULL, '2024-06-04 01:55:15', '2024-10-21 19:01:47'),
	(126, '2024-06-04', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-06-04', 'Cabut pasang kabel lan switch', 'LmSB1yF9Z8qo7gQTq7YMx1dnscYQMeNvxYI9OvFB.jpg', NULL, '2024-06-04 06:08:20', '2024-10-21 19:01:54'),
	(145, '2024-06-07', 'Rendah', 'Hardware', 'Tinta printer warna hitam malah muncul warna merah', 'Erisa', 1, 4, 'TIM IT', 'Selesai', '2024-06-07', 'Dilakukan head cleaning', 'bonlVTqlYcwNluzTIrGQjnR6fjOI9gJBkr0xFCPm.jpg', NULL, '2024-06-12 07:33:36', '2024-10-21 19:02:01'),
	(146, '2024-06-07', 'Rendah', 'Hardware', 'Printer bersuara berdecit berisik', 'Delia', 1, 6, 'Service Printer', 'Selesai', '2024-06-10', 'Diserahkan ke ASTON Bojonegoro', '51dmBCG4DUBtG30gsHET3ZZNOMv3eWzy6IqiUcH4.jpg', NULL, '2024-06-12 07:35:08', '2024-10-21 19:02:08'),
	(147, '2024-06-10', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Delia', 1, 6, 'TIM IT', 'Selesai', '2024-06-10', 'Dilakukan head cleaning', 'W08HJpol4Favk4pcdsAFuG7kw6jcRsta3y2KCZuT.jpg', NULL, '2024-06-12 07:36:26', '2024-10-21 19:02:17'),
	(148, '2024-06-13', 'Rendah', 'Hardware', 'Hasil cetak printer kode tulisan aneh', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-06-13', 'Dilakukan restart komputer dan restrart usb switch printer', 'XMt90fDjCEpoPE2yDZBbtmDyWYrtyGZZPbgAEatn.jpg', NULL, '2024-06-13 07:32:04', '2024-10-21 19:02:23'),
	(149, '2024-06-14', 'Menengah', 'Hardware', 'Komputer bluescreen tidak masuk windows', 'Aris', 1, 9, 'TIM IT', 'Selesai', '2024-06-19', 'Dilakukan install ulang windows', '5foMwfhIJ8fkN2bXLvlbfDFzQ44Kj6l0poxyOVMU.jpg,TzfyemdSEKmlCdOcq8UvnIB66pk8u89VXleOj7Ug.jpg', NULL, '2024-06-19 03:43:43', '2024-10-21 19:02:30'),
	(150, '2024-06-14', 'Rendah', 'Hardware', 'Printer epson end of service', 'Hendy', 1, 3, 'TIM IT', 'Selesai', '2024-06-14', 'Dilakukan reset counter menggunakan epson resetter', 'xMUCeoL3PmyPj2aBIocvPZetqOHntDTEkb3j6rhH.jpg', NULL, '2024-06-19 03:45:03', '2024-10-21 19:02:38'),
	(151, '2024-06-14', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-06-14', 'Dilakukan cabut dan pasang kembali kabel lan dari switch', 'z6FBac0NLUDblmd7BVHGvqIMVQBZhlXiqjII3KS4.jpg', NULL, '2024-06-19 03:46:21', '2024-10-21 19:02:47'),
	(152, '2024-06-19', 'Rendah', 'Hardware', 'Printer tidak menyala', 'Krisna', 1, 2, 'TIM IT', 'Selesai', '2024-06-19', 'Pindah saklar colokan kabel printer', 'hg96FAn77JjnBr0Jr0Xf9areVGKnVDN9ECeO76Zf.jpg', NULL, '2024-06-19 03:47:29', '2024-10-21 19:02:55'),
	(155, '2024-06-20', 'Rendah', 'Hardware', 'Printer tidak menyala', 'Partiwik', 1, 1, 'TIM IT', 'Selesai', '2024-06-20', 'Kabel power printer longgar', '1S6wVBPBP5TC7WmWkQWnhVrAnao93lxpkrICZ8MD.jpg', NULL, '2024-06-21 01:34:16', '2024-10-20 19:16:56'),
	(178, '2024-06-21', 'Rendah', 'Hardware', 'Printer waste ink pad counter', 'Devy', 1, 5, 'TIM IT', 'Selesai', '2024-06-21', 'Melakukan Reset dengan Epson Resetter L3210', 'kh02fgn5EydHNSptg3aO9wARuxs6k6lq650r8mMd.jpg', NULL, '2024-10-20 19:16:32', '2024-10-21 19:03:07'),
	(179, '2024-06-21', 'Menengah', 'Jaringan', 'Internet semua kabel LAN komputer tidak terhubung', 'Didik', 1, 8, 'TIM IT', 'Selesai', '2024-06-21', 'Dilakukan restart modem BIZNET', 'kUdSwZmctgLpv62CSQ2a6LiZXAAblsnY8QngC07I.jpg', NULL, '2024-10-20 19:18:25', '2024-10-21 19:03:14'),
	(180, '2024-06-24', 'Rendah', 'Hardware', 'Printer tinta habis', 'Dian', 1, 6, 'TIM IT', 'Selesai', '2024-06-24', 'Ganti catridge canon ip2770', 'KofFzEdF0BJFm8fqULy9Tn85MStkGYP1mklyu9kh.jpg', NULL, '2024-10-20 19:19:36', '2024-10-21 19:03:25'),
	(181, '2024-06-28', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-06-28', 'Reboot modem biznet', '43hgz7bMwsAXmOKjy2Ogitg5Jn7GcEorpRQTgRAJ.jpg', NULL, '2024-10-20 19:21:16', '2024-10-21 19:03:32'),
	(182, '2024-07-01', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Salsa', 1, 4, 'TIM IT', 'Selesai', '2024-07-01', 'Dilakukan head cleaning', 'AY7GnmmR3WtaJjuceo6sXGayTxIvb11L1rBNJAdd.jpg', NULL, '2024-10-20 19:24:01', '2024-10-21 19:03:47'),
	(183, '2024-07-03', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-07-03', 'Cabut pasang kabel LAN Switch', '9K2Nmf2xPNMqvtenpj4eUdd5AXxVPmwogqPYSxd1.jpg', NULL, '2024-10-20 19:25:03', '2024-10-21 19:03:56'),
	(184, '2024-07-09', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Sukma', 1, 1, 'TIM IT', 'Selesai', '2024-07-09', 'Kabel LAN kemungkinan putus diganti dongle WIFI', 'rQC6SI2Aj0jue8vzyRGLsIRBCSA5HvJfOEcTglWO.jpg', NULL, '2024-10-20 19:26:04', '2024-10-20 19:28:50'),
	(185, '2024-07-09', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-07-09', 'Cabut pasang kabel LAN Switch', 'Kq7Ua4bWgBOCdKn9RblLMeVt2FGIpNtIKcdzak2F.jpg', NULL, '2024-10-20 19:27:07', '2024-10-21 19:04:04'),
	(186, '2024-07-12', 'Rendah', 'Hardware', 'Printer tidak menyala', 'Mala', 1, 16, 'TIM IT', 'Selesai', '2024-07-12', 'Colokan kabel stop kontak longgar', 'hLZ7d7WcosPmJ661037sXru46RWihQvEfUjd6aqn.jpg', NULL, '2024-10-20 19:28:34', '2024-10-21 19:04:15'),
	(187, '2024-07-16', 'Menengah', 'Hardware', 'SSD tidak terdeteksi', 'Erisa', 1, 4, 'TIM IT', 'Selesai', '2024-07-16', 'Ganti kabel SATA', 'DCIjH4beGkPp4inwICBtX516nnt3aEoJJGhUpT6i.jpg', NULL, '2024-10-20 19:32:37', '2024-10-21 19:04:36'),
	(188, '2024-07-18', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-07-18', 'Cabut pasang kabel LAN Switch', 'LEw6v2v8b5BSl5F1fr8u10G4jZJ65mdQ1ooinfGy.jpg', NULL, '2024-10-20 19:33:54', '2024-10-21 19:04:42'),
	(189, '2024-07-22', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-07-22', 'Cabut pasang kabel LAN Switch', '8Tlrb6HByvqFpTrps0rUGaErdeZmb5nAi1ltWXX3.jpg', NULL, '2024-10-20 19:34:59', '2024-10-21 19:04:48'),
	(190, '2024-07-22', 'Rendah', 'Hardware', 'Printer tidak menyala', 'Bambang', 1, 9, 'TIM IT', 'Selesai', '2024-07-22', 'Kabel power printer longgar', 'Czv2OWL05co4ANMNzXcpMHp7i6dotvJh62SOK8Ux.jpg', NULL, '2024-10-20 19:36:12', '2024-10-21 19:04:54'),
	(191, '2024-07-24', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Genta', 1, 8, 'Service Printer', 'Selesai', '2024-07-26', 'Diserahkan ke service printer', 'ECcEvYnbLsF3fHPfR9JIAT9P2uTOXu1Uool00Urv.jpg', NULL, '2024-10-20 19:37:48', '2024-10-21 19:05:05'),
	(192, '2024-07-26', 'Rendah', 'Hardware', 'Printer tidak dapat menarik kertas', 'Siska', 1, 6, 'Service Printer', 'Selesai', '2024-07-29', 'Diserahkan ke service printer', 'sh2eNadcqhUItubCMK1xOMmecI1Y6KFGirFNd6px.jpg', NULL, '2024-10-20 19:39:09', '2024-10-21 19:05:12'),
	(193, '2024-08-02', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Gita', 1, 5, 'TIM IT', 'Selesai', '2024-08-02', 'Cabut pasang kabel socket kabel LAN', '0VoPnvGj7Ze8Vi95YRZZpVtyLVkaSHGEWukq0tAX.jpg', NULL, '2024-10-20 19:40:43', '2024-10-21 19:05:37'),
	(194, '2024-08-06', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Erisa', 1, 4, 'TIM IT', 'Selesai', '2024-08-06', 'Dilakukan head cleaning', 'aaaEqPJsi5PKh9mTtoT2Nr4bDy6UM06ONHFD9pX4.jpg', NULL, '2024-10-20 19:41:36', '2024-10-21 19:06:04'),
	(195, '2024-08-08', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Lila', 1, 15, 'TIM IT', 'Selesai', '2024-08-08', 'Dilakukan head cleaning', 'RZP7lgguEoYUtMLkzH0ew6kmrbl9aYoNVFRBjEX4.jpg', NULL, '2024-10-20 19:43:24', '2024-10-21 19:06:31'),
	(196, '2024-08-15', 'Rendah', 'Hardware', 'Printer ink pad end of its service life', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-08-15', 'Reset Epson dengan software Epson Resetter', 'E5JLNybyvkk8YI1HntRjZN2wLGpwpfi2SiBdJMI1.jpg', NULL, '2024-10-20 19:44:44', '2024-10-21 19:06:40'),
	(197, '2024-08-27', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-08-27', 'Reboot modem biznet', 'pyie8Ih7GbpDsoLMtK6rvQx3tZgBJAJKKPSC2M0J.jpg', NULL, '2024-10-20 19:46:20', '2024-10-21 19:06:55'),
	(198, '2024-08-29', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-08-29', 'Reboot modem biznet', 'vRvTTSQIpS4GKHZctAw75RzxHJ2xKiydyz1F927A.jpg', NULL, '2024-10-20 19:47:33', '2024-10-21 19:07:00'),
	(199, '2024-09-02', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-09-02', 'Reboot modem biznet', 'lhUr6PdCZqhusabdpsdxse6oJGsWAnOiMMEhMDzm.jpg', NULL, '2024-10-20 19:48:19', '2024-10-21 19:07:06'),
	(200, '2024-09-02', 'Rendah', 'Hardware', 'Hasil cetak printer putus-putus', 'Erisa', 1, 4, 'TIM IT', 'Selesai', '2024-09-02', 'Dilakukan head cleaning', 'UtlfuTGp9aJcgIg8MedqDLIUtQa1vsKxtROEGswH.jpg', NULL, '2024-10-20 19:49:24', '2024-10-21 19:07:11'),
	(201, '2024-09-05', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-09-05', 'Cabut pasang kabel LAN Switch', 'BpTAZPuusizw7qbAlmrPvOMHFzne0QvFY5TbRWrH.jpg', NULL, '2024-10-20 19:50:45', '2024-10-21 19:07:21'),
	(202, '2024-09-09', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-09-09', 'Cabut pasang kabel LAN Switch', 'v26DPxyNuHoPcZTTA2Ikr3TMWCnuebX1kXmIWpgq.jpg', NULL, '2024-10-20 20:12:36', '2024-10-21 19:07:28'),
	(203, '2024-09-19', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Gita', 1, 5, 'TIM IT', 'Selesai', '2024-09-19', 'Ganti kabel LAN', 'AdfBjpa8C2hSoGW7DNbLfy0yDdTZIA72zWkf8wGZ.jpg', NULL, '2024-10-20 20:13:27', '2024-10-21 19:07:38'),
	(204, '2024-09-18', 'Rendah', 'Hardware', 'Scanner printer kadang error', 'Erisa', 1, 4, 'Service Printer', 'Selesai', '2024-09-20', 'Diserahkan ke service printer', 'sllBIdvkFq69tpen4tBL9vw0xOCIg5xwR6TIFcl8.jpg', NULL, '2024-10-20 20:14:42', '2024-10-21 19:07:44'),
	(205, '2024-09-24', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Ilham', 1, 8, 'TIM IT', 'Selesai', '2024-09-24', 'Cabut pasang kabel LAN Switch', 'ktT9g9I52zEhO3DicXHwoxo9r2l6GB2ay82Civgi.jpg', NULL, '2024-10-20 20:15:30', '2024-10-21 19:07:52'),
	(206, '2024-09-26', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Didik', 1, 8, 'TIM IT', 'Selesai', '2024-09-26', 'Cabut pasang kabel LAN Switch', 'WCblWRv3STd0fgw17v0NcvOoRpY714ninrhlfOKe.jpg', NULL, '2024-10-20 20:16:01', '2024-10-21 19:08:06'),
	(207, '2024-09-27', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-09-27', 'Reboot modem biznet', 'WP5UtOOZQnY3OdbyKXChuy6TBiFt0wmigbjAJRAr.jpg', NULL, '2024-10-20 20:17:44', '2024-10-21 19:08:12'),
	(208, '2024-10-01', 'Rendah', 'Hardware', 'Printer Macet', 'Aris', 1, 9, 'TIM IT', 'Selesai', '2024-10-01', 'Bongkar printer dan melepaskan kertas yang masih nyangkut', '2FpoR7qxjrX6MDQKnyIOevFmUITkxWgdaadR3bHt.jpg', NULL, '2024-10-20 20:18:52', '2024-10-21 19:08:18'),
	(209, '2024-10-08', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Siska', 1, 6, 'TIM IT', 'Selesai', '2024-10-08', 'Cabut pasang kabel LAN Switch', 'zW6vqOBQlRHWEWpp6dalyxVkMln9gdOJuH7clSRV.jpg', NULL, '2024-10-20 20:19:42', '2024-10-21 19:08:25'),
	(210, '2024-10-09', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Iyan', 1, 2, 'TIM IT', 'Selesai', '2024-10-09', 'Cabut pasang kabel LAN Switch', '4IUVrlwZ0OoFg9YxpVwzQJ4t02sfw5QzvU5X1nBj.jpg', NULL, '2024-10-20 20:20:18', '2024-10-21 19:08:30'),
	(211, '2024-10-15', 'Rendah', 'Hardware', 'Printer ink pad end of its service life', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-10-15', 'Reset Epson dengan software Epson Resetter', 'j1p2pfuRqy3XwCjwOfia8JDWwXKAwWLeBX6jzvFz.jpg', NULL, '2024-10-20 20:20:49', '2024-10-27 18:13:33'),
	(212, '2024-10-17', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Iyan', 1, 2, 'TIM IT', 'Selesai', '2024-10-17', 'Cabut pasang kabel LAN Switch', 'CIOaPzaKtHUZV164ur3I2SAnWiwP8yfjttlWrtU0.jpg', NULL, '2024-10-20 20:21:14', '2024-10-21 18:30:57'),
	(215, '2024-11-26', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-11-26', 'Reboot modem biznet', 's5j6jc7n39bCH7KElbLUShHn1qRuOJGEaQtXjXQG.jpg', NULL, '2024-10-24 18:39:19', '2024-11-26 01:31:36'),
	(222, '2024-10-30', 'Rendah', 'Hardware', 'Warna printer tidak sama', 'Bambang', 1, 9, 'TIM IT', 'Selesai', '2024-10-30', 'Dilakukan power cleaning', '6M4NPSVbZ2zXPGUz8IqpBKitVILvvyjCeqoqjEjd.jpg', NULL, '2024-10-29 19:36:50', '2024-10-29 19:36:51'),
	(223, '2024-10-30', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Siska', 1, 6, 'TIM IT', 'Selesai', '2024-10-30', 'Cabut pasang kabel LAN switch', 'tXeC0Nn5Iyv3dLGb60vMDenhspZEunGjJcuktfc9.jpg', NULL, '2024-10-29 22:21:52', '2024-10-29 22:21:52'),
	(224, '2024-11-01', 'Rendah', 'Lain-lain', 'Format Flashdisk berubah menjadi RAW', 'Yahya', 1, 8, 'TIM IT', 'Selesai', '2024-11-01', 'Buka cmd as administrator, chdsk /f E:', 'uMzG3zpIU3irWtADE0KIvyRHcNavtWgKfQY6bBmd.png', NULL, '2024-10-31 19:01:24', '2024-10-31 19:01:25'),
	(226, '2024-11-04', 'Rendah', 'Software', 'Muncul pop up add your microsoft account', 'Delia', 1, 6, 'TIM IT', 'Selesai', '2024-11-04', 'Restart komputer', 'LwECzhcbSpWGu5KE5R0fBkQuJ9AW0TmXRXrRLn8d.jpg', NULL, '2024-11-03 18:59:53', '2024-11-03 20:28:09'),
	(239, '2024-11-12', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-11-12', 'Reboot modem biznet', '1731406677_s5j6jc7n39bCH7KElbLUShHn1qRuOJGEaQtXjXQG.jpg', NULL, '2024-11-12 10:17:57', '2024-11-12 10:17:57'),
	(240, '2024-11-12', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-11-12', 'Cabut pasang kabel LAN Switch', '1731406736_4IUVrlwZ0OoFg9YxpVwzQJ4t02sfw5QzvU5X1nBj.jpg', NULL, '2024-11-12 10:18:56', '2024-11-12 10:18:56'),
	(241, '2024-11-13', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Genta', 1, 8, 'TIM IT', 'Selesai', '2024-11-13', 'Cabut pasang kabel LAN Switch', '1731470774_1731406736_4IUVrlwZ0OoFg9YxpVwzQJ4t02sfw5QzvU5X1nBj.jpg', NULL, '2024-11-13 04:06:14', '2024-11-20 12:02:04'),
	(247, '2024-11-13', 'Rendah', 'Hardware', 'Printer end of life service', 'Mila', 1, 14, 'TIM IT', 'Selesai', '2024-11-13', 'Dilakukan reset printer dengan epson l220 resetter', '1731547376_WhatsApp Image 2024-11-14 at 08.21.15_8028a687.jpg', NULL, '2024-11-14 01:22:56', '2024-11-14 01:22:57'),
	(248, '2024-11-22', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Didik', 1, 8, 'TIM IT', 'Selesai', '2024-11-22', 'Ganti konektor RJ45 pada uplink switch', '1732247795_1731470774_1731406736_4IUVrlwZ0OoFg9YxpVwzQJ4t02sfw5QzvU5X1nBj.jpg', NULL, '2024-11-22 03:56:17', '2024-11-22 03:56:36'),
	(249, '2024-10-24', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Fahmi', 1, 11, 'TIM IT', 'Selesai', '2024-10-24', 'Reboot modem biznet', '1732584676_Reboot Modem Biznet.jpg', NULL, '2024-11-26 01:31:16', '2024-11-26 01:31:16'),
	(250, '2024-11-28', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Dian', 1, 6, 'TIM IT', 'Selesai', '2024-11-28', 'Kabel LAN longgar, cabut pasang kabel lagi', '1732756522_20241128_080959.jpg', NULL, '2024-11-28 01:15:22', '2024-11-28 01:15:23'),
	(251, '2024-11-29', 'Menengah', 'Jaringan', 'Internet tidak terhubung', 'Dian', 1, 6, 'TIM IT', 'Selesai', '2024-11-29', 'Kabel LAN longgar, cabut pasang kabel lagi', '1732842843_1732756522_20241128_080959.jpg', NULL, '2024-11-29 01:13:36', '2024-11-29 01:14:04');

-- Dumping structure for table sitelbdb.maintenance_hardware
CREATE TABLE IF NOT EXISTS `maintenance_hardware` (
  `id_maintenance_hardware` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori_maintenance_hardware` int unsigned NOT NULL,
  `tanggal_maintenance_hardware` date NOT NULL,
  `kondisi_maintenance_hardware` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_maintenance_hardware` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kantor` int unsigned NOT NULL,
  `dicek_oleh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan_maintenance_hardware` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_maintenance_hardware`),
  KEY `maintenance_hardware_id_kategori_maintenance_hardware_foreign` (`id_kategori_maintenance_hardware`),
  KEY `maintenance_hardware_id_kantor_foreign` (`id_kantor`),
  CONSTRAINT `maintenance_hardware_id_kantor_foreign` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`),
  CONSTRAINT `maintenance_hardware_id_kategori_maintenance_hardware_foreign` FOREIGN KEY (`id_kategori_maintenance_hardware`) REFERENCES `kategori_maintenance_hardware` (`id_kategori_maintenance_hardware`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.maintenance_hardware: ~0 rows (approximately)
INSERT INTO `maintenance_hardware` (`id_maintenance_hardware`, `id_kategori_maintenance_hardware`, `tanggal_maintenance_hardware`, `kondisi_maintenance_hardware`, `keterangan_maintenance_hardware`, `id_kantor`, `dicek_oleh`, `keterangan_tambahan_maintenance_hardware`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(33, 12, '2024-11-19', 'Cukup Optimal', 'EFA', 2, 'dfgs', 'degsf', '1731391610_openWebsite.png,1731391610_pdnob.png', '2024-11-12 06:06:37', '2024-11-12 06:06:50');

-- Dumping structure for table sitelbdb.maintenance_server
CREATE TABLE IF NOT EXISTS `maintenance_server` (
  `id_maintenance_server` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori_maintenance_server` int unsigned NOT NULL,
  `tanggal_maintenance_server` date NOT NULL,
  `kondisi_maintenance_server` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_maintenance_server` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kantor` int unsigned NOT NULL,
  `dicek_oleh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan_maintenance_server` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_maintenance_server`),
  KEY `maintenance_server_id_kategori_maintenance_server_foreign` (`id_kategori_maintenance_server`),
  KEY `maintenance_server_id_kantor_foreign` (`id_kantor`),
  CONSTRAINT `maintenance_server_id_kantor_foreign` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`),
  CONSTRAINT `maintenance_server_id_kategori_maintenance_server_foreign` FOREIGN KEY (`id_kategori_maintenance_server`) REFERENCES `kategori_maintenance_server` (`id_kategori_maintenance_server`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.maintenance_server: ~0 rows (approximately)
INSERT INTO `maintenance_server` (`id_maintenance_server`, `id_kategori_maintenance_server`, `tanggal_maintenance_server`, `kondisi_maintenance_server`, `keterangan_maintenance_server`, `id_kantor`, `dicek_oleh`, `keterangan_tambahan_maintenance_server`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(8, 2, '2024-11-24', 'Cukup Optimal', 'dfgs', 2, 'dgs', 'we', '1731391470_OCR.png,1731391470_openFile.png', '2024-11-12 06:04:18', '2024-11-12 06:04:30');

-- Dumping structure for table sitelbdb.maintenance_software
CREATE TABLE IF NOT EXISTS `maintenance_software` (
  `id_maintenance_software` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori_maintenance_software` int unsigned NOT NULL,
  `tanggal_maintenance_software` date NOT NULL,
  `kondisi_maintenance_software` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_maintenance_software` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kantor` int unsigned NOT NULL,
  `dicek_oleh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan_maintenance_software` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_maintenance_software`),
  KEY `maintenance_software_id_kategori_maintenance_software_foreign` (`id_kategori_maintenance_software`),
  KEY `maintenance_software_id_kantor_foreign` (`id_kantor`),
  CONSTRAINT `maintenance_software_id_kantor_foreign` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`),
  CONSTRAINT `maintenance_software_id_kategori_maintenance_software_foreign` FOREIGN KEY (`id_kategori_maintenance_software`) REFERENCES `kategori_maintenance_software` (`id_kategori_maintenance_software`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.maintenance_software: ~0 rows (approximately)
INSERT INTO `maintenance_software` (`id_maintenance_software`, `id_kategori_maintenance_software`, `tanggal_maintenance_software`, `kondisi_maintenance_software`, `keterangan_maintenance_software`, `id_kantor`, `dicek_oleh`, `keterangan_tambahan_maintenance_software`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(12, 2, '2024-11-25', 'Cukup Optimal', 'efe', 2, 'dqw', NULL, '1731391330_registerPage.png,1731391330_runCmd.png', '2024-11-12 06:01:56', '2024-11-12 06:02:10');

-- Dumping structure for table sitelbdb.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.migrations: ~24 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_07_02_073111_create_permission_tables', 2),
	(5, '2024_10_15_015800_buat_backup_recovery_table', 3),
	(6, '2024_10_15_042337_buat_kategori_backup_recovery', 4),
	(7, '2024_10_21_072006_buat_unit_bagian_table', 5),
	(18, '2024_10_22_023809_buat_rekomendasi_table', 6),
	(19, '2024_10_28_023301_buat_vendor_table', 7),
	(20, '2024_10_28_023435_buat_evaluasi_kinerja_sistem_table', 8),
	(22, '2024_10_29_014826_buat_pengecekan_unit_bagian_table', 9),
	(26, '2024_10_29_082649_buat_kategori_sistem_pengembagan_table', 10),
	(27, '2024_11_08_025140_buat_pelaporan_keuangan_table', 11),
	(30, '2024_11_08_073709_buat_pelaporan_isidentil_table', 12),
	(31, '2024_11_21_105357_buat_pelaporan_pemkab_table', 13),
	(32, '2024_11_22_085738_buat_pelaporan_ojk_table', 14),
	(33, '2024_11_22_151723_buat_pelaporan_lps_table', 15),
	(34, '2024_11_25_151714_buat_pelaporan_ppatk_table', 16),
	(35, '2024_11_25_155651_buat_pelaporan_dirjen_pajak_table', 17),
	(36, '2024_11_26_084626_buat_pelaporan_bpjs_table', 18),
	(37, '2024_11_26_091049_buat_pelaporan_dukcapil_perbarindo_table', 19),
	(39, '2024_11_26_101006_buat_kategori_kredit_table', 20),
	(40, '2024_11_26_112855_buat_kategori_produk_dana_table', 21),
	(41, '2024_11_26_114815_buat_kategori_produk_mobile_banking_table', 22),
	(43, '2024_11_26_135447_buat_tentang_sitelbdb_table', 23);

-- Dumping structure for table sitelbdb.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table sitelbdb.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.model_has_roles: ~4 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 5),
	(2, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 7),
	(23, 'App\\Models\\User', 9);

-- Dumping structure for table sitelbdb.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table sitelbdb.pelaporan_bpjs
CREATE TABLE IF NOT EXISTS `pelaporan_bpjs` (
  `id_pelaporan_bpjs` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_bpjs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan_isidentil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_bpjs`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_bpjs: ~0 rows (approximately)
INSERT INTO `pelaporan_bpjs` (`id_pelaporan_bpjs`, `tanggal_input_data`, `periode_tahun`, `jenis_bpjs`, `jenis_periode`, `nama_laporan`, `nama_laporan_isidentil`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(1, '2024-11-22', '2024', 'Kesehatan', 'Isidentil', 'Iuran BPJS Kesehatan', 'erw', '1732586493_Perbandingan Samsung Galaxy Tab S9 FE 5G.pdf', '2024-11-26 02:00:48', '2024-11-26 02:01:33');

-- Dumping structure for table sitelbdb.pelaporan_dirjen_pajak
CREATE TABLE IF NOT EXISTS `pelaporan_dirjen_pajak` (
  `id_pelaporan_dirjen_pajak` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan_isidentil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_dirjen_pajak`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_dirjen_pajak: ~0 rows (approximately)
INSERT INTO `pelaporan_dirjen_pajak` (`id_pelaporan_dirjen_pajak`, `tanggal_input_data`, `periode_tahun`, `jenis_periode`, `nama_laporan`, `nama_laporan_isidentil`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(3, '2024-11-20', '2025', 'Bulanan', 'Pembayaran PPh 23 (Masa) - Jenis Masa', NULL, '1732525812_Perbandingan Samsung Galaxy Tab S9 FE 5G.pdf', '2024-11-25 09:10:12', '2024-11-25 09:10:12');

-- Dumping structure for table sitelbdb.pelaporan_dukcapil_perbarindo
CREATE TABLE IF NOT EXISTS `pelaporan_dukcapil_perbarindo` (
  `id_pelaporan_dukcapil_perbarindo` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan_isidentil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_dukcapil_perbarindo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_dukcapil_perbarindo: ~0 rows (approximately)
INSERT INTO `pelaporan_dukcapil_perbarindo` (`id_pelaporan_dukcapil_perbarindo`, `tanggal_input_data`, `periode_tahun`, `jenis_periode`, `nama_laporan`, `nama_laporan_isidentil`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(1, '2024-11-21', '2025', 'Bulanan', 'Laporan Data Balikan ke DUKCAPIL kirim Email', 'erw', '1732587538_Perbandingan UPS APC.pdf', '2024-11-26 02:18:37', '2024-11-26 02:18:58');

-- Dumping structure for table sitelbdb.pelaporan_isidentil
CREATE TABLE IF NOT EXISTS `pelaporan_isidentil` (
  `id_pelaporan_isidentil` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `jenis_pelaporan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pihak_menerima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal_laporan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_pendukung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_isidentil`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_isidentil: ~0 rows (approximately)
INSERT INTO `pelaporan_isidentil` (`id_pelaporan_isidentil`, `tanggal_input_data`, `jenis_pelaporan`, `pihak_menerima`, `perihal_laporan`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(62, '2024-11-26', 'EKSTERNAL', 'adfsfgh', 'sdf', '1731375150_Perbandingan Samsung Galaxy Tab S9 FE 5G.pdf', '2024-11-11 09:46:34', '2024-11-12 01:32:30');

-- Dumping structure for table sitelbdb.pelaporan_keuangan
CREATE TABLE IF NOT EXISTS `pelaporan_keuangan` (
  `id_pelaporan_keuangan` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_bulan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kredit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penempatan_bank_lain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabungan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposito` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendapatan_operasional` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendapatan_non_operasional` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_operasional` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_non_operasional` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laba_sebelum_pajak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pajak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laba_setelah_pajak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kpmm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ppap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ldr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bopo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posisi_keuangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laba_rugi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kualitas_aset_produktif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_keuangan`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_keuangan: ~0 rows (approximately)
INSERT INTO `pelaporan_keuangan` (`id_pelaporan_keuangan`, `tanggal_input_data`, `periode_tahun`, `periode_bulan`, `asset`, `kredit`, `penempatan_bank_lain`, `tabungan`, `deposito`, `pendapatan_operasional`, `pendapatan_non_operasional`, `biaya_operasional`, `biaya_non_operasional`, `laba_sebelum_pajak`, `pajak`, `laba_setelah_pajak`, `kap`, `kpmm`, `npl`, `ppap`, `ldr`, `roa`, `roe`, `bopo`, `nim`, `cr`, `posisi_keuangan`, `laba_rugi`, `kualitas_aset_produktif`, `created_at`, `updated_at`) VALUES
	(19, '2024-11-14', '2027', 'Januari', 'adf', 'adfs', 'murah', 'efqw', 'murah', 'hkeo;id', 'lgiuk', 'hiou', 'liubg', 'murah', 'liuh', '08u', '21%', '22%', '3%', '4%', '6%', '3%', '4%', '5%', '23%', '4%', '1731375084_Perbandingan Samsung Galaxy Tab S9 FE 5G.pdf', '1731375116_Perbandingan UPS APC.pdf', '1731375059_Perbandingan UPS APC.pdf', '2024-11-12 01:30:59', '2024-11-25 01:39:29');

-- Dumping structure for table sitelbdb.pelaporan_lps
CREATE TABLE IF NOT EXISTS `pelaporan_lps` (
  `id_pelaporan_lps` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan_isidentil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_lps`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_lps: ~1 rows (approximately)
INSERT INTO `pelaporan_lps` (`id_pelaporan_lps`, `tanggal_input_data`, `periode_tahun`, `jenis_periode`, `nama_laporan`, `nama_laporan_isidentil`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(3, '2024-11-19', '2025', 'Semester', 'Laporan Pembayaran Premi', NULL, '1732509948_Perbandingan UPS APC.pdf', '2024-11-25 04:45:48', '2024-11-25 08:26:31');

-- Dumping structure for table sitelbdb.pelaporan_ojk
CREATE TABLE IF NOT EXISTS `pelaporan_ojk` (
  `id_pelaporan_ojk` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan_isidentil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_ojk`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_ojk: ~1 rows (approximately)
INSERT INTO `pelaporan_ojk` (`id_pelaporan_ojk`, `tanggal_input_data`, `periode_tahun`, `jenis_periode`, `nama_laporan`, `nama_laporan_isidentil`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(11, '2024-11-21', '2024', 'Semester', 'Laporan Pelaksanaan dan Pengawasan Rencana Bisnis Bank (RBB)', NULL, '1732508680_Perbandingan UPS APC.pdf', '2024-11-25 04:24:40', '2024-11-25 04:24:56');

-- Dumping structure for table sitelbdb.pelaporan_pemkab
CREATE TABLE IF NOT EXISTS `pelaporan_pemkab` (
  `id_pelaporan_pemkab` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan_isidentil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instansi_dilaporkan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_pemkab`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_pemkab: ~1 rows (approximately)
INSERT INTO `pelaporan_pemkab` (`id_pelaporan_pemkab`, `tanggal_input_data`, `periode_tahun`, `jenis_periode`, `nama_laporan`, `nama_laporan_isidentil`, `instansi_dilaporkan`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(27, '2024-11-21', '2025', 'Triwulan', 'Laporan Triwulan ke Pemkab', 'erw', 'dgsfb', '1732501438_Perbandingan UPS APC.pdf', '2024-11-25 02:23:59', '2024-11-25 04:33:47');

-- Dumping structure for table sitelbdb.pelaporan_ppatk
CREATE TABLE IF NOT EXISTS `pelaporan_ppatk` (
  `id_pelaporan_ppatk` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_input_data` date NOT NULL,
  `periode_tahun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_periode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_laporan_isidentil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_pendukung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelaporan_ppatk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pelaporan_ppatk: ~1 rows (approximately)
INSERT INTO `pelaporan_ppatk` (`id_pelaporan_ppatk`, `tanggal_input_data`, `periode_tahun`, `jenis_periode`, `nama_laporan`, `nama_laporan_isidentil`, `dokumen_pendukung`, `created_at`, `updated_at`) VALUES
	(3, '2024-11-19', '2025', 'Triwulan', 'Laporan Sipesat Triwulan IV', NULL, '1732524847_Perbandingan UPS APC.pdf', '2024-11-25 08:54:07', '2024-11-25 08:55:20');

-- Dumping structure for table sitelbdb.pengecekan_suhu
CREATE TABLE IF NOT EXISTS `pengecekan_suhu` (
  `id_pengecekan_suhu` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_pengecekan_suhu` date NOT NULL,
  `suhu_pagi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_pagi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_tambahan_pagi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dicek_oleh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu_sore` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_sore` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesimpulan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_tambahan_sore` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengecekan_suhu`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pengecekan_suhu: ~0 rows (approximately)
INSERT INTO `pengecekan_suhu` (`id_pengecekan_suhu`, `tanggal_pengecekan_suhu`, `suhu_pagi`, `kondisi_pagi`, `keterangan_tambahan_pagi`, `dicek_oleh`, `suhu_sore`, `kondisi_sore`, `kesimpulan`, `keterangan_tambahan_sore`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(15, '2024-11-12', '22', 'Normal', 'dfs', 'TIM IT', '22', 'Normal', 'Keadaan Normal', 'dfs', '1731391193_actionLibrary.png,1731391193_buyNow.png', '2024-11-12 05:59:37', '2024-11-12 05:59:53');

-- Dumping structure for table sitelbdb.pengecekan_unit_bagian
CREATE TABLE IF NOT EXISTS `pengecekan_unit_bagian` (
  `id_pengecekan_unit_bagian` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kantor` int unsigned NOT NULL,
  `id_unit_bagian` int unsigned NOT NULL,
  `tanggal_pengecekan_unit_bagian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `komputer_laptop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `printer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `scan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jaringan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesin_hitung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `windows` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `microsoft_office` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `antivirus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cbs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cek_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dvr_mikrotik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengecekan_unit_bagian`),
  KEY `pengecekan_unit_bagian_id_kantor_foreign` (`id_kantor`),
  KEY `pengecekan_unit_bagian_id_unit_bagian_foreign` (`id_unit_bagian`),
  CONSTRAINT `pengecekan_unit_bagian_id_kantor_foreign` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`),
  CONSTRAINT `pengecekan_unit_bagian_id_unit_bagian_foreign` FOREIGN KEY (`id_unit_bagian`) REFERENCES `unit_bagian` (`id_unit_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.pengecekan_unit_bagian: ~0 rows (approximately)
INSERT INTO `pengecekan_unit_bagian` (`id_pengecekan_unit_bagian`, `id_kantor`, `id_unit_bagian`, `tanggal_pengecekan_unit_bagian`, `komputer_laptop`, `printer`, `scan`, `jaringan`, `mesin_hitung`, `windows`, `microsoft_office`, `antivirus`, `browser`, `cbs`, `cek_ktp`, `dvr_mikrotik`, `keterangan_tambahan`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(4, 2, 3, '2024-11-21', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'Optimal', 'adsf', '1731384012_homePage.png', '2024-11-12 03:57:32', '2024-11-12 04:00:12');

-- Dumping structure for table sitelbdb.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.permissions: ~135 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(108, 'view_kendala', 'web', '2024-09-29 21:13:29', '2024-09-29 21:15:10'),
	(109, 'create_kendala', 'web', '2024-09-29 21:14:01', '2024-09-29 21:14:01'),
	(110, 'read_kendala', 'web', '2024-09-29 21:14:09', '2024-09-29 21:14:09'),
	(111, 'update_kendala', 'web', '2024-09-29 21:14:13', '2024-09-29 21:14:13'),
	(112, 'delete_kendala', 'web', '2024-09-29 21:14:18', '2024-09-29 21:14:18'),
	(114, 'view_maintenance_hardware', 'web', '2024-09-29 21:17:55', '2024-09-29 21:17:55'),
	(115, 'create_maintenance_hardware', 'web', '2024-09-29 21:17:59', '2024-09-29 21:17:59'),
	(116, 'read_maintenance_hardware', 'web', '2024-09-29 21:18:03', '2024-09-29 21:18:03'),
	(117, 'update_maintenance_hardware', 'web', '2024-09-29 21:18:07', '2024-09-29 21:18:07'),
	(118, 'delete_maintenance_hardware', 'web', '2024-09-29 21:18:11', '2024-09-29 21:18:11'),
	(119, 'kategori_maintenance_hardware', 'web', '2024-09-29 21:18:15', '2024-09-29 21:18:15'),
	(120, 'view_maintenance_software', 'web', '2024-09-29 21:18:50', '2024-09-29 21:18:50'),
	(121, 'create_maintenance_software', 'web', '2024-09-29 21:18:53', '2024-09-29 21:18:53'),
	(122, 'read_maintenance_software', 'web', '2024-09-29 21:18:57', '2024-09-29 21:18:57'),
	(123, 'update_maintenance_software', 'web', '2024-09-29 21:19:00', '2024-09-29 21:19:00'),
	(124, 'delete_maintenance_software', 'web', '2024-09-29 21:19:05', '2024-09-29 21:19:05'),
	(125, 'kategori_maintenance_software', 'web', '2024-09-29 21:19:09', '2024-09-29 21:19:09'),
	(126, 'view_maintenance_server', 'web', '2024-09-29 21:19:13', '2024-09-29 21:19:13'),
	(127, 'create_maintenance_server', 'web', '2024-09-29 21:19:17', '2024-09-29 21:19:17'),
	(128, 'read_maintenance_server', 'web', '2024-09-29 21:19:22', '2024-09-29 21:19:22'),
	(129, 'update_maintenance_server', 'web', '2024-09-29 21:19:26', '2024-09-29 21:19:26'),
	(130, 'delete_maintenance_server', 'web', '2024-09-29 21:19:30', '2024-09-29 21:19:30'),
	(131, 'kategori_maintenance_server', 'web', '2024-09-29 21:19:33', '2024-09-29 21:19:33'),
	(132, 'view_pengecekan_suhu', 'web', '2024-09-29 21:19:38', '2024-09-29 21:19:38'),
	(133, 'create_pengecekan_suhu', 'web', '2024-09-29 21:19:41', '2024-09-29 21:19:41'),
	(134, 'read_pengecekan_suhu', 'web', '2024-09-29 21:19:44', '2024-09-29 21:19:44'),
	(135, 'update_pengecekan_suhu', 'web', '2024-09-29 21:19:49', '2024-09-29 21:19:49'),
	(136, 'delete_pengecekan_suhu', 'web', '2024-09-29 21:19:52', '2024-09-29 21:19:52'),
	(137, 'view_register_ruang_server', 'web', '2024-09-29 21:19:56', '2024-09-29 21:19:56'),
	(138, 'create_register_ruang_server', 'web', '2024-09-29 21:20:00', '2024-09-29 21:20:00'),
	(139, 'read_register_ruang_server', 'web', '2024-09-29 21:20:03', '2024-09-29 21:20:03'),
	(140, 'update_register_ruang_server', 'web', '2024-09-29 21:20:07', '2024-09-29 21:20:07'),
	(141, 'delete_register_ruang_server', 'web', '2024-09-29 21:20:13', '2024-09-29 21:20:13'),
	(142, 'view_kantor', 'web', '2024-09-29 21:20:19', '2024-09-29 21:20:19'),
	(143, 'create_kantor', 'web', '2024-09-29 21:20:23', '2024-09-29 21:20:23'),
	(144, 'read_kantor', 'web', '2024-09-29 21:20:27', '2024-09-29 21:20:27'),
	(145, 'update_kantor', 'web', '2024-09-29 21:20:30', '2024-09-29 21:20:30'),
	(146, 'delete_kantor', 'web', '2024-09-29 21:20:34', '2024-09-29 21:20:34'),
	(147, 'view_management_user', 'web', '2024-09-29 21:20:38', '2024-09-29 21:20:38'),
	(148, 'create_management_user', 'web', '2024-09-29 21:20:41', '2024-09-29 21:20:41'),
	(149, 'read_management_user', 'web', '2024-09-29 21:20:45', '2024-09-29 21:20:45'),
	(150, 'update_management_user', 'web', '2024-09-29 21:20:49', '2024-09-29 21:20:49'),
	(151, 'delete_management_user', 'web', '2024-09-29 21:20:53', '2024-09-29 21:20:53'),
	(155, 'view_backup', 'web', '2024-10-17 03:16:38', '2024-10-17 03:16:38'),
	(156, 'create_backup', 'web', '2024-10-17 03:16:46', '2024-10-17 03:16:46'),
	(157, 'read_backup', 'web', '2024-10-17 03:16:53', '2024-10-17 03:16:53'),
	(158, 'update_backup', 'web', '2024-10-17 03:16:59', '2024-10-17 03:16:59'),
	(159, 'delete_backup', 'web', '2024-10-17 03:17:07', '2024-10-17 03:17:07'),
	(160, 'kategori_backup', 'web', '2024-10-17 03:17:16', '2024-10-17 03:17:16'),
	(162, 'kategori_unit_bagian', 'web', '2024-10-21 19:18:34', '2024-10-21 19:18:34'),
	(163, 'view_rekomendasi', 'web', '2024-10-21 20:51:46', '2024-10-21 20:51:46'),
	(164, 'create_rekomendasi', 'web', '2024-10-21 20:51:54', '2024-10-21 20:51:54'),
	(165, 'read_rekomendasi', 'web', '2024-10-21 20:52:00', '2024-10-21 20:52:00'),
	(166, 'update_rekomendasi', 'web', '2024-10-21 20:52:06', '2024-10-21 20:52:06'),
	(167, 'delete_rekomendasi', 'web', '2024-10-21 20:52:12', '2024-10-21 20:52:12'),
	(168, 'view_evaluasi_kinerja_sistem', 'web', '2024-10-28 00:50:33', '2024-10-28 00:50:33'),
	(169, 'create_evaluasi_kinerja_sistem', 'web', '2024-10-28 00:50:39', '2024-10-28 00:50:39'),
	(170, 'read_evaluasi_kinerja_sistem', 'web', '2024-10-28 00:50:43', '2024-10-28 00:50:43'),
	(171, 'update_evaluasi_kinerja_sistem', 'web', '2024-10-28 00:50:48', '2024-10-28 00:50:48'),
	(172, 'delete_evaluasi_kinerja_sistem', 'web', '2024-10-28 00:50:51', '2024-10-28 00:50:51'),
	(173, 'kategori_evaluasi_kinerja_sistem', 'web', '2024-10-28 00:50:55', '2024-10-28 00:50:55'),
	(174, 'view_pengecekan_unit_bagian', 'web', '2024-10-28 19:45:15', '2024-10-28 19:45:15'),
	(175, 'create_pengecekan_unit_bagian', 'web', '2024-10-28 19:45:19', '2024-10-28 19:45:19'),
	(176, 'read_pengecekan_unit_bagian', 'web', '2024-10-28 19:45:23', '2024-10-28 19:45:23'),
	(177, 'update_pengecekan_unit_bagian', 'web', '2024-10-28 19:45:27', '2024-10-28 19:45:27'),
	(178, 'delete_pengecekan_unit_bagian', 'web', '2024-10-28 19:45:31', '2024-10-28 19:45:31'),
	(182, 'view_sistem_pengembangan', 'web', '2024-11-01 21:30:46', '2024-11-01 21:30:46'),
	(183, 'create_sistem_pengembangan', 'web', '2024-11-01 21:30:51', '2024-11-01 21:30:51'),
	(184, 'read_sistem_pengembangan', 'web', '2024-11-01 21:30:55', '2024-11-01 21:30:55'),
	(185, 'update_sistem_pengembangan', 'web', '2024-11-01 21:30:59', '2024-11-01 21:30:59'),
	(186, 'delete_sistem_pengembangan', 'web', '2024-11-01 21:31:04', '2024-11-01 21:31:04'),
	(187, 'kategori_sistem_pengembangan', 'web', '2024-11-01 21:31:08', '2024-11-01 21:31:08'),
	(188, 'view_pelaporan_keuangan', 'web', '2024-11-08 00:13:44', '2024-11-08 00:13:44'),
	(189, 'create_pelaporan_keuangan', 'web', '2024-11-08 00:13:46', '2024-11-08 00:13:46'),
	(190, 'read_pelaporan_keuangan', 'web', '2024-11-08 00:13:50', '2024-11-08 00:13:50'),
	(191, 'update_pelaporan_keuangan', 'web', '2024-11-08 00:13:53', '2024-11-08 00:13:53'),
	(192, 'delete_pelaporan_keuangan', 'web', '2024-11-08 00:13:57', '2024-11-08 00:13:57'),
	(193, 'view_pelaporan_isidentil', 'web', '2024-11-11 03:38:13', '2024-11-11 03:38:13'),
	(194, 'create_pelaporan_isidentil', 'web', '2024-11-11 03:38:17', '2024-11-11 03:38:17'),
	(195, 'read_pelaporan_isidentil', 'web', '2024-11-11 03:38:20', '2024-11-11 03:38:20'),
	(196, 'update_pelaporan_isidentil', 'web', '2024-11-11 03:38:23', '2024-11-11 03:38:23'),
	(197, 'delete_pelaporan_isidentil', 'web', '2024-11-11 03:38:27', '2024-11-11 03:38:27'),
	(198, 'view_pelaporan_pemkab', 'web', '2024-11-21 05:27:50', '2024-11-21 05:27:50'),
	(199, 'create_pelaporan_pemkab', 'web', '2024-11-21 05:27:54', '2024-11-21 05:27:54'),
	(200, 'read_pelaporan_pemkab', 'web', '2024-11-21 05:27:58', '2024-11-21 05:27:58'),
	(201, 'update_pelaporan_pemkab', 'web', '2024-11-21 05:28:01', '2024-11-21 05:28:01'),
	(202, 'delete_pelaporan_pemkab', 'web', '2024-11-21 05:28:05', '2024-11-21 05:28:05'),
	(203, 'view_pelaporan_ojk', 'web', '2024-11-22 03:41:36', '2024-11-22 03:41:36'),
	(204, 'create_pelaporan_ojk', 'web', '2024-11-22 03:41:39', '2024-11-22 03:41:39'),
	(205, 'read_pelaporan_ojk', 'web', '2024-11-22 03:41:43', '2024-11-22 03:41:43'),
	(206, 'update_pelaporan_ojk', 'web', '2024-11-22 03:41:46', '2024-11-22 03:41:46'),
	(207, 'delete_pelaporan_ojk', 'web', '2024-11-22 03:41:48', '2024-11-22 03:41:48'),
	(208, 'view_pelaporan_lps', 'web', '2024-11-22 08:34:56', '2024-11-22 08:34:56'),
	(209, 'create_pelaporan_lps', 'web', '2024-11-22 08:34:58', '2024-11-22 08:34:58'),
	(210, 'read_pelaporan_lps', 'web', '2024-11-22 08:35:00', '2024-11-22 08:35:00'),
	(211, 'update_pelaporan_lps', 'web', '2024-11-22 08:35:02', '2024-11-22 08:35:02'),
	(212, 'delete_pelaporan_lps', 'web', '2024-11-22 08:35:05', '2024-11-22 08:35:05'),
	(213, 'view_pelaporan_ppatk', 'web', '2024-11-25 08:31:18', '2024-11-25 08:31:18'),
	(214, 'create_pelaporan_ppatk', 'web', '2024-11-25 08:31:20', '2024-11-25 08:31:20'),
	(215, 'read_pelaporan_ppatk', 'web', '2024-11-25 08:31:22', '2024-11-25 08:31:22'),
	(216, 'update_pelaporan_ppatk', 'web', '2024-11-25 08:31:24', '2024-11-25 08:31:24'),
	(217, 'delete_pelaporan_ppatk', 'web', '2024-11-25 08:31:27', '2024-11-25 08:31:27'),
	(218, 'view_pelaporan_dirjen_pajak', 'web', '2024-11-25 09:11:41', '2024-11-25 09:11:41'),
	(219, 'create_pelaporan_dirjen_pajak', 'web', '2024-11-25 09:11:43', '2024-11-25 09:11:43'),
	(220, 'read_pelaporan_dirjen_pajak', 'web', '2024-11-25 09:11:46', '2024-11-25 09:11:46'),
	(221, 'update_pelaporan_dirjen_pajak', 'web', '2024-11-25 09:11:49', '2024-11-25 09:11:49'),
	(222, 'delete_pelaporan_dirjen_pajak', 'web', '2024-11-25 09:11:51', '2024-11-25 09:11:51'),
	(223, 'view_pelaporan_bpjs', 'web', '2024-11-26 02:02:43', '2024-11-26 02:02:43'),
	(224, 'create_pelaporan_bpjs', 'web', '2024-11-26 02:02:45', '2024-11-26 02:02:45'),
	(225, 'read_pelaporan_bpjs', 'web', '2024-11-26 02:02:48', '2024-11-26 02:02:48'),
	(226, 'update_pelaporan_bpjs', 'web', '2024-11-26 02:02:51', '2024-11-26 02:02:51'),
	(227, 'delete_pelaporan_bpjs', 'web', '2024-11-26 02:02:53', '2024-11-26 02:02:53'),
	(228, 'view_pelaporan_dukcapil_perbarindo', 'web', '2024-11-26 02:20:13', '2024-11-26 02:20:13'),
	(229, 'create_pelaporan_dukcapil_perbarindo', 'web', '2024-11-26 02:20:16', '2024-11-26 02:20:16'),
	(230, 'read_pelaporan_dukcapil_perbarindo', 'web', '2024-11-26 02:20:18', '2024-11-26 02:20:18'),
	(231, 'update_pelaporan_dukcapil_perbarindo', 'web', '2024-11-26 02:20:20', '2024-11-26 02:20:20'),
	(232, 'delete_pelaporan_dukcapil_perbarindo', 'web', '2024-11-26 02:20:22', '2024-11-26 02:20:22'),
	(233, 'view_kategori_produk_kredit', 'web', '2024-11-26 04:08:36', '2024-11-26 04:08:36'),
	(234, 'create_kategori_produk_kredit', 'web', '2024-11-26 04:08:38', '2024-11-26 04:08:38'),
	(235, 'read_kategori_produk_kredit', 'web', '2024-11-26 04:08:40', '2024-11-26 04:08:40'),
	(236, 'update_kategori_produk_kredit', 'web', '2024-11-26 04:08:42', '2024-11-26 04:08:42'),
	(237, 'delete_kategori_produk_kredit', 'web', '2024-11-26 04:08:45', '2024-11-26 04:08:45'),
	(238, 'kategori_produk_kredit', 'web', '2024-11-26 04:09:07', '2024-11-26 04:09:07'),
	(239, 'view_kategori_produk_dana', 'web', '2024-11-26 04:39:59', '2024-11-26 04:39:59'),
	(240, 'create_kategori_produk_dana', 'web', '2024-11-26 04:40:02', '2024-11-26 04:40:02'),
	(241, 'read_kategori_produk_dana', 'web', '2024-11-26 04:40:04', '2024-11-26 04:40:04'),
	(242, 'update_kategori_produk_dana', 'web', '2024-11-26 04:40:06', '2024-11-26 04:40:06'),
	(243, 'delete_kategori_produk_dana', 'web', '2024-11-26 04:40:08', '2024-11-26 04:40:08'),
	(244, 'kategori_produk_dana', 'web', '2024-11-26 04:40:12', '2024-11-26 04:40:12'),
	(245, 'view_kategori_produk_mobile_banking', 'web', '2024-11-26 05:05:41', '2024-11-26 05:05:41'),
	(246, 'create_kategori_produk_mobile_banking', 'web', '2024-11-26 05:05:44', '2024-11-26 05:05:44'),
	(247, 'read_kategori_produk_mobile_banking', 'web', '2024-11-26 05:05:46', '2024-11-26 05:05:46'),
	(248, 'update_kategori_produk_mobile_banking', 'web', '2024-11-26 05:05:49', '2024-11-26 05:05:49'),
	(249, 'delete_kategori_produk_mobile_banking', 'web', '2024-11-26 05:05:51', '2024-11-26 05:05:51'),
	(250, 'kategori_produk_mobile_banking', 'web', '2024-11-26 05:05:54', '2024-11-26 05:05:54');

-- Dumping structure for table sitelbdb.register_ruang_server
CREATE TABLE IF NOT EXISTS `register_ruang_server` (
  `id_register_ruang_server` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_register_ruang_server` date NOT NULL,
  `nama_petugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_urgensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pihak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagian_instansi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_tambahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_register_ruang_server`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.register_ruang_server: ~0 rows (approximately)
INSERT INTO `register_ruang_server` (`id_register_ruang_server`, `tanggal_register_ruang_server`, `nama_petugas`, `keperluan`, `kategori_urgensi`, `pihak`, `bagian_instansi`, `keterangan_tambahan`, `dokumentasi_db`, `created_at`, `updated_at`) VALUES
	(13, '2024-11-28', 'TIM IT', 'eqf', 'Medium', 'INTERNAL', 'Operasional', 'djy', '1731390890_actionLibrary.png', '2024-11-12 05:54:40', '2024-11-12 05:54:50');

-- Dumping structure for table sitelbdb.rekomendasi
CREATE TABLE IF NOT EXISTS `rekomendasi` (
  `id_rekomendasi` int unsigned NOT NULL AUTO_INCREMENT,
  `id_kantor` int unsigned NOT NULL,
  `id_unit_bagian` int unsigned NOT NULL,
  `tanggal_pengajuan_rekomendasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemohon_rekomendasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang_pengadaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekomendasi_pembelian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumentasi_db` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_persetujuan_rekomendasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_tambahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_rekomendasi`),
  KEY `rekomendasi_id_kantor_foreign` (`id_kantor`),
  KEY `rekomendasi_id_unit_bagian_foreign` (`id_unit_bagian`),
  CONSTRAINT `rekomendasi_id_kantor_foreign` FOREIGN KEY (`id_kantor`) REFERENCES `kantor` (`id_kantor`),
  CONSTRAINT `rekomendasi_id_unit_bagian_foreign` FOREIGN KEY (`id_unit_bagian`) REFERENCES `unit_bagian` (`id_unit_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.rekomendasi: ~0 rows (approximately)
INSERT INTO `rekomendasi` (`id_rekomendasi`, `id_kantor`, `id_unit_bagian`, `tanggal_pengajuan_rekomendasi`, `nama_pemohon_rekomendasi`, `tentang_pengadaan`, `rekomendasi_pembelian`, `status`, `dokumentasi_db`, `tanggal_persetujuan_rekomendasi`, `keterangan_tambahan`, `created_at`, `updated_at`) VALUES
	(9, 3, 4, '2024-11-21', 'Fahmi', 'dfgn', 'bf', 'Disetujui', '1731380834_Perbandingan UPS APC.pdf', '2024-11-26', 'bd', '2024-11-12 03:05:58', '2024-11-12 03:07:14');

-- Dumping structure for table sitelbdb.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.roles: ~3 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super-admin', 'web', '2024-07-02 20:31:58', '2024-11-01 21:26:35'),
	(2, 'petugas', 'web', '2024-07-02 20:32:35', '2024-10-14 02:18:08'),
	(23, 'user', 'web', '2024-07-14 21:49:35', '2024-07-15 02:23:20');

-- Dumping structure for table sitelbdb.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.role_has_permissions: ~229 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(108, 1),
	(109, 1),
	(110, 1),
	(111, 1),
	(112, 1),
	(114, 1),
	(115, 1),
	(116, 1),
	(117, 1),
	(118, 1),
	(119, 1),
	(120, 1),
	(121, 1),
	(122, 1),
	(123, 1),
	(124, 1),
	(125, 1),
	(126, 1),
	(127, 1),
	(128, 1),
	(129, 1),
	(130, 1),
	(131, 1),
	(132, 1),
	(133, 1),
	(134, 1),
	(135, 1),
	(136, 1),
	(137, 1),
	(138, 1),
	(139, 1),
	(140, 1),
	(141, 1),
	(142, 1),
	(143, 1),
	(144, 1),
	(145, 1),
	(146, 1),
	(147, 1),
	(148, 1),
	(149, 1),
	(150, 1),
	(151, 1),
	(155, 1),
	(156, 1),
	(157, 1),
	(158, 1),
	(159, 1),
	(160, 1),
	(162, 1),
	(163, 1),
	(164, 1),
	(165, 1),
	(166, 1),
	(167, 1),
	(168, 1),
	(169, 1),
	(170, 1),
	(171, 1),
	(172, 1),
	(173, 1),
	(174, 1),
	(175, 1),
	(176, 1),
	(177, 1),
	(178, 1),
	(182, 1),
	(183, 1),
	(184, 1),
	(185, 1),
	(186, 1),
	(187, 1),
	(188, 1),
	(189, 1),
	(190, 1),
	(191, 1),
	(192, 1),
	(193, 1),
	(194, 1),
	(195, 1),
	(196, 1),
	(197, 1),
	(198, 1),
	(199, 1),
	(200, 1),
	(201, 1),
	(202, 1),
	(203, 1),
	(204, 1),
	(205, 1),
	(206, 1),
	(207, 1),
	(208, 1),
	(209, 1),
	(210, 1),
	(211, 1),
	(212, 1),
	(213, 1),
	(214, 1),
	(215, 1),
	(216, 1),
	(217, 1),
	(218, 1),
	(219, 1),
	(220, 1),
	(221, 1),
	(222, 1),
	(223, 1),
	(224, 1),
	(225, 1),
	(226, 1),
	(227, 1),
	(228, 1),
	(229, 1),
	(230, 1),
	(231, 1),
	(232, 1),
	(233, 1),
	(234, 1),
	(235, 1),
	(236, 1),
	(237, 1),
	(238, 1),
	(239, 1),
	(240, 1),
	(241, 1),
	(242, 1),
	(243, 1),
	(244, 1),
	(245, 1),
	(246, 1),
	(247, 1),
	(248, 1),
	(249, 1),
	(250, 1),
	(108, 2),
	(109, 2),
	(110, 2),
	(111, 2),
	(114, 2),
	(115, 2),
	(116, 2),
	(117, 2),
	(120, 2),
	(121, 2),
	(122, 2),
	(123, 2),
	(126, 2),
	(127, 2),
	(128, 2),
	(129, 2),
	(132, 2),
	(133, 2),
	(134, 2),
	(135, 2),
	(137, 2),
	(138, 2),
	(139, 2),
	(140, 2),
	(142, 2),
	(144, 2),
	(155, 2),
	(156, 2),
	(157, 2),
	(158, 2),
	(163, 2),
	(164, 2),
	(165, 2),
	(166, 2),
	(168, 2),
	(169, 2),
	(170, 2),
	(171, 2),
	(174, 2),
	(175, 2),
	(176, 2),
	(177, 2),
	(182, 2),
	(183, 2),
	(184, 2),
	(185, 2),
	(188, 2),
	(189, 2),
	(190, 2),
	(191, 2),
	(193, 2),
	(194, 2),
	(195, 2),
	(196, 2),
	(198, 2),
	(199, 2),
	(200, 2),
	(201, 2),
	(203, 2),
	(204, 2),
	(205, 2),
	(206, 2),
	(108, 23),
	(110, 23),
	(114, 23),
	(116, 23),
	(120, 23),
	(122, 23),
	(126, 23),
	(128, 23),
	(132, 23),
	(134, 23),
	(137, 23),
	(139, 23),
	(142, 23),
	(144, 23),
	(155, 23),
	(157, 23),
	(163, 23),
	(165, 23),
	(168, 23),
	(170, 23),
	(174, 23),
	(176, 23),
	(182, 23),
	(184, 23),
	(188, 23),
	(190, 23),
	(193, 23),
	(195, 23),
	(198, 23),
	(200, 23),
	(203, 23),
	(205, 23);

-- Dumping structure for table sitelbdb.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('7eBcSpmJJUC1nqxpKx2xAZ2I04xZKxtBamy7ohwc', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnpFQzRvb0xUR3J1MHA1Z3p5VW1iTlBRMGRlR1BVemhPQkVEcEpTdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9zaXRlbGJkYi50ZXN0L2JlcmFuZGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1733122877),
	('ilKmhWED1EwXSR2zjIfY53a5KKtTFWXxwyOYHBHZ', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQUpYdnlmZlRMUUZXTTlYRDBsbHM4OHZrWUtvb1k1RFM5d3ZjelRwdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9zaXRlbGJkYl9kZXYudGVzdC9pdC9zaXN0ZW1fcGVuZ2VtYmFuZ2FuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1733121540),
	('MWnkr3xDaDjU8iPdL6a9Pi5PedICvbKguJae6w1M', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSnA3R1Z0dWxEQ0FQd0Q4TEJHdHU1YTJzYXlYQk5VcTFqamw3MENFQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9zaXRlbGJkYl9kZXYudGVzdC9pdC9zaXN0ZW1fcGVuZ2VtYmFuZ2FuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1732864226);

-- Dumping structure for table sitelbdb.unit_bagian
CREATE TABLE IF NOT EXISTS `unit_bagian` (
  `id_unit_bagian` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_unit_bagian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_unit_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.unit_bagian: ~17 rows (approximately)
INSERT INTO `unit_bagian` (`id_unit_bagian`, `nama_unit_bagian`, `created_at`, `updated_at`) VALUES
	(1, 'Akuntansi', '2024-10-21 18:21:27', '2024-10-21 18:38:45'),
	(2, 'Dana', '2024-10-21 18:30:12', '2024-10-21 18:30:12'),
	(3, 'SKAI', '2024-10-21 18:30:16', '2024-10-21 18:30:16'),
	(4, 'Customer Service', '2024-10-21 18:30:24', '2024-10-21 18:30:24'),
	(5, 'Teller', '2024-10-21 18:34:51', '2024-10-21 18:34:51'),
	(6, 'Legal Kredit', '2024-10-21 18:34:58', '2024-10-21 18:34:58'),
	(7, 'Sekretaris Direksi (SEKDIR)', '2024-10-21 18:35:06', '2024-10-21 18:35:06'),
	(8, 'Kredit', '2024-10-21 18:35:12', '2024-10-21 18:35:12'),
	(9, 'Remedial', '2024-10-21 18:35:23', '2024-10-21 18:35:23'),
	(10, 'SDM', '2024-10-21 18:35:46', '2024-10-21 18:35:46'),
	(11, 'IT dan Pelaporan', '2024-10-21 18:35:54', '2024-10-21 18:35:54'),
	(12, 'Umum', '2024-10-21 18:36:04', '2024-10-21 18:36:04'),
	(13, 'SKK', '2024-10-21 18:36:08', '2024-10-21 18:36:08'),
	(14, 'SKMR', '2024-10-21 18:36:12', '2024-10-21 18:36:12'),
	(15, 'Operasional', '2024-10-21 18:36:22', '2024-10-21 18:36:22'),
	(16, 'Pelayanan', '2024-10-21 18:59:46', '2024-10-21 18:59:46'),
	(17, 'Pemasaran', '2024-10-21 18:59:52', '2024-10-21 18:59:52');

-- Dumping structure for table sitelbdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `foto`, `created_at`, `updated_at`) VALUES
	(5, 'M. Dzul Fahmi Shoib', 'mdzulfahmishoib@gmail.com', NULL, '$2y$12$Nb5HcTk0RO.x61auliLKs.JGmjYQS6MVybjO0f8NQs.z6p9wkKPde', NULL, '1H5TMweYqVoBt3BQiqOz2rh80FVeRVzCzshUsACy.jpg', '2024-09-25 19:15:02', '2024-11-12 04:27:30'),
	(6, 'Petugas', 'petugas@gmail.com', NULL, '$2y$12$ESgk5xnan8UiiUyTAIHnGeOHx8H587e1fhvrzyEagvx7/Khylaf1e', NULL, 'EbQx6sFupnlzKal6cZ1syjwfFkTB9448GJBGBJjY.jpg', '2024-09-30 01:22:58', '2024-09-30 05:07:03'),
	(9, 'user', 'user@gmail.com', NULL, '$2y$12$GCyimzQ7IZicmjzEluRpXu0kZ71IajsuCwjh9GXaXz4OYekbHwtOu', NULL, 'wv2MKkBdDXLPdhzJup5R1xxPkJQ2KD0leM0aiqQM.jpg', '2024-09-30 06:56:13', '2024-09-30 06:56:13');

-- Dumping structure for table sitelbdb.vendor
CREATE TABLE IF NOT EXISTS `vendor` (
  `id_vendor` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vendor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sitelbdb.vendor: ~2 rows (approximately)
INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'PT Marstech Global', 'Vendor Core Banking System', '2024-10-27 19:53:46', '2024-10-27 19:54:46'),
	(2, 'PT Bimasakti Multi Sinergi', 'Mobile Banking', '2024-10-27 19:55:52', '2024-10-27 19:55:52');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
