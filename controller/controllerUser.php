<?php

// stefan : un cas n'est pas visible : celui de l'affichage du profil qui va directement afficher ce qui est dans la RAM
switch ($_REQUEST['user']) {
    case "maLudotheque":
        include 'job/dao/Jeu_P_Dao.php';
        $_SESSION["maLudotheque"] = select("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
        break;
    case "mesPrets";
        include 'job/dao/Pret_Dao.php';
        $_SESSION["mesPrets"] = selectPrets("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
        break;
    case "mesEmprunts";
        include 'job/dao/Pret_Dao.php';
        $_SESSION["mesEmprunts"] = selectPrets("WHERE pret_p.idEmprunteur = " . $_SESSION["monProfil"]->getIdUser());
        break;
    case "mesMessagesEnvoyes";
        include 'job/dao/Message_Dao.php';
        $_SESSION["mesMessagesEnvoyes"] = select("WHERE idExped = " . $_SESSION["monProfil"]->getIdUser());
        break;
    case "mesMessagesRecus";
        include 'job/dao/Message_Dao.php';
        $_SESSION["mesMessagesRecus"] = select("WHERE idDest = " . $_SESSION["monProfil"]->getIdUser());
        break;
}

$pageAAfficher = 'ihm/utilisateur/' . $_GET['user'] . '.php';

