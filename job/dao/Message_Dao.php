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
   
    $requete = "SELECT * FROM ".TABLE_MESSAGE."
            join ".TABLE_INDIVIDU." as destIndividu on idDest=destIndividu.idUser
            join ".TABLE_COMPTE." as destCompte on destCompte.idUser=destindividu.idUser
            join ".TABLE_INDIVIDU." as expedIndividu on idExped=expedIndividu.idUser
            join ".TABLE_COMPTE." as expedCompte on expedCompte.idUser=expedIndividu.idUser "
            .$requete.";";
    
// execution de la requete
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
// declaration de la variable qui sera retourner à la fin de la fonction
    $listeMessages = array();

// On affiche chaque entrée une à une( grace a fetch)
    while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {

// creation des variable correspondant aux attributs de la class Message
        $idMessage = $donnees['idMessage'];
        $idExped = $donnees['idExped'];
        $idDest = $donnees['idDest'];
        $texte = $donnees['texte'];
        $sujet = $donnees['sujet'];
        $dateEnvoi = $donnees['dateEnvoi'];
        
        $destVille = $donnees['ville'];
        $destAdresse = $donnees['adresse'];
        $destCodePostal = $donnees['codePostal'];
        $destDpt = $donnees['numDept'];
        $destEmail = $donnees['email'];
        $destTelephone = $donnees['telephone'];
        $destPseudo = $donnees['pseudo'];
        $destDateInscription = $donnees['dateInscription'];
        $destMdp = $donnees['mdp'];
        $destDroit = $donnees['droit'];
        $destNom = $donnees['nom'];
        $destPrenom = $donnees['prenom'];
        $destDN = $donnees['dateNaiss'];
        
        $expVille = $donnees['ville'];
        $expAdresse = $donnees['adresse'];
        $expCodePostal = $donnees['codePostal'];
        $expDpt = $donnees['numDept'];
        $expEmail = $donnees['email'];
        $expTelephone = $donnees['telephone'];
        $expPseudo = $donnees['pseudo'];
        $expDateInscription = $donnees['dateInscription'];
        $expMdp = $donnees['mdp'];
        $expDroit = $donnees['droit'];
        $expNom = $donnees['nom'];
        $expPrenom = $donnees['prenom'];
        $expDN = $donnees['dateNaiss'];

        $dest = new Individu($destVille, $destAdresse, $destCodePostal, $destDpt, $destEmail, $destTelephone, $destPseudo, $destDateInscription, $destMdp, $destDroit, $destNom, $destPrenom, $destDN);
        $exp = new Individu($expVille, $expAdresse, $expCodePostal, $expDpt, $expEmail, $expTelephone, $expPseudo, $expDateInscription, $expMdp, $expDroit, $expNom, $expPrenom, $expDN);
    
        $listeMessages[] = new Message($exp, $dest, $dateEnvoi, $sujet, $texte, $idMessage);
    }
//echo $donnees['texte'] ."   ". $donnees['sujet'] ."   ". $donnees['typeMessage'];
// fermeture de la connexion
        $pdo = closeConnexion();

// retourne la liste de messages
        return $listeMessages;
    
}

// &$ = passage par reference
//  = Vous pouvez passer une variable par référence à une fonction, de manière à ce que celle-ci puisse la modifier
Function insert($requete) {


// ouverture de la connexion
    $pdo = openConnexion();
    $table = 'message';


// on recupere le contenu de la table message
//prepare =avant query pour éviter faille de sécurité
    $stmt = $pdo->prepare("INSERT INTO " . $table . "(idExped, idDest, dateEnvoi, sujet, texte) VALUES( :idExped, :idDest, :dateEnvoi, :sujet, :texte )");

// execution de la requete
    $stmt->execute(array(
        "idExped" => $requete['idExped'],
        "idDest" => $requete['idDest'],
        "dateEnvoi" => $requete['dateEnvoi'],
        "sujet" => $requete['sujet'],
        "texte" => $requete['texte']
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
    $requeteDelete = "DELETE  FROM " . TABLE_MESSAGE . " WHERE idMessage =".$idOfLineToDelete['idMessage'].";";
    $stmt = $pdo->prepare($requeteDelete);
 
// execution de la requete
    $stmt->execute();


    $pdo = closeConnexion();
}

?>