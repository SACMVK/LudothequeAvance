<form action=" " method="post" accept-charset="utf-8" class="form" role="form">   
    <legend>Trouver un compte</legend>
    Nom :
    <input type="text" name="nom" class="form-control input-lg" maxlength="12" placeholder="Nom" />
    Prénom :
    <input type="text" name="prenom" class="form-control input-lg" maxlength="12" placeholder="Prénom" />
    Pseudo :
    <input type="text" name="pseudo" class="form-control input-lg" maxlength="12" placeholder="Prénom" />
    Ville :
    <input type="text" name="ville" class="form-control input-lg" maxlength="12" placeholder="Ville" />
    Département :
    <select class="form-control select-lg" name="numDept">
        <?php selectDico("departement", "nom", "numDept", true) ?>
    </select>

    <input type=hidden name="objectToWorkWith" value="Individu" />
    <input type=hidden name="actionToDoWithObject" value="selectList" />


    <button type="submit" name="submit" class="boutonBleu">Rechercher</button>
    <button type="reset" name="reset" class="boutonBleu">Réinitialiser</button>

</form>          