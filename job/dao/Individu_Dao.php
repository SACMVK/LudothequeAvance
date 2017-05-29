<?php

// AhMaD: les variables static
const TABLE_INDIVIDU = "individu";
const TABLE_COMPTE = "compte";
const CLE_PRIMAIRE_INDIVIDU = "nom";
const CLE_PRIMAIRE_COMPTE = "idUser";

//AhMaD: functioin qui sert a integrer un valeur dans le table

function insert($list_Values) {

    //AhMaD: déclaration les values
    $ville = $list_Values['ville'];
    $adresse = $list_Values['adresse'];
    $codePostal = $list_Values['codePostal'];
    // stefan : le numéro de département est déduit du code postal
    if (strlen($codePostal) == 5) {
        $numDept = substr($codePostal, 0, 2);
        // stefan : cas où le code postal ne compte que 4 chiffres
    } else if (strlen($codePostal) == 4) {
        $numDept = substr($codePostal, 0, 1);
        // stefan : cas où le code postal a été entré avec un 0 au début
    } else if (substr($codePostal, 0, 1) == "0") {
        $numDept = substr($codePostal, 1, 2);
        // stefan : cas des DOM-TOM
    } else if (substr($codePostal, 0, 2) == 97 || substr($codePostal, 0, 2) == 98) {
        $numDept = substr($codePostal, 0, 3);
    }
    $email = $list_Values['email'];
    $telephone = $list_Values['telephone'];
    $pseudo = $list_Values['pseudo'];
    $dateInscription = getAujourdhui();
    $mdp = $list_Values['mdp'];
    // stefan : par défaut, lorsque l'on s'inscrit, on est simple utilisateur. Seul l'admin peut modifier les droits.
    $droit = "Utilisateur";
    $prenom = $list_Values['prenom'];
    $nom = $list_Values['nom'];
    $dateNaiss = convertDateToSQLdate($list_Values['dateNaiss']);

    //AhMaD:ouvrire la connexion avec BD
    $db = openConnexion();



    //AhMaD:la requete pour inserter dans le tableau compte
    $requete_compte = "INSERT INTO " . TABLE_COMPTE . " (adresse,ville,numDept,email,telephone,pseudo,dateInscription,mdp,codePostal,droit)
                          VALUES ('" . $adresse . "','" . $ville . "','" . $numDept . "','" . $email . "','" . $telephone . "','" . $pseudo . "','" . $dateInscription . "','" . $mdp . "','" . $codePostal . "','" . $droit . "');";

    //AhMaD: préparer la requête pour ensuite l'exécuter
    $stmt_compte = $db->prepare($requete_compte);
    $stmt_compte->execute();



    //AhMaD: on recherche la dernière id générée par la precedente requete en utilisant la fonction lastInsertId();
    $lastIdIndividu = $db->lastInsertId();


    //AhMaD:la requete pour inserter dans le tableau individu
    $requete_individu = "INSERT INTO " . TABLE_INDIVIDU . "(nom,prenom,idUser,dateNaiss) VALUES ('" . $nom . "','" . $prenom . "','" . $lastIdIndividu . "','" . $dateNaiss . "');";
    //AhMaD: préparer la requête pour ensuite l'exécuter
    $stmt_individu = $db->prepare($requete_individu);

    //AhMaD:exécuter
    $stmt_individu->execute();


    //AhMaD:fermeture de la connexion avec BD
    $db = closeConnexion();

    return $lastIdIndividu;
}

//AMaD:function select en gros il s'agit de FIND!
function select($requete) {


    //AhMaD:ouvrire la connexion avec BD
    $db = openConnexion();

    //AhMaD:prepration de requete qiu vas trouver l'utilisateur entre deux table pour cela il y a jointeur
    $requete = "SELECT * FROM " . TABLE_INDIVIDU . " JOIN " . TABLE_COMPTE . " ON " . TABLE_INDIVIDU . ".idUser = " . TABLE_COMPTE . ".idUser " . $requete . ";";

    //AhMaD: préparer la requête pour ensuite l'exécuter
    $stmt = $db->prepare($requete);

    $stmt->execute();
    //AhMaD: on vas creer un array pour stocker les informations
    $individus = null;

    //AhMaD: je parcoure les tables pour afficher les resultats de ma requete.
    // mysql_fetch_assoc($result): permet de afficher les informations de toutes les champs
    while ($champ = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //AhMaD:tant qu'il y a des informations dans chaque champ de la ligne je les prend el je les affiche 
        $idUser = $champ['idUser'];
        $ville = $champ['ville'];
        $adresse = $champ['adresse'];
        $codePostal = $champ['codePostal'];
        $dpt = $champ['numDept'];
        $email = $champ['email'];
        $telephone = $champ['telephone'];
        $pseudo = $champ['pseudo'];
        $dateInscription = $champ['dateInscription'];
        $mdp = $champ['mdp'];
        $droit = $champ['droit'];
        $nom = $champ['nom'];
        $prenom = $champ['prenom'];
        $dateNaissance = $champ['dateNaiss'];

        //AhMaD : on vas creer un nouveau objet avec les informations
        //AhMaD : on stocke ce objet dans l'array pour remplir l'array 
        $individus[] = new Individu($ville, $adresse, $codePostal, $dpt, $email, $telephone, $pseudo, $dateInscription, $mdp, $droit, $nom, $prenom, $dateNaissance, $idUser);
    }
    //AhMaD: on ferme la conexion
    $db = closeConnexion();

    //AhMaD: finalement on vas retourner avec un tableaux qui remplit des objets :)
    return $individus;
}

