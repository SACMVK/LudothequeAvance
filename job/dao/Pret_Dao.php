<?php

function selectPrets($requete) {


    //AhMaD:ouvrire la connexion avec BD
    $db = openConnexion();


    $requete = "SELECT * FROM pret_p "
            . " JOIN compte as compteEmprunteur ON compteEmprunteur.idUser = pret_p.idEmprunteur "
            . " JOIN individu as individuEmprunteur ON individuEmprunteur.idUser = pret_p.idEmprunteur "
            . " JOIN jeu_p ON jeu_p.idJeuP = pret_p.idJeuP "
            . " JOIN produit_culturel_t ON jeu_p.idPC = produit_culturel_t.idPC "
            . " JOIN jeu_t ON jeu_t.idPC = produit_culturel_t.idPC "
            . " JOIN compte as compteProprietaire ON jeu_p.idProprietaire = compteProprietaire.idUser "
            . " JOIN individu as individuProprietaire ON jeu_p.idProprietaire = individuProprietaire.idUser "
            . $requete . ";";


    $stmt = $db->prepare($requete);

    $stmt->execute();

    $pret_list = array();

    /* stefan : PDO ne permet pas d'avoir les noms de colonnes retournées de type table.colonne
     * En cas de nom doublon (par exemple nom emprunteur, nom propriétaire et nom jeu),
     * FETCH_ASSOC écrase les valeurs car il ne peut retourner que "nom".
     * FETCH_NAMED créé des tableaux lorsque plusieurs colonnes ont le même nom.
     * Il faut donc aller chercher les index.
     * On peut se repérer car les tableaux sont créé au fur et à mesure de la déclaration
     * des tables dans le JOIN.
     * D'où l'intérêt d'avoir des noms de colonnes intégrant le nom
     * de la table : table_colonne.
     */
    while ($champ = $stmt->fetch(PDO::FETCH_NAMED)) {
        $idUserProprietaire = $champ['idUser']["2"];
        $villeProprietaire = $champ['ville']["1"];
        $adresseProprietaire = $champ['adresse']["1"];
        $codePostalProprietaire = $champ['codePostal']["1"];
        $dptProprietaire = $champ['numDept']["1"];
        $emailProprietaire = $champ['email']["1"];
        $telephoneProprietaire = $champ['telephone']["1"];
        $pseudoProprietaire = $champ['pseudo']["1"];
        $dateInscriptionProprietaire = $champ['dateInscription']["1"];
        $mdpProprietaire = $champ['mdp']["1"];
        $droitProprietaire = $champ['droit']["1"];
        $nomProprietaire = $champ['nom']["2"];
        $prenomProprietaire = $champ['prenom']["1"];
        $dateNaissanceProprietaire = $champ['dateNaiss']["1"];

        $proprietaire = new Individu($villeProprietaire, $adresseProprietaire, $codePostalProprietaire, $dptProprietaire, $emailProprietaire, $telephoneProprietaire, $pseudoProprietaire, $dateInscriptionProprietaire, $mdpProprietaire, $droitProprietaire, $nomProprietaire, $prenomProprietaire, $dateNaissanceProprietaire, $idUserProprietaire);

        $nbJoueursMinJeuT = $champ['nbJoueursMin'];
        $nbJoueursMaxJeuT = $champ['nbJoueursMax'];
        $nomJeuT = $champ['nom']["1"];
        $editeurJeuT = $champ['editeur'];
        $reglesJeuT = $champ['regles'];
        $difficulteJeuT = $champ['difficulte'];
        $publicJeuT = $champ['public'];
        $listePiecesJeuT = $champ['listePieces'];
        $dureePartieJeuT = $champ['dureePartie'];
        $anneeSortieJeuT = $champ['anneeSortie'];
        $descriptionJeuT = $champ['description'];
        $idPCJeuT = $champ['idPC']["0"];
        $typePCJeuT = $champ['typePC'];

        $listeGenresJeuT = array();
        $listeImagesJeuT = array();
        $listeCommentairesJeuT = array();
        $noteMoyenneJeuT = 5;


        $jeuT = new Jeu_T($nbJoueursMinJeuT, $nbJoueursMaxJeuT, $nomJeuT, $editeurJeuT, $reglesJeuT, $difficulteJeuT, $publicJeuT, $listePiecesJeuT, $dureePartieJeuT, $anneeSortieJeuT, $descriptionJeuT, $typePCJeuT, $listeGenresJeuT, $noteMoyenneJeuT, $listeImagesJeuT, $listeCommentairesJeuT, $idPCJeuT);

        $idJeuP = $champ['idJeuP']["0"];

        $jeuP = new Jeu_P($proprietaire, $jeuT, $idJeuP);

        $idUserEmprunteur = $champ['idUser']["0"];
        $villeEmprunteur = $champ['ville']["0"];
        $adresseEmprunteur = $champ['adresse']["0"];
        $codePostalEmprunteur = $champ['codePostal']["0"];
        $dptEmprunteur = $champ['numDept']["0"];
        $emailEmprunteur = $champ['email']["0"];
        $telephoneEmprunteur = $champ['telephone']["0"];
        $pseudoEmprunteur = $champ['pseudo']["0"];
        $dateInscriptionEmprunteur = $champ['dateInscription']["0"];
        $mdpEmprunteur = $champ['mdp']["0"];
        $droitEmprunteur = $champ['droit']["0"];
        $nomEmprunteur = $champ['nom']["0"];
        $prenomEmprunteur = $champ['prenom']["0"];
        $dateNaissanceEmprunteur = $champ['dateNaiss']["0"];

        $emprunteur = new Individu($villeEmprunteur, $adresseEmprunteur, $codePostalEmprunteur, $dptEmprunteur, $emailEmprunteur, $telephoneEmprunteur, $pseudoEmprunteur, $dateInscriptionEmprunteur, $mdpEmprunteur, $droitEmprunteur, $nomEmprunteur, $prenomEmprunteur, $dateNaissanceEmprunteur, $idUserEmprunteur);

        $propositionEmprunteurDateDebut = $champ['propositionEmprunteurDateDebut'];
        $propositionEmprunteurDateFin = $champ['propositionEmprunteurDateFin'];
        $propositionPreteurDateDebut = $champ['propositionPreteurDateDebut'];
        $propositionPreteurDateFin = $champ['propositionPreteurDateFin'];
        $idNotification = $champ['notification'];
        $statutDemande = $champ['statutDemande'];
        $idPret = $champ['idPret'];

        $requeteNotification = "SELECT * FROM notification WHERE idNotification = " . $idNotification . ";";
        $stmtNotification = $db->prepare($requeteNotification);
        $stmtNotification->execute();
        $notification_dic = array();
        while ($champNotification = $stmtNotification->fetch(PDO::FETCH_ASSOC)) {
            $notification_dic ["sujetPreteur"] = $champNotification["sujetPreteur"];
            $notification_dic ["corpsPreteur"] = $champNotification["corpsPreteur"];
            $notification_dic ["sujetEmprunteur"] = $champNotification["sujetEmprunteur"];
            $notification_dic ["corpsEmprunteur"] = $champNotification["corpsEmprunteur"];
        }

        $nouveauPret = new Pret($jeuP, $emprunteur, $propositionEmprunteurDateDebut, $propositionEmprunteurDateFin, $propositionPreteurDateDebut, $propositionPreteurDateFin, $idNotification, $notification_dic, $statutDemande, $idPret);

        $requeteExpedition = "SELECT * FROM expedition WHERE idPret = " . $idPret . ";";
        $stmtExpedition = $db->prepare($requeteExpedition);
        $stmtExpedition->execute();
        while ($champExpedition = $stmtExpedition->fetch(PDO::FETCH_ASSOC)) {
            $envoiDateEnvoi = $champExpedition["envoiDateEnvoi"];
            $envoiDateReception = $champExpedition["envoiDateReception"];
            $envoiEtatJeu = $champExpedition["envoiEtatJeu"];
            $envoiPiecesManquantes = $champExpedition["envoiPiecesManquantes"];
            $retourDateEnvoi = $champExpedition["retourDateEnvoi"];
            $retourDateReception = $champExpedition["retourDateReception"];
            $retourEtatJeu = $champExpedition["retourEtatJeu"];
            $retourPiecesManquantes = $champExpedition["retourPiecesManquantes"];
            $expedition = new Expedition($envoiDateEnvoi, $envoiDateReception, $envoiEtatJeu, $envoiPiecesManquantes, $retourDateEnvoi, $retourDateReception, $retourEtatJeu, $retourPiecesManquantes);
            $nouveauPret->setExpedition($expedition);
        }



        $pret_list[] = $nouveauPret;
    }

    $db = closeConnexion();


    return $pret_list;
}

