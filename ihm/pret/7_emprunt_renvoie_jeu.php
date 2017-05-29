<div class="blocList">
    <form action=" " method="post" accept-charset="utf-8">
        Vous confirmez à <b><?= $pret->getJeuP()->getProprietaire()->getPseudo() ?></b> 
        que vous lui avez bien renvoyé son jeu <b><?= $pret->getJeuP()->getJeuT()->getNom() ?></b> 
        le : <input type="text"  name="retourDateEnvoi" onclick="new calendar(this);">
        <br />
        <br />
        Intérêt du jeu : 
        <select name="note">
            <option value="">-----</option>
            <option value="1">1/5</option>
            <option value="2">2/5</option>
            <option value="3">3/5</option>
            <option value="4">4/5</option>
            <option value="5">5/5</option>
        </select>
        <br />
        <br />
        Précisions sur l'intérêt du jeu :
        <br />
        <br />
        <textarea name="commentaireT"></textarea>
        <br />
        <br />
        Message à destination du prêteur :
        <br />
        <br />
        <textarea name="message"></textarea>
        <br />
        <br />
        <input type=hidden name="pret" value=7 />
        <input type=hidden name="idPret" value="<?=$pret->getIdPret() ?>" />
        <input class="boutonGris" name="confirmer" type="submit" value="Confirmer le renvoi"/>


    </form>
</div>



