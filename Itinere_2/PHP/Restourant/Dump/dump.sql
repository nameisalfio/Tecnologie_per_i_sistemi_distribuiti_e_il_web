CREATE DATABASE  IF NOT EXISTS `ristorante` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ristorante`;
-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: ristorante
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

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
-- Table structure for table `cameriere`
--

DROP TABLE IF EXISTS `cameriere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cameriere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  `cognome` varchar(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cameriere`
--

LOCK TABLES `cameriere` WRITE;
/*!40000 ALTER TABLE `cameriere` DISABLE KEYS */;
INSERT INTO `cameriere` VALUES (1,'Mario','Rossi','m.rossi','m.rossi'),(2,'Luca','Bianchi','l.bianchi','l.bianchi'),(3,'Giulia','Verdi','g.verdi','g.verdi'),(4,'Paolo','Neri','p.neri','p.neri'),(5,'Anna','Gialli','a.gialli','a.gialli'),(8,'Eva','Di Carlo','diceva','diceva');
/*!40000 ALTER TABLE `cameriere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) DEFAULT NULL,
  `cognome` varchar(25) DEFAULT NULL,
  `id_tavolo` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tavolo_idx` (`id_tavolo`),
  CONSTRAINT `id_tavolo_cliente` FOREIGN KEY (`id_tavolo`) REFERENCES `tavolo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (19,'eduerdo','martinez',4),(21,'ana','eduar',6),(23,'Matteo','Vullo',2);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `controlla_numero_posti` BEFORE INSERT ON `cliente` FOR EACH ROW BEGIN















  DECLARE num_posti_tavolo INT;















  DECLARE num_clienti_tavolo INT;































-- vede numero di posti nel tavolo















  SELECT num_posti INTO num_posti_tavolo















  FROM tavolo















  WHERE id = NEW.id_tavolo;















  















-- vede numero di clienti nel tavolo















  SELECT COUNT(*) INTO num_clienti_tavolo















  FROM cliente















  WHERE id_tavolo = NEW.id_tavolo;































  IF num_clienti_tavolo >= num_posti_tavolo THEN















    SIGNAL SQLSTATE '45000'















    SET MESSAGE_TEXT = 'Il tavolo ha raggiunto il limite di posti consentiti';















  END IF;















END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `tavolo_occupato` AFTER INSERT ON `cliente` FOR EACH ROW BEGIN















  UPDATE tavolo















  SET stato = 'occupato'















  WHERE id = NEW.id_tavolo;















END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `ordine`
--

DROP TABLE IF EXISTS `ordine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tavolo` int NOT NULL,
  `id_piatto` int DEFAULT NULL,
  `stato` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tavolo_idx` (`id_tavolo`),
  KEY `id_piatto_idx` (`id_piatto`),
  CONSTRAINT `id_piatto` FOREIGN KEY (`id_piatto`) REFERENCES `piatto` (`id`),
  CONSTRAINT `id_tavolo` FOREIGN KEY (`id_tavolo`) REFERENCES `tavolo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordine`
--

LOCK TABLES `ordine` WRITE;
/*!40000 ALTER TABLE `ordine` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordine` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `elimina_pagamento` BEFORE INSERT ON `ordine` FOR EACH ROW BEGIN        















    -- Verifica se esiste già un pagamento 'pagato' per lo stesso tavolo















    IF EXISTS (















        SELECT 1















        FROM pagamento















        WHERE id_tavolo = NEW.id_tavolo AND stato = 'pagato'















    ) THEN















        -- Elimina il pagamento 'pagato' precedente















        DELETE FROM pagamento















        WHERE id_tavolo = NEW.id_tavolo AND stato = 'pagato';















    END IF;















END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `inserisci_pagamento` AFTER INSERT ON `ordine` FOR EACH ROW BEGIN



    DECLARE total_cost DECIMAL(10, 2);



    -- Calcola il totale dei costi dei piatti nell'ordine



    SET total_cost = (



        SELECT SUM(p.costo)



        FROM piatto p



        WHERE p.id = NEW.id_piatto



    );



    -- Verifica se esiste già un pagamento per lo stesso tavolo



    IF EXISTS (SELECT 1 FROM pagamento WHERE id_tavolo = NEW.id_tavolo AND stato = 'non pagato') THEN



        -- Aggiorna il pagamento esistente



        UPDATE pagamento



        SET costo_totale = costo_totale + total_cost



        WHERE id_tavolo = NEW.id_tavolo AND stato = 'non pagato';



    ELSE



        -- Inserisci un nuovo record di pagamento



        INSERT INTO pagamento (id_tavolo, costo_totale, stato, data)



        VALUES (NEW.id_tavolo, total_cost, 'non pagato', NOW());



    END IF;



END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `aggiorna_costo_update` AFTER UPDATE ON `ordine` FOR EACH ROW BEGIN



  IF NEW.id_piatto <> OLD.id_piatto THEN



    -- Calcola il nuovo costo totale dell'ordine e aggiorna il pagamento



    UPDATE pagamento



    SET costo_totale = (



						  SELECT SUM(p.costo)



						  FROM ordine o



						  JOIN piatto p ON o.id_piatto = p.id



						  WHERE o.id_tavolo = NEW.id_tavolo



						)



    WHERE id_tavolo = NEW.id_tavolo;



  END IF;



