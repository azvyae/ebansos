-- --------------------------------------------------------
-- Host:                         esubsidi.web.id
-- Versi server:                 10.3.36-MariaDB-cll-lve - MariaDB Server
-- OS Server:                    Linux
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table esubsidi_db.administrasi
CREATE TABLE IF NOT EXISTS `administrasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registrasi` enum('true','false') NOT NULL DEFAULT 'true',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table esubsidi_db.penduduk
CREATE TABLE IF NOT EXISTS `penduduk` (
  `hashId` char(32) NOT NULL,
  `nik` varchar(32) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `tempatLahir` varchar(32) DEFAULT NULL,
  `tanggalLahir` date DEFAULT NULL,
  `jenisKelamin` varchar(50) DEFAULT NULL,
  `alamatRumah` varchar(32) DEFAULT NULL,
  `rt` varchar(2) DEFAULT NULL,
  `rw` varchar(2) DEFAULT NULL,
  `kelurahan` varchar(64) DEFAULT NULL,
  `kecamatan` varchar(64) DEFAULT NULL,
  `statusPerkawinan` varchar(64) DEFAULT NULL,
  `pekerjaan` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`hashId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table esubsidi_db.riwayat
CREATE TABLE IF NOT EXISTS `riwayat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `userId` varchar(50) NOT NULL,
  `aksi` varchar(128) NOT NULL,
  `nikDipengaruhi` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_riwayat_user` (`userId`),
  CONSTRAINT `FK_riwayat_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table esubsidi_db.tanggalterimabansos
CREATE TABLE IF NOT EXISTS `tanggalterimabansos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggalMenerima` date NOT NULL,
  `hashId` char(32) NOT NULL DEFAULT '',
  `jenisBansos` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__penduduk` (`hashId`),
  CONSTRAINT `FK__penduduk` FOREIGN KEY (`hashId`) REFERENCES `penduduk` (`hashId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table esubsidi_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `userId` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipeAkun` tinyint(4) NOT NULL,
  `rw` tinyint(4) DEFAULT NULL,
  `rt` tinyint(4) DEFAULT NULL,
  `statusKonfirmasi` tinyint(4) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
