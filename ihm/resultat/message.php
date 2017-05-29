<div class="bordureBleue">
    Message n° <?= $element->getIdMessage() ?><br />
    <b>Expéditeur :</b> <?= $element->getExp()->getPseudo() ?><br />
    <b>Destinataire :</b> <?= $element->getDest()->getPseudo() ?><br />
    <div class="bordureGrise">
        Sujet : <?= $element->getSujet() ?><br />
    </div>
    <div class="bordureGrise">
        <?= $element->getTexte() ?> 
    </div>
</div>