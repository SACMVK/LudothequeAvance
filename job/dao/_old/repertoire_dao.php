<?php

Function getFichiersAutorises (){
    // stefan : On commence par lister les répertoires
    $listeRepertoiresAutorises = ['ihm/menu','ihm/pages'];
    $listeFichiersAutorises = array();

    foreach ($listeRepertoiresAutorises as $repertoire){
        // Ouverture du répertoire
        $dir = opendir($repertoire) or die('Le répertoire n\'existe pas');

        // Récupération d'un pointeur sur le premier
        // fichier (ou sous-répertoire) du répertoire grâce à readdir.
        // Lorsque nous aurons atteint la fin de répertoire
        // readdir retournera faux par conséquent
        // la boucle s'arrêtera
        while ($fichier = readdir($dir)) {
            if($fichier != '.' && $fichier != '..') {
            // stefan : Ajout du nom de fichier à la liste
            //if (substr ($file)>2)
                 $listeFichiersAutorises[] = $fichier;
        }
        }
        // stefan : Fermerture du lecteur de répertoire
        closedir($dir);

    }    
    return $listeFichiersAutorises;
    
}

?>

