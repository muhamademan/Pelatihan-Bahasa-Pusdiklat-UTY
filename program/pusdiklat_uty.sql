/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.37-MariaDB : Database - pusdiklat_uty
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pusdiklat_uty` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pusdiklat_uty`;

/*Table structure for table `berita_acara` */

DROP TABLE IF EXISTS `berita_acara`;

CREATE TABLE `berita_acara` (
  `id_beritaacara` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `berita` longtext NOT NULL,
  `pertemuan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_mentor` varchar(100) NOT NULL,
  `jenis_pelatihan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_beritaacara`),
  KEY `id_user` (`id_user`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `berita_acara_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `berita_acara_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

/*Data for the table `berita_acara` */

insert  into `berita_acara`(`id_beritaacara`,`id_user`,`id_kelas`,`kelas`,`berita`,`pertemuan`,`tanggal`,`nama_mentor`,`jenis_pelatihan`) values (73,61,16,' Reguler A','pertemuan 1','Pertemuan Ke  1','2021-01-07','Mentor Pelatihan','English Profeciency Test '),(74,61,16,' Reguler A','pertemuan 2','Pertemuan Ke  2','2021-01-08','Mentor Pelatihan','English Profeciency Test '),(78,61,16,' Reguler A','pertemuan 3','Pertemuan Ke  3','2021-01-28','Mentor Pelatihan','English Profeciency Test '),(79,61,16,' Reguler A','pertemuan 4','Pertemuan Ke  4','2021-01-28','Mentor Pelatihan','English Profeciency Test ');

/*Table structure for table `data_peserta` */

DROP TABLE IF EXISTS `data_peserta`;

CREATE TABLE `data_peserta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `id_pelatihan` int(1) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama_peserta` varchar(128) NOT NULL,
  `no_identitas` char(20) NOT NULL,
  `tempat_lahir` varchar(120) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `prodi` varchar(120) NOT NULL,
  `nama_instansi` varchar(128) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `email` varchar(120) NOT NULL,
  `presensi` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_id` (`kelas_id`),
  KEY `user_id` (`user_id`),
  KEY `id_pelatihan` (`id_pelatihan`),
  KEY `id_fakultas` (`id_fakultas`),
  CONSTRAINT `data_peserta_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  CONSTRAINT `data_peserta_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `data_peserta_ibfk_4` FOREIGN KEY (`id_pelatihan`) REFERENCES `pelatihan_kat` (`id`),
  CONSTRAINT `data_peserta_ibfk_5` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `data_peserta` */

insert  into `data_peserta`(`id`,`user_id`,`id_pelatihan`,`id_fakultas`,`kelas_id`,`nama_peserta`,`no_identitas`,`tempat_lahir`,`tgl_lahir`,`jenis_kelamin`,`prodi`,`nama_instansi`,`hp`,`email`,`presensi`) values (16,62,2,3,18,'Eman','12121','Cirebon','2020-11-01','Pria','Informatia','UTY','082313123','eman@gmail.com',0),(17,61,1,3,16,'salsa','232323','jkaarta','2020-11-02','Wanita','psikologi','UGM','7575757','salsa@gmail.com',0),(18,62,2,1,18,'Muhamad Eman','1111111','Bali','2020-11-03','Pria','Management','UTY','876882929','muhamad@gmail.com',0),(20,61,1,3,16,'Buhaji','23232322','Bali','2020-11-01','Wanita','Psikolog','UTY','909090909','haji@gmail',0),(23,62,1,1,33,'nunu','3232','jakarta','2020-12-01','Laki','TI','UGMm','23232','nunu@gmail.com',0);

/*Table structure for table `fakultas` */

DROP TABLE IF EXISTS `fakultas`;

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alias` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fakultas` */

insert  into `fakultas`(`id`,`nama`,`alias`) values (1,'Fakultas Teknologi Informasi dan Elektro','FTIE'),(3,'Fakultas Humaniora, Pendidikan dan Pariwisata','FHPP');

/*Table structure for table `history_peserta` */

DROP TABLE IF EXISTS `history_peserta`;

CREATE TABLE `history_peserta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id_berita` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `presensi` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `history_peserta_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;

/*Data for the table `history_peserta` */

insert  into `history_peserta`(`id`,`id_kelas`,`id_user`,`id_peserta`,`id_berita`,`keterangan`,`presensi`,`tanggal`) values (139,16,61,17,73,'Hadir',1,'2021-01-07'),(140,16,61,20,73,'Tidak hadir',0,'2021-01-07'),(141,16,61,17,74,'Hadir',1,'2021-01-08'),(142,16,61,20,74,'Hadir',1,'2021-01-08'),(149,16,61,17,78,'Tidak hadir',0,'2021-01-28'),(150,16,61,20,78,'Tidak hadir',0,'2021-01-28'),(151,16,61,17,79,'Hadir',1,'2021-01-28'),(152,16,61,20,79,'Tidak hadir',0,'2021-01-28');

/*Table structure for table `institusi` */

DROP TABLE IF EXISTS `institusi`;

CREATE TABLE `institusi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `institusi` */

insert  into `institusi`(`id`,`nama`) values (1,'Universitas Teknologi Yogyakarta'),(2,'Universitas Gajah Mada'),(4,'Orang Dalam');

/*Table structure for table `jenis_pendaftar` */

DROP TABLE IF EXISTS `jenis_pendaftar`;

CREATE TABLE `jenis_pendaftar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `jenis_pendaftar` */

insert  into `jenis_pendaftar`(`id`,`nama_jenis`) values (1,'Internal (Mahasiswa UTY)'),(2,'Internal (Dosen UTY)'),(3,'Internal (Karyawan UTY)'),(4,'Eksternal Kerjasama'),(5,'Partner'),(6,'Eksternal');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `ruangan` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kuota` int(11) NOT NULL,
  `sisa_kuota` int(11) NOT NULL,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id`,`user_id`,`nama`,`ruangan`,`lokasi`,`tanggal`,`kuota`,`sisa_kuota`,`status`) values (16,61,'Reguler A','H.22','Kampus 1 UTY','2020-11-29',20,9,'Buka'),(18,61,'Reguler B','H.21','Kampus 1 UTY','2021-01-15',20,13,'Buka'),(32,62,'Reguler C','H.21','Kampus 3 UTY','2021-01-14',20,18,'Buka'),(33,64,'Reguler G','H.22','Kampus 2 UTY','2021-01-18',20,0,'Buka');

