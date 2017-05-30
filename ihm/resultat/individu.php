<div class="bordureBleue">
    Pseudo : 
    <?= $element->getPseudo() ?><br />
    (inscrit depuis le 
    '<?= screenDate($element->getDateInscription()) ?>)<br />
    Nom :
    <?= $element->getNom() ?><br />
    Prénom :
    <?= $element->getPrenom() ?><br />
    Email :
    <a href="mailto:<?= $element->getEmail() ?>"><?= $element->getEmail() ?></a><br />
    Adresse :
    <?= $element->getAdresse() ?>, <?= $element->getCodePostal() ?> <?= $element->getVille() ?> (<?= $element->getDept() ?>)<br />
    Tel :
    <?= $element->getTelephone() ?><br />
    <form action=" " method="post" accept-charset="utf-8">
        <input type="hidden" name="page" value="creation/message.php" />
        <input type="hidden" name="idDest" value="<?= $element->getIdUser() ?>" />
        <input type="image" name="submit" class="boutonTransparent" value="Ecrire un message" src="ihm/img/ecrire.png" >
    </form>
    <?php
    if ($_SESSION["monProfil"]->getDroit() == "Administrateur") :
        ?>
        <div class="bordureGrise">
            Zone réservée aux administrateurs
            <br />
            <form action=" " method="post" accept-charset="utf-8">
                <select type="text" name="droit">
                    <?php selectDico("droit_d", "droit") ?>
                </select>
                <input type="hidden" name="objectToWorkWith" value="Compte" />
                <input type="hidden" name="actionToDoWithObject" value="update" />
                <input type="hidden" name="page" value="ihm/recherche/individu.php" />
                <input type="hidden" name="idUser" value="<?= $element->getIdUser() ?>" />
                <input type="submit" name="submit" class="boutonBlanc" value="Modifier les droits" />
            </form>
            <form action=" " method="post" accept-charset="utf-8">
                <input type="hidden" name="objectToWorkWith" value="Compte" />
                <input type="hidden" name="actionToDoWithObject" value="delete" />
                <input type="hidden" name="page" value="ihm/recherche/individu.php" />
                <input type="hidden" name="idUser" value="<?= $element->getIdUser() ?>" />
                <input type="image" name="submit" class="boutonTransparent" value="Bannir ce compte" src="ihm/img/delete.png" >
            </form>
        </div>
        <?php
    endif;
    ?>
</div>
