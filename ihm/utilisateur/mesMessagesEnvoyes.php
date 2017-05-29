
<legend>Mes messages</legend>
<div class="container">
  <?php
    if (!empty($_SESSION["mesMessagesEnvoyes"])):
        foreach ($_SESSION["mesMessagesEnvoyes"] as $message) :
       
            ?>
    <div class="row">
            <tr>                 
                <td><?= $message->getExp()->getNom()  ?></td>
                <td><?= $message->getExp()->getPrenom()  ?></td>          
                <td><?= $message->getSujet()?> </td>
                             
                <td id="table-recherche">
                    <form action=" " method="post" accept-charset="utf-8" style="display: inline;">
                        <input type=hidden name="objectToWorkWith" value="Message" />
                        <input type=hidden name="actionToDoWithObject" value="read" />
                        <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                        <input type="image" name="submit" class="boutonTransparent" value="Lire le message" src="ihm/img/loupe.png">
                                               
                    </form>
                    <form action=" " method="post" accept-charset="utf-8" style="display: inline;">
                        <input type=hidden name="objectToWorkWith" value="Message" />
                        <input type=hidden name="actionToDoWithObject" value="answer" />
                        <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                        <input type="image" name="submit" class="boutonTransparent" value="Répondre à ce message" src="ihm/img/repondre.png" >
                    </form>
                    <form action=" " method="post" accept-charset="utf-8" style="display: inline;">
                        <input type=hidden name="objectToWorkWith" value="Message" />
                        <input type=hidden name="actionToDoWithObject" value="delete" />
                        <input type="hidden" name="idMessage" value="<?= $message->getIdmessage() ?>" />
                        <input type="image" name="submit" class="boutonTransparent" value="Supprimer ce message" src="ihm/img/delete.png" >
                    </form>
                 
                </td>
            </tr> 
    </div><br>
            <?php
        endforeach;
    else:
        ?>
        <tr>
            <td>Aucun résultat</td>
        </tr>
    <?php
    endif;
    ?>
</div>

