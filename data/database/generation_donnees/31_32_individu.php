<?php

function generer_donnees_individu(int $nombreIndividus) {
    $listeDepartement = getDepartements();
    for ($indice = 1; $indice <= $nombreIndividus; $indice++) {

        $list['prenom'] = getPrenom();
        $list['nom'] = getNom();
        //echo $list['prenom'] . " " . $list['nom'] . "<br>";
        $prenomMinuscule = strtolower(wd_remove_accents($list['prenom']));
        $nomMinuscule = strtolower(wd_remove_accents($list['nom']));
        //echo $prenomMinuscule . " " . $nomMinuscule . "<br>";
        $list['email'] = getMail($prenomMinuscule, $nomMinuscule);
        //echo $list['email']. "<br>";
        $departement = $listeDepartement[rand(0, count($listeDepartement) - 1)];
        $list['numDept'] = $departement;
        $list['codePostal'] = getCodePostal($departement);
        $list['droit'] = getDroits();
        $list['dateNaiss'] = getDate_(1950, 2010);
        $list['dateInscription'] = getDate_(2016);
        $list['adresse'] = getAdresse();
        $list['ville'] = getVille();
        $list['telephone'] = getTelephone();
        $list['typeCompte'] = getTypeCompte();
        // stefan : petite méthode permettant de relancer un pseudo s'il existe déjà
        $listePseudo [] = "";
        do {
            $pseudo = getPseudo($prenomMinuscule, $nomMinuscule);
        } while (in_array($pseudo, $listePseudo));
        $listePseudo [] = $pseudo;
        $list['pseudo'] = $pseudo;
        //echo $pseudo. "<br>";
        $list['mdp'] = getMdp();

//        echo "<b>" . $list['prenom'] . " " . $list['nom'] . "</b><br>";
//        echo $list['email'] . "<br>";
//        echo $list['telephone'] . "<br>";
//        echo "Droits d'utilisateur : " . $list['droit'] . "<br>";
//        echo "Né(e) le : " . $list['dateNaiss'] . "<br>";
//        echo "Pseudo : " . $list['pseudo'] . "<br>";
//        echo "Mot de passe : " . $list['mdp'] . "<br>";
//        echo "Inscrit(e) le : " . $list['dateInscription'] . "<br>";
//        echo $list['adresse'] . " à " . $list['ville'] . ", " . $list['codePostal'] . " dans le " . $list['numDept'] . " (" . $departement[1] . ")<br><br>";


        echo 'INSERT INTO compte (adresse,ville,email,telephone,pseudo,dateInscription,mdp,codePostal,numDept,droit,typeCompte)';
        echo 'VALUES ("' . $list['adresse'] . '","' . $list['ville'] . '","' . $list['email'] . '","' . $list['telephone'] . '","' . $list['pseudo'] . '","' . $list['dateInscription'] . '","' . $list['mdp'] . '","' . $list['codePostal'] . '","' . $list['numDept'] . '","' . $list['droit'] . '","' . $list['typeCompte'] . '");';
        echo '<br>';
        echo 'INSERT INTO individu (idUser,nom,prenom,dateNaiss)';
        echo 'VALUES ("' . $indice . '","' . $list['nom'] . '","' . $list['prenom'] . '","' . $list['dateNaiss'] . '");';
        echo '<br>';
        //insert($list);
    }
}

