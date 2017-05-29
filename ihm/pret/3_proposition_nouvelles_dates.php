<div class="blocList">
    <form action=" " method="post" accept-charset="utf-8">
        Vous souhaitez proposer de nouvelles dates d'emprunt de votre jeu 
        <b><?= $pret->getJeuP()->getJeuT()->getNom() ?></b>
        à <b><?= $pret->getEmprunteur()->getPseudo() ?></b>.
        <br />
        Les dates initiales étaient du <?= screenDate($pret->getPropositionEmprunteurDateDebut()) ?> 
        au <?= screenDate($pret->getPropositionEmprunteurDateFin()) ?>.
        <br />
        <br />
        Du <input type="text"  name="propositionPreteurDateDebut" onclick="new calendar(this);">
        au <input type="text"  name="propositionPreteurDateFin" onclick="new calendar(this);">
        <br />
        <br />
        Message à destination de l'emprunteur :
        <br />
        <br />
        <textarea name="message"></textarea>
        <br />
        <br />
        <input type=hidden name="pret" value=3 />
        <input type=hidden name="idPret" value="<?=$pret->getIdPret() ?>" />
        <input class="boutonGris" name="envoyer" type="submit" value="Envoyer les nouvelles dates" />
    </form>
</div>