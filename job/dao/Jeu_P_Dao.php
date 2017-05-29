<?php

// AhMaD: les variables static
const TABLE_JEU_P = "jeu_p";
const CLE_PRIMAIRE_JEU_P = "idJeuP";
const TABLE_JEUT = 'jeu_t';
const TABLE_PCT = 'produit_culturel_t';
const TABLE_COMPTE = "compte";
const TABLE_INDIVIDU = "individu";
const TABLE_EDITEUR_D = 'editeur_d';
const TABLE_JEU_A_POUR_GENRE = 'jeu_a_pour_genre';
const TABLE_A_POUR_IMAGE = 'a_pour_image';
const TABLE_NOTE_JEU_T = 'note_jeu_t';
const TABLE_COMMENTAIRE_P_C_T = 'commentaire_p_c_t';

//AhMaD: functioin qui sert a integrer un valeur dans le table

function insert($list_Values) {

    //AhMaD: déclaration les values
    $idProprietaire = $list_Values['idProprietaire'];
    $idPC = $list_Values['idPC'];


    //AhMaD:ouvrire la connexion avec BD
    $db = openConnexion();



    //AhMaD:la requete pour inserter dans le tableau jeu_p
    $requete_jeu_p = "INSERT INTO " . TABLE_JEU_P . " (idPC, idProprietaire) VALUES ( '" . $idPC . "', '" . $idProprietaire . "');";

    //AhMaD: préparer la requête pour ensuite l'exécuter
    $stmt_jeu_p = $db->prepare($requete_jeu_p);
    $stmt_jeu_p->execute();


    //AhMaD: on recherche la dernière id générée par la precedente requete en utilisant la fonction lastInsertId();
    $lastIdJeuP = $db->lastInsertId();

    //AhMaD:fermateur  la connexion avec BD
    $db = closeConnexion();

    //AhMaD:on créer un nouveau objet 
    return $lastIdJeuP;
}

//AMaD:function select en gros il s'agit de FIND!
function select($requete) {


    //AhMaD:ouvrire la connexion avec BD
    $db = openConnexion();


    //AhMaD:prepration de requete qiu vas trouver l'utilisateur entre deux table pour cela il y a jointeur
    $requete = "SELECT * FROM " . TABLE_INDIVIDU
            . " JOIN " . TABLE_COMPTE . " ON " . TABLE_INDIVIDU . ".idUser = " . TABLE_COMPTE . ".idUser "
            . " JOIN " . TABLE_JEU_P . " ON " . TABLE_JEU_P . ".idProprietaire = " . TABLE_COMPTE . ".idUser "
            . " JOIN " . TABLE_PCT . " ON " . TABLE_JEU_P . ".idPC = " . TABLE_PCT . ".idPC "
            . " JOIN " . TABLE_JEUT . " ON " . TABLE_JEUT . ".idPC = " . TABLE_PCT . ".idPC "
            . $requete . ";";

    //AhMaD: préparer la requête pour ensuite l'exécuter
    $stmt = $db->prepare($requete);

    $stmt->execute();
    //AhMaD: on vas creer un array pour stocker les informations
    $Jeu_P_list = array();

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
        $proprietaire = new Individu($ville, $adresse, $codePostal, $dpt, $email, $telephone, $pseudo, $dateInscription, $mdp, $droit, $nom, $prenom, $dateNaissance, $idUser);

            $nbJoueursMin = $champ['nbJoueursMin'];
            $nbJoueursMax = $champ['nbJoueursMax'];
            $nom = $champ['nom'];
            $editeur = $champ['editeur'];
            $regles = $champ['regles'];
            $difficulte = $champ['difficulte'];
            $public = $champ['public'];
            $listePieces = $champ['listePieces'];
            $dureePartie = $champ['dureePartie'];
            $anneeSortie = $champ['anneeSortie'];
            $description = $champ['description'];
            $idPC = $champ['idPC'];
            $typePC = $champ['typePC'];
            
        /*
         * M : Création de listes en récupèrant les données dans la BDD avec la méthode selectListe($table,$var,$champsSelect)
         */
        $listeGenres = selectListe(TABLE_JEU_A_POUR_GENRE, $idPC, 'genre');

        $listeImages = selectListe(TABLE_A_POUR_IMAGE, $idPC, 'source');

        $listeNotes = selectListe(TABLE_NOTE_JEU_T, $idPC, 'note');

        //=========================== LISTE COMMENTAIRES ====================================================
        /*
         * M : Récupèration dans les tables commentaire_p_c_t et compte des commentaires sur les jeux associés à leur commentateur. Ajout dans une liste
         */
        $requeteComment = "SELECT pseudo, commentaireT  FROM " . TABLE_COMMENTAIRE_P_C_T . " JOIN " . TABLE_COMPTE . " ON " . TABLE_COMMENTAIRE_P_C_T . ".idUser=" . TABLE_COMPTE . ".idUser WHERE idPC=$idPC;";
        $stmtComment = $db->prepare($requeteComment);
        $stmtComment->execute();
        $listeCommentaires = array();
        while ($comment = $stmtComment->fetch(PDO::FETCH_ASSOC)) { // Chaque entrée sera récupérée et placée dans un array.
            $pseudo = $comment['pseudo'];
            $commentaire = $comment['commentaireT'];
            $listeCommentaires [] = [$pseudo => $commentaire];
        }
        //==================================================================================================

        /* création du nouvel objet Jeu_T */
        $jeuT = new Jeu_T($nbJoueursMin, $nbJoueursMax, $nom, $editeur, $regles, $difficulte, $public, $listePieces, $dureePartie, $anneeSortie, $description, $typePC, $listeGenres, $listeNotes, $listeImages, $listeCommentaires, $idPC);

        $idJeuP = $champ['idJeuP'];

        //AhMaD : on vas creer un nouveau objet avec les informations
        //AhMaD : on stocke ce objet dans l'array pour remplir l'array         
        $Jeu_P_list[] = new Jeu_P($proprietaire, $jeuT, $idJeuP);
    }
    //AhMaD: on ferme la conexion
    $db = closeConnexion();

    //AhMaD: finalement on va retourner avec un tableau qui remplit des objets :)
    return $Jeu_P_list;
}