function getPseudo($prenom, $nom) {

    $listeMots = [
        " lorem", "ipsum", "dolor", "sit", "amet", "consectetur", "adipiscing", "elit", "mauris", "id", "nisi", "congue", "placerat", "leo", "eu", "ultrices", "erat", "phasellus", "convallis", "varius",
        "nunc", "at", "rhoncus", "nulla", "semper", "a", "curabitur", "eu", "consectetur", "velit", "sit", "amet", "consectetur", "ante", "nunc", "lorem", "arcu", "sagittis", "tristique", "odio",
        "ut", "ultricies", "porta", "eros", "aliquam", "ex", "felis", "placerat", "a", "tortor", "consequat", "imperdiet", "aliquam", "risus", "integer", "purus", "purus", "scelerisque", "quis", "leo",
        "nec", "bibendum", "molestie", "erat", "pellentesque", "vestibulum", "nisl", "ac", "massa", "consequat", "eget", "consectetur", "nunc", "hendrerit", "nullam", "lobortis", "lorem", "et", "tincidunt", "pulvinar",
        "metus", "turpis", "fermentum", "neque", "et", "facilisis", "diam", "orci", "vitae", "risus", "nam", "ac", "dui", "ullamcorper", "interdum", "nisi", "sit", "amet", "luctus", "lectus",
        "vestibulum", "eleifend", "dui", "ante", "vitae", "dictum", "nibh", "laoreet", "at", "quisque", "eget", "nisi", "quis", "tortor", "pulvinar", "posuere", "vivamus", "feugiat", "posuere", "lectus",
        "in", "semper", "metus", "faucibus", "sed", "etiam", "facilisis", "nulla", "ut", "faucibus", "aliquet", "nulla", "rhoncus", "neque", "ex", "ut", "imperdiet", "nulla", "enim", "at",
        "volutpat", "orci", "sagittis", "pharetra", "mauris", "tristique", "dapibus", "pellentesque", " praesent", "id", "quam", "et", "urna", "vulputate", "dignissim", "ut", "sed", "ornare", "tellus", "sed",
        "mollis", "ex", "nec", "velit", "ullamcorper", "porta", "suspendisse", "at", "quam", "vulputate", "aliquam", "metus", "ac", "convallis", "tellus", "quisque", "dapibus", "libero", "dolor", "aenean",
        "aliquet", "at", "elit", "quis", "molestie", "mauris", "at", "nulla", "eu", "diam", "imperdiet", "pulvinar", "nunc", "laoreet", "nisl", "nec", "aliquet", "blandit", "sapien", "ligula",
        "eleifend", "sapien", "vitae", "ullamcorper", "felis", "nunc", "eget", "ante", "vestibulum", "rhoncus", "ipsum", "et", "pellentesque", "pulvinar", "arcu", "diam", "malesuada", "ligula", "ac", "rhoncus",
        "nibh", "ante", "a", "nulla", "class", "aptent", "taciti", "sociosqu", "ad", "litora", "torquent", "per", "conubia", "nostra", "per", "inceptos", "himenaeos", "ut", "interdum", "nulla",
        "urna", "a", "semper", "eros", "tristique", "eget", "curabitur", "lacinia", "metus", "a", "molestie", "faucibus", "nulla", "sit", "amet", "ullamcorper", "odio", "eget", "tristique", "lacus",
        "aliquam", "convallis", "metus", "et", "sagittis", "tincidunt", " duis", "in", "placerat", "ligula", "et", "posuere", "turpis", "donec", "et", "arcu", "nibh", "etiam", "tempus", "non",
        "arcu", "lobortis", "tempus", "praesent", "auctor", "est", "ut", "malesuada", "ultricies", "lacus", "dolor", "malesuada", "nulla", "id", "mattis", "dui", "libero", "et", "est", "fusce",
        "dapibus", "sapien", "vel", "enim", "tristique", "sodales", "etiam", "sed", "orci", "vitae", "enim", "congue", "scelerisque", "suspendisse", "leo", "arcu", "consectetur", "at", "rutrum", "at",
        "dictum", "sed", "mauris", "donec", "volutpat", "lectus", "nec", "luctus", "aliquam", " aliquam", "suscipit", "sem", "vel", "mi", "elementum", "quis", "varius", "magna", "luctus", "aliquam",
        "imperdiet", "erat", "in", "orci", "semper", "viverra", "laoreet", "nibh", "aliquam", "nunc", "vehicula", "sapien", "ut", "faucibus", "porttitor", "donec", "eu", "odio", "purus", "in",
        "ac", "ex", "eget", "mauris", "aliquam", "bibendum", "ut", "viverra", "velit", "sed", "hendrerit", "dignissim", "ut", "eget", "vestibulum", "odio", "et", "pellentesque", "nulla", "duis",
        "et", "scelerisque", "sapien", "sed", "odio", "turpis", "elementum", "a", "massa", "quis", "tempus", "tincidunt", "enim", "aenean", "cursus", "non", "augue", "sed", "volutpat", "in",
        "ut", "nisl", "massa", "pellentesque", "habitant", "morbi", "tristique", "senectus", "et", "netus", "et", "malesuada", "fames", "ac", "turpis", "egestas", "phasellus", "efficitur", "quam", "quis",
        "tristique", "maximus", " aenean", "rhoncus", "consectetur", "orci", "suspendisse", "ultrices", "maximus", "porttitor", "cras", "sit", "amet", "accumsan", "metus", "cras", "tempor", "ullamcorper", "orci", "sit",
        "amet", "dictum", "donec", "eget", "est", "a", "ipsum", "egestas", "rutrum", "ut", "et", "nibh", "quisque", "non", "lacus", "sollicitudin", "posuere", "magna", "id", "ultrices",
        "tellus", "pellentesque", "a", "dolor", "tellus", "cras", "facilisis", "feugiat", "tempor", "pellentesque", "interdum", "semper", "rutrum", "mauris", "et", "sodales", "libero", " etiam", "aliquet", "fermentum",
        "sem", "sit", "amet", "posuere", "curabitur", "id", "vulputate", "sem", "donec", "porta", "lacus", "in", "vehicula", "consequat", "sapien", "felis", "placerat", "lorem", "eu", "congue",
        "ligula", "purus", "nec", "elit", "nullam", "posuere", "feugiat", "justo", "quis", "semper", "in", "feugiat", "magna", "eget", "dolor", "elementum", "imperdiet", "etiam", "venenatis", "sed",
        "magna", "a", "commodo", "duis", "id", "vulputate", "magna", "ut", "suscipit", "lorem", "consectetur", "consectetur", "nisi", "sed", "sodales", "turpis", "praesent", "vitae", "sem", "diam",
        "quisque", "sed", "fringilla", "magna", "maecenas", "ac", "orci", "tempus", "hendrerit", "erat", "ac", "pharetra", "ipsum", "aliquam", "non", "lacinia", "urna", "phasellus", "posuere", "elit",
        "vitae", "tellus", "tristique", "vitae", "vestibulum", "lacus", "consequat", "aliquam", "sagittis", "lorem", "nec", "augue", "pulvinar", "vitae", "commodo", "est", "bibendum", " vestibulum", "ante", "ipsum",
        "primis", "in", "faucibus", "orci", "luctus", "et", "ultrices", "posuere", "cubilia", "curae;", "duis", "pharetra", "erat", "vel", "volutpat", "lobortis", "lacus", "sapien", "porttitor", "metus",
        "sed", "malesuada", "nunc", "tortor", "a", "sem", "sed", "sed", "mi", "risus", "vivamus", "eget", "quam", "maximus", "dictum", "dui", "nec", "posuere", "elit", "fusce",
        "et", "felis", "iaculis", "ornare", "tortor", "at", "faucibus", "purus", "ut", "efficitur", "rhoncus", "libero", "nec", "lacinia", "nibh", "sed", "iaculis", "massa", "eget", "sem",
        "tristique", "et", "dignissim", "ligula", "fermentum", "mauris", "et", "ultrices", "sapien", "nullam", "at", "quam", "tincidunt", "pellentesque", "enim", "ac", "consequat", "dolor", "nullam", "ac",
        "maximus", "dui", "morbi", "quis", "quam", "felis", "mauris", "pharetra", "fermentum", "dolor", "at", "pretium", "cras", "tellus", "elit", "lacinia", "quis", "velit", "a", "rutrum",
        "elementum", "purus", " ut", "sollicitudin", "tortor", "ut", "tempus", "pharetra", "donec", "congue", "laoreet", "mattis", "aliquam", "pellentesque", "faucibus", "pellentesque", "duis", "finibus", "neque", "nibh",
        "et", "laoreet", "erat", "pellentesque", "sed", "aenean", "sed", "faucibus", "ipsum", "at", "vestibulum", "mi", "donec", "id", "neque", "eget", "nisi", "volutpat", "rutrum", "a",
        "at", "erat", "morbi", "vitae", "risus", "a", "mauris", "interdum", "suscipit", "sit", "amet", "non", "tortor", " sed", "a", "nulla", "id", "risus", "dictum", "bibendum",
        "nunc", "vehicula", "est", "ut", "ex", "ultricies", "maximus", "sed", "in", "porttitor", "erat", "at", "mattis", "nisl", "cras", "nec", "dapibus", "eros", "quis", "blandit",
        "nisl", "etiam", "accumsan", "magna", "id", "dictum", "euismod", "tortor", "leo", "imperdiet", "lacus", "eu", "laoreet", "mauris", "purus", "vel", "augue", "quisque", "semper", "libero",
        "scelerisque", "feugiat", "tortor", "at", "condimentum", "elit", "quisque", "pulvinar", "sem", "metus", "a", "auctor", "urna", "ornare", "sit", "amet", "etiam", "nisl", "sem", "pellentesque",
        "vitae", "elit", "sed", "eleifend", "feugiat", "neque", "curabitur", "vel", "urna", "eget", "metus", "consequat", "maximus", "nec", "sit", "amet", "elit", "sed", "vestibulum", "ligula",
        "quis", "tincidunt", "rutrum", "donec", "porta", "nulla", "id", "convallis", "semper", "donec", "porta", "eros", "eget", "enim", "semper", "vel", "sollicitudin", "metus", "sollicitudin", " nulla",
        "porttitor", "pretium", "ligula", "in", "dictum", "quam", "cras", "congue", "sollicitudin", "neque", "quis", "semper", "libero", "auctor", "sit", "amet", "sed", "ac", "accumsan", "justo",
        "nullam", "mollis", "mi", "ut", "neque", "facilisis", "nec", "tincidunt", "leo", "auctor", "vivamus", "quis", "tortor", "quis", "ante", "ornare", "interdum", "eu", "eu", "elit",
        "duis", "cursus", "leo", "est", "sit", "amet", "suscipit", "quam", "pulvinar", "ac", "in", "porta", "tincidunt", "mi", "vel", "volutpat", "nulla", "congue", "aliquet", "augue",
        "id", "luctus", "maecenas", "rutrum", "cursus", "enim", "sit", "amet", "ultricies", "quam", "iaculis", "sit", "amet", " sed", "id", "congue", "est", "cras", "ut", "leo",
        "hendrerit", "urna", "varius", "aliquam", "proin", "vel", "eros", "id", "dolor", "dictum", "vestibulum", "nullam", "dignissim", "ac", "ipsum", "sit", "amet", "iaculis", "aliquam", "est",
        "dolor", "lacinia", "sit", "amet", "ligula", "vitae", "tempus", "porta", "dui", "aenean", "eu", "egestas", "nunc", "phasellus", "eros", "quam", "egestas", "non", "facilisis", "vel",
        "tempus", "sed", "risus", "aenean", "ut", "tortor", "erat", "praesent", "quis", "vestibulum", "eros", "donec", "consequat", "lacus", "at", "vehicula", "auctor", " nunc", "pharetra", "nulla",
        "diam", "vitae", "eleifend", "dui", "elementum", "eu", "suspendisse", "ac", "enim", "at", "justo", "lacinia", "pretium", "praesent", "at", "sem", "quis", "nibh", "fermentum", "imperdiet"];

    $choix = rand(0, 5);
    switch ($choix) {
        case 0:
            $pseudo = $prenom . $nom;
            break;
        case 1:
            $pseudo = $nom . $prenom;
            break;
        case 2:
            $pseudo = $prenom . rand(10, 1000);
            break;
        case 3:
            $pseudo = $nom . rand(10, 1000);
            break;
        case 4:
            $pseudo = $listeMots[rand(0, count($listeMots) - 1)] . $listeMots[rand(0, count($listeMots) - 1)];
            break;
        case 5:
            $pseudo = $listeMots[rand(0, count($listeMots) - 1)] . rand(10, 1000);
            break;
    }
    return $pseudo;
}