/*Table structure for table `pelatihan_kat` */

DROP TABLE IF EXISTS `pelatihan_kat`;

CREATE TABLE `pelatihan_kat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelatihan` varchar(130) NOT NULL,
  `alias` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pelatihan_kat` */

insert  into `pelatihan_kat`(`id`,`nama_pelatihan`,`alias`) values (1,'English Profeciency Test ','EPT'),(2,'Japan Profeciency Test','JPT'),(4,'Bahasa Sunda euy','B.Sundaan'),(5,'Bahasa China','BC');

/*Table structure for table `prodi` */

DROP TABLE IF EXISTS `prodi`;

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `akreditas` varchar(5) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `prodi` */

insert  into `prodi`(`id`,`nama`,`akreditas`,`id_fakultas`) values (1,'S1 Informatika','A',1),(2,'S1 Teknik Elektro','B',1),(3,'D3 Sistem Informasi','A',1),(5,'D3 Bahasa Jepang ','B',3),(6,'S1 Bahasa Inggris','B',3),(7,'D4 Destinasi Pariwisata','C',3);

/*Table structure for table `spesifikasi` */

DROP TABLE IF EXISTS `spesifikasi`;

CREATE TABLE `spesifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelatihan` int(11) NOT NULL,
  `spesifikasi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `spesifikasi` */

