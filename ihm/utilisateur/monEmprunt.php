<div class="blocList"> 
    Identifiant du prêt: <?= $emprunt->getIdPret() ?><br/>
    Jeu emprunté : <?= $emprunt->getJeuP()->getJeuT()->getNom() ?><br/>
    Emprunteur : <?= $emprunt->getEmprunteur()->getPseudo() ?><br/>    
    Propriétaire : <?= $emprunt->getJeuP()->getProprietaire()->getPseudo() ?><br/>
    Statut : <?= $emprunt->getStatutDemande() ?><br/>
    Sujet notification : <?= $emprunt->getNotification()["sujetEmprunteur"] ?><br/>
    id notification : <?= $emprunt->getidNotification() ?><br/>
    <?php
    $corpsEmprunteur = $emprunt->getNotification()["corpsEmprunteur"];
    $corpsEmprunteur = str_replace("#nomPreteur#", $emprunt->getJeuP()->getProprietaire()->getPseudo(), $corpsEmprunteur);
    $corpsEmprunteur = str_replace("#nomJeu#", $emprunt->getJeuP()->getJeuT()->getNom(), $corpsEmprunteur);
    $corpsEmprunteur = str_replace("#propositionEmprunteurDateDebut#", screenDate($emprunt->getPropositionEmprunteurDateDebut()), $corpsEmprunteur);
    $corpsEmprunteur = str_replace("#propositionEmprunteurDateFin#", screenDate($emprunt->getPropositionEmprunteurDateFin()), $corpsEmprunteur);
    if ($emprunt->getPropositionPreteurDateDebut() != null) {
        $corpsEmprunteur = str_replace("#propositionPreteurDateDebut#", screenDate($emprunt->getPropositionPreteurDateDebut()), $corpsEmprunteur);
    }
    if ($emprunt->getPropositionPreteurDateFin() != null) {
        $corpsEmprunteur = str_replace("#propositionPreteurDateFin#", screenDate($emprunt->getPropositionPreteurDateFin()), $corpsEmprunteur);
    }
    if ($emprunt->getExpedition() != null) {
        if ($emprunt->getExpedition()->getEnvoiDateEnvoi() != null) {
            $corpsEmprunteur = str_replace("#envoiDateEnvoi#", screenDate($emprunt->getExpedition()->getEnvoiDateEnvoi()), $corpsEmprunteur);
        }
        if ($emprunt->getExpedition()->getEnvoiDateReception() != null) {
            $corpsEmprunteur = str_replace("#envoiDateReception#", screenDate($emprunt->getExpedition()->getEnvoiDateReception()), $corpsEmprunteur);
        }
        if ($emprunt->getExpedition()->getRetourDateEnvoi() != null) {
            $corpsEmprunteur = str_replace("#retourDateEnvoi#", screenDate($emprunt->getExpedition()->getRetourDateEnvoi()), $corpsEmprunteur);
        }
        if ($emprunt->getExpedition()->getRetourDateReception() != null) {
            $corpsEmprunteur = str_replace("#retourDateReception#", screenDate($emprunt->getExpedition()->getRetourDateReception()), $corpsEmprunteur);
        }
    }
    ?>
    Corps notification : <?= $corpsEmprunteur ?><br/>
    <?php
    $nomBouton = "";
    $renvoiFormulaire = "";
    $ajouterBouton = true;
    switch ($emprunt->getIdNotification()) {
        case "4":
            $nomBouton = "Répondre à une proposition de nouvelles dates";
            $renvoiFormulaire = "pret/4_reponse_nouvelles_dates.php";
            break;
        case "7":
            $nomBouton = "Confirmer la réception du jeu";
            $renvoiFormulaire = "pret/6_emprunteur_recoit_jeu.php";
            break;
        case "8":
            $nomBouton = "Confirmer le renvoi du jeu";
            $renvoiFormulaire = "pret/7_emprunt_renvoie_jeu.php";
            break;
        default:
            $ajouterBouton = false;
            break;
    }
    ?>
    <?php
    if ($ajouterBouton):
        ?>
        <form action=" " method="post" accept-charset="utf-8" class="form" role="form">
            <input type=hidden name="idPret" value="<?= $emprunt->getIdPret() ?>" />
            <input type=hidden name="formulaire" value="<?= $renvoiFormulaire ?>" />
            <input type="submit" name="submit" class="boutonGris" value="<?= $nomBouton ?>">
        </form>
    <?php endif; ?>
</div>