function getMdp() {
    $mDP = "";
    $alphaNum = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    $longueurMDP = rand(4, 8);
    for ($i = 0; $i < $longueurMDP; $i++) {
        $mDP .= $alphaNum[rand(0, count($alphaNum) - 1)];
    }
    return $mDP;
}

function getTelephone() {
    return "0" . rand(600000000, 799999999);
}

function getCodePostal($departement) {
    $codePostal = null;
    if (strlen($departement) == 2) {
        $codePostal =  $departement . rand(0, 9) . "00";
    } else if (strlen ($departement) == 3) {
        $codePostal =  $departement . "00";
    }
    return $codePostal;
}

function getDroits() {
    $pdo = openConnexion();
    $requete = "SELECT * FROM droit_d;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $liste_droits = null;
    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $liste_droits [] = $ligne['droit'];
    }
    $pdo = closeConnexion();
    return $liste_droits[rand(0, count($liste_droits) - 1)];
}

function getTypeCompte() {
    $pdo = openConnexion();
    $requete = "SELECT * FROM type_compte_d;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $liste_type_compte = null;
    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $liste_type_compte [] = $ligne['typeCompte'];
    }
    $pdo = closeConnexion();
    return $liste_type_compte[rand(0, count($liste_type_compte) - 1)];
}

