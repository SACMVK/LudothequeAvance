<legend>Mes prêts</legend>
<?php
if (!empty($_SESSION["mesPrets"])):
    ?>
    Vous avez <?= count($_SESSION["mesPrets"]) ?> prêts enregistrés.<br />
    <?php
    $compteurEnCoursValidation = 0;
    $pretsEnCoursValidation = [];
    $compteurEnCours = 0;
    $pretsEnCours = [];
    $compteurTermines = 0;
    $pretsTermines = [];
    foreach ($_SESSION["mesPrets"] as $pret) {
        if ($pret->getStatutDemande() == "En cours") {
            $compteurEnCoursValidation += 1;
            $pretsEnCoursValidation [] = $pret;
        } elseif ($pret->getStatutDemande() == "Annulée" || $pret->getIdNotification() == "10") {
            $compteurTermines += 1;
            $pretsTermines [] = $pret;
        } else {
            $compteurEnCours += 1;
            $pretsEnCours [] = $pret;
        }
    }
    ?>
    <button class="boutonBlanc" id="boutonEnCoursValidation" onClick="afficherOnglet(this.id)">Prêts en cours de validation (<?= $compteurEnCoursValidation ?>)</button>
    <button class="boutonBlanc" id="boutonEnCours" onClick="afficherOnglet(this.id)">Prêts en cours (<?= $compteurEnCours ?>)</button>
    <button class="boutonBlanc" id="boutonTermines" onClick="afficherOnglet(this.id)">Prêts terminés (<?= $compteurTermines ?>)</button>
    <div id="ongletEnCoursValidation">
        <legend>Prêts en cours de validation (<?= $compteurEnCoursValidation ?>)</legend>
        <?php
        foreach ($pretsEnCoursValidation as $pret) {
            include 'ihm/utilisateur/monPret.php';
        }
        ?>
    </div>
    <div id="ongletEnCours">
        <legend>Prêts en cours (<?= $compteurEnCours ?>)</legend>
        <?php
        foreach ($pretsEnCours as $pret) {
            include 'ihm/utilisateur/monPret.php';
        }
        ?>
    </div>
    <div id="ongletTermines">
        <legend>Prêts terminés (<?= $compteurTermines ?>)</legend>
        <?php
        foreach ($pretsTermines as $pret) {
            include 'ihm/utilisateur/monPret.php';
        }
        ?>
    </div>
    <?php
else:
    ?>
    Vous n'avez aucun prêt en cours.
<?php
endif;
?>
