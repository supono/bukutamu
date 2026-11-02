-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for latihan
CREATE DATABASE IF NOT EXISTS `latihan` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `latihan`;

-- Dumping structure for table latihan.kontak
CREATE TABLE IF NOT EXISTS `kontak` (
  `id_kontak` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) COLLATE armscii8_bin NOT NULL,
  `alamat` text COLLATE armscii8_bin,
  `jenis_kelamin` enum('L','P') COLLATE armscii8_bin DEFAULT 'L',
  `create_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin COMMENT='Ini tidak usah diisi';

-- Dumping data for table latihan.kontak: ~5 rows (approximately)
DELETE FROM `kontak`;
INSERT INTO `kontak` (`id_kontak`, `nama`, `alamat`, `jenis_kelamin`, `create_on`) VALUES
	(1, 'budi', 'Jl. Sariasih no. 54 Bandung', 'L', '2026-10-26 15:25:43'),
	(2, 'Supono', 'Jl. Cihanjuang No. 22 Bandung', 'L', '2026-10-26 15:26:22'),
	(3, 'Ratih', 'Jl. Cihanjuang No. 21 Bandung', 'P', '2026-10-26 15:26:22'),
	(5, 'Test', 'Test', 'L', '2026-10-29 11:35:24'),
	(6, 'Sari', 'Jl. Majenang no 3', 'P', '2026-10-29 11:39:31');

-- Dumping structure for table latihan.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE armscii8_bin DEFAULT '0',
  `password` varchar(32) COLLATE armscii8_bin DEFAULT '0',
  `nama` varchar(100) COLLATE armscii8_bin DEFAULT '0',
  `status` enum('1','0') COLLATE armscii8_bin DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table latihan.user: ~2 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `status`) VALUES
	(1, 'budi', '123456', 'Bang Budi', '1'),
	(2, 'supono', '654321', 'Supono Syafiq', '1');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