// stefan : nom pourri car on ne peut utiliser getDate()
function getDate_(int $dateMini, int $dateMax = 0) {
    // stefan : on ne peut mettre getDate()['year'] directement à la déclaration
    if ($dateMax == 0) {
        $dateMax = getDate()['year'];
    }
    $annee = rand($dateMini, $dateMax);
    $moisMax = 12;
    if ($annee == getDate()['year']) {
        $moisMax = intval(getDate()['month']);
    }
    $mois = rand(1, $moisMax);
    $jourMax = 31;
    if ($mois == 2) {
        $jourMax = 28;
    } else if ($mois == 1 || $mois == 3 || $mois == 5 || $mois == 7 || $mois == 8 || $mois == 10 || $mois == 12) {
        $jourMax = 31;
    } else {
        $jourMax = 30;
    }
    if ($annee == getDate()['year'] || $mois == getDate()['month']) {
        $jourMax = intval(getDate()['mday']);
    }
    $jour = rand(1, $jourMax);
    return $annee . "-" . $mois . "-" . $jour;
}

function getDepartements() {
    $pdo = openConnexion();
    $requete = "SELECT * FROM departement;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $listDepartements = null;
    while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $listDepartements [] = $ligne['numDept'];
    }
    $pdo = closeConnexion();
    return $listDepartements;
}

