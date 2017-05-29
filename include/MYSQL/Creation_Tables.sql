
-- Création de la  table `cursus`

CREATE TABLE IF NOT EXISTS `cursus` (
  `numero_etudiant` int(20) NOT NULL,
  `label` varchar(100) NOT NULL,
  `ListUV` array NOT NULL,
  PRIMARY KEY (`numero_etudiant`)
)

--------------------------------------------------------

-- Création de la table 'elt_de_formation'

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
  PRIMARY KEY (`id`)
) 

--------------------------------------------------------

-- Création de la table 'étudiant'

CREATE TABLE IF NOT EXISTS `etudiant` (
  `num_etudiant` int(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `admission` varchar(10) NOT NULL,
  `filiere` varchar(10) NOT NULL,
  PRIMARY KEY (`num_etudiant`)
)

---------------------------------------------------------

-- Création de la table 'reglement'

CREATE TABLE IF NOT EXISTS `reglement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)

-- Initialisation des reglements 

INSERT INTO `reglement` VALUES (0,'FUTUR_REGLEMENT');
INSERT INTO `reglement` VALUES (1,'NOUVEAU_REGLEMENT');
--------------------------------------------------------

-- Création de la table 'regles'

CREATE TABLE IF NOT EXISTS `regles` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_reglement` varchar(10)  NOT NULL,
  `agregat` varchar(100) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `affectation` varchar(100) NOT NULL,
  `credit` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) 

-- Initialisation des éléments des réglements

-- INSERT INTO `regles` VALUES (0,'NOUVEAU_REGLEMENT');