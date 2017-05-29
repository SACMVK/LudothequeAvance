<?php

abstract class Compte {

    private $idUser;
    private $ville;
    private $adresse;
    private $codePostal;
    private $dpt;
    private $email;
    private $telephone;
    private $pseudo;
    private $dateInscription;
    private $mdp;
    private $droit;

    function __construct($ville, $adresse, $codePostal, $dpt, $email, $telephone, $pseudo, $dateInscription, $mdp, $droit, $idUser) {
        $this->idUser = $idUser;
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->dpt = $dpt;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->pseudo = $pseudo;
        $this->dateInscription = $dateInscription;
        $this->mdp = $mdp;
        $this->droit = $droit;
    }

    // ville
    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    // Adresse
    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    // codePostal
    public function getCodePostal() {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }

    // departement
    public function getDept() {
        return $this->dpt;
    }

    public function setDept($dpt) {
        $this->dpt = $dpt;
    }

    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    // email
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // telephone
    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    // pseudo
    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($Pseudo) {
        $this->pseudo = $Pseudo;
    }

    // dateinscription
    public function getDateInscription() {
        return $this->dateInscription;
    }

    public function setDateInscription($dateInscription) {
        $this->dateInscription = $dateInscription;
    }

    // Mdp
    public function getMdp() {
        return $this->mdp;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    // droit
    public function getDroit() {
        return $this->droit;
    }

    public function setDroit($droit) {
        $this->droit = $droit;
    }

}
