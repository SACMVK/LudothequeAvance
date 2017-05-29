use ludotheque;

## DICOS
# Insertion de données de la table droit_d
INSERT INTO droit_d (droit) VALUES ("Administrateur"), ("Modérateur"), ("Utilisateur");

# Insertion de données de la table etat_d
INSERT INTO etat_d (etat) VALUES ("ras"), ("abimé"), ("manque pièces");

# Insertion de données de la table type_p_c_d
INSERT INTO type_p_c_d (typePC) VALUES ("Jeux de société"), ("Jeux vidéos"), ("Livres");

# Insertion de données de la table editeur_d
INSERT INTO editeur_d (editeur) VALUES ("Ravensburger"), ("Asmodee"), ("Gigamic");

# Insertion de données de la table difficulte_d
INSERT INTO difficulte_d (difficulte) VALUES ("Facile"), ("Moyen"), ("Difficile");

# Insertion de données de la table public_d
INSERT INTO public_d (public) VALUES ("Pour tous"), ("Adultes"), ("Enfants");

# Insertion de données de la table public_d
INSERT INTO type_noteur_d (typeNoteur) VALUES ("Emprunteur"), ("Prêteur");

# Insertion de données de la table genre
INSERT INTO genre (genre) VALUES ('Plateau');

# Insertion de données de la table notification
INSERT INTO notification (notification, sujetPreteur, corpsPreteur, corpsEmprunteur, sujetEmprunteur) VALUES (NULL, 'Demande date', 'Veuillez preciser la date de diponibilité?', 'emprunt jusqu\'au', 'durée d\emprunt');

#Insertion de données de la table departement
INSERT INTO departement (numDept,nom) VALUES ("1","Ain"), ("2","Aisne"), ("3","Allier"), 
("4","Alpes-de-Haute-Provence"), ("5","Hautes-Alpes"), ("6","Alpes-Maritimes"), ("7","Ardèche"), ("8","Ardennes"), ("9","Ariège")
, ("10","Aube"), ("11","Aude"), ("12","Aveyron"), ("13","Bouches-du-Rhône"), ("14","Calvados"), ("15","Cantal"), ("16","Charente"), ("17","Charente-Maritime"), ("18","Cher"), ("19","Corrèze")
, ("20","Corse-du-Sud"), ("21","Côte-d'Or"), ("22","Côtes-d'Armor"), ("23","Creuse"), ("24","Dordogne"), ("25","Doubs"), ("26","Drôme"), ("27","Eure"), ("28","Eure-et-Loir"), ("29","Finistère")
, ("30","Gard"), ("31","Haute-Garonne"), ("32","Gers"), ("33"," Gironde"), ("34","Hérault"), ("35","Ille-et-Vilaine"), ("36","Indre"), ("37","Indre-et-Loire"), ("38","Isère"), ("39","Jura")
, ("40","Landes"), ("41","Loir-et-Cher"), ("42","Loire"), ("43","Haute-Loire"), ("44","Loire-Atlantique"), ("45","Loiret"), ("46","Lot"), ("47","Lot-et-Garonne"), ("48","Lozère"), ("49","Maine-et-Loire")
, ("50","Manche"), ("51","Marne"), ("52","Haute-Marne"), ("53","Mayenne"), ("54","Meurthe-et-Moselle"), ("55","Meuse"), ("56","Morbihan"), ("57","Moselle"), ("58","Nièvre"), ("59","Nord")
, ("60","Oise"), ("61","Orne"), ("62","Pas-de-Calais"), ("63","Puy-de-Dôme"), ("64","Pyrénées-Atlantiques"), ("65","Hautes-Pyrénées"), ("66","Pyrénées-Orientales"), ("67","Bas-Rhin"), ("68","Haut-Rhin"), ("69","Rhône")
, ("70","Haute-Saône"), ("71","Saône-et-Loire"), ("72","Sarthe"), ("73","Savoie"), ("74","Haute-Savoie"), ("75","Paris"), ("76","Seine-Maritime"), ("77","Seine-et-Marne"), ("78","Yvelines"), ("79","Deux-Sèvres")
, ("80","Somme"), ("81","Tarn"), ("82","Tarn-et-Garonne"), ("83","Var"), ("84","Vaucluse"), ("85","Vendée"), ("86","Vienne"), ("87","Haute-Vienne"), ("88","Vosges"), ("89","Yonne")
, ("90","Territoire de Belfort"), ("91","Essonne"), ("92","Hauts-de-Seine"), ("93","Seine-Saint-Denis"), ("94","Val-de-Marne"), ("95","Val-d'Oise"), ("971","Guadeloupe"), ("972","Martinique"), ("973","Guyane"), ("974","La Réunion")
, ("975","Saint-Pierre-et-Miquelon"), ("977","Saint-Barthélemy"), ("978","Saint-Martin"), ("979","Terres australes et antarctiques françaises"), ("986","Wallis-et-Futuna"), ("987","Polynésie française"), ("988","Nouvelle-Calédonie"), ("989","Île de Clipperton");

