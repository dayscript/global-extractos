-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: extractos_global
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `extractos_fics`
--

DROP TABLE IF EXISTS `extractos_fics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extractos_fics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fondo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_inicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `extractos_fics_user_id_foreign` (`user_id`),
  CONSTRAINT `extractos_fics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extractos_fics`
--

LOCK TABLES `extractos_fics` WRITE;
/*!40000 ALTER TABLE `extractos_fics` DISABLE KEYS */;
/*!40000 ALTER TABLE `extractos_fics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extractos_firma`
--

DROP TABLE IF EXISTS `extractos_firma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extractos_firma` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha_inicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `extractos_firma_user_id_foreign` (`user_id`),
  CONSTRAINT `extractos_firma_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extractos_firma`
--

LOCK TABLES `extractos_firma` WRITE;
/*!40000 ALTER TABLE `extractos_firma` DISABLE KEYS */;
/*!40000 ALTER TABLE `extractos_firma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_04_03_145832_PieResumidoClienteDado',1),(4,'2017_04_03_152924_create_table_renta_variable',1),(5,'2017_04_03_154118_create_table_renta_fija',1),(6,'2017_04_03_154246_create_table_operaciones_por_cumplir',1),(7,'2017_04_03_154311_create_table_operaciones_de_liquidez',1),(8,'2017_04_03_154651_create_table_movimientos',1),(9,'2017_04_07_163634_create_table_fics',1),(10,'2017_04_24_154552_create_table_extractos_fics',1),(11,'2017_04_24_155437_create_table_extractos_firma',1),(12,'2018_07_10_162314_update_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moviemientos`
--

DROP TABLE IF EXISTS `moviemientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moviemientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha_inicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `moviemientos_user_id_foreign` (`user_id`),
  CONSTRAINT `moviemientos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moviemientos`
--

