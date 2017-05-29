<?php

function generer_donnees_genre_individu(int $nombreGenre, int $nombreIndividus) {
    for ($indice = 1; $indice <= $nombreGenre; $indice++) {


// stefan : la clé primaire est la somme des deux, il faut vérifier qu'elle est unique
        $listeGenreIndividu [] = ["",""];
        do {
            $idIndividu = rand(1, $nombreIndividus);
            $genre = getGenreIndividu();
            $genreInvidu = [$idIndividu,$genre];
        } while (in_array($genreInvidu, $listeGenreIndividu));
        $listeGenreIndividu [] = $genreInvidu;


        echo 'INSERT INTO user_prefere_genre (idUser, genre)';
        echo 'VALUES ("' . $genreInvidu[0] . '", "' . $genreInvidu[1] . '");';
        echo '<br>';
    }
}

function getGenreIndividu() {
    $pdo = openConnexion();
    $requete = "SELECT * FROM genre;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $liste = null;
    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $liste [] = $ligne['genre'];
    }
    $pdo = closeConnexion();
    return $liste[rand(0, count($liste) - 1)];
}
