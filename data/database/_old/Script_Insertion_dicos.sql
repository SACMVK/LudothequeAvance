use ludotheque;

## DICOS
# Insertion de données de la table droit_d
INSERT INTO droit_d (droit) VALUES ("Administrateur"), ("Modérateur"), ("Utilisateur");

# Insertion de données de la table etat_d
INSERT INTO etat_d (etat) VALUES ("Neuf"), ("Bon état"),("Usé"), ("Abimé"), ("Pièces manquantes");

# Insertion de données de la table type_p_c_d
INSERT INTO type_p_c_d (typePC) VALUES ("Jeux de société"), ("Jeux vidéos"), ("Livres");

# Insertion de données de la table editeur_d
INSERT INTO editeur_d (editeur) VALUES ("2F"),("Abacus"),("Academy Games"),("Albe Pavo"),("Alderac"),("Alea"),("Amigo"),("Arplay Editions"),("Asmodee"),("Asyncron Games"),("Beleduc"),("Bioviva"),("Blackbook Editions"),("Blackrock Editions"),
("Blue Orange"),("Boite à Heuhh"),("Bombyx"),("Cocktail Games"),("Cranio Creations"),("Da Vinci"),("Days Of Wonder"),("Dialude"),("Diptic"),("Djeco"),("Drei Magier Spiele"),("Edge Entertainment"),
("Editions Dagda"),("Editions La Donzelle"),("Eggertspiele"),("Elfinwerks"),("Euphoria Games"),("Fantasy Flight Games"),("Ferti"),("Filosofia"),("Flatlined Games"),("Foxmind"),
("Fun Frag"),("Funforge"),("Gameworks"),("Ghenos Games"),("Gigamic"),("GMT Games"),("Goliath"),("Grain de Crea"),("Haba"),("Hans Im Gluck"),("Hasvro"),("Hazgaard"),("Helvetia Games"),
("Hurrican"),("Ideal"),("Iello"),("Ilopeli"),("In Ludo Veritas"),("Intrafin"),("Jeux Opla"),("Jeux-educatifs-bilin"),("KiniGame"),("Kosmos"),("La Haute Roche"),("Lansay"),("Le droit de perdre"),
("Le Joueur"),("Le Scorpion Masqué"),("Les Jeux du Griffon"),("Les XII Singes"),("Letheia"),("Libellud"),("Lookout Games"),("Lost Battalion Games"),("Ludically"),("Lumos"),("Matagot Editions"),
("Mayfair Games"),("MushrooM Games"),("OldChap Editions"),("Overlook Publishing"),("Paille Editions"),("Pavillon Noir"),("Pearl Games"),("Pixie Games"),("Play Factory"),("Pilsar Grames"),("Purple Brain"),
("Pygmoo"),("Queen Games"),("QWG"),("Rackham"),("Ravensburger"),("Rio Grande"),("Rosebud"),("Selecta"),("Serious Poulp"),("Sirius"),("Smart"),("Sofa Games"),("Squale Games"),("Stronghold Games"),
("Tenki Games"),("ThinkFun"),("University Games"),("Vermicelle"),("Week End Games"),("Winning Moves"),("Ystari Games"),("Z-Man");

# Insertion de données de la table difficulte_d
INSERT INTO difficulte_d (difficulte) VALUES ("Facile"), ("Moyen"), ("Difficile");

# Insertion de données de la table public_d
INSERT INTO public_d (public) VALUES ("Pour tous"), ("Adultes"), ("Enfants");

# Insertion de données de la table public_d
INSERT INTO type_noteur_d (typeNoteur) VALUES ("Emprunteur"), ("Prêteur");

# Insertion de données de la table genre
INSERT INTO genre (genre) VALUES ("Cartes à jouer"),("Casse-tête"),("Jeu de carte à collectionner"),("Jeu de logique"),("Jeu en ligne"),("Jeux à gratter"),
("Jeux de cartes"),("Jeux de connaissances"),("Jeux de dés"),("Jeux de figurines"),("Jeux de figurines à collectionner"),
("Jeux de guerre"),("Jeux de lettres"),("Jeux de pions"),("Jeux de plateau"),("Jeux de rôles"),("Livre dont vous êtes le héros");

# Insertion de données de la table notification
INSERT INTO notification (notification, sujetPreteur, corpsPreteur, corpsEmprunteur, sujetEmprunteur) VALUES (NULL, "Demande date", "Veuillez preciser la date de diponibilité ?", "emprunt jusqu\'au", "durée d\'emprunt");

# Insertion de données de la table departement
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


