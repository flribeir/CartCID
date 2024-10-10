-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.39-0ubuntu0.20.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para CartCID
DROP DATABASE IF EXISTS `CartCID`;
CREATE DATABASE IF NOT EXISTS `CartCID` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `CartCID`;

-- Copiando estrutura para tabela CartCID.Carteirinha
DROP TABLE IF EXISTS `Carteirinha`;
CREATE TABLE IF NOT EXISTS `Carteirinha` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CID` int NOT NULL,
  `Nome` varchar(150) NOT NULL,
  `CPF` varchar(11) NOT NULL,
  `RG` varchar(25) NOT NULL,
  `RG_Orgao_Expeditor` varchar(25) NOT NULL,
  `RG_Data_Expeditor` date NOT NULL,
  `Sexo` enum('F','M') NOT NULL,
  `Tipo_Sanguineo` varchar(3) NOT NULL,
  `Dt_Nascimento` date NOT NULL,
  `Celular` varchar(25) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Naturalidade` varchar(25) NOT NULL,
  `Nacionalidade` varchar(25) NOT NULL,
  `Nome_Pai` varchar(150) DEFAULT NULL,
  `Nome_Mae` varchar(150) NOT NULL,
  `Nome_Responsavel` varchar(150) NOT NULL,
  `Telefone_Responsavel` varchar(25) NOT NULL,
  `Email_Responsavel` varchar(100) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `Endereco` varchar(255) NOT NULL,
  `Numero` varchar(5) NOT NULL,
  `Complemento` varchar(75) DEFAULT NULL,
  `Bairro` varchar(100) NOT NULL,
  `Cidade` varchar(75) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `QRCode` tinytext NOT NULL,
  `Dt_Validade` date NOT NULL,
  `Dt_Inclusao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `fk_carteirinha_doencas` (`CID`),
  CONSTRAINT `fk_carteirinha_doencas` FOREIGN KEY (`CID`) REFERENCES `Doencas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela CartCID.Carteirinha: ~0 rows (aproximadamente)
DELETE FROM `Carteirinha`;

-- Copiando estrutura para tabela CartCID.Doencas
DROP TABLE IF EXISTS `Doencas`;
CREATE TABLE IF NOT EXISTS `Doencas` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `CID` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `GRUPO` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `fk_doencas_grupos` (`GRUPO`),
  CONSTRAINT `fk_doencas_grupos` FOREIGN KEY (`GRUPO`) REFERENCES `Grupo_Doencas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela CartCID.Doencas: ~9 rows (aproximadamente)
DELETE FROM `Doencas`;
INSERT INTO `Doencas` (`ID`, `CID`, `Nome`, `GRUPO`) VALUES
	(99, '6A02', 'Transtorno do Espectro do Autismo (TEA)', 1),
	(100, '6A02.0', 'Transtorno do Espectro do Autismo sem deficiência intelectual (DI) e com comprometimento leve ou ausente da linguagem funcional', 1),
	(101, '6A02.1', 'Transtorno do Espectro do Autismo com deficiência intelectual (DI) e com comprometimento leve ou ausente da linguagem funcional', 1),
	(102, '6A02.2', 'Transtorno do Espectro do Autismo sem deficiência intelectual (DI) e com linguagem funcional prejudicada', 1),
	(103, '6A02.3', 'Transtorno do Espectro do Autismo com deficiência intelectual (DI) e com linguagem funcional prejudicada', 1),
	(104, '6A02.4', 'Transtorno do Espectro do Autismo sem deficiência intelectual (DI) e com ausência de linguagem funcional', 1),
	(105, '6A02.5', 'Transtorno do Espectro do Autismo com deficiência intelectual (DI) e com ausência de linguagem funcional', 1),
	(106, '6A02.Y', 'Outro Transtorno do Espectro do Autismo especificado', 1),
	(107, '6A02.Z', 'Transtorno do Espectro do Autismo, não especificado', 1);

-- Copiando estrutura para tabela CartCID.Grupo_Doencas
DROP TABLE IF EXISTS `Grupo_Doencas`;
CREATE TABLE IF NOT EXISTS `Grupo_Doencas` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Descrição` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela CartCID.Grupo_Doencas: ~1 rows (aproximadamente)
DELETE FROM `Grupo_Doencas`;
INSERT INTO `Grupo_Doencas` (`ID`, `Descrição`) VALUES
	(1, 'TEA');

-- Copiando estrutura para trigger CartCID.tg_Carteirinha_I
DROP TRIGGER IF EXISTS `tg_Carteirinha_I`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `tg_Carteirinha_I` BEFORE INSERT ON `Carteirinha` FOR EACH ROW BEGIN

  SET NEW.Dt_Validade = ADDDATE(DATE(NOW()), INTERVAL 1 YEAR);

  SET NEW.QRCode      = (SELECT FLOOR(RAND() * 99999));

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
