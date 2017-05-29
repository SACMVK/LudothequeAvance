<legend>Mes emprunts</legend>

<?php
if (!empty($_SESSION["mesEmprunts"])) :
    ?>    
    Vous avez <?= count($_SESSION["mesEmprunts"]) ?> emprunts enregistrés.<br />
    <?php
    $compteurEnCoursValidation = 0;
    $empruntsEnCoursValidation = [];
    $compteurEnCours = 0;
    $empruntsEnCours = [];
    $compteurTermines = 0;
    $empruntsTermines = [];
    foreach ($_SESSION["mesEmprunts"] as $emprunt) {
        if ($emprunt->getStatutDemande() == "En cours") {
            $compteurEnCoursValidation += 1;
            $empruntsEnCoursValidation [] = $emprunt;
        } elseif ($emprunt->getStatutDemande() == "Annulée" || $emprunt->getIdNotification() == "10") {
            $compteurTermines += 1;
            $empruntsTermines [] = $emprunt;
        } else {
            $compteurEnCours += 1;
            $empruntsEnCours [] = $emprunt;
        }
    }
    ?>
    <button class="boutonBlanc" id="boutonEnCoursValidation" onClick="afficherOnglet(this.id)">Emprunts en cours de validation (<?= $compteurEnCoursValidation ?>)</button>
    <button class="boutonBlanc" id="boutonEnCours" onClick="afficherOnglet(this.id)">Emprunts en cours (<?= $compteurEnCours ?>)</button>
    <button class="boutonBlanc" id="boutonTermines" onClick="afficherOnglet(this.id)">Emprunts terminés (<?= $compteurTermines ?>)</button>
    <div id="ongletEnCoursValidation">
        <legend>Emprunts en cours de validation (<?= $compteurEnCoursValidation ?>)</legend>
        <?php
        foreach ($empruntsEnCoursValidation as $emprunt) {
            include 'ihm/utilisateur/monEmprunt.php';
        }
        ?>
    </div>
    <div id="ongletEnCours">
        <legend>Emprunts en cours (<?= $compteurEnCours ?>)</legend>
        <?php
        foreach ($empruntsEnCours as $emprunt) {
            include 'ihm/utilisateur/monEmprunt.php';
        }
        ?>
    </div>
    <div id="ongletTermines">
        <legend>Emprunts terminés (<?= $compteurTermines ?>)</legend>
        <?php
        foreach ($empruntsTermines as $emprunt) {
            include 'ihm/utilisateur/monEmprunt.php';
        }
        ?>
    </div>
<?php else: ?>
    Vous n'avez aucun emprunt en cours.
<?php
endif;
?>
