CREATE TABLE IF NOT EXISTS `etudiant` (
  `num_etudiant` int(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `admission` varchar(10) NOT NULL,
  `filiere` varchar(10) NOT NULL,
  PRIMARY KEY (`num_etudiant`)
);


CREATE TABLE IF NOT EXISTS `cursus` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_etu` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT CUR_FK FOREIGN KEY(id_etu) REFERENCES etudiant(num_etudiant)
) ;


CREATE TABLE IF NOT EXISTS `elt_de_formation` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_cursus` int(20) NOT NULL,
  `sem_seq` int(10)  NOT NULL,
  `sem_label` varchar(10) NOT NULL,
  `sigle` varchar(50)  NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `affectation` varchar(50) NOT NULL,
  `inutt` tinyint(1) NOT NULL,
  `inprofil` tinyint(1) NOT NULL,
  `credit` int(11) NOT NULL,
  `resultat` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT ELT_FK FOREIGN KEY(id_cursus) REFERENCES cursus(id)
) ;


CREATE TABLE IF NOT EXISTS `reglement` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO `reglement` VALUES (NULL,'FUTUR_REGLEMENT');
INSERT INTO `reglement` VALUES (NULL,'NOUVEAU_REGLEMENT');


CREATE TABLE IF NOT EXISTS `regle` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_reglement` int(20)  NOT NULL,
  `agregat` varchar(100) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `affectation` varchar(100) NOT NULL,
  `credit` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT REG_FK FOREIGN KEY(id_reglement) REFERENCES reglement(id)
)
  ENGINE=INNODB;
