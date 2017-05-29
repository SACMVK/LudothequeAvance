<?php

include 'emprunt.php';

function generer_prets(int $nombreEmprunteurs, int $nombreJeuxP, string $aujourdhui, int $nombreMessages) {

    // Création de la liste des emprunts
    $listeEmprunt = null;

    $listeJeux = getAllNomJeux();
    $listeUsers = getAllUsers();


    $aujourdhui = dateToJour($aujourdhui);

    $inscriptionMax = -1;

    // pour chaque jeu ...
    for ($indiceJeu = 1; $indiceJeu <= $nombreJeuxP; $indiceJeu++) {
        // .. on détermine un nombre d'emprunt ...
        $nomJeu = $listeJeux[$indiceJeu]["nom"];
        $idJeuT = $listeJeux[$indiceJeu]["idPC"];
        $idPreteur = $listeJeux[$indiceJeu]["idProprietaire"];
        $nomPreteur = [$listeUsers[$idPreteur]["nom"], $listeUsers[$idPreteur]["prenom"]];
        $dateInscriptionPreteur = $listeUsers[$idPreteur]["dateInscription"];
        $inscriptionPreteur = dateToJour($dateInscriptionPreteur);


        $nombreMaxPrets = (int) ($inscriptionPreteur / 60);
        $nombreEmpruntJeuP = rand(0, $nombreMaxPrets);

//        echo "idJeuP : " . $indiceJeu . "<br>";
//        echo "Nombre max d'emprunts : " . $nombreMaxPrets . "<br>";
//        echo "Nombre d'emprunts : " . $nombreEmpruntJeuP . "<br>";

        $joursPrets = null;
        $joursPrets[] = -1;
        $datesPrets = null;
        $datesPrets[] = [-1, -1];
        $listeEmprunteurs = null;
        $listeEmprunteurs [] = "null";

        if ($nombreEmpruntJeuP != 0) {
            // Création liste de dates d'emprunt
            for ($indiceEmprunt = 1; $indiceEmprunt <= $nombreEmpruntJeuP; $indiceEmprunt++) {
                // On a un nouvel emprunteur pour chaque emprunt
                $idEmprunteur = rand(1, $nombreEmprunteurs);
                $dateInscriptionEmprunteur = $listeUsers[$idEmprunteur]["dateInscription"];
                $inscriptionEmprunteur = dateToJour($dateInscriptionEmprunteur);
                $inscriptionPreteur > $inscriptionEmprunteur ? $inscriptionMax = $inscriptionPreteur : $inscriptionMax = $inscriptionEmprunteur;
                // implantation d'un compteur pour éviter une boucle infinie
                do {
                    $dateDebutPret = rand($inscriptionMax, dateToJour("2017-08-31"));
                    $dateFinPret = $dateDebutPret + rand(3, 21);
                    $datesPret = [$dateDebutPret, $dateFinPret];
                    $joursPret = null;
                    // Ajout de 5 jours de marges par rapport au décalage entre le prévu et le réel
                    for ($jourPret = $dateDebutPret - 8; $jourPret < $dateFinPret + 8; $jourPret ++) {
                        $joursPret [] = $jourPret;
                    }
                } while (count(array_intersect($joursPret, $joursPrets)) != 0);
                foreach ($joursPret as $jourPret) {
                    $joursPrets [] = $jourPret;
                }
                $datesPrets [] = $datesPret;
                $listeEmprunteurs [] = $idEmprunteur;
            }
        }

        if ($nombreEmpruntJeuP != 0) {


            // ... pour chaque emprunt, définition de l'emprunt
            for ($indiceEmprunt = 1; $indiceEmprunt <= $nombreEmpruntJeuP; $indiceEmprunt++) {
                $emprunt = new emprunt();
                $emprunt->idJeuP = $indiceJeu;
                $emprunt->idJeuT = $idJeuT;
                $emprunt->nomJeu = $nomJeu;
                $emprunt->idPreteur = $idPreteur;
                $emprunt->nomPreteur = $nomPreteur;
                $emprunt->dateInscriptionPreteur = $dateInscriptionPreteur;
                $emprunt->idEmprunteur = $listeEmprunteurs[$indiceEmprunt];
                $emprunt->nomEmprunteur = [$listeUsers[$listeEmprunteurs[$indiceEmprunt]]["nom"], $listeUsers[$listeEmprunteurs[$indiceEmprunt]]["prenom"]];
                $emprunt->dateInscriptionEmprunteur = $listeUsers[$listeEmprunteurs[$indiceEmprunt]]["dateInscription"];




                // Il y a contre-proposition du prêteur dans 15% des cas
                // Dans les 85%, ce sont les dates de l'emprunteur qui sont validées
                if (rand(0, 100) <= 15) {
                    $emprunt->propositionEmprunteurDateDebut = jourToDate($datesPrets[$indiceEmprunt][0]);
                    $emprunt->propositionEmprunteurDateFin = jourToDate($datesPrets[$indiceEmprunt][1]);
                } else {
                    $emprunt->propositionPreteurDateDebut = jourToDate($datesPrets[$indiceEmprunt][0]);
                    $emprunt->propositionPreteurDateFin = jourToDate($datesPrets[$indiceEmprunt][1]);
                    // Pour ces 15%, on recalcule des dates fictives
                    $dateDebutNonValidee = $datesPrets[$indiceEmprunt][0] + rand(-10, 10);
                    $emprunt->propositionEmprunteurDateDebut = jourToDate($dateDebutNonValidee);
                    $emprunt->propositionEmprunteurDateFin = jourToDate($dateDebutNonValidee + rand(3, 21));
                }




                // 20% d'annulation
                if (rand(0, 100) < 20) {
                    $emprunt->statut = "Annulée";
                    if ($emprunt->propositionPreteurDateDebut == null) {
                        $emprunt->notification = 3;
                    } else {
                        $emprunt->notification = 5;
                    }
                }
                // Si ce n'est pas annulé, elle est en cours dans 40% des cas
                else if ($datesPrets[$indiceEmprunt][0] > $aujourdhui && rand(0, 100) < 40) {
                    $emprunt->statut = "En cours";
                    if ($emprunt->propositionPreteurDateDebut == null) {
                        $emprunt->notification = 1;
                    } else {
                        $emprunt->notification = 4;
                    }
                    // Sinon elle est validée
                } else {
                    $emprunt->statut = "Validée";
                    $envoiDateEnvoi = $datesPrets[$indiceEmprunt][0] - rand(1, 4);
                    $envoiDateReception = $datesPrets[$indiceEmprunt][0] + rand(0, 2);
                    $retourDateEnvoi = $datesPrets[$indiceEmprunt][1] - rand(0, 2);
                    $retourDateReception = $datesPrets[$indiceEmprunt][1] + rand(1, 4);
                    if ($envoiDateEnvoi > $aujourdhui) {
                        if ($emprunt->propositionPreteurDateDebut == null) {
                            $emprunt->notification = 2;
                        } else {
                            $emprunt->notification = 6;
                        }
                        $emprunt->genererExpedition(0);
                    } else if ($envoiDateReception > $aujourdhui) {
                        $emprunt->envoiDateEnvoi = jourToDate($envoiDateEnvoi);
                        $emprunt->notification = 7;
                        $emprunt->genererExpedition(1);
                    } else if ($retourDateEnvoi > $aujourdhui) {
                        $emprunt->envoiDateEnvoi = jourToDate($envoiDateEnvoi);
                        $emprunt->envoiDateReception = jourToDate($envoiDateReception);
                        $emprunt->notification = 8;
                        $emprunt->genererExpedition(2);
                    } else if ($retourDateReception > $aujourdhui) {
                        $emprunt->envoiDateEnvoi = jourToDate($envoiDateEnvoi);
                        $emprunt->envoiDateReception = jourToDate($envoiDateReception);
                        $emprunt->retourDateEnvoi = jourToDate($retourDateEnvoi);
                        $emprunt->notification = 9;
                        $emprunt->genererExpedition(3);
                    } else {
                        $emprunt->envoiDateEnvoi = jourToDate($envoiDateEnvoi);
                        $emprunt->envoiDateReception = jourToDate($envoiDateReception);
                        $emprunt->retourDateEnvoi = jourToDate($retourDateEnvoi);
                        $emprunt->retourDateReception = jourToDate($retourDateReception);
                        $emprunt->notification = 10;
                        $emprunt->genererExpedition(4);
                    }
                }

                $listeEmprunt[] = $emprunt;
            }
        }
    }
    $idMessage = $nombreMessages;


    foreach ($listeEmprunt as $id => $emprunt2) {
        $idEmprunt = $id + 1;
//echo $emprunt2."<br>";
//echo "<b>".$idEmprunt."</b><br>";
//        echo $emprunt2->nomPreteur[0] . " " . $emprunt2->nomPreteur[1];
//        echo "<br>";
//        echo $emprunt2->nomEmprunteur[0] . " " . $emprunt2->nomEmprunteur[1];
//        echo "<br>";
        if ($emprunt2->propositionPreteurDateDebut != null) {
            echo 'INSERT INTO pret_p (idJeuP, idEmprunteur, propositionEmprunteurDateDebut, propositionEmprunteurDateFin, propositionPreteurDateDebut, propositionPreteurDateFin, notification, statutDemande )';
            echo 'VALUES ("' . $emprunt2->idJeuP . '", "' . $emprunt2->idEmprunteur . '", "' . $emprunt2->propositionEmprunteurDateDebut . '", "' . $emprunt2->propositionEmprunteurDateFin . '", "' . $emprunt2->propositionPreteurDateDebut . '", "' . $emprunt2->propositionPreteurDateFin . '", "' . $emprunt2->notification . '", "' . $emprunt2->statut . '");';
            echo '<br>';
        } else {
            echo 'INSERT INTO pret_p (idJeuP, idEmprunteur, propositionEmprunteurDateDebut, propositionEmprunteurDateFin, notification, statutDemande )';
            echo 'VALUES ("' . $emprunt2->idJeuP . '", "' . $emprunt2->idEmprunteur . '", "' . $emprunt2->propositionEmprunteurDateDebut . '", "' . $emprunt2->propositionEmprunteurDateFin . '", "' . $emprunt2->notification . '", "' . $emprunt2->statut . '");';
            echo '<br>';
        }
        if ($emprunt2->statut != "Annulée") {
            if ($emprunt2->envoiDateEnvoi == null) {
                // création d'une expédition vide qui sera updatée
                echo 'INSERT INTO expedition (idPret)';
                echo 'VALUES ("' . $idEmprunt . '");';
                echo '<br>';
            } else if ($emprunt2->envoiDateReception == null) {
                echo 'INSERT INTO expedition (idPret,  envoiDateEnvoi)';
                echo 'VALUES ("' . $idEmprunt . '", "' . $emprunt2->envoiDateEnvoi . '");';
                echo '<br>';
            } else if ($emprunt2->retourDateEnvoi == null) {
                echo 'INSERT INTO expedition (idPret,  envoiDateEnvoi,  envoiDateReception,  envoiEtatJeu,  envoiPiecesManquantes)';
                echo 'VALUES ("' . $idEmprunt . '", "' . $emprunt2->envoiDateEnvoi . '", "' . $emprunt2->envoiDateReception . '", "' . $emprunt2->envoiEtatJeu . '", "' . $emprunt2->envoiPiecesManquantes . '");';
                echo '<br>';
                echo 'INSERT INTO commentaire_jeu_p (idPret, commentaire)';
                echo 'VALUES ("' . $idEmprunt . '", "' . getCommentaire() . '");';
                echo '<br>';
            } else if ($emprunt2->retourDateReception == null) {
                echo 'INSERT INTO expedition (idPret,  envoiDateEnvoi,  envoiDateReception,  envoiEtatJeu,  envoiPiecesManquantes,  retourDateEnvoi)';
                echo 'VALUES ("' . $idEmprunt . '", "' . $emprunt2->envoiDateEnvoi . '", "' . $emprunt2->envoiDateReception . '", "' . $emprunt2->envoiEtatJeu . '", "' . $emprunt2->envoiPiecesManquantes . '", "' . $emprunt2->retourDateEnvoi . '");';
                echo '<br>';
            } else {
                echo 'INSERT INTO expedition (idPret,  envoiDateEnvoi,  envoiDateReception,  envoiEtatJeu,  envoiPiecesManquantes,  retourDateEnvoi,  retourDateReception,  retourEtatJeu,  retourPiecesManquantes)';
                echo 'VALUES ("' . $idEmprunt . '", "' . $emprunt2->envoiDateEnvoi . '", "' . $emprunt2->envoiDateReception . '", "' . $emprunt2->envoiEtatJeu . '", "' . $emprunt2->envoiPiecesManquantes . '", "' . $emprunt2->retourDateEnvoi . '", "' . $emprunt2->retourDateReception . '", "' . $emprunt2->retourEtatJeu . '", "' . $emprunt2->retourPiecesManquantes . '");';
                echo '<br>';
                // Si le jeu a été rendu, l'emprunteur lui donne une note
                echo 'INSERT INTO note_jeu_t (idPC, idUser, note)';
                echo 'VALUES ("' . $emprunt2->idJeuT . '", "' . $emprunt2->idEmprunteur . '", "' . rand(0, 5) . '");';
                echo '<br>';
                // et fait un commentaire
                echo 'INSERT INTO commentaire_p_c_t (idPC, commentaireT, idUser)';
                echo 'VALUES ("' . $emprunt2->idJeuT . '", "' . getCommentaire() . '", "' . $emprunt2->idEmprunteur . '");';
                echo '<br>';
            }
        }
        // génération aléatoire de message pour chaque étape
        switch ($emprunt2->statut) {
            case "Validée":
                if ($emprunt2->propositionPreteurDateDebut != null) {
                    $listeNotification = [1, 2, 7, 8, 9, 10];
                } else {
                    $listeNotification = [1, 4, 6, 7, 8, 9, 10];
                }
                break;
            case "En cours":
                switch ($emprunt2->notification) {
                    case 1:
                        $listeNotification = [1];
                        break;
                    case 4:
                        $listeNotification = [1, 4];
                        break;
                }
                break;
            case "Annulée":
                switch ($emprunt2->notification) {
                    case 3:
                        $listeNotification = [1, 3];
                        break;
                    case 5:
                        $listeNotification = [1, 4, 5];
                        break;
                }
                break;
        }
        if ($emprunt2->envoiDateEnvoi != null) {
            $debutEchanges = rand($inscriptionMax, dateToJour($emprunt2->envoiDateEnvoi));
        } else {
            $debutEchanges = rand($inscriptionMax, dateToJour($emprunt2->propositionEmprunteurDateDebut));
        }
//        echo "<br>" . jourToDate($debutEchanges) . "<br>";
        foreach ($listeNotification as $idNotification) {
            // il y a un message dans 30 % des cas
            if (rand(0, 100) <= 30 && $idNotification <= $emprunt2->notification) {

                $exp = $emprunt2->idPreteur;
                $dest = $emprunt2->idEmprunteur;
                if (in_array($idNotification, [1, 5, 6, 8, 9])) {
                    $dest = $emprunt2->idPreteur;
                    $exp = $emprunt2->idEmprunteur;
                }
                switch ($idNotification) {
                    // demande initiale
                    case 1:
                        $date = jourToDate($debutEchanges);
                        break;
                    // demande validée
                    case 2:
                        if ($emprunt2->envoiDateEnvoi != null) {
                            $date = jourToDate(rand($debutEchanges, dateToJour($emprunt2->envoiDateEnvoi)));
                        } else {
                            $date = jourToDate($debutEchanges + rand(0, 5));
                        }
                        break;
                    // annulation sans contreproposition
                    case 3:
                        $date = jourToDate($debutEchanges + rand(0, 5));
                        break;
                    // contreproposition
                    case 4:
                        if ($emprunt2->statut == "Annulée") {
                            $date = jourToDate($debutEchanges + rand(0, 5));
                        } else {
                            if ($emprunt2->envoiDateEnvoi != null) {
                                $date = jourToDate((int) ((dateToJour($emprunt2->envoiDateEnvoi) - $debutEchanges) / 3) + $debutEchanges);
                            } else {
                                $date = jourToDate($debutEchanges + rand(0, 5));
                            }
                        }
                        break;
                    // annulation contreproposition
                    case 5:
                        $date = jourToDate($debutEchanges + rand(6, 10));
                        break;
                    // validation entre contreproposition et envoi
                    case 6:
                        $date = jourToDate((int) ((dateToJour($emprunt2->envoiDateEnvoi) - $debutEchanges) * 2 / 3 ) + $debutEchanges);
                        break;
                    case 7:
                        $date = $emprunt2->envoiDateEnvoi;
                        break;
                    case 8:
                        $date = $emprunt2->envoiDateReception;
                        break;
                    case 9:
                        $date = $emprunt2->retourDateEnvoi;
                        break;
                    case 10:
                        $date = $emprunt2->retourDateReception;
                        break;
                }
                $idMessage += 1;
                echo 'INSERT INTO message ( idExped, idDest, sujet, texte, dateEnvoi)';
                echo 'VALUES ( "' . $exp . '","' . $dest . '", "' . getTexte(true) . '"," ' . getTexte() . '"," ' . $date . '");';
                echo '<br>';
                echo 'INSERT INTO pret_a_pour_message ( idPret, idMessage, idNotification)';
                echo 'VALUES ( "' . $idEmprunt . '","' . $idMessage . '", "' . $idNotification . '");';
                echo '<br>';
            }
        }
    }
    echo '<br><br>';
}

