<?php

abstract class ProduitCulturel {

    private $idPC;
    private $typePC;
    private $anneeSortie;
    private $description;

    function __construct($anneeSortie, $description, $typePC, $idPC) {
        $this->idPC = $idPC;
        $this->anneeSortie = $anneeSortie;
        $this->description = $description;
        $this->typePC = $typePC;
    }

    public function getIdPC() {
        return $this->idPC;
    }

    public function setIdPC($idPC) {
        $this->idPC = $idPC;
    }

    /* M : AJOUT DES PARAMETRES DE LA TABLE produit_culturel_t */

    //M : $anneeSortie
    public function getAnneeSortie() {
        return $this->anneeSortie;
    }

    public function setAnneeSortie($anneeSortie) {
        $this->anneeSortie = $anneeSortie;
    }

    //M : $description
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    //M : $typePC
    public function getTypePC() {
        return $this->typePC;
    }

    public function setTypePC($typePC) {
        $this->typePC = $typePC;
    }

}
