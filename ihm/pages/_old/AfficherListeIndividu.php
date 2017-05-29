

<br><br><p id='titre'>Les résultats de votre recherche : </p>
<div class="container"> <div class="table-responsive"> <table class="table" id="table-recherche" > 
            <thead> 
                <tr class="tr"> 
                    <th id="table-recherche">Votre choix</th>  
                    <th id="table-recherche">Identifiant</th>  
                    <th id="table-recherche">Nom</th> 
                    <th id="table-recherche">Prénom</th> 
                    <th id="table-recherche">Adresse</th> 
                    <th id="table-recherche">Ville</th> 
                    <th id="table-recherche">Code postal</th> 
                    <th id="table-recherche">Département</th> 
                    <th id="table-recherche">Email</th> 
                    <th id="table-recherche">Téléphone</th> 
                    <th id="table-recherche">Date de naissance</th> 
                    <th id="table-recherche">Niveau de droits</th> 
                    <th id="table-recherche">Date d'inscription</th> 
                    <th id="table-recherche">Pseudo</th> 
                </tr> 
            <thead> 
            <tbody> 

                <?php foreach ($liste as $value) : ?>
                    <tr> 
                        <td id="table-recherche">'. $value->getIdUser()</td>
                        <td id="table-recherche">'.$value->getNom()</td>
                        <td id="table-recherche">'.$value->getPrenom()</td>
                        <td id="table-recherche">'.$value->getRue()</td>
                        <td id="table-recherche">'.$value->getVille()</td>
                        <td id="table-recherche">'.$value->getCodePostal()</td>
                        <td id="table-recherche">'.$value->getDept()</td>
                        <td id="table-recherche">'.$value->getEmail()</td>
                        <td id="table-recherche">'.$value->getTelephone()</td>
                        <td id="table-recherche">'.$value->getDateNaissance()</td>
                        <td id="table-recherche">'.$value->getDroit()</td>
                        <td id="table-recherche">'.$value->getDateInscription()</td>
                        <td id="table-recherche">'.$value->getPseudo()</td>
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table> ";
        <div id="button-table" ><br /><input id="submit" type="submit" name="submit" value="Modifier votre recherche" />
            <br /><br /></div></div> </div> 