function insertPret($list_Values) {
    $idJeuP = $list_Values["idJeuP"];
    $idEmprunteur = $list_Values["idEmprunteur"];
    $propositionEmprunteurDateDebut = convertDateToSQLdate($list_Values["propositionEmprunteurDateDebut"]);
    $propositionEmprunteurDateFin = convertDateToSQLdate($list_Values["propositionEmprunteurDateFin"]);
    $notification = $list_Values["notification"];
    $statutDemande = $list_Values["statutDemande"];
    $requete = "INSERT INTO pret_p (idJeuP, idEmprunteur, propositionEmprunteurDateDebut, propositionEmprunteurDateFin, notification, statutDemande) "
            . "VALUES ('" . $idJeuP . "','" . $idEmprunteur . "','" . $propositionEmprunteurDateDebut . "','" . $propositionEmprunteurDateFin . "','" . $notification . "','" . $statutDemande . "');";
    $db = openConnexion();
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $lastInsertId = $db->lastInsertId();
    $db = closeConnexion();
    return $lastInsertId;
}

function insertExpedition($list_Values) {
    $idPret = $list_Values["idPret"];
    $envoiDateEnvoi = convertDateToSQLdate($list_Values["envoiDateEnvoi"]);
    $requete = "INSERT INTO expedition (idPret, envoiDateEnvoi) VALUES ('" . $idPret . "','" . $envoiDateEnvoi . "');";
    $db = openConnexion();
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $lastInsertId = $db->lastInsertId();
    $db = closeConnexion();
    return $lastInsertId;
}