insert  into `spesifikasi`(`id`,`id_pelatihan`,`spesifikasi`) values (1,1,'Grammar'),(4,2,'Speaking');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `username` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `jns_kelamin` varchar(20) NOT NULL,
  `is_active` int(1) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`username`,`no_hp`,`email`,`role_id`,`jns_kelamin`,`is_active`,`password`,`image`) values (59,'Admin sistem','Admin-System2','0893784792','admin@gmail.com',3,'Laki-Laki',1,'$2y$10$jPFhZgSGm0m7tQL3rLtoqes5sug9MobJoJnrDvkPxuv5UIMxxz9h2','default.png'),(60,'admin-pusdiklat','admin-pusdiklat','0893784792','adminpusdiklat@gmail.com',1,'Laki-Laki',1,'$2y$10$IcfRPW5YFMwGfQl6BCCuGudlA1puxEWA2.sVthmLoNPTa2Z6N9X6G','default.png'),(61,'Mentor Pelatihan','Mentor1','0893784792','mentorpelatihan@gmail.com',2,'Laki-Laki',1,'$2y$10$Pk/P7wW.PqaF.OPH12JC7uJAQCS5shNdAP88Ol7ruwvSBkshc7LiW','default.png'),(62,'Mentor2-Pelatihan','Mentor2','0893784792','mentor2@gmail.com',2,'Laki-Laki',1,'$2y$10$rOl.7bAVjriFHokWrHu1AuaAvegWxjOLFl3bdTIDFTREAypF4oHfG','default.png'),(63,'Admin System Pelatihan','Admin-System','0893784792','adminsistem@gmail.com',3,'Laki-Laki',1,'$2y$10$GQ9ZEduKWs4cmjBM4j1D..BeptQzZNPJZyGjdT1jxfXfEh4J7Za9m','default.png'),(64,'Muhamad Eman Sulaeman','Eman','9898989','eman@gmail.com',2,'Pria',1,'$2y$10$fHox4T7uCpfC3nzTLOr5QulLT7csUghNINORFInbIMcgDuNVaUrP6','default.png');

/*Table structure for table `user_access_menu` */

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `user_access_menu` */

insert  into `user_access_menu`(`id`,`role_id`,`menu_id`) values (1,1,1),(3,2,2),(5,1,3),(6,3,7),(7,3,8),(8,3,9),(9,3,10);

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`,`is_active`) values (1,'Admin',1),(2,'User',1),(5,'Kelola Web',1),(6,'Jadwal Pelatihan',1),(7,'SuperAdmin',1),(8,'Menu',1),(9,'Pelatihan',1),(10,'Akun',1),(11,'Kelola Sertifikasi',1);

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values (1,'Administrator'),(2,'User'),(3,'SuperAdmin'),(4,'Admin Pelatihan Bahasa'),(5,'Admin Ujian Bahasa'),(6,'Admin Pelatihan Sertifikasi'),(7,'Admin Ujian Sertifikasi'),(8,'Mentor Ujian Sertifikasi'),(9,'Mentor Pelatihan Sertifikasi'),(10,'Mentor Ujian Bahasa'),(11,'Mentor Pelatihan Bahasa');

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `user_sub_menu` */

insert  into `user_sub_menu`(`id`,`menu_id`,`title`,`url`,`icon`,`is_active`) values (1,1,'Dashboard','admin','fas fa-fw fa-tachometer-alt',1),(2,2,'My Profile','user','fas fa-fw fa-users',1),(3,2,'Jadwal & Presensi','jadwal_presensi','fas fa-fw fa-book-reader',1),(4,2,'Rekap Mentor','user/rekapmentor','fas fa-fw fa-file-alt',1),(6,1,'Jadwal & Kelas','admin/jadwalkelas','fa fa-cog',1),(8,1,'Rekap Admin','admin/rekapadmin','fa fa-cog',1),(9,2,'Edit Profile','user/edit','fas fa-fw fa-edit',1),(10,2,'Change Password','user/changepassword','fas fa-fw fa-key',1),(18,7,'Dashboard','superadmin','fa fa-cog',1),(19,7,'Institusi','superadmin/institusi','fa fa-cog',1),(20,7,'Program Studi','superadmin/prodi','fa fa-cog',1),(21,7,'Jenis Pendaftar','superadmin/jenis_pendaftar','fa fa-cog',1),(22,8,'Menu Management','menu/menu','fa fa-cog',1),(23,8,'Menu Akses','menu/menuakses','fa fa-cog',1),(24,9,'Spesifikasi','pelatihan/spesifikasi','fa fa-cog',1),(25,9,'Pelatihan','pelatihan/latih','fa fa-cog',1),(26,10,'Admin & Staf','akun/admin','fa fa-cog',1),(27,10,'Pengaturan','akun/pengaturan','fa fa-cog',1),(28,10,'Role','akun/role','fa fa-cog',1),(29,7,'Fakultas','superadmin/fakultas','fa fa-cog',1),(30,1,'Pengatuan','admin/pengaturan','fa fa-cog',1),(31,1,'Peserta','admin/peserta','fa fa-cog',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
