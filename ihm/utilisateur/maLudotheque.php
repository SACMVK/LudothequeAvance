<legend>Ma ludothèque</legend>
<a href='index.php?page=creation/jeu_p.php'><button class="boutonBlanc">Ajouter un jeu à ma ludothèque</button></a>
<br/>
<?php
if (!empty($_SESSION["maLudotheque"])):
    foreach ($_SESSION["maLudotheque"] as $jeuP) :
        ?>
        <div class="blocList"> 
            Identifiant : <?= $jeuP->getIdJeuP() ?><br/>
            Nom : <?= $jeuP->getJeuT()->getNom() ?><br/>
            Editeur : <?= $jeuP->getJeuT()->getEditeur() ?><br/>                 
            <form action=" " method="post" accept-charset="utf-8">
                <input type=hidden name="objectToWorkWith" value="Jeu_P" />
                <input type=hidden name="actionToDoWithObject" value="delete" />
                <input type="hidden" name="idJeuP" value="<?= $jeuP->getIdJeuP() ?>" />
                <input type="image" name="submit" class="boutonTransparent" value="Supprimer ce jeu de ma ludothèque" src="ihm/img/delete.png">
            </form>
            <form action=" " method="post" accept-charset="utf-8" class="form" role="form">
                <input type=hidden name="nom" value="<?= $jeuP->getJeuT()->getNom() ?>" />
                <input type=hidden name="objectToWorkWith" value="jeu_t" />
                <input type=hidden name="actionToDoWithObject" value="selectOne" />
                <input type="image" name="submit" class="boutonTransparent" value="Voir la fiche complète" src="ihm/img/loupe.png">
            </form>

        </div> 
        <?php
    endforeach;
else:
    ?>
    <tr>
        Aucun résultat 
    </tr>
<?php
endif;
?>

<a href='index.php?page=creation/jeu_p.php'><button class="boutonBlanc">Ajouter un jeu à ma ludothèque</button></a>