//AhMaD: function updat pour modifer la table
function update($list_Values) {

    //AhMaD: déclaration les values
    $idUser = $list_Values['idUser'];
    $idJeuT = $list_Values['idJeuT'];
    $etat = $list_Values['etat'];

    //AhMaD:ouvrire la connexion avec BD  
    $db = openConnexion();



    //AhMaD:on vas faire une requete pour savoir update le table compte.  
    $user_requete = "UPDATE " . TABLE_COMPTE . " SET idUser = " . $idUser . "WHERE " . TABLE_COMPTE . ". idUser = " . TABLE_JEU_P . ". idUser ;";
    $stmt = $db->prepare($user_requete);
    $stmt->execute();
    $user = $stmt->execute();

    //AhMaD:on vas faire une requete pour savoir update le table jeu_t.  
    $jeu_requete = "UPDATE " . TABLE_JEUT . " SET idJeuT = " . $idJeuT . " WHERE " . TABLE_JEUT . ". idJeuT = " . TABLE_JEU_P . ". idJeuT ;";
    $stmt = $db->prepare($jeu_requete);
    $stmt->execute();
    $jeu = $stmt->execute();

    //AhMaD:prepration de requete qui vas modifier l'utilisateur entre deux table pour cela il y a jointeur
    $requete = "UPDATE " . TABLE_JEU_P . " SET idJeuP=" . $idJeuP . ",idUser =" . $user . ",idJeuT=" . $jeu . ", etat=" . $etat . ";";




    //AhMaD: on vas préparer la requête et l'exécuter et tu vas bien.
    $stmt = $db->prepare($requete);


    //AhMaD: on vas exécuter
    $stmt->execute();



    //AhMaD: on ferme la conexion
    $db = closeConnexion();
}

//AhMaD: function supprimer pour supprimer un copte
function delete($id) {


    //AhMaD:ouvrire la connexion avec BD  
    $db = openConnexion();

    //AhMaD:prepration de requete qui vas supprimer l'utilisateur entre deux table pour cela il y a jointeur
    $requete = "DELETE FROM " . TABLE_JEU_P . " WHERE idJeuP = " . $id["idJeuP"] . " ;";

    //AhMaD: on vas préparer la requête et l'exécuter et tu vas bien.
    $stmt = $db->prepare($requete);


    //AhMaD: on vas exécuter
    $stmt->execute();



    //AhMaD: on ferme la conexion
    $db = closeConnexion();
}
