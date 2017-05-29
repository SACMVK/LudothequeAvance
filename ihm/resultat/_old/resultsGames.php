
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Manu
 * Permet de rechercher les users en fonction selon les critères suivants:
 *      - departement
 *      - ville
 *      - genre de jeu
 */

// Fonction qui permet de n'afficher que les $length premiers caractères
function str_truncate($text, $length){
    if(strlen($text) <= $length) return $text;
    return trim(substr($text, 0, $length));
}

//Modification effectuée pour éliminer les "" et que les balises soient visiblent dans Netbeans
function screenGame($list){
//    $affichageJeuT =  "<h1>Jeux disponibles</h1>" ; //pas besoin d'initialiser une variable
    ?><h1>Jeux disponibles</h1><?php
    foreach ($list as $jeu) :
 //       $affichageJeuT.=
        if (!empty($list)):
?>    
<table border= 1px solid black>
    <caption><?=  $jeu->getNom() ?></caption>
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
        <td><?= $jeu->getNbJoueursMin() ?> à <?= $jeu->getNbJoueursMax() ?></td>
        <td><?= $jeu->getEditeur() ?></td>
        <td><?= str_truncate($jeu->getRegles(),100) ?> ...</td>
        <td><?= $jeu->getDifficulte() ?></td>
        <td><?= $jeu->getpublic() ?></td>
        <td><?= $jeu->getListePiecese() ?></td>
        <td><?= $jeu->getDureePartie() ?></td>
        <td><?= $jeu->getAnneeSortie() ?></td>
        <td><?= str_truncate($jeu->getDescription(),100) ?> ...</td>
    </tr>
</table><?php
        else:?>
<table border= 1px solid black>
    <tr>
        <td>Aucun résultat</td>
    </tr>
</table><?php
        endif;
    endforeach;
//       return $affichageJeuT;
    }
