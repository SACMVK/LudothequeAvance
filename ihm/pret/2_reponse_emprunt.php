<div class="blocList">
    <form action=" " method="post" accept-charset="utf-8">
        <b><?= $pret->getEmprunteur()->getPseudo() ?></b> 
        souhaite vous emprunter votre jeu <b><?= $pret->getJeuP()->getJeuT()->getNom() ?></b>
        du <?= screenDate($pret->getPropositionEmprunteurDateDebut()) ?> au <?= screenDate($pret->getPropositionEmprunteurDateFin()) ?>
        <br />
        <br />
        Message à destination de l'emprunteur :
        <br />
        <br />
        <textarea name="message"></textarea>
        <br />
        <br />
        <input type=hidden name="pret" value=2 />
        <input type=hidden name="idPret" value="<?=$pret->getIdPret() ?>" />
        <input class="boutonGris" name="accepter" type="submit" value="Accepter"/>
        <input class="boutonGris" name="nouvellesDates" type="submit" value="Proposer d'autres dates" />
        <input class="boutonGris" name="refuser" type="submit" value="Refuser" />
    </form>
</div>