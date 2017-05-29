<?php

if ($_REQUEST['connexion'] == "on") {
    // stefan : la demande arrive en post afin de masquer les informations


    include 'job/dao/Connexion_Dao.php';
    $connexionValide = isConnexionValide($_POST["pseudo"], $_POST["mdp"]);

    // stefan : $connexionValide retourne un array avec en 0 un boolean et en 1 l'id
    if ($connexionValide[0]) {
        include 'job/dao/Individu_Dao.php';
        $_SESSION["monProfil"] = select("WHERE individu.idUser = " . $connexionValide[1])[0];
        $pageAAfficher = "ihm/pages/accueil.php";
    } else {
        $pageAAfficher = "ihm/connexion/echecConnexion.php";
    }
    unset($connexionValide);
}



if ($_REQUEST['connexion'] == "off") {
    /* stefan : la demande de déconnexion arrive en get
     * parce qu'elle arrive par un lien et non par un formulaire
     * et que ce n'est pas une information à cacher.
     */
    $_SESSION = array();
    session_destroy();
    $pageAAfficher = "ihm/connexion/deconnexion.php";
}



