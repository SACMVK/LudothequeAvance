
<a href="index.php?page=recherche/jeu_p.php" class="boutonBlanc">Modifier ma recherche</a>
    <?php
    if (!empty($listOfElements)):
        foreach ($listOfElements as $jeu_p) :
            ?>        
             <div class="blocList">
                 Nom du jeu : <?= $jeu_p->getJeuT()->getNom() ?><br/>
                 Propriétaire : <?= $jeu_p->getProprietaire()->getPseudo() ?><br/>
                 Code postal : <?= $jeu_p->getProprietaire()->getCodePostal() ?><br/>
                    <form action=" " method="post" accept-charset="utf-8" class="form" role="form">
                        <input type=hidden name="idJeuP" value="<?= $jeu_p->getIdJeuP() ?>" />
                        <input type=hidden name="objectToWorkWith" value="jeu_p" />
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


<a href="index.php?page=recherche/jeu_p.php" class="boutonBlanc">Modifier ma recherche</a>

