<?php

// M : Fonction qui permet de n'afficher que les $length premiers caractères
function str_truncate($text, $length) {
    if (strlen($text) <= $length)
        return $text;
    return trim(substr($text, 0, $length));
}

// M : Affihage de la liste des jeu_t
?>

    <?php
    if (!empty($listOfElements)):
        foreach ($listOfElements as $jeu_t) :
            ?> 
<div class="blocList">

                <h1><?= $jeu_t->getNom() ?></h1>
                <p><strong>Nombre de joueurs :</strong> De <?= $jeu_t->getNbJoueursMin() ?> à <?= $jeu_t->getNbJoueursMax() ?></p>
                <p><strong>Editeur :</strong> <?= $jeu_t->getEditeur() ?></p>
                <p><strong>Règles :</strong> <?= str_truncate($jeu_t->getRegles(), 100) ?> ...</p>
   
                <br/>
                <p><strong>Difficulté :</strong> <?= $jeu_t->getDifficulte() ?></p>
                <p><strong>Public :</strong> <?= $jeu_t->getpublic() ?></p>
                <p><strong>Liste des pièces : </strong><?= $jeu_t->getListePieces() ?></p>
        
                <br/>
                <p><strong>Durée de la partie :</strong> <?= $jeu_t->getDureePartie() ?></p>
                <p><strong>Année de sortie :</strong> <?= $jeu_t->getAnneeSortie() ?></p>
                <p><strong>Description :</strong> <?= str_truncate($jeu_t->getDescription(), 100) ?> ...</p>
        
                <form action=" " method="post" accept-charset="utf-8" class="form" role="form">
                    <input type=hidden name="nom" value="<?= $jeu_t->getNom() ?>" />  <!--<input type=hidden name="idPC" value="<?= $jeu_t->getIdPC() ?>" />A reprendre car ne transmet pas la bonne ligne selectionnée par le bouton -->
                    <input type=hidden name="objectToWorkWith" value="jeu_t" />
                    <input type=hidden name="actionToDoWithObject" value="selectOne" />
                    <input type="image" name="submit" title="Fiche complète" class="boutonTransparent" value="Voir la fiche complète" src="ihm/img/loupe.png">
                </form>
      </div>

            <?php
        endforeach;
        
    else:
        ?>
        <div>
            <h1>Aucun résultat</h1>
        </div>
    <?php
    endif;
    ?>


