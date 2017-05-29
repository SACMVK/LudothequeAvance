<p id='titre'>Les résultats de votre recherche : </p>
<div class="container">
    <div class="table-responsive">
        <table class="table" id="table-recherche" > 
            <thead> 
                <tr class="tr">  
                    <th id="table-recherche">Pseudo</th> 
                    <th id="table-recherche">Nom</th> 
                    <th id="table-recherche">Prénom</th> 
                    <th id="table-recherche">Ville</th> 
                    <th id="table-recherche">Département</th> 
                </tr> 
            <thead> 
            <tbody> 

                <?php
                if (!empty($listOfElements)):
                    foreach ($listOfElements as $compte) :
                        ?>
                        <tr> 
                            <td id="table-recherche"><?= $compte->getPseudo() ?></td>
                            <td id="table-recherche"><?= $compte->getNom() ?></td>
                            <td id="table-recherche"><?= $compte->getPrenom() ?></td>
                            <td id="table-recherche"><?= $compte->getVille() ?></td>
                            <td id="table-recherche"><?= $compte->getDept() ?></td>
                        </tr> 
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
            </tbody>
        </table>
        <div id="button-table" ><br />
            <a href="index.php?page=recherche/individu.php" class="boutonBlanc">Modifier ma recherche</a>
            <br />
            <br />
        </div>
    </div>
</div> 



