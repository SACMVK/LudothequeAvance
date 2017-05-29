<?php
echo '<meta charset=cp1252 />';
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';

// stefan : Définition du répertoire à parcourir. 
$cssDirectory = "ihm/css";
// stefan : Si on arrive à ouvrir le répertoire ...
if ($dossier = opendir($cssDirectory)) {
    // stefan : ..., tant qu'il y a un fichier qui n'a pas été lu ...
    while (false !== ($file = readdir($dossier))) {
        /* stefan : ... on vérifie qu'il a bien "css" en extension (les caractères après le ".".
         * explode() permet de séparer une string en un tableau à chaque "." rencontré.
         */
        $fileExtension = explode(".", $file)[count(explode(".", $file)) - 1];
        if ($fileExtension == "css") {
            /* stefan : Si le nom de fichier fini bien par "css",
             * on créé le lien html vers css.
             */
            echo '<link rel="stylesheet" type="text/css" href="' . $cssDirectory . '/' . $file . '">';
        }
    }
    closedir($dossier);
}
?>




