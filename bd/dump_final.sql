-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: safelab_db
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_dispositivos`
--

DROP TABLE IF EXISTS `tbl_dispositivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_dispositivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `codigo_esp` varchar(60) NOT NULL,
  `ativo` tinyint NOT NULL DEFAULT '1',
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tbl_locais_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_dispositivos_tbl_locais1_idx` (`tbl_locais_id`),
  CONSTRAINT `fk_tbl_dispositivos_tbl_locais1` FOREIGN KEY (`tbl_locais_id`) REFERENCES `tbl_locais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dispositivos`
--

LOCK TABLES `tbl_dispositivos` WRITE;
/*!40000 ALTER TABLE `tbl_dispositivos` DISABLE KEYS */;
INSERT INTO `tbl_dispositivos` VALUES (7,'ESP_01','ESP01',1,'2025-11-07 01:45:39',6);
/*!40000 ALTER TABLE `tbl_dispositivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_leituras`
--

DROP TABLE IF EXISTS `tbl_leituras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_leituras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tbl_dispositivos_id` int NOT NULL,
  `temperatura` float NOT NULL,
  `umidade` float NOT NULL,
  `luz` float NOT NULL,
  `ruido` float NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_leituras_tbl_dispositivos_idx` (`tbl_dispositivos_id`),
  CONSTRAINT `fk_tbl_leituras_tbl_dispositivos` FOREIGN KEY (`tbl_dispositivos_id`) REFERENCES `tbl_dispositivos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_leituras`
--

LOCK TABLES `tbl_leituras` WRITE;
/*!40000 ALTER TABLE `tbl_leituras` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_leituras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_locais`
--

DROP TABLE IF EXISTS `tbl_locais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_locais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `locais` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_locais`
--

LOCK TABLES `tbl_locais` WRITE;
/*!40000 ALTER TABLE `tbl_locais` DISABLE KEYS */;
INSERT INTO `tbl_locais` VALUES (6,'Sala 05','Sala de informática (Sala 05) da ETEC');
/*!40000 ALTER TABLE `tbl_locais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomeC` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (2,'admin_etec','administrador01@gmail.com','$2y$10$IIb3Kk0TAA1ajTiHT3.GtOZM4cqWT30vQvxYXApYkX9uaL1NQF1uS','2025-11-07 01:39:29');
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-06 22:48:10
