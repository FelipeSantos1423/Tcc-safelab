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
-- Table structure for table `tbl_alertas`
--

DROP TABLE IF EXISTS `tbl_alertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_alertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `data_hora` datetime NOT NULL,
  `tbl_dispositivos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_alertas_tbl_dispositivos1_idx` (`tbl_dispositivos_id`),
  CONSTRAINT `fk_tbl_alertas_tbl_dispositivos1` FOREIGN KEY (`tbl_dispositivos_id`) REFERENCES `tbl_dispositivos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_alertas`
--

LOCK TABLES `tbl_alertas` WRITE;
/*!40000 ALTER TABLE `tbl_alertas` DISABLE KEYS */;
INSERT INTO `tbl_alertas` VALUES (1,'Alerta: Temperatura acima do limite!','2025-06-25 10:10:00',1),(2,'Alerta: Nível de CO2 crítico!','2025-06-25 10:15:00',1),(3,'Alerta: Nível de ruído elevado!','2025-06-25 10:20:00',2);
/*!40000 ALTER TABLE `tbl_alertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_dispositivos`
--

DROP TABLE IF EXISTS `tbl_dispositivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_dispositivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `mac_adress` varchar(25) NOT NULL,
  `ativo` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dispositivos`
--

LOCK TABLES `tbl_dispositivos` WRITE;
/*!40000 ALTER TABLE `tbl_dispositivos` DISABLE KEYS */;
INSERT INTO `tbl_dispositivos` VALUES (1,'Safelab_1','C8:F0:9E:12:34:56',1),(2,'Safelab_2','D4:36:39:78:90:AB',1);
/*!40000 ALTER TABLE `tbl_dispositivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_medicoes`
--

DROP TABLE IF EXISTS `tbl_medicoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_medicoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data_hora` datetime NOT NULL,
  `temperatura_medicao` decimal(10,2) NOT NULL,
  `umidade_medicao` decimal(10,2) NOT NULL,
  `co2_medicao` decimal(10,2) NOT NULL,
  `ruido_medicao` decimal(10,2) NOT NULL,
  `luz_medicao` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_medicoes`
--

LOCK TABLES `tbl_medicoes` WRITE;
/*!40000 ALTER TABLE `tbl_medicoes` DISABLE KEYS */;
INSERT INTO `tbl_medicoes` VALUES (1,'2025-06-25 10:00:00',25.50,60.00,420.00,50.20,300.00),(2,'2025-06-25 10:05:00',26.00,59.50,430.00,49.80,310.00),(3,'2025-06-25 10:10:00',27.00,58.00,440.00,51.00,320.00);
/*!40000 ALTER TABLE `tbl_medicoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_salas`
--

DROP TABLE IF EXISTS `tbl_salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_salas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_sala` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `tbl_dispositivos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_salas_tbl_dispositivos1_idx` (`tbl_dispositivos_id`),
  CONSTRAINT `fk_tbl_salas_tbl_dispositivos1` FOREIGN KEY (`tbl_dispositivos_id`) REFERENCES `tbl_dispositivos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_salas`
--

LOCK TABLES `tbl_salas` WRITE;
/*!40000 ALTER TABLE `tbl_salas` DISABLE KEYS */;
INSERT INTO `tbl_salas` VALUES (1,'Laboratório de Informática 1','Sala equipada com 30 PCs',1),(2,'Laboratório de Redes','Sala com roteadores e switches',2);
/*!40000 ALTER TABLE `tbl_salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sensores`
--

DROP TABLE IF EXISTS `tbl_sensores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_sensores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_sensor` varchar(45) NOT NULL,
  `unidade_medida` varchar(45) NOT NULL,
  `tbl_dispositivos_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_sensores_tbl_dispositivos1_idx` (`tbl_dispositivos_id`),
  CONSTRAINT `fk_tbl_sensores_tbl_dispositivos1` FOREIGN KEY (`tbl_dispositivos_id`) REFERENCES `tbl_dispositivos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sensores`
--

LOCK TABLES `tbl_sensores` WRITE;
/*!40000 ALTER TABLE `tbl_sensores` DISABLE KEYS */;
INSERT INTO `tbl_sensores` VALUES (1,'Temperatura','°C',1),(2,'Umidade','%',1),(3,'CO2','ppm',1),(4,'Ruído','dB',2),(5,'Luminosidade','Lux',2);
/*!40000 ALTER TABLE `tbl_sensores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sensores_has_tbl_medicoes`
--

DROP TABLE IF EXISTS `tbl_sensores_has_tbl_medicoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_sensores_has_tbl_medicoes` (
  `tbl_sensores_id` int NOT NULL,
  `tbl_medicoes_id` int NOT NULL,
  PRIMARY KEY (`tbl_sensores_id`,`tbl_medicoes_id`),
  KEY `fk_tbl_sensores_has_tbl_medicoes_tbl_medicoes1_idx` (`tbl_medicoes_id`),
  KEY `fk_tbl_sensores_has_tbl_medicoes_tbl_sensores1_idx` (`tbl_sensores_id`),
  CONSTRAINT `fk_tbl_sensores_has_tbl_medicoes_tbl_medicoes1` FOREIGN KEY (`tbl_medicoes_id`) REFERENCES `tbl_medicoes` (`id`),
  CONSTRAINT `fk_tbl_sensores_has_tbl_medicoes_tbl_sensores1` FOREIGN KEY (`tbl_sensores_id`) REFERENCES `tbl_sensores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sensores_has_tbl_medicoes`
--

LOCK TABLES `tbl_sensores_has_tbl_medicoes` WRITE;
/*!40000 ALTER TABLE `tbl_sensores_has_tbl_medicoes` DISABLE KEYS */;
INSERT INTO `tbl_sensores_has_tbl_medicoes` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `tbl_sensores_has_tbl_medicoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_usuario`
--

DROP TABLE IF EXISTS `tbl_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_tipo_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_usuario`
--

LOCK TABLES `tbl_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_usuario` DISABLE KEYS */;
INSERT INTO `tbl_tipo_usuario` VALUES (1,'Administrador'),(2,'Visualizador');
/*!40000 ALTER TABLE `tbl_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomeC` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `tbl_tipo_usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_usuario_tbl_tipo_usuario_idx` (`tbl_tipo_usuario_id`),
  CONSTRAINT `fk_tbl_usuario_tbl_tipo_usuario` FOREIGN KEY (`tbl_tipo_usuario_id`) REFERENCES `tbl_tipo_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (1,'Henrique Alves','henrique@safelab.com','senha123',1),(2,'Beatriz Lima','beatriz@safelab.com','senha123',2),(3,'sim','teste1@teste.com','$2y$10$H/cFBC3RByhgpXFHgSXf4uvHi3nyGX0v7U/RpkyGVcezsH49nHB.W',1),(4,'sim','teste3@teste.com','$2y$10$.L4GR6y1iIOUrBKsjo7/EeW8oEfubnIUM9DfVE06TGH0Z15XQClp.',2),(5,'sim','teste36@teste.com','$2y$10$CZXss7F87MoZS0QJayI7W.Q1MjJxGShM/A8wpaHg2WpSZqKEXT9fa',2),(6,'agora vau pow','lucas@gmail.com','$2y$10$BlgdFTFUh5b4fIOUm/zixe9yNkg16XJfrvdjLkguEye65asx4sGyy',1);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-01 20:02:00