# Insertion de données de la table compte
INSERT INTO compte (adresse,ville,email,telephone,pseudo,dateInscription,mdp,codePostal,numDept,droit) VALUES ("5 rue du trou","Rennes","bim.gmail.com","0706958473","bim","2017-01-30","jkhjh","35000","35","Utilisateur");
INSERT INTO compte (adresse,ville,email,telephone,pseudo,dateInscription,mdp,codePostal,numDept,droit) VALUES ("5 rue du plouf","Vannes","rom.gmail.com","0706958473","rom","2017-02-10","lkjks","56000","56","Administrateur");
INSERT INTO compte (adresse,ville,email,telephone,pseudo,dateInscription,mdp,codePostal,numDept,droit) VALUES ("12 place de la resistance","Rennes","calib.gmail.com","0706958473","calib","2017-01-12","oooosp","35000","35","Modérateur");

# Insertion de données de la table individu
INSERT INTO individu (idUser,nom,prenom,dateNaiss) VALUES (1,"Mcdaniel","Seth","2016-02-05");
INSERT INTO individu (idUser,nom,prenom,dateNaiss) VALUES (2,"Jarvis","Tad","2017-02-15");
INSERT INTO individu (idUser,nom,prenom,dateNaiss) VALUES (3,"Rom","jeff","1980-05-06");

# Insertion de données de la table produit_culturel_t
INSERT INTO produit_culturel_t (idPC, typePC, anneeSortie, description) VALUES (NULL, 'Jeux de société', '2016', 'est bon un sushi de super-méchant, surtout lorsque vous êtes un super-héros... À dire vrai, nous allons carrément vous proposer de vous mettre dans la peau d\'un auteur de comics. Vous savez, ces histoires de super-héros en collants moulants, à la cape qui ne s\'empige jamais dans les pattes ou dans un réacteur, non jamais, à la psychologie particulière (\"racontez-moi ce que vous faisiez avec vos sous-vêtements, enfant, pour maintenant les exhiber ainsi ?\"');

# Insertion de données de la table jeu_t
INSERT INTO jeu_t (idPC, nbJoueursMin, nbJoueursMax, nom, editeur, regles, difficulte, public, listePieces, dureePartie) VALUES (1, '2', '5', 'POW', 'Gigamic', 'Des petits dés...\r\n\r\nVous voilà attablé avec vos collègues co-auteurs et néanmoins adversaires... entre 2 et 5, c\'est parfait ! Nous pouvons éditer de la jeunesse donc à partir de 8 ans, ça passe !\r\n\r\nLes 12 tuiles de Super-héros, en bleues, sont alignées aléatoirement. Sur la ligne du dessous, il en va de même pour les 12 Super-vilains en oranges. Le premier auteur se saisit des 5 dés aux 4 symboles différents et les lance sur la table (super-force s\'abstenir à moins de devoir fouiller la ville voisine pour les retrouver...).\r\n\r\nIl aura le droit d\'améliorer son lancé s\'il le désire, et ce, jusqu\'à 2 fois. Mais pour relancer les dés, il faudra, à chaque fois, mettre un dé de côté qui ne pourra plus être modifié. Lorsque le joueur s\'estime satisfait (ou à l\'issue du troisième lancé de toute façon), il va choisir quelle face de dé s\'appliquera pour récupérer une tuile, ce qui marque la fin de son tour.\r\n\r\nLes boucliers bleus permettent d\'aller chercher un super-héros. Et le nombre de boucliers indique jusqu\'où vous pouvez aller le chercher dans la file. Avec trois boucliers, je peux prendre le premier ou le deuxième ou le troisième, voyez !\r\n\r\nLes têtes de mort oranges... eh oui, votre pouvoir de précog est impressionnant et vous avez raison, vous pourrez faire de même, mais avec les super-chantmés !', 'Moyen', 'Pour tous', NULL, '20 minutes');

# Insertion de données de la table jeu_p
INSERT INTO jeu_p (idJeuP, idPC, idProprietaire, etat) VALUES (NULL, '1', '1', 'ras');

# Insertion de données de la table notation_user
INSERT INTO notation_user (idNU, idUser, idNoteur, notation, typeNoteur) VALUES (NULL, '1', '2', '5', 'Emprunteur');

# Insertion de données de la table pret_p
INSERT INTO pret_p (idJeuP, idEmprunteur, dateDebut, dateRendu, jeuRenduATemps,notification) VALUES ('1', '2', '2017-02-08', '2017-02-16', '1','1');

# Insertion de données de la table user_prefere_genre
INSERT INTO user_prefere_genre (idUser, genre) VALUES ('2', 'Plateau');

# Insertion de données de la table message
INSERT INTO message (idMessage, idExped, idDest, sujet, texte) VALUES (NULL, '1', '2', 'combien de joueurs', 'quel jeu pour 5 joueurs?');

# Insertion de données de la table jeu_a_pour_genre
INSERT INTO jeu_a_pour_genre (idPC, genre) VALUES ('1', 'Plateau');

# Insertion de données de la table commentaire_user
INSERT INTO commentaire_user (idNU, commentaireU) VALUES ('1', 'sympa!');

# Insertion de données de la table commentaire_p_c_t
INSERT INTO commentaire_p_c_t (idPC, commentaireT, idUser) VALUES ('1', 'un bon jeu de plateau', '2');

# Insertion de données de la table commentaire_jeu_p
INSERT INTO commentaire_jeu_p (idJeuP, commentaireJP) VALUES ('1', 'boite pas complète');

# Insertion de données de la table commentaire_p_c_t
INSERT INTO a_pour_image (idPC, source) VALUES ('1', 'C:\\Users\\admin\\Pictures\\235839.jpg');

