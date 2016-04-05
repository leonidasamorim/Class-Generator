# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.9)
# Database: classgenerator
# Generation Time: 2013-02-25 12:32:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table classearquitetura
# ------------------------------------------------------------

DROP TABLE IF EXISTS `classearquitetura`;

CREATE TABLE `classearquitetura` (
  `codClasseArquitetura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codClasseArquitetura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `classearquitetura` WRITE;
/*!40000 ALTER TABLE `classearquitetura` DISABLE KEYS */;

INSERT INTO `classearquitetura` (`codClasseArquitetura`, `nome`)
VALUES
	(1,'Fachada/Cad/CadBD'),
	(2,'Fachada'),
	(3,'Basica'),
	(4,'Cad'),
	(5,'CadBD');

/*!40000 ALTER TABLE `classearquitetura` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table metodo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `metodo`;

CREATE TABLE `metodo` (
  `codMetodo` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `codProjeto` int(10) unsigned NOT NULL DEFAULT '0',
  `codClasseArquitetura` int(10) unsigned NOT NULL DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  `sql` text,
  `classe` varchar(255) DEFAULT NULL,
  `tipoMetodo` char(2) DEFAULT NULL,
  `codigo` text,
  `tipoRetorno` enum('OBJ','ARRAY','BOOL') DEFAULT NULL,
  PRIMARY KEY (`codMetodo`),
  KEY `metodo_FKIndex1` (`codClasseArquitetura`),
  KEY `metodo_FKIndex2` (`codProjeto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table parametro
# ------------------------------------------------------------

DROP TABLE IF EXISTS `parametro`;

CREATE TABLE `parametro` (
  `codParametro` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `codMetodo` int(5) unsigned DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `descricao` text,
  `ordem` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`codParametro`),
  KEY `parametro_FKIndex1` (`codMetodo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table projeto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projeto`;

CREATE TABLE `projeto` (
  `codProjeto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` text,
  `coordenador` varchar(255) DEFAULT NULL,
  `banco` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codProjeto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
