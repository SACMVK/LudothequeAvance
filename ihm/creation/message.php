<p style="color:red;">@team : TOFINISH - ajouter un test de vérification de l'existence du destinataire</p>
<form action=" " method="post" accept-charset="utf-8" class="form" role="form"> 
    <legend>Envoyer un message</legend>
    Pseudo du destinataire :
    <input type="text" name="idUser" class="form-control input-lg" required />


    Sujet du message :
    <input type="text" name="sujet" class="form-control input-lg" placeholder="sujet" required />
    Message :
    <textarea type="textarea" name="texte" class="form-control input-lg" placeholder="texte" maxlength="140" rows="7" /></textarea>

    <input type=hidden name="idExped" value="<?= $_SESSION["monProfil"]->getIdUser(); ?>" />

    <input type=hidden name="objectToWorkWith" value="Message" />
    <input type=hidden name="actionToDoWithObject" value="insert" />

    <button type="submit" id="submit" name="submit" class="boutonBleu">Envoyer</button>
</form>


