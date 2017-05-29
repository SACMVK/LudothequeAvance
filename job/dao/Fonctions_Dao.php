<?php

function getAujourdhui() {
    return getDate()['year'] . "-" . getDate()['mon'] . "-" . getDate()['mday'];
}

function convertDateToSQLdate(string $stringDate) {
    $delimiters = ["/", "-", " ", ":"];
    foreach ($delimiters as $value) {
        if (strpbrk($value, $stringDate) != false) {
            $delimiter = $value;
        }
    }
    $decoupage = explode($delimiter, $stringDate);
    // cas YYYYMMDD
    if (strlen($decoupage[0]) == 4) {
        $convertedDate = $decoupage[0] . "-" . $decoupage[1] . "-" . $decoupage[2];
        // cas DDMMYYYY
    } else {
        $convertedDate = $decoupage[2] . "-" . $decoupage[1] . "-" . $decoupage[0];
    }
    return $convertedDate;
}

// Fonction permettant l'affichage d'une liste déroulante
// L'attribut $colonneId est optionnel, il est utilisé dans le cas où
// la valeur qui doit être envoyée est différente de celle affichée.
// L'attribut $isColonneIdVisible est optionnel permet d'afficher l'attribut $colonneId dans le cas où
// celui-ci est utilisé.
Function selectDico(string $table, string $colonneNom, string $colonneId = "", bool $isColonneIdVisible = false) {

    // M : Connecxion a la BD
    $pdo = openConnexion();
    $reponse = "SELECT * FROM " . $table . ";";
    $stmt = $pdo->prepare($reponse);
    $stmt->execute();
    // Apparait champs de recherche en blanc si ne souhaite pas recherche sur ce champs
    // Cette valeur ne sera pas prise en compte dans le contrôleur
    ?>
    <option value="">-----</option>
    <?php
    //Création d'une liste pour y insérer les résultats du dico et pouvoir les trier
    $listeValidation = array();
    $liste = array();
    while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $estDedans = in_array($donnees[$colonneNom], $listeValidation);
        // La valeur est ajoutée à la liste déroulante si elle n'est pas déjà présente
        if (!$estDedans) {
            // Si elle n'est pas déjà présente, elle est ajouté à la liste des valeurs déjà présentes
            $listeValidation[] = $donnees[$colonneNom];
            // Enregistrement des valeurs retournées si on enregistre l'ID
            if ($colonneId != "") {
                $liste[$donnees[$colonneNom]] = $donnees[$colonneId];
                // Enregistrement des valeurs retournées si on n'enregistre pas l'ID
            } else {
                $liste[$donnees[$colonneNom]] = $donnees[$colonneNom];
            }
        }
    }
    // Ordonnancement de la liste par ordre alphabétique de la colonne des données
    ksort($liste);

    foreach ($liste as $colonneNom => $colonneId) {
        if ($isColonneIdVisible) {
            ?>
            <option value="<?= $colonneId; ?>"><?= $colonneId . " - " . $colonneNom; ?></option>
            <?php
        } else {
            ?>
            <option value="<?= $colonneId; ?>"><?= $colonneNom; ?></option>
            <?php
        }
    }
}

function getArrayFromSQL(string $table, string $colonne) {
    $pdo = openConnexion();
    $reponse = "SELECT " . $colonne . " FROM " . $table . ";";
    $stmt = $pdo->prepare($reponse);
    $stmt->execute();
    $array = array();
    while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $array [] = $donnees["$colonne"];
    }
    return $array;
}

/*
 * Fonction permettant de récupérer la liste d'un champs dans une autre table pour une valeur donnée (exemple idPC=1)
 * @param $table est la table dans laquelle on souhaite récupérer les données
 * @param $var est la valeur donnée dans le WHERE
 * @param $champsSelect est la colonne de laquelle nous souhaitons récupérer les données
 * Retourne une liste de valeurs
 */

Function selectListe($table, $var, $champsSelect) {
    $pdo = openConnexion();

    $liste = array();
    $requete = "SELECT " . $champsSelect . " FROM " . $table . " WHERE idPC=" . $var . ";";
    $stmtListe = $pdo->prepare($requete);

    $stmtListe->execute();

    while ($donnees = $stmtListe->fetch(PDO::FETCH_ASSOC)) {
        $liste[] = $donnees[$champsSelect];
    }
    return $liste;
}

function screenDate(string $date) {
    $dateExploded = explode("-", $date);
    $mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
    return intval($dateExploded[2]) . " " . $mois[intval($dateExploded[1]) - 1] . " " . $dateExploded[0];
}

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

