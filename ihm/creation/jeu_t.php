<p style="color:red;">@team : TODO</p>
<form action=" " method="post" accept-charset="utf-8" class="form" role="form" enctype="multipart/form-data">   
    <?php
    /*
     * Il faut créer ici un formulaire renseigannt tous les champs du constructeur d'un jeu_t et du produit culturel
     * Ces input permettent de renseigner la liste de l'instanciation d'un nouveau jeu_t, grace a la classe controllerRequete
     * puis est ensuite envoyée au Jeu_T_Dao qui traite l'insertion des données avec insert($valuesToInsert). 
     */
    ?>

    <legend>Proposer un nouveau jeu à la ludothèque</legend>
    Type de produit culturel :
    <!-- Autocmplétion : Si fait de cette manière il faut ajouter dans le insert du Jeu_T_Dao la Vérification si le typePC existe déjà dans le dico type_p_c_d -->
    <input type="text" list="typePCdata" name="typePC" required>
    <datalist id="typePCdata">
        <?php selectDico("type_p_c_d", "typePC", ""); ?>
    </datalist><br/><br/>

    Nom :
    <input type="text" name="nom" class="form-control input-lg"  placeholder="Nom" required/>

    Année de sortie :
    <input type="number" step="1" name="anneeSortie" min="1900" max="2100" class="form-control input-lg"  placeholder="2000" required/>

    Description du jeu :
    <input type="text" name="description" class="form-control input-lg"  placeholder="Jeu rigolo à faire en famille ..." required/>

    Nombre de joueurs au minimum :
    <input type="number" name="nbJoueursMin" min="1" class="form-control input-lg"  placeholder="1" required/>

    Nombre de joueurs au minimum :
    <input type="number" name="nbJoueursMax" min="1" class="form-control input-lg"  placeholder="1" required/> <!-- Vérifier si possible incrément au min à la valeur de nbJoueursMin pour ne pas avoir un max inférieur a u min -->

    <!-- Pour l'editeur donne la possibilité d'écrire un nom d'éditeur si n'apparait pas dans la liste ou de le selectionner directement -->
    Editeur :
    <input type="text" list="editeurdata" name="editeur" required>
    <datalist id="editeurdata">
        <?php selectDico("editeur_d", "editeur"); ?>
    </datalist><br/><br/>

    Règles du jeu :
    <input type="text" name="regles" class="form-control input-lg"  placeholder="Le but du jeu est de se débarrasser de toutes ses cartes..." required/>

    Difficulté :
    <select type="text" class="form-control select-lg" name="difficulte" required>
        <?php selectDico("difficulte_d", "difficulte") ?>
    </select>

    Public :
    <select type="text" class="form-control select-lg" name="public" required>
        <?php selectDico("public_d", "public") ?>
    </select>

    Liste des pièces du jeu :
    <input type="text" name="listePieces" class="form-control input-lg"  placeholder="un jeu de 52 cartes et un sablier ..." required/>

    Durée de la partie :
    <input type="text" list="dureePartie" name="dureePartie" placeholder="ex : 15 minutes, 2 heures , 2 jours" required>
    <datalist id="dureePartie">
        <?php selectDico("jeu_t", "dureePartie"); ?>
    </datalist><br/><br/>

    Genre de jeu (choix multiple possible avec Ctrl+select):
    <select type="select" multiple size="4" class="form-control select-lg" name="genre[]" required>
        <?php
        $pdo = openConnexion();
        $reponse = "SELECT * FROM genre;";
        $stmt = $pdo->prepare($reponse);
        $stmt->execute();
        $liste = array();
        while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $liste[]=$donnees['genre'];
        }
        ksort($liste);
        for ($i = 0; $i < count($liste); $i++) :?>
            <option value="<?= $liste[$i]; ?>"><?= $liste[$i]; ?></option>
        <?php endfor; ?>
    </select>
    
    <input type="file" multiple class="form-control" name="source[]" accept="image/*,application/pdf">



    <input type=hidden name="objectToWorkWith" value="Jeu_T" />
    <input type=hidden name="actionToDoWithObject" value="insert" />
    <input type='hidden' name='page' value='creation/confirmation_proposition.php' />
    <input type="submit" name="submit" class="boutonBleu" value="Proposer ce jeu"/>
    <input type="reset" class="boutonBleu" value="Réinitialiser">
</form>          


