DROP DATABASE ludotheque;
CREATE DATABASE IF NOT EXISTS ludotheque;

use ludotheque;

#  Conventions de nommage : 
#  * Nom de tables en minuscules séparé par des _
#  * Nom des champs en minuscules attachés, majuscules au début des mots suivants
#  * Convention de nommage des dicos : Rajout de _d derriere le nom associé comme dico

#    Tables : 
#  * compte -
#  * individu -
#  * notation_user -
#  * commentaire_user -
#  * jeu_p -
#  * commentaire_jeu_p -
#  * pret_p 
#  * departement
#  * user_prefere_genre
#  * produit_culturel_t
#  * a_pour_image
#  * jeu_t
#  * commentaire_p_c_t
#  * jeu_a_pour_genre
#  * genre
#  * message
#  * notification

#    Tables dictionnaires :
#  * droit_d
#  * etat_d
#  * type_p_c_d
#  * editeur_d
#  * difficulte_d
#  * public_d
#  * type_noteur_d

# Création de la table compte (M)
DROP TABLE IF EXISTS compte;

CREATE TABLE compte (
  idUser smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  adresse varchar(300) NOT NULL,
  ville varchar(30) NOT NULL,
  numDept smallint(2) unsigned NOT NULL, #FK dico dpt
  email varchar(255) NOT NULL UNIQUE, #index UNIQUE car évite qu un email soit enregistré deux fois
  telephone int(15) NOT NULL,
  pseudo varchar(30) NOT NULL UNIQUE, #index UNIQUE évite doublon psuedos
  dateInscription date NOT NULL,
  mdp varchar(50) NOT NULL,
  codePostal int(5) unsigned NOT NULL,
  droit varchar(20) NOT NULL, #FK dico

  PRIMARY KEY (idUser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table individu (M)
DROP TABLE IF EXISTS individu;

CREATE TABLE individu (
  idUser smallint(8) unsigned NOT NULL, #FK
  nom varchar(50) NOT NULL,
  prenom varchar(50) NOT NULL,
  dateNaiss date NOT NULL,

  PRIMARY KEY (idUser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table notation_user (M)
DROP TABLE IF EXISTS notation_user;

CREATE TABLE notation_user (
  idNU smallint(8) unsigned NOT NULL AUTO_INCREMENT,  
  idUser smallint(8) unsigned NOT NULL, #FK
  idNoteur smallint(8) unsigned NOT NULL, #FK
  notation tinyint(5) NOT NULL,
  typeNoteur varchar(20) NOT NULL, #FK

  PRIMARY KEY (idNU)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# Création de la table commentaire_user (M)
DROP TABLE IF EXISTS commentaire_user;

CREATE TABLE commentaire_user (
  idNU smallint(8) unsigned NOT NULL,  #FK
  commentaireU text NOT NULL,

  PRIMARY KEY (idNU)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

# Création de la table jeu_p (M)
DROP TABLE IF EXISTS jeu_p;

CREATE TABLE jeu_p (
  idJeuP smallint(8) unsigned NOT NULL AUTO_INCREMENT,  
  idPC SMALLINT(8) UNSIGNED NOT NULL, #FK   à modicer en idPC si modif dans la table jeu_t
  idProprietaire smallint(8) unsigned NOT NULL, #FK
  etat varchar(50) NOT NULL, #FK dico

  PRIMARY KEY (idJeuP)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table commentaire_jeu_p (M)
DROP TABLE IF EXISTS commentaire_jeu_p;

CREATE TABLE commentaire_jeu_p (
  idPret smallint(8) unsigned NOT NULL,  #FK
  commentaireJP text NOT NULL,

  PRIMARY KEY (idPret)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table pret_p (M)
DROP TABLE IF EXISTS pret_p;

CREATE TABLE pret_p (
  idPret smallint(8) unsigned NOT NULL AUTO_INCREMENT, #PK
  idJeuP smallint(8) unsigned NOT NULL,  #FK
  idEmprunteur smallint(8) unsigned NOT NULL, #FK idUser
  dateDebut date NOT NULL,
  dateRendu date NOT NULL,
  jeuRenduATemps boolean,
  notification SMALLINT(8) UNSIGNED NOT NULL,#FK

  PRIMARY KEY (idPret) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table departement (M)
DROP TABLE IF EXISTS departement;

CREATE TABLE departement (
  numDept smallint(2) unsigned NOT NULL,
	nom varchar(50) NOT NULL,

	PRIMARY KEY (numDept)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table user_prefere_genre (M)
DROP TABLE IF EXISTS user_prefere_genre;

CREATE TABLE user_prefere_genre (
	idUser smallint(8) unsigned NOT NULL, #FK
  genre VARCHAR(200) NOT NULL, #FK

	PRIMARY KEY (idUser, genre) # la combinaison des 2 FK contsituent la PK
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table produit_culturel_t (C)
DROP TABLE IF EXISTS produit_culturel_t;

create table produit_culturel_t(
  idPC SMALLINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  typePC VARCHAR(50) NOT NULL,	#FK
  anneeSortie	year NOT NULL,
  description TEXT NOT NULL,

  PRIMARY KEY (idPC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


# Création de la table type_p_c
#DROP TABLE IF EXISTS type_p_c;

#create table type_p_c(
#typePC VARCHAR(50) NOT NULL UNIQUE,

#PRIMARY KEY (typePC)
#) ENGINE=InnoDB DEFAULT CHARSET=utf8;*/


# Création de la table a_pour_image
DROP TABLE IF EXISTS a_pour_image;

create table a_pour_image(
  idPC SMALLINT(8) UNSIGNED NOT NULL, #FK
  source VARCHAR(50) NOT NULL,

  PRIMARY KEY (idPC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table jeu_t
DROP TABLE IF EXISTS jeu_t;

create table jeu_t(
  idPC SMALLINT(8) UNSIGNED NOT NULL, #FK
  nbJoueursMin SMALLINT NOT NULL,
  nbJoueursMax SMALLINT NOT NULL,
  nom VARCHAR(200) NOT NULL,
  editeur VARCHAR(30) NOT NULL, #FK dico option autre 
  #illustrateurPrincipal VARCHAR(100) NOT NULL, --FK option autre (nom, prenom) -> pas utile
  regles TEXT,
  difficulte VARCHAR(200) NOT NULL, #FK dico option autre
  public VARCHAR(20) NOT NULL, #FK dico (tous public, adultes, enfants)
  listePieces TEXT,
  dureePartie VARCHAR(200),

  PRIMARY KEY (idPC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table commentaire_p_c_t
DROP TABLE IF EXISTS commentaire_p_c_t;

create table commentaire_p_c_t(
  idPC SMALLINT(8) UNSIGNED NOT NULL, #FK
  commentaireT TEXT,
  idUser SMALLINT(8) unsigned NOT NULL, #FK

  PRIMARY KEY (idPC, idUser) #combinaison des 2 FK constitue la PK
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table jeu_a_pour_genre
DROP TABLE IF EXISTS jeu_a_pour_genre;

create table jeu_a_pour_genre(
  idPC SMALLINT(8) UNSIGNED NOT NULL, #FK 
  genre VARCHAR(200) NOT NULL, #FK dico  

  PRIMARY KEY (idPC, genre) #combinaison des 2 FK constitue la PK
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table genre
DROP TABLE IF EXISTS genre;

create table genre(                   
  genre VARCHAR(200) NOT NULL UNIQUE,

  PRIMARY KEY (genre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table message
DROP TABLE IF EXISTS notification;

create table notification(
  notification SMALLINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  sujetPreteur VARCHAR(200) NOT NULL,
  corpsPreteur VARCHAR(500) NOT NULL,
  sujetEmprunteur VARCHAR(200) NOT NULL,
  corpsEmprunteur VARCHAR(500) NOT NULL,
  
  PRIMARY KEY (notification)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table message
DROP TABLE IF EXISTS message;

create table message(
  idMessage SMALLINT(8) UNSIGNED NOT NULL AUTO_INCREMENT, #PK 
  idDest SMALLINT(8) UNSIGNED NOT NULL,
  idExped SMALLINT(8) UNSIGNED NOT NULL,
  sujet VARCHAR(200) NOT NULL,
  texte VARCHAR(500) NOT NULL,
  
  PRIMARY KEY (idMessage)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#                      DICTIONNAIRES
#Convention de nommage des dico : Rajout de _d derriere le nom associé comme dico


# Création de la table Dico droit du compte (M)
DROP TABLE IF EXISTS droit_d;

CREATE TABLE droit_d (
  droit varchar(20) NOT NULL,

  PRIMARY KEY (droit)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table Dico etat du jeu_p (M)
DROP TABLE IF EXISTS etat_d;

CREATE TABLE etat_d (
  etat varchar(50) NOT NULL,

  PRIMARY KEY (etat)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table Dico type_p_c du produit_culturel_t (M)
DROP TABLE IF EXISTS type_p_c_d;

CREATE TABLE type_p_c_d (
  typePC VARCHAR(50) NOT NULL,

  PRIMARY KEY (typePC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table Dico editeur du jeu_t (M)
DROP TABLE IF EXISTS editeur_d;

CREATE TABLE editeur_d (
  editeur VARCHAR(30) NOT NULL,

  PRIMARY KEY (editeur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table Dico difficulte du jeu_t (M)
DROP TABLE IF EXISTS difficulte_d;

CREATE TABLE difficulte_d (
  difficulte VARCHAR(200) NOT NULL,

  PRIMARY KEY (difficulte)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table Dico public du jeu_t (M)
DROP TABLE IF EXISTS public_d;

CREATE TABLE public_d (
  public VARCHAR(20) NOT NULL,

  PRIMARY KEY (public)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Création de la table Dico typeNoteur du notation_user (M)
DROP TABLE IF EXISTS type_noteur_d;

CREATE TABLE type_noteur_d (
  typeNoteur varchar(20) NOT NULL,

  PRIMARY KEY (typeNoteur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# PAS UTILE
# Création de la table Dico illustrateurPrincipal du jeu_t (M)
#DROP TABLE IF EXISTS illustrateurPrincipal_d;

#CREATE TABLE illustrateurPrincipal_d (
#illustrateurPrincipal VARCHAR(100) NOT NULL,

#  PRIMARY KEY (illustrateurPrincipal),
#) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#      CLES ETRANGERES
#  * Script de Modification des tables pour ajout des clé étrangères 


# Clés étrangères de la table compte
  
  # Clé étrangère numDept
ALTER TABLE compte 
ADD CONSTRAINT fk_numDept_compte          # On donne un nom à notre clé
        FOREIGN KEY (numDept)             # Colonne sur laquelle on crée la clé
        REFERENCES departement(numDept);  # Colonne de référence

  
  # Clé étrangère droit
ALTER TABLE compte 
ADD CONSTRAINT fk_droit_compte FOREIGN KEY (droit) REFERENCES droit_d(droit);

# Clés étrangères de la table individu
  # Clé étrangère idUser
ALTER TABLE individu 
ADD CONSTRAINT fk_idUser_individu FOREIGN KEY (idUser) REFERENCES compte(idUser);


# Clés étrangères de la table notation_user
  # Clé étrangère idUser
ALTER TABLE notation_user 
ADD CONSTRAINT fk_idUser_notation_user FOREIGN KEY (idUser) REFERENCES compte(idUser);

  # Clé étrangère idNoteur
ALTER TABLE notation_user 
ADD CONSTRAINT fk_idNoteur_notation_user FOREIGN KEY (idNoteur) REFERENCES compte(idUser);

  # Clé étrangère typeNoteur
ALTER TABLE notation_user 
ADD CONSTRAINT fk_typeNoteur_notation_user FOREIGN KEY (typeNoteur) REFERENCES type_noteur_d(typeNoteur);


# Clés étrangères de la table commentaire_user
  # Clé étrangère idUser
ALTER TABLE commentaire_user 
ADD CONSTRAINT fk_idNU_commentaire_user FOREIGN KEY (idNU) REFERENCES notation_user(idNU);

# Clés étrangères de la table jeu_p
  # Clé étrangère idPC
ALTER TABLE jeu_p 
ADD CONSTRAINT fk_idPC_jeu_p FOREIGN KEY (idPC) REFERENCES jeu_t(idPC);

  # Clé étrangère idProprietaire **
ALTER TABLE jeu_p 
ADD CONSTRAINT fk_idProprietaire_jeu_p FOREIGN KEY (idProprietaire) REFERENCES compte(idUser);

  # Clé étrangère etat
ALTER TABLE jeu_p 
ADD CONSTRAINT fk_etat_jeu_p FOREIGN KEY (etat) REFERENCES etat_d(etat);

# Clés étrangères de la table commentaire_jeu_p
  # Clé étrangère idJeuP
ALTER TABLE commentaire_jeu_p 
ADD CONSTRAINT fk_idJeuP_commentaire_jeu_p FOREIGN KEY (idJeuP) REFERENCES jeu_p(idJeuP);

# Clés étrangères de la table pret_p
  # Clé étrangère idJeuP
ALTER TABLE pret_p 
ADD CONSTRAINT fk_idJeuP_pret_p FOREIGN KEY (idJeuP) REFERENCES jeu_p(idJeuP);

  # Clé étrangère idEmprunteur
ALTER TABLE pret_p 
ADD CONSTRAINT fk_idEmprunteur_pret_p FOREIGN KEY (idEmprunteur) REFERENCES compte(idUser);

  # Clé étrangère notification
ALTER TABLE pret_p 
ADD CONSTRAINT fk_notification_pret_p FOREIGN KEY (notification) REFERENCES notification(notification);

# Clés étrangères de la table user_prefere_genre
  # Clé étrangère idUser
ALTER TABLE user_prefere_genre 
ADD CONSTRAINT fk_idUser_user_prefere_genre FOREIGN KEY (idUser) REFERENCES compte(idUser);

  # Clé étrangère genre 
ALTER TABLE user_prefere_genre 
ADD CONSTRAINT fk_genre_user_prefere_genre FOREIGN KEY (genre) REFERENCES genre(genre);

# Clés étrangères de la table produit_culturel_t
  # Clé étrangère typePC
ALTER TABLE produit_culturel_t 
ADD CONSTRAINT fk_typePC_produit_culturel_t FOREIGN KEY (typePC) REFERENCES type_p_c_d(typePC);

# Clés étrangères de la table a_pour_image
  # Clé étrangère typePC
ALTER TABLE a_pour_image 
ADD CONSTRAINT fk_idPC_a_pour_image FOREIGN KEY (idPC) REFERENCES produit_culturel_t(idPC);

# Clés étrangères de la table jeu_t
  # Clé étrangère typePC
ALTER TABLE jeu_t 
ADD CONSTRAINT fk_idPC_jeu_t FOREIGN KEY (idPC) REFERENCES produit_culturel_t(idPC);

  # Clé étrangère editeur
ALTER TABLE jeu_t 
ADD CONSTRAINT fk_editeur_jeu_t FOREIGN KEY (editeur) REFERENCES editeur_d(editeur);

  # Clé étrangère difficulte
ALTER TABLE jeu_t 
ADD CONSTRAINT fk_difficulte_jeu_t FOREIGN KEY (difficulte) REFERENCES difficulte_d(difficulte);

  # Clé étrangère public
ALTER TABLE jeu_t 
ADD CONSTRAINT fk_public_jeu_t FOREIGN KEY (public) REFERENCES public_d(public);

#    PAS UTILE
  # Clé étrangère illustrateurPrincipal
#ALTER TABLE jeu_t 
#ADD CONSTRAINT fk_illustrateurPrincipal_jeu_t FOREIGN KEY (illustrateurPrincipal) REFERENCES illustrateurPrincipal_d(illustrateurPrincipal);

# Clés étrangères de la table commentaire_p_c_t
  # Clé étrangère idPC
ALTER TABLE commentaire_p_c_t 
ADD CONSTRAINT fk_idPC_commentaire_p_c_t FOREIGN KEY (idPC) REFERENCES produit_culturel_t(idPC);

  # Clé étrangère idUser
ALTER TABLE commentaire_p_c_t 
ADD CONSTRAINT fk_idUser_commentaire_p_c_t FOREIGN KEY (idUser) REFERENCES compte(idUser);

# Clés étrangères de la table jeu_a_pour_genre
  # Clé étrangère idPC
ALTER TABLE jeu_a_pour_genre 
ADD CONSTRAINT fk_idPC_jeu_a_pour_genre FOREIGN KEY (idPC) REFERENCES jeu_t(idPC);

  # Clé étrangère genre
ALTER TABLE jeu_a_pour_genre 
ADD CONSTRAINT fk_genre_jeu_a_pour_genre FOREIGN KEY (genre) REFERENCES genre(genre);

# Clés étrangères de la table message
  # Clé étrangère idExped
ALTER TABLE message 
ADD CONSTRAINT fk_idExped_message FOREIGN KEY (idExped) REFERENCES compte(idUser);

  # Clé étrangère idDest
ALTER TABLE message 
ADD CONSTRAINT fk_idDest_message FOREIGN KEY (idDest) REFERENCES compte(idUser);