<div class="blocList">
    <form action=" " method="post" accept-charset="utf-8">
        Vous confirmez à <b><?= $pret->getEmprunteur()->getPseudo() ?></b> 
        que vous lui avez bien envoyé votre jeu <b><?= $pret->getJeuP()->getJeuT()->getNom() ?></b> 
        le : <input type="text"  name="envoiDateEnvoi" onclick="new calendar(this);">
        <br />
        <br />
        Message à destination de l'emprunteur :
        <br />
        <br />
        <textarea name="message"></textarea>
        <br />
        <br />
        <input type=hidden name="pret" value=5 />
        <input type=hidden name="idPret" value="<?=$pret->getIdPret() ?>" />
        <input class="boutonGris" name="confirmer" type="submit" value="Confirmer l'envoi" />

    </form>
</div>