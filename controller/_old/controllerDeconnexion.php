<?php

if ($_GET['connexion'] == "off") {
        /* stefan : la demande de déconnexion arrive en get
     * parce qu'elle arrive par un lien et non par un formulaire
     * et que ce n'est pas une information à cacher.
     */
    $_SESSION = array();
    session_destroy();
    $pageAAfficher = "ihm/connexion/deconnexion.php";
}

