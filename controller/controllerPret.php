<?php

function getValuesFromREQUEST() {
    $listOfValues = array();
    foreach ($_REQUEST as $key => $value) {
        $listOfValues [$key] = $value;
    }
    return $listOfValues;
}

//if (!empty($_REQUEST['formulairePret'])) {
switch ($_REQUEST['pret']) {
    case -1:
        include "job/dao/Jeu_P_Dao.php";
        $jeuP = select("where idJeuP = '" . $_REQUEST["idJeuP"] . "'")[0];
        $pageAAfficher = "ihm/pret/1_demande_emprunt.php";
        break;
    case 1:
        include "job/dao/Pret_Dao.php";
        $listeData = getValuesFromREQUEST();
        $listeData["notification"] = "1";
        $listeData["statutDemande"] = "En cours";
        $lastEmpruntInserted = insertPret($listeData);
        $_SESSION["mesEmprunts"] = selectPrets("WHERE pret_p.idEmprunteur = " . $_SESSION["monProfil"]->getIdUser());
        $emprunt = Pret::getEmpruntFromId($lastEmpruntInserted);
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idExped" => $emprunt->getEmprunteur()->getIdUser(),
                "idDest" => $emprunt->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$emprunt->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$lastEmpruntInserted, "idMessage"=>$lastMessageInserted, "idNotification"=>$emprunt->getIdNotification()]);
        }
        $pageAAfficher = "ihm/utilisateur/mesEmprunts.php";
        break;
    case 2:
        include "job/dao/Pret_Dao.php";
        $pret = Pret::getPretFromId($_REQUEST["idPret"]);
        if (!empty($_REQUEST["accepter"])) {
            $listeData = getValuesFromREQUEST();
            $listeData["notification"] = "2";
            $listeData["statutDemande"] = "Validée";
            updatePret($listeData);
            $_SESSION["mesPrets"] = selectPrets("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
            $pageAAfficher = "ihm/utilisateur/mesPrets.php";
        } elseif (!empty($_REQUEST["nouvellesDates"])) {
            $pageAAfficher = "ihm/pret/3_proposition_nouvelles_dates.php";
        } elseif (!empty($_REQUEST["refuser"])) {
            $listeData = getValuesFromREQUEST();
            $listeData["notification"] = "3";
            $listeData["statutDemande"] = "Annulée";
            updatePret($listeData);
            $_SESSION["mesPrets"] = selectPrets("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
            $pageAAfficher = "ihm/utilisateur/mesPrets.php";
        }
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idDest" => $pret->getEmprunteur()->getIdUser(),
                "idExped" => $pret->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$pret->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$pret->getIdPret(), "idMessage"=>$lastMessageInserted, "idNotification"=>$pret->getIdNotification()]);
        }
        break;
    case 3:
        include "job/dao/Pret_Dao.php";
        $pret = Pret::getPretFromId($_REQUEST["idPret"]);
        $listeData = getValuesFromREQUEST();
        $listeData["notification"] = "4";
        $listeData["statutDemande"] = "En cours";
        updatePret($listeData);
        $_SESSION["mesPrets"] = selectPrets("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idDest" => $pret->getEmprunteur()->getIdUser(),
                "idExped" => $pret->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$pret->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$pret->getIdPret(), "idMessage"=>$lastMessageInserted, "idNotification"=>$pret->getIdNotification()]);
        }
        $pageAAfficher = "ihm/utilisateur/mesPrets.php";
        break;
    case 4:
        include "job/dao/Pret_Dao.php";
        $emprunt = Pret::getEmpruntFromId($_REQUEST["idPret"]);
        if (!empty($_REQUEST["accepter"])) {
            $listeData = getValuesFromREQUEST();
            $listeData["notification"] = "6";
            $listeData["statutDemande"] = "Validée";
            updatePret($listeData);
            $_SESSION["mesEmprunts"] = selectPrets("WHERE pret_p.idEmprunteur = " . $_SESSION["monProfil"]->getIdUser());
        } elseif (!empty($_REQUEST["refuser"])) {
            $listeData = getValuesFromREQUEST();
            $listeData["notification"] = "5";
            $listeData["statutDemande"] = "Annulée";
            updatePret($listeData);
            $_SESSION["mesEmprunts"] = selectPrets("WHERE pret_p.idEmprunteur = " . $_SESSION["monProfil"]->getIdUser());
        }
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idExped" => $emprunt->getEmprunteur()->getIdUser(),
                "idDest" => $emprunt->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$emprunt->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$emprunt->getIdPret(), "idMessage"=>$lastMessageInserted, "idNotification"=>$emprunt->getIdNotification()]);
        }
        $pageAAfficher = "ihm/utilisateur/mesEmprunts.php";
        break;
    case 5:
        include "job/dao/Pret_Dao.php";
        $pret = Pret::getPretFromId($_REQUEST["idPret"]);
        $listeData = getValuesFromREQUEST();
        $listeData["notification"] = "7";
        updatePret($listeData);
        insertExpedition($listeData);
        $_SESSION["mesPrets"] = selectPrets("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idDest" => $pret->getEmprunteur()->getIdUser(),
                "idExped" => $pret->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$pret->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$pret->getIdPret(), "idMessage"=>$lastMessageInserted, "idNotification"=>$pret->getIdNotification()]);
        }
        $pageAAfficher = "ihm/utilisateur/mesPrets.php";
        break;
    case 6:
        include "job/dao/Pret_Dao.php";
        $emprunt = Pret::getEmpruntFromId($_REQUEST["idPret"]);
        $listeData = getValuesFromREQUEST();
        $listeData["notification"] = "8";
        updatePret($listeData);
        updateExpedition($listeData);
        $_SESSION["mesEmprunts"] = selectPrets("WHERE pret_p.idEmprunteur = " . $_SESSION["monProfil"]->getIdUser());
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idExped" => $emprunt->getEmprunteur()->getIdUser(),
                "idDest" => $emprunt->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$emprunt->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$emprunt->getIdPret(), "idMessage"=>$lastMessageInserted, "idNotification"=>$emprunt->getIdNotification()]);
        }
        $pageAAfficher = "ihm/utilisateur/mesEmprunts.php";
        break;
    case 7:
        include "job/dao/Pret_Dao.php";
        $emprunt = Pret::getEmpruntFromId($_REQUEST["idPret"]);
        $listeData = getValuesFromREQUEST();
        $listeData["notification"] = "9";
        $listeData["idPC"] = $emprunt->getJeuP()->getJeuT()->getIdPC();
        $listeData["idUser"] = $emprunt->getEmprunteur()->getIdUser();
        updatePret($listeData);
        updateExpedition($listeData);
        insertNote($listeData);
        insertCommentaire($listeData);
        $_SESSION["mesEmprunts"] = selectPrets("WHERE pret_p.idEmprunteur = " . $_SESSION["monProfil"]->getIdUser());
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idExped" => $emprunt->getEmprunteur()->getIdUser(),
                "idDest" => $emprunt->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$emprunt->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$emprunt->getIdPret(), "idMessage"=>$lastMessageInserted, "idNotification"=>$emprunt->getIdNotification()]);
        }
        $pageAAfficher = "ihm/utilisateur/mesEmprunts.php";
        break;
    case 8:
        include "job/dao/Pret_Dao.php";
        $pret = Pret::getPretFromId($_REQUEST["idPret"]);
        $listeData = getValuesFromREQUEST();
        $listeData["notification"] = "10";
        updatePret($listeData);
        updateExpedition($listeData);
        $_SESSION["mesPrets"] = selectPrets("WHERE jeu_p.idProprietaire = " . $_SESSION["monProfil"]->getIdUser());
        if (!empty($_REQUEST["message"])) {
            include "job/dao/Message_Dao.php";
            $aujourdhui = getdate()["year"] . "-" . getdate()["mon"] . "-" . getdate()["mday"];
            $dataMessage = [
                "idDest" => $pret->getEmprunteur()->getIdUser(),
                "idExped" => $pret->getJeuP()->getProprietaire()->getIdUser(),
                "dateEnvoi" => $aujourdhui,
                "sujet" => "Message en rapport avec le prêt n° ".$pret->getIdPret(),
                "texte" => $_REQUEST["message"]];
            $lastMessageInserted = insert($dataMessage);
            insertMessagePret(["idPret"=>$pret->getIdPret(), "idMessage"=>$lastMessageInserted, "idNotification"=>$pret->getIdNotification()]);
        }
        $pageAAfficher = "ihm/utilisateur/mesPrets.php";
        break;
}
//}

