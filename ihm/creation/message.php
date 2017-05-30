<?php if (!empty($_REQUEST["idMessage"])) : ?>
    <legend>Répondre à un message</legend>
<?php elseif (!empty($_REQUEST["idDest"])): ?>
    <legend>Répondre à un message</legend>
<?php endif; ?>

<?php
if (!empty($_REQUEST["idMessage"])) {
    include 'job/dao/Message_Dao.php';
    $ancienMessage = select("where idMessage = " . $_REQUEST["idMessage"])[0];
    $pseudoDest = $ancienMessage->getExp()->getPseudo();
} elseif ($_REQUEST["idDest"]) {
    $pseudoDest = $_REQUEST["idDest"];
} else {
    $pseudoDest = "";
}
?>

<div class="bordureBleue"> 
    <form action=" " method="post" accept-charset="utf-8" class="form" role="form">
        Destinataire : <input type="text"  placeholder="pseudo du destinataire" name="pseudoDest" value="<?= $pseudoDest ?>" required />
        <br />
        <br />
        <div class="bordureGrise">
            <br />
            Sujet du message :
            <br />
            <br />
            <input type="text" name="sujet" required style="width: 100%;"/>
            <br />
            <br />
        </div>
        <br />
        <br />
        <div class="bordureGrise">
            <br />
            Message :
            <br />
            <br />
            <textarea type="textarea" name="texte" maxlength="500" rows="7" /></textarea>
            <br />
            <br />
        </div>
        <br />
        <input type=hidden name="idExped" value="<?= $_SESSION["monProfil"]->getIdUser(); ?>" />
        <input type=hidden name="objectToWorkWith" value="Message" />
        <input type=hidden name="actionToDoWithObject" value="insert" />
        <input type="submit" name="submit" class="boutonBlanc" value="Envoyer le message" />
    </form>
</div>

