<?php if (!empty($_SESSION)): ?>
    <form action=" " method="post" accept-charset="utf-8" class="form" role="form">
        <!--stefan : on ne peut mettre une valeur à zéro, hypothèse PHP confond avec false -->
        <input type=hidden name="pret" value=-1 >
        <input type=hidden name="idJeuP" value="<?= $element->getIdJeuP() ?>" >
        <input type="submit" name="submit" class="boutonBlanc" value="Demander à emprunter ce jeu">
    </form>
<?php else: ?>
    Pour emprunter le jeu, 
    <a class="boutonBlanc" href='index.php?page=creation/individu.php'>inscrivez-vous</a> ou 
    <a class="boutonBlanc" href='index.php?page=connexion/connexion.php'>connectez-vous</a>
<?php endif; ?>
    
<div class="blocList">
    <h1><?= $element->getJeuT()->getNom() ?> appartenant à <?= $element->getProprietaire()->getPseudo() ?>
        (<?= $element->getProprietaire()->getCodePostal() ?>)</h1>  
    <?php
    /*
     * M : Affichage d'un carroussel d'images
     */
    ?>
    <div class="slideshowJeuT">
        <ul>
            <?php
            $carrouselDirectory = "data/images/vignettes/";
            $listeDesImages = $element->getJeuT()->getListeImages();
            foreach ($listeDesImages as $image) :
                ?>
                <li><img src="<?= $carrouselDirectory . $image ?>"></li>
            <?php endforeach; ?>
        </ul>
    </div>


    </br>
    </br>
    <h2>Editeur : </h2>
    <p><?= $element->getJeuT()->getEditeur() ?></p>
    </br>  
    <h2>Année de sortie : </h2>
    <p><?= $element->getJeuT()->getAnneeSortie() ?></p>
    </br>  
    <h2>Nombre de joueurs : </h2>
    <p>De <?= $element->getJeuT()->getNbJoueursMin() ?> à <?= $element->getJeuT()->getNbJoueursMax() ?> joueurs</p>
    </br>
    <h2>Règles du jeu : </h2>
    <p><?= $element->getJeuT()->getRegles() ?></p>
    </br>
    <h2>Difficulté : </h2>
    <p><?= $element->getJeuT()->getDifficulte() ?></p>
    </br>
    <h2>Public concerné : </h2>
    <p><?= $element->getJeuT()->getpublic() ?></p>
    </br> 
    <h2>Liste de pièces : </h2>
    <p><?= $element->getJeuT()->getListePieces() ?></p>
    </br> 
    <h2>Durée de la partie : </h2>
    <p><?= $element->getJeuT()->getDureePartie() ?></p>
    </br>
    <h2>Genres : </h2>
    <?php foreach ($element->getJeuT()->getListeGenres() as $value): ?>
        <p><?= $value ?></p>
    <?php endforeach; ?>
    </br> 
    <h2>Note Moyenne (Notation sur 5): </h2>
    <?php
    $listeDesNotes = $element->getJeuT()->getListeNotes();
    if (!empty($listeDesNotes)):
        ?>
        <p><?= round(array_sum($listeDesNotes) / sizeof($listeDesNotes), 1) ?>/5 (<?= sizeof($listeDesNotes) ?> votes)</p>
    <?php else: ?>  
        <p>Personne n'a encore évalué ce jeu</p>
    <?php endif ?>    
    </br>  
    </br>
    <h2>Commentaires de joueurs : </h2>
    <?php
    $listeCommentaires = $element->getJeuT()->getListeCommentaires();
    if (!empty($listeCommentaires)):
        foreach ($listeCommentaires as $commentaireT) :
            foreach ($commentaireT as $pseudo => $valueComment):
                ?>
                <em>"<?= $valueComment ?>"</em><strong><?= $pseudo ?></strong><br/><br/>       
                <?php
            endforeach;
        endforeach;
    else:
        ?>
        <p>Personne n'a encore commenté ce jeu</p>
    <?php endif; ?>
</div> 

