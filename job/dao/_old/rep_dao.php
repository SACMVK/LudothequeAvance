<?php

// On commence par lister les répertoires
$listeRepertoires = ['ihm/menu','ihm/pages'];

// 
foreach ($listeRepertoires as $repertoire){
    // Définition du chemin à explorer (adaptez a votre environnement)
    $homedir = dirname($_SERVER["DOCUMENT_ROOT"]).$repertoire;
    
    // Ouverture du répertoire
    $dir = @opendir($homedir);
    
    // Récupération d'un pointeur sur le premier
    // fichier (ou sous-répertoire) du répertoire grâce à readdir.
    // Lorsque nous aurons atteint la fin de répertoire
    // readdir retournera faux par conséquent
    // la boucle s'arrêtera
    while ($file = readdir($dir)) {
        // Affichage du nom du fichier (ou sous-répertoire)
        echo "$file<br/>";
    }
    
    // C'est fini. On ferme !
    closedir($dir);
}
?>

