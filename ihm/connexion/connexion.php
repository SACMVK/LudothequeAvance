<form action="" method="POST">
    <legend>Se connecter</legend>
    <div class="form-group">
        <label for="username-email"> Pseudo :</label>
        <input type="text" name="pseudo" size="20" maxlength="20" required="required" value="id333"  placeholder="votre pseudo"  class="form-control"/>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" name="mdp" size="20" maxlength="20" required="required" value="ju4d" placeholder="Password"  class="form-control"/>
    </div>
    <div class="form-group">
        <input type=hidden name=connexion value=on></input>
        <input type="submit" class="boutonBleu" value="Se connecter" />
    </div>
    <div class="form-group">
        <a href="index.php?page=creation/individu.php" class="boutonBleu">Vous n'avez pas de compte ?</a>
    </div>
</form>
