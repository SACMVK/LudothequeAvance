<legend>Mes messages reçus</legend>
<?php
if (!empty($_SESSION["mesMessagesRecus"])):
    foreach ($_SESSION["mesMessagesRecus"] as $message) :
        ?>
        <div class="bordureBleue">               
            Expéditeur : <?= $message->getExp()->getPseudo() ?>
            <br />
            Sujet : <?= $message->getSujet() ?>
            <br />
            <form action=" " method="post" accept-charset="utf-8">
                <input type="hidden" name="objectToWorkWith" value="Message" />
                <input type="hidden" name="actionToDoWithObject" value="selectOne" />
                <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                <input type="image" name="submit" class="boutonTransparent" value="Lire le message" src="ihm/img/loupe.png">
            </form>
            <form action=" " method="post" accept-charset="utf-8">
                <input type="hidden" name="page" value="creation/message.php" />
                <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                <input type="image" name="submit" class="boutonTransparent" value="Répondre à ce message" src="ihm/img/repondre.png" >
            </form>
            <form action=" " method="post" accept-charset="utf-8">
                <input type="hidden" name="objectToWorkWith" value="Message" />
                <input type="hidden" name="actionToDoWithObject" value="delete" />
                <input type="hidden" name="page" value="ihm/utilisateur/mesMessagesRecus.php" />
                <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                <input type="image" name="submit" class="boutonTransparent" value="Supprimer ce message" src="ihm/img/delete.png" >
            </form>
        </div>
        <?php
    endforeach;
else:
    ?>
    Vous n'avez reçu aucun message.
<?php
endif;
?>