function insertMessagePret($list_Values) {
    $idPret = $list_Values["idPret"];
    $idMessage = $list_Values["idMessage"];
    $idNotification = $list_Values["idNotification"];
    $requete = "INSERT INTO pret_a_pour_message (idPret, idMessage, idNotification) VALUES ('" . $idPret . "','" . $idMessage . "','" . $idNotification . "');";
    $db = openConnexion();
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $lastInsertId = $db->lastInsertId();
    $db = closeConnexion();
    return $lastInsertId;
}

function insertNote($list_Values) {
    $idPC = $list_Values["idPC"];
    $idUser = $list_Values["idUser"];
    $note = $list_Values["note"];
    $requete = "INSERT INTO note_jeu_t (idPC, idUser, note) VALUES ('" . $idPC . "','" . $idUser . "','" . $note . "');";
    $db = openConnexion();
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $lastInsertId = $db->lastInsertId();
    $db = closeConnexion();
    return $lastInsertId;
}

function insertCommentaire($list_Values) {
    $idPC = $list_Values["idPC"];
    $commentaireT = $list_Values["commentaireT"];
    $idUser = $list_Values["idUser"];
    $requete = "INSERT INTO commentaire_p_c_t (idPC, commentaireT, idUser) VALUES ('" . $idPC . "','" . $commentaireT . "','" . $idUser . "');";
    $db = openConnexion();
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $lastInsertId = $db->lastInsertId();
    $db = closeConnexion();
    return $lastInsertId;
}

