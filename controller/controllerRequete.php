<?php



/* stefan : Cette fonction a pour objectif
 * de créer une string de requête SQL (partie "WHERE")
 * à partir des éléments des formulaires de sélection,
 * éléments envoyés dans $_REQUEST.
 */

function createRequestFromREQUEST() {
    /* stefan : La requête par défaut est vide.
     * Elle restera vide s'il n'y a aucune variable
     * dans $_REQUEST.
     */
    $stringRequest = '';
    if (!empty($_REQUEST)) {
        $stringRequest = 'WHERE ';
        foreach ($_REQUEST as $key => $value) {
            $addKey = false;
            if ($key != "pret" &&$key != "user" && $key != "objectToWorkWith" && $key != "actionToDoWithObject" && stristr($key, 'submit') === FALSE && $key != "reset" && $key != "page" && stristr($key, 'liste') === FALSE) {
                if ($value != null && $value != "" && $value != "-----") {
                    $stringRequest .= $key . '="' . $value .'"';
                    $addKey = true;
                }
            }
            /* stefan : Après son ajout à la requête,
             * on supprime le couple clé-valeur du $_REQUEST ...
             */
            unset($_REQUEST [$key]);
            // stefan : ... de manière à pouvoir ajouter ou non "AND".
            if (!(empty($_REQUEST)) && $addKey) {
                $stringRequest .= ' AND ';
            }
        }
    }
    if (substr($stringRequest, strlen($stringRequest)-5, 4)==" AND"){
        $stringRequest = substr($stringRequest, 0, strlen($stringRequest)-5);
    }
    if ($stringRequest == 'WHERE '){
        $stringRequest = "";
    }
    /* stefan : Un nom d'input ne peut avoir un point (par exemple jeu_t.nom
     * Il faut donc mettre jeu_t#nom et la fonction str_replace
     * va faire la modification.
     */
    return str_replace("#",".",$stringRequest);
}

/* stefan : Cette fonction a pour objectif
 * de récupérer dans $_REQUEST la liste des valeurs
 * afin de permettre des modifications
 * dans la base de données
 * (ajout, modification, suppression d'une ligne).
 */

function getValuesFromREQUEST() {
    $listOfValues = array();
    foreach ($_REQUEST as $key => $value) {
        $listOfValues [$key] = $value;
    }
    return $listOfValues;
}

/* stefan : Si $_GET['page'] contient un "+",
 * l'appel au contrôleur a été fait depuis index.php.
 * L'étape suivant consiste à diviser( (explode()) en deux parties cette variable.
 * La première est l'objet avec lequel il faut faire l'action.
 * La deuxième est l'action.
 */
$objectToWorkWith = $_REQUEST['objectToWorkWith'];
$actionToDoWithObject = $_REQUEST['actionToDoWithObject'];

// stefan : On inclue le DAO relatif à l'objet
include 'job/dao/' . $objectToWorkWith . '_Dao.php';

// stefan : On réalise l'action passée depuis le formulaire.
switch ($actionToDoWithObject) {
    case "selectOne":
        // stefan : Partie DAO
        $request = createRequestFromREQUEST();
        $element = select($request)[0];
        // stefan : Partie IHM
        $pageAAfficher = 'ihm/resultat/' . $objectToWorkWith . '.php';
        break;
    case "selectList":
        // stefan : Partie DAO
        $request = createRequestFromREQUEST();
        $listOfElements = select($request);
        // stefan : Partie IHM
        $pageAAfficher = 'ihm/resultat/' . $objectToWorkWith . '_liste.php';
        break;
    case "insert":
        // stefan : Partie DAO
        $valuesToInsert = getValuesFromREQUEST();
        $lastId = insert($valuesToInsert);
        // stefan : Partie IHM
        switch ($objectToWorkWith) {
            case "Individu":
                // stefan : on met [0] car select retourne une liste (à un seul élément) et on ne prend que le premier
                $_SESSION["monProfil"] = select("WHERE individu.idUser = " . $lastId)[0];
                break;
            case "Jeu_P":
                $_SESSION["maLudotheque"] = select("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
                $pageAAfficher = 'ihm/utilisateur/maLudotheque.php';
                break;
            case "Jeu_T":
                $pageAAfficher = 'ihm/utilisateur/maLudotheque.php'; // ?
                break;
            case "Message":
                $pageAAfficher = 'ihm/utilisateur/mesMessages.php';
                break;
        }
        break;
    case "update":
        // stefan : Partie DAO
        $valuesToUpdate = getValuesFromREQUEST();
        update($valuesToUpdate);
        // stefan : Partie IHM
        // Si on modifie un individu et que c'est l'utilisateur qui modifie ses propres informations,
        // il faut mettre à jour l'objet dans la RAM depuis la base de données
        if (($objectToWorkWith == "Individu") && ($_SESSION["monProfil"]->getIdUser() == $_REQUEST["idUser"])) {
            // stefan : récupération de l'id
            $idUserConnecte = $_SESSION["monProfil"]->getIdUser();
            // stefan : suppression de l'utilisateur
            unset($_SESSION["monProfil"]);
            // stefan : recréation de l'utilisateur depuis la base de données
            $_SESSION["monProfil"] = select("WHERE individu.idUser = " . $idUserConnecte)[0];
            $pageAAfficher = 'ihm/utilisateur/monProfil.php';
        }

        break;
    case "delete":
        // stefan : Partie DAO
        // stefan : Ici, on ne récupère qu'une valeur (ID).
        $idOfLineToDelete = getValuesFromREQUEST();
        delete($idOfLineToDelete);
        // stefan : Partie IHM
        switch ($objectToWorkWith) {
            case "Individu":

                break;
            case "Jeu_P":
                $_SESSION["maLudotheque"] = select("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
                $pageAAfficher = 'ihm/utilisateur/maLudotheque.php';
                break;
            case "Jeu_T":
                $pageAAfficher = 'ihm/utilisateur/maLudotheque.php'; // ?
                break;
            case "mesMessageRecus":
                 $_SESSION["mesMessagesRecus"] = select("WHERE idDest = " . $_SESSION["monProfil"]->getIdUser());
                $pageAAfficher = $_REQUEST["page"];
                break;
            
            case "mesMessageEnvoyes":
                $_SESSION["mesMessagesEnvoyes"] = select("WHERE idExped = " . $_SESSION["monProfil"]->getIdUser());
                $pageAAfficher = $_REQUEST["page"];
                break;
        }
        break;
}


