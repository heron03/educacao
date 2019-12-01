# Host: localhost  (Version 5.5.5-10.1.21-MariaDB)
# Date: 2019-11-30 20:37:31
# Generator: MySQL-Front 6.1  (Build 1.26)


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for table "cursos"
#

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `semestres` int(2) DEFAULT NULL,
  `escola_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `blocked` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cursos_escola_id_fk` (`escola_id`),
  CONSTRAINT `cursos_escola_id_fk` FOREIGN KEY (`escola_id`) REFERENCES `escolas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`),
  KEY `usuarios_escola_id_fk` (`escola_id`),
  CONSTRAINT `usuarios_escola_id_fk` FOREIGN KEY (`escola_id`) REFERENCES `escolas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`),
  KEY `aulas_diciplina_id_fk` (`disciplina_id`),
  CONSTRAINT `aulas_diciplina_id_fk` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`),
  KEY `provas_diciplina_id_fk` (`disciplina_id`),
  CONSTRAINT `provas_diciplina_id_fk` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
