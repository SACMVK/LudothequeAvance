<?php



function generer_donnees_jeu_p(int $nombreJeuxP, int $nombreJeuxT , int $nombreIndividus){
    for ($indice = 1; $indice<=$nombreJeuxP; $indice++)
    {
        $listEtats = getEtats();
        
        $list["idPC"] = rand(1, $nombreJeuxT);
        $list["idProprietaire"] = rand(1, $nombreIndividus);

        
        //echo "idPC : ".$list["idPC"]."<br>idProprietaire : ".$list["idProprietaire"]."<br>Etat du jeu : ".$list["etat"]."<br><br>";
        echo 'INSERT INTO jeu_p (idJeuP, idPC, idProprietaire)';
        echo 'VALUES ("'.$indice.'", "'.$list["idPC"].'", "'.$list["idProprietaire"].'");';
echo '<br>';        
//insert($list);
    }
}