// stefan : fonction prise sur internet basé sur les expressions régulières
// suppression des accents
// petit ajout pour supprimer les espaces
function wd_remove_accents($str) {
    $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    // stefan : ajout d'une ligne pour supprimer les espaces
    $str = str_replace(" ", "", $str);
    return $str;
}

function getMail($prenom, $nom) {
    $provider = ["wanadoo", "orange", "free", "alice", "caramail", "gmail"];
    $extension = ["fr", "com", "net"];
    $separatif = [".", "-", "_", ""];
    $nomPrenom = "";
    if (rand(0, 1) == 0) {
        $nomPrenom = $prenom . $separatif[rand(0, count($separatif) - 1)] . $nom;
    } else {
        $nomPrenom = $nom . $separatif[rand(0, count($separatif) - 1)] . $prenom;
    }

    return $nomPrenom . "@" . $provider[rand(0, count($provider) - 1)] . "." . $extension[rand(0, count($extension) - 1)];
}

function getAdresse() {
    $typeVoie = [
        "venelle",
        "impasse",
        "rue",
        "ruelle",
        "passage",
        "avenue",
        "boulevard",
        "carrefour",
        "square",
        "quai",
        "allée",
        "chemin",
        "chaussée",
        "route",
        "voie"
    ];
    $nomVoie = [
        "de l'Abbaye",
        "d'Abbeville",
        "Alphonse Bertillon",
        "d'Amsterdam",
        "Antoine Arnauld",
        "d'Argenson",
        "Bausset",
        "Berzélius",
        "des Célestins",
        "Charlot",
        "du Château",
        "de Cronstadt",
        "Dautancourt",
        "Des Renaudes",
        "des Écoles",
        "Edmond Valentin",
        "du Faubourg Saint-Jacques",
        "Florimont",
        "Foch",
        "de la Fontaine Aux Lions",
        "de la Fraternité",
        "George Sand",
        "Girodet",
        "Guénot",
        "du Hameau",
        "Henri Murger",
        "d'Italie",
        "des Jacobins",
        "Jasmin",
        "Jean Bouton",
        "Moncey",
        "Monplaisir",
        "Montmartre",
        "Mousset",
        "de la Muette",
        "Nollet",
        "Olivier Métra",
        "de l'Oratoire",
        "de l'Orme",
        "du Parc",
        "de la Patte d'Oie",
        "Pégoud",
        "Petit",
        "Pierre De Coubertin",
        "Pierre Lazareff",
        "Pierre Loti",
        "Rabelais",
        "de Rambervillers",
        "René Coty",
        "Rodin",
        "Rosny Aîné",
        "Sadi Carnot",
        "Saillard",
        "Saint-Fargeau",
        "Saint-Éleuthère",
        "Servan",
        "Thomire",
        "des Tourelles",
        "Truffaut",
        "Vaneau",
        "Villehardouin",
        "Verniquet",
        "Voltaire",
        "de l'Yvette",
        "d'Aguesseau",
        "Adolphe Jullien",
        "Alfred Dehodencq",
        "Auguste Métivier",
        "Bargue",
        "Barrault",
        "Bernoulli",
        "Boulitte",
        "Boileau",
        "de la Cavalerie",
        "de Capri",
        "Charles Hermite",
        "Collin",
        "de la Cité Universitaire",
        "des Deux Portes",
        "d'Édimbourg",
        "Drevet",
        "de l'Ermitage",
        "Emile Acollas",
        "Félix Éboué",
        "Eugène Beaudouin",
        "Frédéric Mourlon",
        "Florimont",
        "de la Garance",
        "Gomboust",
        "Georges Leclanché",
        "Gustave Geffroy",
        "de la Grenade",
        "Haxo",
        "Jacques Kablé",
        "de l'Hôtel de Ville",
        "Jean Lorrain",
        "Jean-Jacques Rousseau",
        "Jourdan",
        "Labat",
        "Le Tasse",
        "Liancourt",
        "Léon Delhomme",
        "de Magdebourg",
        "Louise Labé",
        "Marcadet",
        "Marguerite de Navarre",
        "Martin Bernard"
    ];
    return rand(1, 100) . " " . $typeVoie[rand(0, count($typeVoie) - 1)] . " " . $nomVoie[rand(0, count($nomVoie) - 1)];
}