function updatePret($list_Values) {
    $idPret = $list_Values["idPret"];
    $listeSet = [];
    if (!empty($list_Values["idJeuP"])) {
        $listeSet [] = "idJeuP = '" . $list_Values["idJeuP"] . "'";
    }
    if (!empty($list_Values["idEmprunteur"])) {
        $listeSet [] = "idEmprunteur = '" . $list_Values["idEmprunteur"] . "'";
    }
    if (!empty($list_Values["propositionEmprunteurDateDebut"])) {
        $listeSet [] = "propositionEmprunteurDateDebut = '" . convertDateToSQLdate($list_Values["propositionEmprunteurDateDebut"]) . "'";
    }
    if (!empty($list_Values["propositionEmprunteurDateFin"])) {
        $listeSet [] = "propositionEmprunteurDateFin = '" . convertDateToSQLdate($list_Values["propositionEmprunteurDateFin"]) . "'";
    }
    if (!empty($list_Values["propositionPreteurDateDebut"])) {
        $listeSet [] = "propositionPreteurDateDebut = '" . convertDateToSQLdate($list_Values["propositionPreteurDateDebut"]) . "'";
    }
    if (!empty($list_Values["propositionPreteurDateFin"])) {
        $listeSet [] = "propositionPreteurDateFin = '" . convertDateToSQLdate($list_Values["propositionPreteurDateFin"]) . "'";
    }
    if (!empty($list_Values["notification"])) {
        $listeSet [] = "notification = '" . $list_Values["notification"] . "'";
    }
    if (!empty($list_Values["statutDemande"])) {
        $listeSet [] = "statutDemande = '" . $list_Values["statutDemande"] . "'";
    }
    $set = "";
    for ($i = 0; $i < count($listeSet) - 1; $i++) {
        $set .= $listeSet[$i] . ", ";
    }
    $set .= $listeSet[count($listeSet) - 1];

    $requete = "UPDATE pret_p SET " . $set . " WHERE idPret = " . $idPret . ";";

    $db = openConnexion();
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $db = closeConnexion();
}

function updateExpedition($list_Values) {
    $idPret = $list_Values["idPret"];
    if (!empty($list_Values["envoiDateEnvoi"])) {
        $listeSet [] = "envoiDateEnvoi = '" . convertDateToSQLdate($list_Values["envoiDateEnvoi"]) . "'";
    }
    if (!empty($list_Values["envoiDateReception"])) {
        $listeSet [] = "envoiDateReception = '" . convertDateToSQLdate($list_Values["envoiDateReception"]) . "'";
    }
    if (!empty($list_Values["envoiEtatJeu"])) {
        $listeSet [] = "envoiEtatJeu = '" . $list_Values["envoiEtatJeu"] . "'";
    }
    if (!empty($list_Values["envoiPiecesManquantes"])) {
        if ($list_Values["envoiPiecesManquantes"] == "oui") {
            $listeSet [] = "envoiPiecesManquantes = 1";
        } else {
            $listeSet [] = "envoiPiecesManquantes = 0";
        }
    }
    if (!empty($list_Values["retourDateEnvoi"])) {
        $listeSet [] = "retourDateEnvoi = '" . convertDateToSQLdate($list_Values["retourDateEnvoi"]) . "'";
    }
    if (!empty($list_Values["retourDateReception"])) {
        $listeSet [] = "retourDateReception = '" . convertDateToSQLdate($list_Values["retourDateReception"]) . "'";
    }
    if (!empty($list_Values["retourEtatJeu"])) {
        $listeSet [] = "retourEtatJeu = '" . $list_Values["retourEtatJeu"] . "'";
    }
    if (!empty($list_Values["retourPiecesManquantes"])) {
        if ($list_Values["retourPiecesManquantes"] == "oui") {
            $listeSet [] = "retourPiecesManquantes = 1";
        } else {
            $listeSet [] = "retourPiecesManquantes = 0";
        }
    }
    $set = "";
    for ($i = 0; $i < count($listeSet) - 1; $i++) {
        $set .= $listeSet[$i] . ", ";
    }
    $set .= $listeSet[count($listeSet) - 1];
    $requete = "UPDATE expedition SET " . $set . " WHERE idPret = " . $idPret . ";";

    $db = openConnexion();
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $db = closeConnexion();
}

function deletePret($id) {
    
}