//AhMaD: function updat pour modifer le table
function update($list_Values) {

    //AhMaD: déclaration les values
    $idUser = $list_Values['idUser'];
    $ville = $list_Values['ville'];
    $adresse = $list_Values['adresse'];
    $numDept = $list_Values['numDept'];
    $codePostal = $list_Values['codePostal'];
    $email = $list_Values['email'];
    $telephone = $list_Values['telephone'];
    $pseudo = $list_Values['pseudo'];
    $dateInscription = $list_Values['dateInscription'];
    $mdp = $list_Values['mdp'];
    $droit = $list_Values['droit'];
    $prenom = $list_Values['prenom'];
    $nom = $list_Values['nom'];
    $dateNaiss = $list_Values['dateNaiss'];

    //AhMaD:ouvrire la connexion avec BD  
    $db = openConnexion();






    //AhMaD:on vas faire une requete pour savoir si le droit était changé.    ps :   IN  ici  une oprétion logique comme (!=) ou (==) 
//    $droit_requete = "UPDATE " . TABLE_COMPTE . " SET droit = " . '$droit' . " WHERE " . '$droit' . " IN(SELECT" . '$droit' . " FROM droit);";
//    $stmt = $db->prepare($droit_requete);
//    $stmt->execute();
//    $le_droit = $stmt->execute();
    //AhMaD:prepration de requete qui vas modifier l'utilisateur entre deux table pour cela il y a jointeur
    $requete = "UPDATE " . TABLE_INDIVIDU . " JOIN " . TABLE_COMPTE . " ON " . TABLE_INDIVIDU . ".idUser = " . TABLE_COMPTE . ".idUser SET ville = '" . $ville . "', adresse = '" . $adresse . "', codePostal = '" . $codePostal . "', numDept = '" . $numDept . "', email = '" . $email . "', telephone = '" . $telephone . "', pseudo = '" . $pseudo . "', dateInscription = '" . $dateInscription . "', mdp = '" . $mdp . "', droit = '" . $droit . "', nom = '" . $nom . "',  prenom = '" . $prenom . "', dateNaiss= '" . $dateNaiss . "' WHERE " . TABLE_INDIVIDU . ".idUser = " . $idUser . ";";




    //AhMaD: on va préparer la requête et l'exécuter et tu vas bien.
    $stmt = $db->prepare($requete);


    //AhMaD: on vas exécuter
    $stmt->execute();



    //AhMaD: on ferme la conexion
    $db = closeConnexion();
}

//AhMaD: function supprimer pour supprimer un copte
function delete($idOfLineToDelete) {


    //AhMaD:ouvrire la connexion avec BD  
    $db = openConnexion();

    //AhMaD:prepration de requete qui vas supprimer l'utilisateur entre deux table pour cela il y a jointeur
    $requete = "DELETE FROM " . TABLE_INDIVIDU . "JOIN" . TABLE_COMPTE . " ON " . TABLE_INDIVIDU . ".idUser = " . TABLE_COMPTE . ".idUser  WHERE  idUser= '" . $idOfLineToDelete . "' ;";

    //AhMaD: on vas préparer la requête et l'exécuter et tu vas bien.
    $stmt = $db->prepare($requete);


    //AhMaD: on vas exécuter
    $stmt->execute();

    //AhMaD:un petit test pour savoir si tout vas bien
    if ($stmt == true) {
        echo"l'utilisateur était supprimé avec succès";
    } else {
        die("Il y a des erreurs, veuillez modifier votre choix");
    }


    //AhMaD: on ferme la conexion
    $db = closeConnexion();
}