function getVille() {
    $nomVille = [
        "Paris",
        "Marseille",
        "Lyon",
        "Toulouse",
        "Nice",
        "Nantes",
        "Strasbourg",
        "Montpellier",
        "Bordeaux",
        "Lille",
        "Rennes",
        "Reims",
        "Le Havre",
        "Saint-Étienne",
        "Toulon",
        "Grenoble",
        "Dijon",
        "Angers",
        "Nîmes",
        "Villeurbanne",
        "Saint-Denis",
        "Le Mans",
        "Clermont-Ferrand",
        "Aix-en-Provence",
        "Brest",
        "Limoges",
        "Tours",
        "Amiens",
        "Perpignan",
        "Metz",
        "Boulogne-Billancourt",
        "Besançon",
        "Orléans",
        "Rouen",
        "Mulhouse",
        "Caen",
        "Saint-Denis",
        "Nancy",
        "Argenteuil",
        "Saint-Paul",
        "Montreuil",
        "Roubaix",
        "Tourcoing",
        "Dunkerque",
        "Nanterre",
        "Créteil",
        "Avignon",
        "Vitry-sur-Seine",
        "Poitiers",
        "Courbevoie",
        "Fort-de-France",
        "Versailles",
        "Colombes",
        "Asnières-sur-Seine",
        "Aulnay-sous-Bois",
        "Saint-Pierre",
        "Rueil-Malmaison",
        "Pau",
        "Aubervilliers",
        "Champigny-sur-Marne",
        "Le Tampon",
        "Antibes",
        "Saint-Maur-des-Fossés",
        "La Rochelle",
        "Cannes",
        "Béziers",
        "Calais",
        "Saint-Nazaire",
        "Colmar",
        "Drancy",
        "Bourges",
        "Mérignac",
        "Ajaccio",
        "Issy-les-Moulineaux",
        "Levallois-Perret",
        "La Seyne-sur-Mer",
        "Quimper",
        "Noisy-le-Grand",
        "Valence",
        "Villeneuve-d'Ascq",
        "Neuilly-sur-Seine",
        "Antony",
        "Vénissieux",
        "Cergy",
        "Troyes",
        "Clichy",
        "Pessac",
        "Les Abymes",
        "Ivry-sur-Seine",
        "Chambéry",
        "Lorient",
        "Niort",
        "Sarcelles",
        "Montauban",
        "Villejuif",
        "Saint-Quentin",
        "Hyères",
        "Cayenne",
        "Épinay-sur-Seine",
        "Saint-André"
    ];
    return $nomVille[rand(0, count($nomVille) - 1)];
}

