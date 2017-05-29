<?php

function getListeFichier($repertoire) {
// Récupération de la liste des fichiers présents
    if ($dossier = opendir($repertoire)) {
        while (false !== ($file = readdir($dossier))) {
            $fileExtension = explode(".", $file)[count(explode(".", $file)) - 1];
            // Permet de supprimer les répertoires et "." et ".."
            if ($fileExtension != "" && (strpos($file, "."))) {
                $listeFichiersExistant[] = $file;
            }
        }
        closedir($dossier);
    }
    return $listeFichiersExistant;
}

function generation_donnees_jeu_t_aPourImage(int $nombreJeuxT, string $repertoire) {
    $listeFichiers = getListeFichier($repertoire);
    $indiceImage = 0;
    for ($indice = 1; $indice <= $nombreJeuxT; $indice++) {
        echo 'INSERT INTO a_pour_image (idPC, source)';
        // Ne pas oublier de gérer l'utf-8
        echo 'VALUES ("' . $indice . '", "' . utf8_decode($listeFichiers[$indiceImage]) . '");';
        echo '<br>';
        $indiceImage++;
        // Cela permet de repartir à zéro si le nombre d'images est moins important que le nombre de jeux
        if ($indiceImage>count($listeFichiers)-1){
            $indiceImage = 0;
        }
    }
}
