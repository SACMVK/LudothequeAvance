<?php

// Charlotte
// ouverture de la connexion
// // declaration variable qui correspond à la table message

const TABLE_MESSAGE = "message";
const TABLE_COMPTE = "compte";
const TABLE_INDIVIDU = "individu";

// function select == function find()
Function select($requete) {

    $pdo = openConnexion();
// on recupere le contenu de la table message
//prepare =avant query pour éviter faille de sécurité

    $requete = "SELECT * FROM " . TABLE_MESSAGE . "
            join " . TABLE_INDIVIDU . " as destIndividu on idDest=destIndividu.idUser
            join " . TABLE_COMPTE . " as destCompte on destCompte.idUser=destindividu.idUser
            join " . TABLE_INDIVIDU . " as expedIndividu on idExped=expedIndividu.idUser
            join " . TABLE_COMPTE . " as expedCompte on expedCompte.idUser=expedIndividu.idUser "
            . $requete . ";";

// execution de la requete
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
// declaration de la variable qui sera retourner à la fin de la fonction
    $listeMessages = array();

// On affiche chaque entrée une à une( grace a fetch)
    while ($donnees = $stmt->fetch(PDO::FETCH_NAMED)) {

// creation des variable correspondant aux attributs de la class Message
        $idMessage = $donnees['idMessage'];
        $texte = $donnees['texte'];
        $sujet = $donnees['sujet'];
        $dateEnvoi = $donnees['dateEnvoi'];

        $destVille = $donnees['ville'][0];
        $destAdresse = $donnees['adresse'][0];
        $destCodePostal = $donnees['codePostal'][0];
        $destDpt = $donnees['numDept'][0];
        $destEmail = $donnees['email'][0];
        $destTelephone = $donnees['telephone'][0];
        $destPseudo = $donnees['pseudo'][0];
        $destDateInscription = $donnees['dateInscription'][0];
        $destMdp = $donnees['mdp'][0];
        $destDroit = $donnees['droit'][0];
        $destNom = $donnees['nom'][0];
        $destPrenom = $donnees['prenom'][0];
        $destDN = $donnees['dateNaiss'][0];

        $expVille = $donnees['ville'][1];
        $expAdresse = $donnees['adresse'][1];
        $expCodePostal = $donnees['codePostal'][1];
        $expDpt = $donnees['numDept'][1];
        $expEmail = $donnees['email'][1];
        $expTelephone = $donnees['telephone'][1];
        $expPseudo = $donnees['pseudo'][1];
        $expDateInscription = $donnees['dateInscription'][1];
        $expMdp = $donnees['mdp'][1];
        $expDroit = $donnees['droit'][1];
        $expNom = $donnees['nom'][1];
        $expPrenom = $donnees['prenom'][1];
        $expDN = $donnees['dateNaiss'][1];

        $dest = new Individu($destVille, $destAdresse, $destCodePostal, $destDpt, $destEmail, $destTelephone, $destPseudo, $destDateInscription, $destMdp, $destDroit, $destNom, $destPrenom, $destDN);
        $exp = new Individu($expVille, $expAdresse, $expCodePostal, $expDpt, $expEmail, $expTelephone, $expPseudo, $expDateInscription, $expMdp, $expDroit, $expNom, $expPrenom, $expDN);

        $listeMessages[] = new Message($exp, $dest, $dateEnvoi, $sujet, $texte, $idMessage);
    }

// fermeture de la connexion
    $pdo = closeConnexion();

// retourne la liste de messages
    return $listeMessages;
}

// &$ = passage par reference
//  = Vous pouvez passer une variable par référence à une fonction, de manière à ce que celle-ci puisse la modifier
Function insert($valuesToInsert) {


// ouverture de la connexion
    $pdo = openConnexion();
    $table = 'message';

    $requeteGetIdFromPseudo = "select idUser from compte where pseudo='" . $valuesToInsert['pseudoDest'] . "';";
    $stmtGetIdFromPseudo = $pdo->prepare($requeteGetIdFromPseudo);
    $stmtGetIdFromPseudo->execute();
    while ($donnees = $stmtGetIdFromPseudo->fetch(PDO::FETCH_ASSOC)) {
        $idDest = $donnees["idUser"];
    }

// on recupere le contenu de la table message
//prepare =avant query pour éviter faille de sécurité
    $stmt = $pdo->prepare("INSERT INTO " . $table . "(idExped, idDest, dateEnvoi, sujet, texte) VALUES( :idExped, :idDest, :dateEnvoi, :sujet, :texte )");

// execution de la requete
    $stmt->execute(array(
        "idExped" => $valuesToInsert['idExped'],
        "idDest" => $idDest,
        "dateEnvoi" => getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"],
        "sujet" => $valuesToInsert['sujet'],
        "texte" => $valuesToInsert['texte']
    ));

    $lastIdMessage = $pdo->lastInsertId();

    $pdo = closeConnexion();
    return $lastIdMessage;
}

// pour Modifier la table
Function update($requete) {
// ouverture de la connexion
    $pdo = openConnexion();


    $stmt = $pdo->prepare("UPDATE " . $table . " SET 'idExped' = :idExped, 'idDest' = :idDest, 'dateEnvoi' = :dateEnvoi, 'sujet' = :sujet, 'texte' = :texte, idMessage =:idMessage)");

    $stmt->execute(array(
        ":idExped" => $requete['idExped'],
        ":idDest" => $requete['idDest'],
        ":dateEnvoi" => $requete['dateEnvoi'],
        ":sujet" => $requete['sujet'],
        ":texte" => $requete[texte],
        ":idMessage" => $requete['idMessage']
    ));
    //echo ("le message a été modifié");



    $pdo = closeConnexion();
}

function delete($idOfLineToDelete) {
    $pdo = openConnexion();


//prepare =avant query pour éviter faille de sécurité
    $requeteDelete = "DELETE  FROM " . TABLE_MESSAGE . " WHERE idMessage =" . $idOfLineToDelete['idMessage'] . ";";
    $stmt = $pdo->prepare($requeteDelete);

// execution de la requete
    $stmt->execute();


    $pdo = closeConnexion();
}

?>