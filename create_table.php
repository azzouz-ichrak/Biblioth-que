
-- Base de données :  `biblio`

-- Structure de la table `acheteur`

CREATE TABLE IF NOT EXISTS `acheteur` (
  `idach` int(6) NOT NULL AUTO_INCREMENT,
  `nomach` varchar(25) NOT NULL,
  `prenomach` varchar(25) NOT NULL,
  `numtelach` int(8) NOT NULL,
  `localisationach` varchar(255) NOT NULL,
  `imageach` text NOT NULL,
  PRIMARY KEY (`idach`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- Structure de la table `auteur`

CREATE TABLE IF NOT EXISTS `auteur` (
  `idauteur` int(6) NOT NULL AUTO_INCREMENT,
  `nomaut` varchar(255) NOT NULL,
  PRIMARY KEY (`idauteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- Structure de la table `categories`

CREATE TABLE IF NOT EXISTS `categories` (
  `idcat` int(6) NOT NULL AUTO_INCREMENT,
  `nomcat` varchar(255) NOT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- Structure de la table `paiement`

CREATE TABLE IF NOT EXISTS `paiement` (
  `idpaiement` int(6) NOT NULL AUTO_INCREMENT,
  `modepaiement` varchar(255) NOT NULL,
  `datepaimenet` date NOT NULL,
  PRIMARY KEY (`idpaiement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- Structure de la table `promotion`

CREATE TABLE IF NOT EXISTS `promotion` (
  `idpromo` int(6) NOT NULL AUTO_INCREMENT,
  `pourcentage` int(2) NOT NULL,
  PRIMARY KEY (`idpromo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- Structure de la table `typecmd`

CREATE TABLE IF NOT EXISTS `typecmd` (
  `idtype` int(6) NOT NULL AUTO_INCREMENT,
  `typecmd` varchar(255) NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  PRIMARY KEY (`idtype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Structure de la table `vendeur`

CREATE TABLE IF NOT EXISTS `vendeur` (
  `idv` int(6) NOT NULL AUTO_INCREMENT,
  `nomv` varchar(25) NOT NULL,
  `prenomv` varchar(25) NOT NULL,
  `numtelv` int(8) NOT NULL,
  `localisationv` varchar(255) NOT NULL,
  `imagev` text NOT NULL,
  PRIMARY KEY (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- Structure de la table `livre`

CREATE TABLE IF NOT EXISTS `livre` (
  `idlivre` int(6) NOT NULL AUTO_INCREMENT,
  `titre` varchar(25) NOT NULL,
  `langue` varchar(25) NOT NULL,
  `nbp` int(8) NOT NULL,
  `prix` int(3) NOT NULL,
  `image` text NOT NULL,
  `idv` int(6) DEFAULT NULL,
  `idauteur` int(6) DEFAULT NULL,
  `idpromo` int(6) DEFAULT NULL,
  `idcat` int(6) DEFAULT NULL,
  PRIMARY KEY (`idlivre`),
  KEY `idv` (`idv`),
  KEY `idauteur` (`idauteur`),
  KEY `idpromo` (`idpromo`),
  KEY `idcat` (`idcat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Structure de la table `panier`

CREATE TABLE IF NOT EXISTS `panier` (
  `idpanier` int(6) NOT NULL AUTO_INCREMENT,
  `prixpanier` int(3) NOT NULL,
  `idach` int(6) DEFAULT NULL,
  `idlivre` int(6) DEFAULT NULL,
  PRIMARY KEY (`idpanier`),
  KEY `idach` (`idach`),
  KEY `idlivre` (`idlivre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Structure de la table `commande`

CREATE TABLE IF NOT EXISTS `commande` (
  `idcmd` int(6) NOT NULL AUTO_INCREMENT,
  `datecmd` date NOT NULL,
  `idpanier` int(6) DEFAULT NULL,
  `idtype` int(6) DEFAULT NULL,
  `idpaiement` int(6) DEFAULT NULL,
  PRIMARY KEY (`idcmd`),
  KEY `idpanier` (`idpanier`),
  KEY `idtype` (`idtype`),
  KEY `idpaiement` (`idpaiement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Contraintes pour la table `livre`
ALTER TABLE `livre`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`idv`) REFERENCES `vendeur` (`idv`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`idauteur`) REFERENCES `auteur` (`idauteur`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`idpromo`) REFERENCES `promotion` (`idpromo`),
  ADD CONSTRAINT `fk4` FOREIGN KEY (`idcat`) REFERENCES `categories` (`idcat`);


-- Contraintes pour la table `panier`

ALTER TABLE `panier`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`idach`) REFERENCES `acheteur` (`idach`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`idlivre`) REFERENCES `livre` (`idlivre`);

-- Contraintes pour la table `commande`

ALTER TABLE `commande`
  ADD CONSTRAINT `fk7` FOREIGN KEY (`idpanier`) REFERENCES `panier` (`idpanier`),
  ADD CONSTRAINT `fk8` FOREIGN KEY (`idtype`) REFERENCES `typecmd` (`idtype`),
  ADD CONSTRAINT `fk9` FOREIGN KEY (`idpaiement`) REFERENCES `paiement` (`idpaiement`);
