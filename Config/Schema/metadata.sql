# Host: localhost  (Version 5.5.5-10.1.21-MariaDB)
# Date: 2020-04-12 16:30:07
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "acos"
#

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "acos"
#

INSERT INTO `acos` VALUES (1,NULL,NULL,NULL,'Aulas',1,2),(2,NULL,NULL,NULL,'Usuarios',3,4),(3,NULL,NULL,NULL,'Cursos',5,6),(4,NULL,NULL,NULL,'Disciplinas',7,8),(5,NULL,NULL,NULL,'Provas',9,10),(6,NULL,NULL,NULL,'Turmas',11,12);

#
# Structure for table "aros"
#

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "aros"
#

INSERT INTO `aros` VALUES (1,NULL,NULL,NULL,'Aluno',1,6),(2,NULL,NULL,NULL,'Professor',7,14),(3,NULL,NULL,NULL,'Instituição',15,24),(4,3,'Usuario',1,NULL,16,17),(5,1,'Usuario',2,NULL,2,3),(6,2,'Usuario',3,NULL,8,9),(7,2,'Usuario',4,NULL,10,11),(8,3,'Usuario',5,NULL,18,19),(9,2,'Usuario',6,NULL,12,13),(10,3,'Usuario',7,NULL,20,21),(11,1,'Usuario',8,NULL,4,5),(12,3,'Usuario',9,NULL,22,23);

#
# Structure for table "aros_acos"
#

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

#
# Data for table "aros_acos"
#

INSERT INTO `aros_acos` VALUES (1,3,1,'1','1','1','1'),(2,3,2,'1','1','1','1'),(3,3,3,'1','1','1','1'),(4,3,4,'1','1','1','1'),(5,3,5,'1','1','1','1'),(6,3,6,'1','1','1','1'),(7,2,1,'1','1','1','1'),(8,2,2,'1','1','1','1'),(9,2,3,'1','1','1','1'),(10,2,4,'1','1','1','1'),(11,2,5,'1','1','1','1'),(12,2,6,'1','1','1','1'),(13,1,1,'1','1','1','1'),(14,1,2,'1','1','1','1'),(15,1,3,'0','1','0','0'),(16,1,4,'0','1','0','0'),(17,1,5,'1','1','1','1'),(18,1,6,'0','1','0','0');

#
# Structure for table "escolas"
#

DROP TABLE IF EXISTS `escolas`;
CREATE TABLE `escolas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "escolas"
#

INSERT INTO `escolas` VALUES (1,'teste',NULL,NULL,NULL);

#
# Structure for table "usuarios"
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `escola_id` int(11) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `aro_parent_id` int(11) DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarios_escola_id_fk` (`escola_id`),
  CONSTRAINT `usuarios_escola_id_fk` FOREIGN KEY (`escola_id`) REFERENCES `escolas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES (1,'heron','profesor','185ac8a0b2643f660792528e51e92ac6eae00eebea0fc64caf391e5d2962164c',1,'46609031843','heron@coesma.com.br',NULL,'2020-04-12 12:42:44',2,NULL,NULL),(8,'HERON JOSE BUENO DE OLIVEIRA ALMEIDA','aluno','185ac8a0b2643f660792528e51e92ac6eae00eebea0fc64caf391e5d2962164c',NULL,NULL,'heronze@gmail.com','2020-04-12 13:07:32','2020-04-12 13:07:32',1,NULL,NULL),(9,'HERON JOSE BUENO DE OLIVEIRA ALMEIDA','instituicao','185ac8a0b2643f660792528e51e92ac6eae00eebea0fc64caf391e5d2962164c',NULL,NULL,'heronze@gmail.com','2020-04-12 14:38:30','2020-04-12 14:38:30',3,NULL,'1111');

#
# Structure for table "cursos"
#

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `semestres` int(2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `cursos_usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "cursos"
#

INSERT INTO `cursos` VALUES (4,'BSI',8,'2020-04-12 12:56:06',NULL,'2020-04-12 12:56:06',9),(5,'BCC',8,'2020-04-12 13:12:41',NULL,'2020-04-12 13:12:41',9),(6,'Direito',10,'2020-04-12 14:50:54',NULL,'2020-04-12 14:51:53',9);

