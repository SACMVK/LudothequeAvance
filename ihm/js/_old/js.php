<?php




// stefan : Définition du répertoire à parcourir.
$jsDirectory = "ihm/js";
    // stefan : Si on arrive à ouvrir le répertoire ...
    if ($dossier = opendir ($jsDirectory)) {
        // stefan : ..., tant qu'il y a un fichier qui n'a pas été lu ...
        while ( false !== ($file = readdir ( $dossier )) ) {
            /* stefan : ... on vérifie qu'il a bien "js" en extension (les caractères après le ".".
             * explode() permet de séparer une string en un tableau à chaque "." rencontré.
             * end () permet de récupérer le dernier élément d'un tableau.
             */
            $fileExtension = explode(".", $file)[count (explode(".", $file))-1];
            if ($fileExtension == "js") {
                /* stefan : Si le nom de fichier fini bien par "js",
                 * on créé le lien html vers css.
                 */
                echo '<script src="'.$jsDirectory.'/'.$file.'"></script>';
                }   
            }
        closedir ( $dossier );
    }