END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tavolo` int NOT NULL,
  `costo_totale` decimal(5,2) unsigned NOT NULL,
  `stato` varchar(10) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ordine_idx` (`id_tavolo`),
  CONSTRAINT `id_ordine` FOREIGN KEY (`id_tavolo`) REFERENCES `tavolo` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamento`
--

LOCK TABLES `pagamento` WRITE;
/*!40000 ALTER TABLE `pagamento` DISABLE KEYS */;
INSERT INTO `pagamento` VALUES (4,2,0.00,'pagato','2023-09-28'),(5,3,0.00,'pagato','2023-09-29'),(6,1,0.00,'pagato','2023-09-29'),(7,5,0.00,'pagato','2023-09-29');
/*!40000 ALTER TABLE `pagamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `libera_tavolo_aggiornamento` BEFORE UPDATE ON `pagamento` FOR EACH ROW BEGIN

  IF NEW.stato = 'pagato' THEN

    UPDATE tavolo

    SET tavolo.stato = 'libero'

    WHERE tavolo.id = NEW.id_tavolo;

    DELETE FROM cliente

    WHERE cliente.id_tavolo = NEW.id_tavolo;

	UPDATE tavolo

    SET tavolo.id_cameriere = null

    WHERE tavolo.id = NEW.id_tavolo;

	DELETE FROM ordine

    WHERE ordine.id_tavolo = NEW.id_tavolo;

  END IF;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `piatto`
--

DROP TABLE IF EXISTS `piatto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `piatto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `costo` decimal(5,2) NOT NULL,
  `descrizione` varchar(125) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `immagine` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `piatto`
--

LOCK TABLES `piatto` WRITE;
/*!40000 ALTER TABLE `piatto` DISABLE KEYS */;
INSERT INTO `piatto` VALUES (1,'Margherita',7.50,'Descrizione della margherita','cibo','margherita'),(2,'Amatriciana',12.00,'Descrizione della Amatriciana','cibo','amatriciana'),(3,'Patatine',2.50,'Descrizione delle Patatine','cibo','patatine'),(4,'Involtini',8.50,'Descrizione della Margherita','cibo','involtini'),(5,'Insalata',10.00,'Descrizione dell\'Insalata','cibo','insalata'),(6,'Pokè',15.00,'Descrizione del Pokè','cibo','poke'),(7,'Polpette al sugo',13.70,'Descrizione delle Polpette al sugo','cibo','polpette_al_sugo'),(8,'Lasagne',14.00,'Descrizione delle Lasagne','cibo','lasagne'),(9,'Pasta al pomodoro',8.00,'Descrizione della Pasta al pomodoro','cibo','pasta_al_pomodoro'),(10,'Carbonara',12.50,'Descrizione della Carbonara','cibo','carbonara'),(11,'Parmigiana',12.00,'Descrizione della Parmigiana','cibo','parmigiana'),(12,'Insalata di mare',14.80,'Descrizione dell\' Insalata di marer','cibo','insalata_mare'),(13,'Linguine allo scoglio',13.70,'Descrizione delle linguine allo scoglio','cibo','linguine_scoglio'),(14,'Acqua',1.50,'Descrizione dell\'acqua','bevanda','acqua'),(15,'Birra',4.50,'Descrizione della Birra','bevanda','birra'),(16,'Torta al Cioccolato',6.75,'Descrizione della Torta al Cioccolato','cibo','torta_cioccolato'),(17,'Risotto al Limone',11.99,'Descrizione del Risotto al Limone','cibo','risotto_limone'),(18,'Coca-Cola',2.25,'Descrizione della Coca-Cola','bevanda','coca_cola'),(19,'Tortellini alla Panna',10.50,'Descrizione dei Tortellini alla Panna','cibo','tortellini_panna'),(20,'Fanta',2.99,'Descrizione della Fanta','bevanda','fanta'),(21,'Vino rosso',7.50,'Descrizione del Vino rosso','bevanda','vino_rosso'),(22,'Vino bianco',7.50,'Descrizione del Vino bianco','bevanda','vino_bianco'),(23,'Caffè espresso',1.20,'Descrizione del Caffè espresso','bevanda','caffe');
/*!40000 ALTER TABLE `piatto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tavolo`
--

DROP TABLE IF EXISTS `tavolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tavolo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cameriere` int DEFAULT NULL,
  `num_posti` int NOT NULL,
  `stato` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cameriere_idx` (`id_cameriere`),
  CONSTRAINT `id_cameriere` FOREIGN KEY (`id_cameriere`) REFERENCES `cameriere` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tavolo`
--

LOCK TABLES `tavolo` WRITE;
/*!40000 ALTER TABLE `tavolo` DISABLE KEYS */;
INSERT INTO `tavolo` VALUES (1,5,4,'occupato'),(2,NULL,2,'libero'),(3,NULL,6,'libero'),(4,NULL,4,'libero'),(5,NULL,3,'libero'),(6,NULL,5,'libero'),(7,NULL,7,'libero'),(8,NULL,8,'libero'),(9,NULL,2,'libero'),(10,NULL,4,'libero');
/*!40000 ALTER TABLE `tavolo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ristorante'
--

--
-- Dumping routines for database 'ristorante'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-15 16:47:12
