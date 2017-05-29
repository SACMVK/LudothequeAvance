<p style="color:red;">@team : Attention, le mail et le pseudo doivent être uniques dans la BD, il faut modifier les valeurs par défaut</p>
<form action=" " method="post" accept-charset="utf-8" class="form" role="form">   
    <legend>Mettre à jour mon compte</legend>
    <!-- size : taille cellule | maxlength : nombre maximum de caractères autorisé -->
    <!-- Ajouter expressions régulières mail, code postal, téléphone + check conformitée mot de passe -->
    <!-- stefan : un input disabled n'envoie pas l'info, il faut ajouter un hidden qui lui est actif -->
    Nom :
    <input type="text" name="nom" size="10" maxlength="10" required value="<?= $_SESSION["monProfil"]->getNom() ?>" class="form-control input-lg"   placeholder="Nom"/>
    Prénom :
    <input type="text" name="prenom" size="10" maxlength="10" required value="<?= $_SESSION["monProfil"]->getPrenom() ?>" class="form-control input-lg"   placeholder="Prénom"/>
    Date de naissance :
    <input type="date" name="dateNaiss" size="10" maxlength="10" required value="<?= $_SESSION["monProfil"]->getDateNaissance() ?>" class="form-control input-lg"   placeholder="Date de naissance"/>
    Date d'inscription :
    <input type="date" name="dateInscription" size="10" maxlength="10" required value="<?= $_SESSION["monProfil"]->getDateInscription() ?>" class="form-control input-lg"   placeholder="Date d'inscription" disabled/>
    <input type="hidden" name="dateInscription" value="<?= $_SESSION["monProfil"]->getDateInscription() ?>" />
    Niveau de droits :
    <input type="date" name="droit" size="20" maxlength="20" required value="<?= $_SESSION["monProfil"]->getDroit() ?>" class="form-control input-lg"   placeholder="Niveau de droits" disabled/>
    <input type="hidden" name="droit" value="<?= $_SESSION["monProfil"]->getDroit() ?>" />
    Identifiant :
    <input type="date" name="idUser" size="20" maxlength="20" required value="<?= $_SESSION["monProfil"]->getIdUser() ?>" class="form-control input-lg"   placeholder="Identifiant" disabled/>
    <input type="hidden" name="idUser" value="<?= $_SESSION["monProfil"]->getIdUser() ?>" />
    Pseudo :
    <input type="text" name="pseudo" size="20" maxlength="20" required value="<?= $_SESSION["monProfil"]->getPseudo() ?>" class="form-control input-lg"  placeholder="Pseudo"/>
    Mot de passe :
    <input type="password" name="mdp" size="20" maxlength="20" required value="<?= $_SESSION["monProfil"]->getMdp() ?>" class="form-control input-lg"  placeholder="Mot de passe"/>
    Confirmation du mot de passe :
    <input type="password" name="mdp2" size="20" maxlength="20" required value="<?= $_SESSION["monProfil"]->getMdp() ?>" class="form-control input-lg"  placeholder="Confirmation du mot de passe"/>
    Adresse e-mail :
    <input type="text" name="email" size="100" maxlength="100" required value="<?= $_SESSION["monProfil"]->getEmail() ?>" class="form-control input-lg"  placeholder="Adresse e-mail"/>
    Téléphone :
    <input type="text" name="telephone" size="10" maxlength="10" required  value="<?= $_SESSION["monProfil"]->getTelephone() ?>" class="form-control input-lg"  placeholder="Téléphone"/>
    Adresse :
    <input type=text name="adresse" size="100" maxlength="100" required value="<?= $_SESSION["monProfil"]->getAdresse() ?>" class="form-control input-lg"  placeholder="Adresse"/>
    Code Postal :
    <input type=text name="codePostal" size="5" maxlength="5" required value="<?= $_SESSION["monProfil"]->getCodePostal() ?>" class="form-control input-lg"  placeholder="Code Postal"/>
    Ville :
    <input type=text name="ville" size="100" maxlength="100" required value="<?= $_SESSION["monProfil"]->getVille() ?>" class="form-control input-lg"  placeholder="Ville"/>
    Département :
    <input type=text name="numDept" size="3" maxlength="3" required value="<?= $_SESSION["monProfil"]->getDept() ?>" class="form-control input-lg"   placeholder="Département" disabled/>
    <input type=hidden name="numDept" value="<?= $_SESSION["monProfil"]->getDept() ?>"/>


    <input type=hidden name="objectToWorkWith" value="Individu" />
    <input type=hidden name="actionToDoWithObject" value="update" />
    <input type=hidden name="page" value="profilUser/profilUser.php" />


    <button type="submit" name="submit" class="boutonBleu">Modifier mon profil</button>

</form>
