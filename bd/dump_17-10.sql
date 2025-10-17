-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: safelab_db
-- ------------------------------------------------------
-- Server version	8.0.40

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dispositivos`
--

LOCK TABLES `tbl_dispositivos` WRITE;
/*!40000 ALTER TABLE `tbl_dispositivos` DISABLE KEYS */;
INSERT INTO `tbl_dispositivos` VALUES (1,'Henque','352',0,'2025-10-16 04:47:22',1),(2,'sal','333',1,'2025-10-16 04:47:22',2),(3,'tes','555',1,'2025-10-16 04:47:22',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_leituras`
--

LOCK TABLES `tbl_leituras` WRITE;
/*!40000 ALTER TABLE `tbl_leituras` DISABLE KEYS */;
INSERT INTO `tbl_leituras` VALUES (1,1,22.5,50.2,300,40.1,'2025-10-16 05:18:51'),(2,1,23,52,320,41.5,'2025-10-16 05:18:51'),(3,1,21.8,48.5,280,39.8,'2025-10-16 05:18:51'),(4,2,25.1,55,400,45,'2025-10-16 05:18:51'),(5,2,24.5,53.2,380,44.3,'2025-10-16 05:18:51'),(6,2,25,54.8,410,46.2,'2025-10-16 05:18:51'),(7,3,20,47,250,38,'2025-10-16 05:18:51'),(8,3,21.2,49.5,270,39.5,'2025-10-16 05:18:51'),(9,3,19.8,46.3,240,37.2,'2025-10-16 05:18:51'),(10,3,20.5,45,150,35,'2025-10-16 05:37:54'),(11,3,21,46,155,36,'2025-10-16 05:37:54'),(12,3,21.5,47,160,37,'2025-10-16 05:37:54'),(13,3,22,48,165,38,'2025-10-16 05:37:54'),(14,3,22.5,49,170,39,'2025-10-16 05:37:54'),(15,3,23,50,175,40,'2025-10-16 05:37:54'),(16,3,23.5,51,180,41,'2025-10-16 05:37:54'),(17,3,24,52,185,42,'2025-10-16 05:37:54'),(18,3,24.5,53,190,43,'2025-10-16 05:37:54'),(19,3,25,54,195,44,'2025-10-16 05:37:54'),(20,2,21,48,180,39,'2025-10-16 05:38:50'),(21,2,21.5,49,185,40,'2025-10-16 05:38:50'),(22,2,22,50,190,41,'2025-10-16 05:38:50'),(23,2,22.3,51,195,42,'2025-10-16 05:38:50'),(24,2,22.8,52,200,43,'2025-10-16 05:38:50'),(25,2,23,53,205,44,'2025-10-16 05:38:50'),(26,2,23.2,54,210,45,'2025-10-16 05:38:50'),(27,2,23.5,55,215,46,'2025-10-16 05:38:50'),(28,2,23.7,56,220,47,'2025-10-16 05:38:50'),(29,2,24,57,225,48,'2025-10-16 05:38:50'),(30,1,22.5,50,200,40,'2025-10-16 05:38:53'),(31,1,23.1,52,210,42,'2025-10-16 05:38:53'),(32,1,24,53,220,41,'2025-10-16 05:38:53'),(33,1,23.8,51,230,43,'2025-10-16 05:38:53'),(34,1,25.2,54,240,39,'2025-10-16 05:38:53'),(35,1,26,55,250,38,'2025-10-16 05:38:53'),(36,1,25.5,56,260,37,'2025-10-16 05:38:53'),(37,1,24.8,53,270,36,'2025-10-16 05:38:53'),(38,1,23.9,52,280,35,'2025-10-16 05:38:53'),(39,1,22.7,51,290,34,'2025-10-16 05:38:53'),(40,1,22.5,50.2,300,40.1,'2025-10-16 05:43:06'),(41,1,23,52,320,41.5,'2025-10-16 05:43:06'),(42,1,21.8,48.5,280,39.8,'2025-10-16 05:43:06'),(43,2,25.1,55,400,45,'2025-10-16 05:43:06'),(44,2,24.5,53.2,380,44.3,'2025-10-16 05:43:06'),(45,2,25,54.8,410,46.2,'2025-10-16 05:43:06'),(46,3,20,47,250,38,'2025-10-16 05:43:06'),(47,3,21.2,49.5,270,39.5,'2025-10-16 05:43:06'),(48,3,19.8,46.3,240,37.2,'2025-10-16 05:43:06'),(49,1,22.5,50,200,40,'2025-10-16 05:43:06'),(50,1,23.1,52,210,42,'2025-10-16 05:43:06'),(51,1,24,53,220,41,'2025-10-16 05:43:06'),(52,1,23.8,51,230,43,'2025-10-16 05:43:06'),(53,1,25.2,54,240,39,'2025-10-16 05:43:06'),(54,1,26,55,250,38,'2025-10-16 05:43:06'),(55,1,25.5,56,260,37,'2025-10-16 05:43:06'),(56,1,24.8,53,270,36,'2025-10-16 05:43:06'),(57,1,23.9,52,280,35,'2025-10-16 05:43:06'),(58,1,22.7,51,290,34,'2025-10-16 05:43:06'),(59,2,21,48,180,39,'2025-10-16 05:43:06'),(60,2,21.5,49,185,40,'2025-10-16 05:43:06'),(61,2,22,50,190,41,'2025-10-16 05:43:06'),(62,2,22.3,51,195,42,'2025-10-16 05:43:06'),(63,2,22.8,52,200,43,'2025-10-16 05:43:06'),(64,2,23,53,205,44,'2025-10-16 05:43:06'),(65,2,23.2,54,210,45,'2025-10-16 05:43:06'),(66,2,23.5,55,215,46,'2025-10-16 05:43:06'),(67,2,23.7,56,220,47,'2025-10-16 05:43:06'),(68,2,24,57,225,48,'2025-10-16 05:43:06'),(69,3,20.5,45,150,35,'2025-10-16 05:43:06'),(70,3,21,46,155,36,'2025-10-16 05:43:06'),(71,3,21.5,47,160,37,'2025-10-16 05:43:06'),(72,3,22,48,165,38,'2025-10-16 05:43:06'),(73,3,22.5,49,170,39,'2025-10-16 05:43:06'),(74,3,23,50,175,40,'2025-10-16 05:43:06'),(75,3,23.5,51,180,41,'2025-10-16 05:43:06'),(76,3,24,52,185,42,'2025-10-16 05:43:06'),(77,3,24.5,53,190,43,'2025-10-16 05:43:06'),(78,3,25,54,195,44,'2025-10-16 05:43:06');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_locais`
--

LOCK TABLES `tbl_locais` WRITE;
/*!40000 ALTER TABLE `tbl_locais` DISABLE KEYS */;
INSERT INTO `tbl_locais` VALUES (1,'sala 01','laboratório de informática 1'),(2,'sala 05','laboratório de informática 5'),(3,'sala 06','laboratório de informática 6');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,'Henrique dos Santos','teste1@teste.com','$2y$10$meMuIuJSUe.m0UWfyS2nGuChQ5ZsZvGA1H9zwysrif5sE4tdcugDG','2025-10-16 00:13:26');
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

-- Dump completed on 2025-10-17 18:52:09
