<div class="blocList">
    <form action=" " method="post" accept-charset="utf-8">
        Vous confirmez à <b><?= $pret->getEmprunteur()->getPseudo() ?></b> 
        que vous avez bien reçu votre jeu <b><?= $pret->getJeuP()->getJeuT()->getNom() ?></b> 
        le : <input type="text"  name="retourDateReception" onclick="new calendar(this);">
        <br />
        <br />               
        État du jeu reçu : 
        <select name="retourEtatJeu">
            <?php selectDico("etat_d", "etat") ?>
        </select>
        <br />
        <br />   
        Pièce(s) manquante(s) :
        <select name="retourPiecesManquantes" >
            <option value="non">Non</option>
            <option value="oui">Oui</option>
        </select>
        <br />
        <br />
        Message à destination de l'emprunteur :
        <br />
        <br />
        <textarea name="message"></textarea>
        <br />
        <br />
        <input type=hidden name="pret" value=8 />
        <input type=hidden name="idPret" value="<?= $pret->getIdPret() ?>" />
        <input class="boutonGris" name="confirmer" type="submit" value="Confirmer la réception"/>

    </form>
</div>