function dateToJour(string $date) {
    $annee = (int) (explode("-", $date)[0]);
    $mois = (int) (explode("-", $date)[1]);
    $mois -= 1;
    $jours = (int) (explode("-", $date)[2]);
    $listeMois = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    $nombreJours = 0;
    if ($annee == 2017) {
        $mois += 12;
    }
    if ($mois > 1) {
        for ($moisCourant = 0; $moisCourant < $mois; $moisCourant++) {
            $nombreJours += $listeMois[$moisCourant];
        }
    }
    $nombreJours += $jours;
    return $nombreJours;
}

function jourToDate(int $nombreJours) {
    $listeMois = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    $mois = 0;
    while ($nombreJours - $listeMois[$mois] > 0) {
        //echo $nombreJours. " ". $mois. "<br>";
        $nombreJours -= $listeMois[$mois];
        $mois ++;
    }
    $annee = 2016;
    $mois += 1;
    if ($mois > 12) {
        $annee = 2017;
        $mois -= 12;
    }
    return $annee . "-" . $mois . "-" . $nombreJours;
}

function getAllNomJeux() {
    $pdo = openConnexion();
    $requete = "SELECT * FROM jeu_p JOIN  jeu_t ON jeu_p.idPC = jeu_t.idPC;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $list = null;
    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $list [$ligne ["idJeuP"]] = ["nom" => $ligne ["nom"], "idProprietaire" => $ligne ["idProprietaire"], "idPC" => $ligne ["idPC"]];
    }
    $pdo = closeConnexion();
    return $list;
}

function getAllUsers() {
    $pdo = openConnexion();
    $requete = "SELECT * FROM compte JOIN individu ON compte.idUser = individu.idUser;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $list = null;
    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $list [$ligne ["idUser"]] = ["nom" => $ligne ["nom"], "prenom" => $ligne ["prenom"], "dateInscription" => $ligne ["dateInscription"]];
    }
    $pdo = closeConnexion();
    return $list;
}
