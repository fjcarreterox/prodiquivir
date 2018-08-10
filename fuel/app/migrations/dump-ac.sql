-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: chio
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
-- Table structure for table `albarans`
--

DROP TABLE IF EXISTS `albarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albarans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `IdAlbaran` int(11) NOT NULL,
  `IdEntrega` int(11) DEFAULT NULL,
  `IdProveedor` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albarans`
--

LOCK TABLES `albarans` WRITE;
/*!40000 ALTER TABLE `albarans` DISABLE KEYS */;
INSERT INTO `albarans` VALUES (1,1,1,2,1432310719,1432310719),(18,2,8,6,1433191961,1433191980),(19,3,10,6,1433192610,1433192832),(20,4,NULL,NULL,1433193088,1433193088),(21,5,11,2,1433354050,1433354295),(22,6,NULL,NULL,1433357248,1433357248),(23,7,NULL,NULL,1433914308,1433914307),(24,8,NULL,NULL,1433914784,1433914784),(25,9,NULL,NULL,1433973570,1433973570);
/*!40000 ALTER TABLE `albarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anticipos`
--

DROP TABLE IF EXISTS `anticipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anticipos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `idprov` int(11) NOT NULL,
  `numcheque` int(11) NOT NULL,
  `idbanco` int(11) NOT NULL,
  `cuantia` decimal(5,2) NOT NULL,
  `recogido` tinyint(4) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anticipos`
--

LOCK TABLES `anticipos` WRITE;
/*!40000 ALTER TABLE `anticipos` DISABLE KEYS */;
/*!40000 ALTER TABLE `anticipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bancos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (1,'Banco Santander',1433418561,1433418561),(2,'Banco Popular',1433418581,1433418581),(3,'BBVA',1433418591,1433418591);
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entregas`
--

DROP TABLE IF EXISTS `entregas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entregas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `albaran` int(5) NOT NULL,
  `variedad` int(11) NOT NULL,
  `tam` int(4) NOT NULL,
  `total` int(4) NOT NULL,
  `rate_picado` int(2) NOT NULL,
  `rate_molestado` int(2) NOT NULL,
  `rate_morado` int(2) NOT NULL,
  `rate_mosca` int(2) NOT NULL,
  `rate_azofairon` int(2) NOT NULL,
  `rate_agostado` int(2) NOT NULL,
  `rate_granizado` int(2) NOT NULL,
  `rate_perdigon` int(2) NOT NULL,
  `rate_taladro` int(2) NOT NULL,
  `idpuesto` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entregas`
--

LOCK TABLES `entregas` WRITE;
/*!40000 ALTER TABLE `entregas` DISABLE KEYS */;
INSERT INTO `entregas` VALUES (1,'2015-04-12',1,1,325,120,0,0,0,0,20,0,0,0,0,2,1431778603,1431889024),(2,'2015-05-15',1,2,300,100,0,0,20,0,0,0,0,0,0,2,1431778796,1431889032),(8,'2015-06-01',2,1,10,10,0,0,0,0,0,0,0,0,0,1,1433191979,1433191979),(9,'2015-06-01',3,1,300,100,0,0,0,0,0,0,0,0,0,2,1433192623,1433192623),(10,'2015-06-01',3,1,300,123,0,0,0,0,0,0,0,0,0,1,1433192831,1433192831),(11,'2015-06-03',5,1,43,78,0,0,0,0,0,0,0,0,0,1,1433354295,1433354295);
/*!40000 ALTER TABLE `entregas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('app','default','001_create_variedads'),('app','default','002_create_proveedors'),('app','default','003_create_users'),('app','default','004_create_entregas'),('app','default','005_create_albarans'),('app','default','006_create_puestos'),('app','default','007_create_anticipos'),('app','default','008_create_bancos');
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedors`
--

DROP TABLE IF EXISTS `proveedors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `domicilio` varchar(120) NOT NULL,
  `poblacion` varchar(50) NOT NULL,
  `nifcif` varchar(9) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `envases` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedors`
--

LOCK TABLES `proveedors` WRITE;
/*!40000 ALTER TABLE `proveedors` DISABLE KEYS */;
INSERT INTO `proveedors` VALUES (1,'Pepito','C/ Rociito nº3','Coria','65473829V','678543212','persona fisica','Buena gente el tipo...',20,1431773007,1433878387),(2,'Willy de Vil','C/ Cerca del rio','Coria','34567890E','678543214','persona fisica','Tiene un rabo...',0,1431773091,1433189656),(3,'Javi Master','C/ José Rodríguez de la Borbolla, nº9, blq.3 6ºD','Montequinto','28649581E','678 789 654','persona fisica','Sin palabras',0,1431773208,1433190849),(4,'Agricoria S.L.','Av. aviación, 98.','Coria','H34568732','634569812','empresa',NULL,0,1431774300,1431774300),(5,'Albertito','c/ nuestra casa, 9ºB','Montequinto','23456789T','+34 657 787 959','persona fisica','Está sobado ahora mismo....',0,1432137443,1433190800),(6,'Manolito#1','c/ Manolito, nº1','Montequinto','23456789T','665143492','persona fisica','Es manolito 1.',0,1433190480,1433190762),(7,'Manolito#2','c/ Manolito, nº2','Montequinto','28649581E','665143491','persona fisica','Es manolito 2.',10,1433190896,1433875840);
/*!40000 ALTER TABLE `proveedors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puestos`
--

DROP TABLE IF EXISTS `puestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puestos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puestos`
--

LOCK TABLES `puestos` WRITE;
/*!40000 ALTER TABLE `puestos` DISABLE KEYS */;
INSERT INTO `puestos` VALUES (1,'Coria',1433401494,1433401494),(2,'Bollullos',1433401509,1433401509),(4,'Soporte',1433515122,1433515122);
/*!40000 ALTER TABLE `puestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `idpuesto` tinyint(4) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Javi crack','b5aa23af1eb1e5014550e0b559bdb48d',4,1431892120,1434087568),(2,'Rocío','e807f1fcf82d132f9bb018ca6738a19f',1,1431892835,1434087458),(3,'Pedro','f40a37048732da05928c3d374549c832',2,1433972597,1434087410);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variedads`
--

DROP TABLE IF EXISTS `variedads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variedads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `en_anticipo` tinyint(4) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variedads`
--

LOCK TABLES `variedads` WRITE;
/*!40000 ALTER TABLE `variedads` DISABLE KEYS */;
INSERT INTO `variedads` VALUES (1,'Manzanilla',1,1431763209,1431763209),(2,'Gordal',1,1431763236,1431763236),(3,'Molino',0,1431763248,1431763248);
/*!40000 ALTER TABLE `variedads` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-19 17:20:57