#
# Structure for table "turmas"
#

DROP TABLE IF EXISTS `turmas`;
CREATE TABLE `turmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semestres` int(2) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `turma_curso_id_fk` (`curso_id`),
  KEY `turma_usuario_id_fk` (`usuarios_id`),
  CONSTRAINT `turmas_curso_id_fk` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `turmas_usuarios_id_fk` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "turmas"
#

INSERT INTO `turmas` VALUES (5,1,4,NULL,'2020-04-12 13:00:51',NULL,'2020-04-12 14:07:06'),(7,2,4,NULL,'2020-04-12 13:51:47',NULL,'2020-04-12 13:51:47'),(8,3,4,NULL,'2020-04-12 13:56:05',NULL,'2020-04-12 13:56:05'),(10,4,4,NULL,'2020-04-12 14:03:05',NULL,'2020-04-12 14:03:05'),(11,1,5,NULL,'2020-04-12 14:04:38',NULL,'2020-04-12 14:04:38');

#
# Structure for table "disciplinas"
#

DROP TABLE IF EXISTS `disciplinas`;
CREATE TABLE `disciplinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `turma_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diciplinas_turma_id_fk` (`turma_id`),
  KEY `diciplinas_usuarios_id_fk` (`usuario_id`),
  CONSTRAINT `diciplinas_turma_id_fk` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `diciplinas_usuarios_id_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "disciplinas"
#

INSERT INTO `disciplinas` VALUES (7,'Logica',5,1,'2020-04-12 13:08:15',NULL,'2020-04-12 13:08:15'),(8,'AlgorÃ­timo',5,1,'2020-04-12 14:17:22',NULL,'2020-04-12 14:17:22');

#
# Structure for table "aulas"
#

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE `aulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `disciplina_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `data` date DEFAULT NULL,
  `conteudo` text,
  PRIMARY KEY (`id`),
  KEY `aulas_diciplina_id_fk` (`disciplina_id`),
  CONSTRAINT `aulas_diciplina_id_fk` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "aulas"
#

INSERT INTO `aulas` VALUES (3,'teste',7,'2020-04-12 13:12:03',NULL,'2020-04-12 13:12:03','0000-00-00','1234');

#
# Structure for table "provas"
#

DROP TABLE IF EXISTS `provas`;
CREATE TABLE `provas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `disciplina_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `enunciado1` text,
  `enunciado2` text,
  `enunciado3` text,
  `enunciado4` text,
  `enunciado5` text,
  `imagem1` varchar(255) DEFAULT NULL,
  `imagem2` varchar(255) DEFAULT NULL,
  `imagem3` varchar(255) DEFAULT NULL,
  `imagem4` varchar(255) DEFAULT NULL,
  `imagem5` varchar(255) DEFAULT NULL,
  `valor_enunciado1` float(3,2) DEFAULT NULL,
  `valor_enunciado2` float(3,2) DEFAULT NULL,
  `valor_enunciado3` float(3,2) DEFAULT NULL,
  `valor_enunciado4` float(3,2) DEFAULT NULL,
  `valor_enunciado5` float(3,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provas_diciplina_id_fk` (`disciplina_id`),
  CONSTRAINT `provas_diciplina_id_fk` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Data for table "provas"
#


#
# Structure for table "exercicios"
#

DROP TABLE IF EXISTS `exercicios`;
CREATE TABLE `exercicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `prova_id` int(11) DEFAULT NULL,
  `aula_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exercicios_aula_id_fk` (`aula_id`),
  KEY `exercicios_prova_id_fk` (`prova_id`),
  CONSTRAINT `exercicios_aula_id_fk` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exercicios_prova_id_fk` FOREIGN KEY (`prova_id`) REFERENCES `provas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "exercicios"
#


#
# Structure for table "usuarios_turmas"
#

DROP TABLE IF EXISTS `usuarios_turmas`;
CREATE TABLE `usuarios_turmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `turma_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "usuarios_turmas"
#

