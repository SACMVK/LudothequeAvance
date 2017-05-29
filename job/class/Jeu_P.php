<?php

class Jeu_P {

    // AhMaD: les attributs pour Jeu_T
    private $idJeuP;
    private $jeuT;
    private $proprietaire;

// AhMaD: Le connecteur 
    function __construct($proprietaire, $jeuT, $idJeuP = -1) {
        $this->idJeuP = $idJeuP;
        $this->jeuT = $jeuT;
        $this->proprietaire = $proprietaire;
    }

    // AhMaD: getter et setter
    // idJeuP
    function getIdJeuP() {
        return $this->idJeuP;
    }

    function setdJeuP($idJeuP) {
        $this->idJeuP = $idJeuP;
    }

    // idProprietaire
    function getProprietaire() {
        return $this->proprietaire;
    }

    function setProprietaire($proprietaire) {
        $this->proprietaire = $proprietaire;
    }


    // idJeuT
    function getJeuT() {
        return $this->jeuT;
    }

    function setJeuT($jeuT) {
        $this->jeuT = $jeuT;
    }

    // AhMaD: ToString pour afficher l'objet, le point pour concaténer, cela comme (+) en java
    function __toString() {
        return ("id= " . $this->idJeuP . ", Proprietaire :" . $this->proprietaire . ", JeuT: " . $this->jeuT);
    }

}

?>
