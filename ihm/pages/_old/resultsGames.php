
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Permet de rechercher les users en fonction selon les critères suivants:
 *      - departement
 *      - ville
 *      - genre de jeu
 */

function screenGame($list){
    $affichageJeuT = "<h1>Jeux disponibles</h1>";
    foreach ($list as $jeu) {
        $affichageJeuT.= 
"    <table border= 1px solid black>
    <caption>".$jeu->getNom()."</caption>
   <tr>
       <th>Nombre de joueurs</th>
       <th>Editeur</th>
       <th>Règles</th>
       <th>Difficulté</th>
       <th>Public</th>
       <th>Liste des pièces</th>
       <th>Durée de la partie</th>
       <th>Année de sortie</th>
       <th>Description</th>
   </tr>
   <tr>
       <td>".$jeu->getNbJoueursMin()." à ".$jeu->getNbJoueursMax()."</td>
       <td>".$jeu->getEditeur()."</td>
       <td>".$jeu->getRegles()."</td>
       <td>".$jeu->getDifficulte()."</td>
       <td>".$jeu->getpublic()."</td>
       <td>".$jeu->getListePiecese()."</td>
       <td>".$jeu->getDureePartie()."</td>
       <td>".$jeu->getAnneeSortie()."</td>
       <td>".$jeu->getDescription()."</td>
   </tr>
</table>";
    }
       return $affichageJeuT;
    }
    
    
    