function getPrenom() {
    $prenom = [
        "Emma",
        "Lea",
        "Jade",
        "Manon",
        "Chloé",
        "Inès",
        "Camille",
        "Clara",
        "Sarah",
        "Lola",
        "Zoé",
        "Louise",
        "Eva",
        "Anaïs",
        "Maelys",
        "Lucie",
        "Romane",
        "Océane",
        "Juliette",
        "Marie",
        "Celia",
        "Mathilde",
        "Julie",
        "Jeanne",
        "Lisa",
        "Noémie",
        "Lou",
        "Charlotte",
        "Clémence",
        "Laura",
        "Ambre",
        "Pauline",
        "Alicia",
        "Maéva",
        "Justine",
        "Louane",
        "Anna",
        "Mélissa",
        "Nina",
        "Luna",
        "Maëlle",
        "Margot",
        "Lily",
        "Alice",
        "Elisa",
        "Elsa",
        "Julia",
        "Margaux",
        "Rose",
        "Emilie",
        "Elise",
        "Marion",
        "Mélina",
        "Lucas",
        "Enzo",
        "Nathan",
        "Mathis",
        "Louis",
        "Hugo",
        "Maxime",
        "Jules",
        "Thomas",
        "Raphaël",
        "Gabriel",
        "Mathéo",
        "Théo",
        "Ethan",
        "Clément",
        "Yanis",
        "Arthur",
        "Léo",
        "Paul",
        "Antoine",
        "Baptiste",
        "Alexandre",
        "Axel",
        "Quentin",
        "Noa",
        "Alexis",
        "Maël",
        "Maxence",
        "Valentin",
        "Romain",
        "Kylian",
        "Matteo",
        "Esteban",
        "Mathys",
        "Victor",
        "Samuel",
        "Martin",
        "Simon",
        "Pierre",
        "Lorenzo",
        "Julien",
        "Mathieu",
        "Adrien",
        "Benjamin",
        "Nicolas",
        "Aaron"
    ];
    return $prenom[rand(0, count($prenom) - 1)];
}

function getNom() {
    $nom = [
        "Martin",
        "Bernard",
        "Thomas",
        "Dubois",
        "Durand",
        "Moreau",
        "Petit",
        "Leroy",
        "Lefèbvre",
        "Bertrand",
        "Roux",
        "David",
        "Garnier",
        "Legrand",
        "Garcia",
        "Bonnet",
        "Lambert",
        "Girard",
        "Morel",
        "Dupont",
        "Guerin",
        "Fournier",
        "Lefèvre",
        "Rousseau",
        "François",
        "Fontaine",
        "Mercier",
        "Roussel",
        "Boyer",
        "Blanc",
        "Henry",
        "Chevalier",
        "Masson",
        "Clément",
        "Perrin",
        "Lemaire",
        "Dumont",
        "Meyer",
        "Marchand",
        "Joly",
        "Gauthier",
        "Mathieu",
        "Nicolas",
        "Nguyen",
        "Robin",
        "Barbier",
        "Lucas",
        "Schmitt",
        "Duval",
        "Gautier",
        "Dufour",
        "Meunier",
        "Brunet",
        "Blanchard",
        "Leroux",
        "Caron",
        "Lopez",
        "Giraud",
        "Fabre",
        "Pierre",
        "Gaillard",
        "Sanchez",
        "Rivière",
        "Renard",
        "Perez",
        "Renault",
        "Lemoine",
        "Arnaud",
        "Colin",
        "Brun",
        "Picard",
        "Rolland",
        "Vidal",
        "Leclercq",
        "Aubert",
        "Hubert",
        "Bourgeois",
        "Roy",
        "Dupuy",
        "Louis",
        "Maillard",
        "Aubry",
        "Charpentier",
        "Benoit",
        "Berger",
        "Royer",
        "Poirier",
        "Dupuis",
        "Rodriguez",
        "Jacquet",
        "Moulin",
        "Charles",
        "Lecomte",
        "Deschamps",
        "Fernandez",
        "Guillot",
        "Collet",
        "Prévost",
        "Germain",
        "Bailly",
        "Perrot",
        "Le gall",
        "Renault",
        "Le roux",
        "Vasseur",
        "Hervé",
        "Gonzalez",
        "Barré",
        "Breton",
        "Huet",
        "Bertin",
        "Carpentier",
        "Lebrun",
        "Carré",
        "Boucher",
        "Ménard",
        "Rey",
        "Klein",
        "Weber",
        "Collin",
        "Cousin",
        "Millet",
        "Tessier",
        "Lévèque",
        "Le goff",
        "Lesage",
        "Marchal",
        "Leblanc",
        "Bouchet",
        "Etienne",
        "Jacob",
        "Humbert",
        "Bouvier",
        "Léger",
        "Perrier",
        "Pelletier",
        "Rémy"
    ];
    return $nom[rand(0, count($nom) - 1)];
}
