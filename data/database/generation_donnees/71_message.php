<?php



function generer_donnees_message(int $nombreMessages, int $nombreIndividus, string $aujourdhui) {

    // Fonction définie dans 81_prets
    $listeUsers = getAllUsers();
    
$aujourdhui = dateToJour($aujourdhui);
 
    for ($indice = 1; $indice <= $nombreMessages; $indice++) {

        // fonctions dateToJour et jourToDate définies dans 81_prets
 
        $idExped = rand(1, $nombreIndividus);
        $dateInscriptionExped = $listeUsers[$idExped]["dateInscription"];
        $inscriptionExped = dateToJour($dateInscriptionExped);

        $idDest = rand(1, $nombreIndividus);
        $dateInscriptionDest = $listeUsers[$idDest]["dateInscription"];
        $inscriptionDest = dateToJour($dateInscriptionDest);
        
        $inscriptionDest > $inscriptionExped ? $inscriptionMax = $inscriptionDest : $inscriptionMax = $inscriptionExped;
 

        
        $list['idExped'] = rand(1, $nombreIndividus);
        $list['idDest'] = rand(1, $nombreIndividus);
        $list['sujet'] = getTexte(true);
        $list['texte'] = getTexte();

        $list['dateEnvoi'] = jourToDate(rand($inscriptionMax, $aujourdhui));
 
        //echo "idExped : " . $list['idExped'] . "<br>idDest : " . $list['idDest'] . "<br>sujet : " . $list['sujet'] . "<br>texte :<br>" . $list['texte'] . "<br><br>";
        
echo 'INSERT INTO message ( idExped, idDest, sujet, texte, dateEnvoi)';
echo '<br>';
echo 'VALUES ( "'.$list['idExped'].'","' .$list['idDest'].'", "'.$list['sujet'].'"," '.$list['texte'].'"," '.$list['dateEnvoi'].'");';
echo '<br>';

//insert($list);
    }
}




function getTexte(bool $sujet = false) {
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






    $text = "";


    if ($sujet) {
        $nombreMaxMotsSujet = 8;
        $nombreMotsSujet = rand(1, $nombreMaxMotsSujet);
        for ($j = 0; $j < $nombreMotsSujet; $j++) {
            $text .= $listeMots[rand(0, count($listeMots) - 1)];
            if ($j != $nombreMotsSujet - 1) {
                $text .= " ";
            }
        }
        $casse = rand(0, 3);
        if ($casse == 2) {
            $text = strtoupper($text);
        }
        else if ($casse == 1){
            $text = ucfirst($text);
        }
    } else {
        $nombreMaxMotsDansPhrase = 10;
        $nombreMaxPhrase = 6;
        $nombreMinMotsDansPhrase = 3;
        $nombreMinPhrase = 1;

        $nombreMotsDansPhrase = rand($nombreMinMotsDansPhrase, $nombreMaxMotsDansPhrase);
        $nombrePhrases = rand($nombreMinPhrase, $nombreMaxPhrase);
        for ($i = 0; $i < $nombrePhrases; $i++) {
            for ($j = 0; $j < $nombreMotsDansPhrase; $j++) {
                $mot = $listeMots[rand(0, count($listeMots) - 1)];
                if ($j == 0) {
                    $mot = ucfirst($mot) . " ";
                } else if ($j == $nombreMotsDansPhrase - 1) {
                    $mot .= ".";
                } else {
                    $mot .= " ";
                }
                $text .= $mot;
            }
            if ($i != $nombrePhrases - 1) {
                $text .= " ";
            }
        }
    }




    return $text;
}
