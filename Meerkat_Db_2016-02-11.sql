CREATE DATABASE  IF NOT EXISTS `meerkat_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `meerkat_db`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 192.168.1.105    Database: meerkat_db
-- ------------------------------------------------------
-- Server version	5.5.38-0+wheezy1

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
-- Table structure for table `accesos`
--

DROP TABLE IF EXISTS `accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesos` (
  `cod_acceso` int(11) NOT NULL AUTO_INCREMENT,
  `cod_perf` int(11) NOT NULL,
  `cod_OM` int(11) NOT NULL,
  `tipo_acceso` int(11) NOT NULL,
  PRIMARY KEY (`cod_acceso`),
  KEY `cod_perf` (`cod_perf`),
  KEY `cod_OM` (`cod_OM`),
  KEY `tipo_acceso` (`tipo_acceso`),
  CONSTRAINT `accesos_ibfk_1` FOREIGN KEY (`cod_perf`) REFERENCES `perfiles` (`cod_perf`),
  CONSTRAINT `accesos_ibfk_2` FOREIGN KEY (`cod_OM`) REFERENCES `opciones_de_menu` (`cod_OM`),
  CONSTRAINT `accesos_ibfk_3` FOREIGN KEY (`tipo_acceso`) REFERENCES `tipos_acceso` (`cod_TA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activos_fijos`
--

DROP TABLE IF EXISTS `activos_fijos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activos_fijos` (
  `cod_af` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_af` int(10) NOT NULL,
  `nombre_af` varchar(30) NOT NULL,
  `fechacompra_af` date NOT NULL,
  `cod_estado` int(11) NOT NULL,
  `costo_af` float NOT NULL,
  `garantia_af` int(11) NOT NULL,
  `nroserie_af` varchar(30) DEFAULT NULL,
  `hardware_af` varchar(255) DEFAULT NULL,
  `cod_categ` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `depto_af` int(11) DEFAULT '0',
  `user_af` int(11) DEFAULT '0',
  PRIMARY KEY (`cod_af`),
  KEY `cod_prov` (`cod_prov`),
  KEY `cod_categ` (`cod_categ`),
  KEY `cod_estado` (`cod_estado`),
  CONSTRAINT `activos_fijos_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estados` (`cod_estado`),
  CONSTRAINT `activos_fijos_ibfk_2` FOREIGN KEY (`cod_categ`) REFERENCES `categorias` (`cod_categ`),
  CONSTRAINT `activos_fijos_ibfk_3` FOREIGN KEY (`cod_prov`) REFERENCES `proveedores` (`cod_prov`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activos_fijos`
--

LOCK TABLES `activos_fijos` WRITE;
/*!40000 ALTER TABLE `activos_fijos` DISABLE KEYS */;
INSERT INTO `activos_fijos` VALUES (1,123,'PC Fer','2015-05-20',4,15000,32,'adasd','asdasdsadadasd',2,2,2,0),(2,223,'Otra pc','2006-10-04',5,2,2,'kljhdfadj ','A ver que es esto',2,2,4,0),(3,5151515,'alguna cosa','2015-03-11',6,2500,10,'gg-5585','ni idea que es',2,1,4,1),(4,9999,'cosas','2015-11-27',6,500,50,'1232321321','s,dn asdÃ±lf Ã±lasdkfja lÃ±kj',2,1,4,0),(5,5555555,'slkdfj ','2015-11-27',3,20000,10,'asÃ±dsass+*','sdfasdfasdf',3,1,4,0);
/*!40000 ALTER TABLE `activos_fijos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `cod_area` int(11) NOT NULL AUTO_INCREMENT,
  `des_area` varchar(30) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  `cod_user` int(11) NOT NULL,
  PRIMARY KEY (`cod_area`),
  KEY `cod_user` (`cod_user`),
  KEY `cod_estado` (`cod_estado`),
  KEY `cod_user_2` (`cod_user`),
  CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estados` (`cod_estado`),
  CONSTRAINT `areas_ibfk_2` FOREIGN KEY (`cod_user`) REFERENCES `usuarios` (`cod_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Sistemas22',1,1),(2,'Prueba',2,1),(3,'Prueba22',2,1),(4,'Prueba3',1,1),(5,'Prueba51',1,1),(6,'Area51',1,1);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asignaciones`
--

DROP TABLE IF EXISTS `asignaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignaciones` (
  `cod_asig` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_asig` date NOT NULL,
  `cod_user` int(11) DEFAULT NULL,
  `cod_tipo` int(11) NOT NULL,
  `codigo_asig` int(11) NOT NULL COMMENT 'codigo del insumo asignado!! ya sea AF o cons',
  `cod_depto` int(11) DEFAULT NULL,
  `cantidad` int(50) NOT NULL,
  PRIMARY KEY (`cod_asig`),
  KEY `cod_user` (`cod_user`),
  KEY `cod_tipo` (`cod_tipo`),
  KEY `cod_depto` (`cod_depto`),
  CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`cod_user`) REFERENCES `usuarios` (`cod_user`),
  CONSTRAINT `asignaciones_ibfk_3` FOREIGN KEY (`cod_depto`) REFERENCES `departamentos` (`cod_depto`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignaciones`
--

LOCK TABLES `asignaciones` WRITE;
/*!40000 ALTER TABLE `asignaciones` DISABLE KEYS */;
INSERT INTO `asignaciones` VALUES (3,'2015-11-29',NULL,0,5,2,10),(4,'2015-11-29',NULL,0,3,2,65),(5,'2015-12-01',NULL,0,2,3,5),(6,'2015-12-01',NULL,0,1,3,10),(7,'2015-11-11',NULL,1,2,1,13),(8,'2015-12-02',NULL,1,1,1,14),(9,'2015-12-03',NULL,0,1,2,0),(10,'2015-12-05',NULL,1,5,3,1),(11,'2015-12-06',NULL,1,5,2,2),(12,'2015-12-06',1,1,10,NULL,1),(13,'2015-12-06',2,1,10,NULL,1);
/*!40000 ALTER TABLE `asignaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `cod_categ` int(11) NOT NULL AUTO_INCREMENT,
  `desc_categ` varchar(30) NOT NULL,
  `ptopedido_categ` int(11) DEFAULT NULL,
  `cod_estado` int(11) NOT NULL,
  `vidautil_categ` int(11) DEFAULT NULL,
  `cod_tipo` int(11) NOT NULL,
  PRIMARY KEY (`cod_categ`),
  KEY `cod_tipo` (`cod_tipo`),
  KEY `cod_tipo_2` (`cod_tipo`),
  KEY `cod_tipo_3` (`cod_tipo`),
  KEY `cod_tipo_4` (`cod_tipo`),
  KEY `cod_estado` (`cod_estado`),
  KEY `cod_tipo_5` (`cod_tipo`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estados` (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Mouses',5,1,0,2),(2,'Desktop PC',0,1,5,1),(3,'Servers',0,1,10,1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra_cons`
--

DROP TABLE IF EXISTS `compra_cons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra_cons` (
  `cod_cpra` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_cpra` date NOT NULL,
  `costounit_cpra` float NOT NULL,
  `cantidad_cpra` int(11) NOT NULL,
  `cod_cons` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  PRIMARY KEY (`cod_cpra`),
  KEY `cod_cons` (`cod_cons`),
  KEY `cod_prov` (`cod_prov`),
  CONSTRAINT `compra_cons_ibfk_1` FOREIGN KEY (`cod_cons`) REFERENCES `consumibles` (`cod_cons`),
  CONSTRAINT `compra_cons_ibfk_2` FOREIGN KEY (`cod_prov`) REFERENCES `proveedores` (`cod_prov`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra_cons`
--

LOCK TABLES `compra_cons` WRITE;
/*!40000 ALTER TABLE `compra_cons` DISABLE KEYS */;
INSERT INTO `compra_cons` VALUES (1,'2015-12-02',20,50,2,1);
/*!40000 ALTER TABLE `compra_cons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumibles`
--

DROP TABLE IF EXISTS `consumibles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumibles` (
  `cod_cons` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_cons` varchar(10) NOT NULL,
  `desc_cons` varchar(30) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  `costo_cons` float DEFAULT NULL,
  `stock_cons` int(11) NOT NULL,
  `nroSerie_cons` varchar(30) DEFAULT NULL,
  `reciclable_cons` varchar(11) NOT NULL,
  `cod_categ` int(11) NOT NULL,
  `depto_con` int(11) NOT NULL,
  `fechacompra_con` date NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `recicla_cons` int(11) NOT NULL,
  PRIMARY KEY (`cod_cons`),
  KEY `cod_categ` (`cod_categ`),
  CONSTRAINT `consumibles_ibfk_1` FOREIGN KEY (`cod_categ`) REFERENCES `categorias` (`cod_categ`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumibles`
--

LOCK TABLES `consumibles` WRITE;
/*!40000 ALTER TABLE `consumibles` DISABLE KEYS */;
INSERT INTO `consumibles` VALUES (1,'111','cartcho hp',6,500,46,NULL,'si',1,3,'2015-11-24',1,3),(2,'222','teclado',3,20,47,NULL,'no',1,4,'2015-11-29',1,0),(3,'333','mouse',6,100,3,NULL,'Si',1,4,'2015-11-29',2,0),(5,'1212','cvvx',3,110,94,NULL,'Si',1,4,'2015-11-29',1,0),(6,'555','hgjghj',3,100,100,NULL,'No',1,4,'2015-11-10',0,0),(7,'666','1111',3,50,0,NULL,'No',1,4,'2015-11-17',0,0),(10,'777','teclas',3,52,45,NULL,'Si',1,0,'2015-11-29',2,0),(11,'11111','kasjhd akjh ',3,1000,0,NULL,'Si',1,0,'2015-12-10',1,0),(12,'1111','10101',3,10000,100,NULL,'Si',1,0,'2015-12-03',2,0);
/*!40000 ALTER TABLE `consumibles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `cod_depto` int(11) NOT NULL AUTO_INCREMENT,
  `desc_depto` varchar(30) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  `cod_user` int(11) NOT NULL,
  `cod_area` int(11) NOT NULL,
  PRIMARY KEY (`cod_depto`),
  KEY `cod_user` (`cod_user`),
  KEY `cod_area` (`cod_area`),
  KEY `cod_estado` (`cod_estado`),
  CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estados` (`cod_estado`),
  CONSTRAINT `departamentos_ibfk_2` FOREIGN KEY (`cod_user`) REFERENCES `usuarios` (`cod_user`),
  CONSTRAINT `departamentos_ibfk_3` FOREIGN KEY (`cod_area`) REFERENCES `areas` (`cod_area`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Tecnico',1,1,1),(2,'Funcional',1,1,4),(3,'Gerencia',1,1,1),(4,'En deposito',1,1,1);
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `cod_estado` int(11) NOT NULL AUTO_INCREMENT,
  `desc_estado` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES (1,'Habilitado'),(2,'Deshabilitado'),(3,'Disponible'),(4,'Asignado'),(5,'En Service'),(6,'De Baja'),(7,'En Reciclaje');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menues`
--

DROP TABLE IF EXISTS `menues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menues` (
  `cod_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(30) NOT NULL,
  `desc_menu` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menues`
--

LOCK TABLES `menues` WRITE;
/*!40000 ALTER TABLE `menues` DISABLE KEYS */;
INSERT INTO `menues` VALUES (1,'Activo_Fijo','Gestion de Activos Fijos'),(2,'Consumible','Gestion de Consumibles'),(3,'ABM','Mantenimiento de usuarios, categorias, departament'),(4,'Informes','Emision de Informes');
/*!40000 ALTER TABLE `menues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opciones_de_menu`
--

DROP TABLE IF EXISTS `opciones_de_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opciones_de_menu` (
  `cod_OM` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_OM` varchar(30) NOT NULL,
  `desc_OM` varchar(50) DEFAULT NULL,
  `cod_menu` int(11) NOT NULL,
  PRIMARY KEY (`cod_OM`),
  KEY `cod_menu` (`cod_menu`),
  CONSTRAINT `opciones_de_menu_ibfk_1` FOREIGN KEY (`cod_menu`) REFERENCES `menues` (`cod_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opciones_de_menu`
--

LOCK TABLES `opciones_de_menu` WRITE;
/*!40000 ALTER TABLE `opciones_de_menu` DISABLE KEYS */;
INSERT INTO `opciones_de_menu` VALUES (1,'Alta_AF','Alta de Activo Fijo',1),(2,'Asignacion_AF','Asignacion-Reasignacion de Activo Fijo',1),(3,'Service_AF','Envio de un Activo Fijo al Service',1),(4,'Reactivacion_AF','Reactivacion de un AF a la vuelta del Service',1),(5,'Baja_AF','Baja de Activo Fijo',1),(6,'Deposito_AF','Envio al deposito de un AF',1),(7,'Alta_C','Alta de Consumible',2),(8,'Asignacion_C','Asignacion-Reasignacion de un Consumible',2),(9,'Reciclar_C','Envio a Reciclar un Consumible',2),(10,'Reactivar_C','Reactivacion de un C a la vuelta del reciclaje',2),(11,'Baja_C','Baja de un consumible',2),(12,'Reabastecer_C','Reabastecimiento de un Consumible',2),(13,'Areas_ABM','ABM de areas',3),(14,'Deptos_ABM','ABM de Deptos',3),(15,'Usuarios_ABM','ABM de Usuarios',3),(16,'Categorias_ABM','ABM de Categorias',3),(17,'Proveedores_ABM','ABM de Proveedores',3),(18,'Puestos_ABM','ABM de Puestos',3),(19,'Perfiles_ABM','ABM de Perfiles',3),(20,'AF_Existentes_List','Listado de AF existentes',4),(21,'Ins_Faltantes_List','Listado de Insumos Faltantes',4),(22,'AF_Presupuesto_List','Listado de Activos Fijos para presupuesto',4),(23,'Gastos_List','Listado de Gastos por area, sector, etc',4),(24,'Activos_Amort_List','Listado de Activos Amortizables',4);
/*!40000 ALTER TABLE `opciones_de_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfiles` (
  `cod_perf` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perf` varchar(30) NOT NULL,
  `desc_perf` varchar(50) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_perf`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'Analista IT','Todo',1),(2,'Enc. de Sistemas','Informes AF\'s para presupuesto y AF\'s existentes',1),(3,'Analista Contable','Informes de Gastos y Activos amortizables',1),(4,'Analista de Compras','Informes de Insumos faltantes',1),(5,'Ninguno','Sin Acceso',1);
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `cod_prov` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prov` varchar(30) NOT NULL,
  `tel_prov` varchar(30) DEFAULT NULL,
  `mail_prov` varchar(50) DEFAULT NULL,
  `contacto_prov` varchar(50) DEFAULT NULL,
  `cod_estado` int(11) NOT NULL,
  `recicla_prov` char(1) NOT NULL,
  PRIMARY KEY (`cod_prov`),
  KEY `cod_estado` (`cod_estado`),
  CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estados` (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'fer','15313213','Fer@coen.com','fer coen',1,'S'),(2,'test','123123231','test@test','Test',1,'N');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puestos`
--

DROP TABLE IF EXISTS `puestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puestos` (
  `cod_puesto` int(11) NOT NULL AUTO_INCREMENT,
  `desc_puesto` varchar(30) NOT NULL,
  `cod_depto` int(11) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_puesto`),
  KEY `cod_depto` (`cod_depto`),
  CONSTRAINT `puestos_ibfk_1` FOREIGN KEY (`cod_depto`) REFERENCES `departamentos` (`cod_depto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puestos`
--

LOCK TABLES `puestos` WRITE;
/*!40000 ALTER TABLE `puestos` DISABLE KEYS */;
INSERT INTO `puestos` VALUES (1,'Analista Jr.',2,1),(3,'Analista Tecnico Jr',1,1),(4,'Contador',2,1);
/*!40000 ALTER TABLE `puestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puestos_x_user`
--

DROP TABLE IF EXISTS `puestos_x_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puestos_x_user` (
  `cod_user` int(11) NOT NULL,
  `cod_puesto` int(11) NOT NULL,
  PRIMARY KEY (`cod_user`,`cod_puesto`),
  KEY `cod_puesto` (`cod_puesto`),
  CONSTRAINT `puestos_x_user_ibfk_1` FOREIGN KEY (`cod_user`) REFERENCES `usuarios` (`cod_user`),
  CONSTRAINT `puestos_x_user_ibfk_2` FOREIGN KEY (`cod_puesto`) REFERENCES `puestos` (`cod_puesto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puestos_x_user`
--

LOCK TABLES `puestos_x_user` WRITE;
/*!40000 ALTER TABLE `puestos_x_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `puestos_x_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reciclados`
--

DROP TABLE IF EXISTS `reciclados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reciclados` (
  `cod_rec` int(11) NOT NULL DEFAULT '0',
  `fecha_rec` date NOT NULL,
  `costo_rec` float NOT NULL,
  `cod_cons` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  PRIMARY KEY (`cod_rec`),
  KEY `cod_cons` (`cod_cons`),
  KEY `cod_prov` (`cod_prov`),
  CONSTRAINT `reciclados_ibfk_1` FOREIGN KEY (`cod_cons`) REFERENCES `consumibles` (`cod_cons`),
  CONSTRAINT `reciclados_ibfk_2` FOREIGN KEY (`cod_prov`) REFERENCES `proveedores` (`cod_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reciclados`
--

LOCK TABLES `reciclados` WRITE;
/*!40000 ALTER TABLE `reciclados` DISABLE KEYS */;
/*!40000 ALTER TABLE `reciclados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `cod_serv` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_serv` date NOT NULL,
  `costo_serv` float NOT NULL,
  `desc_serv` varchar(255) NOT NULL,
  `cod_af` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  PRIMARY KEY (`cod_serv`),
  KEY `cod_af` (`cod_af`),
  KEY `cod_prov` (`cod_prov`),
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`cod_af`) REFERENCES `activos_fijos` (`cod_af`),
  CONSTRAINT `services_ibfk_2` FOREIGN KEY (`cod_prov`) REFERENCES `proveedores` (`cod_prov`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'2015-11-29',0,'',2,1),(2,'2015-12-01',0,'',2,1);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_acceso`
--

DROP TABLE IF EXISTS `tipos_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_acceso` (
  `cod_TA` int(11) NOT NULL AUTO_INCREMENT,
  `desc_TA` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_TA`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_acceso`
--

LOCK TABLES `tipos_acceso` WRITE;
/*!40000 ALTER TABLE `tipos_acceso` DISABLE KEYS */;
INSERT INTO `tipos_acceso` VALUES (1,'Lectura'),(2,'Escritura'),(3,'Deshabilitado');
/*!40000 ALTER TABLE `tipos_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_categ`
--

DROP TABLE IF EXISTS `tipos_categ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_categ` (
  `cod_Tipo` int(11) NOT NULL,
  `desc_Tipo` varchar(30) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_Tipo`),
  KEY `cod_estado` (`cod_estado`),
  CONSTRAINT `tipos_categ_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estados` (`cod_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_categ`
--

LOCK TABLES `tipos_categ` WRITE;
/*!40000 ALTER TABLE `tipos_categ` DISABLE KEYS */;
INSERT INTO `tipos_categ` VALUES (1,'Activo Fijo',1),(2,'Consumible',1);
/*!40000 ALTER TABLE `tipos_categ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `cod_user` int(11) NOT NULL AUTO_INCREMENT,
  `login_user` varchar(10) NOT NULL,
  `nombre_user` varchar(30) NOT NULL,
  `tel_user` varchar(30) NOT NULL,
  `mail_user` varchar(50) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  `pass_user` varchar(50) DEFAULT NULL,
  `cod_puesto` int(11) NOT NULL,
  `cod_perf` int(11) NOT NULL,
  PRIMARY KEY (`cod_user`),
  KEY `cod_puesto` (`cod_puesto`),
  KEY `cod_perf` (`cod_perf`),
  KEY `cod_estado` (`cod_estado`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estados` (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'fer','Fernando Coen','152550375','fercoen@gmail.com',1,'81dc9bdb52d04dc20036dbd8313ed055',1,1),(2,'caro','Carolina Salcedo','1234123','caro@caro',1,NULL,1,2),(3,'fabri','Fabrik Hernandez','12343123123','fabrik@fabri',2,'e10adc3949ba59abbe56e057f20f883e',4,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'meerkat_db'
--

--
-- Dumping routines for database 'meerkat_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-11  1:52:32
