-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: registro_alumnos
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id_alumno` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `grupo` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave_carrera` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  UNIQUE KEY `matricula` (`matricula`),
  UNIQUE KEY `correo` (`correo`),
  KEY `clave_carrera` (`clave_carrera`),
  CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`clave_carrera`) REFERENCES `carreras` (`clave_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (1,'Saucedo Martinez Said','21302099','1001','21302099@utfv.edu.mx','DGS'),(2,'Fernando Lugo Hernandez','21302053','1001','21302053@utfv.edu.mx','DGS'),(3,'Joshep Dominic Contreras Soreque','22102006','1001','22102006@utfv.edu.mx','DGS'),(4,'Lucero Vazquez Ramos','22102014','701','22102014@utfv.edu.mx','IND'),(5,'Erick Mendoza Bautista','22302018','801','22302018@utfv.edu.mx','LOG'),(6,'Andrea Solis Morales','22302045','1101','22302045@utfv.edu.mx','DAI'),(7,'Carlos Rivas Jimenez','22301010','201','22301010@utfv.edu.mx','DSM'),(8,'Mariana Torres Aguilar','22301012','301','22301012@utfv.edu.mx','MER'),(9,'Diego Armando Leal Ponce','22301025','401','22301025@utfv.edu.mx','BIO'),(10,'Jessica Paola Martínez Cruz','22301031','501','22301031@utfv.edu.mx','AUT');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-21 16:12:13
