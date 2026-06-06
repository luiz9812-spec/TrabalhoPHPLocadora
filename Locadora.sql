-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: locadora
-- ------------------------------------------------------
-- Server version	8.0.46

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `CPF` char(11) NOT NULL,
  `NOME` varchar(50) DEFAULT NULL,
  `NASCIMENTO` date DEFAULT NULL,
  `ENDERECO` varchar(50) DEFAULT NULL,
  `CIDADE` varchar(50) DEFAULT NULL,
  `ESTADO` char(2) DEFAULT NULL,
  `TELEFONE` varchar(15) DEFAULT NULL,
  `EMAIL` varchar(254) NOT NULL,
  `SENHA` varchar(50) NOT NULL,
  PRIMARY KEY (`CPF`),
  KEY `IDX_CLIENTES` (`CPF`,`NOME`,`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES ('12345678901','ANA SOUZA','1995-03-12','RUA DAS FLORES','SAO PAULO','SP','11988887777','ana.souza@email.com','1234'),('23456789012','BRUNO ALMEIDA','1988-07-25','AVENIDA BRASIL','CAMPINAS','SP','19977776666','bruno.almeida@email.com','1234'),('34567890123','CARLA MENDES','1992-11-03','RUA DAS ACACIAS','SOROCABA','SP','15966665555','carla.mendes@email.com','1234'),('45678901234','DIEGO FERREIRA','1990-01-18','RUA CENTRAL','RIBEIRAO PRETO','SP','16955554444','diego.ferreira@email.com','1234'),('56789012345','ELISA COSTA','1997-09-09','AVENIDA PAULISTA','SAO PAULO','SP','11944443333','elisa.costa@email.com','1234'),('67890123456','FELIPE ROCHA','1985-05-30','RUA NOVA','JUNDIAI','SP','11933332222','felipe.rocha@email.com','1234'),('68119358040','JORGE NOGUEIRA','1990-07-10','RUA DOS SANTOS','SAO PAULO','SP','17999999999','jorge.nogueira@email.com','1234'),('78901234567','GABRIELA LIMA','1993-12-14','RUA DO SOL','OSASCO','SP','11922221111','gabriela.lima@email.com','1234'),('89012345678','HENRIQUE MARTINS','1989-06-21','RUA DAS PEDRAS','MOGI DAS CRUZES','SP','11911110000','henrique.martins@email.com','1234'),('90123456789','ISABELA PEREIRA','1996-10-05','AVENIDA LITORANEA','SANTOS','SP','13999998888','isabela.pereira@email.com','1234');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desenvolvedoras`
--

DROP TABLE IF EXISTS `desenvolvedoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `desenvolvedoras` (
  `ID_DESENVOLVEDORA` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_DESENVOLVEDORA`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desenvolvedoras`
--

LOCK TABLES `desenvolvedoras` WRITE;
/*!40000 ALTER TABLE `desenvolvedoras` DISABLE KEYS */;
INSERT INTO `desenvolvedoras` VALUES (1,'NINTENDO'),(2,'SEGA'),(3,'SONY'),(4,'MICROSOFT'),(5,'BANDAI'),(6,'SQUARE'),(7,'CAPCOM'),(8,'FROMSOFTWARE'),(9,'HAL LABORATORY'),(10,'SNK');
/*!40000 ALTER TABLE `desenvolvedoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emprestimos`
--

DROP TABLE IF EXISTS `emprestimos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emprestimos` (
  `ID_EMPRESTIMO` int NOT NULL AUTO_INCREMENT,
  `ID_JOGO` int DEFAULT NULL,
  `CPF` char(11) DEFAULT NULL,
  `DATA_EMPRESTIMO` date DEFAULT NULL,
  `DATA_ENTREGA` date DEFAULT NULL,
  `DEVOLVIDO` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID_EMPRESTIMO`),
  KEY `ID_JOGO` (`ID_JOGO`),
  KEY `CPF` (`CPF`),
  CONSTRAINT `emprestimos_ibfk_1` FOREIGN KEY (`ID_JOGO`) REFERENCES `jogos` (`ID_JOGO`),
  CONSTRAINT `emprestimos_ibfk_2` FOREIGN KEY (`CPF`) REFERENCES `clientes` (`CPF`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprestimos`
--

LOCK TABLES `emprestimos` WRITE;
/*!40000 ALTER TABLE `emprestimos` DISABLE KEYS */;
INSERT INTO `emprestimos` VALUES (1,1,'68119358040','2026-05-01','2026-05-10',1),(2,2,'12345678901','2026-05-03','2026-05-12',1),(3,3,'23456789012','2026-05-05','2026-05-15',0),(4,4,'34567890123','2026-05-06','2026-05-16',0),(5,5,'45678901234','2026-05-07','2026-05-17',1),(6,6,'56789012345','2026-05-08','2026-05-18',0),(7,7,'67890123456','2026-05-09','2026-05-19',1),(8,8,'78901234567','2026-05-10','2026-05-20',0),(9,9,'89012345678','2026-05-11','2026-05-21',0),(10,10,'90123456789','2026-05-12','2026-05-22',1);
/*!40000 ALTER TABLE `emprestimos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generos` (
  `ID_GENERO` int NOT NULL AUTO_INCREMENT,
  `ID_JOGO` int DEFAULT NULL,
  `ID_LISTAGENERO` int DEFAULT NULL,
  PRIMARY KEY (`ID_GENERO`),
  KEY `ID_JOGO` (`ID_JOGO`),
  KEY `ID_LISTAGENERO` (`ID_LISTAGENERO`),
  CONSTRAINT `generos_ibfk_1` FOREIGN KEY (`ID_JOGO`) REFERENCES `jogos` (`ID_JOGO`),
  CONSTRAINT `generos_ibfk_2` FOREIGN KEY (`ID_LISTAGENERO`) REFERENCES `listageneros` (`ID_LISTAGENERO`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,1,1),(2,1,8),(3,2,1),(4,2,4),(5,3,1),(6,3,8),(7,4,4),(8,4,8),(9,5,2),(10,6,2),(11,7,7),(12,8,1),(13,8,8),(14,9,3),(15,10,3);
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jogos`
--

DROP TABLE IF EXISTS `jogos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jogos` (
  `ID_JOGO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(50) DEFAULT NULL,
  `ID_DESENVOLVEDORA` int NOT NULL,
  `LANCAMENTO` year DEFAULT NULL,
  `ID_PUBLISHER` int NOT NULL,
  `JOGADORES` int DEFAULT NULL,
  `DESCRICAO` text,
  `ID_PLATAFORMA` int NOT NULL,
  `DISPONIVEL` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID_JOGO`),
  KEY `ID_DESENVOLVEDORA` (`ID_DESENVOLVEDORA`),
  KEY `ID_PUBLISHER` (`ID_PUBLISHER`),
  KEY `ID_PLATAFORMA` (`ID_PLATAFORMA`),
  KEY `IDX_JOGOS` (`ID_JOGO`,`NOME`,`ID_DESENVOLVEDORA`,`ID_PUBLISHER`,`ID_PLATAFORMA`),
  CONSTRAINT `jogos_ibfk_1` FOREIGN KEY (`ID_DESENVOLVEDORA`) REFERENCES `desenvolvedoras` (`ID_DESENVOLVEDORA`),
  CONSTRAINT `jogos_ibfk_2` FOREIGN KEY (`ID_PUBLISHER`) REFERENCES `publishers` (`ID_PUBLISHER`),
  CONSTRAINT `jogos_ibfk_3` FOREIGN KEY (`ID_PLATAFORMA`) REFERENCES `plataformas` (`ID_PLATAFORMA`),
  CONSTRAINT `jogos_chk_1` CHECK (((`JOGADORES` >= 1) and (`JOGADORES` <= 4)))
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jogos`
--

LOCK TABLES `jogos` WRITE;
/*!40000 ALTER TABLE `jogos` DISABLE KEYS */;
INSERT INTO `jogos` VALUES (1,'SUPER MARIO BROS',1,1985,1,2,'Derrote o temível Bowser, salve a Princesa Peach e descubra por que este título definiu gerações! Jogue sozinho ou com um amigo!',1,1),(2,'MEGA MAN X',7,1993,7,1,'Evolua o seu arsenal, derrote os temíveis Mavericks e descubra por que este título redefiniu a ação nos videogames!',2,1),(3,'SONIC THE HEDGEHOG',2,1991,2,1,'O jogador controla Sonic, cujo objetivo é parar os planos de Robotnik, salvando os animais e recuperar as Esmeraldas.',7,1),(4,'METROID',1,1986,1,1,'Metroid é um jogo de ação e aventura de rolagem lateral no qual o jogador controla Samus Aran em ambientes bidimensionais.',1,1),(5,'STREET FIGHTER II: THE WORLD WARRIOR',7,1991,7,2,' O jogador enfrenta o seu adversário em combates um-contra-um num ambiente fechado, em séries de melhor de três.',2,1),(6,'THE KING OF FIGHTERS 2002',10,2003,10,2,'O jogador enfrenta o seu adversário em combates um-contra-um num ambiente fechado, usando um time de 3 lutadores.',9,1),(7,'DAYTONA USA',2,1995,2,4,'Uma jogabilidade simples, que não priorizava o realismo e sim a diversão, com colisões fantasiosas e cheias de efeitos, tornando o seu aprendizado inicial fácil e de certo modo, viciante.',8,1),(8,'ALEX KIDD IN MIRACLE WORLD',2,1986,2,1,'Jogo de plataforma em 2D, semelhante ao Super Mario Bros. da Nintendo.',6,1),(9,'DARK SOULS',8,2011,5,1,'O enredo de Dark Souls se passa no reino fictício de Lordran, onde os jogadores assumem o papel de um personagem morto-vivo amaldiçoado que inicia uma peregrinação para descobrir o destino de sua espécie.',12,1),(10,'DARK SOULS',8,2011,5,1,'O enredo de Dark Souls se passa no reino fictício de Lordran, onde os jogadores assumem o papel de um personagem morto-vivo amaldiçoado que inicia uma peregrinação para descobrir o destino de sua espécie.',13,1);
/*!40000 ALTER TABLE `jogos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listageneros`
--

DROP TABLE IF EXISTS `listageneros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `listageneros` (
  `ID_LISTAGENERO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_LISTAGENERO`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listageneros`
--

LOCK TABLES `listageneros` WRITE;
/*!40000 ALTER TABLE `listageneros` DISABLE KEYS */;
INSERT INTO `listageneros` VALUES (1,'PLATAFORMA'),(2,'LUTA'),(3,'RPG'),(4,'ACAO'),(5,'FPS'),(6,'ESPORTES'),(7,'CORRIDA'),(8,'AVENTURA'),(9,'VISUAL NOVEL'),(10,'ESTRATEGIA');
/*!40000 ALTER TABLE `listageneros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plataformas`
--

DROP TABLE IF EXISTS `plataformas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plataformas` (
  `ID_PLATAFORMA` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(50) DEFAULT NULL,
  `ID_DESENVOLVEDORA` int DEFAULT NULL,
  PRIMARY KEY (`ID_PLATAFORMA`),
  KEY `ID_DESENVOLVEDORA` (`ID_DESENVOLVEDORA`),
  CONSTRAINT `plataformas_ibfk_1` FOREIGN KEY (`ID_DESENVOLVEDORA`) REFERENCES `desenvolvedoras` (`ID_DESENVOLVEDORA`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plataformas`
--

LOCK TABLES `plataformas` WRITE;
/*!40000 ALTER TABLE `plataformas` DISABLE KEYS */;
INSERT INTO `plataformas` VALUES (1,'NINTENDO ENTERTAINMENT SYSTEM',1),(2,'SUPER NINTENDO',1),(3,'NINTENDO 64',1),(4,'GAMECUBE',1),(5,'WII',1),(6,'MASTER SYSTEM',2),(7,'MEGA DRIVE',2),(8,'SEGA SATURN',2),(9,'DREAMCAST',2),(10,'PLAYSTATION',3),(11,'PLAYSTATION2',3),(12,'PLAYSTATION3',3),(13,'PLAYSTATION4',3),(14,'XBOX',4),(15,'XBOX360',4),(16,'XBOXONE',4);
/*!40000 ALTER TABLE `plataformas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publishers` (
  `ID_PUBLISHER` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_PUBLISHER`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publishers`
--

LOCK TABLES `publishers` WRITE;
/*!40000 ALTER TABLE `publishers` DISABLE KEYS */;
INSERT INTO `publishers` VALUES (1,'NINTENDO'),(2,'SEGA'),(3,'SONY'),(4,'MICROSOFT'),(5,'BANDAI'),(6,'SQUARE'),(7,'CAPCOM'),(8,'505 GAMES'),(9,'ROCKSTAR'),(10,'SNK');
/*!40000 ALTER TABLE `publishers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'locadora'
--
/*!50003 DROP FUNCTION IF EXISTS `calcular_dias_emprestimo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `calcular_dias_emprestimo`(DATA1 DATE, DATA2 DATE) RETURNS int
    DETERMINISTIC
BEGIN
	RETURN DATEDIFF(DATA2, DATA1);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `realizar_emprestimo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `realizar_emprestimo`(IN P_ID_JOGO INT, IN P_CPF CHAR(11), IN P_DATA_ENTREGA DATE)
BEGIN
	DECLARE STATUS_JOGO BOOLEAN;
    
    SELECT DISPONIVEL INTO STATUS_JOGO FROM JOGOS WHERE ID_JOGO = P_ID_JOGO;
    
    IF STATUS_JOGO = 1 THEN
		
        INSERT INTO EMPRESTIMOS (ID_JOGO, CPF, DATA_EMPRESTIMO, DATA_ENTREGA) VALUES
			(P_ID_JOGO, P_CPF, CURDATE(), P_DATA_ENTREGA);
            
	ELSE 
		SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Jogo indisponível';
	END IF;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-24 13:38:15