LOCK TABLES `moviemientos` WRITE;
/*!40000 ALTER TABLE `moviemientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `moviemientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operaciones_de_liquidez`
--

DROP TABLE IF EXISTS `operaciones_de_liquidez`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operaciones_de_liquidez` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operaciones_de_liquidez_user_id_foreign` (`user_id`),
  CONSTRAINT `operaciones_de_liquidez_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones_de_liquidez`
--

LOCK TABLES `operaciones_de_liquidez` WRITE;
/*!40000 ALTER TABLE `operaciones_de_liquidez` DISABLE KEYS */;
/*!40000 ALTER TABLE `operaciones_de_liquidez` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operaciones_por_cumplir`
--

DROP TABLE IF EXISTS `operaciones_por_cumplir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operaciones_por_cumplir` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operaciones_por_cumplir_user_id_foreign` (`user_id`),
  CONSTRAINT `operaciones_por_cumplir_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones_por_cumplir`
--

LOCK TABLES `operaciones_por_cumplir` WRITE;
/*!40000 ALTER TABLE `operaciones_por_cumplir` DISABLE KEYS */;
/*!40000 ALTER TABLE `operaciones_por_cumplir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portafolios`
--

DROP TABLE IF EXISTS `portafolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portafolios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retan_variable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retan_fija` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operaciones_de_liquiez` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operaciones_por_cumplir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_disponible` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_cuenta_de_administracion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fondos_de_inversion_colectiva` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gran_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renta_fija_porcentaje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renta_variable_porcentaje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renta_fics_porcentaje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portafolios_user_id_foreign` (`user_id`),
  CONSTRAINT `portafolios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portafolios`
--

LOCK TABLES `portafolios` WRITE;
/*!40000 ALTER TABLE `portafolios` DISABLE KEYS */;
/*!40000 ALTER TABLE `portafolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renta_fics`
--

DROP TABLE IF EXISTS `renta_fics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `renta_fics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `renta_fics_user_id_foreign` (`user_id`),
  CONSTRAINT `renta_fics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renta_fics`
--

LOCK TABLES `renta_fics` WRITE;
/*!40000 ALTER TABLE `renta_fics` DISABLE KEYS */;
/*!40000 ALTER TABLE `renta_fics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renta_fija`
--

DROP TABLE IF EXISTS `renta_fija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `renta_fija` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `renta_fija_user_id_foreign` (`user_id`),
  CONSTRAINT `renta_fija_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renta_fija`
--

LOCK TABLES `renta_fija` WRITE;
/*!40000 ALTER TABLE `renta_fija` DISABLE KEYS */;
/*!40000 ALTER TABLE `renta_fija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renta_variable`
--

DROP TABLE IF EXISTS `renta_variable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `renta_variable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_json` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `renta_variable_user_id_foreign` (`user_id`),
  CONSTRAINT `renta_variable_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renta_variable`
--

LOCK TABLES `renta_variable` WRITE;
/*!40000 ALTER TABLE `renta_variable` DISABLE KEYS */;
/*!40000 ALTER TABLE `renta_variable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codeoyd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asesor_comercial` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_identification_unique` (`identification`),
  UNIQUE KEY `users_codeoyd_unique` (`codeoyd`)
) ENGINE=InnoDB AUTO_INCREMENT=23648 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'1020814856','18233','NUÑEZ MORENO ALEJANDRO','Indefinida','NUÑEZ MORENO ALEJANDRO','Indefinido',1,'1020814856@sincorreo.com','$2y$10$WGjLUrOcWXkXO1VBZHdamusosNr6sDvwLhPZ7NHOBEgbCxa3GuS2K',NULL,'2018-07-11 21:18:51','2018-07-11 21:18:51'),(3,'91040756570','137461','DEVIS  CANTILLO  NATALIA','Indefinida','DEVIS  CANTILLO  NATALIA','Indefinido',1,'91040756570@sincorreo.com','$2y$10$AND0BxmvuNleQVY3bBqmTeFQtEHsopWVKPBdQCRthxvdkkj2DVQqq',NULL,'2018-07-11 21:57:19','2018-07-11 21:57:19'),(4,'1000148428','134107','GOMEZ HORLANDY JAVIER FELIPE','Indefinida','GOMEZ HORLANDY JAVIER FELIPE','Indefinido',1,'1000148428@sincorreo.com','$2y$10$txIkKX3B1mTgEuTfGL1VZOCDlczlEPDbLt/llX03WDmfLsehqzwDO',NULL,'2018-07-11 21:59:53','2018-07-11 21:59:53'),(5,'900033085','171931','FUNDACION NUEVA ACROPOLIS','Indefinida','FUNDACION NUEVA ACROPOLIS','Indefinido',1,'900033085@sincorreo.com','$2y$10$cOdZoeY.MmyX/nuB7vHZku9NuQQ8Y2dkhjHKRASQ35sxCryzeZ6cq',NULL,'2018-07-11 22:00:26','2018-07-11 22:00:26'),(6,'1000707105','85463','GAVIRIA RUIZ ESTHEFANIA','Indefinida','GAVIRIA RUIZ ESTHEFANIA','Indefinido',1,'1000707105@sincorreo.com','$2y$10$.GkWXMfRg8UaiGjCpH7oju93CHzCc/PUWrikHv8Vx1VFozINr86.W',NULL,'2018-07-11 22:00:38','2018-07-11 22:00:38'),(7,'91509719','33297','AMAYA SUAREZ OSCAR JAVIER','Indefinida','AMAYA SUAREZ OSCAR JAVIER','Indefinido',1,'91509719@sincorreo.com','$2y$10$m3N5RUZcJJq1jQ6jsOiSKOIUp0XYpyopybo.kAe/SY1Cu8z2pbHI2',NULL,'2018-07-11 22:00:49','2018-07-11 22:00:49'),(8,'3002008','179537','QUINTERO RODRIGUEZ JOSE URIEL','Indefinida','QUINTERO RODRIGUEZ JOSE URIEL','Indefinido',1,'3002008@sincorreo.com','$2y$10$5TRbJSV3w8FOwqHwqQCX7uR2T3wdMskvKBMiwZIJcChh0eusACueq',NULL,'2018-07-11 22:01:57','2018-07-11 22:01:57'),(23645,'1013611324','0','aacevedo','Bogotá','0','Register to Dashboard',1,'aacevedo@dayscript.com','$2y$10$3p09rNifa/nlXhIKhU9wc.3Wj5uJihK7NfrrxDOKM0ZvcfP3XfoOi',NULL,'2018-07-10 22:12:27','2018-07-10 22:12:27'),(23647,'71672243','20193','ZAPATA GOMEZ WILLIAM ALBERTO','Indefinida','CARRERA 43  56 - 12','Indefinido',1,'71672243@sincorreo.com','$2y$10$5hmhTtVMod7PVKJIw2UN0uWZQ8tfhwIlqgKgbYeaFlNDOK8cjie3e',NULL,'2018-07-18 02:02:28','2018-07-18 02:02:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-17 17:34:37
