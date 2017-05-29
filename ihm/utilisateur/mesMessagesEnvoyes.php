<legend>Mes messages envoyés</legend>
<?php
if (!empty($_SESSION["mesMessagesEnvoyes"])):
    foreach ($_SESSION["mesMessagesEnvoyes"] as $message) :
        ?>
        <div class="bordureBleue">
            Destinataire : <?= $message->getDest()->getPseudo() ?>
            <br />
            Sujet : <?= $message->getSujet() ?>
            <br />
            <form action=" " method="post" accept-charset="utf-8">
                <input type=hidden name="objectToWorkWith" value="Message" />
                <input type=hidden name="actionToDoWithObject" value="selectOne" />
                <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                <input type="image" name="submit" class="boutonTransparent" value="Lire le message" src="ihm/img/loupe.png">
            </form>
            <form action=" " method="post" accept-charset="utf-8">
                <input type=hidden name="objectToWorkWith" value="Message" />
                <input type=hidden name="actionToDoWithObject" value="delete" />
                <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                <input type="image" name="submit" class="boutonTransparent" value="Supprimer ce message" src="ihm/img/delete.png" >
            </form>
        </div>
        <?php
    endforeach;
else:
    ?>
    Vous n'avez envoyé aucun message.
<?php
endif;
?>

