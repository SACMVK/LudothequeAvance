<div class="blocList">
    <form action=" " method="post" accept-charset="utf-8">
        <b><?= $pret->getJeuP()->getProprietaire()->getPseudo() ?></b> vous propose d'autres dates 
        pour le prêt de son jeu <b><?= $pret->getJeuP()->getJeuT()->getNom() ?></b> : 
        du <?= screenDate($pret->getPropositionPreteurDateDebut()) ?> au <?= screenDate($pret->getPropositionPreteurDateFin()) ?>. 
        Les dates initiales étaient du <?= screenDate($pret->getPropositionEmprunteurDateDebut()) ?> 
        au <?= screenDate($pret->getPropositionEmprunteurDateFin()) ?>.
        <br />
        <br />
        Messsage à destination du prêteur :
        <br />
        <br />
        <textarea name="message"></textarea>
        <br />
        <br />
        <input type=hidden name="pret" value=4 />
        <input type=hidden name="idPret" value="<?=$pret->getIdPret() ?>" />
        <input class="boutonGris" name="accepter" type="submit" value="Accepter" />
        <input class="boutonGris" name="refuser" type="submit" value="Refuser">
    </form>
</div>