/*
 * M : Fonction d'upload d'une image.
 * @author : Manu
 * @Creation Date : 28/05/2017
 * Utilisée notamment dans la proposition d'un nouveau jeu_t
 * @param $sourceName : nom du fichier source ($_FILES['source']['name'])
 * @param $sourceTmpName : nom temporaire du fichier source ($_FILES['source']['tmp_name'])
 * @param $sourceSize : taille du fichier source ($_FILES['source']['size'])
 * retourne un array composé d'un message et du nouveau nom de l'image
 */

function uploadImage($sourceName, $sourceTmpName, $sourceSize) {
    $message = '';

    $target_dir = "C:/xampp/htdocs/LudothequeBTS/data/images/vignettes/"; //J'ai dû mettre l'url en absolu car ne me trouve pas le fichier en relative
    // Ne pas oublier la gestion de l'utf8
    $target_file = $target_dir . utf8_decode(basename($sourceName));
    $uploadOk = 1;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($sourceTmpName);
        if ($check !== false) {
            $message .= "Le fichier est bien une image - " . $check["mime"] . ". ";
            $uploadOk = 1;
        } else {
            $message .= "Le fichier n'est pas une image. ";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
//    if (file_exists($target_file)) {
//        $message .= "Une image portant le même nom est déjà présente. Consultez l'article de gestion des images. ";
//        $uploadOk = 0;
//    }
    // Check file size
    if ($sourceSize > 5242880) {
        $message .= "L'image est trop lourde. ";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (strtolower($fileType) != "jpg" && strtolower($fileType) != "png" && strtolower($fileType) != "jpeg" && strtolower($fileType) != "gif") {
        $message .= "Seules les images de types JPG, JPEG, PNG & GIF sont autorisées. ";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= "Le chargement n'est pas possible. ";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($sourceTmpName, $target_file)) {
            $message .= "Votre fichier " . basename($sourceName) . " a bien été chargé. ";
            // Renommage du fichier avec un ID
            //include 'C:/xampp/htdocs/LudothequeBTS/data/database/renommage_recadrage_images.php';

            $nouveauNom = renommerFichier(utf8_decode($sourceName), $target_dir);
            rename($target_file, $target_dir . $nouveauNom);

            $dimensionsImageReduite = [640, 640];

            // Création d'un objet de type image où sont les pixels originaux
            switch (strtolower($fileType)) {
                case "jpg":
                case "jpeg":
                    $imageOrigine = imagecreatefromjpeg($target_dir . $nouveauNom);
                    break;
                case "png":
                    $imageOrigine = imagecreatefrompng($target_dir . $nouveauNom);
                    break;
                case "gif":
                    $imageOrigine = imagecreatefromgif($target_dir . $nouveauNom);
                    break;
            }


            // Récupération des dimensions de l'image
            $dimensionsActuellesImage = getimagesize($target_dir . $nouveauNom);

            // Calcul de la réduction
            if ($dimensionsActuellesImage[0] / $dimensionsImageReduite[0] < $dimensionsActuellesImage[1] / $dimensionsImageReduite[1]) {
                $nouvelleLargeur = $dimensionsActuellesImage[0] / $dimensionsActuellesImage[1] * $dimensionsImageReduite[1];
                $nouvelleHauteur = $dimensionsImageReduite[1];
            } else {
                $nouvelleLargeur = $dimensionsImageReduite[0];
                $nouvelleHauteur = $dimensionsActuellesImage[1] / $dimensionsActuellesImage[0] * $dimensionsImageReduite[0];
            }

            // Création d'un deuxième objet de type image qui va recevoir les pixels "réduits"
            $vignette = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur) or die("Erreur");

            // Réduction de l'image
            imagecopyresampled($vignette, $imageOrigine, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $dimensionsActuellesImage[0], $dimensionsActuellesImage[1]);

            // Sauvegarde de la vignette à un taux de compression élévé (=nombre faible)
            switch (strtolower($fileType)) {
                case "jpg":
                case "jpeg":
                    imagejpeg($vignette, $target_dir . $nouveauNom, 40);
                    break;
                case "png":
                    imagepng($vignette, $target_dir . $nouveauNom, 4);
                    break;
                case "gif":
                    imagegif($vignette, $target_dir . $nouveauNom);
                    break;
            }

            // Suppression des deux objets
            imagedestroy($imageOrigine);
            imagedestroy($vignette);
        } else {
            $message .= "Il y a eu une erreur lors du chargement. ";
        }
    }
    

    return [$message, $nouveauNom];
}
?>
