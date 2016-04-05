-- 
-- Database: `classgenerator`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `classearquitetura`
-- 

CREATE TABLE `classearquitetura` (
  `codClasseArquitetura` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(255) default NULL,
  PRIMARY KEY  (`codClasseArquitetura`)
) TYPE=InnoDB AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `classearquitetura`
-- 

INSERT INTO `classearquitetura` VALUES (1, 'Fachada/Cad/CadBD');
INSERT INTO `classearquitetura` VALUES (2, 'Fachada');
INSERT INTO `classearquitetura` VALUES (3, 'Basica');
INSERT INTO `classearquitetura` VALUES (4, 'Cad');
INSERT INTO `classearquitetura` VALUES (5, 'CadBD');

-- --------------------------------------------------------

-- 
-- Table structure for table `metodo`
-- 

CREATE TABLE `metodo` (
  `codMetodo` int(5) unsigned NOT NULL auto_increment,
  `codProjeto` int(10) unsigned NOT NULL default '0',
  `codClasseArquitetura` int(10) unsigned NOT NULL default '0',
  `nome` varchar(255) default NULL,
  `descricao` text,
  `sql` text,
  `classe` varchar(255) default NULL,
  `tipoMetodo` char(2) default NULL,
  `codigo` text,
  `tipoRetorno` enum('OBJ','ARRAY','BOOL') default NULL,
  PRIMARY KEY  (`codMetodo`),
  KEY `metodo_FKIndex1` (`codClasseArquitetura`),
  KEY `metodo_FKIndex2` (`codProjeto`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;



-- 
-- Table structure for table `parametro`
-- 

CREATE TABLE `parametro` (
  `codParametro` int(5) unsigned NOT NULL auto_increment,
  `codMetodo` int(5) unsigned default '0',
  `nome` varchar(255) default NULL,
  `tipo` varchar(255) default NULL,
  `descricao` text,
  `ordem` int(10) unsigned default NULL,
  PRIMARY KEY  (`codParametro`),
  KEY `parametro_FKIndex1` (`codMetodo`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `projeto`
-- 

CREATE TABLE `projeto` (
  `codProjeto` int(10) unsigned NOT NULL auto_increment,
  `descricao` text,
  `coordenador` varchar(255) default NULL,
  `banco` varchar(255) default NULL,
  PRIMARY KEY  (`codProjeto`)
) TYPE=InnoDB AUTO_INCREMENT=1 ;
