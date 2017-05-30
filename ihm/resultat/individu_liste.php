<a href="index.php?page=recherche/individu.php" class="boutonBlanc">Modifier ma recherche</a>
<?php
if (!empty($listOfElements)):
    foreach ($listOfElements as $compte) :
        ?>
        <div class="bordureBleue">
            Pseudo : <?= $compte->getPseudo() ?><br/>
            Nom : <?= $compte->getNom() ?><br/>
            Prénom : <?= $compte->getPrenom() ?><br/>
            Ville : <?= $compte->getVille() ?><br/>
            Département : <?= $compte->getDept() ?><br/>
            Code postal : <?= $compte->getCodePostal() ?><br/>
            <form action=" " method="post" accept-charset="utf-8" class="form" role="form">
                <input type=hidden name="compte#idUser" value="<?= $compte->getIdUser() ?>" />
                <input type=hidden name="objectToWorkWith" value="individu" />
                <input type=hidden name="actionToDoWithObject" value="selectOne" />
                <input type="image" name="submit" class="boutonTransparent" value="Voir la fiche complète" src="ihm/img/loupe.png">
            </form> 
        </div>
        <?php
    endforeach;
else:
    ?>
    Aucun résultat
<?php
endif;
?>
<a href="index.php?page=recherche/individu.php" class="boutonBlanc">Modifier ma recherche</a>




