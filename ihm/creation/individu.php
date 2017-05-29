
<p style="color:red;">@team : Attention, le mail et le pseudo doivent être uniques dans la BD, il faut modifier les valeurs par défaut</p>
<form action=" " method="post" accept-charset="utf-8" class="form" role="form">   
    <legend>Créer mon compte</legend>
    Nom :
    <input type="text" name="nom" size="10" maxlength="10" required value="nom" class="form-control input-lg"  placeholder="Nom"/>
    Prénom :
    <input type="text" name="prenom" size="10" maxlength="10" required value="prenom" class="form-control input-lg" placeholder="Prénom"/>             
    Date de naissance :
    <input type="date" name="dateNaiss" size="10" maxlength="10" required value="14-02-1990" class="form-control input-lg" placeholder="Date de naissance"/>
    Pseudo :
    <input type="text" name="pseudo" size="20" maxlength="20" required value="pseudo"  class="form-control input-lg" placeholder="Pseudo"/>        
    Mot de passe :
    <input type="password" name="mdp" size="20" maxlength="20" required value="mdp"  class="form-control input-lg" placeholder=" Mot de passe"/>
    Confirmation du mot de passe :
    <input type="password" name="mdp2" size="20" maxlength="20" required value="mdp"  class="form-control input-lg" placeholder=" Confirmation du mot de passe"/>
    Adresse e-mail :
    <input type="text" name="email" size="100" maxlength="100" required value="a@a.fr"  class="form-control input-lg" placeholder="   Adresse e-mail"/>
    Téléphone :
    <input type="text" name="telephone" size="10" maxlength="10" required  value="0612345678"  class="form-control input-lg" placeholder="Téléphone"/>
    Adresse :
    <input type=text name="adresse" size="100" maxlength="100" required value="9 rue test"  class="form-control input-lg" placeholder="Adresse"/>
    Code Postal :
    <input type=text name="codePostal" size="5" maxlength="5" required value="56000"  class="form-control input-lg" placeholder="Code Postal"/>
    Ville :
    <input type=text name="ville" rows="5" size="100" maxlength="100" required value="Vannes"  class="form-control input-lg" placeholder="Ville"/>

    <input type=hidden name="objectToWorkWith" value="Individu" />
    <input type=hidden name="actionToDoWithObject" value="insert" />

    <?php
    $arrayPseudo = getArrayFromSQL("compte","pseudo");
    $stringPseudo = "";
    foreach ($arrayPseudo as $pseudo){
        $stringPseudo.=$pseudo."#";
    }
    $stringPseudo = substr($stringPseudo,0,strlen($stringPseudo)-1);
    ?>
    <input type="hidden" name="listePseudo" value="<?=$stringPseudo ?>" />

        <?php
    $arrayEmail = getArrayFromSQL("compte","email");
    $stringEmail = "";
    foreach ($arrayEmail as $email){
        $stringEmail.=$email."#";
    }
    $stringEmail = substr($stringEmail,0,strlen($stringEmail)-1);
    ?>
    <input type="hidden" name="listeMail" value="<?=$stringEmail ?>" />
    
    <button type="submit" name="submit" class="boutonBleu">S'inscrire</button>
    <button type="reset" name="reset" class="boutonBleu">Réinitialiser</button>


</form>          

