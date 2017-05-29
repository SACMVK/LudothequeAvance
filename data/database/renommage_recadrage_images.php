<?php

function renommerReduireDeplacerFichier($repertoireTemp, $repertoireVignettes, $dimensionsImageReduite) {
    if ($dossier = opendir($repertoireTemp)) {
        while (false !== ($file = readdir($dossier))) {
            $fileExtension = explode(".", $file)[count(explode(".", $file)) - 1];
            // Permet de supprimer les répertoires et "." et ".."
            if ($fileExtension != "" && (strpos($file, "."))) {
                // Création d'un nouveau nom
                $nouveauNom = renommerFichier($file, $repertoireVignettes);
                // Renommage fichier
                rename($repertoireTemp . $file, $repertoireTemp . $nouveauNom);
                // Copie du fichier dans le répertoire des vignettes
                copy($repertoireTemp . $nouveauNom, $repertoireVignettes . $nouveauNom);
                // Suppression de l'ancien (PHP ne sait pas déplacer)
                unlink($repertoireTemp . $nouveauNom);
                // Réduction du fichier à 640x640 pixels
                reduireFichier($repertoireVignettes . $nouveauNom, $dimensionsImageReduite);
            }
        }
        closedir($dossier);
    }
}

// Renommage du fichier avec un ID
function renommerFichier($nomFichier, $repertoire) {
    // Suppression des points dans les noms de fichiers
    $extension = explode(".", $nomFichier)[count(explode(".", $nomFichier)) - 1];
    $longueurExtension = strlen($extension);
    $nomSansPoint = substr($nomFichier, 0, strlen($nomFichier) - $longueurExtension);
    $nomFichier = str_replace(".", "", $nomSansPoint) . "." . strtolower($extension);

    // Récupération de la liste des fichiers présents
    $listeFichiersExistant[] = "";
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

    // Déclaration de liste alphanumérique
    $alphaNum = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    // Déclaration du nombre d'essais pour test
    //$nombreEssais = 0;
    do {
        $code = "";
        for ($i = 0; $i < 4; $i++) {
            $code .= $alphaNum[rand(0, count($alphaNum) - 1)];
        }
        $nouveauNomFichier = explode(".", $nomFichier)[0] . "_[" . $code . "]." . explode(".", $nomFichier)[1];
        //$nombreEssais ++;
    } while (in_array($nouveauNomFichier, $listeFichiersExistant));
    return $nouveauNomFichier;
}

function reduireFichier($fichier, $dimensionsImageReduite) {

    $extension = explode(".", $fichier)[count(explode(".", $fichier)) - 1];
// Création d'un objet de type image où sont les pixels originaux
    switch ($extension) {
        case "jpg":
        case "jpeg":
            $imageOrigine = imagecreatefromjpeg($fichier);
            break;
        case "png":
            $imageOrigine = imagecreatefrompng($fichier);
            break;
        case "gif":
            $imageOrigine = imagecreatefromgif($fichier);
            break;
    }


// Récupération des dimensions de l'image
    $dimensionsActuellesImage = getimagesize($fichier);

// Calcul de la réduction
    if ($dimensionsActuellesImage[0] / $dimensionsImageReduite[0] < $dimensionsActuellesImage[1] / $dimensionsImageReduite[1]) {
        $nouvelleLargeur = $dimensionsActuellesImage[0] / $dimensionsActuellesImage[1] * $dimensionsImageReduite[1];
        $nouvelleHauteur = $dimensionsImageReduite[1];
    } else {
        $nouvelleLargeur = $dimensionsImageReduite[0];
        $nouvelleHauteur = $dimensionsActuellesImage[1] / $dimensionsActuellesImage[0] * $dimensionsImageReduite[0];
    }

    // Calcul de la position du coin supérieur gauche de la zone de pixels choisie
    $decalageLargeur = ($dimensionsImageReduite[0] - $nouvelleLargeur) / 2;
    $decalageHauteur = ($dimensionsImageReduite[1] - $nouvelleHauteur) / 2;
    saveTexte($dimensionsActuellesImage[0] . " " . $dimensionsActuellesImage[1] . " " . $nouvelleLargeur . " " . $nouvelleHauteur);
// Création d'un deuxième objet de type image qui va recevoir les pixels "réduits"
    $vignette = imagecreatetruecolor($dimensionsImageReduite[0], $dimensionsImageReduite[0]) or die("Erreur");
// On met un fond blanc car certains GIF et PNG ont de la transparence
// et cela permet de compenser la différence de ratio entre celui de l'image initiale
    // et cela carré de l'image finale
    $fondBlanc = imagecolorallocate($vignette, 255, 255, 255);
    imagefill($vignette, 0, 0, $fondBlanc);
// Réduction de l'image
    imagecopyresampled($vignette, $imageOrigine, $decalageLargeur, $decalageHauteur, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $dimensionsActuellesImage[0], $dimensionsActuellesImage[1]);

// Sauvegarde de la vignette à un taux de compression élévé (=nombre faible)
    switch ($extension) {
        case "jpg":
        case "jpeg":
            imagejpeg($vignette, $fichier, 50);
            break;
        case "png":
            imagepng($vignette, $fichier, 5);
            break;
        case "gif":
            imagegif($vignette, $fichier);
            break;
    }

// Suppression des deux objets
    imagedestroy($imageOrigine);
    imagedestroy($vignette);
}
